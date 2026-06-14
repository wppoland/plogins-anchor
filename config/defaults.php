<?php
/**
 * Default settings, merged under the option key `anchor_settings`.
 *
 * Anchor renders a sticky add-to-cart bar on single product pages once the
 * shopper scrolls past the main add-to-cart form. The merchant enables it and
 * tunes the scroll trigger from the WooCommerce → Anchor settings screen.
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

    // Pixels scrolled past the main add-to-cart form before the bar reveals.
    // Clamped to a sane range on save.
    'scroll_threshold' => 300,
];
