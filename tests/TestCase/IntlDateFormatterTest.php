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
namespace CakeDC\Intl\TestCase;

use DateTimeZone;
use IntlDateFormatter;
use PHPUnit_Framework_TestCase;

class IntlDateFormatterTest extends PHPUnit_Framework_TestCase
{
    function setUp()
    {
        parent::setUp();
    }

    function testParse()
    {
        $fmt = new IntlDateFormatter("en_US", IntlDateFormatter::FULL, IntlDateFormatter::FULL);
        $actual = $fmt->parse("Wednesday, January 20, 2038 3:14:07 AM GMT");
        $expected = 2147570047;
        $this->assertEquals($expected, $actual);
    }

    function testIntlDateFormatterGetLocal()
    {
        $Formatter = new IntlDateFormatter('en_US', IntlDateFormatter::FULL, IntlDateFormatter::FULL,
            new DateTimeZone("UTC"));
        $expected = 'en';
        $this->assertEquals($expected, $Formatter->getLocale());
    }

    function testUsingDifferentPattern()
    {
        $Formatter = new IntlDateFormatter('en_US', IntlDateFormatter::FULL, IntlDateFormatter::FULL);
        $Formatter->setPattern('yyyy-MM-dd');
        debug($Formatter->format('1481155200'));

        $Formatter = new IntlDateFormatter('en_US', IntlDateFormatter::FULL, IntlDateFormatter::FULL);
        $Formatter->setPattern('yy-M-d');
        debug($Formatter->format('1481155200'));
    }

    function testFormatEn()
    {

        $fmt1 = new IntlDateFormatter('en_US', IntlDateFormatter::FULL, IntlDateFormatter::FULL, 'America/Chicago');
        $expected = 'Sunday, January 1, 2012 at 6:31:32 AM CST';
        $this->assertEquals($expected, $fmt1->format(strtotime('2012-01-01 12:31:32 +0000')));

        $fmt2 = new IntlDateFormatter('en_US', IntlDateFormatter::FULL, IntlDateFormatter::FULL, 'GMT+05:12');
        $expected = 'Sunday, January 1, 2012 at 5:12:00 AM GMT+05:12';
        $this->assertEquals($expected, $fmt2->format(strtotime('2012-01-01 00:00:00 +0000')));

        $fmt3 = new IntlDateFormatter('en_US', IntlDateFormatter::LONG, IntlDateFormatter::LONG, 'GMT+05:12');
        $expected = 'January 1, 2012 at 5:12:00 AM GMT+05:12';
        $this->assertEquals($expected, $fmt3->format(strtotime('2012-01-01 00:00:00 +0000')));

        $fmt4 = new IntlDateFormatter('en_US', IntlDateFormatter::MEDIUM, IntlDateFormatter::MEDIUM, 'GMT+05:12');
        $expected = 'Jan 1, 2012, 5:12:00 AM';
        $this->assertEquals($expected, $fmt4->format(strtotime('2012-01-01 00:00:00 +0000')));

        $fmt5 = new IntlDateFormatter('en_US', IntlDateFormatter::SHORT, IntlDateFormatter::SHORT, 'GMT+05:12');
        $expected = '1/1/12 5:12 AM';
        $this->assertEquals($expected, $fmt5->format(strtotime('2012-01-01 00:00:00 +0000')));

        $fmt6 = new IntlDateFormatter('en_US', IntlDateFormatter::FULL, IntlDateFormatter::FULL, 'America/Chicago');
        $expected = 'Sunday, January 1, 2012 at 6:31:32 AM CST';
        $this->assertEquals($expected, $fmt6->format(strtotime('2012-01-01 12:31:32 +0000')));

        $fmt7 = new IntlDateFormatter('en_US', IntlDateFormatter::FULL, IntlDateFormatter::FULL, 'GMT');
        $expected = 'Sunday, January 1, 2012 at 12:00:00 AM GMT';
        $this->assertEquals($expected, $fmt7->format(strtotime('2012-01-01 00:00:00 +0000')));

    }

}