<?php
namespace Able\Reglib;

use \Able\Prototypes\TUnclonable;
use \Able\Prototypes\TUncreatable;

class Reglib {
	use TUnclonable;
	use TUncreatable;

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
