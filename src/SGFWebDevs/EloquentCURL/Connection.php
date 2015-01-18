<?php

namespace SGFWebDevs\EloquentCURL;

use GuzzleHttp\Client as GuzzleClient;
use Illuminate\Database\Connection as IlluminateConnection;
use SGFWebDevs\EloquentCURL\Exceptions\InvalidURLException;

class Connection extends IlluminateConnection {
	protected $client;
	protected $driverName = 'eloquentcurl';
	protected $defaults = array(
		'host'            	=> 'http://localhost',
		'port'            	=> 80,
		'api-version'     	=> '',
		'auth-type'			=> '',

		'auths' => array(
			'oauth' => array(
				'private-key' 	=> '',
				'public-key' 	=> '',
				'token'			=> '',
				'token-private'	=> ''
			),
			'basic' => array(
				'username' 	=> '',
				'password'	=> ''
			),
			'digest' => array(
				'username'	=> '',
				'password'	=> ''
			)
		)
	);

	public function __construct (array $config) {
		$this->config = $config;
		$this->client = $this->createConnection();
	}

	public function createConnection () {
		$client = new GuzzleClient(array(
			'base_url'	=> $this->getHost() . $this->getPort() . '/{version}',
			array(
				'version'	=> $this->getApiVersion()
			)
		));

		return $client;
	}

	public function getConfig ($option, $default = null) {
		return array_get($this->config, $option, $default);
	}

	public function getHost () {
		$host = rtrim($this->getConfig('host', $this->defaults['host']), '/');

		if (filter_var($host, FILTER_VALIDATE_URL) === false)
			throw new InvalidURLException('The host " . $host . " is invalid. Make sure the host is prefixed with a schema. (e.g. https://, http:// ... )');

		return $host;
	}

	public function getPort () {
		return $this->getConfig('port', $this->defaults['port']);
	}

	public function getApiVersion () {
		return rtrim($this->getConfig('api-version', $this->defaults['api-version']), '/');
	}

	public function getAuthType () {
		return $this->getConfig('auth-type', $this->defaults['auth-type']);
	}

	public function getAuth ($auth_type) {
		return $this->getConfig('auths.' . $auth_type, $this->defaults['auth-type']['auths'][$auth_type]);
	}

	public function getAuthOption ($auth_type, $option) {
		return array_get($this->getAuth($auth_type), $option, $this->defaults['auth-type']['auths'][$auth_type][$option]);
	}

	public function getDriver () {
		return $this->driverName;
	}

	public function getClient () {
		return $this->client;
	}

	public function setClient (GuzzleClient $client) {
		$this->client = $client;
	}
}
