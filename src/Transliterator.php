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

    public $id = 'Any-Latin; Latin-ASCII; [\u0080-\u7fff] remove';

    private $transliteration = [
        '/À|Á|Â|Ã|Å|Ǻ|Ā|Ă|Ą|Ǎ|Α/' => 'A',
        '/Æ|Ǽ/' => 'AE',
        '/Ä/' => 'Ae',
        '/Β/' => 'B',
        '/Ç|Ć|Ĉ|Ċ|Č/' => 'C',
        '/Ð|Ď|Đ|Δ/' => 'D',
        '/È|É|Ê|Ë|Ē|Ĕ|Ė|Ę|Ě|Ε/' => 'E',
        '/Ĝ|Ğ|Ġ|Ģ|Ґ|Γ/' => 'G',
        '/Ĥ|Ħ/' => 'H',
        '/Ì|Í|Î|Ï|Ĩ|Ī|Ĭ|Ǐ|Į|İ|І/' => 'I',
        '/Ĳ/' => 'IJ',
        '/Ĵ/' => 'J',
        '/Ķ|Κ/' => 'K',
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
        '/Ź|Ż|Ž|Ζ/' => 'Z',
        '/ά|à|á|â|ã|å|ǻ|ā|ă|ą|ǎ|ª|α/' => 'a',
        '/ä|æ|ǽ/' => 'ae',
        '/ç|ć|ĉ|ċ|č/' => 'c',
        '/ð|ď|đ/' => 'd',
        '/è|é|ê|ë|ē|ĕ|ė|ę|ě|ε/' => 'e',
        '/ƒ/' => 'f',
        '/ĝ|ğ|ġ|ģ|ґ|γ|δ/' => 'g',
        '/ĥ|ħ/' => 'h',
        '/ì|í|î|ï|ĩ|ī|ĭ|ǐ|į|ı|і|ι|ί/' => 'i',
        '/ĳ/' => 'ij',
        '/ĵ/' => 'j',
        '/ķ/' => 'k',
        '/ĺ|ļ|ľ|ŀ|ł|λ/' => 'l',
        '/ñ|ń|ņ|ň|ŉ|ν/' => 'n',
        '/ò|ó|ô|õ|ō|ŏ|ǒ|ő|ơ|ø|ǿ|º|ο/' => 'o',
        '/ö|œ/' => 'oe',
        '/ŕ|ŗ|ř/' => 'r',
        '/ś|ŝ|ş|ș|š|ſ|ς|σ/' => 's',
        '/ß/' => 'ss',
        '/ţ|ț|ť|ŧ|τ/' => 't',
        '/þ/' => 'th',
        '/ù|ú|û|ũ|ū|ŭ|ů|ű|ų|ư|ǔ|ǖ|ǘ|ǚ|ǜ/' => 'u',
        '/ü/' => 'ue',
        '/ŵ/' => 'w',
        '/ý|ÿ|ŷ/' => 'y',
        '/є/' => 'ye',
        '/ї/' => 'yi',
        '/ź|ż|ž|ζ/' => 'z',
    ];

    final private function __construct()
    {

    }

    public static function create($id, $direction = null)
    {
        $instance = new self();
        $instance->$id = $id;
        return $instance;
    }

    public static function createFromRules($rules, $direction = null)
    {
        trigger_error('Transliterator::createFromRules not yet implemented');
        $instance = new self();
        $instance->buildRules($instance, $rules);

    }

    private function buildRules($instance, $rules)
    {

    }

    public static function listIDs()
    {
        trigger_error('Transliterator::listIDs not yet implemented');
        $instance = new self();

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