<?php
namespace Able\Reglib;

use \Able\Helpers\Arr;
use \Exception;

class Regex {

	/**
	 * @const string
	 */
	public const RE_VARIABLE = '[A-Za-z_][A-Za-z0-9_]*';

	/**
	 * @param string $source
	 * @return bool
	 * @throws Exception
	 */
	public static final function checkVariable(string $source): bool {
		return self::create('/^' . self::RE_VARIABLE . '$/')->check($source);
	}

	/**
	 * @const string
	 */
	const RE_NAMESPACE = '(' . self::RE_VARIABLE . '\\\\*)+';

	/**
	 * @param string $source
	 * @return bool
	 * @throws Exception
	 */
	public static final function checkNamespace(string $source): bool {
		return self::create('/^' . self::RE_NAMESPACE . '$/')->check($source);
	}

	/**
	 * @const string
	 */
	const RE_NUMBER = '[-+]?[0-9]+\.?[0-9]*';

	/**
	 * @param string $source
	 * @return bool
	 * @throws Exception
	 */
	public static final function checkNumber(string $source): bool {
		return self::create('/^' . self::RE_NUMBER . '$/')->check($source);
	}

	/**
	 * @const string
	 */
	const RE_KEYWORD = '[A-Za-z][A-Za-z0-9]*';

	/**
	 * @const string
	 */
	const RE_QUOTED = '(?:\'(?:\\\\\'|[^\'])*\'|"(?:\\\\"|[^"])*")';

	/**
	 * @const string
	 */
	const RE_PARAMS = '(' . self::RE_QUOTED . '|[^,]+)';

	/**
	 * @var null
	 */
	private $pattern = null;

	/**
	 * @param string $pattern
	 * @throws Exception
	 */
	public final function __construct(string $pattern) {
		if (@preg_match($pattern, null) === false){
			throw new Exception(preg_replace('/^[^:]+:\s*/', '', error_get_last()['message']));
		}

		$this->pattern = $pattern;
	}

	/**
	 * @var array
	 */
	protected static $Cache = [];

	/**
	 * @param string $pattern
	 * @return Regex
	 * @throws Exception
	 */
	public final static function create(string $pattern): Regex {
		if (!isset(self::$Cache[$key = get_called_class() . trim($pattern)])){
			self::$Cache[$key] = new static($pattern);
		}

		return self::$Cache[$key];
	}

	/**
	 * @param string $source
	 * @param int $position
	 * @return string
	 */
	public final function take(string $source, int $position = 0): string {
		return preg_match($this->pattern, $source, $Matches)
			&& isset($Matches[$position]) ? $Matches[$position] : '';
	}

	/**
	 * @param string $source
	 * @param int $position
	 * @return string
	 */
	public final function retrieve(string &$source, int $position = 0): string {
		$out = self::take($source, $position);
		$source = $this->erase($source);
		return $out;
	}

	/**
	 * @param string $source
	 * @return array|null
	 */
	public final function match(string $source): ?array {
		return preg_match($this->pattern, $source, $Matches) > 0 ? $Matches : null;
	}

	/**
	 * @param string $source
	 * @return bool
	 */
	public final function check(string $source): bool {
		return !empty($this->match($source));
	}

	/**
	 * @param string $source
	 * @param string|callable $replacement
	 * @param int $limit
	 * @return string
	 */
	public final function replace(string $source, $replacement, int $limit = -1): string {
		return is_callable($replacement) ? preg_replace_callback('', $replacement,
			$source, $limit) : preg_replace($this->pattern, $replacement, $source, $limit);
	}

	/**
	 * @param string $source
	 * @return string
	 */
	public final function erase(string $source): string {
		return preg_replace($this->pattern, '', $source);
	}

	/**
	 * @param string $source
	 * @return \Generator
	 */
	public final function split(string $source): \Generator {
		$offset = 0;

		while(preg_match($this->pattern, $source,
			$Matches, PREG_OFFSET_CAPTURE, $offset) > 0){
				yield substr($source, $offset, $Matches[0][1] - $offset);

				$offset = $Matches[0][1] + strlen($Matches[0][0]);
		}

		if ($offset < strlen($source)){
			yield substr($source, $offset);
		}
	}

	/**
	 * @param string $source
	 * @return array
	 */
	public final function parse(string $source): array {
		return Arr::combine(array_slice(func_get_args(), 1), array_slice((array)$this->match($source), 1));
	}
}
