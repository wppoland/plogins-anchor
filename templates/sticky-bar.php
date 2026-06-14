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

$position      = ($settings['position'] ?? 'bottom') === 'top' ? 'top' : 'bottom';
$showOnDesktop = ! empty($settings['show_on_desktop']);
$showOnMobile  = ! empty($settings['show_on_mobile']);
$showQuantity  = ! empty($settings['show_quantity']);
$showThumbnail = ! empty($settings['show_thumbnail']);
$showPrice     = ! empty($settings['show_price']);

$isVariable = $product->is_type('variable');

$classes = sprintf(
    'anchor-bar anchor-bar--%s%s%s',
    sanitize_html_class($position),
    $showOnDesktop ? '' : ' anchor-bar--hide-desktop',
    $showOnMobile ? '' : ' anchor-bar--hide-mobile',
);

$productUrl = $product->get_permalink();
$addToCartUrl = method_exists($product, 'add_to_cart_url') ? $product->add_to_cart_url() : $productUrl;

// Quantity bounds, mirroring WooCommerce's native quantity input.
$minQty  = 1;
$maxQty  = $product->get_max_purchase_quantity();
$stepQty = 1;
?>
<div
    class="<?php echo esc_attr($classes); ?>"
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
        <?php if ($showThumbnail) : ?>
            <div class="anchor-bar__media" aria-hidden="true">
                <?php
                echo wp_kses_post(
                    $product->get_image(
                        'woocommerce_gallery_thumbnail',
                        ['class' => 'anchor-bar__thumb', 'loading' => 'lazy', 'decoding' => 'async'],
                    ),
                );
                ?>
            </div>
        <?php endif; ?>

        <div class="anchor-bar__info">
            <a class="anchor-bar__title" href="<?php echo esc_url($productUrl); ?>">
                <?php echo esc_html($product->get_name()); ?>
            </a>
            <?php if ($showPrice) : ?>
                <span class="anchor-bar__price" data-anchor-price>
                    <?php echo wp_kses_post($product->get_price_html()); ?>
                </span>
            <?php endif; ?>
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
                    <?php if ($showQuantity) : ?>
                        <label class="screen-reader-text" for="anchor-qty">
                            <?php esc_html_e('Quantity', 'anchor'); ?>
                        </label>
                        <input
                            type="number"
                            id="anchor-qty"
                            class="anchor-bar__qty"
                            name="quantity"
                            value="<?php echo esc_attr((string) $minQty); ?>"
                            min="<?php echo esc_attr((string) $minQty); ?>"
                            <?php echo $maxQty > 0 ? 'max="' . esc_attr((string) $maxQty) . '"' : ''; ?>
                            step="<?php echo esc_attr((string) $stepQty); ?>"
                            inputmode="numeric"
                        />
                    <?php endif; ?>
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
                <?php if ($showQuantity && ! $product->is_sold_individually()) : ?>
                    <label class="screen-reader-text" for="anchor-qty">
                        <?php esc_html_e('Quantity', 'anchor'); ?>
                    </label>
                    <input
                        type="number"
                        id="anchor-qty"
                        class="anchor-bar__qty"
                        name="quantity"
                        value="<?php echo esc_attr((string) $minQty); ?>"
                        min="<?php echo esc_attr((string) $minQty); ?>"
                        <?php echo $maxQty > 0 ? 'max="' . esc_attr((string) $maxQty) . '"' : ''; ?>
                        step="<?php echo esc_attr((string) $stepQty); ?>"
                        inputmode="numeric"
                    />
                <?php endif; ?>
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
