=== Anchor - Sticky Add to Cart Bar for WooCommerce ===
Contributors: wppoland
Tags: woocommerce, add to cart, sticky, conversion, product page
Requires at least: 6.5
Tested up to: 7.0
Requires PHP: 8.1
Requires Plugins: woocommerce
Stable tag: 0.1.0
License: GPLv2 or later
License URI: https://www.gnu.org/licenses/gpl-2.0.html

A sticky add-to-cart bar that appears on scroll, boosting conversions on long WooCommerce product pages.

== Description ==

Anchor adds a slim, sticky add-to-cart bar to the bottom of your WooCommerce
single product pages. It stays out of the way until the shopper scrolls past the
main add-to-cart button, then slides into view with the product title, price and
a buy button — so the purchase is always one tap away, even on long pages.

The bar is **variation-aware**: on variable products it mirrors WooCommerce's
native variations form, updating the price, availability and the buy button as
the shopper picks options. Anchor adds no jQuery of its own — it simply listens
to the events WooCommerce already emits.

Because the bar is fixed to the edge of the viewport and starts hidden, it never
occupies document flow and causes **zero Cumulative Layout Shift**.

= Features =

* Sticky add-to-cart bar on single product pages, revealed on scroll.
* Configurable scroll threshold (how far past the main button to reveal).
* Shows the product title, price and a buy button.
* Variation-aware: price and availability stay in sync with the native form.
* Accessible: ARIA region, keyboard operable, visible focus, screen-reader text.
* Respects prefers-reduced-motion and is dark-mode aware.
* No layout shift — the bar is fixed and starts hidden.
* Translation ready (POT included) and clean uninstall.
* HPOS and cart/checkout blocks compatible.

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
deferred, and the bar is fixed to the viewport and hidden until needed, so it
never causes Cumulative Layout Shift.

== Screenshots ==

1. The sticky add-to-cart bar on a product page.
2. The Anchor settings screen under WooCommerce.

== Changelog ==

= 0.1.0 =
* Initial release: a sticky add-to-cart bar on single product pages, revealed on scroll, with a configurable scroll threshold and variation-aware price/availability sync.
