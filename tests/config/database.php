<?php

return array(
	'default' => 'default',
	'connections' => array(
		'eloquentcurl' => array(
			'driver' => 'eloquentcurl',
			'host' => 'localhost',
			'port' => 80,
			'username' => '',
			'password' => '',
			'api-private-key' => '',
			'api-public-key'  => '',
			'api-version' => '',
			'oauth'	=> false
		),
		'default' => array(
			'driver' => 'eloquentcurl'
		)
	)
);
