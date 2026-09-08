<?php
/**
 * Full-page landing template. Loaded by the plugin (template_include) when a
 * page selects the "Brewco Landing" template. Standalone document — the template
 * ships its own navbar/footer, so it deliberately does NOT call the theme
 * header/footer. wp_head()/wp_footer() remain so enqueued assets + plugins load.
 */
if ( ! defined( 'ABSPATH' ) ) { exit; }

// Base URL for this plugin's assets, used by the markup partial below.
$A = esc_url( BREWCO_LANDING_URL . 'assets/' );
?>
<!doctype html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<!-- This landing page is designed light-only. Tell browsers + dark-mode tools
	     not to force-dark it (which was inverting the transparent logo to white). -->
	<meta name="color-scheme" content="light">
	<meta name="darkreader-lock">
	<?php wp_head(); ?>
</head>
<body <?php body_class( 'brewco-landing-page' ); ?>>
<?php include BREWCO_LANDING_DIR . 'template-parts/landing.php'; ?>
<?php wp_footer(); ?>
</body>
</html>
