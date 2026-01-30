<?php

namespace FluentCartElementorBlocks\App\Modules\Integrations\Elementor\Renderers;

use FluentCart\App\Models\Product;
use FluentCart\App\Services\Renderer\ProductCardRender;
use FluentCart\App\Services\Renderer\ShopAppRenderer;
use FluentCart\Framework\Pagination\CursorPaginator;
use FluentCart\Framework\Support\Arr;

class ElementorShopAppRenderer extends ShopAppRenderer
{
    protected $cardElements = [];

    protected $clientId = '';

    public function __construct($products = [], $config = [])
    {
        $this->cardElements = Arr::get($config, 'card_elements', []);
        $this->clientId = Arr::get($config, 'client_id', '');

        if ($this->clientId && !empty($this->cardElements)) {
            set_transient(
                'fc_el_collection_' . $this->clientId,
                $this->cardElements,
                48 * HOUR_IN_SECONDS
            );
        }

        parent::__construct($products, $config);
    }

    public function renderProduct()
    {
        $products = $this->products;

        $cursor = '';
        if ($products instanceof CursorPaginator) {
            $cursor = wp_parse_args(wp_parse_url($products->nextPageUrl(), PHP_URL_QUERY));
        }

        foreach ($products as $index => $product) {
            $cursorAttr = '';
            if ($index === 0) {
                $cursorAttr = Arr::get($cursor, 'cursor', '');
            }

            $this->renderCardWithLayout($product, $cursorAttr, $index === 0);
        }
    }

    private function renderCardWithLayout(Product $product, $cursorAttr = '', $isFirst = false)
    {
        $cardRender = new ProductCardRender($product, ['cursor' => $cursorAttr]);

        $cursorData = '';
        if ($cursorAttr) {
            $cursorData = 'data-fluent-cart-cursor="' . esc_attr($cursorAttr) . '"';
        }

        $providerAttr = '';
        if ($isFirst && $this->clientId) {
            $providerAttr = 'data-template-provider="elementor" data-fluent-client-id="' . esc_attr($this->clientId) . '"';
        }
        ?>
        <article data-fluent-cart-shop-app-single-product data-fct-product-card=""
                 class="fct-product-card"
                <?php echo $cursorData; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
                <?php echo $providerAttr; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
                 aria-label="<?php echo esc_attr(sprintf(
                         __('%s product card', 'fluent-cart'), $product->post_title));
                 ?>">
            <?php static::renderCardElements($cardRender, $this->cardElements); ?>
        </article>
        <?php
    }

    /**
     * Render card elements in the given order.
     * Shared between initial render and AJAX preload callback.
     */
    public static function renderCardElements(ProductCardRender $cardRender, array $cardElements)
    {
        foreach ($cardElements as $element) {
            $type = Arr::get($element, 'element_type', '');
            switch ($type) {
                case 'image':
                    $cardRender->renderProductImage();
                    break;
                case 'title':
                    $cardRender->renderTitle();
                    break;
                case 'excerpt':
                    $cardRender->renderExcerpt();
                    break;
                case 'price':
                    $cardRender->renderPrices();
                    break;
                case 'button':
                    $cardRender->showBuyButton();
                    break;
            }
        }
    }
}
