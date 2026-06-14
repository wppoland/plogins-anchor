<?php

declare(strict_types=1);

namespace Anchor\Admin;

defined('ABSPATH') || exit;

use Anchor\Contract\HasHooks;

/**
 * Admin settings page registered as a WooCommerce submenu ("WooCommerce →
 * Anchor"). Stores settings in the `anchor_settings` option (array): the master
 * toggle and the scroll threshold.
 *
 * All output is escaped; all input is sanitised and clamped on save. The screen
 * uses manage_woocommerce so shop managers can configure it.
 */
final class Settings implements HasHooks
{
    private const OPTION = 'anchor_settings';
    private const PAGE   = 'anchor-settings';

    /** Scroll-threshold bounds, in pixels. */
    private const MIN_THRESHOLD = 0;
    private const MAX_THRESHOLD = 5000;

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
                    <?php esc_html_e('Anchor shows a slim, sticky add-to-cart bar at the bottom of your product pages once the shopper scrolls past the main button. It keeps the price and buy button one tap away on long pages — and stays in sync with WooCommerce variations. The bar is fixed to the viewport, so it never shifts your layout.', 'anchor'); ?>
                </p>
            </div>

            <form method="post" action="options.php">
                <?php settings_fields(self::PAGE); ?>

                <div class="anchor-card">
                    <h2><?php esc_html_e('Display', 'anchor'); ?></h2>
                    <table class="form-table" role="presentation">
                        <tbody>
                            <tr>
                                <th scope="row"><?php esc_html_e('Enable the bar', 'anchor'); ?></th>
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
                                    <p class="description">
                                        <?php esc_html_e('When off, the bar never renders and its CSS/JS are not loaded — zero front-end impact.', 'anchor'); ?>
                                    </p>
                                </td>
                            </tr>
                            <tr>
                                <th scope="row">
                                    <label for="anchor_scroll_threshold"><?php esc_html_e('Scroll threshold (px)', 'anchor'); ?></label>
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
                                            esc_html__('How far past the main add-to-cart form the shopper must scroll before the bar appears (%1$d–%2$d). 300 is a good default.', 'anchor'),
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

                <?php submit_button(); ?>
            </form>
        </div>
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

        $threshold = isset($raw['scroll_threshold']) ? absint($raw['scroll_threshold']) : 300;
        $threshold = max(self::MIN_THRESHOLD, min(self::MAX_THRESHOLD, $threshold));

        return [
            'enabled'          => ! empty($raw['enabled']),
            'scroll_threshold' => $threshold,
        ];
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
