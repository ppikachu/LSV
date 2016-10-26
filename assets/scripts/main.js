/* ========================================================================
 * DOM-based Routing
 * Based on http://goo.gl/EUTi53 by Paul Irish
 *
 * Only fires on body classes that match. If a body class contains a dash,
 * replace the dash with an underscore when adding it to the object below.
 *
 * .noConflict()
 * The routing is enclosed within an anonymous function so that you can
 * always reference jQuery with $, even when in .noConflict() mode.
 * ======================================================================== */

(function($) {

		// Use this variable to set up the common and page specific functions. If you
		// rename this variable, you will also need to rename the namespace below.
		var Sage = {
				// All pages
				'common': {
						init: function() {
								// JavaScript to be fired on all pages
						},
						finalize: function() {
								// JavaScript to be fired on all pages, after page specific JS is fired
						}
				},
				// Home page
				'home': {
						init: function() {
								// JavaScript to be fired on the home page

								function reposition() {

										var modal = $(this),
												dialog = modal.find('.modal-dialog');

										modal.css('display', 'block');

										// Dividing by two centers the modal exactly, but dividing by three
										// or four works better for larger screens.
										dialog.css("margin-top", Math.max(0, ($(window).height() - dialog.height()) / 2));
								}

								// Reposition when a modal is shown
								$('.modal').on('show.bs.modal', reposition);

								// Reposition when the window is resized
								$(window).on('resize', function() {
										$('.modal:visible').each(reposition);
								});

								var options = {
										"backdrop": "static",
										'show': true
								};
								$('#myModal').modal(options);
						},
						finalize: function() {
								// JavaScript to be fired on the home page, after the init JS
						}
				},
				'tax_tipo': {
						init: function() {

								var $grid = $('.grid').isotope({
										// options
										itemSelector: '.grid-item',
										layoutMode: 'fitRows'
								});

								// bind filter button click
								var $filters = $('#filters').on('click', 'button', function() {
										var filterAttr = $(this).attr('data-filter');
										$grid.isotope({ filter: filterAttr });
								});

								// change is-checked class on buttons
								$('.btn-group-zonas').each(function(i, buttonGroup) {
										var $buttonGroup = $(buttonGroup);
										$buttonGroup.on('click', '.zona', function() {
												$buttonGroup.find('.check').removeClass('check');
												$('.btn-group-zonas').find('.check-grand').removeClass('check-grand');
												$buttonGroup.find('.check-zona').removeClass('check-zona');
												$(this).addClass('check-zona');
										});
								});
								// change is-checked class on buttons
								$('.inner').each(function(i, buttonGroup) {
										var $buttonGroup = $(buttonGroup);
										$buttonGroup.on('click', '.hijo', function() {
											$buttonGroup.find('.check').removeClass('check');
											$('.btn-group-zonas').find('.check-grand').removeClass('check-grand');
											$(this).addClass('check');
										});
								});
								// change is-checked class on buttons
								$('.grand-ul').each(function(i, buttonGroup) {
										var $buttonGroup = $(buttonGroup);
										$buttonGroup.on('click', '.grand', function() {
												$buttonGroup.find('.check-grand').removeClass('check-grand');
												$(this).addClass('check-grand');
										});
								});

								$('.toggle').click(function(e) {
										e.preventDefault();

										var $this = $(this);

										if ($this.next().hasClass('show')) {
												$this.next().removeClass('show');
												//$this( "ul li:last-child" ).toggleClass('xxxxxxxxx');
												//$this.next().slideUp(350);
										} else {
												$this.parent().parent().find('li .inner').removeClass('show');
												//$this.parent().parent().find('li .inner').slideUp(350);
												$this.next().toggleClass('show');
												//$this.next().slideToggle(350);
										}
								});

						},
						finalize: function() {
								// JavaScript to be fired on the home page, after the init JS
						}
				},
				// filtrado lugares anterior
				'post_type_archive_lugar': {
						init: function() {
								// JavaScript to be fired on the about us page
								var $grid = $('.grid').isotope({
										// options
										itemSelector: '.grid-item',
										layoutMode: 'fitRows'
								});

								// store filter for each group
								var filters = {};

								// flatten object by concatting values
								function concatValues(obj) {
										var value = '';
										for (var prop in obj) {
												value += obj[prop];
										}
										return value;
								}

								$('#filters').on('click', 'button', function() {
										var $this = $(this);
										// get group key
										var $buttonGroup = $this.parents('.btn-group');
										var filterGroup = $buttonGroup.attr('data-filter-group');
										// set filter for group
										filters[filterGroup] = $this.attr('data-filter');
										// combine filters
										var filterValue = concatValues(filters);
										// set filter for Isotope
										$grid.isotope({ filter: filterValue });
								});

								$('.toggle').click(function(e) {
										e.preventDefault();

										var $this = $(this);

										if ($this.next().hasClass('show')) {
												$this.next().removeClass('show');
												//$this( "ul li:last-child" ).toggleClass('xxxxxxxxx');
												//$this.next().slideUp(350);
										} else {
												$this.parent().parent().find('li .inner').removeClass('show');
												//$this.parent().parent().find('li .inner').slideUp(350);
												$this.next().toggleClass('show');
												//$this.next().slideToggle(350);
										}
								});

								// change is-checked class on buttons
								$('.btn-group-zonas').each(function(i, buttonGroup) {
										var $buttonGroup = $(buttonGroup);
										$buttonGroup.on('click', '.zona', function() {
												$buttonGroup.find('.check').removeClass('check');
												$('.btn-group-zonas').find('.check-grand').removeClass('check-grand');
												$buttonGroup.find('.check-zona').removeClass('check-zona');
												$(this).addClass('check-zona');
										});
								});

								// change is-checked class on buttons
								$('.inner').each(function(i, buttonGroup) {
										var $buttonGroup = $(buttonGroup);
										$buttonGroup.on('click', '.hijo', function() {
												$buttonGroup.find('.check').removeClass('check');
												$('.btn-group-zonas').find('.check-grand').removeClass('check-grand');
												$(this).addClass('check');
										});
								});

								// change is-checked class on buttons
								$('.grand-ul').each(function(i, buttonGroup) {
										var $buttonGroup = $(buttonGroup);
										$buttonGroup.on('click', '.grand', function() {
												$buttonGroup.find('.check-grand').removeClass('check-grand');
												$(this).addClass('check-grand');
										});
								});

								// change is-checked class on buttons
								$('.btn-group-tipo').each(function(i, buttonGroup) {
										var $buttonGroup = $(buttonGroup);
										$buttonGroup.on('click', '.btn', function() {
												$buttonGroup.find('.check').removeClass('check');
												$buttonGroup.find('.check').removeClass('check');
												$(this).addClass('check');
										});
								});

						}
				}
		};

		// The routing fires all common scripts, followed by the page specific scripts.
		// Add additional events for more control over timing e.g. a finalize event
		var UTIL = {
				fire: function(func, funcname, args) {
						var fire;
						var namespace = Sage;
						funcname = (funcname === undefined) ? 'init' : funcname;
						fire = func !== '';
						fire = fire && namespace[func];
						fire = fire && typeof namespace[func][funcname] === 'function';

						if (fire) {
								namespace[func][funcname](args);
						}
				},
				loadEvents: function() {
						// Fire common init JS
						UTIL.fire('common');

						// Fire page-specific init JS, and then finalize JS
						$.each(document.body.className.replace(/-/g, '_').split(/\s+/), function(i, classnm) {
								UTIL.fire(classnm);
								UTIL.fire(classnm, 'finalize');
						});

						// Fire common finalize JS
						UTIL.fire('common', 'finalize');
				}
		};

		// Load Events
		$(document).ready(UTIL.loadEvents);

})(jQuery); // Fully reference jQuery after this point.
