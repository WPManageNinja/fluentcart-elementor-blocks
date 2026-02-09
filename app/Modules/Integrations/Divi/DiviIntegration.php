<?php

namespace FluentCartElementorBlocks\App\Modules\Integrations\Divi;

use FluentCartElementorBlocks\App\Modules\Integrations\Divi\Modules\Legacy\AddToCartModule;
use FluentCartElementorBlocks\App\Modules\Integrations\Divi\Modules\Legacy\BuyNowModule;
use FluentCartElementorBlocks\App\Modules\Integrations\Divi\Modules\Legacy\CheckoutModule;
use FluentCartElementorBlocks\App\Modules\Integrations\Divi\Modules\Legacy\MiniCartModule;
use FluentCartElementorBlocks\App\Modules\Integrations\Divi\Modules\Legacy\ProductCarouselModule;
use FluentCartElementorBlocks\App\Modules\Integrations\Divi\Modules\Legacy\ProductCategoriesListModule;

class DiviIntegration
{
    private static $moduleSlugs = [
        'fceb_mini_cart',
        'fceb_add_to_cart',
        'fceb_buy_now',
        'fceb_product_categories_list',
        'fceb_product_carousel',
        'fceb_checkout',
    ];

    public function register()
    {
        // Register module slugs for Divi 5's lazy shortcode loading on frontend
        \add_filter('et_builder_3rd_party_module_slugs', [$this, 'registerModuleSlugs']);

        // Register the actual module instances when the builder framework is ready
        \add_action('et_builder_ready', [$this, 'registerModules']);
    }

    public function registerModuleSlugs(array $slugs): array
    {
        return array_merge($slugs, self::$moduleSlugs);
    }

    public function registerModules()
    {
        static $registered = false;
        if ($registered) {
            return;
        }
        $registered = true;

        new MiniCartModule();
        new AddToCartModule();
        new BuyNowModule();
        new ProductCategoriesListModule();
        new ProductCarouselModule();
        new CheckoutModule();
    }
}
