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

namespace CakeDC\intl\src\Utility;


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


}