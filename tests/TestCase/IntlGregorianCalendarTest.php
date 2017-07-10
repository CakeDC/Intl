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

use IntlGregorianCalendar;
use PHPUnit_Framework_TestCase;

class IntlGregorianCalendarTest extends PHPUnit_Framework_TestCase
{
    public function setUp()
    {
        parent::setUp();
    }

    function testIntlGregorianCalendarConstruct()
    {
        ini_set("intl.default_locale", "nl");

        date_default_timezone_set('Europe/Amsterdam');

        $intlcal = new IntlGregorianCalendar();
        $this->assertEquals('Europe/Amsterdam', $intlcal->getTimeZone()->getId());
        $this->assertEquals('nl_NL', $intlcal->getLocale(1));

        $intlcal = new IntlGregorianCalendar('Europe/Lisbon', null);
        $this->assertEquals('Europe/Lisbon', $intlcal->getTimeZone()->getId());
        $this->assertEquals('nl_NL', $intlcal->getLocale(1));

        $intlcal = new IntlGregorianCalendar(null, 'pt_PT');
        $this->assertEquals('Europe/Amsterdam', $intlcal->getTimeZone()->getId());
        $this->assertEquals('pt_PT', $intlcal->getLocale(1));

        $intlcal = new IntlGregorianCalendar('Europe/Lisbon', 'pt_PT');
        $this->assertEquals('Europe/Lisbon', $intlcal->getTimeZone()->getId());
        $this->assertEquals('pt_PT', $intlcal->getLocale(1));

        $intlcal = new IntlGregorianCalendar('Europe/Paris', 'fr_CA', null, null, null, null);
        $this->assertEquals('Europe/Paris', $intlcal->getTimeZone()->getId());
        $this->assertEquals('fr_CA', $intlcal->getLocale(1));

        $this->assertEquals('gregorian', $intlcal->getType());
    }


    function testIntlGregorianCalendarConstructArgs()
    {
        date_default_timezone_set('Europe/Amsterdam');
        $intlcal = new IntlGregorianCalendar(2012, 1, 29, 16, 0, null);
        $this->assertEquals('Europe/Amsterdam', $intlcal->getTimeZone()->getId());
        $this->assertEquals($intlcal->getTime(), (float)strtotime('2012-02-29 16:00:00') * 1000);

        $intlcal = new IntlGregorianCalendar(2012, 1, 29, 16, 7, 8);
        $this->assertEquals($intlcal->getTime(), (float)strtotime('2012-02-29 16:07:08') * 1000);
        $this->assertEquals('gregorian', $intlcal->getType());
    }

    function testIntlGregorianCalendargetGregorianChange()
    {
        ini_set("intl.default_locale", "nl");
        date_default_timezone_set('Europe/Amsterdam');

        $intlcal = new IntlGregorianCalendar();

        $this->assertEquals(-12219292800000, $intlcal->getGregorianChange());
        $this->assertEquals(true, $intlcal->setGregorianChange(0));
        $this->assertEquals(0, $intlcal->getGregorianChange());
        $this->assertEquals(true, $intlcal->setGregorianChange(1));
        $this->assertEquals(1, $intlcal->getGregorianChange());
    }

    function testIntlGregorianCalendarisLeapYear()
    {
        ini_set("intl.default_locale", "nl");
        date_default_timezone_set('Europe/Amsterdam');
        $intlcal = new IntlGregorianCalendar();

        $this->assertEquals(true, $intlcal->isLeapYear(2012));
        $this->assertEquals(false, $intlcal->isLeapYear(1900));
    }

    function testEqualsBeforeAfter()
    {
        ini_set("intl.default_locale", "nl");

        $intlcal1 = new IntlGregorianCalendar(2012, 1, 29, 16, 59, 59);
        $intlcal2 = IntlCalendar::createInstance(null, '@calendar=japanese');
        $intlcal3 = new IntlGregorianCalendar(2012, 1, 29, 17, 00, 00);
        $intlcal2->setTime($intlcal1->getTime());

        var_dump($intlcal2->getType());

        var_dump("1 eq 1", $intlcal1->equals($intlcal1));

        var_dump("1 eq 2", $intlcal1->equals($intlcal2));
        var_dump("1 before 2", $intlcal1->before($intlcal2));
        var_dump("1 after 2", $intlcal1->after($intlcal2));

        var_dump("1 eq 3", $intlcal1->equals($intlcal3));
        var_dump("1 before 3", $intlcal1->before($intlcal3));
        var_dump("1 after 3", $intlcal1->after($intlcal3));

        var_dump("3 eq 2", intlcal_equals($intlcal3, $intlcal2));
        var_dump("3 before 2", intlcal_before($intlcal3, $intlcal2));
        var_dump("3 after 2", intlcal_after($intlcal3, $intlcal2));
    }


}