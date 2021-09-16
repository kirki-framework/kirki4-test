<?php
/**
 * Plugin Name: Kirki4 Test
 * Description: This is a test plugin for Kirki4.
 *
 * An example file demonstrating how to add all controls.
 *
 * @package     Kirki
 * @category    Core
 * @author      Ari Stathopoulos (@aristath)
 * @copyright   Copyright (c) 2019, Ari Stathopoulos (@aristath)
 * @license     https://opensource.org/licenses/MIT
 * @since       3.0.12
 */

use Kirki\Util\Helper;

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

// Do not proceed if Kirki does not exist.
if ( ! class_exists( 'Kirki' ) ) {
	return;
}

/**
 * Remove jQuery migrate script when SCRIPT_DEBUG is defined and the value is true.
 * This is to reduce the noises in browser console.
 *
 * @param WP_Scripts $scripts Instance of WP_Scripts.
 */
function kirki4_test_remove_jquery_migrate( $scripts ) {
	if ( ! defined( 'SCRIPT_DEBUG' ) || ! SCRIPT_DEBUG ) {
		return;
	}

	if ( isset( $scripts->registered['jquery'] ) ) {
		$script = $scripts->registered['jquery'];

		// Check whether the script has any dependencies
		if ( $script->deps ) {
			$script->deps = array_diff( $script->deps, [ 'jquery-migrate' ] );
		}
	}
}
add_action( 'wp_default_scripts', 'kirki4_test_remove_jquery_migrate', 99999 );

/**
 * Add a panel.
 *
 * @link https://kirki.org/docs/getting-started/panels.html
 */
new \Kirki\Panel(
	'kirki_demo_panel',
	[
		'priority'    => 10,
		'title'       => esc_html__( 'Kirki Demo Panel', 'kirki' ),
		'description' => esc_html__( 'Contains sections for all kirki controls.', 'kirki' ),
	]
);

/**
 * Add Sections.
 *
 * We'll be doing things a bit differently here, just to demonstrate an example.
 * We're going to define 1 section per control-type just to keep things clean and separate.
 *
 * @link https://kirki.org/docs/getting-started/sections.html
 */
$sections = [
	'background'      => [ esc_html__( 'Background', 'kirki' ), '' ],
	'code'            => [ esc_html__( 'Code', 'kirki' ), '' ],
	'checkbox'        => [ esc_html__( 'Checkbox', 'kirki' ), '' ],
	'color'           => [ esc_html__( 'Color', 'kirki' ), '' ],
	'color_advanced'  => [ esc_html__( 'Color — Advanced', 'kirki' ), '' ],
	'color_palette'   => [ esc_html__( 'Color Palette', 'kirki' ), '' ],
	'custom'          => [ esc_html__( 'Custom', 'kirki' ), '' ],
	'dashicons'       => [ esc_html__( 'Dashicons', 'kirki' ), '' ],
	'date'            => [ esc_html__( 'Date', 'kirki' ), '' ],
	'dimension'       => [ esc_html__( 'Dimension', 'kirki' ), '' ],
	'dimensions'      => [ esc_html__( 'Dimensions', 'kirki' ), '' ],
	'dropdown-pages'  => [ esc_html__( 'Dropdown Pages', 'kirki' ), '' ],
	'editor'          => [ esc_html__( 'Editor', 'kirki' ), '' ],
	'fontawesome'     => [ esc_html__( 'Font-Awesome', 'kirki' ), '' ],
	'generic'         => [ esc_html__( 'Generic', 'kirki' ), '' ],
	'image'           => [ esc_html__( 'Image', 'kirki' ), '' ],
	'multicheck'      => [ esc_html__( 'Multicheck', 'kirki' ), '' ],
	'multicolor'      => [ esc_html__( 'Multicolor', 'kirki' ), '' ],
	'number'          => [ esc_html__( 'Number', 'kirki' ), '' ],
	'preset'          => [ esc_html__( 'Preset', 'kirki' ), '' ],
	'radio'           => [ esc_html__( 'Radio', 'kirki' ), esc_html__( 'A plain Radio control.', 'kirki' ) ],
	'radio-buttonset' => [ esc_html__( 'Radio Buttonset', 'kirki' ), esc_html__( 'Radio-Buttonset controls are essentially radio controls with some fancy styling to make them look cooler.', 'kirki' ) ],
	'radio-image'     => [ esc_html__( 'Radio Image', 'kirki' ), esc_html__( 'Radio-Image controls are essentially radio controls with some fancy styles to use images', 'kirki' ) ],
	'repeater'        => [ esc_html__( 'Repeater', 'kirki' ), '' ],
	'select'          => [ esc_html__( 'Select', 'kirki' ), '' ],
	'slider'          => [ esc_html__( 'Slider', 'kirki' ), '' ],
	'sortable'        => [ esc_html__( 'Sortable', 'kirki' ), '' ],
	'switch'          => [ esc_html__( 'Switch', 'kirki' ), '', 'outer' ],
	'toggle'          => [ esc_html__( 'Toggle', 'kirki' ), '', 'outer' ],
	'typography'      => [ esc_html__( 'Typography', 'kirki' ), '' ],
	'upload'          => [ esc_html__( 'Upload', 'kirki' ), '' ],
];
foreach ( $sections as $section_id => $section ) {
	$section_args = [
		'title'       => $section[0],
		'description' => $section[1],
		'panel'       => 'kirki_demo_panel',
	];
	if ( isset( $section[2] ) ) {
		$section_args['type'] = $section[2];
	}
	new \Kirki\Section( str_replace( '-', '_', $section_id ) . '_section', $section_args );
}

new \Kirki\Section(
	'pro_test',
	[
		'title'       => esc_html__( 'Test Link Section', 'kirki' ),
		'type'        => 'link',
		'button_text' => esc_html__( 'Pro', 'kirki' ),
		'button_url'  => 'https://wplemon.com',
	]
);

/**
 * Background Control.
 *
 * @todo Triggers change on load.
 */
new \Kirki\Field\Background(
	[
		'settings'    => 'background_setting',
		'label'       => esc_html__( 'Background Control', 'kirki' ),
		'description' => esc_html__( 'Background conrols are pretty complex! (but useful if properly used)', 'kirki' ),
		'section'     => 'background_section',
		'default'     => [
			'background-color'      => 'rgba(20,20,20,.8)',
			'background-image'      => '',
			'background-repeat'     => 'repeat',
			'background-position'   => 'center center',
			'background-size'       => 'cover',
			'background-attachment' => 'scroll',
		],
	]
);

/**
 * Code control.
 *
 * @link https://kirki.org/docs/controls/code.html
 */
new \Kirki\Field\Code(
	[
		'settings'    => 'code_css_setting',
		'label'       => esc_html__( 'Code Control — CSS', 'kirki' ),
		'description' => esc_html__( 'Description', 'kirki' ),
		'section'     => 'code_section',
		'default'     => '',
		'choices'     => [
			'language' => 'css',
		],
	]
);

/**
 * Checkbox control.
 *
 * @link https://kirki.org/docs/controls/checkbox.html
 */
new \Kirki\Field\Checkbox(
	[
		'settings'    => 'checkbox_setting',
		'label'       => esc_html__( 'Checkbox Control', 'kirki' ),
		'description' => esc_html__( 'Description', 'kirki' ),
		'section'     => 'checkbox_section',
		'default'     => true,
	]
);

/**
 * Color Controls.
 *
 * @link https://kirki.org/docs/controls/color.html
 */
Kirki::add_field(
	'theme_config_id',
	[
		'type'        => 'color',
		'settings'    => 'kirki_color_setting_alpha_old_way',
		'label'       => 'Using <code>Kirki::add_field</code> — With alpha',
		'description' => esc_html__( 'This is a color control registered using `Kirki::add_field` with "alpha" => true.', 'kirki' ),
		'section'     => 'color_section',
		'transport'   => 'postMessage',
		'default'     => '#ff0055',
		'choices'     => [
			'alpha' => true,
		],
	]
);

new \Kirki\Field\Color(
	[
		'settings'    => 'kirki_color_setting_hex',
		'label'       => __( 'Hex only', 'kirki' ),
		'description' => esc_html__( 'This is a color control without alpha channel.', 'kirki' ),
		'section'     => 'color_section',
		'transport'   => 'postMessage',
		'default'     => '#0008DC',
	]
);

new \Kirki\Field\Color(
	[
		'settings'    => 'kirki_color_setting_alpha',
		'label'       => __( 'With alpha channel', 'kirki' ),
		'description' => esc_html__( 'This is a color control with alpha channel.', 'kirki' ),
		'section'     => 'color_section',
		'transport'   => 'postMessage',
		'choices'     => [
			'alpha' => true,
		],
	]
);

new \Kirki\Field\Color(
	[
		'settings'    => 'kirki_color_setting_hue',
		'label'       => __( 'Hue only.', 'kirki' ),
		'description' => esc_html__( 'This is a color control with "mode" => "hue" (hue mode).', 'kirki' ),
		'section'     => 'color_section',
		'transport'   => 'postMessage',
		'default'     => 160,
		'mode'        => 'hue',
	]
);

/**
 * The "save_as" choice will be ignored when using:
 * - "mode" argument (argument, not choices) with value is "hue"
 * - Or, "formComponent" choice with value is "HexColorPicker"
 */
new \Kirki\Field\Color(
	[
		'settings'    => 'kirki_color_setting_save_as',
		'label'       => 'New! — Using <code>save_as</code> choice',
		'description' => esc_html__( 'You can use "save_as" in your choices with value is "array" or "string" (which is default). However, this "save_as" choice will be ignored when using "formComponent" choice with value is "HexColorPicker", or when using "mode" argument with value is "hue".', 'kirki' ),
		'section'     => 'color_section',
		'transport'   => 'postMessage',
		'choices'     => [
			'alpha'   => true,
			'save_as' => 'array', // Default is 'string'.
		],
	]
);

/**
 * Color Control (Advanced)
 */

/**
 * Color control with formComponent value is HexColorPicker.
 *
 * The saved value will always be a string, for instance:
 * "#ff0000"
 *
 * When formComponent is set, we ignore the "alpha" and "save_as" choices.
 * They can set it, but it will be ignored.
 */
new \Kirki\Field\Color(
	[
		'settings'    => 'kirki_color_advanced_setting_hex',
		'label'       => __( 'v4 — formComponent — HexColorPicker', 'kirki' ),
		'description' => esc_html__( 'This is a color control with formComponent value is HexColorPicker.', 'kirki' ),
		'section'     => 'color_advanced_section',
		'default'     => '#ffff00',
		'choices'     => [
			// When using formComponent, we ignore "alpha" and "save_as" choices.
			'formComponent' => 'HexColorPicker',
		],
		'transport'   => 'postMessage',
	]
);

/**
 * Color control with formComponent value is RgbColorPicker.
 *
 * The saved value will be an rgba array.
 * The format is following the `react-colorful` and `colord` formatting, for instance:
 * [
 *   'r' => 255,
 *   'g' => 255,
 *   'b' => 45,
 *   'a' => 0.5
 * ]
 *
 * When formComponent is set, we ignore the "alpha" and "save_as" choices.
 * They can set it, but it will be ignored.
 */
new \Kirki\Field\Color(
	[
		'settings'    => 'kirki_color_advanced_setting_rgb',
		'label'       => __( 'v4 — formComponent — RgbColorPicker', 'kirki' ),
		'description' => esc_html__( 'This is a color control with formComponent value is RgbColorPicker. The saved value will be an array.', 'kirki' ),
		'section'     => 'color_advanced_section',
		'default'     => '#ffff00',
		'choices'     => [
			// When using formComponent, we ignore "alpha" and "save_as" choices.
			'formComponent' => 'RgbColorPicker',
		],
		'transport'   => 'postMessage',
	]
);

/**
 * Color control with formComponent value is RgbStringColorPicker.
 *
 * The saved value will be an rgb string.
 * The format is following the `react-colorful` and `colord` formatting, for instance:
 * "rgba(255, 255, 45)"
 *
 * When formComponent is set, we ignore the "alpha" and "save_as" choices.
 * They can set it, but it will be ignored.
 */
new \Kirki\Field\Color(
	[
		'settings'    => 'kirki_color_advanced_setting_rgb_string',
		'label'       => __( 'v4 — formComponent — RgbStringColorPicker', 'kirki' ),
		'description' => esc_html__( 'This is a color control with formComponent value is RgbStringColorPicker. The saved value will be a string.', 'kirki' ),
		'section'     => 'color_advanced_section',
		'default'     => '#ffff00',
		'choices'     => [
			// When using formComponent, we ignore "alpha" and "save_as" choices.
			'formComponent' => 'RgbStringColorPicker',
		],
		'transport'   => 'postMessage',
	]
);

/**
 * Color control with formComponent value is RgbaColorPicker.
 *
 * The saved value will be an rgba array.
 * The format is following the `react-colorful` and `colord` formatting, for instance:
 * [
 *   'r' => 255,
 *   'g' => 255,
 *   'b' => 45,
 *   'a' => 0.5
 * ]
 *
 * When formComponent is set, we ignore the "alpha" and "save_as" choices.
 * They can set it, but it will be ignored.
 */
new \Kirki\Field\Color(
	[
		'settings'    => 'kirki_color_advanced_setting_rgba',
		'label'       => __( 'v4 — formComponent — RgbaColorPicker', 'kirki' ),
		'description' => esc_html__( 'This is a color control with formComponent value is RgbaColorPicker.  The saved value will be an array.', 'kirki' ),
		'section'     => 'color_advanced_section',
		'default'     => '#ffff00',
		'choices'     => [
			// When using formComponent, we ignore "alpha" and "save_as" choices.
			'formComponent' => 'RgbaColorPicker',
		],
		'transport'   => 'postMessage',
	]
);

/**
 * Color control with formComponent value is RgbaStringColorPicker.
 *
 * The saved value will be an rgba string.
 * The format is following the `react-colorful` and `colord` formatting, for instance:
 * "rgba(255, 255, 45, 0.5)"
 *
 * When formComponent is set, we ignore the "alpha" and "save_as" choices.
 * They can set it, but it will be ignored.
 */
new \Kirki\Field\Color(
	[
		'settings'    => 'kirki_color_advanced_setting_rgba_string',
		'label'       => __( 'v4 — formComponent — RgbaStringColorPicker', 'kirki' ),
		'description' => esc_html__( 'This is a color control with formComponent value is RgbaStringColorPicker. The saved value will be a string.', 'kirki' ),
		'section'     => 'color_advanced_section',
		'default'     => '#ffff00',
		'choices'     => [
			// When using formComponent, we ignore "alpha" and "save_as" choices.
			'formComponent' => 'RgbaStringColorPicker',
		],
		'transport'   => 'postMessage',
	]
);

/**
 * Color control with formComponent value is HslColorPicker.
 *
 * The saved value will be an hsl array.
 * The format is following the `react-colorful` and `colord` formatting (int, without the percent sign), for instance:
 * [
 *   'h' => 180,
 *   's' => 40, // Is int, without the percent sign.
 *   'l' => 50, // Is int, without the percent sign.
 * ]
 *
 * When formComponent is set, we ignore the "alpha" and "save_as" choices.
 * They can set it, but it will be ignored.
 */
new \Kirki\Field\Color(
	[
		'settings'    => 'kirki_color_advanced_setting_hsl',
		'label'       => __( 'v4 — formComponent — HslColorPicker', 'kirki' ),
		'description' => esc_html__( 'This is a color control with formComponent value is HslColorPicker. The saved value will be an array', 'kirki' ),
		'section'     => 'color_advanced_section',
		'default'     => 'hsl(206, 23%, 25%)',
		'choices'     => [
			// When using formComponent, we ignore "alpha" and "save_as" choices.
			'formComponent' => 'HslColorPicker',
		],
		'transport'   => 'postMessage',
	]
);

/**
 * Color control with formComponent value is HslStringColorPicker.
 *
 * The saved value will be an hsl string.
 * The format is following the `react-colorful` and `colord` formatting, for instance:
 * "hsl(180, 40%, 50%)"
 *
 * When formComponent is set, we ignore the "alpha" and "save_as" choices.
 * They can set it, but it will be ignored.
 */
new \Kirki\Field\Color(
	[
		'settings'    => 'kirki_color_advanced_setting_hsl_string',
		'label'       => __( 'v4 — formComponent — HslStringColorPicker', 'kirki' ),
		'description' => esc_html__( 'This is a color control with formComponent value is HslStringColorPicker. The saved value will be a string', 'kirki' ),
		'section'     => 'color_advanced_section',
		'default'     => 'hsl(206, 23%, 25%)',
		'choices'     => [
			// When using formComponent, we ignore "alpha" and "save_as" choices.
			'formComponent' => 'HslStringColorPicker',
		],
		'transport'   => 'postMessage',
	]
);

/**
 * Color control with formComponent value is HslaColorPicker.
 *
 * The saved value will be an hsla array.
 * The format is following the `react-colorful` and `colord` formatting (int, without the percent sign), for instance:
 * [
 *   'h' => 180,
 *   's' => 40, // Is int, without the percent sign.
 *   'l' => 50, // Is int, without the percent sign.
 *   'a' => 0.5
 * ]
 *
 * When formComponent is set, we ignore the "alpha" and "save_as" choices.
 * They can set it, but it will be ignored.
 */
new \Kirki\Field\Color(
	[
		'settings'    => 'kirki_color_advanced_setting_hsla',
		'label'       => __( 'v4 — formComponent — HslaColorPicker', 'kirki' ),
		'description' => esc_html__( 'This is a color control with formComponent value is HslaColorPicker. The saved value will be an array', 'kirki' ),
		'section'     => 'color_advanced_section',
		'default'     => 'hsla(206, 23%, 25%, 0.7)',
		'choices'     => [
			// When using formComponent, we ignore "alpha" and "save_as" choices.
			'formComponent' => 'HslaColorPicker',
		],
		'transport'   => 'postMessage',
	]
);

/**
 * Color control with formComponent value is HslaStringColorPicker.
 *
 * The saved value will be an hsla string.
 * The format is following the `react-colorful` and `colord` formatting, for instance:
 * "hsla(180, 40%, 50%, 0.5)"
 *
 * When formComponent is set, we ignore the "alpha" and "save_as" choices.
 * They can set it, but it will be ignored.
 */
new \Kirki\Field\Color(
	[
		'settings'    => 'kirki_color_advanced_setting_hsla_string',
		'label'       => __( 'v4 — formComponent — HslaStringColorPicker', 'kirki' ),
		'description' => esc_html__( 'This is a color control with formComponent value is HslaStringColorPicker. The saved value will be a string', 'kirki' ),
		'section'     => 'color_advanced_section',
		'default'     => 'hsla(206, 23%, 25%, 0.7)',
		'choices'     => [
			// When using formComponent, we ignore "alpha" and "save_as" choices.
			'formComponent' => 'HslaStringColorPicker',
		],
		'transport'   => 'postMessage',
	]
);

/**
 * DateTime Control.
 */
new \Kirki\Field\Date(
	[
		'settings'    => 'date_setting',
		'label'       => esc_html__( 'Date Control', 'kirki' ),
		'description' => esc_html__( 'This is a date control.', 'kirki' ),
		'section'     => 'date_section',
		'default'     => '',
	]
);
new \Kirki\Field\Date(
	[
		'settings'    => 'date_setting2',
		'label'       => esc_html__( 'Date Control 2', 'kirki' ),
		'description' => esc_html__( 'This is a date control.', 'kirki' ),
		'section'     => 'date_section',
		'default'     => '',
	]
);

/**
 * Editor Controls
 */
new \Kirki\Field\Editor(
	[
		'settings'    => 'editor_1',
		'label'       => esc_html__( 'First Editor Control', 'kirki' ),
		'description' => esc_html__( 'This is an editor control.', 'kirki' ),
		'section'     => 'editor_section',
		'default'     => '',
	]
);

new \Kirki\Field\Editor(
	[
		'settings'    => 'editor_2',
		'label'       => esc_html__( 'Second Editor Control', 'kirki' ),
		'description' => esc_html__( 'This is a 2nd editor control just to check that we do not have issues with multiple instances.', 'kirki' ),
		'section'     => 'editor_section',
		'default'     => esc_html__( 'Default Text', 'kirki' ),
	]
);

/**
 * Color-Palette Controls.
 *
 * @link https://kirki.org/docs/controls/color-palette.html
 */
new \Kirki\Field\Color_Palette(
	[
		'settings'    => 'color_palette_setting__simple',
		'label'       => esc_html__( 'Simple Colors Set', 'kirki' ),
		'description' => esc_html__( 'With default size (28). The `size` here is inner size (without border)', 'kirki' ),
		'section'     => 'color_palette_section',
		'default'     => '#888888',
		'transport'   => 'postMessage',
		'choices'     => [
			'colors' => [ '#000000', '#222222', '#444444', '#666666', '#888888', '#aaaaaa', '#cccccc', '#eeeeee', '#ffffff' ],
			'style'  => 'round',
		],
	]
);

new \Kirki\Field\Color_Palette(
	[
		'settings'    => 'color_palette_setting__material_all',
		'label'       => esc_html__( 'Material Design Colors — All', 'kirki' ),
		'description' => esc_html__( 'Showing all material design colors using `round` shape and size is 17', 'kirki' ),
		'section'     => 'color_palette_section',
		'default'     => '#D1C4E9',
		'transport'   => 'postMessage',
		'choices'     => [
			'colors' => Helper::get_material_design_colors( 'all' ),
			'shape'  => 'round',
			'size'   => 17,
		],
	]
);

new \Kirki\Field\Color_Palette(
	[
		'settings'    => 'color_palette_setting__material_primary',
		'label'       => esc_html__( 'Material Design Colors — Primary', 'kirki' ),
		'description' => esc_html__( 'Showing primary material design colors', 'kirki' ),
		'section'     => 'color_palette_section',
		'choices'     => [
			'colors' => Helper::get_material_design_colors( 'primary' ),
			'size'   => 25,
		],
	]
);

new \Kirki\Field\Color_Palette(
	[
		'settings'    => 'color_palette_setting__material_red',
		'label'       => esc_html__( 'Material Design Colors — Red', 'kirki' ),
		'description' => esc_html__( 'Showing red material design colors', 'kirki' ),
		'section'     => 'color_palette_section',
		'choices'     => [
			'colors' => Helper::get_material_design_colors( 'red' ),
			'size'   => 16,
		],
	]
);

new \Kirki\Field\Color_Palette(
	[
		'settings'    => 'color_palette_setting__a100',
		'label'       => esc_html__( 'Material Design Colors — A100', 'kirki' ),
		'description' => esc_html__( 'Showing "A100" variant of material design colors', 'kirki' ),
		'section'     => 'color_palette_section',
		'default'     => '#FF80AB',
		'choices'     => [
			'colors' => Helper::get_material_design_colors( 'A100' ),
			'size'   => 60,
			'style'  => 'round',
		],
	]
);

Kirki::add_field(
	'theme_config_id',
	[
		'type'        => 'color-palette',
		'settings'    => 'color_palette_setting__old',
		'label'       => 'The Old Way',
		'description' => 'Using `Kirki::add_field` in round shape',
		'section'     => 'color_palette_section',
		'transport'   => 'postMessage',
		'choices'     => [
			'colors' => [ '#000000', '#222222', '#444444', '#666666', '#888888', '#aaaaaa', '#cccccc', '#eeeeee', '#ffffff' ],
			'style'  => 'round',
		],
	]
);

/**
 * Dashicons control.
 *
 * @link https://kirki.org/docs/controls/dashicons.html
 */
new \Kirki\Field\Dashicons(
	[
		'settings'    => 'dashicons_setting_0',
		'label'       => esc_html__( 'Dashicons Control', 'kirki' ),
		'description' => esc_html__( 'Using a custom array of dashicons', 'kirki' ),
		'section'     => 'dashicons_section',
		'default'     => 'menu',
		'choices'     => [
			'menu',
			'admin-site',
			'dashboard',
			'admin-post',
			'admin-media',
			'admin-links',
			'admin-page',
		],
	]
);

new \Kirki\Field\Dashicons(
	[
		'settings'    => 'dashicons_setting_1',
		'label'       => esc_html__( 'All Dashicons', 'kirki' ),
		'description' => esc_html__( 'Showing all dashicons', 'kirki' ),
		'section'     => 'dashicons_section',
		'default'     => 'menu',
	]
);

/**
 * Dimension Control.
 */
new \Kirki\Field\Dimension(
	[
		'settings'    => 'dimension_0',
		'label'       => esc_html__( 'Dimension Control', 'kirki' ),
		'description' => esc_html__( 'Description Here.', 'kirki' ),
		'section'     => 'dimension_section',
		'default'     => '10px',
		'choices'     => [
			'accept_unitless' => true,
		],
	]
);

/**
 * Dimensions Control.
 */
new \Kirki\Field\Dimensions(
	[
		'settings'    => 'dimensions_0',
		'label'       => esc_html__( 'Dimension Control', 'kirki' ),
		'description' => esc_html__( 'Description Here.', 'kirki' ),
		'section'     => 'dimensions_section',
		'default'     => [
			'width'  => '100px',
			'height' => '100px',
		],
	]
);

new \Kirki\Field\Dimensions(
	[
		'settings'    => 'dimensions_1',
		'label'       => esc_html__( 'Dimension Control', 'kirki' ),
		'description' => esc_html__( 'Description Here.', 'kirki' ),
		'section'     => 'dimensions_section',
		'default'     => [
			'padding-top'    => '1em',
			'padding-bottom' => '10rem',
			'padding-left'   => '1vh',
			'padding-right'  => '10px',
		],
	]
);

new \Kirki\Field\Dimensions(
	[
		'settings'    => 'padding_0',
		'label'       => esc_html__( 'Padding Control', 'kirki' ),
		'description' => esc_html__( 'Please set the padding for the element.', 'kirki' ),
		'section'     => 'dimensions_section',
		'default'     => [
			'top'        => '1em',
			'bottom'     => '10rem',
			'horizontal' => '1vh',
		],
	]
);

new \Kirki\Field\Dimensions(
	[
		'settings'    => 'spacing_0',
		'label'       => esc_html__( 'Spacing Control', 'kirki' ),
		'description' => esc_html__( 'Please set the spacing for the element.', 'kirki' ),
		'section'     => 'dimensions_section',
		'default'     => [
			'top'    => '1em',
			'bottom' => '10rem',
			'left'   => '1vh',
			'right'  => '10px',
		],
	]
);

/**
 * Dropdown-pages Control.
 */
new \Kirki\Field\Dropdown_Pages(
	[
		'settings'    => 'dropdown-pages',
		'label'       => esc_html__( 'Dropdown Pages Control', 'kirki' ),
		'description' => esc_html__( 'Description Here.', 'kirki' ),
		'section'     => 'dropdown_pages_section',
		'default'     => [
			'width'  => '100px',
			'height' => '100px',
		],
	]
);

/**
 * Generic Controls.
 */
new \Kirki\Field\Text(
	[
		'settings'    => 'generic_text_setting',
		'label'       => esc_html__( 'Generic Control — Text Field', 'kirki' ),
		'description' => esc_html__( 'Description', 'kirki' ),
		'section'     => 'generic_section',
		'default'     => '',
	]
);

new \Kirki\Field\URL(
	[
		'settings'    => 'generic_url_setting',
		'label'       => esc_html__( 'Generic Control — URL Field', 'kirki' ),
		'description' => esc_html__( 'Description', 'kirki' ),
		'section'     => 'generic_section',
		'default'     => '',
	]
);

new \Kirki\Field\Textarea(
	[
		'settings'    => 'generic_textarea_setting',
		'label'       => esc_html__( 'Generic Control — Textarea Field', 'kirki' ),
		'description' => esc_html__( 'Description', 'kirki' ),
		'section'     => 'generic_section',
		'default'     => '',
	]
);

new \Kirki\Field\Generic(
	[
		'settings'    => 'generic_custom_setting',
		'label'       => esc_html__( 'Generic Control — Custom Input.', 'kirki' ),
		'description' => esc_html__( 'The "generic" control allows you to add any input type you want. In this case we use type="password" and define custom styles.', 'kirki' ),
		'section'     => 'generic_section',
		'default'     => '',
		'choices'     => [
			'element'  => 'input',
			'type'     => 'password',
			'style'    => 'background-color:black;color:red;',
			'data-foo' => 'bar',
		],
	]
);

/**
 * Image Control.
 */
new \Kirki\Field\Image(
	[
		'settings'    => 'image_setting_url',
		'label'       => esc_html__( 'Image Control (URL)', 'kirki' ),
		'description' => esc_html__( 'Description Here.', 'kirki' ),
		'section'     => 'image_section',
		'default'     => '',
	]
);

new \Kirki\Field\Image(
	[
		'settings'    => 'image_setting_id',
		'label'       => esc_html__( 'Image Control (ID)', 'kirki' ),
		'description' => esc_html__( 'Description Here.', 'kirki' ),
		'section'     => 'image_section',
		'default'     => '',
		'choices'     => [
			'save_as' => 'id',
		],
	]
);

new \Kirki\Field\Image(
	[
		'settings'    => 'image_setting_array',
		'label'       => esc_html__( 'Image Control (array)', 'kirki' ),
		'description' => esc_html__( 'Description Here.', 'kirki' ),
		'section'     => 'image_section',
		'default'     => '',
		'choices'     => [
			'save_as' => 'array',
		],
	]
);

/**
 * Upload control.
 */
new \Kirki\Field\Upload(
	[
		'settings'    => 'upload_setting_url',
		'label'       => esc_html__( 'Upload Control (URL)', 'kirki' ),
		'description' => esc_html__( 'Description Here.', 'kirki' ),
		'section'     => 'upload_section',
		'default'     => '',
		'transport'   => 'postMessage',
	]
);

/**
 * Multicheck Control.
 */
new \Kirki\Field\Multicheck(
	[
		'settings' => 'multicheck_setting',
		'label'    => esc_html__( 'Multickeck Control', 'kirki' ),
		'section'  => 'multicheck_section',
		'default'  => [ 'option-1', 'option-3', 'option-4' ],
		'priority' => 10,
		'choices'  => [
			'option-1' => esc_html__( 'Option 1', 'kirki' ),
			'option-2' => esc_html__( 'Option 2', 'kirki' ),
			'option-3' => esc_html__( 'Option 3', 'kirki' ),
			'option-4' => esc_html__( 'Option 4', 'kirki' ),
			'option-5' => esc_html__( 'Option 5', 'kirki' ),
		],
	]
);

/**
 * Multicolor Control.
 */
new \Kirki\Field\Multicolor(
	[
		'settings'  => 'multicolor_setting',
		'label'     => esc_html__( 'Multicolor Control', 'kirki' ),
		'section'   => 'multicolor_section',
		'priority'  => 10,
		'transport' => 'postMessage',
		'choices'   => [
			'link'   => esc_html__( 'Color', 'kirki' ),
			'hover'  => esc_html__( 'Hover', 'kirki' ),
			'active' => esc_html__( 'Active', 'kirki' ),
		],
		'alpha'     => true,
		'default'   => [
			'link'   => '#0088cc',
			'hover'  => '#00aaff',
			'active' => '#00ffff',
		],
	]
);

/**
 * Number Control.
 */
new \Kirki\Field\Number(
	[
		'settings' => 'number_setting',
		'label'    => esc_html__( 'Number Control', 'kirki' ),
		'section'  => 'number_section',
		'priority' => 10,
		'choices'  => [
			'min'  => -5,
			'max'  => 5,
			'step' => 1,
		],
	]
);

/**
 * Radio Control.
 */
new \Kirki\Field\Radio(
	[
		'settings'    => 'radio_setting',
		'label'       => esc_html__( 'Radio Control', 'kirki' ),
		'description' => esc_html__( 'The description here.', 'kirki' ),
		'section'     => 'radio_section',
		'default'     => 'option-3',
		'choices'     => [
			'option-1' => esc_html__( 'Option 1', 'kirki' ),
			'option-2' => esc_html__( 'Option 2', 'kirki' ),
			'option-3' => esc_html__( 'Option 3', 'kirki' ),
			'option-4' => esc_html__( 'Option 4', 'kirki' ),
			'option-5' => esc_html__( 'Option 5', 'kirki' ),
		],
	]
);

/**
 * Radio-Buttonset Control.
 */
new \Kirki\Field\Radio_Buttonset(
	[
		'settings'    => 'radio_buttonset_setting',
		'label'       => esc_html__( 'Radio-Buttonset Control', 'kirki' ),
		'description' => esc_html__( 'The description here.', 'kirki' ),
		'section'     => 'radio_buttonset_section',
		'default'     => 'option-2',
		'choices'     => [
			'option-1' => esc_html__( 'Option 1', 'kirki' ),
			'option-2' => esc_html__( 'Option 2', 'kirki' ),
			'option-3' => esc_html__( 'Option 3', 'kirki' ),
		],
	]
);

/**
 * Radio-Image Control.
 */
new \Kirki\Field\Radio_Image(
	[
		'settings'    => 'radio_image_setting',
		'label'       => esc_html__( 'Radio-Image Control', 'kirki' ),
		'description' => esc_html__( 'The description here.', 'kirki' ),
		'section'     => 'radio_image_section',
		'default'     => 'travel',
		'choices'     => [
			'moto'    => 'https://jawordpressorg.github.io/wapuu/wapuu-archive/wapuu-moto.png',
			'cossack' => 'https://raw.githubusercontent.com/templatemonster/cossack-wapuula/master/cossack-wapuula.png',
			'travel'  => 'https://jawordpressorg.github.io/wapuu/wapuu-archive/wapuu-travel.png',
		],
	]
);

/**
 * Repeater Control.
 */
new \Kirki\Field\Repeater(
	[
		'settings'    => 'repeater_setting',
		'label'       => esc_html__( 'Repeater Control', 'kirki' ),
		'description' => esc_html__( 'The description here.', 'kirki' ),
		'section'     => 'repeater_section',
		'default'     => [
			[
				'link_text'   => esc_html__( 'Kirki Site', 'kirki' ),
				'link_url'    => 'https://kirki.org/',
				'link_target' => '_self',
				'checkbox'    => false,
			],
			[
				'link_text'   => esc_html__( 'Kirki Repository', 'kirki' ),
				'link_url'    => 'https://github.com/aristath/kirki',
				'link_target' => '_self',
				'checkbox'    => false,
			],
		],
		'fields'      => [
			'link_text'   => [
				'type'        => 'text',
				'label'       => esc_html__( 'Link Text', 'kirki' ),
				'description' => esc_html__( 'This will be the label for your link', 'kirki' ),
				'default'     => '',
			],
			'link_url'    => [
				'type'        => 'text',
				'label'       => esc_html__( 'Link URL', 'kirki' ),
				'description' => esc_html__( 'This will be the link URL', 'kirki' ),
				'default'     => '',
			],
			'link_target' => [
				'type'        => 'select',
				'label'       => esc_html__( 'Link Target', 'kirki' ),
				'description' => esc_html__( 'This will be the link target', 'kirki' ),
				'default'     => '_self',
				'choices'     => [
					'_blank' => esc_html__( 'New Window', 'kirki' ),
					'_self'  => esc_html__( 'Same Frame', 'kirki' ),
				],
			],
			'checkbox'    => [
				'type'    => 'checkbox',
				'label'   => esc_html__( 'Checkbox', 'kirki' ),
				'default' => false,
			],
		],
	]
);

/**
 * Select Control.
 */
new \Kirki\Field\Select(
	[
		'settings'    => 'select_setting',
		'label'       => esc_html__( 'Select Control', 'kirki' ),
		'description' => esc_html__( 'The description here.', 'kirki' ),
		'section'     => 'select_section',
		'default'     => 'option-3',
		'placeholder' => esc_html__( 'Select an option', 'kirki' ),
		'choices'     => [
			'option-1' => esc_html__( 'Option 1', 'kirki' ),
			'option-2' => esc_html__( 'Option 2', 'kirki' ),
			'option-3' => esc_html__( 'Option 3', 'kirki' ),
			'option-4' => esc_html__( 'Option 4', 'kirki' ),
			'option-5' => esc_html__( 'Option 5', 'kirki' ),
		],
	]
);

new \Kirki\Field\Select(
	[
		'settings'    => 'select_setting_multiple',
		'label'       => esc_html__( 'Select Control', 'kirki' ),
		'description' => esc_html__( 'The description here.', 'kirki' ),
		'section'     => 'select_section',
		'default'     => 'option-3',
		'multiple'    => 3,
		'choices'     => [
			'option-1' => esc_html__( 'Option 1', 'kirki' ),
			'option-2' => esc_html__( 'Option 2', 'kirki' ),
			'option-3' => esc_html__( 'Option 3', 'kirki' ),
			'option-4' => esc_html__( 'Option 4', 'kirki' ),
			'option-5' => esc_html__( 'Option 5', 'kirki' ),
		],
	]
);

/**
 * Slider Control.
 */
new \Kirki\Field\Slider(
	[
		'settings'    => 'slider_setting',
		'label'       => esc_html__( 'Slider Control', 'kirki' ),
		'description' => esc_html__( 'The description here.', 'kirki' ),
		'section'     => 'slider_section',
		'default'     => '10',
		'transport'   => 'postMessage',
		'choices'     => [
			'min'  => 0,
			'max'  => 100,
			'step' => 1,
		],
	]
);

Kirki::add_field(
	'theme_config_id',
	[
		'type'        => 'slider',
		'settings'    => 'slider_setting_old',
		'label'       => esc_html__( 'Slider Control — Using Old Way', 'kirki' ),
		'description' => 'Added using `Kirki::add_field`',
		'section'     => 'slider_section',
		'transport'   => 'postMessage',
		'choices'     => [
			'min'  => 0,
			'max'  => 100,
			'step' => 0.5,
		],
	]
);

/**
 * Sortable control.
 */
new \Kirki\Field\Sortable(
	[
		'settings' => 'sortable_setting',
		'label'    => __( 'This is a sortable control.', 'kirki' ),
		'section'  => 'sortable_section',
		'default'  => [ 'option3', 'option1', 'option4' ],
		'choices'  => [
			'option1' => esc_html__( 'Option 1', 'kirki' ),
			'option2' => esc_html__( 'Option 2', 'kirki' ),
			'option3' => esc_html__( 'Option 3', 'kirki' ),
			'option4' => esc_html__( 'Option 4', 'kirki' ),
			'option5' => esc_html__( 'Option 5', 'kirki' ),
			'option6' => esc_html__( 'Option 6', 'kirki' ),
		],
	]
);

/**
 * Switch control.
 */
new \Kirki\Field\Checkbox_Switch(
	[
		'settings'    => 'switch_setting',
		'label'       => esc_html__( 'Switch Field', 'kirki' ),
		'description' => esc_html__( 'Simple switch control', 'kirki' ),
		'section'     => 'switch_section',
		'transport'   => 'postMessage',
		'default'     => true,
	]
);

new \Kirki\Field\Checkbox_Switch(
	[
		'settings'        => 'switch_setting_custom_label',
		'label'           => esc_html__( 'Switch Field — With custom labels', 'kirki' ),
		'description'     => esc_html__( 'Switch control using custom labels', 'kirki' ),
		'section'         => 'switch_section',
		'default'         => true,
		'choices'         => [
			'on'  => esc_html__( 'Enabled', 'kirki' ),
			'off' => esc_html__( 'Disabled', 'kirki' ),
		],
		'active_callback' => [
			[
				'setting'  => 'switch_setting',
				'operator' => '==',
				'value'    => true,
			],
		],
	]
);

/**
 * Toggle control.
 */
Kirki::add_field(
	'theme_config_id',
	[
		'type'        => 'toggle',
		'settings'    => 'toggle_setting',
		'label'       => esc_html__( 'Toggle Field', 'kirki' ),
		'description' => esc_html__( 'Toggle is just utilizing switch control but aligned horizontally & without the text', 'kirki' ),
		'section'     => 'toggle_section',
		'default'     => '1',
		'priority'    => 10,
		'transport'   => 'postMessage',
	]
);

/**
 * Typography Control.
 */
new \Kirki\Field\Typography(
	[
		'settings'    => 'typography_setting_0',
		'label'       => esc_html__( 'Typography Control', 'kirki' ),
		'description' => esc_html__( 'The full set of options.', 'kirki' ),
		'section'     => 'typography_section',
		'priority'    => 10,
		'transport'   => 'auto',
		'default'     => [
			'font-family'     => 'Roboto',
			'variant'         => 'regular',
			'font-style'      => 'normal',
			'color'           => '#333333',
			'font-size'       => '14px',
			'line-height'     => '1.5',
			'letter-spacing'  => '0',
			'word-spacing'    => 'normal',
			'text-transform'  => 'none',
			'text-decoration' => 'none',
			'text-align'      => 'left',
			'margin-top'      => '0',
			'margin-right'    => '0',
			'margin-bottom'   => '0',
			'margin-left'     => '0',
		],
		'output'      => [
			[
				'element' => 'body, p',
			],
		],
		'choices'     => [
			'fonts' => [
				'google'   => [ 'popularity', 60 ],
				'families' => [
					'custom' => [
						'text'     => 'My Custom Fonts (demo only)',
						'children' => [
							[
								'id'   => 'helvetica-neue',
								'text' => 'Helvetica Neue',
							],
							[
								'id'   => 'linotype-authentic',
								'text' => 'Linotype Authentic',
							],
						],
					],
				],
				'variants' => [
					'helvetica-neue'     => [ 'regular', '900' ],
					'linotype-authentic' => [ 'regular', '100', '300' ],
				],
			],
		],
	]
);

// new \Kirki\Field\Typography(
// 	[
// 		'settings'    => 'typography_setting_1',
// 		'label'       => esc_html__( 'Typography Control', 'kirki' ),
// 		'description' => esc_html__( 'Just the font-family and font-weight.', 'kirki' ),
// 		'section'     => 'typography_section',
// 		'priority'    => 10,
// 		'transport'   => 'auto',
// 		'default'     => [
// 			'font-family' => 'Roboto',
// 		],
// 		'output'      => [
// 			[
// 				'element' => [ 'h1', 'h2', 'h3', 'h4', 'h5', 'h6' ],
// 			],
// 		],
// 	]
// );

/**
 * Example function that creates a control containing the available sidebars as choices.
 *
 * @return void
 */
function kirki_sidebars_select_example() {
	$sidebars = [];
	if ( isset( $GLOBALS['wp_registered_sidebars'] ) ) {
		$sidebars = $GLOBALS['wp_registered_sidebars'];
	}
	$sidebars_choices = [];
	foreach ( $sidebars as $sidebar ) {
		$sidebars_choices[ $sidebar['id'] ] = $sidebar['name'];
	}
	if ( ! class_exists( 'Kirki' ) ) {
		return;
	}
	new \Kirki\Field\Select(
		[
			'settings'    => 'sidebars_select',
			'label'       => esc_html__( 'Sidebars Select', 'kirki' ),
			'description' => esc_html__( 'An example of how to implement sidebars selection.', 'kirki' ),
			'section'     => 'select_section',
			'default'     => 'primary',
			'choices'     => $sidebars_choices,
			'priority'    => 30,
		]
	);
}
add_action( 'init', 'kirki_sidebars_select_example', 999 );
