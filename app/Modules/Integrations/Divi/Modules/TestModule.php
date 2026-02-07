<?php

namespace FluentCartElementorBlocks\App\Modules\Integrations\Divi\Modules;

class TestModule extends \ET_Builder_Module
{
    public $slug       = 'fceb_test_module';
    public $vb_support = 'partial';

    public function init()
    {
        $this->name = 'FluentCart Test';
    }

    public function get_fields()
    {
        return [
            'heading' => [
                'label'           => 'Heading',
                'type'            => 'text',
                'option_category' => 'basic_option',
                'toggle_slug'     => 'main_content',
                'default'         => 'Hello from FluentCart!',
            ],
        ];
    }

    public function render($attrs, $content, $render_slug)
    {
        $heading = $this->props['heading'] ?? 'Hello from FluentCart!';

        return sprintf(
            '<div class="fceb-test-module"><h3>%s</h3><p>FluentCart Divi test module is working.</p></div>',
            esc_html($heading)
        );
    }
}
