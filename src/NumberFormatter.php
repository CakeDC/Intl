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
    const PATTERN_DECIMAL = 0;
    const PERCENT = 3;
    const SCIENTIFIC = 4;
    const SPELLOUT = 5;
    const DURATION = 7;
    const PATTERN_RULEBASED = 9;
    const IGNORE = 0;
    const DEFAULT_STYLE = 1;
    const ROUND_CEILING = 0;
    const ROUND_FLOOR = 1;
    const ROUND_DOWN = 2;
    const ROUND_UP = 3;
    const ROUND_HALFEVEN = 4;
    const ROUND_HALFDOWN = 5;
    const ROUND_HALFUP = 6;
    const PAD_BEFORE_PREFIX = 0;
    const PAD_AFTER_PREFIX = 1;
    const PAD_BEFORE_SUFFIX = 2;
    const PAD_AFTER_SUFFIX = 3;
    const PARSE_INT_ONLY = 0;
    const GROUPING_USED = 1;
    const DECIMAL_ALWAYS_SHOWN = 2;
    const MAX_INTEGER_DIGITS = 3;
    const MIN_INTEGER_DIGITS = 4;
    const INTEGER_DIGITS = 5;
    const FRACTION_DIGITS = 8;
    const MULTIPLIER = 9;
    const GROUPING_SIZE = 10;
    const ROUNDING_MODE = 11;
    const ROUNDING_INCREMENT = 12;
    const FORMAT_WIDTH = 13;
    const PADDING_POSITION = 14;
    const SECONDARY_GROUPING_SIZE = 15;
    const SIGNIFICANT_DIGITS_USED = 16;
    const MIN_SIGNIFICANT_DIGITS = 17;
    const MAX_SIGNIFICANT_DIGITS = 18;
    const LENIENT_PARSE = 19;
    const POSITIVE_PREFIX = 0;
    const POSITIVE_SUFFIX = 1;
    const NEGATIVE_PREFIX = 2;
    const NEGATIVE_SUFFIX = 3;
    const PADDING_CHARACTER = 4;
    const DEFAULT_RULESET = 6;
    const PUBLIC_RULESETS = 7;
    const DECIMAL_SEPARATOR_SYMBOL = 0;
    const GROUPING_SEPARATOR_SYMBOL = 1;
    const PATTERN_SEPARATOR_SYMBOL = 2;
    const PERCENT_SYMBOL = 3;
    const ZERO_DIGIT_SYMBOL = 4;
    const DIGIT_SYMBOL = 5;
    const MINUS_SIGN_SYMBOL = 6;
    const PLUS_SIGN_SYMBOL = 7;
    const CURRENCY_SYMBOL = 8;
    const INTL_CURRENCY_SYMBOL = 9;
    const MONETARY_SEPARATOR_SYMBOL = 10;
    const EXPONENTIAL_SYMBOL = 11;
    const PERMILL_SYMBOL = 12;
    const PAD_ESCAPE_SYMBOL = 13;
    const INFINITY_SYMBOL = 14;
    const NAN_SYMBOL = 15;
    const SIGNIFICANT_DIGIT_SYMBOL = 16;
    const MONETARY_GROUPING_SEPARATOR_SYMBOL = 17;
    const TYPE_DEFAULT = 0;
    const TYPE_INT32 = 1;
    const TYPE_INT64 = 2;
    const TYPE_CURRENCY = 4;

    private $pattern;
    private $locale;
    private $style;
    private $errorCode;
    private $errorMessage;


    private $methods = [
        self::DECIMAL => 'Decimal',
        self::CURRENCY => 'Currency',
        self::PERCENT => 'Percent',
        self::SPELLOUT => 'Spellout',
        self::ORDINAL => 'Ordinal',
    ];


    public function __construct($locale, $style, $pattern = null)
    {
        $this->locale = Locale::parseLocale($locale);
        $this->style = $style;
        $this->pattern = $pattern;

    }

    public static function create($locale, $style, $pattern = null)
    {
        return new self($locale, $style, $pattern);
    }

    public function format($value, $type = null)
    {
        if ($type) {
            if (isset($this->methods[$type]) && is_callable($this->methods[$type], 'format')) {
                $class = "CakeDC\Intl\Utility\Number\\" . $this->methods[$type];
                $fmt = new $class($value);
                return $fmt->format();
            } else {
                return;
            }
        }
        $class = "CakeDC\Intl\Utility\Number\\" . $this->methods[$this->style];
        $fmt = new $class($value);
        return $fmt->format($value);
    }

    public function parse($value, $type = null, &$position = null)
    {

    }

    public function formatCurrency($value, $currency)
    {
    }

    public function parseCurrency($value, &$currency, &$position = null)
    {
    }

    public function setAttribute($attr, $value)
    {

    }

    public function setTextAttribute($attr, $value)
    {
    }

    public function setSymbol($attr, $value)
    {
    }

    public function getAttribute($attr)
    {
    }

    public function getTextAttribute($attr)
    {
    }

    public function getSymbol($attr)
    {
    }

    public function getPattern()
    {
    }

    public function setPattern($pattern)
    {
        $this->pattern = $pattern;
    }

    public function getLocale($type = null)
    {
    }

    public function getErrorCode()
    {
        return $this->errorCode;
    }

    public function getErrorMessage()
    {
        return $this->errorMessage;
    }

    private function decimal($number)
    {
        return floatval($number);
    }
}
