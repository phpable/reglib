<?php
namespace Able\Reglib;

use \Able\Prototypes\TUnclonable;
use \Able\Prototypes\TUncreatable;

class Reglib {

	/**
	 * To avoid circular dependencies this class is not used TUncreatable
	 * and TUnclonable traits from the Able\Prototypes package but de-facto it does!
	 */

	/**
	 * @throws \Exception
	 */
	public final function __construct(){
		throw new \Exception('Can\'t create an uncreatable object!');
	}

	/**
	 * @throws \Exception
	 */
	public final function __clone(){
		throw new \Exception('Can\'t clone an unclonable object!');
	}

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
