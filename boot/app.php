<?php

use FluentCartElementorBlocks\App\Core\Application;

return function($file) {
    add_action('fluentcart_loaded', function($app) use ($file) {
        new Application($app, $file);
    });
};
