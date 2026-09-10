<?php
/**
 * Field accessors with inline fallbacks.
 *
 * Every getter here takes the template's original hardcoded value as its
 * fallback. That matters for two reasons:
 *
 *   1. ACF's `default_value` only populates fields when a post is CREATED.
 *      A page that already exists (like the draft published before these
 *      fields shipped) comes back with every field empty — without fallbacks
 *      it would render as a blank shell.
 *   2. If ACF is ever deactivated, `get_field()` disappears. The guards below
 *      mean the page degrades to exactly the copy it shipped with rather than
 *      fataling.
 *
 * So the page renders identically until someone deliberately overrides a field.
 */
if ( ! defined( 'ABSPATH' ) ) { exit; }

/** A single value, falling back to the shipped copy. */
function brewco_field( $name, $fallback = '' ) {
	if ( ! function_exists( 'get_field' ) ) { return $fallback; }
	$v = get_field( $name );
	if ( null === $v || '' === $v || false === $v || array() === $v ) { return $fallback; }
	return $v;
}

/** A repeater, as an array of rows. $fallback is the shipped set. */
function brewco_rows( $name, $fallback = array() ) {
	if ( ! function_exists( 'get_field' ) ) { return $fallback; }
	$v = get_field( $name );
	if ( empty( $v ) || ! is_array( $v ) ) { return $fallback; }
	return $v;
}

/**
 * An image field's URL. ACF may return an array, an ID or a URL depending on
 * the field's return format, so normalise all three.
 *
 * @param string $name         field name
 * @param string $fallback_rel path relative to assets/, e.g. "img/placeholder.svg"
 */
function brewco_image_url( $name, $fallback_rel ) {
	$v = function_exists( 'get_field' ) ? get_field( $name ) : null;
	if ( is_array( $v ) && ! empty( $v['url'] ) ) { return esc_url( $v['url'] ); }
	if ( is_numeric( $v ) ) {
		$src = wp_get_attachment_image_url( (int) $v, 'full' );
		if ( $src ) { return esc_url( $src ); }
	}
	if ( is_string( $v ) && '' !== $v ) { return esc_url( $v ); }
	return brewco_landing_asset( $fallback_rel );
}

/**
 * A gallery (or image repeater) field as a list of URLs. Returns an empty array
 * when unset, so callers can decide their own fallback chain.
 */
function brewco_gallery_urls( $name ) {
	$out = array();
	$v   = function_exists( 'get_field' ) ? get_field( $name ) : null;
	if ( ! is_array( $v ) ) { return $out; }
	foreach ( $v as $item ) {
		// ACF gallery rows may be attachment arrays, bare IDs or URLs.
		if ( is_array( $item ) ) {
			if ( ! empty( $item['url'] ) ) { $out[] = esc_url( $item['url'] ); }
			continue;
		}
		if ( is_numeric( $item ) ) {
			$src = wp_get_attachment_image_url( (int) $item, 'full' );
			if ( $src ) { $out[] = esc_url( $src ); }
			continue;
		}
		if ( is_string( $item ) && '' !== $item ) { $out[] = esc_url( $item ); }
	}
	return $out;
}

/** Escaped text. */
function brewco_t( $name, $fallback = '' ) {
	return esc_html( brewco_field( $name, $fallback ) );
}

/**
 * Escaped text with newlines converted to <br>. Used where the design needs a
 * deliberate line break (the hero-adjacent headings), so an editor can control
 * wrapping without typing HTML.
 */
function brewco_t_br( $name, $fallback = '' ) {
	return nl2br( esc_html( brewco_field( $name, $fallback ) ), false );
}

/**
 * A two-tone heading: plain text with a copper-accented tail.
 * The accent is a separate field so an editor never has to type a <span>.
 */
function brewco_heading( $plain_name, $plain_fb, $accent_name = '', $accent_fb = '' ) {
	$out = esc_html( brewco_field( $plain_name, $plain_fb ) );
	$accent = $accent_name ? brewco_field( $accent_name, $accent_fb ) : '';
	if ( '' !== $accent ) {
		$out .= ' <span class="text-accent">' . esc_html( $accent ) . '</span>';
	}
	return $out;
}

/** Split a textarea into trimmed, non-empty lines (used for short bullet lists). */
function brewco_lines( $name, $fallback_lines = array() ) {
	$raw = brewco_field( $name, '' );
	if ( '' === $raw ) { return $fallback_lines; }
	$lines = array_filter( array_map( 'trim', preg_split( '/\r\n|\r|\n/', $raw ) ), 'strlen' );
	return $lines ? array_values( $lines ) : $fallback_lines;
}

/** Row value with fallback, for repeater rows that may predate a sub-field. */
function brewco_row( $row, $key, $fallback = '' ) {
	return ( is_array( $row ) && isset( $row[ $key ] ) && '' !== $row[ $key ] ) ? $row[ $key ] : $fallback;
}
