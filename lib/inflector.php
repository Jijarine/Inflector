<?php

/**
 * Pluralize and singularize English words.
 *
 * PHP versions 7.2
 *
 * Copyright (c) Cole Design Stuidos, LLC (https://coleds.com)
 * 
 * Licensed under The MIT License
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cole Design Studios, LLC. (https://coleds.com)
 * @link          https://github.com/Jijarine/Inflector
 * @since         v0.0.1
 * @license       https://opensource.org/licenses/mit-license.php MIT License
 */

class Inflector {

/**
 * Plural inflector rules
 *
 * @var array
 * @access protected
 * @static
 */
	protected static $plural = [
		'rules' => [
			'/(s)tatus$/i' => '\1\2tatuses',
			'/(quiz)$/i' => '\1zes',
			'/^(ox)$/i' => '\1\2en',
			'/([m|l])ouse$/i' => '\1ice',
			'/(matr|vert|ind)(ix|ex)$/i'  => '\1ices',
			'/(x|ch|ss|sh)$/i' => '\1es',
			'/([^aeiouy]|qu)y$/i' => '\1ies',
			'/(hive)$/i' => '\1s',
			'/(?:([^f])fe|([lr])f)$/i' => '\1\2ves',
			'/sis$/i' => 'ses',
			'/([ti])um$/i' => '\1a',
			'/(p)erson$/i' => '\1eople',
			'/(m)an$/i' => '\1en',
			'/(c)hild$/i' => '\1hildren',
			'/(buffal|tomat)o$/i' => '\1\2oes',
			'/(alumn|bacill|cact|foc|fung|nucle|radi|stimul|syllab|termin|vir)us$/i' => '\1i',
			'/us$/i' => 'uses',
			'/(alias)$/i' => '\1es',
			'/(ax|cris|test)is$/i' => '\1es',
			'/s$/' => 's',
			'/^$/' => '',
			'/$/' => 's',
		],
		'uninflected' => [
			'.*[nrlm]ese', '.*deer', '.*fish', '.*measles', '.*ois', '.*pox', '.*sheep', 'people'
		],
		'irregular' => [
			'atlas' => 'atlases',
			'beef' => 'beefs',
			'brother' => 'brothers',
			'cafe' => 'cafes',
			'child' => 'children',
			'corpus' => 'corpuses',
			'cow' => 'cows',
			'ganglion' => 'ganglions',
			'genie' => 'genies',
			'genus' => 'genera',
			'graffito' => 'graffiti',
			'hoof' => 'hoofs',
			'loaf' => 'loaves',
			'man' => 'men',
			'money' => 'monies',
			'mongoose' => 'mongooses',
			'move' => 'moves',
			'mythos' => 'mythoi',
			'niche' => 'niches',
			'numen' => 'numina',
			'occiput' => 'occiputs',
			'octopus' => 'octopuses',
			'opus' => 'opuses',
			'ox' => 'oxen',
			'penis' => 'penises',
			'person' => 'people',
			'sex' => 'sexes',
			'soliloquy' => 'soliloquies',
			'testis' => 'testes',
			'trilby' => 'trilbys',
			'turf' => 'turfs'
		]
	];

/**
 * Singular inflector rules
 *
 * @var array
 * @access protected
 * @static
 */
	protected static $singular = [
		'rules' => [
			'/(s)tatuses$/i' => '\1\2tatus',
			'/^(.*)(menu)s$/i' => '\1\2',
			'/(quiz)zes$/i' => '\\1',
			'/(matr)ices$/i' => '\1ix',
			'/(vert|ind)ices$/i' => '\1ex',
			'/^(ox)en/i' => '\1',
			'/(alias)(es)*$/i' => '\1',
			'/(alumn|bacill|cact|foc|fung|nucle|radi|stimul|syllab|termin|viri?)i$/i' => '\1us',
			'/([ftw]ax)es/i' => '\1',
			'/(cris|ax|test)es$/i' => '\1is',
			'/(shoe|slave)s$/i' => '\1',
			'/(o)es$/i' => '\1',
			'/ouses$/' => 'ouse',
			'/([^a])uses$/' => '\1us',
			'/([m|l])ice$/i' => '\1ouse',
			'/(x|ch|ss|sh)es$/i' => '\1',
			'/(m)ovies$/i' => '\1\2ovie',
			'/(s)eries$/i' => '\1\2eries',
			'/([^aeiouy]|qu)ies$/i' => '\1y',
			'/([lr])ves$/i' => '\1f',
			'/(tive)s$/i' => '\1',
			'/(hive)s$/i' => '\1',
			'/(drive)s$/i' => '\1',
			'/([^fo])ves$/i' => '\1fe',
			'/(^analy)ses$/i' => '\1sis',
			'/(analy|diagno|^ba|(p)arenthe|(p)rogno|(s)ynop|(t)he)ses$/i' => '\1\2sis',
			'/([ti])a$/i' => '\1um',
			'/(p)eople$/i' => '\1\2erson',
			'/(m)en$/i' => '\1an',
			'/(c)hildren$/i' => '\1\2hild',
			'/(n)ews$/i' => '\1\2ews',
			'/eaus$/' => 'eau',
			'/^(.*us)$/' => '\\1',
			'/s$/i' => ''
		],
		'uninflected' => [
			'.*[nrlm]ese', '.*deer', '.*fish', '.*measles', '.*ois', '.*pox', '.*sheep', '.*ss'
		],
		'irregular' => [
			'foes' => 'foe',
			'waves' => 'wave',
			'curves' => 'curve'
		]
	];

/**
 * Default map of accented and special characters to ASCII characters
 *
 * @var array
 * @access protected
 * @static
 */
	protected static $transliteration = [
		'/ä|æ|ǽ/' => 'ae',
		'/ö|œ/' => 'oe',
		'/ü/' => 'ue',
		'/Ä/' => 'Ae',
		'/Ü/' => 'Ue',
		'/Ö/' => 'Oe',
		'/À|Á|Â|Ã|Ä|Å|Ǻ|Ā|Ă|Ą|Ǎ/' => 'A',
		'/à|á|â|ã|å|ǻ|ā|ă|ą|ǎ|ª/' => 'a',
		'/Ç|Ć|Ĉ|Ċ|Č/' => 'C',
		'/ç|ć|ĉ|ċ|č/' => 'c',
		'/Ð|Ď|Đ/' => 'D',
		'/ð|ď|đ/' => 'd',
		'/È|É|Ê|Ë|Ē|Ĕ|Ė|Ę|Ě/' => 'E',
		'/è|é|ê|ë|ē|ĕ|ė|ę|ě/' => 'e',
		'/Ĝ|Ğ|Ġ|Ģ/' => 'G',
		'/ĝ|ğ|ġ|ģ/' => 'g',
		'/Ĥ|Ħ/' => 'H',
		'/ĥ|ħ/' => 'h',
		'/Ì|Í|Î|Ï|Ĩ|Ī|Ĭ|Ǐ|Į|İ/' => 'I',
		'/ì|í|î|ï|ĩ|ī|ĭ|ǐ|į|ı/' => 'i',
		'/Ĵ/' => 'J',
		'/ĵ/' => 'j',
		'/Ķ/' => 'K',
		'/ķ/' => 'k',
		'/Ĺ|Ļ|Ľ|Ŀ|Ł/' => 'L',
		'/ĺ|ļ|ľ|ŀ|ł/' => 'l',
		'/Ñ|Ń|Ņ|Ň/' => 'N',
		'/ñ|ń|ņ|ň|ŉ/' => 'n',
		'/Ò|Ó|Ô|Õ|Ō|Ŏ|Ǒ|Ő|Ơ|Ø|Ǿ/' => 'O',
		'/ò|ó|ô|õ|ō|ŏ|ǒ|ő|ơ|ø|ǿ|º/' => 'o',
		'/Ŕ|Ŗ|Ř/' => 'R',
		'/ŕ|ŗ|ř/' => 'r',
		'/Ś|Ŝ|Ş|Š/' => 'S',
		'/ś|ŝ|ş|š|ſ/' => 's',
		'/Ţ|Ť|Ŧ/' => 'T',
		'/ţ|ť|ŧ/' => 't',
		'/Ù|Ú|Û|Ũ|Ū|Ŭ|Ů|Ű|Ų|Ư|Ǔ|Ǖ|Ǘ|Ǚ|Ǜ/' => 'U',
		'/ù|ú|û|ũ|ū|ŭ|ů|ű|ų|ư|ǔ|ǖ|ǘ|ǚ|ǜ/' => 'u',
		'/Ý|Ÿ|Ŷ/' => 'Y',
		'/ý|ÿ|ŷ/' => 'y',
		'/Ŵ/' => 'W',
		'/ŵ/' => 'w',
		'/Ź|Ż|Ž/' => 'Z',
		'/ź|ż|ž/' => 'z',
		'/Æ|Ǽ/' => 'AE',
		'/ß/'=> 'ss',
		'/Ĳ/' => 'IJ',
		'/ĳ/' => 'ij',
		'/Œ/' => 'OE',
		'/ƒ/' => 'f'
	];

/**
 * Return $word in plural form.
 *
 * @param string $word Word in singular
 * @return string Word in plural
 * @access public
 * @static
 */
	public static function pluralize(string $word) : string {
		$uninflected = '(?:' . implode('|', Inflector::$plural['uninflected']) . ')';
		$irregular = '(?:' . implode('|', array_keys(Inflector::$plural['irregular'])) . ')';
		
		if (preg_match('/^('.$uninflected.')$/i', $word, $regs)) {
			return $word;
		}

		if (preg_match('/(.*)\\b('.$irregular.')$/i', $word, $regs)) {
			$string = $regs[1].substr($word, 0, 1).substr($irregular[strtolower($regs[2])], 1);
			return $string;
		}
		
		foreach (Inflector::$plural['rules'] as $rule => $replacement) {
			if (preg_match($rule, $word)) {
				return preg_replace($rule, $replacement, $word);
			}
		}
		
		return $word;
	}

/**
 * Return $word in singular form.
 *
 * @param string $word Word in plural
 * @return string Word in singular
 * @access public
 * @static
 */
	public static function singularize(string $word) : string {
		$uninflected = '(?:'.join( '|', Inflector::$singular['uninflected']).')';
		$irregular = '(?:'.join( '|', array_keys(Inflector::$singular['irregular'])).')';
		
		if (preg_match('/(.*)\\b('.$irregular.')$/i', $word, $regs)) {
			$string = $regs[1].substr($word, 0, 1).substr($irregular[strtolower($regs[2])], 1);
			return $string;
		}

		if (preg_match('/^('.$uninflected.')$/i', $word, $regs)) {
			return $word;
		}

		foreach (Inflector::$singular['rules'] as $rule => $replacement) {
			if (preg_match($rule, $word)) {
				return preg_replace($rule, $replacement, $word);
			}
		}
		
		return $word;
	}

/**
 * Returns the given lower_case_andunderscored_word as a CamelCased word.
 *
 * @param string $string Word to camelize
 * @return string Camelized word. LikeThis.
 * @access public
 * @static
 */
	public static function camelize(string $string) : string {
		return str_replace(' ', '', Inflector::humanize($string));
	}

/**
 * Returns the given camelCasedWord as an underscored_word.
 *
 * @param string $string Camel-cased word to be "underscorized"
 * @return string Underscore-syntaxed version of the $string
 * @access public
 * @static
 */
	public static function underscore(string $string) {
		return strtolower(preg_replace('/(?<=\\w)([A-Z])/', '_\\1', $string));
	}

/**
 * Returns the given underscored_word_group as a Human Readable Word Group.
 * (Underscores are replaced by spaces and capitalized following words.)
 *
 * @param string $string String to be made readable
 * @return string Human-readable string
 * @access public
 * @static
 */
	public static function humanize(string $string) : string {
		return ucwords(str_replace('_', ' ', $string));
	}

/**
 * Returns corresponding table name.
 *
 * @param string $string to get database table name for
 * @return string Name of the database table
 * @access public
 * @static
 */
    public static function tableize(string $string) : string {
		return Inflector::pluralize(strtolower(preg_replace('~(?<=\\w)([A-Z])~', '_$1', $string)));
    }

/**
 * Returns a class name ("User" for the database table "users".) for given database table.
 *
 * @param string $string Name of database table to get class name for
 * @return string Class name
 * @access public
 * @static
 */
	public static function classify(string $string) : string {
		return Inflector::camelize(Inflector::singularize($string));
	}

/**
 * Returns camelBacked version of an underscored string.
 *
 * @param string $string
 * @return string in variable form
 * @access public
 * @static
 */
	public static function variable(string $string) : string {
		$string2 = Inflector::camelize(Inflector::underscore($string));
		$replace = strtolower(substr($string2, 0, 1));
		$result = preg_replace('/\\w/', $replace, $string2, 1);
		return $result;
	}

/**
 * Returns a string with all spaces converted to hyphens by default, accented
 * characters converted to non-accented characters, and non word characters removed.
 *
 * @param string $string the string you want to slug
 * @param string $replacement will replace keys in map
 * @param array $map extra elements to map to the replacement
 * @deprecated $map param will be removed in future versions.
 * @return string
 * @access public
 * @static
 */
	public static function slug(string $string, string $replacement = '-', array $map = []) {
		if (is_array($replacement)) {
			$map = $replacement;
			$replacement = '-';
		}
		$quotedReplacement = preg_quote($replacement, '/');

		$merge = array(
			'/[^\s\p{Ll}\p{Lm}\p{Lo}\p{Lt}\p{Lu}\p{Nd}]/mu' => ' ',
			'/\\s+/' => $replacement,
			sprintf('/^[%s]+|[%s]+$/', $quotedReplacement, $quotedReplacement) => '',
		);

		$map = $map + Inflector::$transliteration + $merge;
		return preg_replace(array_keys($map), array_values($map), $string);
	}
}
