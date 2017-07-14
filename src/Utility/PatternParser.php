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

namespace CakeDC\Intl\Utility;


class PatternParser
{
    /**
     * @var array
     */
    private $symbols =
        [
            'GGGGG' => 'A',
            'GGGGG' => 'A',
            'GGGG' => 'Anno Domini',
            'GGG' => 'AD',
            'GG' => 'AD',
            'G' => 'AD',
            'yyyy' => 'Y',
            'yy' => 'y',
            'y' => 'Y',
            'Y' => 'Y',
            'u' => 'Exception',
            'U' => 'Exception',
            'r' => 'Exception',
            'QQQQQ' => 'Exception',
            'QQQQ' => 'Exception',
            'QQQ' => 'Exception',
            'QQ' => 'Exception',
            'Q' => 'Exception',
            'qqqqq' => 'Exception',
            'qqqq' => 'Exception',
            'qqq' => 'Exception',
            'qq' => 'Exception',
            'q' => 'Exception',
            'MMMMM',
            'MMMM' => 'F',
            'MMM' => 'M',
            'MM' => 'm',
            'M' => 'n',
            'LLLLL',
            'LLLL' => 'F',
            'LLL' => 'M',
            'LL' => 'm',
            'L' => 'n',
            'ww' => 'W',
            'w' => 'W',
            'W',
            'dd' => 'd',
            'd' => 'j',
            'D' => 'z',
            'F',
            'g',
            'EEEEEE',
            'EEEEE',
            'EEEE' => 'l',
            'EEE' => 'D',
            'EE' => 'D',
            'E' => 'D',
            'eeeeee',
            'eeeee',
            'eeee' => 'l',
            'eee' => 'D',
            'ee' => 'N',
            'e' => 'N',
            'cccccc',
            'ccccc',
            'cccc' => 'l',
            'ccc' => 'D',
            'cc' => 'N',
            'c' => 'N',
            'a' => 'a',
            'hh' => 'h',
            'h' => 'g',
            'HH' => 'H',
            'H' => 'G',
            'kk' => 'Not Implemented',
            'k' => 'Not Implemented',
            'KK' => 'Not Implemented',
            'K' => 'Not Implemented',
            'mm' => 'Not Implemented',
            'm' => 'Not Implemented',
            'ss' => 'Not Implemented',
            's' => 'Not Implemented',
            'SSSS' => 'Not Implemented',
            'SSS' => 'Not Implemented',
            'SS' => 'Not Implemented',
            'S' => 'Not Implemented',
            'A' => 'Not Implemented',
            'zzzz' => 'Not Implemented',
            'zzz' => 'Not Implemented',
            'zz' => 'Not Implemented',
            'z' => 'Not Implemented',
            'ZZZZ' => 'Not Implemented',
            'ZZZ' => 'Not Implemented',
            'ZZ' => 'Not Implemented',
            'Z' => 'Not Implemented',
            'OOOO' => 'Not Implemented',
            'VVVV' => 'Not Implemented',
            'vvvv' => 'Not Implemented',
            'ZZZZZ' => 'Not Implemented',
            'XXXXX' => 'Not Implemented',
            'O' => 'Not Implemented',
            'OOOO' => 'Not Implemented',
            'v' => 'Not Implemented',
            'VV' => 'Not Implemented',
            'VVV' => 'Not Implemented',
            'XXXXX' => 'Not Implemented',
            'XXXX' => 'Not Implemented',
            'XXX' => 'Not Implemented',
            'XX' => 'Not Implemented',
            'X' => 'Not Implemented',
            'xxxxx' => 'Not Implemented',
            'xxxx' => 'Not Implemented',
            'xxx' => 'Not Implemented',
            'xx' => 'Not Implemented',
            'x' => 'Not Implemented',
        ];
    /**
     * @var
     */
    private $pattern;

    /**
     * PatternParser constructor.
     * @param $pattern
     */
    public function __construct($pattern)
    {
        $this->setPattern($pattern);
    }

    /**
     * @return mixed
     */
    public function getPattern()
    {
        return $this->pattern;
    }

    /**
     * @param $pattern
     */
    public function setPattern($pattern)
    {
        $this->pattern = $pattern;
    }

    /**
     * @return mixed|string
     */
    public function format()
    {
        $string = $this->pattern;

        if (preg_match('/\'(?<match>[^\']+)\'(?<date>[^\'.]+)/uism', $string, $found)) {
            $string = $this->escapeString($found['match']);
            if (isset($found['date'])) {
                $date = $this->parse($found['date']);
            } else {
                trigger_error('No date format found in string');
            }
            return $string . ' ' . $date;
        }
        return $this->parse($string);
    }

    /**
     * This method will be made protected in future releases.
     * @param $string
     * @return string
     */
    public function escapeString($string)
    {
        $escape = '\\';
        $chars = str_split($string);
        return $escape . implode($escape, $chars);;
    }

    /**
     * @param $string
     * @return mixed
     */
    protected function parse($string)
    {
        $matched = [];

        foreach ($this->symbols as $match => $replace) {

            $pos = strpos($string, $match);


            if ($pos !== false && !in_array($match, $matched)) {
                $matched[] = $replace;
                $string = str_replace($match, $replace, $string);
            }
        }
        return $this->pattern = $string;
    }
}