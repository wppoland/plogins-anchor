<?php
/**
 * Boot order: services listed here are resolved from the container and have
 * their registerHooks() called during Plugin::boot(). Each must implement
 * Anchor\Contract\HasHooks.
 *
 * @package Anchor
 *
 * @return array<class-string>
 */

declare(strict_types=1);

use Anchor\Admin\Settings;
use Anchor\Service\StickyBar;

defined('ABSPATH') || exit;

return is_admin()
    ? [
        StickyBar::class,
        Settings::class,
    ]
    : [
        StickyBar::class,
    ];
