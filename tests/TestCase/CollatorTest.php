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

use Collator;
use Locale;
use PHPUnit_Framework_TestCase;

class CollatorTest extends PHPUnit_Framework_TestCase
{
    function setUp()
    {
        parent::setUp();
    }

    function testgetSortKey()
    {
        $coll = new Collator('en_US');
        $this->assertEquals('71%3F%3FE%01%09%01%DC%08', urlencode($coll->getSortKey('Hello')));
    }

    function testCreateCollatorDiffLocales()
    {

        $locales = array(
            'EN-US-ODESSA',
            'UK_UA_ODESSA',
            'root',
            'uk@currency=EURO',
        );

        $requested = array(
            'EN-US-ODESSA' => array('valid' => 'en_US', 'actual' => 'root',),
            'UK_UA_ODESSA' => array('valid' => 'uk', 'actual' => 'uk',),
            'root' => array('valid' => 'root', 'actual' => 'root',),
            'uk@currency=EURO' => array('valid' => 'uk', 'actual' => 'uk',),
        );

        foreach ($locales as $locale) {
            $coll = Collator::create($locale);
            $this->assertEquals($requested[$locale]['valid'], $coll->getLocale(Locale::VALID_LOCALE));
            $this->assertEquals($requested[$locale]['actual'], $coll->getLocale(Locale::ACTUAL_LOCALE));

        }
    }

    function testGetSetAttribute()
    {

        $coll = Collator::create('en_US');

        $coll->setAttribute(Collator::NORMALIZATION_MODE, Collator::OFF);
        $val = $coll->getAttribute(Collator::NORMALIZATION_MODE);
        $val = ($val == Collator::OFF ? "off" : "on");
        $this->assertEquals('off', $val);

        $coll->setAttribute(Collator::NORMALIZATION_MODE, Collator::ON);
        $val = $coll->getAttribute(Collator::NORMALIZATION_MODE);
        $val = ($val == Collator::OFF ? "off" : "on");
        $this->assertEquals('on', $val);
    }

    function testGetSetStrength()
    {

        $coll = Collator::create('en_US');

        //$set = $coll->setStrength(Collator::PRIMARY);
        //$get = $coll->getStrength();
        // $this->assertEquals($set, $get);


        $set = $coll->setStrength(Collator::SECONDARY);
        $get = $coll->getStrength();
        $this->assertEquals($set, $get);


        $set = $coll->setStrength(Collator::TERTIARY);
        $get = $coll->getStrength();
        $this->assertEquals($set, $get);
    }
}