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
namespace CakeDC\Intl;


class NumberFormatter
{
    const DECIMAL = 1;
    const MIN_FRACTION_DIGITS = 7;
    const MAX_FRACTION_DIGITS = 6;
    const TYPE_DOUBLE = 3;
    const CURRENCY = 2;
    const CURRENCY_CODE = 5;
    const ORDINAL = 6;
    const PERCENT = 3;


    public function __construct($locale, $style, $pattern = null)
    {

    }

    public function setAttribute($attr, $value)
    {

    }

    public function format($value, $type = null)
    {
        return $value;

    }

    public function parse($value, $type = null, &$position = null)
    {

    }

}