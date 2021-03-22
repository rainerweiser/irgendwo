/**
 * Handles pagination!
 */

var envira_pagination_requesting = false;

jQuery( document ).ready(
	function( $ ) {

			/* AJAX Load on Pagination Click */
			$( document ).on(
				'click',
				'div.envira-pagination-ajax-load a',
				function( e ) {

					/* Prevent default action */
					e.preventDefault();

					/* If we're already performing a request, don't do anything */
					if ( envira_pagination_requesting ) {
						 return;
					}

					/* Flag that we're making a request */
					envira_pagination_requesting = true;

					/* Setup some vars */
					var envira_pagination_container = $( this ).parent(),
					envira_pagination_id            = $( envira_pagination_container ).parent().attr( 'id' ).split( 'envira-gallery-wrap-' )[1],
					envira_pagination_wrapped       = $( envira_pagination_container ).parent().find( 'div#envira-gallery-' + envira_pagination_id ),
					envira_pagination_type          = $( envira_pagination_container ).data( 'type' ),
					envira_pagination_page          = envira_pagination_get_query_arg( 'page', $( this ).attr( 'href' ) ),
					envira_gallery_proof_email      = Cookies.get( 'envira_proofing_email' ),
					envira_post_id                  = envira_pagination_container.data( 'envira-post-id' );

					/* envira_post_id might be undefined beyond page 1 in cases like instagram */
					if ( envira_post_id == undefined || envira_post_id == '' ) {
						 envira_post_id = envira_pagination_id;
					}

					/* Locate any divs in envira-gallery-position-overlay that aren't hidden - make sure they are still not hidden after new page is loaded */
					var visible_divs = [];
					envira_pagination_wrapped.find( '.envira-gallery-position-overlay:first > div' ).each( function(){ console.log( this ); visible_divs.push( $( this ).attr( "class" ) ); } );

					/* Perform an AJAX request to retrieve the markup for the paginated request */
					/* This includes updated pagination and Addons (e.g. Tags) output, so everything */
					/* is up to date */
					$.ajax(
						{
							type:   'POST',
							url:    envira_pagination.ajax,
							data:   {
								action:                 'envira_pagination_get_page',
								nonce:                  envira_pagination.nonce,
								envira_post_id:         envira_post_id,
								post_id:                envira_pagination_id,
								type:                   envira_pagination_type,
								page:                   envira_pagination_page,
								envira_proofing_email:  envira_gallery_proof_email,
							}
						}
					).done(
						function( response ) {

							/* If the response is empty, there's nothing else to output */
							if ( response == '' ) {
								return;
							}

							$( document ).trigger( 'enviraPaginate' );

							/* Load the response into the gallery container */
							var response_container = $( response ),
							response_wrapped       = $( response_container ).find( 'div#envira-gallery-' + envira_pagination_id ),
							response_pagination    = $( response_container ).find( '.envira-pagination-ajax-load' ).first();

							/* Clear Pagination Bar */
							$( '.envira-pagination-ajax-load', $( envira_pagination_container ).parent() ).replaceWith( $( response_pagination ) );
							$( envira_pagination_wrapped ).replaceWith( $( response_wrapped ) );

							/* Get the gallery container */
							var $container = $( '#envira-gallery-' + envira_pagination_id );

							/* Reload any buttons like printing or download */
							visible_divs.forEach(
								function(css_class) {
									if ( css_class != 'envira-printing-button') {
										  // printing button is hover
										  $( '#envira-gallery-' + envira_pagination_id + ' .envira-gallery-position-overlay .' + css_class ).show().css( 'display', 'inline-block' );
									}
								}
							);

							/* Fire an event for third party plugins to use*/
							$( document ).trigger(
								{
									type:       'envira_pagination_ajax_load_completed',
									id:         envira_pagination_id,   /* gallery|album ID*/
									id_type:    envira_pagination_type, /* gallery|album*/
									page:       envira_pagination_page, /* current page loaded*/
									response:   response,               /* HTML markup of items*/
								}
							);

							/* Flag that we've finished the request */
							envira_pagination_requesting = false;

							$( document ).trigger( 'envira_load' );

						}
					).fail(
						function( response ) {
							/* Something went wrong - either a real error, or we've reached the end of the gallery*/
							/* Don't change the flag, so we don't make any more requests*/

							/* Fire an event for third party plugins to use */
							$( document ).trigger(
								{
									type:       'envira_pagination_ajax_load_error',
									id:         envira_pagination_id,       /* gallery|album ID*/
									id_type:    envira_pagination_type,     /* gallery|album*/
									page:       envira_pagination_page,     /* current page loaded*/
									response:   response,                   /* may give a clue as to the error from the AJAX request*/
								}
							);
						}
					);

				}
			);

			/* Load More Button */
			$( 'div.envira-pagination-ajax-load-more' ).each(
				function() {
					/* Get the parent element, which will give us a unique gallery ID */
					var envira_pagination_container = $( this ).parent(),
					envira_pagination_type          = $( this ).data( 'type' ),
					envira_pagination_blog_id       = $( this ).data( 'blog-id' ),
					envira_pagination_id            = $( this ).parent().attr( 'id' ).split( 'envira-gallery-wrap-' )[1],
					envira_pagination_page          = Number( $( this ).attr( 'data-page' ) ),
					envira_pagination_max_pages     = Number( $( this ).attr( 'data-max-pages' ) ),
					envira_pagination_requesting    = false;

					/* When the user clicks on the 'load more' button, run an AJAX request to fetch the next page */
					$( this ).on(
						'click',
						'a.envira-pagination-load-more',
						function( e ) {

							/* Prevent default action */
							e.preventDefault();

							/* If we're already performing a request, don't do anything */
							if ( envira_pagination_requesting ) {
								   return;
							}

							/* Flag that we're making a request */
							envira_pagination_requesting = true;

							/* Alter the CSS of the button so that a "spinner" or other UI could be done */
							var link = $( this );
							link.addClass( 'envira-loading' );

							/* grab any exclusions - go through what exists already */
							envira_pagination_exclusions = new Array();
							envira_pagination_container.find( 'img.envira-gallery-image' ).each(
								function () {
									envira_pagination_exclusions.push( $( this ).data( 'envira-item-id' ) );
								}
							);

							/* Locate any divs in envira-gallery-position-overlay that aren't hidden - make sure they are still not hidden after new page is loaded */
							var visible_divs = [];
							envira_pagination_container.find( '.envira-gallery-position-overlay:first > div' ).each( function(){ console.log( this ); visible_divs.push( $( this ).attr( "class" ) ); } );

							/* Perform an AJAX request to retrieve the next set of items */
							$.ajax(
								{
									type:   'POST',
									url:    envira_pagination.ajax,
									data:   {
										action:     'envira_pagination_get_items',
										nonce:      envira_pagination.nonce,
										post_id:    envira_pagination_id,
										type:       envira_pagination_type,
										blog_id:    envira_pagination_blog_id,
										page:       Number( envira_pagination_page + 1 ),
										trigger:    'button',
										exclusions: envira_pagination_exclusions,
									}
								}
							).done(
								function( response ) {
									/* If the response is empty, there's nothing else to output */
									if ( response == '' || response == '0' ) {
										  // let's hide the "click more" button
										  $( envira_pagination_container ).find( '.envira-pagination-load-more' ).hide();
										  return;
									}

									/* Remove the Loading CSS */
									link.removeClass( 'envira-loading' );

									/* Get the gallery container */
									var $container = $( '#envira-gallery-' + envira_pagination_id );

									/* Justified Gallery */
									if ( $container.hasClass( 'enviratope' ) ) {

										  /* Insert the new images to the Gallery */
										  $container.enviratope( 'insert', $( response ) );

									} else {

										/* Just append to the gallery */
										$container.append( response );
									}

									/* Reload CSS Animations */
									$( '#envira-gallery-' + envira_pagination_id + ' .envira-gallery-item img' ).fadeTo( 'slow', 1 );

									/* Reload any buttons like printing or download */
									visible_divs.forEach(
										function(css_class) {
											if ( css_class != 'envira-printing-button') {
												  // printing button is hover
												  $( '#envira-gallery-' + envira_pagination_id + ' .envira-gallery-position-overlay .' + css_class ).show().css( 'display', 'inline-block' );
											}
										}
									);

									/* Check and see if this is the last page... if not, increment */
									if ( typeof envira_pagination_max_pages !== 'undefined' && envira_pagination_max_pages === ( envira_pagination_page + 1 ) ) {

										// let's hide the "click more" button
										$( envira_pagination_container ).find( '.envira-pagination-load-more' ).hide();

										/* Fire an event for third party plugins to use*/
										$( document ).trigger(
											{
												type:       'envira_pagination_lazy_load_completed_inal',
												id:         envira_pagination_id,   /* gallery|album ID*/
												id_type:    envira_pagination_type, /* gallery|album*/
												page:       envira_pagination_page, /* current page loaded*/
												response:   response,               /* HTML markup of items*/
											 }
										);

									} else {

										  /* Increment the page number */
										  envira_pagination_page = Number( envira_pagination_page + 1 );
										  $( 'div.envira-pagination-ajax-load', $( envira_pagination_container ) ).attr( 'data-page', envira_pagination_page );

										  /* Fire an event for third party plugins to use */
										$( document ).trigger(
											{
												type:       'envira_pagination_lazy_load_completed',
												id:         envira_pagination_id,   /* gallery|album ID*/
												id_type:    envira_pagination_type, /* gallery|album*/
												page:       envira_pagination_page, /* current page loaded*/
												response:   response,               /* HTML markup of items*/
											  }
										);

									}

									/* Flag that we've finished the request*/
									envira_pagination_requesting = false;
									$( document ).trigger( 'envira_load' );

								}
							).fail(
								function( response ) {
									/* Something went wrong - either a real error, or we've reached the end of the gallery */
									/* Don't change the flag, so we don't make any more requests */

									/* Fire an event for third party plugins to use */
									$( document ).trigger(
										{
											type:       'envira_pagination_lazy_load_error',
											id:         envira_pagination_id,       /* gallery|album ID*/
											id_type:    envira_pagination_type,     /* gallery|album*/
											page:       envira_pagination_page,     /* current page loaded*/
											response:   response,                   /* may give a clue as to the error from the AJAX request*/
										}
									);
								}
							);

						}
					);
				}
			);

			/* Lazy Load on Scroll*/
			$( 'div.envira-pagination-lazy-load' ).each(
				function() {

					/* Get the parent element, which will give us a unique gallery ID*/
					var     envira_pagination_container = $( this ).parent(),
					envira_pagination_type              = $( this ).data( 'type' ),
					envira_pagination_id                = $( this ).parent().attr( 'id' ).split( 'envira-gallery-wrap-' )[1],
					envira_pagination_wrapped           = $( this ).parent().find( 'div#envira-gallery-' + envira_pagination_id ),
					envira_pagination_blog_id           = $( this ).data( 'blog-id' ),
					envira_pagination_page              = Number( $( this ).attr( 'data-page' ) ),
					envira_pagination_requesting        = false, /* Hide paginator, as we'll display more images as the user scrolls.*/
					envira_post_id                      = envira_pagination_container.data( 'envira-post-id' ),
					envira_isotopes                     = [],
					envira_isotopes_config              = [],
					envira_pagination_isotopes          = envira_pagination_type === 'album' ? envira_isotopes : envira_isotopes,
					envira_pagination_isotopes_config   = envira_pagination_type === 'album' ? envira_isotopes_config : envira_isotopes_config;

					/* envira_post_id might be undefined beyond page 1 in cases like instagram */
					if ( envira_post_id == undefined || envira_post_id == '' ) {
						envira_post_id = envira_pagination_id;
					}

					$( this ).hide();

					function envira_lazy_load_reload() {

						/* If we're already performing a request, don't do anything*/
						if ( envira_pagination_requesting ) {
							return;
						}

						/* Flag that we're making a request*/
						envira_pagination_requesting = true;

						/* grab any exclusions - go through what exists already */
						envira_pagination_exclusions = new Array();
						envira_pagination_container.find( 'img.envira-gallery-image' ).each(
							function () {
								envira_pagination_exclusions.push( $( this ).data( 'envira-item-id' ) );
							}
						);

						/* Locate any divs in envira-gallery-position-overlay that aren't hidden - make sure they are still not hidden after new page is loaded */
						var visible_divs = [];
						envira_pagination_wrapped.find( '.envira-gallery-position-overlay:first > div' ).each( function(){ console.log( this ); visible_divs.push( $( this ).attr( "class" ) ); } );

						/* Perform an AJAX request to retrieve the next set of items*/
						$.ajax(
							{
								type:   'POST',
								async: false,
								url:    envira_pagination.ajax,
								data:   {
									action:     'envira_pagination_get_items',
									nonce:      envira_pagination.nonce,
									envira_post_id:  envira_post_id,
									post_id:    envira_pagination_id,
									type:       envira_pagination_type,
									page:       Number( envira_pagination_page + 1 ),
									trigger:    'scroll',
									exclusions: envira_pagination_exclusions,
								}
							}
						).done(
							function( response ) {

								/* If the response is empty, there's nothing else to output*/
								if ( response == '' ) {
									return;
								}

								/* Get the gallery container*/
								var $container = $( '#envira-gallery-' + envira_pagination_id );

								/* Justified Gallery*/
								if ( $container.hasClass( 'envira-gallery-justified-public' ) ) {

									$container.append( response );
									$container.enviraJustifiedGallery( 'norewind' );

									function doStuff() {
										envira_pagination_requesting = false;
									}

									setTimeout( doStuff, 3000 );

									/* If Isotope is enabled, use its insert method*/
								} else if ( $container.hasClass( 'enviratope' ) ) {

									  /* Insert the new images to the Gallery*/
									  $container.enviratope( 'insert', $( response ) );

									  /* Re-initialize Isotope*/

									  envira_pagination_isotopes[ envira_pagination_id ] = $container.enviratope( envira_pagination_isotopes_config[ envira_pagination_id ] ).enviratope( 'layout' );

									  envira_pagination_isotopes[ envira_pagination_id ].enviraImagesLoaded()
									.done(
										function( instance ) {
											envira_pagination_isotopes[ envira_pagination_id ].enviratope( 'layout' );
											envira_pagination_requesting = false;
										}
									)
									.progress(
										function( instance, image ) {
											envira_pagination_isotopes[ envira_pagination_id ].enviratope( 'layout' );
										}
									);

								} else {
									/* Just append to the gallery*/
									$container.append( response );
									envira_pagination_requesting = false;
								}//

								/* Reload CSS Animations*/
								$( '#envira-gallery-' + envira_pagination_id + ' .envira-gallery-item img' ).fadeTo( 'slow', 1 );

								/* Reload any buttons like printing or download */
								visible_divs.forEach(
									function(css_class) {
										if ( css_class != 'envira-printing-button') {
											// printing button is hover
											$( '#envira-gallery-' + envira_pagination_id + ' .envira-gallery-position-overlay .' + css_class ).show().css( 'display', 'inline-block' );
										}
									}
								);

								/* Increment the page number*/
								envira_pagination_page = Number( envira_pagination_page + 1 );
								$( 'div.envira-pagination-ajax-load', $( envira_pagination_container ) ).attr( 'data-page', envira_pagination_page );

								/* Fire an event for third party plugins to use*/
								$( document ).trigger(
									{
										type:       'envira_pagination_lazy_load_completed',
										id:         envira_pagination_id,   /* gallery|album ID*/
										id_type:    envira_pagination_type, /* gallery|album*/
										page:       envira_pagination_page, /* current page loaded*/
										response:   response,               /* HTML markup of items*/
									}
								);

								/* Flag that we've finished the request*/
								// envira_pagination_requesting = false;
								$( document ).trigger( 'envira_load' );

							}
						).fail(
							function( response ) {
								/* Something went wrong - either a real error, or we've reached the end of the gallery*/
								/* Don't change the flag, so we don't make any more requests*/

								/* Fire an event for third party plugins to use*/
								$( document ).trigger(
									{
										type:       'envira_pagination_lazy_load_error',
										id:         envira_pagination_id,       /* gallery|album ID*/
										id_type:    envira_pagination_type,     /* gallery|album*/
										page:       envira_pagination_page,     /* current page loaded*/
										response:   response,                   /* may give a clue as to the error from the AJAX request*/
									}
								);
							}
						);

					}

					/* When the user scrolls to the end of the container, run an AJAX request to fetch the next page*/

					var envira_lastY = 0;

					$( 'html' ).on(
						{
							'touchmove': function(e) { // for iphones/mobile
								 var currentY = e.originalEvent.touches[0].clientY;
								if ( currentY > envira_lastY ) { // moved down
									envira_lazy_load_reload();
								}
								envira_lastY = currentY;
							},
							'mousewheel DOMMouseScroll': function(e) { // for desktops
								var delta = (e.originalEvent.wheelDelta || -e.originalEvent.detail);
								if ( delta < 0 ) {
									envira_lazy_load_reload();
								}
							}
						}
					);

				}
			);

	}
);
/**
 * Returns a URL parameter by name
 *
 * @since 1.1.7
 *
 * @param   string  name
 * @param   string  url
 * @return  string  value
 */
function envira_pagination_get_query_arg( name, url ) {

	name        = name.replace( /[\[\]]/g, "\\$&" );
	var regex   = new RegExp( "[?&]" + name + "(=([^&#]*)|&|#|$)" ),
		results = regex.exec( url );

	if ( ! results ) {
		return null;
	}
	if ( ! results[2] ) {
		return '';
	}

	return decodeURIComponent( results[2].replace( /\+/g, " " ) );

};

/*!
 * JavaScript Cookie v2.1.3
 * https://github.com/js-cookie/js-cookie
 *
 * Copyright 2006, 2015 Klaus Hartl & Fagner Brack
 * Released under the MIT license
 */(function (factory) {
	var registeredInModuleLoader = false;
	if (typeof define === 'function' && define.amd) {
		define( factory );
		registeredInModuleLoader = true;
	}
	if (typeof exports === 'object') {
		module.exports           = factory();
		registeredInModuleLoader = true;
	}
	if ( ! registeredInModuleLoader) {
		var OldCookies = window.Cookies;
		var api        = window.Cookies = factory();
		api.noConflict = function () {
			window.Cookies = OldCookies;
			return api;
		};
	}
}(function () {
	function extend () {
		var i      = 0;
		var result = {};
		for (; i < arguments.length; i++) {
			var attributes = arguments[ i ];
			for (var key in attributes) {
				result[key] = attributes[key];
			}
		}
		return result;
	}

	function init (converter) {
		function api (key, value, attributes) {
			var result;
			if (typeof document === 'undefined') {
				return;
			}

			/* Write*/

			if (arguments.length > 1) {
				attributes = extend(
					{
						path: '/'
					},
					api.defaults,
					attributes
				);

				if (typeof attributes.expires === 'number') {
					var expires = new Date();
					expires.setMilliseconds( expires.getMilliseconds() + attributes.expires * 864 + 5 );
					attributes.expires = expires;
				}

				try {
					result = JSON.stringify( value );
					if (/^[\{\[]/.test( result )) {
						value = result;
					}
				} catch (e) {
				}

				if ( ! converter.write) {
					value = encodeURIComponent( String( value ) )
						.replace( /%(23|24|26|2B|3A|3C|3E|3D|2F|3F|40|5B|5D|5E|60|7B|7D|7C)/g, decodeURIComponent );
				} else {
					value = converter.write( value, key );
				}

				key = encodeURIComponent( String( key ) );
				key = key.replace( /%(23|24|26|2B|5E|60|7C)/g, decodeURIComponent );
				key = key.replace( /[\(\)]/g, escape );

				return (document.cookie = [
					key, '=', value,
					attributes.expires ? '; expires=' + attributes.expires.toUTCString() : '', /* use expires attribute, max-age is not supported by IE*/
					attributes.path ? '; path=' + attributes.path : '',
					attributes.domain ? '; domain=' + attributes.domain : '',
					attributes.secure ? '; secure' : ''
				].join( '' ));
			}

			/* Read*/

			if ( ! key) {
				result = {};
			}

			/* To prevent the for loop in the first place assign an empty array*/
			/* in case there are no cookies at all. Also prevents odd result when*/
			/* calling "get()"*/
			var cookies = document.cookie ? document.cookie.split( '; ' ) : [];
			var rdecode = /(%[0-9A-Z]{2})+/g;
			var i       = 0;

			for (; i < cookies.length; i++) {
				var parts  = cookies[i].split( '=' );
				var cookie = parts.slice( 1 ).join( '=' );

				if (cookie.charAt( 0 ) === '"') {
					cookie = cookie.slice( 1, -1 );
				}

				try {
					var name = parts[0].replace( rdecode, decodeURIComponent );
					cookie   = converter.read ?
						converter.read( cookie, name ) : converter( cookie, name ) ||
						cookie.replace( rdecode, decodeURIComponent );

					if (this.json) {
						try {
							cookie = JSON.parse( cookie );
						} catch (e) {
						}
					}

					if (key === name) {
						result = cookie;
						break;
					}

					if ( ! key) {
						result[name] = cookie;
					}
				} catch (e) {
				}
			}

			return result;
		}

		api.set      = api;
		api.get      = function (key) {
			return api.call( api, key );
		};
		api.getJSON  = function () {
			return api.apply(
				{
					json: true
				},
				[].slice.call( arguments )
			);
		};
		api.defaults = {};

		api.remove = function (key, attributes) {
			api(
				key,
				'',
				extend(
					attributes,
					{
						expires: -1
					}
				)
			);
		};

		api.withConverter = init;

		return api;
	}

	return init( function () {} );
}));
