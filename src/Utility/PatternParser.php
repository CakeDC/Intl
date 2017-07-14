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
            'yyyy' => 'Y',
            'yy' => 'y',
            'y' => 'Y',
            'Y' => 'Y',
            'MMMM' => 'F',
            'MMM' => 'M',
            'MM' => 'm',
            'M' => 'n',
            'LLLL' => 'F',
            'LLL' => 'M',
            'LL' => 'm',
            'L' => 'n',
            'ww' => 'W',
            'w' => 'W',
            'dd' => 'd',
            'd' => 'j',
            'D' => 'z',
            'EEEE' => 'l',
            'EEE' => 'D',
            'EE' => 'D',
            'E' => 'D',
            'eeee' => 'l',
            'eee' => 'D',
            'ee' => 'N',
            'e' => 'N',
            'cccc' => 'l',
            'ccc' => 'D',
            'cc' => 'N',
            'c' => 'N',
            'a' => 'A',
            'hh' => 'h',
            'h' => 'g',
            'HH' => 'H',
            'H' => 'G',
            'mm' => 'i',
            'm' => 'm', //
            'ss' => 's',
            's' => 's',
            'SSSS' => 'u',
            'SSS' => 'u',
            'SS' => 'u',
            'S' => 'u',
            'A' => 'v',
            'zzzz' => 'e',
            'zzz' => 'e',
            'zz' => 'e',
            'z' => 'e',
        ];

    private $exceptions =
        [
            'GGGGG',
            'GGGGG',
            'GGGG',
            'GGG',
            'GG',
            'G',
            'u',
            'U',
            'r',
            'QQQQQ',
            'QQQQ',
            'QQQ',
            'QQ',
            'Q',
            'qqqqq',
            'qqqq',
            'qqq',
            'qq',
            'q',
            'MMMMM',
            'LLLLL',
            'W',
            'F',
            'g',
            'EEEEEE',
            'EEEEE',
            'eeeeee',
            'eeeee',
            'cccccc',
            'ccccc',
            'kk',
            'k',
            'KK',
            'K',
            'ZZZZZ',
            'ZZZZ',
            'ZZZ',
            'ZZ',
            'Z',
            'OOOO',
            'O',
            'VVVV',
            'vvvv',
            'XXXXX',
            'v',
            'VV',
            'VVV',
            'XXXXX',
            'XXXX',
            'XXX',
            'XX',
            'X',
            'xxxxx',
            'xxxx',
            'xxx',
            'xx',
            'x',
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
        $date = '';

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
        return $escape . implode($escape, $chars);
    }

    /**
     * @param $string
     * @return mixed
     */
    protected function parse($string)
    {
        $matched = [];

        foreach ($this->exceptions as $exception) {
            $pos = strpos($string, $exception);
            if ($pos !== false) {
                throw new \Exception("This library does not implement the $exception sybmol, install intl extention to use http://php.net/manual/en/book.intl.php");
                break;
            }
        }

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