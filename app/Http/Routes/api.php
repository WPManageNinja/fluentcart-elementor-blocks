<?php

/**
 * @var $router WPFluentMicro\Framework\Http\Router\Router
 */

use FluentCartElementorBlocks\App\Http\Policies\UserPolicy;

$router->withPolicy(UserPolicy::class)->group(function($router) {
	$router->get('/demo-users', 'UserController@users');
});
