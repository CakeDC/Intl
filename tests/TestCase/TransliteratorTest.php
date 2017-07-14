<?php
/**
 * Copyright 2017, Cake Development Corporation (http:cakedc.com)
 *
 * Licensed under The MIT License
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright Copyright 2017, Cake Development Corporation (http:cakedc.com)
 * @link https:www.cakedc.com
 * @license MIT License (http:www.opensource.orglicensesmit-license.php)
 */

namespace CakeDC\Intl\TestCase;

use PHPUnit_Framework_TestCase;
use Transliterator;


class TransliteratorTest extends PHPUnit_Framework_TestCase
{
    public function setUp()
    {
        parent::setUp();
    }

    /**
     * @dataProvider providerTransliterationChars
     */

    public function testTransliteratorTransliterateMethod($characters, $transliterated)
    {
        $actual = transliterator_transliterate($characters, null);
        $this->assertSame($transliterated, $actual);
    }

    /**
     * @dataProvider providerTransliterationChars
     */

    public function testTransliteratorTransliterate($characters, $transliterated)
    {
        $fmt = Transliterator::create($characters);
        $actual = $fmt->transliterate($characters, null);
        $this->assertSame($transliterated, $actual);
    }

    public function providerTransliterationChars()
    {
        return [
            [
                'À|Á|Â|Ã|Å|Ǻ|Ā|Ă|Ą|Ǎ',
                'A|A|A|A|A|A|A|A|A|A',
            ],
            [
                'Æ|Ǽ',
                'AE|AE',
            ],
            [
                'Ä',
                'Ae',
            ],
            [
                'Ç|Ć|Ĉ|Ċ|Č',
                'C|C|C|C|C',
            ],
            [
                'Ð|Ď|Đ',
                'D|D|D',
            ],
            [
                'È|É|Ê|Ë|Ē|Ĕ|Ė|Ę|Ě',
                'E|E|E|E|E|E|E|E|E',
            ],
            [
                'Ĝ|Ğ|Ġ|Ģ|Ґ',
                'G|G|G|G|G',
            ],
            [
                'Ĥ|Ħ',
                'H|H',
            ],
            [
                'Ì|Í|Î|Ï|Ĩ|Ī|Ĭ|Ǐ|Į|İ|І',
                'I|I|I|I|I|I|I|I|I|I|I',
            ],
            [
                'Ĳ',
                'IJ',
            ],
            [
                'Ĵ',
                'J',
            ],
            [
                'Ķ',
                'K',
            ],
            [
                'Ĺ|Ļ|Ľ|Ŀ|Ł',
                'L|L|L|L|L',
            ],
            [
                'Ñ|Ń|Ņ|Ň',
                'N|N|N|N',
            ],
            [
                'Ò|Ó|Ô|Õ|Ō|Ŏ|Ǒ|Ő|Ơ|Ø|Ǿ',
                'O|O|O|O|O|O|O|O|O|O|O',
            ],
            [
                'Œ',
                'OE',
            ],
            [
                'Ö',
                'Oe',
            ],
            [
                'Ŕ|Ŗ|Ř',
                'R|R|R',
            ],
            [
                'Ś|Ŝ|Ş|Ș|Š',
                'S|S|S|S|S',
            ],
            [
                'ẞ',
                'SS',
            ],
            [
                'Ţ|Ț|Ť|Ŧ',
                'T|T|T|T',
            ],
            [
                'Þ',
                'TH',
            ],
            [
                'Ù|Ú|Û|Ũ|Ū|Ŭ|Ů|Ű|Ų|Ư|Ǔ|Ǖ|Ǘ|Ǚ|Ǜ',
                'U|U|U|U|U|U|U|U|U|U|U|U|U|U|U',
            ],
            [
                'Ü',
                'Ue',
            ],
            [
                'Ŵ',
                'W',
            ],
            [
                'Ý|Ÿ|Ŷ',
                'Y|Y|Y',
            ],
            [
                'Є',
                'Ye',
            ],
            [
                'Ї',
                'Yi',
            ],
            [
                'Ź|Ż|Ž',
                'Z|Z|Z',
            ],
            [
                'à|á|â|ã|å|ǻ|ā|ă|ą|ǎ|ª',
                'a|a|a|a|a|a|a|a|a|a|a',
            ],
            [
                'ä|æ|ǽ',
                'ae|ae|ae',
            ],
            [
                'ç|ć|ĉ|ċ|č',
                'c|c|c|c|c',
            ],
            [
                'ð|ď|đ',
                'd|d|d',
            ],
            [
                'è|é|ê|ë|ē|ĕ|ė|ę|ě',
                'e|e|e|e|e|e|e|e|e',
            ],
            [
                'ƒ',
                'f',
            ],
            [
                'ĝ|ğ|ġ|ģ|ґ',
                'g|g|g|g|g',
            ],
            [
                'ĥ|ħ',
                'h|h',
            ],
            [
                'ì|í|î|ï|ĩ|ī|ĭ|ǐ|į|ı|і',
                'i|i|i|i|i|i|i|i|i|i|i',
            ],
            [
                'ĳ',
                'ij',
            ],
            [
                'ĵ',
                'j',
            ],
            [
                'ķ',
                'k',
            ],
            [
                'ĺ|ļ|ľ|ŀ|ł',
                'l|l|l|l|l',
            ],
            [
                'ñ|ń|ņ|ň|ŉ',
                'n|n|n|n|n',
            ],
            [
                'ò|ó|ô|õ|ō|ŏ|ǒ|ő|ơ|ø|ǿ|º',
                'o|o|o|o|o|o|o|o|o|o|o|o',
            ],
            [
                'ö|œ',
                'oe|oe',
            ],
            [
                'ŕ|ŗ|ř',
                'r|r|r',
            ],
            [
                'ś|ŝ|ş|ș|š|ſ',
                's|s|s|s|s|s',
            ],
            [
                'ß',
                'ss',
            ],
            [
                'ţ|ț|ť|ŧ',
                't|t|t|t',
            ],
            [
                'þ',
                'th',
            ],
            [
                'ù|ú|û|ũ|ū|ŭ|ů|ű|ų|ư|ǔ|ǖ|ǘ|ǚ|ǜ',
                'u|u|u|u|u|u|u|u|u|u|u|u|u|u|u',
            ],
            [
                'ü',
                'ue',
            ],
            [
                'ŵ',
                'w',
            ],
            [
                'ý|ÿ|ŷ',
                'y|y|y',
            ],
            [
                'є',
                'ye',
            ],
            [
                'ї',
                'yi',
            ],
            [
                'ź|ż|ž',
                'z|z|z',
            ],
        ];
    }
}