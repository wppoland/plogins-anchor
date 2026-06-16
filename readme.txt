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
https://github.com/wppoland/anchor.

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

== Screenshots ==

1. The sticky add-to-cart bar on a product page.
2. The Anchor settings screen under WooCommerce.

== Changelog ==

= 0.1.0 =
* Initial release: a sticky add-to-cart bar on single product pages, revealed on scroll, with a configurable scroll threshold and variation-aware price/availability sync.
