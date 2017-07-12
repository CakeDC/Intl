<?php
/**
 * Copyright 2017, Cake Development Corporation (http://cakedc.com)
 *
 * Licensed under The MIT License
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright Copyright 2017, Cake Development Corporation (http://cakedc.com)
 * @link https://www.cakedc.com
 * @license MIT License (http://www.opensource.org/licenses/mit-license.php)
 */

namespace CakeDC\Intl\Utility;


class PatternParser
{
    private $eraDesignator = [
        'G' => 'AD',
        'GG' => 'AD',
        'GGG' => 'AD',
        'GGGG' => 'Anno Domini',
        'GGGGG' => 'A',
    ];
    private $year = [
        'yy' => 'y',
        'y' => 'Y',
        'yyyy' => 'Y',
    ];
    private $yearOfWeekOfYear = [
        'Y' => 'Y',
    ];
    private $extendedYear = [
        'u',
    ];
    private $cyclicYearName = [
        'U' => 'Not Implemented',
    ];
    private $relatedGregorianYear = [
        'r',
    ];
    private $quarter = [
        'Q',
        'QQ',
        'QQQ',
        'QQQQ',
        'QQQQQ',
    ];
    private $standAloneQuarter = [
        'q',
        'qq',
        'qqq',
        'qqqq',
        'qqqqq',
    ];
    private $monthInYear = [
        'M' => 'n',
        'MM' => 'm',
        'MMM' => 'M',
        'MMMM' => 'F',
        'MMMMM',
    ];
    private $standAloneMonthInYear = [
        'L' => 'n',
        'LL' => 'm',
        'LLL' => 'M',
        'LLLL' => 'F',
        'LLLLL',
    ];
    private $weekOfYear = [
        'w' => 'W',
        'ww' => 'W',
    ];
    private $weekOfMonth = [
        'W',
    ];
    private $dayInMonth = [
        'd' => 'j',
        'dd' => 'd',
    ];
    private $dayOfYear = [
        'D' => 'z',
    ];
    private $dayOfWeekInMonth = [
        'F',
    ];
    private $modifiedJulianDay = [
        'g',
    ];
    private $dayOfWeek = [
        'E' => 'D',
        'EE' => 'D',
        'EEE' => 'D',
        'EEEE' => 'l',
        'EEEEE',
        'EEEEEE',
    ];
    private $localDayOfWeek = [
        'e' => 'N',
        'ee' => 'N',
        'eee' => 'D',
        'eeee' => 'l',
        'eeeee',
        'eeeeee',
    ];
    private $atandAloneLocalDayOfWeek = [
        'c' => 'N',
        'cc' => 'N',
        'ccc' => 'D',
        'cccc' => 'l',
        'ccccc',
        'cccccc',
    ];
    private $amPmMarker = [
        'a' => 'a',
    ];
    private $hourInAmPm1 = [
        'h' => 'g',
        'hh' => 'h',
    ];
    private $hourInDay23 = [
        'H' => 'G',
        'HH' => 'H',
    ];
    private $hourInDay24 = [
        'k' => 'Not Implemented',
        'kk' => 'Not Implemented',
    ];
    private $hourInAmPm0 = [
        'K' => 'Not Implemented',
        'KK' => 'Not Implemented',
    ];
    private $minuteInHour = [
        'm',
        'mm',
    ];
    private $secondInMinute = [
        's',
        'ss',
    ];
    private $fractionalSecond = [
        'S',
        'SS',
        'SSS',
        'SSSS',
    ];
    private $millisecondsInDay = [
        'A'
    ];
    private $specificNonLocationTZ = [
        'z',
        'zz',
        'zzz',
        'zzzz',
    ];
    private $ISO860BasicTZ = [
        'Z',
        'ZZ',
        'ZZZ',
    ];
    private $longlocalizedGMTTZ = [
        'ZZZZ',
        'OOOO',
        'VVVV',
        'vvvv',
    ];
    private $ISO8601ExtendedHmsTZ = [
        'ZZZZZ' .
        'XXXXX',
    ];
    private $shortLocalizedGMTTZ = [
        'O',
        'OOOO'
    ];
    private $genericNonLocationTZ = [
        'v',
    ];
    private $longTimeZoneIDTZ = [
        'VV',
    ];
    private $timeZoneExemplarCity = [
        'VVV',
    ];
    private $ISO8601BasicHmWith0TZ = [
        'X',
    ];
    private $ISO8601BasicHmWithZTZ = [
        'XX',
    ];
    private $ISO8601ExtendedHmwithZTZ = [
        'XXX',
    ];
    private $ISO8601BasicHmsWithZTZ = [
        'XXXX',
    ];
    private $ISO8601ExtendedHmsWithZTZ = [
        'XXXXX',
    ];
    private $ISO8601BasicHmWithout0TZ = [
        'x',
    ];
    private $ISO8601BasicHmWithoutZTZ = [
        'xx',
    ];
    private $ISO8601ExtendedHmwithoutZTZ = [
        'xxx',
    ];
    private $ISO8601BasicHmsWithoutZTZ = [
        'xxxx',
    ];
    private $ISO8601ExtendedHmsWithoutZTZ = [
        'xxxxx',
    ];
    private $pattern;

    public function __construct($pattern)
    {
        $this->setPattern($pattern);
    }

    public function setPattern($pattern)
    {
        $this->pattern = $pattern;
    }

    public function parse()
    {

    }
    /*
    Timestamp:    1499821968
    G => AD
    GG => AD
    GGG => AD
    GGGG => Anno Domini
    GGGGG => A
    yy => 17
    y => 2017
    yyyy => 2017
    u => 2017
    U => 2017
    r => 2017
    Q => 3
    QQ => 03
    QQQ => Q3
    QQQQ => 3rd quarter
    QQQQQ => 3rd quarter
    q => 3
    qq => 03
    qqq => Q3
    qqqq => 3rd quarter
    qqqqq => 3rd quarter
    M => 7
    MM => 07
    MMM => Jul
    MMMM => July
    MMMMM => J
    n =>
    m => 12
    M => 7
    F => 2
    LLLLL => J
    w => 28
    ww => 28
    W => 3
    d => 11
    dd => 11
    D => 192
    F => 2
    g => 2457946
    E => Tue
    EE => Tue
    EEE => Tue
    EEEE => Tuesday
    EEEEE => T
    EEEEEE => Tu
    e => 3
    ee => 03
    eee => Tue
    eeee => Tuesday
    eeeee => T
    eeeeee => Tu
    c => 3
    cc => 3
    ccc => Tue
    cccc => Tuesday
    ccccc => T
    cccccc => Tu
    a => PM
    h => 8
    hh => 08
    H => 20
    HH => 20
    k => 20
    kk => 20
    K => 8
    KK => 08
    m => 12
    mm => 12
    s => 48
    ss => 48
    S => 0
    SS => 00
    SSS => 000
    SSSS => 0000
    A => 72768000
    z => CDT
    zz => CDT
    zzz => CDT
    zzzz => Central Daylight Time
    Z => -0500
    ZZ => -0500
    ZZZ => -0500
    ZZZZ => GMT-05:00
    OOOO => GMT-05:00
    VVVV => Chicago Time
    vvvv => Central Time
    ZZZZZ => -05:00
    XXXXX => -05:00
    O => GMT-5
    OOOO => GMT-05:00
    v => CT
    VV => America/Chicago
    VVV => Chicago
    X => -05
    XX => -0500
    XXX => -05:00
    XXXX => -0500
    XXXXX => -05:00
    x => -05
    xx => -0500
    xxx => -05:00
    xxxx => -0500
    xxxxx => -05:00
    MMMM dd, yyyy h:m a => July 11, 2017 8:12 PM
    */

}