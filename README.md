# Anchor — Sticky Add to Cart Bar for WooCommerce

A sticky add-to-cart bar that appears on scroll, boosting conversions on long
WooCommerce product pages. FREE, wp.org-ready, and fully self-contained (no
shared kit dependency).

## What it does

On single product pages Anchor prints a slim bar that stays hidden until the
shopper scrolls past the main add-to-cart form, then slides into view with the
product thumbnail, title, price, an optional quantity field and a buy button.
It is **variation-aware**: on variable products it mirrors WooCommerce's native
variations form (price, availability, resolved variation id) without adding any
jQuery of its own. The bar is fixed to the viewport and starts hidden, so it
causes **zero Cumulative Layout Shift**.

## Settings (WooCommerce → Anchor)

- Master enable toggle.
- Position: top or bottom of the screen.
- Show on desktop / show on mobile (independent).
- Scroll threshold (px past the main button before reveal).
- Show or hide the thumbnail, price and quantity field.

## Architecture

- **Bootstrap** (`anchor.php`): PHP/WC guards, HPOS + cart-blocks compat, boot on
  `init` priority 0, `do_action('anchor/booted', Plugin::instance())` fired from
  `Plugin::boot()` (the hook the PRO companion extends).
- **Autoload** (`autoload.php`): Composer vendor autoloader + a minimal PSR-4
  fallback. No external runtime packages.
- **DI**: `src/Plugin.php` singleton + `src/Container.php`; services in
  `config/services.php`, boot order in `config/hooks.php`, defaults in
  `config/defaults.php`; `src/Migrator.php` seeds defaults.
- **Front end**: `src/Service/StickyBar.php` renders `templates/sticky-bar.php`
  and enqueues `assets/{css,js}/anchor.*` only on product pages.
- **Admin**: `src/Admin/Settings.php` (Settings API, manage_woocommerce).

## Quality gates

```bash
composer install
composer cs        # PHPCS (WordPress security ruleset)
composer analyse   # PHPStan level 6 + WooCommerce stubs
```

CI (`.github/workflows/ci.yml`) calls the shared `wppoland/workflows@v1` reusable
workflow and runs the official WordPress Plugin Check as the wp.org submission
gate.
