<?php

namespace FluentCartElementorBlocks\App\Modules\Integrations\Elementor\Controls;

use Elementor\Control_Select2;

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly.
}

class ProductVariationSelectControl extends Control_Select2
{
    public function get_type()
    {
        return 'fluent_product_variation_select';
    }
}
