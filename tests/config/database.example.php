<?php

return array(
	'default' => 'eloquentcurl',
	'connections' => array(
		'eloquentcurl' => array(
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
		)
	)
);
