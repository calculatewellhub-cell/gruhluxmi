/**
 * WellHub Digital — vanilla JS interactions.
 * No build step required; loaded with `defer`.
 */
( function () {
	'use strict';

	function ready( fn ) {
		if ( document.readyState !== 'loading' ) {
			fn();
		} else {
			document.addEventListener( 'DOMContentLoaded', fn );
		}
	}

	function trapFocus( container ) {
		var focusable = container.querySelectorAll( 'a[href], button:not([disabled]), input, select, textarea, [tabindex]:not([tabindex="-1"])' );
		if ( ! focusable.length ) {
			return;
		}
		var first = focusable[0];
		var last = focusable[ focusable.length - 1 ];

		container.addEventListener( 'keydown', function ( e ) {
			if ( e.key !== 'Tab' ) {
				return;
			}
			if ( e.shiftKey && document.activeElement === first ) {
				e.preventDefault();
				last.focus();
			} else if ( ! e.shiftKey && document.activeElement === last ) {
				e.preventDefault();
				first.focus();
			}
		} );
	}

	ready( function () {
		/* Mobile menu */
		var menuToggle = document.getElementById( 'mobile-menu-toggle' );
		var menuClose = document.getElementById( 'mobile-menu-close' );
		var mobileNav = document.getElementById( 'mobile-navigation' );

		function openMenu() {
			mobileNav.classList.add( 'is-open' );
			menuToggle.setAttribute( 'aria-expanded', 'true' );
			document.body.style.overflow = 'hidden';
			trapFocus( mobileNav );
			var firstLink = mobileNav.querySelector( 'a, button' );
			if ( firstLink ) {
				firstLink.focus();
			}
		}

		function closeMenu() {
			mobileNav.classList.remove( 'is-open' );
			menuToggle.setAttribute( 'aria-expanded', 'false' );
			document.body.style.overflow = '';
			menuToggle.focus();
		}

		if ( menuToggle && mobileNav ) {
			menuToggle.addEventListener( 'click', function () {
				var isOpen = mobileNav.classList.contains( 'is-open' );
				isOpen ? closeMenu() : openMenu();
			} );
		}
		if ( menuClose ) {
			menuClose.addEventListener( 'click', closeMenu );
		}
		document.addEventListener( 'keydown', function ( e ) {
			if ( e.key === 'Escape' && mobileNav && mobileNav.classList.contains( 'is-open' ) ) {
				closeMenu();
			}
		} );

		/* Header search toggle */
		var searchToggle = document.getElementById( 'search-toggle' );
		var searchForm = document.getElementById( 'header-search-form' );
		if ( searchToggle && searchForm ) {
			searchToggle.addEventListener( 'click', function () {
				var isActive = searchForm.classList.toggle( 'is-active' );
				searchToggle.setAttribute( 'aria-expanded', isActive ? 'true' : 'false' );
				if ( isActive ) {
					var input = searchForm.querySelector( 'input[type="search"]' );
					if ( input ) {
						input.focus();
					}
				}
			} );
		}

		/* Submenu keyboard accessibility (desktop dropdowns) */
		document.querySelectorAll( '.primary-navigation .menu-item-has-children > a' ).forEach( function ( link ) {
			link.addEventListener( 'focus', function () {
				var parent = link.closest( 'li' );
				document.querySelectorAll( '.primary-navigation li.is-open' ).forEach( function ( openLi ) {
					if ( openLi !== parent ) {
						openLi.classList.remove( 'is-open' );
					}
				} );
			} );
		} );

		/* Live-update cart count after AJAX add-to-cart. WooCommerce's
		 * own add-to-cart script triggers this as a jQuery event, so
		 * jQuery (already loaded by WooCommerce on these pages) is used
		 * for this one integration point rather than reinventing it. */
		if ( window.jQuery ) {
			window.jQuery( document.body ).on( 'added_to_cart', function ( e, fragments ) {
				var countEl = document.querySelector( '.wellhub-cart-count' );
				if ( countEl && fragments && fragments[ 'div.widget_shopping_cart_content' ] ) {
					var match = fragments[ 'div.widget_shopping_cart_content' ].match( /(\d+)\s*item/i );
					if ( match ) {
						countEl.textContent = match[1];
					}
				}
			} );
		}
	} );
} )();
