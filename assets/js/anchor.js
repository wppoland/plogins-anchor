/**
 * Anchor, sticky add-to-cart bar (front-end).
 *
 * Responsibilities:
 *  1. Reveal the bar once the shopper scrolls past the native add-to-cart form,
 *     using an IntersectionObserver (no scroll-event thrash, no layout reads).
 *  2. On variable products, mirror WooCommerce's native variation form: when a
 *     variation is found, copy its price / availability into the bar and enable
 *     the add button; on reset, disable it again.
 *
 * The bar starts hidden (`hidden` + aria-hidden), so it never causes layout
 * shift. We add no jQuery of our own; we only *listen* to the events WooCommerce
 * already emits on the variations form when jQuery is present.
 */
( function () {
	'use strict';

	var config = window.anchorConfig || {};
	var bar = document.getElementById( 'anchor-bar' );

	if ( ! bar ) {
		return;
	}

	/* ---- Reveal on scroll ------------------------------------------------ */

	var anchorTarget =
		document.querySelector( '.single-product form.cart' ) ||
		document.querySelector( 'form.cart' ) ||
		document.querySelector( '.summary' );

	var threshold = parseInt( config.scrollThreshold, 10 );
	if ( isNaN( threshold ) || threshold < 0 ) {
		threshold = 300;
	}

	var hasCaught = false;

	function show() {
		if ( bar.hasAttribute( 'hidden' ) ) {
			bar.hidden = false;
		}
		bar.setAttribute( 'aria-hidden', 'false' );
		bar.classList.add( 'is-visible' );
		bar.dispatchEvent( new CustomEvent( 'anchor:bar-visible', { bubbles: true } ) );

		// Presentation only: play the "anchor catches" settle once, the first time
		// the bar lands. Re-show on later scrolls just slides; it doesn't re-settle.
		if ( ! hasCaught ) {
			hasCaught = true;
			bar.classList.add( 'is-settled' );
		}
	}

	function hide() {
		bar.setAttribute( 'aria-hidden', 'true' );
		bar.classList.remove( 'is-visible' );
	}

	if ( 'IntersectionObserver' in window && anchorTarget ) {
		// Reveal when the native form leaves the viewport (scrolled past), using a
		// POSITIVE top root margin so the threshold maps to "px past the form".
		//
		// This used to be a negative margin, which shrinks the root from the top and
		// so runs the setting backwards: the merchant read "higher keeps it hidden
		// longer", raised it to 800, and the shopper got the bar 800px before the
		// form had even left the screen. Growing the root upwards instead means the
		// form only stops intersecting once its bottom edge is `threshold` px above
		// the top of the viewport, which is what the settings screen promises.
		var observer = new IntersectionObserver(
			function ( entries ) {
				entries.forEach( function ( entry ) {
					if ( entry.isIntersecting ) {
						hide();
					} else if ( entry.boundingClientRect.top < 0 ) {
						// Only show when the form scrolled UP and away (not before it).
						show();
					}
				} );
			},
			{ rootMargin: threshold + 'px 0px 0px 0px', threshold: 0 }
		);
		observer.observe( anchorTarget );
	} else {
		// Fallback: simple, throttled scroll check.
		var ticking = false;
		window.addEventListener(
			'scroll',
			function () {
				if ( ticking ) {
					return;
				}
				ticking = true;
				window.requestAnimationFrame( function () {
					// Same meaning as the observer path: px scrolled past the form,
					// falling back to raw page scroll only when there is no form.
					var past = anchorTarget
						? -anchorTarget.getBoundingClientRect().bottom
						: window.pageYOffset;

					if ( past > threshold ) {
						show();
					} else {
						hide();
					}
					ticking = false;
				} );
			},
			{ passive: true }
		);
	}

	/* ---- "Choose options" jump (variable products) ----------------------- */

	var chooseBtn = bar.querySelector( '[data-anchor-choose]' );
	if ( chooseBtn && anchorTarget ) {
		chooseBtn.addEventListener( 'click', function () {
			anchorTarget.scrollIntoView( { behavior: 'smooth', block: 'center' } );
			var firstSelect = anchorTarget.querySelector( 'select' );
			if ( firstSelect ) {
				firstSelect.focus( { preventScroll: true } );
			}
		} );
	}

	/* ---- Variation sync -------------------------------------------------- */

	if ( bar.getAttribute( 'data-product-type' ) !== 'variable' ) {
		return;
	}

	var priceEl = bar.querySelector( '[data-anchor-price]' );
	var addBtn = bar.querySelector( '[data-anchor-add]' );
	var variationInput = bar.querySelector( '[data-anchor-variation-id]' );
	var form = bar.querySelector( '[data-anchor-form]' );
	var chooseWrap = chooseBtn;

	var variationsForm = document.querySelector( '.variations_form' );

	// WooCommerce variation events are emitted via jQuery. Use it only if present
	// (WooCommerce ships it); otherwise the bar stays in its safe "choose" state.
	var jq = window.jQuery;
	if ( ! variationsForm || ! jq ) {
		return;
	}

	function setChosen( variation ) {
		if ( variationInput ) {
			variationInput.value = variation.variation_id || 0;
		}
		if ( priceEl && variation.price_html ) {
			priceEl.innerHTML = variation.price_html;
		}
		if ( addBtn ) {
			addBtn.disabled = ! variation.is_purchasable || ! variation.is_in_stock;
		}
		if ( form ) {
			form.hidden = false;
		}
		if ( chooseWrap ) {
			chooseWrap.hidden = true;
		}
	}

	function setUnchosen() {
		if ( variationInput ) {
			variationInput.value = 0;
		}
		if ( addBtn ) {
			addBtn.disabled = true;
		}
		if ( form ) {
			form.hidden = true;
		}
		if ( chooseWrap ) {
			chooseWrap.hidden = false;
		}
	}

	jq( variationsForm ).on( 'found_variation', function ( event, variation ) {
		if ( variation ) {
			setChosen( variation );
		}
	} );

	jq( variationsForm ).on( 'reset_data hide_variation', function () {
		setUnchosen();
	} );
} )();
