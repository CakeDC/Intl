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

use NumberFormatter;
use PHPUnit_Framework_TestCase;

class NumberFormatterTest extends PHPUnit_Framework_TestCase
{

    public function setUp()
    {
        parent::setUp();
    }

    public function testFormatRorFloat()
    {

        $nfmt = new NumberFormatter("en_US", NumberFormatter::DECIMAL);
        $this->assertSame(23.25, $nfmt->format(23.25));

        $nfmt = new NumberFormatter('en_US', NumberFormatter::DECIMAL);
        $this->assertSame(1.234, $nfmt->format('1.234.567,891', NumberFormatter::DECIMAL));
    }

    function testFormatForCurrency()
    {
        $nfmt = new NumberFormatter("en_US", NumberFormatter::CURRENCY);
        $this->assertEquals("$23.25", $nfmt->format(23.25));

        $nfmt = new NumberFormatter("en_US", NumberFormatter::CURRENCY);
        $this->assertEquals("$0.25", $nfmt->format(.25));
    }
}

    function testFormatForPercent()
    {
        $nfmt = new NumberFormatter('en_US', NumberFormatter::PERCENT, '#,##0%');
        $this->assertEquals('2,325%', $nfmt->format(23.25));

        $nfmt = new NumberFormatter('en_US', NumberFormatter::PERCENT, '#,##0%');
        $this->assertEquals('25%', $nfmt->format(.25));
    }

/*
    function testFormatWithTypeConversion()
    {
        $nfmt = new NumberFormatter('en_US', NumberFormatter::DECIMAL);
        $number = 1234567.891234567890000;
        $this->assertEquals('1,234,567', $nfmt->format($number, NumberFormatter::TYPE_INT32));
    }

    function testFormatCurrency()
    {
        $nfmt = new NumberFormatter("en_US", NumberFormatter::CURRENCY);
        $number = 1234567.89;
        $this->assertEquals("$1,234,567.89", $nfmt->formatCurrency($number, 'USD'));

    }

    function testWithMiscPatterns()
    {
        $styles = [
            NumberFormatter::PATTERN_DECIMAL => '##.#####################',
            NumberFormatter::DECIMAL => '',
            NumberFormatter::CURRENCY => '',
            NumberFormatter::PERCENT => '',
            NumberFormatter::SCIENTIFIC => '',
            NumberFormatter::SPELLOUT => '@@@@@@@',
            NumberFormatter::ORDINAL => '',
            NumberFormatter::DURATION => '',
            NumberFormatter::PATTERN_RULEBASED => '#####.###',
        ];

        $expected = [
            "1234567.89123457",
            "1,234,567.891",
            "$1,234,567.89",
            "123,456,789%",
            "1.23456789123457E6",
            "one million two hundred thirty-four thousand five hundred sixty-seven point eight nine one two three four five seven",
            "1,234,568th",
            "343:56:08",
            "#####.###",
        ];

        $locales = [
            'en_US',
        ];
        $number = 1234567.891234567890000;
        foreach ($locales as $locale) {
            $i = 0;

            foreach ($styles as $style => $pattern) {
                $fmt = new NumberFormatter($locale, $style, $pattern);
                isset($integer[$style]) ? $this->assertEquals($expected[$i],
                    $fmt->format($number, NumberFormatter::TYPE_INT32)) : $this->assertEquals($expected[$i],
                    $fmt->format(($number)));
                $i++;
            }
        }
    }

    function testGetSetAttribute()
    {
        // attr_name => array( attr, value )
        $attributes = array(
            'PARSE_INT_ONLY' => array(NumberFormatter::PARSE_INT_ONLY, 1, 12345.123456),
            'GROUPING_USED' => array(NumberFormatter::GROUPING_USED, 0, 12345.123456),
            'DECIMAL_ALWAYS_SHOWN' => array(NumberFormatter::DECIMAL_ALWAYS_SHOWN, 1, 12345),
            'MAX_INTEGER_DIGITS' => array(NumberFormatter::MAX_INTEGER_DIGITS, 2, 12345.123456),
            'MIN_INTEGER_DIGITS' => array(NumberFormatter::MIN_INTEGER_DIGITS, 20, 12345.123456),
            'INTEGER_DIGITS' => array(NumberFormatter::INTEGER_DIGITS, 7, 12345.123456),
            'MAX_FRACTION_DIGITS' => array(NumberFormatter::MAX_FRACTION_DIGITS, 2, 12345.123456),
            'MIN_FRACTION_DIGITS' => array(NumberFormatter::MIN_FRACTION_DIGITS, 20, 12345.123456),
            'FRACTION_DIGITS' => array(NumberFormatter::FRACTION_DIGITS, 5, 12345.123456),
            'MULTIPLIER' => array(NumberFormatter::MULTIPLIER, 2, 12345.123456),
            'GROUPING_SIZE' => array(NumberFormatter::GROUPING_SIZE, 2, 12345.123456),
            'ROUNDING_MODE' => array(NumberFormatter::ROUNDING_MODE, 1, 12345.123456),
            'ROUNDING_INCREMENT' => array(NumberFormatter::ROUNDING_INCREMENT, (float)2, 12345.123456),
            'FORMAT_WIDTH' => array(NumberFormatter::FORMAT_WIDTH, 27, 12345.123456),
            'PADDING_POSITION' => array(NumberFormatter::PADDING_POSITION, 2, 12345.123456),
            'SECONDARY_GROUPING_SIZE' => array(NumberFormatter::SECONDARY_GROUPING_SIZE, 2, 12345.123456),
            'SIGNIFICANT_DIGITS_USED' => array(NumberFormatter::SIGNIFICANT_DIGITS_USED, 1, 12345.123456),
            'MIN_SIGNIFICANT_DIGITS' => array(NumberFormatter::MIN_SIGNIFICANT_DIGITS, 3, 1),
            'MAX_SIGNIFICANT_DIGITS' => array(NumberFormatter::MAX_SIGNIFICANT_DIGITS, 4, 12345.123456),
            // 'LENIENT_PARSE' => array( NumberFormatter::LENIENT_PARSE, 2, 12345.123456 )
        );

        $res_str = '';

        $fmt = new NumberFormatter("en_US", NumberFormatter::DECIMAL);

        foreach ($attributes as $attr_name => $args) {
            list($attr, $new_val, $number) = $args;
            $res_str .= "\nAttribute $attr_name\n";

            // Get original value of the attribute.
            $orig_val = $fmt->getAttribute($attr);

            // Format the number using the original attribute value.
            $rc = $fmt->format($number);

            $ps = $fmt->parse($rc);

            $res_str .= sprintf("Old attribute value: %s ;  Format result: %s ; Parse result: %s\n",
                dump($orig_val),
                dump($rc),
                dump($ps));

            // Set new attribute value.
            $rc = $fmt->setAttribute($attr, $new_val);
            if ($rc) {
                $res_str .= "Setting attribute: ok\n";
            } else {
                $res_str .= sprintf("Setting attribute failed: %s\n");
            }

            // Format the number using the new value.
            $rc = $fmt->format($number);

            // Get current value of the attribute and check if it equals $new_val.
            $attr_val_check = $fmt->getAttribute($attr);
            if ($attr_val_check !== $new_val) {
                $res_str .= "ERROR: New $attr_name attribute value has not been set correctly.\n";
            }

            $ps = $fmt->parse($rc);

            $res_str .= sprintf("New attribute value: %s ;  Format result: %s ; Parse result: %s\n",
                dump($new_val),
                dump($rc),
                dump($ps));


            // Restore original attribute of the  value
            if ($attr != NumberFormatter::INTEGER_DIGITS && $attr != NumberFormatter::FRACTION_DIGITS
                && $attr != NumberFormatter::FORMAT_WIDTH && $attr != NumberFormatter::SIGNIFICANT_DIGITS_USED
            ) {
                $fmt->setAttribute($attr, $orig_val);
            }
        }

        debug($res_str);
    }

    function testSetGetPattern()
    {
        $res_str = '';
        $test_value = 12345.123456;
        $fmt = new NumberFormatter("en_US", NumberFormatter::PATTERN_DECIMAL);

        // Get default patten.
        $res_str .= "Default pattern: '" . $fmt->getPattern() . "'\n";
        $res_str .= "Formatting result: " . $fmt->format($test_value) . "\n";

        // Set a new pattern.
        $res = $fmt->setPattern("0.0");
        if ($res === false) {
            $res_str .= $fmt->getErrorMessage() . "\n";
        }

        // Check if the pattern has been changed.
        $res = $fmt->getPattern();
        if ($res === false) {
            $res_str .= $fmt->getErrorMessage() . "\n";
        }
        $res_str .= "New pattern: '" . $fmt->getPattern() . "'\n";
        $res_str .= "Formatted number: " . $fmt->format($test_value) . "\n";

        $fmt->setPattern(str_repeat('@', 200));
        $res_str .= "New pattern: '" . $fmt->getPattern() . "'\n";
        $res_str .= "Formatted number: " . $fmt->format($test_value) . "\n";

        debug($res_str);
    }

    function testGetSetSymbol()
    {
        $longstr = str_repeat("blah", 10);
        $symbols = array(
            'DECIMAL_SEPARATOR_SYMBOL' => array(
                NumberFormatter::DECIMAL_SEPARATOR_SYMBOL,
                '_._',
                12345.123456,
                NumberFormatter::DECIMAL
            ),
            'GROUPING_SEPARATOR_SYMBOL' => array(
                NumberFormatter::GROUPING_SEPARATOR_SYMBOL,
                '_,_',
                12345.123456,
                NumberFormatter::DECIMAL
            ),
            'PATTERN_SEPARATOR_SYMBOL' => array(
                NumberFormatter::PATTERN_SEPARATOR_SYMBOL,
                '_;_',
                12345.123456,
                NumberFormatter::DECIMAL
            ),
            'PERCENT_SYMBOL' => array(NumberFormatter::PERCENT_SYMBOL, '_%_', 12345.123456, NumberFormatter::PERCENT),
            'ZERO_DIGIT_SYMBOL' => array(
                NumberFormatter::ZERO_DIGIT_SYMBOL,
                '_ZD_',
                12345.123456,
                NumberFormatter::DECIMAL
            ),
            'DIGIT_SYMBOL' => array(NumberFormatter::DIGIT_SYMBOL, '_DS_', 12345.123456, NumberFormatter::DECIMAL),
            'MINUS_SIGN_SYMBOL' => array(
                NumberFormatter::MINUS_SIGN_SYMBOL,
                '_-_',
                -12345.123456,
                NumberFormatter::DECIMAL
            ),
            'PLUS_SIGN_SYMBOL' => array(
                NumberFormatter::PLUS_SIGN_SYMBOL,
                '_+_',
                12345.123456,
                NumberFormatter::SCIENTIFIC
            ),
            'CURRENCY_SYMBOL' => array(
                NumberFormatter::CURRENCY_SYMBOL,
                '_$_',
                12345.123456,
                NumberFormatter::CURRENCY
            ),
            'INTL_CURRENCY_SYMBOL' => array(
                NumberFormatter::INTL_CURRENCY_SYMBOL,
                '_$_',
                12345.123456,
                NumberFormatter::CURRENCY
            ),
            'MONETARY_SEPARATOR_SYMBOL' => array(
                NumberFormatter::MONETARY_SEPARATOR_SYMBOL,
                '_MS_',
                12345.123456,
                NumberFormatter::CURRENCY
            ),
            'EXPONENTIAL_SYMBOL' => array(
                NumberFormatter::EXPONENTIAL_SYMBOL,
                '_E_',
                12345.123456,
                NumberFormatter::SCIENTIFIC
            ),
            'PERMILL_SYMBOL' => array(NumberFormatter::PERMILL_SYMBOL, '_PS_', 12345.123456, NumberFormatter::DECIMAL),
            'PAD_ESCAPE_SYMBOL' => array(
                NumberFormatter::PAD_ESCAPE_SYMBOL,
                '_PE_',
                12345.123456,
                NumberFormatter::DECIMAL
            ),
            'INFINITY_SYMBOL' => array(
                NumberFormatter::INFINITY_SYMBOL,
                '_IS_',
                12345.123456,
                NumberFormatter::DECIMAL
            ),
            'NAN_SYMBOL' => array(NumberFormatter::NAN_SYMBOL, '_N_', 12345.123456, NumberFormatter::DECIMAL),
            'SIGNIFICANT_DIGIT_SYMBOL' => array(
                NumberFormatter::SIGNIFICANT_DIGIT_SYMBOL,
                '_SD_',
                12345.123456,
                NumberFormatter::DECIMAL
            ),
            'MONETARY_GROUPING_SEPARATOR_SYMBOL' => array(
                NumberFormatter::MONETARY_GROUPING_SEPARATOR_SYMBOL,
                '_MG_',
                12345.123456,
                NumberFormatter::CURRENCY
            ),
            'MONETARY_GROUPING_SEPARATOR_SYMBOL-2' => array(
                NumberFormatter::MONETARY_GROUPING_SEPARATOR_SYMBOL,
                "&nbsp;",
                12345.123456,
                NumberFormatter::CURRENCY
            ),
            'MONETARY_GROUPING_SEPARATOR_SYMBOL-3' => array(
                NumberFormatter::MONETARY_GROUPING_SEPARATOR_SYMBOL,
                $longstr,
                12345.123456,
                NumberFormatter::CURRENCY
            ),
        );

        $res_str = '';

        foreach ($symbols as $symb_name => $data) {
            list($symb, $new_val, $number, $attr) = $data;

            $fmt = new NumberFormatter('en_US', $attr);

            $res_str .= "\nSymbol '$symb_name'\n";

            // Get original symbol value.
            $orig_val = $fmt->getSymbol($symb);
            $res_str .= "Default symbol: [$orig_val]\n";

            // Set a new symbol value.
            $res_val = $fmt->setSymbol($symb, $new_val);
            if (!$res_val) {
                $res_str .= "set_symbol() error: " . $fmt->getErrorMessage() . "\n";
            }

            // Get the symbol value back.
            $new_val_check = $fmt->getSymbol($symb);
            if (!$new_val_check) {
                $res_str .= "get_symbol() error: " . $fmt->getErrorMessage() . "\n";
            }

            $res_str .= "New symbol: [$new_val_check]\n";

            // Check if the new value has been set.
            if ($new_val_check !== $new_val) {
                $res_str .= "ERROR: New $symb_name symbol value has not been set correctly.\n";
            }

            // Format the number using the new value.
            $s = $fmt->format($number);
            $res_str .= "A number formatted with the new symbol: $s\n";

            // Restore attribute's symbol.
            $fmt->setSymbol($symb, $orig_val);
        }
        $badvals = array(2147483648, -2147483648, -1, 4294901761);
        foreach ($badvals as $badval) {
            if ($fmt->getSymbol(2147483648)) {
                $res_str .= "Bad value $badval should return false!\n";
            }
        }
        debug($res_str);
    }

}
*/
function dump($val)
{
    return var_export($val, true);
}