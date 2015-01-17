<?php

namespace SGFWebDevs\EloquentCURL;

use Illuminate\Cache\Cache;
use Illuminate\Cache\Repository;
use Illuminate\Database\Connection;
use Illuminate\Support\ServiceProvider;
use Illuminate\Foundation\AliasLoader;

use SGFWebDevs\EloquentCURL\Eloquent\Model;
use SGFWebDevs\EloquentCURL\Cache\CURLStore;

class EloquentCURLServiceProvider extends ServiceProvider {
	
	public function boot () {
		Model::setConnectionResolver($this->app['db']);
		Model::setEventDispatcher($this->app['events']);
		$this->package('sgfwebdevs/eloquentcurl');
	}

	public function register () {
		$this->app['db']->extend('eloquentcurl', function ($config) {
			return new Connection($config);
		});

		$this->app['cache']->extend('eloquentcurl', function ($config) {
			return new Repository(new CURLStore);
		});

		$this->app->booting(function () {
			$loader = AliasLoader::getInstance();
			$loader->alias('EloquentCURL', 'SGFWebDevs\EloquentCURL\Eloquent\Model');
		});
	}
}
