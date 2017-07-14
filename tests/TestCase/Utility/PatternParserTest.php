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

namespace CakeDC\Intl\TestCase\Utility;

use CakeDC\Intl\Utility\PatternParser;
use PHPUnit_Framework_TestCase;

class PatternParserTest extends PHPUnit_Framework_TestCase
{
    /**
     * Timestamp: July 11, 2017 8:12 PM CST America/Chicago
     */
    private $timeStamp = 1499821968;
    private $timezone;

    public function setUp()
    {
        parent::setUp();
        $this->timezone = ini_get('date.timezone');
        date_default_timezone_set('America/Chicago');
    }

    public function tearDown()
    {
        date_default_timezone_set($this->timezone);
        parent::tearDown();
    }

    public function testEscapeStrings()
    {
        $fmt = new PatternParser('test');
        $strings = "It's easy to add single quote ";
        $expected = "\\I\\t\\'\\s\\ \\e\\a\\s\\y\\ \\t\\o\\ \\a\\d\\d\\ \\s\\i\\n\\g\\l\\e\\ \\q\\u\\o\\t\\e\\ ";
        $this->assertSame($fmt->escapeString($strings), $expected);

        $fmt = new PatternParser('test');
        $strings = "Escape single quouted text to pass to date()";
        $expected = '\E\s\c\a\p\e\ \s\i\n\g\l\e\ \q\u\o\u\t\e\d\ \t\e\x\t\ \t\o\ \p\a\s\s\ \t\o\ \d\a\t\e\(\)';
        $this->assertSame($fmt->escapeString($strings), $expected);

        $fmt = new PatternParser('test');
        $strings = "It\'s easy to add single quote";
        $string = $fmt->escapeString($strings);
        $expected = "It's easy to add single quote " . date("Y - m - d");
        $date = date($string[0] . "Y - m - d");
        //  $this->assertSame($date, $expected);

    }

    public function testFormat()
    {
        $string = "'Escape single quouted text to pass to date()' yyyy-M-dd";
        $fmt = new PatternParser($string);
        $expected = '\E\s\c\a\p\e\ \s\i\n\g\l\e\ \q\u\o\u\t\e\d\ \t\e\x\t\ \t\o\ \p\a\s\s\ \t\o\ \d\a\t\e\(\)  Y-n-d';
        $this->assertSame($fmt->format(), $expected);
    }

    public function testParse()
    {
        $pattern = 'yyyy - MMM - dd';
        $Parser = new PatternParser($pattern);
        $Parser->format();
        $this->assertSame('Y - M - d', $Parser->getPattern());


        $pattern = 'MM/dd/yyyy';
        $Parser = new PatternParser($pattern);
        $Parser->format();
        $this->assertSame('m/d/Y', $Parser->getPattern());

    }
}

    /**
     * @dataProvider providerFormatingSymbols
     */
/*
public function testFormatingSymbols($pattern, $expected, $msg = null)
{
    if (isset ($msg) && extension_loaded('intl')) {
        $this->markTestSkipped(
            'The Intl extension is available.'
        );
    }
    $fmt = new IntlDateFormatter('en_US', IntlDateFormatter::FULL, IntlDateFormatter::FULL);
    $fmt->setPattern($pattern);
    $this->assertSame($expected, $fmt->format($this->timeStamp));
}

public function providerFormatingSymbols()
{
    return [
        [
            'G',
            'AD',
        ],
        [
            'GG',
            'AD',
        ],
        [
            'GGG',
            'AD',
        ],
        [
            'GGGG',
            'Anno Domini',
        ],
        [
            'GGGGG',
            'A',
        ],
        [
            'yy',
            '17',
        ],
        [
            'y',
            '2017',
        ],
        [
            'yyyy',
            '2017',
        ],
        [
            'u',
            '2017',
        ],
        [
            'U',
            '2017',
        ],
        [
            'r',
            '2017',
        ],
        [
            'Q',
            '3',
        ],
        [
            'QQ',
            '03',
        ],
        [
            'QQQ',
            'Q3',
        ],
        [
            'QQQQ',
            '3rd quarter',
        ],
        [
            'QQQQQ',
            '3rd quarter',
        ],
        [
            'q',
            '3',
        ],
        [
            'qq',
            '03',
        ],
        [
            'qqq',
            'Q3',
        ],
        [
            'qqqq',
            '3rd quarter',
        ],
        [
            'qqqqq',
            '3rd quarter',
        ],
        [
            'M',
            '7',
        ],
        [
            'MM',
            '07',
        ],
        [
            'MMM',
            'Jul',
        ],
        [
            'MMMM',
            'July',
        ],
        [
            'MMMMM',
            'J',
        ],
        [
            'L',
            '7',
        ],
        [
            'LL',
            '07',
        ],
        [
            'LLL',
            'Jul',
        ],
        [
            'LLLL',
            'July',
        ],
        [
            'LLLLL',
            'J',
        ],
        [
            'w',
            '28',
        ],
        [
            'ww',
            '28',
        ],
        [
            'W',
            '3',
        ],
        [
            'd',
            '11',
        ],
        [
            'dd',
            '11',
        ],
        [
            'D',
            '192',
        ],
        [
            'F',
            '2',
        ],
        [
            'g',
            '2457946',
        ],
        [
            'E',
            'Tue',
        ],
        [
            'EE',
            'Tue',
        ],
        [
            'EEE',
            'Tue',
        ],
        [
            'EEEE',
            'Tuesday',
        ],
        [
            'EEEEE',
            'T',
        ],
        [
            'EEEEEE',
            'Tu',
        ],
        [
            'e',
            '3',
        ],
        [
            'ee',
            '03',
        ],
        [
            'eee',
            'Tue',
        ],
        [
            'eeee',
            'Tuesday',
        ],
        [
            'eeeee',
            'T',
        ],
        [
            'eeeeee',
            'Tu',
        ],
        [
            'c',
            '3',
        ],
        [
            'cc',
            '3',
        ],
        [
            'ccc',
            'Tue',
        ],
        [
            'cccc',
            'Tuesday',
        ],
        [
            'ccccc',
            'T',
        ],
        [
            'cccccc',
            'Tu',
        ],
        [
            'a',
            'PM',
        ],
        [
            'h',
            '8',
        ],
        [
            'hh',
            '08',
        ],
        [
            'H',
            '20',
        ],
        [
            'HH',
            '20',
        ],
        [
            'k',
            '20',
        ],
        [
            'kk',
            '20',
        ],
        [
            'K',
            '8',
        ],
        [
            'KK',
            '08',
        ],
        [
            'm',
            '12',
        ],
        [
            'mm',
            '12',
        ],
        [
            's',
            '48',
        ],
        [
            'ss',
            '48',
        ],
        [
            'S',
            '0',
        ],
        [
            'SS',
            '00',
        ],
        [
            'SSS',
            '000',
        ],
        [
            'SSSS',
            '0000',
        ],
        [
            'A',
            '72768000',
        ],
        [
            'z',
            'CDT',
        ],
        [
            'zz',
            'CDT',
        ],
        [
            'zzz',
            'CDT',
        ],
        [
            'zzzz',
            'Central Daylight Time',
        ],
        [
            'Z',
            '-0500',
        ],
        [
            'ZZ',
            '-0500',
        ],
        [
            'ZZZ',
            '-0500',
        ],
        [
            'ZZZZ',
            'GMT-05:00',
        ],
        [
            'OOOO',
            'GMT-05:00',
        ],
        [
            'VVVV',
            'Chicago Time',
        ],
        [
            'vvvv',
            'Central Time',
        ],
        [
            'ZZZZZ',
            '-05:00',
        ],
        [
            'XXXXX',
            '-05:00',
        ],
        [
            'O',
            'GMT-5',
        ],
        [
            'OOOO',
            'GMT-05:00',
        ],
        [
            'v',
            'CT',
        ],
        [
            'VV',
            'America/Chicago',
        ],
        [
            'VVV',
            'Chicago',
        ],
        [
            'X',
            '-05',
        ],
        [
            'XX',
            '-0500',
        ],
        [
            'XXX',
            '-05:00',
        ],
        [
            'XXXX',
            '-0500',
        ],
        [
            'XXXXX',
            '-05:00',
        ],
        [
            'x',
            '-05',
        ],
        [
            'xx',
            '-0500',
        ],
        [
            'xxx',
            '-05:00',
        ],
        [
            'xxxx',
            '-0500',
        ],
        [
            'xxxxx',
            '-05:00',
        ],
        [
            'MMMM dd, yyyy h:m a',
            'July 11, 2017 8:12 PM',
        ],
        [
            '\'Testing with escaped string\' MMMM dd, yyyy h:m a',
            'Testing with escaped string July 11, 2017 8:12 PM',
        ],
        [
            "'Testing with escaped string' MMMM dd, yyyy h:m a",
            'Testing with escaped string July 11, 2017 8:12 PM',
        ],
        [
            "'It''s easy to add single quote' MMMM dd, yyyy h:m a",
            'It\'s easy to add single quote July 11, 2017 8:12 PM',
        ],
        [
            '\'It\'\'s easy to add single quote\' MMMM dd, yyyy h:m a',
            'It\'s easy to add single quote July 11, 2017 8:12 PM',
        ],
    ];

}
}*/