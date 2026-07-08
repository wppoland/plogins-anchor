=== Plogins Anchor - Sticky Add to Cart for WooCommerce ===
Contributors: motylanogha
Tags: woocommerce, add to cart, sticky, conversion, product page
Requires at least: 6.5
Tested up to: 7.0
Requires PHP: 8.1
Requires Plugins: woocommerce
Stable tag: 1.0.2
License: GPLv2 or later
License URI: https://www.gnu.org/licenses/gpl-2.0.html

Keeps the add-to-cart button in reach on long WooCommerce product pages with a sticky bar that appears on scroll.

== Description ==

Anchor adds a slim sticky add-to-cart bar to the bottom of your WooCommerce
single product pages. It stays hidden until the shopper scrolls past the main
add-to-cart button, then slides into view showing the product title, price and a
buy button, so the add-to-cart control is still reachable on long pages.

On variable products the bar follows the native variations form. As the shopper
picks options, the price, stock status and the buy button update to match the
selected variation. Anchor does not load its own copy of jQuery; it listens to
the variation events WooCommerce already fires.

The bar is positioned with CSS `position: fixed` and starts hidden, so it sits
outside the document flow and does not push other content around or cause
layout shift when it appears.

Anchor is not on the WordPress.org directory yet, so if you want to read the
code, report a bug or suggest a change, the repository is at
https://github.com/wppoland/plogins-anchor.

= Documentation and links =

* **Documentation** - https://plogins.com/plogins-anchor/docs/
* **Plugin page** - https://plogins.com/plogins-anchor/
* **Source code** - https://github.com/wppoland/plogins-anchor
* **Bug reports and feature requests** - https://github.com/wppoland/plogins-anchor/issues


= Features =

* Sticky add-to-cart bar on single product pages, revealed once the shopper scrolls past the main button.
* Scroll threshold you set in pixels (0 to 5000), so you decide how far down the bar kicks in.
* Shows the product title, price and a buy button.
* On variable products the price and stock status track the variation the shopper has selected.
* Marked up as an ARIA region with a visible focus state and screen-reader label.
* Honours prefers-reduced-motion and has a dark-mode style.
* The bar is fixed to the viewport and starts hidden, so it does not cause layout shift.
* Ships with a POT file for translation, and deleting the plugin removes the two options it stores.
* Declares HPOS and cart/checkout blocks compatibility.

== Installation ==

1. Upload the plugin to `/wp-content/plugins/anchor`, or install via Plugins → Add New.
2. Activate it. WooCommerce must be active.
3. Go to **WooCommerce → Anchor** to enable the bar and set the scroll threshold.

== Frequently Asked Questions ==

= Does it require WooCommerce? =

Yes. Anchor only runs when WooCommerce is active.

= Does it work with variable products? =

Yes. The bar mirrors WooCommerce's native variations form: pick options on the
page and the bar's price, availability and buy button update to match.

= Will it slow my product pages down or shift the layout? =

No. The stylesheet and script load only on single product pages, the script is
deferred, and the bar is fixed to the viewport and hidden until it is needed.
Because it starts outside the document flow, showing it does not shift the page.

= Can I change when the bar appears? =

Yes. Set the scroll threshold in pixels under **WooCommerce → Anchor** (0–5000).

= Does it work on simple products? =

Yes. On simple products the bar shows the title, price and add-to-cart button. On variable products it tracks the selected variation.


= Does this plugin work on WordPress Multisite? =

Yes. This plugin is compatible with WordPress Multisite. Network activate it or activate it on individual sites; each site keeps its own settings and data.

== Screenshots ==

1. The sticky add-to-cart bar on a product page.
2. The Anchor settings screen under WooCommerce.

== External Services ==

Anchor does not connect to any external services. It sends no data off your site
and loads nothing from a third-party CDN; its stylesheet and script (`assets/css/anchor.css`
and `assets/js/anchor.js`) are served from your own install, and the front-end script reads
only a small `anchorConfig` object (the scroll threshold) that WordPress prints inline.

All of Anchor's data stays in your database: it stores two autoloaded-off options,
`anchor_settings` (the enable toggle and scroll threshold) and `anchor_db_version`,
and keeps no per-product data. Both options are removed when you delete the plugin.
Anchor sends no email and makes no HTTP requests of its own.

== Translations ==

Plogins Anchor includes Polish, German and Spanish translations for the plugin interface. The text domain is `plogins-anchor`, so WordPress.org language packs can also override or extend these bundled translations.

== Changelog ==

= 1.0.2 =
* Added bundled Polish, German and Spanish translations for the plugin interface.

= 1.0.1 =
* First stable release.

= 0.1.3 =
* Renamed to Plogins Anchor for WooCommerce for a more distinctive plugin name.

= 0.1.2 =
* Add `anchor/bar_rendered` action and `anchor:bar-visible` front-end event for PRO analytics.

= 0.1.1 =
* `anchor/bar_visible` filter so PRO and custom code can hide the bar per product without loading assets.

= 0.1.0 =
* Initial release: a sticky add-to-cart bar on single product pages, revealed on scroll, with a configurable scroll threshold and variation-aware price/availability sync.
