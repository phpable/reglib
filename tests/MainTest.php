<?php
namespace Able\Reglib\Tests;

use \PHPUnit\Framework\TestCase;
use \Able\Reglib\Regexp;

class MainTest extends TestCase {

	/**
	 * @throws \Exception
	 */
	public final function testReplace() {
		$Regexp = new Regexp('/test/');

		$this->assertEquals($Regexp->replace('test_string_of_test',
			'real'), 'real_string_of_real');

		$this->assertEquals($Regexp->replace('test_string_of_test',
			'real', 1), 'real_string_of_test');
	}

	/**
	 * @throws \Exception
	 */
	public final function testTake() {
		$Regexp = new Regexp('/^test(?:_(string))(?:_(of))/');

		$this->assertEquals($Regexp->take('test_string_of_test'), 'test_string_of');

		$this->assertEquals($Regexp->take('test_string_of_test', 1), 'string');
		$this->assertEquals($Regexp->take('test_string_of_test', 2), 'of');
	}

	/**
	 * @throws \Exception
	 */
	public final function testCheck() {
		$Regexp = new Regexp('/^test[A-Za-z_]+of\w+$/');

		$this->assertTrue($Regexp->check('test_string_of_test'));
		$this->assertFalse($Regexp->check('test_string_of_!test'));

	}
}
