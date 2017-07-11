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

use Locale;
use PHPUnit_Framework_TestCase;

class LocaleTest extends PHPUnit_Framework_TestCase
{
    public function setUp()
    {
        parent::setUp();
    }

    function testGetDefault()
    {
        $locale = Locale::getDefault();
        $expected = 'en_US';
        $this->assertSame($expected, $locale);
    }

    function testParseLocale()
    {
        $locale = Locale::parseLocale(null);
        $expected = ['language' => 'en', 'region' => 'US',];
        $this->assertSame($expected, $locale);

    }

    function testGetDisplayLanguage()
    {
        $locale = Locale::getDisplayLanguage(null);
    }

    /**
     * @expectedException UnexpectedValueException
     */
    function testParseLocaleException()
    {
        if (extension_loaded('intl')) {
            $this->markTestSkipped(
                'The Intl extension is available.'
            );
        }
        $locale = Locale::parseLocale("en_UK");
    }

}