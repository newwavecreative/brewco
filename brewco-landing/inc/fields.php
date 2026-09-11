<?php
/**
 * ACF field group for the Brewco Landing template.
 *
 * Registered in PHP via acf_add_local_field_group() rather than built in the
 * admin UI on purpose: this way the fields live in version control and deploy
 * with the plugin. A field group created through the admin lives only in that
 * install's database, so it would exist on production and nowhere else, and
 * would drift the moment anyone edited it.
 *
 * Local field groups are read-only in the ACF admin (that is expected) — edit
 * this file, not the UI.
 *
 * NOTE: default_value only applies when a post is CREATED. Existing pages come
 * back empty, which is why every getter in helpers.php carries the shipped copy
 * as an inline fallback. The defaults here are a convenience for new pages.
 */
if ( ! defined( 'ABSPATH' ) ) { exit; }

/** Compact builders — keep the field list readable. */
function brewco_f( $type, $name, $label, $extra = array() ) {
	return array_merge(
		array(
			'key'   => 'field_brewco_' . $name,
			'name'  => $name,
			'label' => $label,
			'type'  => $type,
		),
		$extra
	);
}
function brewco_f_tab( $label ) {
	return array(
		'key'       => 'field_brewco_tab_' . sanitize_title( $label ),
		'label'     => $label,
		'type'      => 'tab',
		'placement' => 'left',
	);
}
function brewco_f_rep( $name, $label, $sub, $extra = array() ) {
	return brewco_f(
		'repeater',
		$name,
		$label,
		array_merge(
			array(
				'layout'       => 'block',
				'button_label' => 'Add row',
				'sub_fields'   => $sub,
			),
			$extra
		)
	);
}
/** Sub-fields need their own unique keys. */
function brewco_sf( $type, $parent, $name, $label, $extra = array() ) {
	return array_merge(
		array(
			'key'   => 'field_brewco_' . $parent . '_' . $name,
			'name'  => $name,
			'label' => $label,
			'type'  => $type,
		),
		$extra
	);
}

add_action( 'acf/init', 'brewco_register_fields' );
function brewco_register_fields() {
	if ( ! function_exists( 'acf_add_local_field_group' ) ) { return; }

	$ta  = array( 'type' => 'textarea', 'rows' => 3 );
	$img = array( 'return_format' => 'array', 'preview_size' => 'medium' );

	$fields = array(

		/* ---------------------------------------------------------- HERO */
		brewco_f_tab( 'Hero' ),
		brewco_f( 'textarea', 'hero_headline', 'Headline', array(
			'rows'         => 2,
			'default_value' => 'The Marketing Vehicle for the World’s Most Trusted Brands',
			'instructions' => 'Line breaks here become line breaks on the page.',
		) ),
		brewco_f( 'textarea', 'hero_sub', 'Intro paragraph', array( 'rows' => 4 ) ),
		brewco_f( 'text', 'hero_cta_label', 'Button label', array( 'default_value' => 'Get a Custom Quote' ) ),
		brewco_f( 'text', 'hero_link_label', 'Secondary link label', array( 'default_value' => 'See our work' ) ),
		brewco_f( 'gallery', 'hero_slides', 'Background slideshow', array(
			'return_format' => 'array',
			'preview_size'  => 'medium',
			'instructions'  => 'Two or more images cross-fade automatically. One image just sits still. Drag to reorder — the first one shows first.',
		) ),
		brewco_f( 'number', 'hero_slide_seconds', 'Seconds per slide', array(
			'default_value' => 6,
			'min'           => 2,
			'max'           => 30,
			'append'        => 'sec',
		) ),
		brewco_f( 'image', 'hero_image', 'Background image (fallback)', array_merge( $img, array(
			'instructions' => 'Only used if the slideshow above is empty.',
		) ) ),

		/* ------------------------------------------------------ LOGO BAR */
		brewco_f_tab( 'Client bar' ),
		brewco_f( 'text', 'logobar_label', 'Label', array( 'default_value' => 'Trusted by the brands we build for' ) ),
		brewco_f_rep( 'logobar_clients', 'Clients', array(
			brewco_sf( 'image', 'logobar', 'logo', 'Logo', array(
				'return_format' => 'array',
				'preview_size'  => 'thumbnail',
				'instructions'  => 'PNG with a transparent background works best. WordPress blocks SVG uploads unless an SVG plugin is installed.',
			) ),
			brewco_sf( 'text', 'logobar', 'name', 'Name', array(
				'instructions' => 'Read aloud to screen readers as the logo’s description. Shown as text instead if no logo is uploaded.',
			) ),
		), array( 'layout' => 'table', 'button_label' => 'Add client' ) ),

		/* --------------------------------------------------- WHO WE ARE */
		brewco_f_tab( 'Who We Are' ),
		brewco_f( 'text', 'about_eyebrow', 'Eyebrow', array( 'default_value' => 'Who We Are' ) ),
		brewco_f( 'text', 'about_heading', 'Heading', array( 'default_value' => 'Award-Winning' ) ),
		brewco_f( 'text', 'about_heading_accent', 'Heading (copper part)', array(
			'default_value' => 'Experiential Brand Strategy',
			'instructions'  => 'Shown in the accent colour, after the heading above.',
		) ),
		brewco_f( 'textarea', 'about_text', 'Paragraph', array( 'rows' => 4 ) ),

		/* ---------------------------------------------------- INTEGRATED */
		brewco_f_tab( 'Integrated team' ),
		brewco_f( 'text', 'showcase_eyebrow', 'Eyebrow', array( 'default_value' => 'The Difference' ) ),
		brewco_f( 'text', 'showcase_heading', 'Heading', array( 'default_value' => 'One integrated team,' ) ),
		brewco_f( 'text', 'showcase_heading_accent', 'Heading (copper part)', array( 'default_value' => 'start to finish' ) ),
		brewco_f( 'textarea', 'showcase_text', 'Paragraph', $ta ),
		brewco_f( 'textarea', 'showcase_list', 'Checklist', array(
			'rows'         => 4,
			'instructions' => 'One item per line.',
		) ),
		brewco_f( 'text', 'showcase_cta_label', 'Button label', array( 'default_value' => 'What We Do' ) ),
		brewco_f( 'image', 'showcase_image', 'Image', $img ),

		/* --------------------------------------------------------- STATS */
		brewco_f_tab( 'Stats' ),
		brewco_f_rep( 'stats', 'Stats', array(
			brewco_sf( 'number', 'stats', 'value', 'Number' ),
			brewco_sf( 'text', 'stats', 'suffix', 'Suffix', array( 'instructions' => 'e.g. % — leave blank for none.' ) ),
			brewco_sf( 'text', 'stats', 'label', 'Label' ),
		), array( 'layout' => 'table', 'button_label' => 'Add stat', 'max' => 4 ) ),
		brewco_f( 'text', 'stats_heading', 'Heading', array( 'default_value' => 'Experience that shows up' ) ),
		brewco_f( 'text', 'stats_heading_accent', 'Heading (copper part)', array( 'default_value' => 'where your audience is' ) ),
		brewco_f( 'textarea', 'stats_text', 'Paragraph', $ta ),

		/* ------------------------------------------------------ SERVICES */
		brewco_f_tab( 'Services' ),
		brewco_f( 'text', 'services_eyebrow', 'Eyebrow', array( 'default_value' => 'What We Do' ) ),
		brewco_f( 'text', 'services_heading', 'Heading', array( 'default_value' => 'Completely' ) ),
		brewco_f( 'text', 'services_heading_accent', 'Heading (copper part)', array( 'default_value' => 'integrated solutions' ) ),
		brewco_f_rep( 'services', 'Service cards', array(
			brewco_sf( 'text', 'services', 'title', 'Title' ),
			brewco_sf( 'textarea', 'services', 'body', 'Description', array( 'rows' => 4 ) ),
			brewco_sf( 'textarea', 'services', 'items', 'Checklist', array(
				'rows'         => 3,
				'instructions' => 'One item per line. Leave blank for no list.',
			) ),
			brewco_sf( 'image', 'services', 'image', 'Image', array(
				'return_format' => 'array',
				'preview_size'  => 'thumbnail',
				'instructions'  => 'Shown in the square beside the text. Square images crop least.',
			) ),
			brewco_sf( 'select', 'services', 'image_fit', 'Image fit', array(
				'choices'       => array(
					'fill' => 'Fill the square (photos)',
					'fit'  => 'Fit inside the square (icons, logos)',
				),
				'default_value' => 'fill',
				'instructions'  => 'Fill crops to the edges. Fit shows the whole image with space around it.',
			) ),
			brewco_sf( 'text', 'services', 'icon', 'Icon glyph (no image)', array(
				'instructions' => 'Only shown if no image is uploaded. A single character, e.g. ◇ △ ○ ✚ ▤ ◈',
				'maxlength'    => 2,
			) ),
		), array( 'button_label' => 'Add service' ) ),

		/* ----------------------------------------------------- PHOTO CTA */
		brewco_f_tab( 'Photo banner' ),
		brewco_f( 'text', 'photocta_eyebrow', 'Eyebrow', array( 'default_value' => 'North America · Europe' ) ),
		brewco_f( 'textarea', 'photocta_heading', 'Heading', array(
			'rows'         => 2,
			'instructions' => 'Line breaks here become line breaks on the page.',
		) ),
		brewco_f( 'textarea', 'photocta_text', 'Paragraph', $ta ),
		brewco_f( 'text', 'photocta_cta_label', 'Button label', array( 'default_value' => 'Get a Custom Quote' ) ),
		brewco_f( 'image', 'photocta_image', 'Background image', $img ),

		/* --------------------------------------------------------- FLEET */
		brewco_f_tab( 'Vehicles' ),
		brewco_f( 'text', 'fleet_eyebrow', 'Eyebrow', array( 'default_value' => 'Vehicles' ) ),
		brewco_f( 'text', 'fleet_heading', 'Heading', array( 'default_value' => 'Built, owned and' ) ),
		brewco_f( 'text', 'fleet_heading_accent', 'Heading (copper part)', array( 'default_value' => 'maintained in-house' ) ),
		brewco_f( 'textarea', 'fleet_sub', 'Sub-line', $ta ),
		brewco_f_rep( 'fleet_items', 'Vehicle types', array(
			brewco_sf( 'text', 'fleet', 'label', 'Label' ),
			brewco_sf( 'text', 'fleet', 'url', 'Link', array(
				'instructions' => 'Where the pill goes, e.g. /vehicles/box-trucks/ — leave blank for a plain, unlinked pill.',
			) ),
		), array( 'layout' => 'table', 'button_label' => 'Add vehicle type' ) ),

		/* --------------------------------------------------------- QUOTE */
		brewco_f_tab( 'Quote & offices' ),
		brewco_f( 'text', 'quote_eyebrow', 'Eyebrow', array( 'default_value' => 'Get Started' ) ),
		brewco_f( 'text', 'quote_heading', 'Heading', array( 'default_value' => 'Every project is' ) ),
		brewco_f( 'text', 'quote_heading_accent', 'Heading (copper part)', array( 'default_value' => 'quoted to spec' ) ),
		brewco_f( 'text', 'quote_lead_heading', 'Card heading', array( 'default_value' => 'Contact us for a no-cost consultation.' ) ),
		brewco_f( 'textarea', 'quote_lead_text', 'Card paragraph', array( 'rows' => 4 ) ),
		brewco_f( 'text', 'quote_cta_label', 'Button label', array( 'default_value' => 'Get a Custom Quote' ) ),
		brewco_f_rep( 'offices', 'Offices', array(
			brewco_sf( 'text', 'offices', 'name', 'Name', array(
				'instructions' => 'Shown on the quote card, e.g. "Headquarters".',
			) ),
			brewco_sf( 'text', 'offices', 'city', 'City label', array(
				'instructions' => 'Shown in the footer list, e.g. "Central City, KY".',
			) ),
			brewco_sf( 'textarea', 'offices', 'address', 'Address', array(
				'rows'         => 3,
				'instructions' => 'Line breaks become line breaks on the page.',
			) ),
			brewco_sf( 'text', 'offices', 'phone', 'Phone (displayed)' ),
			brewco_sf( 'text', 'offices', 'phone_link', 'Phone (dial format)', array(
				'instructions' => 'e.g. +12707542264 — used for the tel: link.',
			) ),
		), array( 'button_label' => 'Add office' ) ),

		/* ---------------------------------------------------- HOW IT WORKS */
		brewco_f_tab( 'How it works' ),
		brewco_f( 'text', 'how_eyebrow', 'Eyebrow', array( 'default_value' => 'How It Works' ) ),
		brewco_f( 'text', 'how_heading', 'Heading', array( 'default_value' => 'From first conversation' ) ),
		brewco_f( 'text', 'how_heading_accent', 'Heading (copper part)', array( 'default_value' => 'to the road' ) ),
		brewco_f_rep( 'steps', 'Steps', array(
			brewco_sf( 'text', 'steps', 'step_label', 'Step label', array( 'default_value' => 'Step 1' ) ),
			brewco_sf( 'text', 'steps', 'title', 'Title' ),
			brewco_sf( 'textarea', 'steps', 'text', 'Description', array( 'rows' => 3 ) ),
		), array( 'button_label' => 'Add step', 'max' => 3 ) ),

		/* ------------------------------------------------------- STORIES */
		brewco_f_tab( 'Partner stories' ),
		brewco_f( 'text', 'stories_eyebrow', 'Eyebrow', array( 'default_value' => 'Our Work' ) ),
		brewco_f( 'text', 'stories_heading', 'Heading', array( 'default_value' => 'The partner these brands' ) ),
		brewco_f( 'text', 'stories_heading_accent', 'Heading (copper part)', array( 'default_value' => 'trusted' ) ),
		brewco_f_rep( 'stories', 'Stories', array(
			brewco_sf( 'text', 'stories', 'brand', 'Brand' ),
			brewco_sf( 'textarea', 'stories', 'text', 'Story', array( 'rows' => 4 ) ),
		), array(
			'button_label' => 'Add story',
			'instructions' => 'The scrolling row duplicates these automatically — add each story once.',
		) ),

		/* ----------------------------------------------------- FINAL CTA */
		brewco_f_tab( 'Closing CTA' ),
		brewco_f( 'text', 'finalcta_heading', 'Heading', array( 'default_value' => 'Let’s' ) ),
		brewco_f( 'text', 'finalcta_heading_accent', 'Heading (copper part)', array( 'default_value' => 'get started' ) ),
		brewco_f( 'text', 'finalcta_text', 'Sub-line', array( 'default_value' => 'Contact us for a no-cost consultation.' ) ),
		brewco_f( 'text', 'finalcta_cta_label', 'Button label', array( 'default_value' => 'Contact Us' ) ),
		brewco_f( 'text', 'finalcta_cta_url', 'Button link', array( 'default_value' => '/contact/' ) ),

		/* -------------------------------------------------------- FOOTER */
		brewco_f_tab( 'Footer' ),
		brewco_f_rep( 'footer_features', 'Highlights', array(
			brewco_sf( 'text', 'ffeat', 'icon', 'Icon glyph', array( 'maxlength' => 2 ) ),
			brewco_sf( 'text', 'ffeat', 'title', 'Title' ),
			brewco_sf( 'text', 'ffeat', 'text', 'Sub-line' ),
		), array( 'button_label' => 'Add highlight', 'max' => 3 ) ),
		brewco_f( 'textarea', 'footer_text', 'Blurb', array( 'rows' => 3 ) ),
		brewco_f( 'text', 'footer_phone', 'Phone (displayed)', array( 'default_value' => '270-754-2264' ) ),
		brewco_f( 'text', 'footer_phone_link', 'Phone (dial format)', array( 'default_value' => '+12707542264' ) ),
		brewco_f_rep( 'footer_socials', 'Social links', array(
			brewco_sf( 'text', 'fsoc', 'label', 'Label' ),
			brewco_sf( 'url', 'fsoc', 'url', 'URL' ),
		), array( 'layout' => 'table', 'button_label' => 'Add link' ) ),
	);

	acf_add_local_field_group( array(
		'key'                   => 'group_brewco_landing',
		'title'                 => 'Brewco Landing — page content',
		'fields'                => $fields,
		'location'              => array(
			array(
				array(
					'param'    => 'page_template',
					'operator' => '==',
					'value'    => BREWCO_LANDING_SLUG,
				),
			),
		),
		'menu_order'            => 0,
		'position'              => 'normal',
		'style'                 => 'default',
		'label_placement'       => 'top',
		'active'                => true,
		'hide_on_screen'        => array( 'the_content' ),
		'description'           => 'Content for the Brewco Landing template. Any field left blank falls back to the copy the template shipped with.',
	) );
}
