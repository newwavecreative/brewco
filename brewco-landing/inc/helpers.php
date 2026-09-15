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

/**
 * A repeater, as an array of rows. $fallback is the shipped set.
 *
 * Blank rows are dropped, and if nothing is left the shipped set is used. A
 * repeater saved with only an empty row (an "Add row" clicked and never
 * filled) used to count as real content: it suppressed the fallback and drew
 * an empty item — the Vehicles section went live as one empty pill.
 *
 * $content_keys names the sub-fields that make a row "real". Pass it for any
 * repeater with a sub-field that has a default value (a select, or a text
 * field with default_value): a freshly added row carries that default, so
 * without the list a blank row would look filled in. With no list, any
 * non-blank value counts.
 */
function brewco_rows( $name, $fallback = array(), $content_keys = array() ) {
	if ( ! function_exists( 'get_field' ) ) { return $fallback; }
	$v = get_field( $name );
	if ( empty( $v ) || ! is_array( $v ) ) { return $fallback; }
	$rows = array();
	foreach ( $v as $row ) {
		if ( brewco_row_has_content( $row, $content_keys ) ) { $rows[] = $row; }
	}
	return $rows ? $rows : $fallback;
}

/** Does this repeater row carry any content in the given keys (or any key)? */
function brewco_row_has_content( $row, $keys = array() ) {
	if ( ! is_array( $row ) ) { return ! brewco_is_blank( $row ); }
	$check = $keys ? array_intersect_key( $row, array_flip( $keys ) ) : $row;
	foreach ( $check as $val ) {
		if ( ! brewco_is_blank( $val ) ) { return true; }
	}
	return false;
}

/** Empty for our purposes: null, false, an empty array, or whitespace-only text. */
function brewco_is_blank( $v ) {
	if ( null === $v || false === $v || array() === $v ) { return true; }
	if ( is_string( $v ) ) { return '' === trim( $v ); }
	return false;
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

/**
 * A file field's URL (e.g. the hero video), or '' when unset. As with images,
 * ACF returns an array, an attachment ID or a URL depending on return format.
 */
function brewco_file_url( $name ) {
	$v = function_exists( 'get_field' ) ? get_field( $name ) : null;
	if ( is_array( $v ) && ! empty( $v['url'] ) ) { return esc_url( $v['url'] ); }
	if ( is_numeric( $v ) && (int) $v > 0 ) {
		$src = wp_get_attachment_url( (int) $v );
		return $src ? esc_url( $src ) : '';
	}
	if ( is_string( $v ) && '' !== $v ) { return esc_url( $v ); }
	return '';
}

/**
 * Normalise an image VALUE (not a field name) — e.g. a repeater sub-field — to
 * array( url, width, height, alt ), or null when there is no usable image.
 *
 * ACF hands back an attachment array, a bare ID or a URL depending on the
 * field's return format, and `false` for an empty image. Width/height are
 * returned so the markup can reserve the image's space before it loads: that
 * avoids layout shift, and it keeps the logo marquee's measured width correct
 * from the first frame.
 */
function brewco_image_data( $v ) {
	if ( is_array( $v ) && ! empty( $v['url'] ) ) {
		return array(
			'url'    => esc_url( $v['url'] ),
			'width'  => isset( $v['width'] ) ? (int) $v['width'] : 0,
			'height' => isset( $v['height'] ) ? (int) $v['height'] : 0,
			'alt'    => isset( $v['alt'] ) ? (string) $v['alt'] : '',
		);
	}
	if ( is_numeric( $v ) && (int) $v > 0 ) {
		$src = wp_get_attachment_image_src( (int) $v, 'full' );
		if ( $src ) {
			return array(
				'url'    => esc_url( $src[0] ),
				'width'  => (int) $src[1],
				'height' => (int) $src[2],
				'alt'    => (string) get_post_meta( (int) $v, '_wp_attachment_image_alt', true ),
			);
		}
		return null;
	}
	if ( is_string( $v ) && '' !== $v ) {
		return array( 'url' => esc_url( $v ), 'width' => 0, 'height' => 0, 'alt' => '' );
	}
	return null;
}

/** width="" height="" attributes, or nothing when dimensions are unknown. */
function brewco_img_dims( $img ) {
	if ( empty( $img['width'] ) || empty( $img['height'] ) ) { return ''; }
	return ' width="' . (int) $img['width'] . '" height="' . (int) $img['height'] . '"';
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

/**
 * A button's link field: a section of this page (#contact), a page on the site
 * (/contact/) or a full URL. esc_url() returns '' for anything unsafe or
 * malformed (e.g. javascript:), so fall back to the default instead of printing
 * a button that goes nowhere.
 */
function brewco_link( $name, $fallback ) {
	$url = esc_url( trim( (string) brewco_field( $name, $fallback ) ) );
	return '' !== $url ? $url : esc_url( $fallback );
}

/** Row value with fallback, for repeater rows that may predate a sub-field. */
function brewco_row( $row, $key, $fallback = '' ) {
	return ( is_array( $row ) && isset( $row[ $key ] ) && '' !== $row[ $key ] ) ? $row[ $key ] : $fallback;
}
