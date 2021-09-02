<?php
function test_customize_register( $wp_customize ) {
	$wp_customize->add_setting(
		'test_bg_color',
		array(
			'type'              => 'option',
			'capability'        => 'edit_theme_options',
			'default'           => '#f1f1f1',
			'transport'         => 'postMessage',
			'sanitize_callback' => 'sanitize_hex_color',
		)
	);

	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize,
			'test_bg_color',
			array(
				'label'    => __( 'Background Color', 'ultimate-dashboard' ),
				'section'  => 'kirki_color_section',
				'settings' => 'test_bg_color',
			)
		)
	);
}
add_action( 'customize_register', 'test_customize_register' );

/**
 * Enqueue login customizer control scripts.
 */
function kirki4_test_control_scripts() {

	wp_enqueue_script( 'kirki4-test-customizer-control', plugin_dir_url( __DIR__ ) . '/kirki4-test/controls.js', array( 'customize-controls' ), '0.0.1', true );

	// wp_localize_script(
	// 'customize-controls',
	// 'udbLoginCustomizer',
	// $this->create_js_object()
	// );
}
add_action( 'customize_controls_enqueue_scripts', 'kirki4_test_control_scripts' );
