<?php
/**
 * Slumber Falls Theme Customizer
 *
 * @package Slumber_Falls
 */

/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function slumber_falls_customize_register( $wp_customize ) {
	$wp_customize->get_setting( 'blogname' )->transport         = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport  = 'postMessage';
	$wp_customize->get_setting( 'header_textcolor' )->transport = 'postMessage';

	if ( isset( $wp_customize->selective_refresh ) ) {
		$wp_customize->selective_refresh->add_partial(
			'blogname',
			array(
				'selector'        => '.site-title a',
				'render_callback' => 'slumber_falls_customize_partial_blogname',
			)
		);
		$wp_customize->selective_refresh->add_partial(
			'blogdescription',
			array(
				'selector'        => '.site-description',
				'render_callback' => 'slumber_falls_customize_partial_blogdescription',
			)
		);
	}

	// Footer Logo Section
	$wp_customize->add_section(
		'slumber_falls_footer_logo',
		array(
			'title'    => __( 'Footer Logo', 'slumber-falls' ),
			'priority' => 40,
		)
	);

	// Footer Logo Setting
	$wp_customize->add_setting(
		'footer_logo',
		array(
			'default'           => '',
			'sanitize_callback' => 'absint',
		)
	);

	// Footer Logo Control
	$wp_customize->add_control(
		new WP_Customize_Media_Control(
			$wp_customize,
			'footer_logo',
			array(
				'label'       => __( 'Footer Logo (White)', 'slumber-falls' ),
				'description' => __( 'Upload a white logo on transparent background for the footer. Recommended size: 200x80px', 'slumber-falls' ),
				'section'     => 'slumber_falls_footer_logo',
				'mime_type'   => 'image',
			)
		)
	);
}
add_action( 'customize_register', 'slumber_falls_customize_register' );

/**
 * Render the site title for the selective refresh partial.
 *
 * @return void
 */
function slumber_falls_customize_partial_blogname() {
	bloginfo( 'name' );
}

/**
 * Render the site tagline for the selective refresh partial.
 *
 * @return void
 */
function slumber_falls_customize_partial_blogdescription() {
	bloginfo( 'description' );
}

/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 */
function slumber_falls_customize_preview_js() {
	wp_enqueue_script( 'slumber-falls-customizer', get_template_directory_uri() . '/js/customizer.js', array( 'customize-preview' ), _S_VERSION, true );
}
add_action( 'customize_preview_init', 'slumber_falls_customize_preview_js' );
