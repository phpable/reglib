<?php
namespace Able\Reglib;

use \Able\Statics\TStatic;

class Reglib {
	use TStatic;

	/**
	 * @const string
	 */
	const VAR = '[A-Za-z_][A-Za-z0-9_]*';

	/**
	 * @const string
	 */
	const KEYWORD = '[A-Za-z][A-Za-z0-9]*';

	/**
	 * @const string
	 */
	const NAMESPACE = '(' . self::VAR . '\\\\*)+';

	/**
	 * @const string
	 */
	const QUOTED = '(?:\'(?:\\\\\'|[^\'])*\'|"(?:\\\\"|[^"])*")';

	/**
	 * @const string
	 */
	const PARAMS = '(' . self::QUOTED . '|[^,]+)';

}
