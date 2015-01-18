<?php

namespace SGFWebDevs\EloquentCURL\Tests;

use Mockery as M;
use SGFWebDevs\EloquentCURL\Connection;

class ConnectionTest extends TestCase {
	public function setup () {
		parent::setUp();
	}

	public function testGetters () {
		$config = array(
			'host'            	=> 'http://mockconfig.com',
			'port'            	=> 80,
			'api-version'     	=> 'v1',
			'auth-type'			=> 'oauth',

			'auths' => array(
				'oauth' => array(
					'private-key' 	=> 'aaaaaaaaa',
					'public-key' 	=> 'bbbbbbbbb',
					'token'			=> 'ccccccccc',
					'token-private'	=> 'ddddddddd'
				),
				'basic' => array(
					'username' 	=> 'test',
					'password'	=> 'password'
				),
				'digest' => array(
					'username'	=> 'test',
					'password'	=> 'password'
				)
			)
		);

		$curl = new Connection($config);

		// Test top level getters
		$this->assertEquals($config['host'], $curl->getHost(), 'Host does not match.');

		$this->assertTrue(is_int($curl->getPort()), 'Port is not an integer.');
		$this->assertEquals($config['port'], $curl->getPort(), 'Port does not match.');

		$this->assertEquals($config['api-version'], $curl->getApiVersion(), 'Version does not match.');
		$this->assertEquals($config['auth-type'], $curl->getAuthType(), 'Auth Type does not match.');

		// Test auth getters
		$this->assertEquals($config['auths']['oauth'], $curl->getAuth('oauth'), 'OAuth array does not match.');
		$this->assertEquals($config['auths']['oauth']['private-key'], $curl->getAuthOption('oauth', 'private-key'), 'Private key does not match.');
		$this->assertEquals($config['auths']['oauth']['public-key'], $curl->getAuthOption('oauth', 'public-key'), 'Public key does not match.');
		$this->assertEquals($config['auths']['oauth']['token'], $curl->getAuthOption('oauth', 'token'), 'Token does not match.');
		$this->assertEquals($config['auths']['oauth']['token-private'], $curl->getAuthOption('oauth', 'token-private'), 'Token private does not match.');

		$this->assertEquals($config['auths']['basic'], $curl->getAuth('basic'), 'Basic array does not match.');
		$this->assertEquals($config['auths']['basic']['username'], $curl->getAuthOption('basic', 'username'), 'Username does not match.');
		$this->assertEquals($config['auths']['basic']['password'], $curl->getAuthOption('basic', 'password'), 'Password does not match.');

		$this->assertEquals($config['auths']['digest'], $curl->getAuth('basic'), 'Digest array does not match.');
		$this->assertEquals($config['auths']['digest']['username'], $curl->getAuthOption('digest', 'username'), 'Username does not match.');
		$this->assertEquals($config['auths']['digest']['password'], $curl->getAuthOption('digest', 'password'), 'Password does not match.');
	}

	public function testConnection () {
		$connection = $this->getConnectionWithConfig('eloquentcurl');
		$this->assertInstanceOf('SGFWebDevs\EloquentCURL\Connection', $connection);
	}

	public function testClientInstance () {

	}
}
