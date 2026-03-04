# Rec 20 vs GS1 Verification Reference

Cross-check of GS1 UnitConverterUNECERec20 datatable multipliers against
UN/CEFACT Recommendation 20 (Rev 17, 2021) Annex I conversion factors.

## GS1 Data Errors Found and Fixed

| Code | Unit                   | GS1 Original | Correct Value | Error Factor | Rec 20 Reference    |
|------|------------------------|--------------|---------------|--------------|---------------------|
| HN   | millimetres of mercury | 13332.24     | 133.3224      | 100x         | '133,322 4 Pa'      |
| F79  | inch of mercury        | 33220.4859   | 3386.389      | ~9.81x       | '3,386 39 × 10³ Pa' |
| F78  | inch of water          | 2443.56309   | 249.089       | ~9.81x       | '2,490 89 × 10² Pa' |
| 4T   | picofarad              | 1e-09        | 1e-12         | 1000x        | '10⁻¹² F'           |

## Excluded Entries (13)

Units excluded from automated verification due to different base unit conventions,
code collisions, or known Rec 20 typographical errors.

| Code | Name                                 | GS1 Type                    | Reason                                              |
|------|--------------------------------------|-----------------------------|-----------------------------------------------------|
| 80   | pound per square inch absolute       | pressure                    | Rec 20 uses kg/m² base                              |
| A85  | gigaelectronvolt                     | energy                      | Rec 20 uses eV base                                 |
| B29  | kiloelectronvolt                     | energy                      | Rec 20 uses eV base                                 |
| B71  | megaelectronvolt                     | energy                      | Rec 20 uses eV base                                 |
| B84  | terabit/second                       | data rate                   | Code collision (GS1: terabit/s, Rec20: microampere) |
| BQL  | becquerel                            | radioactivity               | Rec 20 uses Curie base                              |
| E41  | kilogram-force per square millimetre | pressure                    | Rec 20 exponent sign error (10⁻⁶ should be 10⁶)     |
| H67  | millimetre per hour                  | speed                       | Rec 20 exponent error (10⁻⁷ should be 10⁻⁶)         |
| L21  | cubic millimetre per cubic metre     | dimensionless concentration | Rec 20 inverse convention                           |
| MIK  | square mile (statute mile)           | area                        | Rec 20 uses km² base                                |
| N22  | ounce (avoirdupois) per square inch  | pressure                    | Rec 20 uses kg/m² base                              |
| RPM  | revolutions per minute               | angular velocity            | Rec 20 uses 1/s, GS1 uses rad/s                     |
| RPS  | revolutions per second               | angular velocity            | Rec 20 uses 1/s, GS1 uses rad/s                     |

## Verification Tables

**643 units verified** across 49 categories.

### Absorbed Dose (4)

| Code | Name         | GS1 Multiplier | GS1 Offset | Rec 20 Conv Factor | Status |
|------|--------------|----------------|------------|--------------------|--------|
| A61  | erg per gram | 0.0001         | 0          | 10⁻⁴ J/kg          | OK     |
| A95  | gray         | 1              | 0          | m²/s²              | OK     |
| C13  | milligray    | 0.001          | 0          | 10⁻³ Gy            | OK     |
| C80  | rad          | 0.01           | 0          | 10⁻² Gy            | OK     |

### Absorbed Dose Rate (11)

| Code | Name                 | GS1 Multiplier | GS1 Offset | Rec 20 Conv Factor    | Status |
|------|----------------------|----------------|------------|-----------------------|--------|
| P54  | miligray per second  | 0.001          | 0          | 10⁻³ Gy/s             | OK     |
| P55  | microgray per second | 1e-06          | 0          | 10⁻⁶ Gy/s             | OK     |
| P56  | nanogray per second  | 1e-09          | 0          | 10⁻⁹ Gy/s             | OK     |
| P57  | gray per minute      | 0.0166667      | 0          | 1,666 67 × 10⁻² Gy/s  | OK     |
| P58  | milligray per minute | 1.66667e-05    | 0          | 1,666 67 × 10⁻⁵ Gy/s  | OK     |
| P59  | microgray per minute | 1.66667e-08    | 0          | 1,666 67 × 10⁻⁸ Gy/s  | OK     |
| P60  | nanogray per minute  | 1.66667e-11    | 0          | 1,666 67 × 10⁻¹¹ Gy/s | OK     |
| P61  | gray per hour        | 0.000277778    | 0          | 2,777 78 × 10⁻⁴ Gy/s  | OK     |
| P62  | milligray per hour   | 2.77778e-07    | 0          | 2,777 78 × 10⁻⁷ Gy/s  | OK     |
| P63  | microgray per hour   | 2.77778e-10    | 0          | 2,777 78 × 10⁻¹⁰ Gy/s | OK     |
| P64  | nanogray per hour    | 2.77778e-13    | 0          | 2,777 78 × 10⁻¹³ Gy/s | OK     |

### Acceleration (11)

| Code | Name                                   | GS1 Multiplier | GS1 Offset | Rec 20 Conv Factor   | Status |
|------|----------------------------------------|----------------|------------|----------------------|--------|
| A73  | foot per second squared                | 0.3048         | 0          | 0,304 8 m/s²         | OK     |
| A76  | gal                                    | 0.01           | 0          | 10⁻² m/s²            | OK     |
| C11  | milligal                               | 1e-05          | 0          | 10⁻⁵ m/s²            | OK     |
| IV   | inch per second squared                | 0.0254         | 0          | 0,025 4 m/s²         | OK     |
| K40  | standard acceleration of free fall     | 9.80665        | 0          | 9,806 65 m/s²        | OK     |
| M38  | kilometre per second squared           | 1000           | 0          | 10³ m/s²             | OK     |
| M39  | centimetre per second squared          | 0.01           | 0          | 10⁻² m/s²            | OK     |
| M40  | yard per second squared                | 0.9144         | 0          | 9,144 x 10⁻¹ m/s²    | OK     |
| M41  | millimetre per second squared          | 0.001          | 0          | 10⁻³ m/s²            | OK     |
| M42  | mile (statute mile) per second squared | 1609.344       | 0          | 1,609 344 x 10³ m/s² | OK     |
| MSK  | metre per second squared               | 1              | 0          | m/s²                 | OK     |

### Amount of Substance (4)

| Code | Name      | GS1 Multiplier | GS1 Offset | Rec 20 Conv Factor | Status |
|------|-----------|----------------|------------|--------------------|--------|
| B45  | kilomole  | 1000           | 0          | 10³ mol            | OK     |
| C18  | millimole | 0.001          | 0          | 10⁻³ mol           | OK     |
| C34  | mole      | 1              | 0          | mol                | OK     |
| FH   | micromole | 1e-06          | 0          | 10⁻⁶ mol           | OK     |

### Angle (9)

| Code | Name        | GS1 Multiplier  | GS1 Offset | Rec 20 Conv Factor    | Status |
|------|-------------|-----------------|------------|-----------------------|--------|
| A91  | gon         | 0.01570796327   | 0          | 1,570 796 × 10⁻² rad  | OK     |
| B97  | microradian | 1e-06           | 0          | 10⁻⁶ rad              | OK     |
| C25  | milliradian | 0.001           | 0          | 10⁻³ rad              | OK     |
| C81  | radian      | 1               | 0          | rad                   | OK     |
| D61  | minute      | 0.0002908882087 | 0          | 2,908 882 × 10⁻⁴ rad  | OK     |
| D62  | second      | 4.848136811e-06 | 0          | 4,848 137 × 10⁻⁶ rad  | OK     |
| DD   | degree      | 0.01745329252   | 0          | 1,745 329 x 10⁻² rad  | OK     |
| M43  | mil         | 0.0009817477042 | 0          | 9,817 477  × 10⁻⁴ rad | OK     |
| M44  | revolution  | 6.283185307     | 0          | 6,283 185 rad         | OK     |

### Angular Impulse (2)

| Code | Name                              | GS1 Multiplier | GS1 Offset | Rec 20 Conv Factor | Status |
|------|-----------------------------------|----------------|------------|--------------------|--------|
| B33  | kilogram metre squared per second | 1              | 0          | kg x m²/s          | OK     |
| C53  | newton metre second               | 1              | 0          | N x m x s          | OK     |

### Angular Velocity (2)

| Code | Name                   | GS1 Multiplier | GS1 Offset | Rec 20 Conv Factor | Status |
|------|------------------------|----------------|------------|--------------------|--------|
| 2A   | radians per second     | 1              | 0          | rad/s              | OK     |
| M46  | revolutions per minute | 0.104719755    | 0          | 0,104 719 8 rad/s  | OK     |

### Area (17)

| Code | Name                                    | GS1 Multiplier | GS1 Offset | Rec 20 Conv Factor   | Status |
|------|-----------------------------------------|----------------|------------|----------------------|--------|
| ACR  | acre                                    | 4046.873       | 0          | 4 046,873 m²         | OK     |
| ARE  | are                                     | 100            | 0          | 10² m²               | OK     |
| CMK  | square centimetre                       | 0.0001         | 0          | 10⁻⁴ m²              | OK     |
| DAA  | decare                                  | 1000           | 0          | 10³ m²               | OK     |
| DMK  | square decimetre                        | 0.01           | 0          | 10⁻² m²              | OK     |
| FTK  | square foot                             | 0.09290304     | 0          | 9,290 304 x 10⁻² m²  | OK     |
| H16  | square decametre                        | 100            | 0          | 10² m²               | OK     |
| H18  | square hectometre                       | 10000          | 0          | 10⁴ m²               | OK     |
| H30  | square micrometre (square micron)       | 1e-12          | 0          | 10⁻¹² m²             | OK     |
| HAR  | hectare                                 | 10000          | 0          | 10⁴ m²               | OK     |
| INK  | square inch                             | 0.00064516     | 0          | 6,451 6 x 10⁻⁴ m²    | OK     |
| KMK  | square kilometre                        | 1000000        | 0          | 10⁶ m²               | OK     |
| M47  | circular mil                            | 5.067075e-10   | 0          | 5,067 075 x 10⁻¹⁰ m² | OK     |
| M48  | square mile (based on U.S. survey foot) | 2589998        | 0          | 2,589 998 x 10⁶ m²   | OK     |
| MMK  | square millimetre                       | 1e-06          | 0          | 10⁻⁶ m²              | OK     |
| MTK  | square metre                            | 1              | 0          | m²                   | OK     |
| YDK  | square yard                             | 0.8361274      | 0          | 8,361 274 x 10⁻¹ m²  | OK     |

### Capacitance (7)

| Code | Name       | GS1 Multiplier | GS1 Offset | Rec 20 Conv Factor         | Status |
|------|------------|----------------|------------|----------------------------|--------|
| 4O   | microfarad | 1e-06          | 0          | 10⁻⁶ F                     | OK     |
| 4T   | picofarad  | 1e-12          | 0          | 10⁻¹² F                    | FIXED  |
| C10  | millifarad | 0.001          | 0          | 10⁻³ F                     | OK     |
| C41  | nanofarad  | 1e-09          | 0          | 10⁻⁹ F                     | OK     |
| FAR  | farad      | 1              | 0          | F                          | OK     |
| H48  | attofarad  | 1e-18          | 0          | 10⁻¹⁸ m⁻² x kg⁻¹ x s⁴ x A² | OK     |
| N90  | kilofarad  | 1000           | 0          | 10³ F                      | OK     |

### Charge (13)

| Code | Name                                   | GS1 Multiplier | GS1 Offset | Rec 20 Conv Factor  | Status |
|------|----------------------------------------|----------------|------------|---------------------|--------|
| A8   | ampere second                          | 1              | 0          | C                   | OK     |
| AMH  | ampere hour                            | 3600           | 0          | 3,6 x 10³ C         | OK     |
| B26  | kilocoulomb                            | 1000           | 0          | 10³ C               | OK     |
| B86  | microcoulomb                           | 1e-06          | 0          | 10⁻⁶ C              | OK     |
| C40  | nanocoulomb                            | 1e-09          | 0          | 10⁻⁹ C              | OK     |
| C71  | picocoulomb                            | 1e-12          | 0          | 10⁻¹² C             | OK     |
| COU  | coulomb                                | 1              | 0          | A x s               | OK     |
| D77  | megacoulomb                            | 1000000        | 0          | 10⁶ C               | OK     |
| D86  | millicoulomb                           | 0.001          | 0          | 10⁻³ C              | OK     |
| E09  | milliampere hour                       | 3.6            | 0          | 3,6 C               | OK     |
| N94  | franklin                               | 3.335641e-10   | 0          | 3,335 641 x 10⁻¹⁰ C | OK     |
| N95  | ampere minute                          | 60             | 0          | 60 C                | OK     |
| TAH  | kiloampere hour (thousand ampere hour) | 3600000        | 0          | 3,6 x 10⁶ C         | OK     |

### Conductance (7)

| Code | Name         | GS1 Multiplier | GS1 Offset | Rec 20 Conv Factor | Status |
|------|--------------|----------------|------------|--------------------|--------|
| B53  | kilosiemens  | 1000           | 0          | 10³ S              | OK     |
| B99  | microsiemens | 1e-06          | 0          | 10⁻⁶ S             | OK     |
| C27  | millisiemens | 0.001          | 0          | 10⁻³ S             | OK     |
| N92  | picosiemens  | 1e-12          | 0          | 10⁻¹² S            | OK     |
| NQ   | mho          | 1              | 0          | S                  | OK     |
| NR   | micromho     | 1e-06          | 0          | 10⁻⁶ S             | OK     |
| SIE  | siemens      | 1              | 0          | A/V                | OK     |

### Current (8)

| Code | Name        | GS1 Multiplier | GS1 Offset | Rec 20 Conv Factor | Status |
|------|-------------|----------------|------------|--------------------|--------|
| 4K   | milliampere | 0.001          | 0          | 10⁻³ A             | OK     |
| AMP  | ampere      | 1              | 0          | A                  | OK     |
| B22  | kiloampere  | 1000           | 0          | 10³ A              | OK     |
| C39  | nanoampere  | 1e-09          | 0          | 10⁻⁹ A             | OK     |
| C70  | picoampere  | 1e-12          | 0          | 10⁻¹² A            | OK     |
| H38  | megaampere  | 1000000        | 0          | 10⁶ A              | OK     |
| N96  | biot        | 10             | 0          | 10¹ A              | OK     |
| N97  | gilbert     | 0.7957747      | 0          | 7,957 747 x 10⁻¹ A | OK     |

### Density (28)

| Code | Name                                | GS1 Multiplier | GS1 Offset | Rec 20 Conv Factor       | Status |
|------|-------------------------------------|----------------|------------|--------------------------|--------|
| 23   | gram per cubic centimetre           | 1000           | 0          | 10³ kg/m³                | OK     |
| 87   | pound per cubic foot                | 16.01846       | 0          | 1,601 846 x 10¹ kg/m³    | OK     |
| A93  | gram per cubic metre                | 0.001          | 0          | 10⁻³ kg/m³               | OK     |
| B34  | kilogram per cubic decimetre        | 1000           | 0          | 10³ kg/m³                | OK     |
| B35  | kilogram per litre                  | 1000           | 0          | 10³ kg/m³                | OK     |
| B72  | megagram per cubic metre            | 1000           | 0          | 10³ kg/m³                | OK     |
| D41  | tonne per cubic metre               | 1000           | 0          | 10³ kg/m³                | OK     |
| F23  | gram per cubic decimetre            | 1              | 0          | kg x m⁻³                 | OK     |
| G31  | kilogram per cubic centimetre       | 1000000        | 0          | 10⁶ kg x m⁻³             | OK     |
| G32  | ounce (avoirdupois) per cubic yard  | 0.0370798      | 0          | 3,707 98 × 10⁻² kg x m⁻³ | OK     |
| GE   | pound per gallon (US)               | 119.8264       | 0          | 1,198 264 x 10² kg/m³    | OK     |
| GJ   | gram per millilitre                 | 1000           | 0          | 10³ kg/m³                | OK     |
| GL   | gram per litre                      | 1              | 0          | kg/m³                    | OK     |
| GP   | milligram per cubic metre           | 1e-06          | 0          | 10⁻⁶ kg/m³               | OK     |
| GQ   | microgram per cubic metre           | 1e-09          | 0          | 10⁻⁹ kg/m³               | OK     |
| H29  | microgram per litre                 | 1e-06          | 0          | 10⁻⁶ m⁻³ x kg            | OK     |
| K41  | grain per gallon (US)               | 0.01711806     | 0          | 1,711 806 x 10⁻² kg/m³   | OK     |
| K71  | pound (avoirdupois) per gallon (UK) | 99.77637       | 0          | 99,776 37 kg/m³          | OK     |
| K84  | pound per cubic yard                | 0.5932764      | 0          | 0,593 276 4 kg/m³        | OK     |
| KMQ  | kilogram per cubic metre            | 1              | 0          | kg/m³                    | OK     |
| L37  | ounce (avoirdupois) per gallon (UK) | 6.236023       | 0          | 6,236 023 kg/m³          | OK     |
| L38  | ounce (avoirdupois) per gallon (US) | 7.489152       | 0          | 7,489 152 kg/m³          | OK     |
| L39  | ounce (avoirdupois) per cubic inch  | 1729.994       | 0          | 1,729 994 x 10³ kg/m³    | OK     |
| L65  | slug per cubic foot                 | 515.3788       | 0          | 5,153 788 x 10² kg/m³    | OK     |
| L92  | ton (UK long) per cubic yard        | 1328.939       | 0          | 1,328 939 x 10³ kg/m³    | OK     |
| L93  | ton (US short) per cubic yard       | 1186.553       | 0          | 1,186 553 x 10³ kg/m³    | OK     |
| LA   | pound per cubic inch                | 27679.9        | 0          | 2,767 990 x 10⁴ kg/m³    | OK     |
| M1   | milligram per litre                 | 0.001          | 0          | 10⁻³ kg/m³               | OK     |

### Dimensionless Concentration (11)

| Code | Name                             | GS1 Multiplier | GS1 Offset | Rec 20 Conv Factor | Status |
|------|----------------------------------|----------------|------------|--------------------|--------|
| H60  | cubic metre per cubic metre      | 1              | 0          | 1                  | OK     |
| H65  | millilitre per cubic metre       | 1e-06          | 0          | 10⁻⁶ 1             | OK     |
| J33  | microgram per kilogram           | 1e-09          | 0          | 10⁻⁹               | OK     |
| J36  | microlitre per litre             | 1e-06          | 0          | 10⁻⁶               | OK     |
| J87  | cubic centimetre per cubic metre | 1e-06          | 0          | 10⁻⁶               | OK     |
| J91  | cubic decimetre per cubic metre  | 0.001          | 0          | 10⁻³               | OK     |
| K62  | litre per litre                  | 1              | 0          | 1                  | OK     |
| L19  | millilitre per litre             | 0.001          | 0          | 10⁻³               | OK     |
| L32  | nanogram per kilogram            | 1e-12          | 0          | 10⁻¹²              | OK     |
| M29  | kilogram per kilogram            | 1              | 0          | 1                  | OK     |
| NA   | milligram per kilogram           | 1e-06          | 0          | 10⁻⁶  1            | OK     |

### Dynamic Viscosity (19)

| Code | Name                               | GS1 Multiplier | GS1 Offset | Rec 20 Conv Factor       | Status |
|------|------------------------------------|----------------|------------|--------------------------|--------|
| 89   | poise                              | 0.1            | 0          | 0,1 Pa x s               | OK     |
| C24  | millipascal second                 | 0.001          | 0          | 10⁻³ Pa x s              | OK     |
| C65  | pascal second                      | 1              | 0          | Pa x s                   | OK     |
| C7   | centipoise                         | 0.001          | 0          | 10⁻³ Pa x s              | OK     |
| J32  | micropoise                         | 1e-06          | 0          | 10⁻⁶ Pa x s              | OK     |
| K67  | pound per foot hour                | 0.0004133789   | 0          | 4,133 789 x 10⁻⁴ Pa x s  | OK     |
| K68  | pound per foot second              | 1.488164       | 0          | 1,488 164 Pa x s         | OK     |
| K91  | pound-force second per square foot | 47.88026       | 0          | 47,880 26 Pa x s         | OK     |
| K92  | pound-force second per square inch | 6894.757       | 0          | 6,894 757  x 10³ Pa x s  | OK     |
| L64  | slug per foot second               | 47.88026       | 0          | 47,880 26 Pa x s         | OK     |
| N34  | poundal second per square foot     | 1.488164       | 0          | 1,488 164 Pa x s         | OK     |
| N36  | newton second per square metre     | 1              | 0          | Pa x s                   | OK     |
| N38  | kilogram per metre minute          | 0.0166667      | 0          | 1,666 67 × 10⁻² Pa x s   | OK     |
| N39  | kilogram per metre day             | 1.15741e-05    | 0          | 1,157 41 × 10⁻⁵ Pa x s   | OK     |
| N40  | kilogram per metre hour            | 0.000277778    | 0          | 2,777 78 × 10⁻⁴ Pa x s   | OK     |
| N41  | gram per centimetre second         | 0.1            | 0          | 0,1 Pa x s               | OK     |
| N42  | poundal second per square inch     | 214.2957       | 0          | 2,142 957 x 10² Pa x s   | OK     |
| N43  | pound per foot minute              | 0.02480273     | 0          | 2,480 273 x 10⁻²  Pa x s | OK     |
| N44  | pound per foot day                 | 1.722412e-05   | 0          | 1,722 412 x 10⁻⁵ Pa x s  | OK     |

### Effective Dose (4)

| Code | Name                          | GS1 Multiplier | GS1 Offset | Rec 20 Conv Factor | Status |
|------|-------------------------------|----------------|------------|--------------------|--------|
| C28  | millisievert                  | 0.001          | 0          | 10⁻³ Sv            | OK     |
| D13  | sievert                       | 1              | 0          | m²/s²              | OK     |
| D91  | rem                           | 0.01           | 0          | 10⁻² Sv            | OK     |
| L31  | milliroentgen aequivalent men | 1e-05          | 0          | 10⁻⁵ Sv            | OK     |

### Effective Dose Rate (13)

| Code | Name                    | GS1 Multiplier  | GS1 Offset | Rec 20 Conv Factor         | Status |
|------|-------------------------|-----------------|------------|----------------------------|--------|
| P65  | sievert per second      | 1               | 0          | Sv/s                       | OK     |
| P66  | millisievert per second | 0.001           | 0          | 10⁻³ Sv/s                  | OK     |
| P67  | microsievert per second | 1e-06           | 0          | 10⁻⁶ Sv/s                  | OK     |
| P68  | nanosievert per second  | 1e-09           | 0          | 10⁻⁹ Sv/s                  | OK     |
| P69  | rem per second          | 0.01            | 0          | 10⁻² Sv/s                  | OK     |
| P70  | sievert per hour        | 0.000277778     | 0          | 2,777 78 × 10⁻⁴ Sv/s       | OK     |
| P71  | millisievert per hour   | 2.77777778e-08  | 0          | 0,277 777 778 × 10⁻⁷ Sv/s  | OK     |
| P72  | microsievert per hour   | 2.77777778e-11  | 0          | 0,277 777 778 × 10⁻¹⁰ Sv/s | OK     |
| P73  | nanosievert per hour    | 2.77777778e-14  | 0          | 0,277 777 778 × 10⁻¹³ Sv/s | OK     |
| P74  | sievert per minute      | 0.016666        | 0          | 0,016 666 Sv/s             | OK     |
| P75  | millisievert per minute | 1.666666667e-05 | 0          | 1,666 666 667 × 10⁻⁵ Sv/s  | OK     |
| P76  | microsievert per minute | 1.666666667e-08 | 0          | 1,666 666 667 × 10⁻⁸ Sv/s  | OK     |
| P77  | nanosievert per minute  | 1.666666667e-11 | 0          | 1,666 666 667 × 10⁻¹¹ Sv/s | OK     |

### Energy (28)

| Code | Name                                       | GS1 Multiplier     | GS1 Offset | Rec 20 Conv Factor      | Status |
|------|--------------------------------------------|--------------------|------------|-------------------------|--------|
| 3B   | megajoule                                  | 1000000            | 0          | 10⁶ J                   | OK     |
| 85   | foot pound-force                           | 1.355818           | 0          | 1,355 818 J             | OK     |
| A13  | attojoule                                  | 1e-18              | 0          | 10⁻¹⁸ J                 | OK     |
| A53  | electronvolt                               | 1.602176487e-19    | 0          | 1,602 176 487 x 10⁻¹⁹ J | OK     |
| A57  | erg                                        | 1e-07              | 0          | 10⁻⁷J                   | OK     |
| A68  | exajoule                                   | 1e+18              | 0          | 10¹⁸ J                  | OK     |
| A70  | femtojoule                                 | 1e-15              | 0          | 10⁻¹⁵ J                 | OK     |
| BTU  | British thermal unit (international table) | 1055.056           | 0          | 1,055 056 x 10³ J       | OK     |
| C15  | millijoule                                 | 0.001              | 0          | 10⁻³ J                  | OK     |
| C68  | petajoule                                  | 1000000000000000.0 | 0          | 10¹⁵ J                  | OK     |
| D30  | terajoule                                  | 1000000000000      | 0          | 10¹² J                  | OK     |
| D32  | terawatt hour                              | 3600000000000000.0 | 0          | 3,6 x 10¹⁵ J            | OK     |
| E14  | kilocalorie (international table)          | 4186.8             | 0          | 4,186 8 x 10³ J         | OK     |
| GV   | gigajoule                                  | 1000000000         | 0          | 10⁹ J                   | OK     |
| GWH  | gigawatt hour                              | 3600000000000      | 0          | 3,6 x 10¹² J            | OK     |
| J55  | watt second                                | 1                  | 0          | W x s                   | OK     |
| J75  | calorie (mean)                             | 4.19002            | 0          | 4,190 02 J              | OK     |
| JOU  | joule                                      | 1                  | 0          | J                       | OK     |
| K51  | kilocalorie (mean)                         | 4190.02            | 0          | 4,190 02 x 10³ J        | OK     |
| K53  | kilocalorie (thermochemical)               | 4184               | 0          | 4,184 x 10³ J           | OK     |
| KJO  | kilojoule                                  | 1000               | 0          | 10³ J                   | OK     |
| KWH  | kilowatt hour                              | 3600000            | 0          | 3,6 x 10⁶ J             | OK     |
| MWH  | megawatt hour                              | 3600000000         | 0          | 3,6 x 10⁹ J             | OK     |
| N46  | foot poundal                               | 0.04214011         | 0          | 4,214 011 x 10⁻² J      | OK     |
| N47  | inch poundal                               | 0.003511677        | 0          | 3,511 677 x 10⁻³ J      | OK     |
| N71  | therm (EC)                                 | 105506000          | 0          | 1,055 06 × 10⁸ J        | OK     |
| N72  | therm (US)                                 | 105480400          | 0          | 1,054 804 × 10⁸ J       | OK     |
| WHR  | watt hour                                  | 3600               | 0          | 3,6 x 10³ J             | OK     |

### Energy Density (5)

| Code | Name                                                      | GS1 Multiplier | GS1 Offset | Rec 20 Conv Factor  | Status |
|------|-----------------------------------------------------------|----------------|------------|---------------------|--------|
| A60  | erg per cubic centimetre                                  | 0.1            | 0          | 10⁻¹ J/m³           | OK     |
| B8   | joule per cubic metre                                     | 1              | 0          | J/m³                | OK     |
| JM   | megajoule per cubic metre                                 | 1000000        | 0          | 10⁶ J/m³            | OK     |
| N58  | British thermal unit (international table) per cubic foot | 37258.95       | 0          | 3,725 895 x10⁴ J/m³ | OK     |
| N59  | British thermal unit (thermochemical) per cubic foot      | 37234.03       | 0          | 3,723 403 x10⁴ J/m³ | OK     |

### Exposure (2)

| Code | Name       | GS1 Multiplier | GS1 Offset | Rec 20 Conv Factor         | Status |
|------|------------|----------------|------------|----------------------------|--------|
| B63  | lux hour   | 3600           | 0          | 3,6 x 10³ s x cd x sr / m² | OK     |
| B64  | lux second | 1              | 0          | s x cd x sr / m²           | OK     |

### Flow Rate (83)

| Code | Name                             | GS1 Multiplier | GS1 Offset | Rec 20 Conv Factor      | Status |
|------|----------------------------------|----------------|------------|-------------------------|--------|
| 2J   | cubic centimetre per second      | 1e-06          | 0          | 10⁻⁶ m³/s               | OK     |
| 2K   | cubic foot per hour              | 7.86579e-06    | 0          | 7,865 79 x 10⁻⁶ m³/s    | OK     |
| 2L   | cubic foot per minute            | 0.0004719474   | 0          | 4,719 474 x 10⁻⁴ m³/s   | OK     |
| 40   | millilitre per second            | 1e-06          | 0          | 10⁻⁶ m³/s               | OK     |
| 41   | millilitre per minute            | 1.66667e-08    | 0          | 1,666 67 x 10⁻⁸ m³/s    | OK     |
| 4X   | kilolitre per hour               | 0.000277778    | 0          | 2,777 78 x 10⁻⁴ m³/s    | OK     |
| 5A   | barrel (US) per minute           | 0.00264979     | 0          | 2,649 79 x 10⁻³ m³/s    | OK     |
| G2   | US gallon per minute             | 6.30902e-05    | 0          | 6,309 020 x 10⁻⁵ m³/s   | OK     |
| G3   | Imperial gallon per minute       | 7.57682e-05    | 0          | 7,576 82 x 10⁻⁵ m³/s    | OK     |
| J58  | barrel (UK petroleum) per minute | 2.651886       | 0          | 2,651 886 m³/s          | OK     |
| J59  | barrel (UK petroleum) per day    | 1.8415874e-06  | 0          | 1,841 587 4 x 10⁻⁶ m³/s | OK     |
| J60  | barrel (UK petroleum) per hour   | 4.41981e-05    | 0          | 4,419 810 x 10⁻⁵ m³/s   | OK     |
| J61  | barrel (UK petroleum) per second | 0.15911315     | 0          | 0,159 113 15 m³/s       | OK     |
| J62  | barrel (US petroleum) per hour   | 4.416314e-05   | 0          | 4,416 314 x 10⁻⁵ m³/s   | OK     |
| J63  | barrel (US petroleum) per second | 0.1589873      | 0          | 0,158 987 3 m³/s        | OK     |
| J64  | bushel (UK) per day              | 4.209343e-07   | 0          | 4,209 343 x 10⁻⁷ m³/s   | OK     |
| J65  | bushel (UK) per hour             | 1.010242e-05   | 0          | 1,010 242 x 10⁻⁵ m³/s   | OK     |
| J66  | bushel (UK) per minute           | 0.0006061453   | 0          | 6,061 453 x 10⁻⁴ m³/s   | OK     |
| J67  | bushel (UK) per second           | 0.03636872     | 0          | 3,636 872 x 10⁻² m³/s   | OK     |
| J68  | bushel (US dry) per day          | 4.078596e-07   | 0          | 4,078 596 x 10⁻⁷ m³/s   | OK     |
| J69  | bushel (US dry) per hour         | 9.788631e-06   | 0          | 9,788 631 x 10⁻⁶ m³/s   | OK     |
| J70  | bushel (US dry) per minute       | 0.0005873178   | 0          | 5,873 178 x 10⁻⁴ m³/s   | OK     |
| J71  | bushel (US dry) per second       | 0.03523907     | 0          | 3,523 907 x 10⁻² m³/s   | OK     |
| J90  | cubic decimetre per day          | 1.15741e-08    | 0          | 1,157 41 x 10⁻⁸ m³/s    | OK     |
| J92  | cubic decimetre per minute       | 1.66667e-05    | 0          | 1,666 67 x 10⁻⁵ m³/s    | OK     |
| J93  | cubic decimetre per second       | 0.001          | 0          | 10⁻³ m³/s               | OK     |
| J95  | ounce (UK fluid) per day         | 3.288549e-10   | 0          | 3,288 549 x 10⁻¹⁰ m³/s  | OK     |
| J96  | ounce (UK fluid) per hour        | 7.892517e-09   | 0          | 7,892 517 x 10⁻⁹ m³/s   | OK     |
| J97  | ounce (UK fluid) per minute      | 4.73551e-07    | 0          | 4,735 51 x 10⁻⁷ m³/s    | OK     |
| J98  | ounce (UK fluid) per second      | 2.841306e-05   | 0          | 2,841 306 x 10⁻⁵ m³/s   | OK     |
| J99  | ounce (US fluid) per day         | 3.422862e-10   | 0          | 3,422 862 x 10⁻¹⁰ m³/s  | OK     |
| K10  | ounce (US fluid) per hour        | 8.214869e-09   | 0          | 8,214 869 x 10⁻⁹ m³/s   | OK     |
| K11  | ounce (US fluid) per minute      | 4.928922e-07   | 0          | 4,928 922 x 10⁻⁷ m³/s   | OK     |
| K12  | ounce (US fluid) per second      | 2.957353e-05   | 0          | 2,957 353 x 10⁻⁵ m³/s   | OK     |
| K22  | cubic foot per day               | 3.277413e-07   | 0          | 3,277 413 x 10⁻⁷ m³/s   | OK     |
| K26  | gallon (UK) per day              | 5.261678e-08   | 0          | 5,261 678 x 10⁻⁸ m³/s   | OK     |
| K27  | gallon (UK) per hour             | 1.262803e-06   | 0          | 1,262 803 x 10⁻⁶ m³/s   | OK     |
| K28  | gallon (UK) per second           | 0.00454609     | 0          | 4,546 09 x 10⁻³ m³/s    | OK     |
| K30  | gallon (US liquid) per second    | 0.003785412    | 0          | 3,785 412 x 10⁻³ m³/s   | OK     |
| K32  | gill (UK) per day                | 1.644274e-05   | 0          | 1,644 274 x 10⁻⁵ m³/s   | OK     |
| K33  | gill (UK) per hour               | 3.946258e-08   | 0          | 3,946 258 x 10⁻⁸ m³/s   | OK     |
| K34  | gill (UK) per minute             | 0.02367755     | 0          | 0,023 677 55 m³/s       | OK     |
| K35  | gill (UK) per second             | 0.0001420653   | 0          | 1,420 653 x 10⁻⁴ m³/s   | OK     |
| K36  | gill (US) per day                | 1.369145e-09   | 0          | 1,369 145 x 10⁻⁹ m³/s   | OK     |
| K37  | gill (US) per hour               | 3.285947e-08   | 0          | 3,285 947 x 10⁻⁸ m³/s   | OK     |
| K38  | gill (US) per minute             | 1.971568e-06   | 0          | 1,971 568 x 10⁻⁶ m³/s   | OK     |
| K39  | gill (US) per second             | 0.0001182941   | 0          | 1,182 941 x 10⁻⁴ m³/s   | OK     |
| K94  | quart (UK liquid) per day        | 1.31542e-08    | 0          | 1,315 420 x 10⁻⁸ m³/s   | OK     |
| K95  | quart (UK liquid) per hour       | 3.157008e-07   | 0          | 3,157 008 x 10⁻⁷ m³/s   | OK     |
| K96  | quart (UK liquid) per minute     | 1.894205e-05   | 0          | 1,894 205 x 10⁻⁵ m³/s   | OK     |
| K97  | quart (UK liquid) per second     | 0.001136523    | 0          | 1,136 523 x 10⁻³ m³/s   | OK     |
| K98  | quart (US liquid) per day        | 1.095316e-08   | 0          | 1,095 316 x 10⁻⁸ m³/s   | OK     |
| K99  | quart (US liquid) per hour       | 2.628758e-07   | 0          | 2,628 758 x 10⁻⁷ m³/s   | OK     |
| L10  | quart (US liquid) per minute     | 1.577255e-05   | 0          | 1,577 255 x 10⁻⁵ m³/s   | OK     |
| L11  | quart (US liquid) per second     | 0.0009463529   | 0          | 9,463 529 x 10⁻⁴ m³/s   | OK     |
| L2   | litre per minute                 | 1.66667e-05    | 0          | 1,666 67 x 10⁻⁵ m³/s    | OK     |
| L44  | peck (UK) per day                | 1.052336e-07   | 0          | 1,052 336 x 10⁻⁷ m³/s   | OK     |
| L45  | peck (UK) per hour               | 2.525606e-06   | 0          | 2,525 606 x 10⁻⁶ m³/s   | OK     |
| L46  | peck (UK) per minute             | 0.00015153635  | 0          | 1,515 363 5 x 10⁻⁴ m³/s | OK     |
| L47  | peck (UK) per second             | 0.009092181    | 0          | 9,092 181 x 10⁻³ m³/s   | OK     |
| L48  | peck (US dry) per day            | 1.019649e-07   | 0          | 1,019 649 x 10⁻⁷ m³/s   | OK     |
| L49  | peck (US dry) per hour           | 2.447158e-06   | 0          | 2,447 158 x 10⁻⁶ m³/s   | OK     |
| L50  | peck (US dry) per minute         | 0.0001468295   | 0          | 1,468 295 x 10⁻⁴ m³/s   | OK     |
| L51  | peck (US dry) per second         | 0.008809768    | 0          | 8,809 768 x 10⁻³ m³/s   | OK     |
| L53  | pint (UK) per day                | 6.577098e-09   | 0          | 6,577 098 x 10⁻⁹ m³/s   | OK     |
| L54  | pint (UK) per hour               | 1.578504e-07   | 0          | 1,578 504 x 10⁻⁷ m³/s   | OK     |
| L55  | pint (UK) per minute             | 9.471022e-06   | 0          | 9,471 022 x 10⁻⁶ m³/s   | OK     |
| L56  | pint (UK) per second             | 0.0005682613   | 0          | 5,682 613 x 10⁻⁴ m³/s   | OK     |
| L57  | pint (US liquid) per day         | 5.47658e-09    | 0          | 5,476 580 x 10⁻⁹ m³/s   | OK     |
| L58  | pint (US liquid) per hour        | 1.314379e-07   | 0          | 1,314 379 x 10⁻⁷ m³/s   | OK     |
| L59  | pint (US liquid) per minute      | 7.886275e-06   | 0          | 7,886 275 x 10⁻⁶ m³/s   | OK     |
| L60  | pint (US liquid) per second      | 0.0004731765   | 0          | 4,731 765 x 10⁻⁴ m³/s   | OK     |
| LD   | litre per day                    | 1.15741e-08    | 0          | 1,157 41 x 10⁻⁸ m³/s    | OK     |
| M12  | cubic yard per day               | 8.849015e-06   | 0          | 8,849 015 x 10⁻⁶ m³/s   | OK     |
| M13  | cubic yard per hour              | 0.0002123764   | 0          | 2,123 764 x 10⁻⁴ m³/s   | OK     |
| M15  | cubic yard per minute            | 0.01274258     | 0          | 1,274 258 x 10⁻² m³/s   | OK     |
| M16  | cubic yard per second            | 0.7645549      | 0          | 0,764 554 9 m³/s        | OK     |
| MQH  | cubic metre per hour             | 0.000277778    | 0          | 2,777 78 x 10⁻⁴ m³/s    | OK     |
| MQS  | cubic metre per second           | 1              | 0          | m³/s                    | OK     |
| Q37  | Standard cubic metre per day     | 1.15741e-05    | 0          | 1.15741 × 10-5 m3/s     | OK     |
| Q38  | Standard cubic metre per hour    | 0.000277778    | 0          | 2.77778 × 10-4 m3/s     | OK     |
| Q39  | Normalized cubic metre per day   | 1.15741e-05    | 0          | 1.15741 × 10-5 m3/s     | OK     |
| Q40  | Normalized cubic metre per hour  | 0.000277778    | 0          | 2.77778 × 10-4 m3/s     | OK     |

### Force (15)

| Code | Name                              | GS1 Multiplier | GS1 Offset | Rec 20 Conv Factor | Status |
|------|-----------------------------------|----------------|------------|--------------------|--------|
| B37  | kilogram-force                    | 9.80665        | 0          | 9,806 65 N         | OK     |
| B47  | kilonewton                        | 1000           | 0          | 10³ N              | OK     |
| B51  | kilopond                          | 9.80665        | 0          | 9,806 65 N         | OK     |
| B73  | meganewton                        | 1000000        | 0          | 10⁶ N              | OK     |
| B92  | micronewton                       | 1e-06          | 0          | 10⁻⁶ N             | OK     |
| C20  | millinewton                       | 0.001          | 0          | 10⁻³ N             | OK     |
| C78  | pound-force                       | 4.448222       | 0          | 4,448 222 N        | OK     |
| DU   | dyne                              | 1e-05          | 0          | 10⁻⁵ N             | OK     |
| L40  | ounce (avoirdupois)-force         | 0.2780139      | 0          | 0,278 013 9 N      | OK     |
| L94  | ton-force (US short)              | 8896.443       | 0          | 8,896 443 x 10³ N  | OK     |
| M75  | kilopound-force                   | 4448.222       | 0          | 4,448 222 x 10³ N  | OK     |
| M76  | poundal                           | 0.138255       | 0          | 1,382 550 x 10⁻¹ N | OK     |
| M77  | kilogram metre per second squared | 1              | 0          | (kg x m)/s²        | OK     |
| M78  | pond                              | 0.00980665     | 0          | 9,806 65 x 10⁻³ N  | OK     |
| NEW  | newton                            | 1              | 0          | (kg x m)/s²        | OK     |

### Frequency (7)

| Code | Name              | GS1 Multiplier       | GS1 Offset | Rec 20 Conv Factor | Status |
|------|-------------------|----------------------|------------|--------------------|--------|
| A86  | gigahertz         | 1000000000           | 0          | 10⁹ Hz             | OK     |
| C94  | reciprocal minute | 0.016666666666666666 | 0          | 1,666 667 x 10⁻² s | OK     |
| C97  | reciprocal second | 1                    | 0          | s⁻¹                | OK     |
| D29  | terahertz         | 1000000000000        | 0          | 10¹² Hz            | OK     |
| HTZ  | hertz             | 1                    | 0          | Hz                 | OK     |
| KHZ  | kilohertz         | 1000                 | 0          | 10³ Hz             | OK     |
| MHZ  | megahertz         | 1000000              | 0          | 10⁶ Hz             | OK     |

### Illuminance (6)

| Code | Name                   | GS1 Multiplier | GS1 Offset | Rec 20 Conv Factor           | Status |
|------|------------------------|----------------|------------|------------------------------|--------|
| B60  | lumen per square metre | 1              | 0          | cd x sr/m²                   | OK     |
| KLX  | kilolux                | 1000           | 0          | 10³ cd x sr / m²             | OK     |
| LUX  | lux                    | 1              | 0          | cd x sr / m²                 | OK     |
| P25  | lumen per square foot  | 10.76391       | 0          | 1,076 391 x 10¹ cd x sr / m² | OK     |
| P26  | phot                   | 10000          | 0          | 10⁴ cd x sr / m²             | OK     |
| P27  | footcandle             | 10.76391       | 0          | 1,076 391 x 10¹ cd x sr / m² | OK     |

### Impulse (6)

| Code | Name                           | GS1 Multiplier | GS1 Offset | Rec 20 Conv Factor        | Status |
|------|--------------------------------|----------------|------------|---------------------------|--------|
| B31  | kilogram metre per second      | 1              | 0          | kg x m/s                  | OK     |
| C57  | newton second                  | 1              | 0          | N x s                     | OK     |
| M98  | kilogram centimetre per second | 0.01           | 0          | 10⁻² kg x m/s             | OK     |
| M99  | gram centimetre per second     | 1e-05          | 0          | 10⁻⁵ kg x m/s             | OK     |
| N10  | pound foot per second          | 0.138255       | 0          | 1,382 550 x 10⁻¹ kg x m/s | OK     |
| N11  | pound inch per second          | 0.01152125     | 0          | 1,152 125 x 10⁻² kg x m/s | OK     |

### Inductance (6)

| Code | Name       | GS1 Multiplier | GS1 Offset | Rec 20 Conv Factor | Status |
|------|------------|----------------|------------|--------------------|--------|
| 81   | henry      | 1              | 0          | H                  | OK     |
| B90  | microhenry | 1e-06          | 0          | 10⁻⁶ H             | OK     |
| C14  | millihenry | 0.001          | 0          | 10⁻³ H             | OK     |
| C43  | nanohenry  | 1e-09          | 0          | 10⁻⁹ H             | OK     |
| C73  | picohenry  | 1e-12          | 0          | 10⁻¹² H            | OK     |
| P24  | kilohenry  | 1000           | 0          | 10³ H              | OK     |

### Irradiance (14)

| Code | Name                                                              | GS1 Multiplier | GS1 Offset | Rec 20 Conv Factor   | Status |
|------|-------------------------------------------------------------------|----------------|------------|----------------------|--------|
| C32  | milliwatt per square metre                                        | 0.001          | 0          | 10⁻³ W/m²            | OK     |
| C76  | picowatt per square metre                                         | 1e-12          | 0          | 10⁻¹² W/m²           | OK     |
| D54  | watt per square metre                                             | 1              | 0          | W/m²                 | OK     |
| D85  | microwatt per square metre                                        | 1e-06          | 0          | 10⁻⁶ W/m²            | OK     |
| N48  | watt per square centimetre                                        | 10000          | 0          | 10⁴ W/m²             | OK     |
| N49  | watt per square inch                                              | 1550.003       | 0          | 1,550 003 x 10³ W/m² | OK     |
| N50  | British thermal unit (international table) per square foot hour   | 3.154591       | 0          | 3,154 591 W/m²       | OK     |
| N51  | British thermal unit (thermochemical) per square foot hour        | 3.152481       | 0          | 3,152 481 W/m²       | OK     |
| N52  | British thermal unit (thermochemical) per square foot minute      | 189.1489       | 0          | 1,891 489 x 10² W/m² | OK     |
| N53  | British thermal unit (international table) per square foot second | 11356.53       | 0          | 1,135 653 x 10⁴ W/m² | OK     |
| N54  | British thermal unit (thermochemical) per square foot second      | 11348.93       | 0          | 1,134 893 x 10⁴ W/m² | OK     |
| N55  | British thermal unit (international table) per square inch second | 1634246        | 0          | 1,634 246 x 10⁶ W/m² | OK     |
| N56  | calorie (thermochemical) per square centimetre minute             | 697.3333       | 0          | 6,973 333 x 10² W/m² | OK     |
| N57  | calorie (thermochemical) per square centimetre second             | 41840          | 0          | 4,184 x 10⁴ W/m²     | OK     |

### Kinematic Viscosity (7)

| Code | Name                          | GS1 Multiplier | GS1 Offset | Rec 20 Conv Factor   | Status |
|------|-------------------------------|----------------|------------|----------------------|--------|
| 4C   | centistokes                   | 1e-06          | 0          | 10⁻⁶ m²/s            | OK     |
| 91   | stokes                        | 0.0001         | 0          | 10⁻⁴ m²/s            | OK     |
| C17  | millimetre squared per second | 1e-06          | 0          | 10⁻⁶ m²/s            | OK     |
| M79  | square foot per hour          | 2.58064e-05    | 0          | 2,580 64 x 10⁻⁵ m²/s | OK     |
| M81  | square centimetre per second  | 0.0001         | 0          | 10⁻⁴ m²/s            | OK     |
| S3   | square foot per second        | 0.09290304     | 0          | 0,092 903 04 m²/s    | OK     |
| S4   | square metre per second       | 1              | 0          | m²/s                 | OK     |

### Length (23)

| Code | Name                            | GS1 Multiplier     | GS1 Offset | Rec 20 Conv Factor    | Status |
|------|---------------------------------|--------------------|------------|-----------------------|--------|
| 4H   | micrometre                      | 1e-06              | 0          | 10⁻⁶ m                | OK     |
| A11  | angstrom                        | 1e-10              | 0          | 10⁻¹⁰ m               | OK     |
| A12  | astronomical unit               | 149597870000       | 0          | 1,495 978 70 × 10¹¹ m | OK     |
| A45  | decametre                       | 10                 | 0          | 10 m                  | OK     |
| A71  | femtometre                      | 1e-15              | 0          | 10⁻¹⁵ m               | OK     |
| AK   | fathom                          | 1.8288             | 0          | 1,828 8 m             | OK     |
| B57  | light year                      | 9460730000000000.0 | 0          | 9,460 73 x 10¹⁵ m     | OK     |
| C45  | nanometre                       | 1e-09              | 0          | 10⁻⁹ m                | OK     |
| CMT  | centimetre                      | 0.01               | 0          | 10⁻² m                | OK     |
| DMT  | decimetre                       | 0.1                | 0          | 10⁻¹ m                | OK     |
| FOT  | foot                            | 0.3048             | 0          | 0,304 8 m             | OK     |
| HMT  | hectometre                      | 100                | 0          | 10² m                 | OK     |
| INH  | inch                            | 0.0254             | 0          | 25,4 x 10⁻³ m         | OK     |
| KMT  | kilometre                       | 1000               | 0          | 10³ m                 | OK     |
| M49  | chain (based on US survey foot) | 20.11684           | 0          | 2,011684 x 10 m       | OK     |
| M50  | furlong                         | 201.168            | 0          | 2,011 68 x 10² m      | OK     |
| M51  | foot (US survey)                | 0.3048006          | 0          | 3,048 006 x 10⁻¹ m    | OK     |
| MMT  | millimetre                      | 0.001              | 0          | 10⁻³ m                | OK     |
| MTR  | metre                           | 1                  | 0          | m                     | OK     |
| NMI  | nautical mile                   | 1852               | 0          | 1 852 m               | OK     |
| SMI  | mile (statute mile)             | 1609.344           | 0          | 1 609,344 m           | OK     |
| X1   | Gunter's chain                  | 20.1168            | 0          | 20,116 8 m            | OK     |
| YRD  | yard                            | 0.9144             | 0          | 0,914 4 m             | OK     |

### Luminous Intensity (3)

| Code | Name         | GS1 Multiplier | GS1 Offset | Rec 20 Conv Factor | Status |
|------|--------------|----------------|------------|--------------------|--------|
| CDL  | candela      | 1              | 0          | cd                 | OK     |
| P33  | kilocandela  | 1000           | 0          | 10³ cd             | OK     |
| P34  | millicandela | 0.001          | 0          | 10⁻³ cd            | OK     |

### Magnetic Flux (3)

| Code | Name       | GS1 Multiplier | GS1 Offset | Rec 20 Conv Factor | Status |
|------|------------|----------------|------------|--------------------|--------|
| C33  | milliweber | 0.001          | 0          | 10⁻³ Wb            | OK     |
| P11  | kiloweber  | 1000           | 0          | 10³ Wb             | OK     |
| WEB  | weber      | 1              | 0          | Wb                 | OK     |

### Magnetic Flux Density (6)

| Code | Name       | GS1 Multiplier | GS1 Offset | Rec 20 Conv Factor | Status |
|------|------------|----------------|------------|--------------------|--------|
| C29  | millitesla | 0.001          | 0          | 10⁻³ T             | OK     |
| C48  | nanotesla  | 1e-09          | 0          | 10⁻⁹ T             | OK     |
| D33  | tesla      | 1              | 0          | T                  | OK     |
| D81  | microtesla | 1e-06          | 0          | 10⁻⁶ T             | OK     |
| P12  | gamma      | 1e-09          | 0          | 10⁻⁹ T             | OK     |
| P13  | kilotesla  | 1000           | 0          | 10³ T              | OK     |

### Magnetic Vector Potential (3)

| Code | Name                 | GS1 Multiplier | GS1 Offset | Rec 20 Conv Factor | Status |
|------|----------------------|----------------|------------|--------------------|--------|
| B56  | kiloweber per metre  | 1000           | 0          | 10³ Wb/m           | OK     |
| D59  | weber per metre      | 1              | 0          | Wb/m               | OK     |
| D60  | weber per millimetre | 1000           | 0          | 10³ Wb/m           | OK     |

### Mass (23)

| Code | Name                                      | GS1 Multiplier | GS1 Offset | Rec 20 Conv Factor  | Status |
|------|-------------------------------------------|----------------|------------|---------------------|--------|
| 2U   | megagram                                  | 1000           | 0          | 10³ kg              | OK     |
| APZ  | troy ounce or apothecary ounce            | 0.003110348    | 0          | 3,110 348 x 10⁻³ kg | OK     |
| CGM  | centigram                                 | 1e-05          | 0          | 10⁻⁵ kg             | OK     |
| CWA  | hundred pound (cwt) / hundred weight (US) | 45.3592        | 0          | 45,359 2 kg         | OK     |
| CWI  | hundred weight (UK)                       | 50.8023        | 0          | 50,802 35 kg        | OK     |
| DG   | decigram                                  | 0.0001         | 0          | 10⁻⁴ kg             | OK     |
| DJ   | decagram                                  | 0.01           | 0          | 10⁻² kg             | OK     |
| DTN  | decitonne                                 | 100            | 0          | 10² kg              | OK     |
| F13  | slug                                      | 14.5939        | 0          | 1,459 390 x 10¹ kg  | OK     |
| GRM  | gram                                      | 0.001          | 0          | 10⁻³ kg             | OK     |
| GRN  | grain                                     | 6.479891e-05   | 0          | 64,798 91 x 10⁻⁶ kg | OK     |
| HGM  | hectogram                                 | 0.1            | 0          | 10⁻¹ kg             | OK     |
| KGM  | kilogram                                  | 1              | 0          | kg                  | OK     |
| KTN  | kilotonne                                 | 1000000        | 0          | 10⁶ kg              | OK     |
| LBR  | pound                                     | 0.45359237     | 0          | 0,453 592 37 kg     | OK     |
| LTN  | ton (UK) or long ton (US)                 | 1016.047       | 0          | 1,016 047 x 10³ kg  | OK     |
| M86  | pfund                                     | 0.5            | 0          | 0,5 kg              | OK     |
| MC   | microgram                                 | 1e-09          | 0          | 10⁻⁹ kg             | OK     |
| MGM  | milligram                                 | 1e-06          | 0          | 10⁻⁶ kg             | OK     |
| ONZ  | ounce                                     | 0.02834952     | 0          | 2,834 952 x 10⁻² kg | OK     |
| STI  | stone (UK)                                | 6.350293       | 0          | 6,350 293 kg        | OK     |
| STN  | ton (US) or short ton (UK/US)             | 907.1847       | 0          | 0,907184 7 x 10³ kg | OK     |
| TNE  | tonne (metric ton)                        | 1000           | 0          | 10³ kg              | OK     |

### Molar Concentration (5)

| Code | Name                     | GS1 Multiplier | GS1 Offset | Rec 20 Conv Factor | Status |
|------|--------------------------|----------------|------------|--------------------|--------|
| B46  | kilomole per cubic metre | 1000           | 0          | 10³ mol/m³         | OK     |
| C35  | mole per cubic decimetre | 1000           | 0          | 10³ mol/m³         | OK     |
| C36  | mole per cubic metre     | 1              | 0          | mol/m³             | OK     |
| C38  | mole per litre           | 1000           | 0          | 10³ mol/m³         | OK     |
| M33  | millimole per litre      | 1              | 0          | mol/m³             | OK     |

### Molar Mass (2)

| Code | Name              | GS1 Multiplier | GS1 Offset | Rec 20 Conv Factor | Status |
|------|-------------------|----------------|------------|--------------------|--------|
| A94  | gram per mole     | 0.001          | 0          | 10⁻³ kg/mol        | OK     |
| D74  | kilogram per mole | 1              | 0          | kg/mol             | OK     |

### Molar Thermodynamic Energy (2)

| Code | Name               | GS1 Multiplier | GS1 Offset | Rec 20 Conv Factor | Status |
|------|--------------------|----------------|------------|--------------------|--------|
| B15  | joule per mole     | 1              | 0          | J/mol              | OK     |
| B44  | kilojoule per mole | 1000           | 0          | 10³ J/mol          | OK     |

### Molar Volume (4)

| Code | Name                      | GS1 Multiplier | GS1 Offset | Rec 20 Conv Factor | Status |
|------|---------------------------|----------------|------------|--------------------|--------|
| A36  | cubic centimetre per mole | 1e-06          | 0          | 10⁻⁶ m³/mol        | OK     |
| A37  | cubic decimetre per mole  | 0.001          | 0          | 10⁻³ m³/mol        | OK     |
| A40  | cubic metre per mole      | 1              | 0          | m³/mol             | OK     |
| B58  | litre per mole            | 0.001          | 0          | 10⁻³ m³/mol        | OK     |

### Power (41)

| Code | Name                                                  | GS1 Multiplier   | GS1 Offset | Rec 20 Conv Factor | Status |
|------|-------------------------------------------------------|------------------|------------|--------------------|--------|
| 2I   | British thermal unit (international table) per hour   | 0.2930711        | 0          | 2,930 711x 10⁻¹ W  | OK     |
| A25  | cheval vapeur                                         | 735.4988         | 0          | 7,354 988 x 10² W  | OK     |
| A63  | erg per second                                        | 1e-07            | 0          | 10⁻⁷ W             | OK     |
| A74  | foot pound-force per second                           | 1.355818         | 0          | 1,355 818 W        | OK     |
| A90  | gigawatt                                              | 1000000000       | 0          | 10⁹ W              | OK     |
| B39  | kilogram-force metre per second                       | 9.80665          | 0          | 9,806 65 W         | OK     |
| BHP  | brake horse power                                     | 745.7            | 0          | 7,457 x 10² W      | OK     |
| C31  | milliwatt                                             | 0.001            | 0          | 10⁻³ W             | OK     |
| C49  | nanowatt                                              | 1e-09            | 0          | 10⁻⁹ W             | OK     |
| C75  | picowatt                                              | 1e-12            | 0          | 10⁻¹² W            | OK     |
| D31  | terawatt                                              | 1000000000000    | 0          | 10¹² W             | OK     |
| D46  | volt ampere                                           | 1                | 0          | W                  | OK     |
| D80  | microwatt                                             | 1e-06            | 0          | 10⁻⁶ W             | OK     |
| E15  | kilocalorie (thermochemical) per hour                 | 1.16222          | 0          | 1,162 22 W         | OK     |
| F80  | water horse power                                     | 746.043          | 0          | 7,460 43 x 10² W   | OK     |
| HJ   | metric horse power                                    | 735.49875        | 0          | 735,498 75 W       | OK     |
| J44  | British thermal unit (international table) per minute | 17.584266        | 0          | 17,584 266 W       | OK     |
| J45  | British thermal unit (international table) per second | 1055.056         | 0          | 1,055 056 x 10³ W  | OK     |
| J47  | British thermal unit (thermochemical) per hour        | 0.2928751        | 0          | 0,292 875 1 W      | OK     |
| J51  | British thermal unit (thermochemical) per minute      | 17.5725          | 0          | 17,572 50 W        | OK     |
| J52  | British thermal unit (thermochemical) per second      | 1054.35          | 0          | 1,054 350 x 10³ W  | OK     |
| J81  | calorie (thermochemical) per minute                   | 0.06973333       | 0          | 6,973 333 x 10⁻² W | OK     |
| J82  | calorie (thermochemical) per second                   | 4.184            | 0          | 4,184 W            | OK     |
| K15  | foot pound-force per hour                             | 0.0003766161     | 0          | 3,766 161 x 10⁻⁴ W | OK     |
| K16  | foot pound-force per minute                           | 0.02259697       | 0          | 2,259 697 x 10⁻² W | OK     |
| K42  | horsepower (boiler)                                   | 9809.5           | 0          | 9,809 50 x 10³ W   | OK     |
| K43  | horsepower (electric)                                 | 746              | 0          | 746 W              | OK     |
| K54  | kilocalorie (thermochemical) per minute               | 69.73333         | 0          | 69,733 33 W        | OK     |
| K55  | kilocalorie (thermochemical) per second               | 4184             | 0          | 4,184 x 10³ W      | OK     |
| KWT  | kilowatt                                              | 1000             | 0          | 10³ W              | OK     |
| MAW  | megawatt                                              | 1000000          | 0          | 10⁶ W              | OK     |
| N12  | Pferdestaerke                                         | 735.4988         | 0          | 7,354 988 x 10² W  | OK     |
| P14  | joule per second                                      | 1                | 0          | W                  | OK     |
| P15  | joule per minute                                      | 0.016666666666   | 0          | 1,666 67 × 10⁻² W  | OK     |
| P16  | joule per hour                                        | 0.00027777777777 | 0          | 2,777 78 × 10⁻⁴ W  | OK     |
| P17  | joule per day                                         | 1.157407407e-05  | 0          | 1,157 41 × 10⁻⁵ W  | OK     |
| P18  | kilojoule per second                                  | 1000             | 0          | 10³ W              | OK     |
| P19  | kilojoule per minute                                  | 16.6666666667    | 0          | 1,666 67 × 10 W    | OK     |
| P20  | kilojoule per hour                                    | 0.2777777778     | 0          | 2,777 78 x 10⁻¹ W  | OK     |
| P21  | kilojoule per day                                     | 0.01157407407    | 0          | 1,157 41 x 10⁻² W  | OK     |
| WTT  | watt                                                  | 1                | 0          | W                  | OK     |

### Pressure (39)

| Code | Name                                 | GS1 Multiplier | GS1 Offset | Rec 20 Conv Factor            | Status |
|------|--------------------------------------|----------------|------------|-------------------------------|--------|
| 74   | millipascal                          | 0.001          | 0          | 10⁻³ Pa                       | OK     |
| 84   | kilopounds force per square inch     | 6894757        | 0          | 6,894 757 x 10⁶ Pa            | OK     |
| A89  | gigapascal                           | 1000000000     | 0          | 10⁹ Pa                        | OK     |
| A97  | hectopascal                          | 100            | 0          | 10² Pa                        | OK     |
| ATM  | standard atmosphere                  | 101325         | 0          | 1 013 25 Pa                   | OK     |
| ATT  | technical atmosphere                 | 98066.5        | 0          | 98 066,5 Pa                   | OK     |
| B40  | kilogram-force per square metre      | 9.80665        | 0          | 9,806 65 Pa                   | OK     |
| B96  | micropascal                          | 1e-06          | 0          | 10⁻⁶ Pa                       | OK     |
| BAR  | bar                                  | 100000         | 0          | 10⁵ Pa                        | OK     |
| C55  | newton per square metre              | 1              | 0          | Pa                            | OK     |
| C56  | newton per square millimetre         | 1000000        | 0          | 10⁶ Pa                        | OK     |
| E42  | kilogram-force per square centimetre | 98066.5        | 0          | 9,806 65 x 10⁴ Pa             | OK     |
| F78  | inch of water                        | 249.089        | 0          | 2,490 89 × 10² kg x m⁻¹ x s⁻² | FIXED  |
| F79  | inch of mercury                      | 3386.389       | 0          | 3,386 39 × 10³ kg x m⁻¹ x s⁻² | FIXED  |
| H75  | decapascal                           | 10             | 0          | 10¹ Pa                        | OK     |
| H78  | conventional centimetre of water     | 98.0665        | 0          | 9,806 65 × 10¹ Pa             | OK     |
| HN   | millimetres of mercury               | 133.3224       | 0          | 133,322 4 Pa                  | FIXED  |
| HP   | conventional millimetre of water     | 9.80665        | 0          | 9,806 65 Pa                   | OK     |
| J89  | centimetres of mercury               | 1333.224       | 0          | 1,333 224 x 10³ Pa            | OK     |
| K24  | foot of water                        | 2989.067       | 0          | 2,989 067 x 10³  Pa           | OK     |
| K25  | foot of mercury                      | 40636.66       | 0          | 4,063 666 x 10⁴ Pa            | OK     |
| K31  | gram-force per square centimetre     | 98.0665        | 0          | 98,066 5 Pa                   | OK     |
| K85  | pound-force per square foot          | 47.88026       | 0          | 47,880 26 Pa                  | OK     |
| KPA  | kilopascal                           | 1000           | 0          | 10³ Pa                        | OK     |
| MBR  | millibar                             | 100            | 0          | 10² Pa                        | OK     |
| MPA  | megapascal                           | 1000000        | 0          | 10⁶ Pa                        | OK     |
| N13  | centimetre of mercury (0 ºC)         | 1333.22        | 0          | 1,333 22 x 10³ Pa             | OK     |
| N14  | centimetre of water (4 ºC)           | 98.0638        | 0          | 9,806 38 x 10 Pa              | OK     |
| N15  | foot of water (39.2 ºF)              | 2988.98        | 0          | 2,988 98 x 10³  Pa            | OK     |
| N16  | inch of mercury (32 ºF)              | 3386.38        | 0          | 3,386 38 x 10³  Pa            | OK     |
| N17  | inch of mercury (60 ºF)              | 3376.85        | 0          | 3,376 85 x 10³  Pa            | OK     |
| N18  | inch of water (39.2 ºF)              | 249.082        | 0          | 2,490 82 × 10² Pa             | OK     |
| N19  | inch of water (60 ºF)                | 248.84         | 0          | 2,488 4 × 10² Pa              | OK     |
| N20  | kip per square inch                  | 6894757        | 0          | 6,894 757 x 10⁶ Pa            | OK     |
| N21  | poundal per square foot              | 1.488164       | 0          | 1,488 164 Pa                  | OK     |
| N23  | conventional metre of water          | 9806.65        | 0          | 9,806 65 x 10³ Pa             | OK     |
| PAL  | pascal                               | 1              | 0          | Pa                            | OK     |
| PS   | pound force per square inch          | 6894.757       | 0          | 6,894 757 x 10³ Pa            | OK     |
| UA   | torr                                 | 133.3224       | 0          | 133,322 4 Pa                  | OK     |

### Radioactivity (8)

| Code | Name           | GS1 Multiplier | GS1 Offset | Rec 20 Conv Factor | Status |
|------|----------------|----------------|------------|--------------------|--------|
| 2Q   | kilobecquerel  | 1000           | 0          | 10³ Bq             | OK     |
| 2R   | kilocurie      | 37000000000000 | 0          | 3,7 x 10¹³ Bq      | OK     |
| 4N   | megabecquerel  | 1000000        | 0          | 10⁶ Bq             | OK     |
| CUR  | curie          | 37000000000    | 0          | 3,7 x 10¹⁰ Bq      | OK     |
| GBQ  | gigabecquerel  | 1000000000     | 0          | 10⁹ Bq             | OK     |
| H08  | microbecquerel | 1e-06          | 0          | 10⁻⁶ Bq            | OK     |
| M5   | microcurie     | 37000          | 0          | 3,7 x 10⁴ Bq       | OK     |
| MCU  | millicurie     | 37000000       | 0          | 3,7 x 10⁷ Bq       | OK     |

### Resistance (8)

| Code | Name     | GS1 Multiplier | GS1 Offset | Rec 20 Conv Factor | Status |
|------|----------|----------------|------------|--------------------|--------|
| A87  | gigaohm  | 1000000000     | 0          | 10⁹ Ω              | OK     |
| B49  | kiloohm  | 1000           | 0          | 10³ Ω              | OK     |
| B75  | megaohm  | 1000000        | 0          | 10⁶ Ω              | OK     |
| B94  | microohm | 1e-06          | 0          | 10⁻⁶ Ω             | OK     |
| E45  | milliohm | 0.001          | 0          | 10⁻³ Ω             | OK     |
| H44  | teraohm  | 1000000000000  | 0          | 10¹² Ω             | OK     |
| OHM  | ohm      | 1              | 0          | Ω                  | OK     |
| P22  | nanoohm  | 1e-09          | 0          | 10⁻⁹ Ω             | OK     |

### Specific Volume (7)

| Code | Name                         | GS1 Multiplier | GS1 Offset | Rec 20 Conv Factor     | Status |
|------|------------------------------|----------------|------------|------------------------|--------|
| 22   | decilitre per gram           | 0.1            | 0          | 10⁻¹ x m³/kg           | OK     |
| A39  | cubic metre per kilogram     | 1              | 0          | m³/kg                  | OK     |
| H83  | litre per kilogram           | 0.001          | 0          | 10⁻³ m³ x kg⁻¹         | OK     |
| KX   | millilitre per kilogram      | 1e-06          | 0          | 10⁻⁶ m³/kg             | OK     |
| N28  | cubic decimetre per kilogram | 0.001          | 0          | 10⁻³ m³ x kg⁻¹         | OK     |
| N29  | cubic foot per pound         | 0.06242796     | 0          | 6,242 796 x 10⁻² m³/kg | OK     |
| N30  | cubic inch per pound         | 3.612728e-05   | 0          | 3,612 728 x 10⁻⁵ m³/kg | OK     |

### Speed (22)

| Code | Name                   | GS1 Multiplier       | GS1 Offset | Rec 20 Conv Factor           | Status |
|------|------------------------|----------------------|------------|------------------------------|--------|
| 2M   | centimetres per second | 0.01                 | 0          | 10⁻² m/s                     | OK     |
| 2X   | metre per minute       | 0.016666666666666666 | 0          | 0,016 666 m/s                | OK     |
| C16  | millimetre per second  | 0.001                | 0          | 10⁻³ m/s                     | OK     |
| FR   | foot per minute        | 0.00508              | 0          | 5,08 x 10⁻³ m/s              | OK     |
| FS   | foot per second        | 0.3048               | 0          | 0,304 8 m/s                  | OK     |
| H49  | centimetres per hour   | 2.77777778e-07       | 0          | 0,277 777 778 × 10⁻⁶ m x s⁻¹ | OK     |
| H81  | millimetre per minute  | 1.6666666666666e-05  | 0          | 1,666 666 667 × 10⁻⁵ m x s⁻¹ | OK     |
| HM   | miles per hour         | 0.44704              | 0          | 0,447 04 m/s                 | OK     |
| IU   | inch per second        | 0.0254               | 0          | 0,025 4 m/s                  | OK     |
| K14  | foot per hour          | 8.466667e-05         | 0          | 8,466 667 x 10⁻⁵m/s          | OK     |
| KMH  | kilometres per hour    | 0.277777778          | 0          | 0,277 778 m/s                | OK     |
| KNT  | knot                   | 0.514444             | 0          | 0,514 444 m/s                | OK     |
| M57  | miles per minute       | 26.8224              | 0          | 26,822 4 m/s                 | OK     |
| M58  | miles per second       | 1609.344             | 0          | 1,609 344 x 10³ m/s          | OK     |
| M60  | metre per hour         | 0.0002777777777777   | 0          | 2,777 78 x 10⁻⁴ m/s          | OK     |
| M61  | inch per year          | 8.048774e-10         | 0          | 8,048 774 x 10⁻¹⁰ m/s        | OK     |
| M62  | kilometres per second  | 1000                 | 0          | 10³ m/s                      | OK     |
| M63  | inch per minute        | 0.0004233333         | 0          | 4,233 333 x 10⁻⁴ m/s         | OK     |
| M64  | yard per second        | 0.9144               | 0          | 9,144 x 10⁻¹ m/s             | OK     |
| M65  | yard per minute        | 0.01524              | 0          | 1,524 x 10⁻² m/s             | OK     |
| M66  | yard per hour          | 0.000254             | 0          | 2,54 x 10⁻⁴ m/s              | OK     |
| MTS  | metres per second      | 1                    | 0          | m/s                          | OK     |

### Temperature (4)

| Code | Name               | GS1 Multiplier     | GS1 Offset        | Rec 20 Conv Factor | Status |
|------|--------------------|--------------------|-------------------|--------------------|--------|
| A48  | degrees Rankine    | 0.5555555555555556 | 0                 | 5/9 x K            | OK     |
| CEL  | degrees Celsius    | 1                  | 273.15            | 1 x K              | OK     |
| FAH  | degrees Fahrenheit | 0.5555555555555556 | 255.3722222222222 | 5/9 x K            | OK     |
| KEL  | kelvin             | 1                  | 0                 | K                  | OK     |

### Time (15)

| Code | Name          | GS1 Multiplier | GS1 Offset | Rec 20 Conv Factor | Status |
|------|---------------|----------------|------------|--------------------|--------|
| ANN  | year          | 31557600       | 0          | 3,155 76 x 10⁷ s   | OK     |
| B52  | kilosecond    | 1000           | 0          | 10³ s              | OK     |
| B98  | microsecond   | 1e-06          | 0          | 10⁻⁶ s             | OK     |
| C26  | millisecond   | 0.001          | 0          | 10⁻³ s             | OK     |
| C47  | nanosecond    | 1e-09          | 0          | 10⁻⁹ s             | OK     |
| DAY  | day           | 86400          | 0          | 86 400 s           | OK     |
| H70  | picosecond    | 1e-12          | 0          | 10⁻¹² s            | OK     |
| HUR  | hour          | 3600           | 0          | 3 600 s            | OK     |
| L95  | common year   | 31536000       | 0          | 3,153 6 x 10⁷ s    | OK     |
| L96  | sidereal year | 31558150       | 0          | 3,155 815 x 10⁷ s  | OK     |
| M56  | shake         | 1e-08          | 0          | 10⁻⁸ s             | OK     |
| MIN  | minute        | 60             | 0          | 60 s               | OK     |
| MON  | month         | 2629800        | 0          | 2,629 800 x 10⁶ s  | OK     |
| SEC  | second        | 1              | 0          | s                  | OK     |
| WEE  | week          | 604800         | 0          | 6,048 x 10⁵ s      | OK     |

### Torque (16)

| Code | Name                           | GS1 Multiplier | GS1 Offset | Rec 20 Conv Factor            | Status |
|------|--------------------------------|----------------|------------|-------------------------------|--------|
| B38  | kilogram-force metre           | 9.80665        | 0          | 9,806 65 N x m                | OK     |
| B48  | kilonewton metre               | 1000           | 0          | 10³ N x m                     | OK     |
| B74  | meganewton metre               | 1000000        | 0          | 10⁶ N x m                     | OK     |
| B93  | micronewton metre              | 1e-06          | 0          | 10⁻⁶ N x m                    | OK     |
| D83  | millinewton metre              | 0.001          | 0          | 10⁻³ N x m                    | OK     |
| DN   | decinewton metre               | 0.1            | 0          | 10⁻¹ N x m                    | OK     |
| F21  | pound-force inch               | 0.112985       | 0          | 1,129 85 × 10⁻¹ kg x m² x s⁻² | OK     |
| F88  | newton centimetre              | 0.01           | 0          | 10⁻² kg x m² x s⁻²            | OK     |
| J72  | centinewton metre              | 0.01           | 0          | 10⁻² N x m                    | OK     |
| J94  | dyne centimetre                | 1e-07          | 0          | 10⁻⁷ N x m                    | OK     |
| L41  | ounce (avoirdupois)-force inch | 0.007061552    | 0          | 7,061 552 x 10⁻³ N x m        | OK     |
| M92  | pound-force foot               | 1.355818       | 0          | 1,355 818 N x m               | OK     |
| M95  | poundal foot                   | 0.04214011     | 0          | 4,214 011 x 10⁻² N x m        | OK     |
| M96  | poundal inch                   | 0.003511677    | 0          | 3,511 677 10⁻³ N x m          | OK     |
| M97  | dyne metre                     | 1e-05          | 0          | 10⁻⁵ N x m                    | OK     |
| NU   | newton metre                   | 1              | 0          | N x m                         | OK     |

### Voltage (6)

| Code | Name      | GS1 Multiplier | GS1 Offset | Rec 20 Conv Factor | Status |
|------|-----------|----------------|------------|--------------------|--------|
| 2Z   | millivolt | 0.001          | 0          | 10⁻³ V             | OK     |
| B78  | megavolt  | 1000000        | 0          | 10⁶ V              | OK     |
| D82  | microvolt | 1e-06          | 0          | 10⁻⁶ V             | OK     |
| KVT  | kilovolt  | 1000           | 0          | 10³ V              | OK     |
| N99  | picovolt  | 1e-12          | 0          | 10⁻¹² V            | OK     |
| VLT  | volt      | 1              | 0          | V                  | OK     |

### Volume (54)

| Code | Name                                  | GS1 Multiplier | GS1 Offset | Rec 20 Conv Factor    | Status |
|------|---------------------------------------|----------------|------------|-----------------------|--------|
| 4G   | microlitre                            | 1e-09          | 0          | 10⁻⁹ m³               | OK     |
| 5I   | standard cubic foot                   | 4.672          | 0          | 4,672 m³              | OK     |
| A44  | decalitre                             | 0.01           | 0          | 10⁻² m³               | OK     |
| BLD  | dry barrel (US)                       | 0.115627       | 0          | 1,156 27 x 10⁻¹ m³    | OK     |
| BLL  | barrel (US)                           | 0.1589873      | 0          | 158,987 3 x 10⁻³ m³   | OK     |
| BUA  | bushel (US)                           | 0.03523907     | 0          | 3,523 907 x 10⁻² m³   | OK     |
| BUI  | bushel (UK)                           | 0.03636872     | 0          | 3,636 872 x 10⁻² m³   | OK     |
| CLT  | centilitre                            | 1e-05          | 0          | 10⁻⁵ m³               | OK     |
| CMQ  | cubic centimetre                      | 1e-06          | 0          | 10⁻⁶ m³               | OK     |
| DLT  | decilitre                             | 0.0001         | 0          | 10⁻⁴ m³               | OK     |
| DMA  | cubic decametre                       | 1000           | 0          | 10³ m³                | OK     |
| DMQ  | cubic decimetre                       | 0.001          | 0          | 10⁻³ m³               | OK     |
| FTQ  | cubic foot                            | 0.02831684659  | 0          | 2,831 685 x 10⁻² m³   | OK     |
| G21  | cup [unit of volume]                  | 0.0002365882   | 0          | 2,365 882 x 10⁻⁴ m³   | OK     |
| G23  | peck                                  | 0.008809768    | 0          | 8,809 768 x 10⁻³ m³   | OK     |
| G24  | tablespoon (US)                       | 1.478676e-05   | 0          | 1,478 676 x 10⁻⁵ m³   | OK     |
| G25  | teaspoon (US)                         | 4.928922e-06   | 0          | 4,928 922 x 10⁻⁶ m³   | OK     |
| G26  | stere                                 | 1              | 0          | m³                    | OK     |
| GLD  | dry gallon (US)                       | 0.004404884    | 0          | 4,404 884 x 10⁻³ m³   | OK     |
| GLI  | gallon (UK)                           | 0.004546092    | 0          | 4,546 092 x 10⁻³ m³   | OK     |
| GLL  | gallon (US)                           | 0.003785412    | 0          | 3,785 412 x 10⁻³ m³   | OK     |
| H19  | cubic hectometre                      | 1000000        | 0          | 10⁶ m³                | OK     |
| H20  | cubic kilometre                       | 1000000000     | 0          | 10⁹ m³                | OK     |
| HLT  | hectolitre                            | 0.1            | 0          | 10⁻¹ m³               | OK     |
| INQ  | cubic inch                            | 1.6387064e-05  | 0          | 16,387 064 x 10⁻⁶ m³  | OK     |
| J57  | barrel (UK petroleum)                 | 0.15911315     | 0          | 0,159 113 15 m³       | OK     |
| K6   | kilolitre                             | 1              | 0          | m³                    | OK     |
| L43  | peck (UK)                             | 0.009092181    | 0          | 9,092 181 x 10⁻³ m³   | OK     |
| L61  | pint (US dry)                         | 0.0005506105   | 0          | 5,506 105 x 10⁻⁴ m³   | OK     |
| L62  | quart (US dry)                        | 0.001101221    | 0          | 1,101 221 x 10⁻³ m³   | OK     |
| L84  | ton (UK shipping)                     | 1.1893         | 0          | 1,189 3 m³            | OK     |
| L86  | ton (US shipping)                     | 1.1326         | 0          | 1,132 6 m³            | OK     |
| LTR  | litre                                 | 0.001          | 0          | 10⁻³ m³               | OK     |
| M67  | acre-foot (based on U.S. survey foot) | 1233.489       | 0          | 1,233 489 x 10³ m³    | OK     |
| M68  | cord (128 ft³)                        | 3.624556       | 0          | 3,624 556 m³          | OK     |
| M69  | cubic mile (UK statute)               | 4168182000     | 0          | 4,168 182 x 10⁹ m³    | OK     |
| M70  | ton. register                         | 2.831685       | 0          | 2,831 685 m³          | OK     |
| MAL  | megalitre                             | 1000           | 0          | 10³ m³                | OK     |
| MLT  | millilitre                            | 1e-06          | 0          | 10⁻⁶ m³               | OK     |
| MMQ  | cubic millimetre                      | 1e-09          | 0          | 10⁻⁹ m³               | OK     |
| MTQ  | cubic metre                           | 1              | 0          | m³                    | OK     |
| NM3  | Normalised cubic metre                | 1              | 0          | m3                    | OK     |
| OZA  | fluid ounce (US)                      | 2.957353e-05   | 0          | 2,957 353 x 10⁻⁵ m³   | OK     |
| OZI  | fluid ounce (UK)                      | 2.841306e-05   | 0          | 2,841 306 x 10⁻⁵ m³   | OK     |
| PT   | pint (US)                             | 0.000473176    | 0          | 4, 731 76 x 10⁻⁴ m³   | OK     |
| PTD  | dry pint (US)                         | 0.0005506105   | 0          | 5,506 105 x 10⁻⁴ m³   | OK     |
| PTI  | pint (UK)                             | 0.000568261    | 0          | 5, 682 61 x 10⁻⁴ m³   | OK     |
| PTL  | liquid pint (US)                      | 0.0004731765   | 0          | 4, 731 765 x 10⁻⁴ m³  | OK     |
| QT   | quart (US)                            | 0.0009463529   | 0          | 0,946 352 9 x 10⁻³ m³ | OK     |
| QTD  | dry quart (US)                        | 0.001101221    | 0          | 1,101 221 x 10⁻³ m³   | OK     |
| QTI  | quart (UK)                            | 0.0011365225   | 0          | 1,136 522 5 x 10⁻³ m³ | OK     |
| QTL  | liquid quart (US)                     | 0.0009463529   | 0          | 9,463 529 x 10⁻⁴ m³   | OK     |
| SM3  | Standard cubic metre                  | 1              | 0          | m3                    | OK     |
| YDQ  | cubic yard                            | 0.764555       | 0          | 0,764 555 m³          | OK     |

## Statistics

- Total GS1 units: 719
- Total Rec 20 Annex I units with conversion factor: 1373
- Units in both sources: 660
- Units verified (parseable + base): 643
    - Parseable conversion factors matched: 578
    - Base SI units (multiplier = 1): 65
- Units excluded: 13
- GS1 data errors found: 4 (all fixed)
- Categories covered: 49
- Test suite: 643 multiplier tests + 24 physical equivalence tests + 8 round-trip tests

## Methodology

Rec 20 conversion factors use European notation (comma = decimal separator,
space = digit grouping, Unicode superscripts for exponents). A custom parser
handles the following patterns:

- `10ⁿ unit` - power of 10 (e.g., `10⁻³ kg`)
- `number × 10ⁿ unit` - scientific notation (e.g., `3,386 39 × 10³ Pa`)
- `number × 10 unit` - times ten (e.g., `9,806 38 x 10 Pa`)
- `number unit` - simple value (e.g., `0,453 592 37 kg`)
- `n/m × unit` - fraction (e.g., `5/9 x K`)
- `unit` - base unit symbol only (multiplier = 1)

69 Rec 20 conversion factors are expressed as compound unit formulas
(e.g., `m²/s²`, `(kg x m)/s²`) which are unparseable but correspond to
base SI units with multiplier = 1, verified separately.
