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
	const QUOTED = '(?:\'(?:\\\\\'|[^\'])*\'|"(?:\\\\"|[^"])*")';

}
