<?php

namespace SGFWebDevs\EloquentCURL\Tests;

use Mockery as M;
use PHPUnit_Framework_TestCase;
use SGFWebDevs\EloquentCURL\Connection;
use SGFWebDevs\EloquentCURL\Eloquent\Model;

class TestCase extends PHPUnit_Framework_TestCase {

	public function __construct () {
		parent::__construct();
		$this->config = require 'config/database.php';
	}

	public function setUp () {
		parent::setUp();
		$resolver = M::mock('Illuminate\Database\ConnectionResolverInterface');
		$resolver->shouldReceive('connection')->andReturn($this->getConnectionWithConfig('default'));
	}

	public function tearDown () {
		parent::tearDown();
	}

	public static function setUpBeforeClass () {
		date_default_timezone_set('America/Chicago');
	}

	protected function getConnectionWithConfig ($config = null) {
		$connection = array();
		if (is_null($config))
			$connection = $this->config['connections']['default'];
		else
			$connection = $this->config['connections'][$config];
		return new Connection($connection);
	}


}
