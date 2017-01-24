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

//use CakeDC\Intl\IntlGregorianCalendar as IntlGregorianCalendar;
//use CakeDC\Intl\MessageFormatter as MessageFormatter;
use DateTime;
use DateTimeZone;
use IntlGregorianCalendar;
use MessageFormatter;
use PHPUnit_Framework_TestCase;

class MessageFormatterTest extends PHPUnit_Framework_TestCase
{

    public function setUp()
    {
        parent::setUp();
    }

    public function testClassInstanceMessageFormatterFormater()
    {
        $c = New MessageFormatter('en_US', '{0}');
        $this->assertInstanceOf('MessageFormatter', $c);
        $this->assertEquals('en_US', $c->getLocale());
        $this->assertEquals('{0}', $c->getPattern());
    }

    public function testOrdinalMessageFormatterFormat()
    {
        $msgf = new MessageFormatter('en_US', "{0,number} -- {1,ordinal}");
        $x = $msgf->format(array(1.3, 1.3));
        $y = $msgf->format(array(1.3, 1.3));
        $msgf->setPattern("{0,ordinal} -- {1,number}");
        $z = $msgf->format(array(1.3, 1.3));
        $this->assertEquals($x, "1.3 -- 1st");
        $this->assertEquals($y, "1.3 -- 1st");
        $this->assertEquals($z, "1st -- 1.3");

    }

    public function testSelectordinalMessageFormatterFormater()
    {
        $locale = array("de", "fr", "en", "ru",);
        $data = array(42, 42.42, 2147483643, 2147483643.12345, 5);
        $string = array('de' => array("42-other", "42,42-other", "2.147.483.643-other", "2.147.483.643,123-other", "five"),
            'fr' => array("42-other", "42,42-other", "2 147 483 643-other", "2 147 483 643,123-other", "five"),
            'en' => array("42-two", "42.42-other", "2,147,483,643-few", "2,147,483,643.123-other", "five"),
            'ru' => array("42-other", "42,42-other", "2 147 483 643-other", "2 147 483 643,123-other", "five"),);

        $numeric = array('de' => array("42-other", "42,42-other", "2.147.483.643-other", "2.147.483.643,123-other", "five"),
            'fr' => array("42-other", "42,42-other", "2 147 483 643-other", "2 147 483 643,123-other", "five"),
            'en' => array("42-two", "42.42-other", "2,147,483,643-few", "2,147,483,643.123-other", "five"),
            'ru' => array("42-other", "42,42-other", "2 147 483 643-other", "2 147 483 643,123-other", "five"),);

        foreach ($locale as $lc) {
            $msgf = new MessageFormatter($lc, "{n, selectordinal, =5 {five} zero {#-zero} one {#-one} two {#-two} few {#-few} many {#-many} other {#-other}}");
            $count = 0;
            foreach ($data as $i) {
                $this->assertEquals($string[$lc][$count], $msgf->format(array("n" => $i)));
                $count++;
            }
            $count = 0;
            $msgf = new MessageFormatter($lc, "{0, selectordinal, =5 {five} zero {#-zero} one {#-one} two {#-two} few {#-few} many {#-many} other {#-other}}");
            foreach ($data as $i) {
                $this->assertEquals($numeric[$lc][$count], $msgf->format(array($i)));
                $count++;
            }
        }
    }

    function testDatetimeObjectMessageFormatterFormater()
    {
        $dt = new DateTime("2012-05-06 18:00:42", new DateTimeZone("Europe/Lisbon"));
        $msgf = new MessageFormatter('en_US', '{0,date} {0,time}');
        $result = $msgf->format(array($dt));
        $this->assertEquals("May 6, 2012 5:00:42 PM", $result);
    }

    function testInsufficientNumericArguments()
    {
        $msgf = new MessageFormatter('en_US', '{0} {1}');
        $result = $msgf->format(array(7));
        $this->assertEquals('7 {1}', $result);
    }

    function testMessageFormatAcceptsIntlCalendarArguments()
    {
        $zone = ini_get('date.timezone');
        ini_set('date.timezone', 'Europe/Lisbon');
        $cal = new IntlGregorianCalendar(2012, 04, 17, 17, 35, 36);
        $msgf = new MessageFormatter('pt_PT', '{0,date,full} {0,time,h:m:s a V}');
        $result = $msgf->format(array($cal));
        //$this->assertEquals('quinta-feira, 17 de Maio de 2012 5:35:36 da tarde ptlis', $result);
        $this->assertEquals('quinta-feira, 17 de maio de 2012 5:35:36 da tarde utc', $result);
        ini_set('date.timezone', $zone);
    }

    function testMixedNamedAndNumericParams()
    {
        $msgf = new MessageFormatter('en_US', "{0,number} -- {foo,ordinal}");
        $result = $msgf->format(array(2.3, "foo" => 1.3));
        $this->assertEquals('2.3 -- 1st', $result);
        $result = $msgf->format(array("foo" => 1.3, 0 => 2.3));
        $this->assertEquals('2.3 -- 1st', $result);
    }

    function testSimpleTypesHandlingWithNumericStrings()
    {
        $msgf = new MessageFormatter('en_US', "
        none      {a}
        number      {b,number}
        number integer      {c,number,integer}
        number currency      {d,number,currency}
        number percent      {e,number,percent}
        date      {f,date}
        time      {g,time}
        spellout      {h,spellout}
        ordinal      {i,ordinal}
        duration      {j,duration}");

        $ex = "1336317965.5 str";
        $result = $msgf->format(array(
            'a' => $ex,
            'b' => $ex,
            'c' => $ex,
            'd' => $ex,
            'e' => $ex,
            'f' => "  1336317965.5",
            'g' => "  1336317965.5",
            'h' => $ex,
            'i' => $ex,
            'j' => $ex,
        ));

        $expected = "
        none      1336317965.5 str
        number      1,336,317,965.5
        number integer      1,336,317,965
        number currency      $1,336,317,965.50
        number percent      133,631,796,550%
        date      May 6, 2012
        time      3:26:05 PM
        spellout      one billion three hundred thirty-six million three hundred seventeen thousand nine hundred sixty-five point five
        ordinal      1,336,317,966th
        duration      371,199:26:06";
        $this->assertEquals($expected, $result);


    }

    function testWithNamedSubpatterns()
    {
        $pattern = <<<_MSG_
{gender_of_host, select,
  female {{num_guests, plural, offset:1
      =0 {{host} does not give a party.}
      =1 {{host} invites {guest} to her party.}
      =2 {{host} invites {guest} and one other person to her party.}
     other {{host} invites {guest} as one of the # people invited to her party.}}}
  male   {{num_guests, plural, offset:1
      =0 {{host} does not give a party.}
      =1 {{host} invites {guest} to his party.}
      =2 {{host} invites {guest} and one other person to his party.}
     other {{host} invites {guest} as one of the # people invited to his party.}}}
  other {{num_guests, plural, offset:1
      =0 {{host} does not give a party.}
      =1 {{host} invites {guest} to their party.}
      =2 {{host} invites {guest} and one other person to their party.}
     other {{host} invites {guest} as one of the # people invited to their party.}}}}
_MSG_;


        $args = array(
            array('gender_of_host' => 'female', 'num_guests' => 0, 'host' => 'Alice', 'guest' => 'Bob'),
            array('gender_of_host' => 'male', 'num_guests' => 1, 'host' => 'Alice', 'guest' => 'Bob'),
            array('gender_of_host' => 'none', 'num_guests' => 2, 'host' => 'Alice', 'guest' => 'Bob'),
            array('gender_of_host' => 'female', 'num_guests' => 27, 'host' => 'Alice', 'guest' => 'Bob'),
        );

        $expected = array('Alice does not give a party.',
            'Alice invites Bob to his party.',
            'Alice invites Bob and one other person to their party.',
            'Alice invites Bob as one of the 26 people invited to her party.',);

        $msgf = new MessageFormatter('en_US', $pattern);
        $count = 0;
        foreach ($args as $arg) {
            $result = $msgf->format($arg);
            $this->assertEquals($expected[$count], $result);
            $result = $msgf->formatMessage('en_US', $pattern, $arg);
            $this->assertEquals($expected[$count], $result);
            $count++;
        }

    }

    function testWithSubpatterns()
    {
        $pattern = <<<_MSG_
{0, select,
  female {{1, plural, offset:1
      =0 {{2} does not give a party.}
      =1 {{2} invites {3} to her party.}
      =2 {{2} invites {3} and one other person to her party.}
     other {{2} invites {3} as one of the # people invited to her party.}}}
  male   {{1, plural, offset:1
      =0 {{2} does not give a party.}
      =1 {{2} invites {3} to his party.}
      =2 {{2} invites {3} and one other person to his party.}
     other {{2} invites {3} as one of the # other people invited to his party.}}}
  other {{1, plural, offset:1
      =0 {{2} does not give a party.}
      =1 {{2} invites {3} to their party.}
      =2 {{2} invites {3} and one other person to their party.}
      other {{2} invites {3} as one of the # other people invited to their party.}}}}
_MSG_;


        $args = array(
            array('female', 0, 'Alice', 'Bob'),
            array('male', 1, 'Alice', 'Bob'),
            array('none', 2, 'Alice', 'Bob'),
            array('female', 27, 'Alice', 'Bob'),
        );

        $expected = array('Alice does not give a party.',
            'Alice invites Bob to his party.',
            'Alice invites Bob and one other person to their party.',
            'Alice invites Bob as one of the 26 people invited to her party.',
        );

        $msgf = new MessageFormatter('en_US', $pattern);
        $count = 0;
        foreach ($args as $arg) {
            $result = $msgf->format($arg);
            $this->assertEquals($expected[$count], $result);
            $result = $msgf->formatMessage('en_US', $pattern, $arg);
            $this->assertEquals($expected[$count], $result);
            $count++;
        }
    }

    function testFormatNumberMiscLocalesPatterns()
    {
        $locales = array(
            'en_US' => "{0,number,integer} monkeys on {1,number,integer} trees make {2,number} monkeys per tree",
            'ru_UA' => "{0,number,integer} мавп на {1,number,integer} деревах це {2,number} мавпи на кожному деревi",
            'de' => "{0,number,integer} Affen über {1,number,integer} Bäume um {2,number} Affen pro Baum",
            'en_UK' => "{0,number,integer} monkeys on {1,number,integer} trees make {2,number} monkeys per tree",
            'fr' => "C'est la vie!",
        );

        $expected = array(
            'en_US' => "4,560 monkeys on 123 trees make 37.073 monkeys per tree",
            'ru_UA' => "4 560 мавп на 123 деревах це 37,073 мавпи на кожному деревi",
            'de' => "4.560 Affen über 123 Bäume um 37,073 Affen pro Baum",
            'en_UK' => "4,560 monkeys on 123 trees make 37.073 monkeys per tree",
            'fr' => "C'est la vie!",
        );

        $m = 4560;
        $t = 123;

        foreach ($locales as $locale => $pattern) {
            $msgf = new MessageFormatter($locale, $pattern);
            $result = $msgf->format(array($m, $t, $m / $t));
            $this->assertEquals($expected[$locale], $result);
            $result = $msgf->formatMessage($locale, $pattern, array($m, $t, $m / $t));
            $this->assertEquals($expected[$locale], $result);

        }
    }

    function testGetLocale()
    {
        $locales = array(
            'en_UK',
            'en_US@California',
            'uk',
        );

        foreach ($locales as $locale) {
            $msgf = new MessageFormatter($locale, 'Test');
            $result = $msgf->getLocale();
            $this->assertEquals($locale, $result);
        }

    }

    function testGetSetPattern()
    {
        $args = array(123, 456);

        $pattern = "{0,number} monkeys on {1,number} trees";
        $msgf = new MessageFormatter("en_US", "{0,number} monkeys on {1,number} trees");
        $expected = '123 monkeys on 456 trees';
        $result = $msgf->format($args);
        $this->assertEquals($expected, $result);

        $expected = $msgf->getPattern();
        $this->assertEquals($expected, $pattern);

        $newPattern = "{0,number} trees hosting {1,number} monkeys";
        $msgf->setPattern($newPattern);
        $expected = $msgf->getPattern();
        $this->assertEquals($expected, $newPattern);

        $expected = '123 trees hosting 456 monkeys';
        $result = $msgf->format($args);
        $this->assertEquals($expected, $result);

        $msgf->setPattern(str_repeat($newPattern, 10));
        $expected = $msgf->getPattern();
        $check = str_repeat($newPattern, 10);
        $this->assertEquals($expected, $check);

        $expected = '123 trees hosting 456 monkeys123 trees hosting 456 monkeys123 trees hosting 456 monkeys123 trees hosting 456 monkeys123 trees hosting 456 monkeys123 trees hosting 456 monkeys123 trees hosting 456 monkeys123 trees hosting 456 monkeys123 trees hosting 456 monkeys123 trees hosting 456 monkeys';
        $result = $msgf->format($args);
        $this->assertEquals($expected, $result);
    }

    function testParseFormatsDatesMillisecPrecission()
    {
        $msgf = new MessageFormatter('en_US',
            "On {0,time,yyyy-MM-dd G 'at' HH:mm:ss.SSS zzz} something odd happened");

        $expected = 'On 2012-05-06 AD at 13:22:49.123 GMT something odd happened';
        $result = $msgf->format(array(1336310569.123));
        $this->assertEquals($expected, $result);

        $expected = array(1336310569.123);
        $result = $msgf->parse($result);
        $this->assertEquals($expected, $result);

    }

    function testParseUsingMiscLacalesPatterns()
    {
        $locales = array(
            'en_US' => "{0,number,integer} monkeys on {1,number,integer} trees make {2,number} monkeys per tree",
            'ru_UA' => "{0,number,integer} мавп на {1,number,integer} деревах це {2,number} мавпи на кожному деревi",
            'de' => "{0,number,integer} Affen über {1,number,integer} Bäume um {2,number} Affen pro Baum",
            'en_UK' => "{0,number,integer} monkeys on {1,number,integer} trees make {2,number} monkeys per tree",
            'fr' => 'C\'est {0,number,integer}',
        );

        $results = array(
            'en_US' => "4,560 monkeys on 123 trees make 37.073 monkeys per tree",
            'ru_UA' => "4 560 мавп на 123 деревах це 37,073 мавпи на кожному деревi",
            'de' => "4.560 Affen über 123 Bäume um 37,073 Affen pro Baum",
            'en_UK' => "4,560 monkeys on 123 trees make 37.073 monkeys per tree",
            'fr' => "C'est 42",

        );

        $expected = array(
            'en_US' => array(4560, 123, 37.073,),
            'ru_UA' => array(4560, 123, 37.073,),
            'de' => array(4560, 123, 37.073,),
            'en_UK' => array(4560, 123, 37.073,),
            'fr' => array(42,),
        );


        foreach ($locales as $locale => $pattern) {
            $msgf = new MessageFormatter($locale, $pattern);
            $result = $msgf->parse($results[$locale]);
            $this->assertEquals($expected[$locale], $result);

            $result = $msgf->parseMessage($locale, $pattern, $results[$locale]);
            $this->assertEquals($expected[$locale], $result);
        }
    }

    function testInvalidatesArgTypesCache()
    {
        $msgf = new MessageFormatter('en_US', "{0,number} -- {1,ordinal}");

        $result = $msgf->format(array(1.3, 1.3));
        $this->assertEquals('1.3 -- 1st', $result);

        $result = $msgf->format(array(1.3, 1.3));
        $this->assertEquals('1.3 -- 1st', $result);

        $msgf->setPattern("{0,ordinal} -- {1,number}");

        $result = $msgf->format(array(1.3, 1.3));
        $this->assertEquals('1st -- 1.3', $result);
    }
}
