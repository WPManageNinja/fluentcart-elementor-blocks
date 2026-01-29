<?php

/**
 * All registered filter's handlers should be in app\Hooks\Handlers,
 * addFilter is similar to add_filter and addCustomFlter is just a
 * wrapper over add_filter which will add a prefix to the hook name
 * using the plugin slug to make it unique in all wordpress plugins,
 * ex: $app->addCustomFilter('foo', ['FooHandler', 'handleFoo']) is
 * equivalent to add_filter('slug-foo', ['FooHandler', 'handleFoo']).
 */

/**
 * @var $app WPFluentMicro\Framework\Foundation\Application
 */


// Used to encrypt/decrypt any value. The same
// key is required to decrypt the encrypted value.
$app->addFilter($app->config->get('app.slug') . '_encryption_key', function($default) {
	// must return a 16 characters long string, for example:
	return implode('', range('a', 'p')); // abcdefghijklmnop
});