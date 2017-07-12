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

namespace CakeDC\intl\tests\TestCase\Utility;

use IntlDateFormatter;
use PHPUnit_Framework_TestCase;

class PatternParserTest extends PHPUnit_Framework_TestCase
{
    /**
     * Timestamp:    1499821968
     */
    private $time = 1499821968;

    public function setUp()
    {
        parent::setUp();
        date_default_timezone_set('America/Chicago');
    }

    public function testFormatingWithSymbolUpperG()
    {
        $pattern = 'G';
        $fmt = new IntlDateFormatter('en_US', IntlDateFormatter::FULL, IntlDateFormatter::FULL);
        $fmt->setPattern($pattern);
        $this->assertSame('AD', $fmt->format($this->time));
    }

    public function testFormatingWithSymbolUpperGG()
    {
        $pattern = 'GG';
        $fmt = new IntlDateFormatter('en_US', IntlDateFormatter::FULL, IntlDateFormatter::FULL);
        $fmt->setPattern($pattern);
        $this->assertSame('AD', $fmt->format($this->time));
    }

    public function testFormatingWithSymbolUpperGGG()
    {
        $pattern = 'GGG';
        $fmt = new IntlDateFormatter('en_US', IntlDateFormatter::FULL, IntlDateFormatter::FULL);
        $fmt->setPattern($pattern);
        $this->assertSame('AD', $fmt->format($this->time));
    }

    public function testFormatingWithSymbolUpperGGGG()
    {
        $pattern = 'GGGG';
        $fmt = new IntlDateFormatter('en_US', IntlDateFormatter::FULL, IntlDateFormatter::FULL);
        $fmt->setPattern($pattern);
        $this->assertSame('Anno Domini', $fmt->format($this->time));
    }

    public function testFormatingWithSymbolUpperGGGGG()
    {
        $pattern = 'GGGGG';
        $fmt = new IntlDateFormatter('en_US', IntlDateFormatter::FULL, IntlDateFormatter::FULL);
        $fmt->setPattern($pattern);
        $this->assertSame('A', $fmt->format($this->time));
    }

    public function testFormatingWithSymbolLowery()
    {
        $pattern = 'y';
        $fmt = new IntlDateFormatter('en_US', IntlDateFormatter::FULL, IntlDateFormatter::FULL);
        $fmt->setPattern($pattern);
        $this->assertSame('2017', $fmt->format($this->time));
    }

    public function testFormatingWithSymbolLoweryy()
    {
        $pattern = 'yy';
        $fmt = new IntlDateFormatter('en_US', IntlDateFormatter::FULL, IntlDateFormatter::FULL);
        $fmt->setPattern($pattern);
        $this->assertSame('17', $fmt->format($this->time));
    }

    public function testFormatingWithSymbolLoweryyyy()
    {
        $pattern = 'yyyy';
        $fmt = new IntlDateFormatter('en_US', IntlDateFormatter::FULL, IntlDateFormatter::FULL);
        $fmt->setPattern($pattern);
        $this->assertSame('2017', $fmt->format($this->time));
    }

    public function testFormatingWithSymbolLoweru()
    {
        $pattern = 'u';
        $fmt = new IntlDateFormatter('en_US', IntlDateFormatter::FULL, IntlDateFormatter::FULL);
        $fmt->setPattern($pattern);
        $this->assertSame('2017', $fmt->format($this->time));
    }

    public function testFormatingWithSymbolUpperU()
    {
        $pattern = 'u';
        $fmt = new IntlDateFormatter('en_US', IntlDateFormatter::FULL, IntlDateFormatter::FULL);
        $fmt->setPattern($pattern);
        $this->assertSame('2017', $fmt->format($this->time));
    }

    public function testFormatingWithSymbolLowerr()
    {
        $pattern = 'r';
        $fmt = new IntlDateFormatter('en_US', IntlDateFormatter::FULL, IntlDateFormatter::FULL);
        $fmt->setPattern($pattern);
        $this->assertSame('2017', $fmt->format($this->time));
    }

    public function testFormatingWithSymbolUpperQ()
    {
        $pattern = 'Q';
        $fmt = new IntlDateFormatter('en_US', IntlDateFormatter::FULL, IntlDateFormatter::FULL);
        $fmt->setPattern($pattern);
        $this->assertSame('3', $fmt->format($this->time));
    }

    public function testFormatingWithSymbolUpperQQ()
    {
        $pattern = 'QQ';
        $fmt = new IntlDateFormatter('en_US', IntlDateFormatter::FULL, IntlDateFormatter::FULL);
        $fmt->setPattern($pattern);
        $this->assertSame('03', $fmt->format($this->time));
    }

    public function testFormatingWithSymbolUpperQQQ()
    {
        $pattern = 'QQQ';
        $fmt = new IntlDateFormatter('en_US', IntlDateFormatter::FULL, IntlDateFormatter::FULL);
        $fmt->setPattern($pattern);
        $this->assertSame('Q3', $fmt->format($this->time));
    }

    public function testFormatingWithSymbolUpperQQQQ()
    {
        $pattern = 'QQQQ';
        $fmt = new IntlDateFormatter('en_US', IntlDateFormatter::FULL, IntlDateFormatter::FULL);
        $fmt->setPattern($pattern);
        $this->assertSame('3rd quarter', $fmt->format($this->time));
    }

    public function testFormatingWithSymbolUpperQQQQQ()
    {
        $pattern = 'QQQQQ';
        $fmt = new IntlDateFormatter('en_US', IntlDateFormatter::FULL, IntlDateFormatter::FULL);
        $fmt->setPattern($pattern);
        $this->assertSame('3rd quarter', $fmt->format($this->time));
    }

    public function testFormatingWithSymbolLowerq()
    {
        $pattern = 'q';
        $fmt = new IntlDateFormatter('en_US', IntlDateFormatter::FULL, IntlDateFormatter::FULL);
        $fmt->setPattern($pattern);
        $this->assertSame('', $fmt->format($this->time));
    }
    /*
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