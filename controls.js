/**
 * String.prototype.includes polyfill.
 *
 * @see https://developer.mozilla.org/en-US/docs/Web/JavaScript/Reference/Global_Objects/String/includes
 */
if (!String.prototype.includes) {
	String.prototype.includes = function (search, start) {
		'use strict';

		if (search instanceof RegExp) {
			throw TypeError('first argument must not be a RegExp');
		}
		if (start === undefined) { start = 0; }
		return this.indexOf(search, start) !== -1;
	};
}

/**
 * Scripts within customizer control panel.
 *
 * Used global objects:
 * - jQuery
 * - wp
 * - udbLoginCustomizer
 */
(function ($) {
	var events = {};

	wp.customize.bind('ready', function () {
		listen();
	});

	function listen() {
		events.switchBgColor();
	}

	/**
	 * Change the page when the "Login Customizer" panel is expanded (or collapsed).
	 */
	events.switchBgColor = function () {
		wp.customize('test_bg_color', function (setting) {
			setting.bind(function (val) {

				wp.customize('color_setting_default').set(val);

			});
		});
	}
})(jQuery, wp.customize);
