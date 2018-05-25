<?php
namespace Able\Reglib;

class Regexp {

	/**
	 * @var null
	 */
	private $condition = null;

	/**
	 * Regexp constructor.
	 * @param string $condition
	 * @throws \Exception
	 */
	public final function __construct(string $condition){
		if (@preg_match($condition, null) === false){
			throw new \Exception(preg_replace('/^[^:]+:\s*/', '', error_get_last()['message']));
		}

		$this->condition = $condition;
	}

	/**
	 * @param string $source
	 * @param int $position
	 * @return string
	 */
	public final function take(string $source, int $position = 0): string {
		return preg_match($this->condition, $source, $Matches) !== false
			&& isset($Matches[$position]) ? $Matches[$position] : '';
	}

	/**
	 * @param string $source
	 * @return bool
	 */
	public final function check(string $source): bool {
		return preg_match($this->condition, $source) > 0;
	}

	/**
	 * @param string $source
	 * @param string|callable $replacement
	 * @param int $limit
	 * @return string
	 */
	public final function replace(string $source, $replacement, int $limit = -1): string{
		return is_callable($replacement) ? preg_replace_callback('', $replacement,
			$source, $limit) : preg_replace($this->condition, $replacement, $source, $limit);
	}
}
