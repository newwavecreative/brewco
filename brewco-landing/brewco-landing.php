<?php
/**
 * Plugin Name:       Brewco Marketing Group — Landing
 * Description:        Registers the "Brewco Landing" page template (custom-coded landing page). Loads its own CSS/JS only on pages using that template, so the rest of the site is untouched.
 * Version:           1.0.0
 * Author:            Brewco Marketing Group
 * License:           GPL-2.0-or-later
 */

if ( ! defined( 'ABSPATH' ) ) { exit; }

define( 'BREWCO_LANDING_DIR', plugin_dir_path( __FILE__ ) );
define( 'BREWCO_LANDING_URL', plugin_dir_url( __FILE__ ) );

/** Template identifier stored as the page's _wp_page_template meta. */
const BREWCO_LANDING_SLUG = 'brewco-landing';

/**
 * Versioned asset URL (adds ?v=<filemtime>) so browsers/CDNs always fetch the
 * current file — otherwise <img>/<video> tags cache indefinitely across deploys.
 *
 * @param string $rel path relative to the plugin's assets/ dir, e.g. "logo.png".
 */
function brewco_landing_asset( $rel ) {
	$path = BREWCO_LANDING_DIR . 'assets/' . ltrim( $rel, '/' );
	$ver  = file_exists( $path ) ? filemtime( $path ) : '1';
	return esc_url( BREWCO_LANDING_URL . 'assets/' . ltrim( $rel, '/' ) . '?v=' . $ver );
}

/**
 * 1. Add "Brewco Landing" to the Page Attributes → Template dropdown.
 *    Works regardless of the active theme (theme_page_templates fires for any theme).
 */
add_filter( 'theme_page_templates', function ( $templates ) {
	$templates[ BREWCO_LANDING_SLUG ] = 'Brewco Landing';
	return $templates;
} );

/**
 * 2. When a page uses our template, render our file instead of the theme's.
 */
add_filter( 'template_include', function ( $template ) {
	if ( is_page() ) {
		$slug = get_page_template_slug( get_queried_object_id() );
		if ( BREWCO_LANDING_SLUG === $slug ) {
			$custom = BREWCO_LANDING_DIR . 'templates/landing-template.php';
			if ( file_exists( $custom ) ) {
				return $custom;
			}
		}
	}
	return $template;
} );

/**
 * 3. Enqueue CSS/JS + fonts ONLY on pages using our template.
 *    filemtime() versioning busts the cache automatically on every deploy.
 */
add_action( 'wp_enqueue_scripts', function () {
	if ( ! is_page() ) { return; }
	if ( BREWCO_LANDING_SLUG !== get_page_template_slug( get_queried_object_id() ) ) { return; }

	$css   = BREWCO_LANDING_DIR . 'assets/css/styles.css';
	$js    = BREWCO_LANDING_DIR . 'assets/js/main.js';
	$lenis = BREWCO_LANDING_DIR . 'assets/js/lenis.min.js';

	// Brewco's typeface is Cero Pro Light, self-hosted on this WordPress install
	// by the "Use Any Font" plugin. The @font-face in styles.css points at
	// /wp-content/uploads/useanyfont/ directly, so there is no external font
	// request here — nothing to enqueue from Google Fonts.
	wp_enqueue_style(
		'brewco-landing',
		BREWCO_LANDING_URL . 'assets/css/styles.css',
		array(),
		file_exists( $css ) ? filemtime( $css ) : '1.0.0'
	);
	// Lenis smooth scroll (the same library Framer/MEDVi use) — loaded first.
	wp_enqueue_script(
		'brewco-lenis',
		BREWCO_LANDING_URL . 'assets/js/lenis.min.js',
		array(),
		file_exists( $lenis ) ? filemtime( $lenis ) : '1.3.25',
		true
	);
	wp_enqueue_script(
		'brewco-landing',
		BREWCO_LANDING_URL . 'assets/js/main.js',
		array( 'brewco-lenis' ), // ensure Lenis global exists before main.js runs
		file_exists( $js ) ? filemtime( $js ) : '1.0.0',
		true // in footer, after DOM
	);
} );
