<?php

namespace FluentCartElementorBlocks\App\Modules\Integrations\Divi;

use ET_Builder_Module;

class DiviIntegration
{
    public function register()
    {
        // ET_Builder_Module requires the builder to be loaded
        if (!class_exists(ET_Builder_Module::class)) {
            return;
        }

        \add_action('et_builder_ready', [$this, 'registerModules']);
    }

    public function registerModules()
    {
        new Modules\TestModule();
    }
}
