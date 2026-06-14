<?php
/**
 * Default settings, merged under the option key `anchor_settings`.
 *
 * Anchor renders a sticky add-to-cart bar on single product pages once the
 * shopper scrolls past the main add-to-cart form. The merchant tunes its
 * position, where it shows (mobile / desktop), the scroll trigger and which
 * elements appear, from the WooCommerce → Anchor settings screen.
 *
 * @package Anchor
 *
 * @return array<string, mixed>
 */

declare(strict_types=1);

defined('ABSPATH') || exit;

return [
    // Master switch. When off, nothing renders and no assets load.
    'enabled' => true,

    // Bar position: 'bottom' (default) or 'top'.
    'position' => 'bottom',

    // Where the bar may appear.
    'show_on_desktop' => true,
    'show_on_mobile'  => true,

    // Pixels scrolled past the main add-to-cart form before the bar reveals.
    // Clamped to a sane range on save.
    'scroll_threshold' => 300,

    // Show the quantity field inside the bar.
    'show_quantity' => true,

    // Show the product thumbnail inside the bar.
    'show_thumbnail' => true,

    // Show the price inside the bar.
    'show_price' => true,
];
