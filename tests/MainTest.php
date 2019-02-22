<?php
namespace Able\Reglib\Tests;

use \PHPUnit\Framework\TestCase;
use \Able\Reglib\Regex;

class MainTest extends TestCase {

	/**
	 * @throws \Exception
	 */
	public final function testReplace() {
		$Regex = new Regex('/test/');

		$this->assertEquals($Regex->replace('test_string_of_test',
			'real'), 'real_string_of_real');

		$this->assertEquals($Regex->replace('test_string_of_test',
			'real', 1), 'real_string_of_test');
	}

	/**
	 * @throws \Exception
	 */
	public final function testTake() {
		$Regex = new Regex('/^test(?:_(string))(?:_(of))/');

		$this->assertEquals($Regex->take('test_string_of_test'), 'test_string_of');

		$this->assertEquals($Regex->take('test_string_of_test', 1), 'string');
		$this->assertEquals($Regex->take('test_string_of_test', 2), 'of');
	}

	/**
	 * @throws \Exception
	 */
	public final function testCheck() {
		$Regex = new Regex('/^test[A-Za-z_]+of\w+$/');

		$this->assertTrue($Regex->check('test_string_of_test'));
		$this->assertFalse($Regex->check('test_string_of_!test'));

	}
}
