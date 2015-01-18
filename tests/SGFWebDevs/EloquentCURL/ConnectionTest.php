<?php

namespace SGFWebDevs\EloquentCURL\Tests;

use Mockery as M;

class ConnectionTest extends TestCase {
	public function setup () {
		parent::setUp();
	}

	public function testConnection () {
		$connection = $this->getConnectionWithConfig('neo4j');
		$this->assertInstanceOf('SGFWebDevs\EloquentCURL\Connection', $connection);
	}
}
