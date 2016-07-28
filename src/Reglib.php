<?php
namespace Eggbe\Reglib;

use \Eggbe\Prototype\TUnclonable;
use \Eggbe\Prototype\TUncreatable;

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
	const QUOTED = '(?:\'(?:\\\\\'|[^\'])*\'|"(?:\\\\"|[^"])*")';

}
