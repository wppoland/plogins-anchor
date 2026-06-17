<?php
/**
 * Sticky add-to-cart bar, printed on single product pages and revealed on scroll
 * by the Anchor front-end script. No layout shift: the bar is position:fixed and
 * starts hidden, so it never occupies document flow until shown.
 *
 * On variable products the form posts the resolved variation id; the script keeps
 * the price / availability / button state in sync with WooCommerce's native
 * variations form.
 *
 * @package Anchor
 *
 * @var \WC_Product          $product  The current product.
 * @var array<string, mixed> $settings Resolved plugin settings.
 */

declare(strict_types=1);

defined('ABSPATH') || exit;

// phpcs:disable WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedVariableFound -- Variables are local to the template include scope, not true globals.

if (! $product instanceof \WC_Product) {
    return;
}

$isVariable = $product->is_type('variable');

$productUrl   = $product->get_permalink();
?>
<div
    class="anchor-bar"
    id="anchor-bar"
    role="region"
    aria-label="<?php esc_attr_e('Add to cart', 'anchor'); ?>"
    aria-hidden="true"
    data-anchor-bar
    data-product-id="<?php echo esc_attr((string) $product->get_id()); ?>"
    data-product-type="<?php echo esc_attr($product->get_type()); ?>"
    hidden
>
    <div class="anchor-bar__inner">
        <div class="anchor-bar__info">
            <a class="anchor-bar__title" href="<?php echo esc_url($productUrl); ?>">
                <?php echo esc_html($product->get_name()); ?>
            </a>
            <span
                class="anchor-bar__price"
                data-anchor-price
                <?php if ($isVariable) : ?>
                aria-live="polite"
                aria-atomic="true"
                <?php endif; ?>
            >
                <?php echo wp_kses_post($product->get_price_html()); ?>
            </span>
        </div>

        <?php if ($isVariable) : ?>
            <?php // Variable products: the JS mirrors the native variation form. Until a
                  // variation is chosen the button scrolls back to the selectors. ?>
            <div class="anchor-bar__actions">
                <button
                    type="button"
                    class="button anchor-bar__button anchor-bar__button--choose"
                    data-anchor-choose
                >
                    <?php esc_html_e('Choose options', 'anchor'); ?>
                </button>
                <form
                    class="anchor-bar__form anchor-bar__form--variable"
                    method="post"
                    enctype="multipart/form-data"
                    action="<?php echo esc_url($productUrl); ?>"
                    data-anchor-form
                    hidden
                >
                    <input type="hidden" name="add-to-cart" value="<?php echo esc_attr((string) $product->get_id()); ?>" />
                    <input type="hidden" name="product_id" value="<?php echo esc_attr((string) $product->get_id()); ?>" />
                    <input type="hidden" name="variation_id" value="0" data-anchor-variation-id />
                    <button
                        type="submit"
                        class="button alt anchor-bar__button"
                        data-anchor-add
                        disabled
                    >
                        <?php esc_html_e('Add to cart', 'anchor'); ?>
                    </button>
                </form>
            </div>
        <?php elseif ($product->is_purchasable() && $product->is_in_stock()) : ?>
            <form
                class="anchor-bar__form anchor-bar__actions"
                method="post"
                enctype="multipart/form-data"
                action="<?php echo esc_url($productUrl); ?>"
                data-anchor-form
            >
                <input type="hidden" name="add-to-cart" value="<?php echo esc_attr((string) $product->get_id()); ?>" />
                <button type="submit" class="button alt anchor-bar__button" data-anchor-add>
                    <?php echo esc_html($product->single_add_to_cart_text()); ?>
                </button>
            </form>
        <?php else : ?>
            <div class="anchor-bar__actions">
                <a class="button anchor-bar__button" href="<?php echo esc_url($productUrl); ?>">
                    <?php echo esc_html($product->add_to_cart_text()); ?>
                </a>
            </div>
        <?php endif; ?>
    </div>
</div>
