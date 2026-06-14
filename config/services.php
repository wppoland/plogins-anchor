<?php
/**
 * Service wiring. Returns a closure that registers every service in the
 * container. Anchor is self-contained: the sticky-bar logic lives in
 * {@see \Anchor\Service\StickyBar} and the admin screen in
 * {@see \Anchor\Admin\Settings}.
 *
 * @package Anchor
 */

declare(strict_types=1);

use Anchor\Admin\Settings;
use Anchor\Container;
use Anchor\Migrator;
use Anchor\Service\StickyBar;

defined('ABSPATH') || exit;

return static function (Container $c): void {
    $c->singleton(Migrator::class, static fn (): Migrator => new Migrator());

    // Front-end sticky add-to-cart bar.
    $c->singleton(StickyBar::class, static fn (): StickyBar => new StickyBar());

    // Admin (only needed in wp-admin context).
    if (is_admin()) {
        $c->singleton(Settings::class, static fn (): Settings => new Settings());
    }
};
