<?php

declare(strict_types=1);

namespace Anchor\Service;

use Anchor\Contract\HasHooks;

defined('ABSPATH') || exit;

/**
 * Renders the sticky add-to-cart bar on single product pages.
 *
 * The bar is printed once, after the product summary, and stays hidden until the
 * shopper scrolls past the main add-to-cart form (the front-end script reveals
 * it via an IntersectionObserver). On variable products the script listens to
 * WooCommerce's native variation events to keep the price, availability and the
 * resolved variation id in sync — Anchor ships no jQuery of its own.
 *
 * All output is escaped; the service is inert unless enabled and on a product
 * page, and it degrades gracefully (it simply renders nothing) when product data
 * is missing or the product is not purchasable.
 */
final class StickyBar implements HasHooks
{
    private const OPTION = 'anchor_settings';

    public function registerHooks(): void
    {
        add_action('wp_enqueue_scripts', [$this, 'enqueueAssets']);
        // Print late in the product summary so the markup sits after the native
        // add-to-cart form in source order; CSS fixes it to the viewport edge.
        add_action('woocommerce_after_single_product', [$this, 'renderBar'], 20);
    }

    public function enqueueAssets(): void
    {
        if (! $this->shouldRender()) {
            return;
        }

        wp_enqueue_style(
            'anchor',
            ANCHOR_URL . 'assets/css/anchor.css',
            [],
            \Anchor\VERSION,
        );

        wp_enqueue_script(
            'anchor',
            ANCHOR_URL . 'assets/js/anchor.js',
            [],
            \Anchor\VERSION,
            ['in_footer' => true, 'strategy' => 'defer'],
        );

        $settings = $this->settings();

        wp_localize_script(
            'anchor',
            'anchorConfig',
            [
                'scrollThreshold' => (int) $settings['scroll_threshold'],
            ],
        );
    }

    /**
     * Print the sticky bar markup. Hidden by default; revealed by the script.
     */
    public function renderBar(): void
    {
        if (! $this->shouldRender()) {
            return;
        }

        $product = $this->currentProduct();

        if (! $product instanceof \WC_Product) {
            return;
        }

        // Never render a broken bar: skip products that cannot be purchased
        // (e.g. external/affiliate without price, or fully unpurchasable items).
        if (! $product->is_purchasable() && ! $product->is_type('variable')) {
            return;
        }

        $settings = $this->settings();

        $this->renderTemplate('sticky-bar', [
            'product'  => $product,
            'settings' => $settings,
        ]);
    }

    /**
     * The bar renders only when enabled, WooCommerce is present and we are on a
     * single product page.
     */
    private function shouldRender(): bool
    {
        if (! $this->isEnabled()) {
            return false;
        }

        if (! function_exists('is_product') || ! is_product()) {
            return false;
        }

        return true;
    }

    private function currentProduct(): ?\WC_Product
    {
        global $product;

        if ($product instanceof \WC_Product) {
            return $product;
        }

        $queried = wc_get_product(get_queried_object_id());

        return $queried instanceof \WC_Product ? $queried : null;
    }

    private function isEnabled(): bool
    {
        return (bool) ($this->settings()['enabled'] ?? false);
    }

    /**
     * Stored settings merged over packaged defaults.
     *
     * @return array<string, mixed>
     */
    private function settings(): array
    {
        $stored = get_option(self::OPTION, []);

        if (! is_array($stored)) {
            $stored = [];
        }

        /** @var array<string, mixed> $defaults */
        $defaults = require ANCHOR_DIR . 'config/defaults.php';

        return array_merge($defaults, $stored);
    }

    /**
     * @param array<string, mixed> $context
     */
    private function renderTemplate(string $template, array $context): void
    {
        $file = ANCHOR_DIR . 'templates/' . $template . '.php';

        if (! is_readable($file)) {
            return;
        }

        extract($context, EXTR_SKIP);
        require $file;
    }
}
