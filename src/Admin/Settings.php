<?php

declare(strict_types=1);

namespace Anchor\Admin;

defined('ABSPATH') || exit;

use Anchor\Contract\HasHooks;

/**
 * Admin settings page registered as a WooCommerce submenu ("WooCommerce →
 * Anchor"). Stores settings in the `anchor_settings` option (array): the master
 * toggle, bar position, device gates, scroll threshold and which elements
 * (thumbnail / price / quantity) appear.
 *
 * All output is escaped; all input is sanitised and clamped on save. The screen
 * uses manage_woocommerce so shop managers can configure it.
 */
final class Settings implements HasHooks
{
    private const OPTION = 'anchor_settings';
    private const PAGE   = 'anchor-settings';

    /** Allowed bar positions (mapped to CSS classes by the template). */
    private const POSITIONS = ['bottom', 'top'];

    /** Scroll-threshold bounds, in pixels. */
    private const MIN_THRESHOLD = 0;
    private const MAX_THRESHOLD = 5000;

    /** Incremented to give each inline-help control a unique id/anchor. */
    private int $helpSeq = 0;

    public function registerHooks(): void
    {
        add_action('admin_menu', [$this, 'addMenuPage']);
        add_action('admin_init', [$this, 'registerSettings']);
        add_action('admin_enqueue_scripts', [$this, 'enqueueAssets']);
    }

    public function enqueueAssets(string $hook): void
    {
        if ($hook !== 'woocommerce_page_' . self::PAGE) {
            return;
        }

        wp_enqueue_style(
            'anchor-admin',
            ANCHOR_URL . 'assets/css/admin.css',
            [],
            \Anchor\VERSION,
        );

        wp_enqueue_script(
            'anchor-admin',
            ANCHOR_URL . 'assets/js/admin.js',
            [],
            \Anchor\VERSION,
            ['in_footer' => true, 'strategy' => 'defer'],
        );
    }

    public function addMenuPage(): void
    {
        add_submenu_page(
            'woocommerce',
            __('Anchor — Sticky Add to Cart Bar', 'anchor'),
            __('Anchor', 'anchor'),
            'manage_woocommerce',
            self::PAGE,
            [$this, 'renderPage'],
        );
    }

    public function registerSettings(): void
    {
        register_setting(
            self::PAGE,
            self::OPTION,
            [
                'type'              => 'array',
                'sanitize_callback' => [$this, 'sanitize'],
            ],
        );

        // Align the options.php save capability with the menu cap so shop
        // managers (not just admins with manage_options) can save.
        add_filter(
            'option_page_capability_' . self::PAGE,
            static fn (): string => 'manage_woocommerce',
        );
    }

    public function renderPage(): void
    {
        if (! current_user_can('manage_woocommerce')) {
            return;
        }

        $settings = $this->settings();
        ?>
        <div class="wrap anchor-admin">
            <h1><?php echo esc_html(get_admin_page_title()); ?></h1>

            <div class="anchor-intro">
                <p>
                    <?php esc_html_e('Anchor shows a slim, sticky add-to-cart bar on your product pages once the shopper scrolls past the main button. It keeps the price and buy button one tap away on long pages — and stays in sync with WooCommerce variations. The bar is fixed to the viewport, so it never shifts your layout.', 'anchor'); ?>
                </p>
            </div>

            <form method="post" action="options.php">
                <?php settings_fields(self::PAGE); ?>

                <div class="anchor-card">
                    <h2><?php esc_html_e('Display', 'anchor'); ?></h2>
                    <table class="form-table" role="presentation">
                        <tbody>
                            <tr>
                                <th scope="row">
                                    <?php esc_html_e('Enable the bar', 'anchor'); ?>
                                    <?php $this->help(__('The master switch. When off, the sticky bar never renders and its CSS/JS are not loaded — zero front-end impact.', 'anchor')); ?>
                                </th>
                                <td>
                                    <label for="anchor_enabled">
                                        <input
                                            type="checkbox"
                                            id="anchor_enabled"
                                            name="<?php echo esc_attr(self::OPTION); ?>[enabled]"
                                            value="1"
                                            <?php checked((bool) ($settings['enabled'] ?? false), true); ?>
                                        />
                                        <?php esc_html_e('Show the sticky add-to-cart bar on single product pages.', 'anchor'); ?>
                                    </label>
                                </td>
                            </tr>
                            <tr>
                                <th scope="row">
                                    <label for="anchor_position"><?php esc_html_e('Position', 'anchor'); ?></label>
                                    <?php $this->help(__('Bottom is the most common and works well on mobile. Top suits stores with a sticky header you want to complement.', 'anchor')); ?>
                                </th>
                                <td>
                                    <select id="anchor_position" name="<?php echo esc_attr(self::OPTION); ?>[position]">
                                        <?php
                                        $current   = (string) ($settings['position'] ?? 'bottom');
                                        $posLabels = [
                                            'bottom' => __('Bottom of the screen', 'anchor'),
                                            'top'    => __('Top of the screen', 'anchor'),
                                        ];
                                        foreach (self::POSITIONS as $pos) :
                                            ?>
                                            <option value="<?php echo esc_attr($pos); ?>" <?php selected($current, $pos); ?>>
                                                <?php echo esc_html($posLabels[$pos] ?? $pos); ?>
                                            </option>
                                        <?php endforeach; ?>
                                    </select>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>

                <div class="anchor-card">
                    <h2><?php esc_html_e('Where to show it', 'anchor'); ?></h2>
                    <table class="form-table" role="presentation">
                        <tbody>
                            <?php
                            $this->checkboxRow(
                                'show_on_desktop',
                                __('Desktop', 'anchor'),
                                __('Show the bar on desktop screens (wider than 768px).', 'anchor'),
                                $settings,
                                __('Turn off if you only want the bar on phones, where long product pages make scrolling back up costly.', 'anchor'),
                            );
                            $this->checkboxRow(
                                'show_on_mobile',
                                __('Mobile', 'anchor'),
                                __('Show the bar on mobile screens (768px and narrower).', 'anchor'),
                                $settings,
                                __('Mobile shoppers benefit most from a one-tap buy bar. Leave this on for the biggest conversion lift.', 'anchor'),
                            );
                            ?>
                            <tr>
                                <th scope="row">
                                    <label for="anchor_scroll_threshold"><?php esc_html_e('Scroll threshold (px)', 'anchor'); ?></label>
                                    <?php $this->help(__('How far past the main add-to-cart button the shopper must scroll before the bar appears. Lower reveals it sooner; higher waits longer. 300 is a good default.', 'anchor')); ?>
                                </th>
                                <td>
                                    <input
                                        type="number"
                                        id="anchor_scroll_threshold"
                                        name="<?php echo esc_attr(self::OPTION); ?>[scroll_threshold]"
                                        value="<?php echo esc_attr((string) (int) ($settings['scroll_threshold'] ?? 300)); ?>"
                                        min="<?php echo esc_attr((string) self::MIN_THRESHOLD); ?>"
                                        max="<?php echo esc_attr((string) self::MAX_THRESHOLD); ?>"
                                        step="10"
                                        class="small-text"
                                    />
                                    <p class="description">
                                        <?php
                                        printf(
                                            /* translators: 1: minimum px, 2: maximum px. */
                                            esc_html__('Pixels scrolled past the main add-to-cart form (%1$d–%2$d).', 'anchor'),
                                            (int) self::MIN_THRESHOLD,
                                            (int) self::MAX_THRESHOLD,
                                        );
                                        ?>
                                    </p>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>

                <div class="anchor-card">
                    <h2><?php esc_html_e('What to show in the bar', 'anchor'); ?></h2>
                    <table class="form-table" role="presentation">
                        <tbody>
                            <?php
                            $this->checkboxRow(
                                'show_thumbnail',
                                __('Product thumbnail', 'anchor'),
                                __('Show a small product image in the bar.', 'anchor'),
                                $settings,
                                __('A thumbnail reassures shoppers which product they are buying. It is hidden automatically on small screens to save space.', 'anchor'),
                            );
                            $this->checkboxRow(
                                'show_price',
                                __('Price', 'anchor'),
                                __('Show the product price in the bar.', 'anchor'),
                                $settings,
                                __('On variable products the price updates automatically as the shopper picks options, matching the native form.', 'anchor'),
                            );
                            $this->checkboxRow(
                                'show_quantity',
                                __('Quantity field', 'anchor'),
                                __('Show a quantity input in the bar.', 'anchor'),
                                $settings,
                                __('Lets shoppers buy more than one without scrolling back up. Hidden automatically for sold-individually products.', 'anchor'),
                            );
                            ?>
                        </tbody>
                    </table>
                </div>

                <?php
                /**
                 * Fires after Anchor's own settings cards, before the submit
                 * button. PRO add-ons render their extra settings cards here.
                 * Any fields they print are saved under the same option and
                 * preserved by the sanitize filter below.
                 *
                 * @param array<string, mixed> $settings Resolved settings.
                 * @param string               $option   The option name.
                 */
                do_action('anchor_admin_settings_after_cards', $settings, self::OPTION);
                ?>

                <?php submit_button(); ?>
            </form>
        </div>
        <?php
    }

    /**
     * Render an accessible inline-help affordance: a "?" button that toggles a
     * popover describing the adjacent setting. Uses the native Popover API and is
     * wired via aria-describedby; the bundled script supplies a fallback for
     * browsers without Popover support.
     */
    private function help(string $text): void
    {
        $id = 'anchor-help-' . (++$this->helpSeq);
        ?>
        <button
            type="button"
            class="anchor-help"
            aria-label="<?php esc_attr_e('More information', 'anchor'); ?>"
            aria-describedby="<?php echo esc_attr($id); ?>"
            aria-expanded="false"
            popovertarget="<?php echo esc_attr($id); ?>"
        >?</button>
        <div id="<?php echo esc_attr($id); ?>" class="anchor-tip" role="tooltip" popover hidden>
            <?php echo esc_html($text); ?>
        </div>
        <?php
    }

    /**
     * Render a single checkbox row in the form-table.
     *
     * @param array<string, mixed> $settings
     */
    private function checkboxRow(string $key, string $label, string $help, array $settings, string $tip = ''): void
    {
        $id = 'anchor_' . $key;
        ?>
        <tr>
            <th scope="row">
                <?php echo esc_html($label); ?>
                <?php if ($tip !== '') {
                    $this->help($tip);
                } ?>
            </th>
            <td>
                <label for="<?php echo esc_attr($id); ?>">
                    <input
                        type="checkbox"
                        id="<?php echo esc_attr($id); ?>"
                        name="<?php echo esc_attr(self::OPTION); ?>[<?php echo esc_attr($key); ?>]"
                        value="1"
                        <?php checked((bool) ($settings[$key] ?? false), true); ?>
                    />
                    <?php echo esc_html($help); ?>
                </label>
            </td>
        </tr>
        <?php
    }

    /**
     * Sanitises, validates and clamps the submitted settings before save.
     *
     * @param mixed $raw
     * @return array<string, mixed>
     */
    public function sanitize(mixed $raw): array
    {
        if (! is_array($raw)) {
            $raw = [];
        }

        $position = isset($raw['position']) ? sanitize_key((string) $raw['position']) : 'bottom';

        if (! in_array($position, self::POSITIONS, true)) {
            $position = 'bottom';
        }

        $threshold = isset($raw['scroll_threshold']) ? absint($raw['scroll_threshold']) : 300;
        $threshold = max(self::MIN_THRESHOLD, min(self::MAX_THRESHOLD, $threshold));

        $sanitized = [
            'enabled'          => ! empty($raw['enabled']),
            'position'         => $position,
            'show_on_desktop'  => ! empty($raw['show_on_desktop']),
            'show_on_mobile'   => ! empty($raw['show_on_mobile']),
            'scroll_threshold' => $threshold,
            'show_quantity'    => ! empty($raw['show_quantity']),
            'show_thumbnail'   => ! empty($raw['show_thumbnail']),
            'show_price'       => ! empty($raw['show_price']),
        ];

        return (array) apply_filters('anchor_sanitize_settings', $sanitized, $raw);
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
}
