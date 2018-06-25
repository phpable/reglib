<?php
namespace Able\Reglib;

class Regexp {

	/**
	 * @var null
	 */
	private $pattern = null;

	/**
	 * Regexp constructor.
	 * @param string $pattern
	 * @throws \Exception
	 */
	public final function __construct(string $pattern){
		if (@preg_match($pattern, null) === false){
			throw new \Exception(preg_replace('/^[^:]+:\s*/', '', error_get_last()['message']));
		}

		$this->pattern = $pattern;
	}

	/**
	 * @var array
	 */
	protected static $Cache = [];

	/**
	 * @param string $pannern
	 * @return Regexp
	 */
	public final static function create(string $pannern) {
		if (!isset(self::$Cache[$key = get_called_class() . trim($pannern)])){
			self::$Cache[$key] = new static($pannern);
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
	 * @return string
	 */
	public final function retrieve(string &$source): string {
		$source = substr($source, strlen($out = self::take($source)));
		return $out;
	}

	/**
	 * @param string $source
	 * @return bool
	 */
	public final function check(string $source): bool {
		return preg_match($this->pattern, $source) > 0;
	}

	/**
	 * @param string $source
	 * @param string|callable $replacement
	 * @param int $limit
	 * @return string
	 */
	public final function replace(string $source, $replacement, int $limit = -1): string{
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

				$line  = substr($source, $offset, $Matches[0][1] - $offset);
				$offset = $Matches[0][1] + strlen($Matches[0][0]);

			yield $line . $Matches[0][0];
		}

		if ($offset < strlen($source)){
			yield substr($source, $offset);
		}
	}
}
