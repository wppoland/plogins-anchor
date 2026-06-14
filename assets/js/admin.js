/**
 * Anchor — admin settings enhancements (progressive, dependency-free).
 *
 * Wires each "?" help button to an accessible popover. Where the native Popover
 * API exists it is used; otherwise a small show/hide fallback keeps it keyboard-
 * and screen-reader-operable via aria-expanded. Loaded with `defer`; with JS
 * disabled, all settings still save and descriptions remain visible.
 */
( function () {
	'use strict';

	var root = document.querySelector( '.anchor-admin' );

	if ( ! root ) {
		return;
	}

	var supportsPopover =
		typeof HTMLElement !== 'undefined' &&
		HTMLElement.prototype.hasOwnProperty( 'popover' );

	function closeAllFallback( except ) {
		root.querySelectorAll( '.anchor-help[aria-expanded="true"]' ).forEach(
			function ( btn ) {
				if ( btn === except ) {
					return;
				}
				btn.setAttribute( 'aria-expanded', 'false' );
				var tip = document.getElementById(
					btn.getAttribute( 'aria-describedby' )
				);
				if ( tip ) {
					tip.hidden = true;
				}
			}
		);
	}

	root.addEventListener( 'click', function ( event ) {
		var btn = event.target.closest( '.anchor-help' );

		if ( ! btn || supportsPopover ) {
			return;
		}

		// Native Popover handles its own toggling; this is the fallback only.
		var tip = document.getElementById(
			btn.getAttribute( 'aria-describedby' )
		);

		if ( ! tip ) {
			return;
		}

		var open = btn.getAttribute( 'aria-expanded' ) === 'true';
		closeAllFallback( btn );
		btn.setAttribute( 'aria-expanded', String( ! open ) );
		tip.hidden = open;
	} );

	if ( ! supportsPopover ) {
		document.addEventListener( 'keydown', function ( event ) {
			if ( event.key === 'Escape' ) {
				closeAllFallback( null );
			}
		} );

		document.addEventListener( 'click', function ( event ) {
			if ( ! event.target.closest( '.anchor-help, .anchor-tip' ) ) {
				closeAllFallback( null );
			}
		} );
	}
} )();
