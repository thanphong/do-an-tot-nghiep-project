<?php
/**
 * TestRunner for CakePHP Test suite.
 *
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @since         CakePHP(tm) v 2.0
 * @license       http://www.opensource.org/licenses/mit-license.php MIT License
 */

require_once 'PHPUnit/TextUI/TestRunner.php';

App::uses('CakeFixtureManager', 'TestSuite/Fixture');

/**
 * A custom test runner for CakePHP's use of PHPUnit.
 *
 * @package       Cake.TestSuite
*/
class CakeTestRunner extends PHPUnit_TextUI_TestRunner {

	/**
	 * Lets us pass in some options needed for CakePHP's webrunner.
	 *
	 * @param mixed $loader The test suite loader
	 * @param array $params list of options to be used for this run
	 */
	public function __construct($loader, $params) {
		parent::__construct($loader);
		$this->_params = $params;
	}

	/**
	 * Actually run a suite of tests. Cake initializes fixtures here using the chosen fixture manager
	 *
	 * @param PHPUnit_Framework_Test $suite The test suite to run
	 * @param array $arguments The CLI arguments
	 * @return void
	 */
	public function doRun(PHPUnit_Framework_Test $suite, array $arguments = array()) {
		if (isset($arguments['printer'])) {
			self::$versionStringPrinted = true;
		}

		$fixture = $this->_getFixtureManager($arguments);
		foreach ($suite->getIterator() as $test) {
			if ($test instanceof CakeTestCase) {
				$fixture->fixturize($test);
				$test->fixtureManager = $fixture;
			}
		}

		$return = parent::doRun($suite, $arguments);
		$fixture->shutdown();
		return $return;
	}

	// @codingStandardsIgnoreStart PHPUnit overrides don't match CakePHP
	/**
	* Create the test result and splice on our code coverage reports.
	*
	* @return PHPUnit_Framework_TestResult
	*/
	protected function createTestResult() {
		$result = new PHPUnit_Framework_TestResult;
		if (!empty($this->_params['codeCoverage'])) {
			if (method_exists($result, 'collectCodeCoverageInformation')) {
				$result->collectCodeCoverageInformation(true);
			}
			if (method_exists($result, 'setCodeCoverage')) {
				$result->setCodeCoverage(new PHP_CodeCoverage());
			}
		}
		return $result;
	}
	// @codingStandardsIgnoreEnd

	/**
	 * Get the fixture manager class specified or use the default one.
	 *
	 * @param array $arguments The CLI arguments.
	 * @return mixed instance of a fixture manager.
	 * @throws RuntimeException When fixture manager class cannot be loaded.
	 */
	protected function _getFixtureManager($arguments) {
		if (isset($arguments['fixtureManager'])) {
			App::uses($arguments['fixtureManager'], 'TestSuite');
			if (class_exists($arguments['fixtureManager'])) {
				return new $arguments['fixtureManager'];
			}
			throw new RuntimeException(__d('cake_dev', 'Could not find fixture manager %s.', $arguments['fixtureManager']));
		}
		App::uses('AppFixtureManager', 'TestSuite');
		if (class_exists('AppFixtureManager')) {
			return new AppFixtureManager();
		}
		return new CakeFixtureManager();
	}

}
