#!/usr/bin/env python3
"""
Extract Rec 20 Annex II & III units missing from the unit-converter package.

Reads the Excel source, cross-references with existing package codes,
filters active-only, categorizes each unit, and outputs JSON.
"""

import json
import os
import re
import subprocess
import sys

try:
    import openpyxl
except ImportError:
    print("Error: openpyxl required. Install with: pip install openpyxl", file=sys.stderr)
    sys.exit(1)

EXCEL_PATH = os.path.expanduser("~/Desktop/rec20_Rev17e-2021.xlsx")
SHEET_NAME = "Annex II & Annex III"
PROJECT_ROOT = os.path.dirname(os.path.dirname(os.path.abspath(__file__)))
OUTPUT_PATH = os.path.join(PROJECT_ROOT, "bin", "annex23_units.json")

# --- Categorization mappings from the implementation plan ---

# Aliases: code -> (target_category, target_case_code)
ALIASES = {
    "EA":  ("counting", "C62"),
    "H87": ("counting", "C62"),
    "NAR": ("counting", "C62"),
    "A99": ("memory_capacity", "XBI"),
    "C37": ("memory_capacity", "XKB"),
    "B68": ("memory_capacity", "XGB"),
    "2G":  ("voltage", "VLT"),
    "2H":  ("voltage", "VLT"),
}

# Extend existing convertible categories: code -> (category, case_name, symbol, multiplier, label)
EXTEND_CONVERTIBLE = {
    # Counting
    "GRO": ("counting", "Gross", "gr", "144", "gross"),
    "GGR": ("counting", "GreatGross", "GGR", "1728", "great gross"),
    "SCO": ("counting", "Score", "SCO", "20", "score"),
    "MIL": ("counting", "Thousand", "MIL", "1000", "thousand"),
    "MIO": ("counting", "Million", "MIO", "1000000", "million"),
    "MLD": ("counting", "Milliard", "MLD", "1000000000", "milliard"),
    "BIL": ("counting", "BillionEUR", "BIL", "1000000000000", "billion (EUR)"),
    "TRL": ("counting", "TrillionEUR", "TRL", "1000000000000000000", "trillion (EUR)"),
    # Mass
    "CNT": ("mass", "CentalUK", "CNT", "45.359237", "cental (UK)"),
    "CTM": ("mass", "MetricCarat", "CTM", "0.0002", "metric carat"),
    "LBT": ("mass", "TroyPoundUS", "LBT", "0.3732417", "troy pound (US)"),
    "QTR": ("mass", "QuarterUK", "Qr (UK)", "12.70059", "quarter (UK)"),
    "SCR": ("mass", "Scruple", "SCR", "0.001295982", "scruple"),
    # Length
    "H80": ("length", "RackUnit", "U", "0.04445", "rack unit"),
    "H82": ("length", "BigPoint", "bp", "0.0003527778", "big point"),
    "N3":  ("length", "PrintPoint", "N3", "0.000351", "print point"),
    "R1":  ("length", "Pica", "R1", "0.004217518", "pica"),
    "E33": ("length", "FootPerThousand", "E33", "0.0003048", "foot per thousand"),
    # DimensionlessConcentration
    "H93": ("dimensionless_concentration", "PercentPerHundred", "%/100", "0.0001", "percent per hundred"),
    "H94": ("dimensionless_concentration", "PercentPerThousand", "%/1000", "0.00001", "percent per thousand"),
    "H91": ("dimensionless_concentration", "PercentPerTenThousand", "%/10000", "0.000001", "percent per ten thousand"),
    "H92": ("dimensionless_concentration", "PercentPerHundredThousand", "%/100000", "0.0000001", "percent per one hundred thousand"),
    "Q26": ("dimensionless_concentration", "OnePerOne", "1/1", "1", "one per one"),
    # Frequency
    "BPM": ("frequency", "BeatsPerMinute", "BPM", "0.01666666666666666", "beats per minute"),
    "E91": ("frequency", "ReciprocalDay", "d⁻¹", "0.00001157407407407", "reciprocal day"),
    "FIT": ("frequency", "FailuresInTime", "FIT", "0.000000000000277778", "failures in time"),
    # Time
    "M36": ("time", "ThirtyDayMonth", "mo (30 days)", "2592000", "30-day month"),
    "M37": ("time", "Actual360", "y (360 days)", "31104000", "actual/360"),
    # Area
    "E19": ("area", "Ping", "E19", "3.305", "ping"),
}

# New convertible categories: code -> (category, case_name, symbol, multiplier, label)
NEW_CONVERTIBLE = {
    # Wavenumber
    "Q25": ("wavenumber", "Dioptre", "dpt", "1", "dioptre"),
    "E90": ("wavenumber", "ReciprocalCentimetre", "cm⁻¹", "100", "reciprocal centimetre"),
    "Q24": ("wavenumber", "ReciprocalInch", "1/in", "39.3700787", "reciprocal inch"),
    "TPI": ("wavenumber", "TeethPerInch", "TPI", "39.3700787", "teeth per inch"),
    # TextileDensity
    "D34": ("textile_density", "Tex", "tex", "0.000001", "tex"),
    "A47": ("textile_density", "Decitex", "dtex", "0.0000001", "decitex"),
    "A49": ("textile_density", "Denier", "den", "0.000000111111111", "denier"),
    # SignalRate
    "J38": ("signal_rate", "Baud", "Bd", "1", "baud"),
    "K50": ("signal_rate", "Kilobaud", "kBd", "1000", "kilobaud"),
    "J54": ("signal_rate", "Megabaud", "MBd", "1000000", "megabaud"),
}

# Packaging extensions
PACKAGING_CODES = {
    "AB", "AS", "AY", "CG", "D63", "D65", "HA", "HEA", "JNT",
    "KA", "KT", "LEF", "LO", "LR", "LS", "NL", "OA", "PD",
    "QR", "RM", "ROM", "SQ", "SR", "STC", "STK", "STW", "SW",
    "SX", "SYR", "Z11", "P5",
}


def get_existing_codes():
    """Extract all unit codes currently in the package."""
    codes = set()
    src_dir = os.path.join(PROJECT_ROOT, "src", "Units")
    for fname in os.listdir(src_dir):
        if not fname.endswith(".php"):
            continue
        with open(os.path.join(src_dir, fname)) as f:
            for line in f:
                m = re.search(r"case\s+\w+\s*=\s*'([^']+)'", line)
                if m:
                    codes.add(m.group(1))
    return codes


def make_case_name(name):
    """Convert a unit name to a PascalCase PHP enum case name."""
    # Remove parenthetical content for the case name
    clean = name.strip()
    # Replace special chars with spaces
    clean = re.sub(r'[^a-zA-Z0-9\s]', ' ', clean)
    # PascalCase
    words = clean.split()
    result = ''.join(w.capitalize() for w in words if w)
    # Ensure starts with a letter
    if result and not result[0].isalpha():
        result = 'U' + result
    return result or 'Unknown'


def main():
    existing_codes = get_existing_codes()
    print(f"Existing codes in package: {len(existing_codes)}")

    wb = openpyxl.load_workbook(EXCEL_PATH, read_only=True, data_only=True)
    ws = wb[SHEET_NAME]

    units = []
    all_active = []

    for row in ws.iter_rows(min_row=2, values_only=True):
        status = row[0]
        code = str(row[1]).strip() if row[1] else None
        name = str(row[2]).strip() if row[2] else ""
        level = str(row[4]).strip() if row[4] else ""
        symbol = str(row[5]).strip() if row[5] else code or ""
        conv_factor = str(row[6]).strip() if row[6] else None

        if not code:
            continue

        # Skip deprecated (X) and deleted (D) and broken status (¦)
        if status in ('X', 'D', '¦'):
            continue

        all_active.append(code)

        # Skip codes already in the package
        if code in existing_codes:
            continue

        # Categorize the unit
        entry = {
            "code": code,
            "name": name,
            "symbol": symbol if symbol != "None" else code,
            "level": level,
        }

        if code in ALIASES:
            target_cat, target_code = ALIASES[code]
            entry.update({
                "category": target_cat,
                "disposition": "alias",
                "convertible": True,
                "multiplier": "0",
                "is_alias": True,
                "alias_target": target_code,
                "case_name": make_case_name(name),
            })
        elif code in EXTEND_CONVERTIBLE:
            cat, case_name, sym, mult, label = EXTEND_CONVERTIBLE[code]
            entry.update({
                "category": cat,
                "disposition": "extend",
                "convertible": True,
                "multiplier": mult,
                "is_alias": False,
                "alias_target": None,
                "case_name": case_name,
                "symbol": sym,
                "label": label,
            })
        elif code in NEW_CONVERTIBLE:
            cat, case_name, sym, mult, label = NEW_CONVERTIBLE[code]
            entry.update({
                "category": cat,
                "disposition": "new_category",
                "convertible": True,
                "multiplier": mult,
                "is_alias": False,
                "alias_target": None,
                "case_name": case_name,
                "symbol": sym,
                "label": label,
            })
        elif code in PACKAGING_CODES:
            entry.update({
                "category": "packaging",
                "disposition": "extend",
                "convertible": False,
                "multiplier": "0",
                "is_alias": False,
                "alias_target": None,
                "case_name": make_case_name(name),
                "label": name,
            })
        else:
            # Trade (non-convertible catch-all)
            entry.update({
                "category": "trade",
                "disposition": "new_category",
                "convertible": False,
                "multiplier": "0",
                "is_alias": False,
                "alias_target": None,
                "case_name": make_case_name(name),
                "label": name,
            })

        units.append(entry)

    print(f"Total active codes in Annex II&III: {len(all_active)}")
    print(f"Missing from package (to add): {len(units)}")

    # Summary by category
    cats = {}
    for u in units:
        key = f"{u['category']} ({u['disposition']})"
        cats[key] = cats.get(key, 0) + 1
    print("\nBreakdown by category:")
    for k, v in sorted(cats.items()):
        print(f"  {k}: {v}")

    # Write JSON
    with open(OUTPUT_PATH, 'w') as f:
        json.dump(units, f, indent=2, ensure_ascii=False)

    print(f"\nOutput written to: {OUTPUT_PATH}")


if __name__ == "__main__":
    main()
