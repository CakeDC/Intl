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


class Transliterator
{

    const FORWARD = 0;
    const REVERSE = 1;

    public $id;

    private $transliteration = array(
        '/À|Á|Â|Ã|Å|Ǻ|Ā|Ă|Ą|Ǎ/' => 'A',
        '/Æ|Ǽ/' => 'AE',
        '/Ä/' => 'Ae',
        '/Ç|Ć|Ĉ|Ċ|Č/' => 'C',
        '/Ð|Ď|Đ/' => 'D',
        '/È|É|Ê|Ë|Ē|Ĕ|Ė|Ę|Ě/' => 'E',
        '/Ĝ|Ğ|Ġ|Ģ|Ґ/' => 'G',
        '/Ĥ|Ħ/' => 'H',
        '/Ì|Í|Î|Ï|Ĩ|Ī|Ĭ|Ǐ|Į|İ|І/' => 'I',
        '/Ĳ/' => 'IJ',
        '/Ĵ/' => 'J',
        '/Ķ/' => 'K',
        '/Ĺ|Ļ|Ľ|Ŀ|Ł/' => 'L',
        '/Ñ|Ń|Ņ|Ň/' => 'N',
        '/Ò|Ó|Ô|Õ|Ō|Ŏ|Ǒ|Ő|Ơ|Ø|Ǿ/' => 'O',
        '/Œ/' => 'OE',
        '/Ö/' => 'Oe',
        '/Ŕ|Ŗ|Ř/' => 'R',
        '/Ś|Ŝ|Ş|Ș|Š/' => 'S',
        '/ẞ/' => 'SS',
        '/Ţ|Ț|Ť|Ŧ/' => 'T',
        '/Þ/' => 'TH',
        '/Ù|Ú|Û|Ũ|Ū|Ŭ|Ů|Ű|Ų|Ư|Ǔ|Ǖ|Ǘ|Ǚ|Ǜ/' => 'U',
        '/Ü/' => 'Ue',
        '/Ŵ/' => 'W',
        '/Ý|Ÿ|Ŷ/' => 'Y',
        '/Є/' => 'Ye',
        '/Ї/' => 'Yi',
        '/Ź|Ż|Ž/' => 'Z',
        '/à|á|â|ã|å|ǻ|ā|ă|ą|ǎ|ª/' => 'a',
        '/ä|æ|ǽ/' => 'ae',
        '/ç|ć|ĉ|ċ|č/' => 'c',
        '/ð|ď|đ/' => 'd',
        '/è|é|ê|ë|ē|ĕ|ė|ę|ě/' => 'e',
        '/ƒ/' => 'f',
        '/ĝ|ğ|ġ|ģ|ґ/' => 'g',
        '/ĥ|ħ/' => 'h',
        '/ì|í|î|ï|ĩ|ī|ĭ|ǐ|į|ı|і/' => 'i',
        '/ĳ/' => 'ij',
        '/ĵ/' => 'j',
        '/ķ/' => 'k',
        '/ĺ|ļ|ľ|ŀ|ł/' => 'l',
        '/ñ|ń|ņ|ň|ŉ/' => 'n',
        '/ò|ó|ô|õ|ō|ŏ|ǒ|ő|ơ|ø|ǿ|º/' => 'o',
        '/ö|œ/' => 'oe',
        '/ŕ|ŗ|ř/' => 'r',
        '/ś|ŝ|ş|ș|š|ſ/' => 's',
        '/ß/' => 'ss',
        '/ţ|ț|ť|ŧ/' => 't',
        '/þ/' => 'th',
        '/ù|ú|û|ũ|ū|ŭ|ů|ű|ų|ư|ǔ|ǖ|ǘ|ǚ|ǜ/' => 'u',
        '/ü/' => 'ue',
        '/ŵ/' => 'w',
        '/ý|ÿ|ŷ/' => 'y',
        '/є/' => 'ye',
        '/ї/' => 'yi',
        '/ź|ż|ž/' => 'z',
    );

    final private function __construct($id)
    {
        $this->id = $id;
    }

    public static function create($id, $direction = null)
    {
        return new Transliterator($id);
    }

    public static function createFromRules($rules, $direction = null)
    {
        trigger_error('Transliterator::createFromRules not yet implemented');
    }

    public static function listIDs()
    {
        trigger_error('Transliterator::listIDs not yet implemented');
    }

    public function transliterate($subject, $start = null, $end = null)
    {
        return preg_replace(array_keys($this->transliteration), array_values($this->transliteration), $subject);
    }

    public function createInverse()
    {
        trigger_error('Transliterator::createInverse not yet implemented');
    }

    public function getErrorCode()
    {
        trigger_error('Transliterator::getErrorCode not yet implemented');
    }

    public function getErrorMessage()
    {
        trigger_error('Transliterator::getErrorMessage not yet implemented');
    }
}