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

use IntlDateFormatter;
use Locale;
use NumberFormatter;

class MessageFormatter
{
    private $locale = 'en_US';
    private $pattern;
    private $errorCode = false;
    private $errorMessage = null;


    public function __construct($locale, $pattern)
    {
        $this->locale = $locale;
        $this->pattern = $pattern;
    }

    public static function formatMessage($locale, $pattern, array $args)
    {
        Locale::parseLocale($locale);


        if (stripos($pattern, 'number,')) {
            $x = explode('}', $pattern, 2);
            $pattern = '0' . $x[1];
            $args[0] = number_format($args[0], 2);
        }

        $count = count($args) - 1;
        $i = 0;

        do {
            $pattern = str_replace("{$count}", $args[$i], $pattern);
        } while ($i > $count);
        return $pattern;
    }

    public static function create($locale, $pattern)
    {

    }

    public static function parseMessage($locale, $pattern, $source)
    {

    }

    public function format(array $args)
    {
        $methods =
            [
                'number',
                'date',
                'time',
                'plural',
                'ordinal',
                'duration',
                'spellout',
                'select',
                'selectordinal',

            ];
        $return = [];

        if (preg_match_all('/{(?<match>[^\\}]+)}/uiUsm', $this->getPattern(), $found)) {
            foreach ($found['match'] as $key => $value) {
                foreach ($methods as $key1 => $method) {
                    if (strpos($value, $method) !== false) {
                        $pattern = explode("$method,", $value);
                        $return[] = $this->{$method}($args, $pattern[1]);
                        break;
                    }
                }
            }
            return implode(' ', $return);
        }


    }

    public function getPattern()
    {
        return $this->pattern;
    }

    public function setPattern($pattern)
    {
        $this->pattern = $pattern;
    }

    public function getLocale()
    {
        return $this->locale;
    }

    public function getErrorCode()
    {
        return $this->errorCode;
    }

    public function getErrorMessage()
    {
        return $this->errorMessage;
    }

    public function parse($value)
    {

    }

    protected function number($number, $type)
    {
        $type = ['none', 'interger', 'currency', 'percent', 'argStyleText',];

        $Num = new NumberFormatter();
        return $Num->format($number, $type);

    }

    protected function date($timestamp, $type)
    {
        $type = strtoupper($type);
        $type = constant("IntlDateFormatter::$type");

        $Date = new IntlDateFormatter('en_US', $type, IntlDateFormatter::NONE);
        return $Date->format($timestamp[0]);
    }

    protected function time($timestamp, $pattern)
    {
        $Date = new IntlDateFormatter('en_US', IntlDateFormatter::NONE, IntlDateFormatter::NONE);
        $Date->setPattern($pattern);
        return $Date->format($timestamp[0]);
    }

    protected function plural()
    {
        //' => 7,
    }

    protected function ordinal($number)
    {
        $number .= (($j = abs($number) % 100) > 10 && $j < 14 ? 'th' : ['th', 'st', 'nd', 'rd'][$j % 10] ?: 'th');
        return $number;
    }

    protected function duration($number)
    {
        $type = ['argStyleText',];

        $Num = new NumberFormatter();
        return $Num->format($number, $type);
    }

    protected function spellout($number)
    {
        $type = ['argStyleText',];

        $Num = new NumberFormatter();
        return $Num->format($number, $type);
    }
    protected function select()
    {
        //' => 9,
    }

    protected function selectordinal()
    {
        //' => 8,
    }

}