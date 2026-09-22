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
 * NOTE: ACF shows and returns default_value only while a field has no stored
 * value (checked on production, ACF 6.8.10). A field that has been saved blank
 * stays blank, which is why every getter in helpers.php also carries the
 * shipped copy as an inline fallback.
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
	/* Button link fields. Plain text rather than ACF's URL type, which rejects the
	   in-page anchors (#contact) and root-relative paths (/contact/) these use.
	   The default shows in the editor until the field is first saved. */
	$link = function ( $default ) {
		return array(
			'default_value' => $default,
			'instructions'  => 'Where the button goes: a section of this page (#contact, #faq, #services, #our-work, #fleet, #approach), a page on this site (e.g. /contact/), or a full URL. Left blank, it goes to ' . $default . '.',
		);
	};

	$fields = array(

		/* -------------------------------------------------------- HEADER */
		brewco_f_tab( 'Header' ),
		brewco_f( 'text', 'nav_cta_label', 'Button label', array(
			'default_value' => 'Get a Custom Quote',
			'instructions'  => 'The button at the right of the top menu, also shown in the mobile menu.',
		) ),
		brewco_f( 'text', 'nav_cta_url', 'Button link', $link( '#contact' ) ),

		/* ---------------------------------------------------------- HERO */
		brewco_f_tab( 'Hero' ),
		brewco_f( 'textarea', 'hero_headline', 'Headline', array(
			'rows'         => 2,
			'default_value' => 'The Marketing Vehicle for the World’s Most Trusted Brands',
			'instructions' => 'Line breaks here become line breaks on the page.',
		) ),
		brewco_f( 'text', 'hero_cta_label', 'Button label', array( 'default_value' => 'Get a Custom Quote' ) ),
		brewco_f( 'text', 'hero_cta_url', 'Button link', $link( '#contact' ) ),
		brewco_f( 'text', 'hero_link_label', 'Secondary link label', array( 'default_value' => 'See our work' ) ),
		brewco_f( 'text', 'hero_link_url', 'Secondary link', $link( '#work' ) ),
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
		brewco_f( 'file', 'hero_video', 'Background video', array(
			'return_format' => 'array',
			'mime_types'    => 'mp4',
			'instructions'  => 'Optional. An MP4 here plays silently on a loop in place of the slideshow; remove it to bring the slideshow back. Keep it short and light — under 15 MB, 720p or 1080p. Sound in the file is never played.',
		) ),
		brewco_f( 'image', 'hero_video_poster', 'Video still (optional)', array_merge( $img, array(
			'instructions' => 'Shown while the video loads, if a phone blocks autoplay, and instead of the video for visitors who have reduced motion turned on. Leave empty to use the first slideshow image. A frame from the video avoids a jump when it starts.',
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
		brewco_f( 'text', 'showcase_cta_url', 'Button link', $link( '#services' ) ),
		brewco_f( 'image', 'showcase_image', 'Image', $img ),

		/* --------------------------------------------------------- STATS */
		brewco_f_tab( 'Stats' ),
		brewco_f( 'text', 'stats_heading', 'Heading', array( 'default_value' => 'Experience that shows up' ) ),
		brewco_f( 'text', 'stats_heading_accent', 'Heading (copper part)', array( 'default_value' => 'where your audience is' ) ),
		brewco_f( 'textarea', 'stats_text', 'Paragraph', $ta ),
		brewco_f_rep( 'stats', 'Stats', array(
			brewco_sf( 'number', 'stats', 'value', 'Number' ),
			brewco_sf( 'text', 'stats', 'suffix', 'Suffix', array( 'instructions' => 'e.g. % — leave blank for none.' ) ),
			brewco_sf( 'text', 'stats', 'label', 'Label' ),
		), array( 'layout' => 'table', 'button_label' => 'Add stat', 'max' => 4 ) ),

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
			brewco_sf( 'text', 'services', 'cta_label', 'Button label', array(
				'default_value' => 'Learn More',
				'instructions'  => 'Left blank, it reads Learn More.',
			) ),
			brewco_sf( 'text', 'services', 'cta_url', 'Button link', array(
				'instructions' => 'Where the button goes: a page on this site (e.g. /what-we-do/experiential/), a section of this page (#contact) or a full URL. Left blank, the six original services go to their own page under /what-we-do/; any other card shows no button.',
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
		brewco_f( 'text', 'photocta_cta_url', 'Button link', $link( '#contact' ) ),
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
		brewco_f( 'text', 'quote_cta_label', 'Button label', array( 'default_value' => 'Get a Custom Quote' ) ),
		// Kept under its original name (it used to sit in the removed Closing CTA tab)
		// so a link already saved there carries over. The footer's Contact Us uses it too.
		brewco_f( 'text', 'finalcta_cta_url', 'Button link', array(
			'default_value' => '/contact/',
			'instructions'  => 'Where this section’s Get a Custom Quote button goes, e.g. /contact/. The footer’s Contact Us link uses it too.',
		) ),
		// The page no longer shows the addresses; the footer's Offices column lists these.
		brewco_f_rep( 'offices', 'Offices', array(
			brewco_sf( 'text', 'offices', 'name', 'Name', array(
				'instructions' => 'e.g. "Headquarters". Shown in the footer when City label is blank.',
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

		/* ------------------------------------------------------- STORIES */
		brewco_f_tab( 'Partner stories' ),
		brewco_f( 'text', 'stories_eyebrow', 'Eyebrow', array( 'default_value' => 'Our Work' ) ),
		brewco_f( 'text', 'stories_heading', 'Heading', array( 'default_value' => 'The partner these brands' ) ),
		brewco_f( 'text', 'stories_heading_accent', 'Heading (copper part)', array( 'default_value' => 'trusted' ) ),
		brewco_f( 'text', 'stories_link_label', 'Link label', array(
			'default_value' => 'See the work',
			'instructions'  => 'Shown on every slide that has a link, followed by an arrow.',
		) ),
		brewco_f_rep( 'stories', 'Stories', array(
			brewco_sf( 'image', 'stories', 'image', 'Photo', array(
				'return_format' => 'array',
				'preview_size'  => 'medium',
				'instructions'  => 'The large background photo. Leave empty to use the featured image of the Brewco page this story links to. Landscape, at least 1600px wide.',
			) ),
			brewco_sf( 'text', 'stories', 'brand', 'Client / title', array(
				'instructions' => 'The large title on the slide, e.g. “IBM”.',
			) ),
			brewco_sf( 'textarea', 'stories', 'text', 'Blurb', array(
				'rows'         => 4,
				'instructions' => 'Two or three sentences shown over the photo.',
			) ),
			brewco_sf( 'text', 'stories', 'url', 'Link', array(
				'instructions' => 'The case study page, e.g. /work/ibm/. Leave blank for a slide with no link.',
			) ),
			brewco_sf( 'image', 'stories', 'logo', 'Logo (optional)', array(
				'return_format' => 'array',
				'preview_size'  => 'thumbnail',
				'instructions'  => 'Shown in a small white badge above the title.',
			) ),
		), array(
			'button_label' => 'Add story',
			'instructions' => 'Each story is one slide in the Our Work carousel. Drag rows to reorder.',
		) ),
		brewco_f( 'text', 'stories_more_label', 'More work button label', array( 'default_value' => 'View More Work' ) ),
		brewco_f( 'text', 'stories_more_url', 'More work button link', $link( '/our-work/' ) ),

		/* ----------------------------------------------------------- FAQ */
		brewco_f_tab( 'FAQ' ),
		brewco_f( 'text', 'faq_eyebrow', 'Eyebrow', array( 'default_value' => 'FAQ' ) ),
		brewco_f( 'text', 'faq_heading', 'Heading', array( 'default_value' => 'Frequently asked' ) ),
		brewco_f( 'text', 'faq_heading_accent', 'Heading (copper part)', array( 'default_value' => 'questions' ) ),
		brewco_f_rep( 'faqs', 'Questions', array(
			brewco_sf( 'text', 'faqs', 'question', 'Question', array(
				'instructions' => 'Phrase it the way someone would ask it, and name the company, e.g. “Is Brewco Marketing Group employee-owned?”',
			) ),
			brewco_sf( 'textarea', 'faqs', 'answer', 'Answer', array(
				'rows'         => 4,
				'instructions' => 'A complete answer that makes sense on its own. Plain text; line breaks become line breaks. It is also published as FAQ structured data for search engines and AI assistants, so keep it factual.',
			) ),
		), array(
			'button_label' => 'Add question',
			'instructions' => 'Adding even one question replaces all of the built-in questions, so enter the full set. A question without an answer (or the reverse) is skipped.',
		) ),

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
