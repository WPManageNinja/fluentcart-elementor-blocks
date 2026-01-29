<?php

namespace FluentCartElementorBlocks\App\Http\Controllers;

use FluentCartElementorBlocks\App\Core\App;
use FluentCart\App\Http\Controllers\Controller as BaseController;

abstract class Controller extends BaseController
{
    public function __construct()
    {
        parent::__construct(App::getInstance());
    }
}
