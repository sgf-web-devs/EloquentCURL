<?php

namespace SGFWebDevs\EloquentCURL;

use Closure;
use GuzzleHttp\Client as GuzzleClient;
use Illuminate\Database\ConnectionInterface as IlluminateConnection;
use SGFWebDevs\EloquentCURL\Exceptions\InvalidURLException;

class Connection implements IlluminateConnection {
	protected $client;
	protected $driverName = 'eloquentcurl';
	protected $defaults = array(
		'host'        => 'http://localhost',
		'port'        => 80,
		'api-version' => '',
		'auth-type'   => '',
		'auths'       => array(
			'oauth'  => array(
				'private-key'   => '',
				'public-key'    => '',
				'token'         => '',
				'token-private' => ''
			),
			'basic'  => array(
				'username' => '',
				'password' => ''
			),
			'digest' => array(
				'username' => '',
				'password' => ''
			)
		)
	);

	public function __construct (array $config) {
		$this->config = $config;
		$this->client = $this->createConnection();
	}

	public function createConnection () {
		$port = $this->getPort();
		$port = ($port == 80) ? '' : ':' . $port;

		$client = new GuzzleClient(array(
			'base_url' => $this->getHost() . $port . '/{version}',
			array(
				'version' => $this->getApiVersion()
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
		return (int) $this->getConfig('port', $this->defaults['port']);
	}

	public function getApiVersion () {
		return rtrim($this->getConfig('api-version', $this->defaults['api-version']), '/');
	}

	public function getAuthType () {
		return $this->getConfig('auth-type', $this->defaults['auth-type']);
	}

	public function getAuth ($auth_type) {
		return $this->getConfig('auths.' . $auth_type, $this->defaults['auths'][$auth_type]);
	}

	public function getAuthOption ($auth_type, $option) {
		return array_get($this->getAuth($auth_type), $option, $this->defaults['auths'][$auth_type][$option]);
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

	/**
	 * Begin a fluent query against a database table.
	 *
	 * @param  string $table
	 *
	 * @return \Illuminate\Database\Query\Builder
	 */
	public function table ($table) {

	}

	/**
	 * Get a new raw query expression.
	 *
	 * @param  mixed $value
	 *
	 * @return \Illuminate\Database\Query\Expression
	 */
	public function raw ($value) {

	}

	/**
	 * Run a select statement and return a single result.
	 *
	 * @param  string $query
	 * @param  array $bindings
	 *
	 * @return mixed
	 */
	public function selectOne ($query, $bindings = array()) {

	}

	/**
	 * Run a select statement against the database.
	 *
	 * @param  string $query
	 * @param  array $bindings
	 *
	 * @return array
	 */
	public function select ($query, $bindings = array()) {

	}

	/**
	 * Run an insert statement against the database.
	 *
	 * @param  string $query
	 * @param  array $bindings
	 *
	 * @return bool
	 */
	public function insert ($query, $bindings = array()) {

	}

	/**
	 * Run an update statement against the database.
	 *
	 * @param  string $query
	 * @param  array $bindings
	 *
	 * @return int
	 */
	public function update ($query, $bindings = array()) {

	}

	/**
	 * Run a delete statement against the database.
	 *
	 * @param  string $query
	 * @param  array $bindings
	 *
	 * @return int
	 */
	public function delete ($query, $bindings = array()) {

	}

	/**
	 * Execute an SQL statement and return the boolean result.
	 *
	 * @param  string $query
	 * @param  array $bindings
	 *
	 * @return bool
	 */
	public function statement ($query, $bindings = array()) {

	}

	/**
	 * Run an SQL statement and get the number of rows affected.
	 *
	 * @param  string $query
	 * @param  array $bindings
	 *
	 * @return int
	 */
	public function affectingStatement ($query, $bindings = array()) {

	}

	/**
	 * Run a raw, unprepared query against the PDO connection.
	 *
	 * @param  string $query
	 *
	 * @return bool
	 */
	public function unprepared ($query) {

	}

	/**
	 * Prepare the query bindings for execution.
	 *
	 * @param  array $bindings
	 *
	 * @return array
	 */
	public function prepareBindings (array $bindings) {

	}

	/**
	 * Execute a Closure within a transaction.
	 *
	 * @param  \Closure $callback
	 *
	 * @return mixed
	 *
	 * @throws \Exception
	 */
	public function transaction (Closure $callback) {

	}

	/**
	 * Start a new database transaction.
	 *
	 * @return void
	 */
	public function beginTransaction () {

	}

	/**
	 * Commit the active database transaction.
	 *
	 * @return void
	 */
	public function commit () {

	}

	/**
	 * Rollback the active database transaction.
	 *
	 * @return void
	 */
	public function rollBack () {

	}

	/**
	 * Get the number of active transactions.
	 *
	 * @return int
	 */
	public function transactionLevel () {

	}

	/**
	 * Execute the given callback in "dry run" mode.
	 *
	 * @param  \Closure $callback
	 *
	 * @return array
	 */
	public function pretend (Closure $callback) {

	}

}
