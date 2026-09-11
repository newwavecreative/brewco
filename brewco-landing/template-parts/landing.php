<?php
/**
 * Landing page markup — section order mirrors the reference (quad.medvi.org):
 *   nav · hero · logos · statement · integrated · stats · services ·
 *   photo CTA · fleet · quote · process · partner stories · CTA · footer
 *
 * Included by templates/landing-template.php, which defines $A = plugin assets base URL.
 * Animation hooks: data-reveal | data-reveal-delay | data-parallax | data-rotate | data-count | data-flip
 *
 * CONTENT: driven by the ACF field group in inc/fields.php, via the accessors in
 * inc/helpers.php. Every getter carries the shipped copy as its fallback, so an
 * empty field (or ACF being deactivated) renders the original page rather than a
 * blank one. Edit copy in the page editor; edit the fallbacks here.
 *
 * COPY SOURCE: the fallbacks below are drawn from brewco.com (Sept 2026) — the
 * "Who We Are", "What We Do", "Vehicles" and "Contact" pages. Nothing is invented.
 * Open questions are marked `CONFIRM:` — grep for it.
 *
 * OUTSTANDING: imagery. The image fields fall back to assets/img/placeholder.svg.
 * Upload real Brewco photography to the hero, showcase and photo-banner fields.
 */
if ( ! defined( 'ABSPATH' ) ) { exit; }
if ( ! isset( $A ) ) { $A = ''; }

/* Repeater fallbacks — the content the template shipped with. */
$fb_clients = array(
	array( 'name' => 'McDonald’s' ), array( 'name' => 'IBM' ),
	array( 'name' => 'General Motors' ), array( 'name' => 'LG' ),
	array( 'name' => 'KOHLER' ), array( 'name' => 'Compassion International' ),
	array( 'name' => 'TCS New York City Marathon' ),
);
$fb_stats = array(
	array( 'value' => 25,  'suffix' => '',  'label' => 'Years in Business' ),
	array( 'value' => 100, 'suffix' => '%', 'label' => 'Employee-Owned' ),
	array( 'value' => 4,   'suffix' => '',  'label' => 'Offices, US & UK' ),
);
$fb_services = array(
	array(
		'title' => 'Experiential Marketing',
		'body'  => 'Brewco Marketing Group immerses customers in face-to-face interactions and experiences that educate and entertain. Let us transform your marketing mix with innovative experiential marketing strategies and efficient implementation.',
		'items' => "Mobile marketing tours and pop-up retail\nRetail activation and product sampling\nMobile training, command centers and STEM education",
		'icon'  => '◇',
	),
	array(
		'title' => 'Sponsorship Negotiation & Activation',
		'body'  => 'Negotiating and activating event sponsorships is a complex process. Brewco Marketing Group utilizes years of expertise and relationships to seamlessly coordinate sponsorship opportunities.',
		'items' => "Identifying the right events\nNegotiating partnerships and display space\nExecuting on-site customer engagement",
		'icon'  => '△',
	),
	array(
		'title' => 'Design & Fabrication',
		'body'  => 'A completely integrated company that removes the hassle and costs associated with 3rd-party vendors. We have an experienced team ready to bring your project to life, from first drawing to finished asset.',
		'items' => "In-house design and fabrication\nElectrical and HVAC\nMaintenance and support staff",
		'icon'  => '○',
	),
	array(
		'title' => 'Brewco Health',
		'body'  => 'Mobile health solutions that directly contribute to increased medical access for underserved populations or communities in crisis. Working one-on-one with regional healthcare systems and emergency management departments, Brewco Health develops and builds mobile solutions to enhance medical services where they are needed the most.',
		'items' => '',
		'icon'  => '✚',
	),
	array(
		'title' => 'Brewco Staging',
		'body'  => 'Brewco Staging fulfills the need for mobile stages at both entertainment and corporate events. Based on the quality of our mobile stage inventory and a reputation for well-done event execution, Brewco Staging is proud to provide various mobile staging options.',
		'items' => '',
		'icon'  => '▤',
	),
	array(
		'title' => 'Brewco Hospitality',
		'body'  => 'Mobile hospitality assets for short-term or long-term lease. From VIP experiences to employee appreciation perks, Brewco Hospitality offers mobile assets featuring viewing decks, TVs, lounging furniture, private bathrooms, dining tables and more.',
		'items' => '',
		'icon'  => '◈',
	),
);
/* URLs are brewco.com's own vehicle pages (all verified 200, 2026-09-11).
   Root-relative, since the landing page lives on the same WordPress install. */
$fb_fleet = array(
	array( 'label' => 'Box Trucks',                  'url' => '/vehicles/box-trucks/' ),
	array( 'label' => 'Bumper Pull Trailers',        'url' => '/vehicles/bumper-pull-trailers/' ),
	array( 'label' => 'Custom Buses',                'url' => '/vehicles/custom-buses/' ),
	array( 'label' => 'Custom Containers',           'url' => '/vehicles/custom-containers/' ),
	array( 'label' => 'Expandable Trailers',         'url' => '/vehicles/expandable-trailers/' ),
	array( 'label' => 'Gooseneck Trailers',          'url' => '/vehicles/gooseneck-trailers/' ),
	array( 'label' => 'Mobile Hospitality Trailers', 'url' => '/vehicles/mobile-hospitality-trailers/' ),
	array( 'label' => 'Mobile Kitchens',             'url' => '/vehicles/mobile-kitchens/' ),
	array( 'label' => 'Mobile Stages',               'url' => '/vehicles/mobile-stages/' ),
	array( 'label' => 'Sprinter Vans',               'url' => '/vehicles/sprinter-vans/' ),
);
$fb_offices = array(
	array( 'name' => 'Headquarters',    'city' => 'Central City, KY',    'address' => "106 Brewer Drive\nCentral City, KY 42330",              'phone' => '270-754-2264',    'phone_link' => '+12707542264' ),
	array( 'name' => 'Nashville, TN',   'city' => 'Nashville, TN',   'address' => "1 Vantage Way\nNashville, TN 37228",                    'phone' => '615-496-5264',    'phone_link' => '+16154965264' ),
	array( 'name' => 'Charlotte, NC',   'city' => 'Charlotte, NC',   'address' => "4107 Rose Lake Drive, Suite G\nCharlotte, NC 28217",    'phone' => '980-201-9048',    'phone_link' => '+19802019048' ),
	array( 'name' => 'London, England', 'city' => 'London, England', 'address' => "16 Great Queen Street\nCovent Garden, London WC2B 5AH", 'phone' => '+44 203 600 1025', 'phone_link' => '+442036001025' ),
);
$fb_steps = array(
	array( 'step_label' => 'Step 1', 'title' => 'Consult',            'text' => 'We start with a no-cost consultation: your goals, your audience, and where the program needs to go. Our team scopes the asset and the tour around that.' ),
	array( 'step_label' => 'Step 2', 'title' => 'Design & Fabricate', 'text' => 'Our in-house designers, fabricators, electricians and HVAC experts build the asset under one roof.' ),
	array( 'step_label' => 'Step 3', 'title' => 'Tour & Manage',      'text' => 'We manage the program on the road — staffing, logistics, maintenance and storage.' ),
);
$fb_stories = array(
	array( 'brand' => 'IBM',                                   'text' => 'Fabricated and managed a mobile Cyber Tactical Operations Center and launched a tour in the United States. All assets were subsequently shipped to Europe for an ongoing mobile tour consisting of 3 assets and a large touring staff.' ),
	array( 'brand' => 'McDonald’s',                            'text' => 'Builds and manages the fleet of McDonald’s Mobile Restaurants that activate throughout the United States — the 53’ McRig, 35’ Snack Truck, 14’ McCafe and two food trucks.' ),
	array( 'brand' => 'PSEG Long Island',                      'text' => 'Fabricated and managed the first-ever mobile experience powered by solar. “My Smart Energy Lab” was self-sufficient and capable of 10 hours of solar-powered runtime per activation.' ),
	array( 'brand' => 'Major League Baseball',                 'text' => 'Took 52 artifacts from the National Baseball Hall of Fame and Museum on the road for the “We Are Baseball” mobile experience — 14 trailers, 2 mobile stages and the first mobile IMAX theater.' ),
	array( 'brand' => 'Texas Division of Emergency Management','text' => 'Trusted during a pandemic to fabricate and deliver 4 mobile medical ICUs that can function independently or together as a field hospital.' ),
);
$fb_ffeat = array(
	array( 'icon' => '◈', 'title' => '100% Employee-Owned', 'text' => 'Every owner has a stake in the outcome' ),
	array( 'icon' => '✦', 'title' => 'In-House Fabrication', 'text' => 'Design, build, electrical and HVAC under one roof' ),
	array( 'icon' => '✔', 'title' => '25 Years',             'text' => 'Award-winning mobile programs' ),
);
$fb_socials = array(
	array( 'label' => 'Facebook',  'url' => 'https://www.facebook.com/BrewcoMarketing' ),
	array( 'label' => 'Instagram', 'url' => 'https://www.instagram.com/brewcomarketing/' ),
	array( 'label' => 'LinkedIn',  'url' => 'https://www.linkedin.com/company/brewco-marketing-group' ),
	array( 'label' => 'YouTube',   'url' => 'https://www.youtube.com/channel/UCaOpa5GiN22P3HCwk1gkMuw' ),
	array( 'label' => 'X',         'url' => 'https://twitter.com/brewcomarketing' ),
);

$clients = brewco_rows( 'logobar_clients', $fb_clients, array( 'name', 'logo' ) );
$stories = brewco_rows( 'stories', $fb_stories, array( 'brand', 'text' ) );
?>
<!-- SECTION 01 — NAVBAR (labels are structural, kept in the template) -->
<header class="nav" id="nav" data-nav>
  <div class="nav__inner brewco-container">
    <a class="nav__logo" href="#top" aria-label="Brewco Marketing Group home">
      <img class="nav__logo-img nav__logo-img--light" src="<?php echo brewco_landing_asset( 'logo-white.png' ); ?>" alt="Brewco Marketing Group">
      <img class="nav__logo-img nav__logo-img--dark" src="<?php echo brewco_landing_asset( 'logo.png' ); ?>" alt="Brewco Marketing Group">
    </a>
    <nav class="nav__links" aria-label="Primary">
      <a href="#approach">Who We Are</a>
      <a href="#services">What We Do</a>
      <a href="#work">Our Work</a>
      <a href="#fleet">Vehicles</a>
    </nav>
    <a href="#contact" class="btn btn--cta nav__cta"><?php echo brewco_t( 'hero_cta_label', 'Get a Custom Quote' ); ?></a>
    <button class="nav__burger" aria-label="Open menu" aria-expanded="false" data-menu-toggle>
      <span></span><span></span><span></span>
    </button>
  </div>
  <div class="nav__mobile" data-mobile-menu>
    <a href="#approach">Who We Are</a>
    <a href="#services">What We Do</a>
    <a href="#work">Our Work</a>
    <a href="#fleet">Vehicles</a>
    <a href="#contact" class="btn btn--cta"><?php echo brewco_t( 'hero_cta_label', 'Get a Custom Quote' ); ?></a>
  </div>
</header>

<main id="top">

<!-- SECTION 02 — HERO -->
<section class="hero" id="hero">
  <?php
  /* Slideshow, falling back to the single legacy image field, then the placeholder.
     Each slide is stacked and cross-faded by main.js; the first ships with
     .is-active so the hero still renders with JS disabled. */
  $hero_slides = brewco_gallery_urls( 'hero_slides' );
  if ( ! $hero_slides ) {
      $hero_slides = array( brewco_image_url( 'hero_image', 'img/placeholder.svg' ) );
  }
  $hero_secs = (float) brewco_field( 'hero_slide_seconds', 6 );
  ?>
  <div class="hero__bg" data-slide-seconds="<?php echo esc_attr( $hero_secs ); ?>">
    <?php foreach ( $hero_slides as $i => $slide_url ) : ?>
      <img class="hero__slide<?php echo 0 === $i ? ' is-active' : ''; ?>"
           src="<?php echo $slide_url; /* already escaped by the helper */ ?>"
           alt="" aria-hidden="true"
           <?php echo 0 === $i ? 'fetchpriority="high"' : 'loading="lazy" decoding="async"'; ?>>
    <?php endforeach; ?>
    <div class="hero__overlay"></div>
  </div>
  <div class="brewco-container hero__grid">
    <div class="hero__left">
      <h1 class="hero__title" data-reveal data-reveal-delay="80"><?php echo brewco_t_br( 'hero_headline', 'The Marketing Vehicle for the World’s Most Trusted Brands' ); ?></h1>
    </div>
    <div class="hero__right" data-reveal data-reveal-delay="180">
      <p class="hero__sub"><?php echo brewco_t( 'hero_sub', 'Brewco Marketing Group is a 100% employee-owned company dedicated to designing, fabricating, and managing custom experiences for our partners. For 25 years, we have created award-winning solutions that engage audiences where they work, live and play.' ); ?></p>
      <div class="hero__actions">
        <a href="#contact" class="btn btn--cta btn--lg"><?php echo brewco_t( 'hero_cta_label', 'Get a Custom Quote' ); ?></a>
        <a href="#work" class="hero__link"><?php echo brewco_t( 'hero_link_label', 'See our work' ); ?> &rarr;</a>
      </div>
    </div>
  </div>
  <a href="#work" class="hero__cue" aria-label="Scroll down"></a>
</section>

<!-- SECTION 03 — LOGO BAR (marquee)
     The track is emitted twice so the loop is seamless — add each client once. -->
<section class="logobar" id="work">
  <div class="brewco-container">
    <p class="logobar__label" data-reveal><?php echo brewco_t( 'logobar_label', 'Trusted by the brands we build for' ); ?></p>
    <?php /* data-speed = constant scroll rate in px/s, so the pace is the same
             however many clients are listed (main.js sets the duration). */ ?>
    <div class="marquee" data-marquee data-speed="66">
      <div class="marquee__track">
        <?php for ( $pass = 0; $pass < 2; $pass++ ) : ?>
          <?php foreach ( $clients as $c ) : ?>
            <?php
            $cname = (string) brewco_row( $c, 'name' );
            $clogo = brewco_image_data( is_array( $c ) && isset( $c['logo'] ) ? $c['logo'] : null );
            ?>
            <?php if ( $clogo ) : ?>
              <?php /* The second pass is a visual duplicate for the loop: hidden
                       from screen readers, so each logo is announced once. */ ?>
              <span class="logobar__item"<?php echo $pass ? ' aria-hidden="true"' : ''; ?>><img class="logobar__img" src="<?php echo $clogo['url']; ?>"<?php echo brewco_img_dims( $clogo ); ?> alt="<?php echo $pass ? '' : esc_attr( '' !== $cname ? $cname : $clogo['alt'] ); ?>" loading="lazy" decoding="async"></span>
            <?php elseif ( '' !== $cname ) : ?>
              <span class="logobar__logo"<?php echo $pass ? ' aria-hidden="true"' : ''; ?>><?php echo esc_html( $cname ); ?></span>
            <?php endif; ?>
          <?php endforeach; ?>
        <?php endfor; ?>
      </div>
    </div>
  </div>
</section>

<!-- SECTION 04 — STATEMENT -->
<section class="about" id="approach">
  <span class="section-watermark" aria-hidden="true">Who We Are</span>
  <div class="brewco-container about__inner">
    <span class="eyebrow" data-reveal><?php echo brewco_t( 'about_eyebrow', 'Who We Are' ); ?></span>
    <h2 class="about__title" data-reveal data-reveal-delay="80">
      <?php echo brewco_heading( 'about_heading', 'Award-Winning', 'about_heading_accent', 'Experiential Brand Strategy' ); ?>
    </h2>
    <p class="about__text" data-reveal data-reveal-delay="160">
      <?php echo brewco_t( 'about_text', 'Brewco Marketing Group is a 100% employee-owned company that is dedicated to producing excellent mobile experiences. For 25 years, we have created memorable mobile programs to engage audiences where they work, live and play.' ); ?>
    </p>
  </div>
</section>

<!-- SECTION 05 — INTEGRATED TEAM -->
<section class="showcase">
  <span class="section-watermark" aria-hidden="true">Integrated</span>
  <div class="brewco-container showcase__grid">
    <div class="showcase__stage" data-reveal>
      <div class="showcase__card" data-rotate>
        <img src="<?php echo brewco_image_url( 'showcase_image', 'img/placeholder.svg' ); ?>" alt="">
      </div>
    </div>
    <div class="showcase__body" data-reveal data-reveal-delay="140">
      <span class="eyebrow"><?php echo brewco_t( 'showcase_eyebrow', 'The Difference' ); ?></span>
      <h2><?php echo brewco_heading( 'showcase_heading', 'One integrated team,', 'showcase_heading_accent', 'start to finish' ); ?></h2>
      <p><?php echo brewco_t( 'showcase_text', 'Brewco Marketing Group is a completely integrated company that removes the hassle and costs associated with 3rd-party vendors. We have an experienced team ready to bring your project to life.' ); ?></p>
      <ul class="checklist">
        <?php foreach ( brewco_lines( 'showcase_list', array( 'In-house designer and fabricators', 'Electricians and HVAC experts', 'Maintenance technicians and support staff' ) ) as $item ) : ?>
          <li><?php echo esc_html( $item ); ?></li>
        <?php endforeach; ?>
      </ul>
      <a href="#services" class="btn btn--dark"><?php echo brewco_t( 'showcase_cta_label', 'What We Do' ); ?></a>
    </div>
  </div>
</section>

<!-- SECTION 06 — STATS -->
<section class="stats">
  <div class="brewco-container">
    <div class="stats__grid">
      <?php $i = 0; foreach ( brewco_rows( 'stats', $fb_stats, array( 'label', 'value' ) ) as $stat ) : ?>
        <div class="stat" data-reveal<?php echo $i ? ' data-reveal-delay="' . ( 100 * $i ) . '"' : ''; ?>>
          <div class="stat__num"><span data-count="<?php echo esc_attr( brewco_row( $stat, 'value', 0 ) ); ?>">0</span><?php echo esc_html( brewco_row( $stat, 'suffix' ) ); ?></div>
          <div class="stat__label"><?php echo esc_html( brewco_row( $stat, 'label' ) ); ?></div>
        </div>
      <?php $i++; endforeach; ?>
    </div>
    <div class="stats__headline" data-reveal>
      <h2><?php echo brewco_heading( 'stats_heading', 'Experience that shows up', 'stats_heading_accent', 'where your audience is' ); ?></h2>
      <p><?php echo brewco_t( 'stats_text', 'Our team of experiential marketing experts have logged millions of miles and executed thousands of event days across North America and Europe.' ); ?></p>
    </div>
  </div>
</section>

<!-- SECTION 07 — SERVICES -->
<section class="features" id="services">
  <span class="section-watermark" aria-hidden="true">Services</span>
  <div class="brewco-container">
    <div class="section-head" data-reveal>
      <span class="eyebrow"><?php echo brewco_t( 'services_eyebrow', 'What We Do' ); ?></span>
      <h2><?php echo brewco_heading( 'services_heading', 'Completely', 'services_heading_accent', 'integrated solutions' ); ?></h2>
    </div>
    <div class="feature-list">
      <?php $i = 0; foreach ( brewco_rows( 'services', $fb_services, array( 'title', 'body', 'image' ) ) as $svc ) : ?>
        <?php
        $delay = ( $i % 3 ) * 80;
        $items = array_filter( array_map( 'trim', preg_split( '/\r\n|\r|\n/', (string) brewco_row( $svc, 'items' ) ) ), 'strlen' );
        ?>
        <article class="featurecard" data-reveal<?php echo $delay ? ' data-reveal-delay="' . (int) $delay . '"' : ''; ?>>
          <div class="featurecard__body">
            <h3><?php echo esc_html( brewco_row( $svc, 'title' ) ); ?></h3>
            <p><?php echo esc_html( brewco_row( $svc, 'body' ) ); ?></p>
            <?php if ( $items ) : ?>
              <ul class="checklist">
                <?php foreach ( $items as $item ) : ?>
                  <li><?php echo esc_html( $item ); ?></li>
                <?php endforeach; ?>
              </ul>
            <?php endif; ?>
          </div>
          <?php $simg = brewco_image_data( is_array( $svc ) && isset( $svc['image'] ) ? $svc['image'] : null ); ?>
          <?php if ( $simg ) : ?>
            <?php $sfit = 'fit' === brewco_row( $svc, 'image_fit', 'fill' ) ? 'fit' : 'fill'; ?>
            <div class="featurecard__icon featurecard__icon--img featurecard__icon--<?php echo $sfit; ?>">
              <img src="<?php echo $simg['url']; ?>"<?php echo brewco_img_dims( $simg ); ?> alt="<?php echo esc_attr( $simg['alt'] ); ?>" loading="lazy" decoding="async">
            </div>
          <?php else : ?>
            <div class="featurecard__icon" aria-hidden="true"><?php echo esc_html( brewco_row( $svc, 'icon', '◇' ) ); ?></div>
          <?php endif; ?>
        </article>
      <?php $i++; endforeach; ?>
    </div>
  </div>
</section>

<!-- SECTION 08 — PHOTO CTA -->
<section class="photocta">
  <div class="photocta__bg" data-parallax="0.08">
    <img src="<?php echo brewco_image_url( 'photocta_image', 'img/placeholder.svg' ); ?>" alt="" aria-hidden="true">
    <div class="photocta__overlay"></div>
  </div>
  <div class="brewco-container photocta__content" data-reveal>
    <span class="eyebrow eyebrow--light"><?php echo brewco_t( 'photocta_eyebrow', 'North America · Europe' ); ?></span>
    <h2><?php echo brewco_t_br( 'photocta_heading', "Millions of miles.\nThousands of event days." ); ?></h2>
    <p><?php echo brewco_t( 'photocta_text', 'Our team executes thousands of event days annually across North America and Europe.' ); ?></p>
    <a href="#contact" class="btn btn--cta btn--lg"><?php echo brewco_t( 'photocta_cta_label', 'Get a Custom Quote' ); ?></a>
  </div>
</section>

<!-- SECTION 09 — FLEET
     Replaces the template's "us vs. them" line chart, which plotted an
     unlabelled "results over time" trend with no data behind it. -->
<section class="fleet" id="fleet">
  <div class="brewco-container">
    <div class="section-head" data-reveal>
      <span class="eyebrow"><?php echo brewco_t( 'fleet_eyebrow', 'Vehicles' ); ?></span>
      <h2><?php echo brewco_heading( 'fleet_heading', 'Built, owned and', 'fleet_heading_accent', 'maintained in-house' ); ?></h2>
      <p class="section-head__sub"><?php echo brewco_t( 'fleet_sub', 'Every asset below is designed, fabricated and managed by our own team — no third-party vendors between you and the build.' ); ?></p>
    </div>
    <ul class="taggrid" data-reveal>
      <?php foreach ( brewco_rows( 'fleet_items', $fb_fleet, array( 'label' ) ) as $v ) : ?>
        <?php
        $vlabel = (string) brewco_row( $v, 'label' );
        // Escape first, then decide: esc_url() returns '' for an unsafe or
        // malformed URL (e.g. javascript:), which should become a plain pill
        // rather than a link with an empty href that just reloads the page.
        $vurl = esc_url( trim( (string) brewco_row( $v, 'url' ) ) );
        ?>
        <li>
          <?php if ( '' !== $vurl ) : ?>
            <a class="tag" href="<?php echo $vurl; ?>"><?php echo esc_html( $vlabel ); ?></a>
          <?php else : ?>
            <span class="tag"><?php echo esc_html( $vlabel ); ?></span>
          <?php endif; ?>
        </li>
      <?php endforeach; ?>
    </ul>
  </div>
</section>

<!-- SECTION 10 — QUOTE / CONTACT
     Replaces the template's $114/mo pricing card; Brewco quotes to spec. -->
<section class="quote" id="quote">
  <div class="brewco-container">
    <div class="section-head" data-reveal>
      <span class="eyebrow"><?php echo brewco_t( 'quote_eyebrow', 'Get Started' ); ?></span>
      <h2><?php echo brewco_heading( 'quote_heading', 'Every project is', 'quote_heading_accent', 'quoted to spec' ); ?></h2>
    </div>
    <div class="quotecard" data-reveal>
      <div class="quotecard__lead">
        <h3><?php echo brewco_t( 'quote_lead_heading', 'Contact us for a no-cost consultation.' ); ?></h3>
        <p><?php echo brewco_t( 'quote_lead_text', 'Tell us what you are trying to accomplish and where you need to be. We will scope the asset, the build and the tour, and come back with a custom quote.' ); ?></p>
        <a href="#contact" class="btn btn--cta btn--lg"><?php echo brewco_t( 'quote_cta_label', 'Get a Custom Quote' ); ?></a>
      </div>
      <ul class="quotecard__locations">
        <?php foreach ( brewco_rows( 'offices', $fb_offices, array( 'name', 'city', 'address', 'phone' ) ) as $o ) : ?>
          <li>
            <strong><?php echo esc_html( brewco_row( $o, 'name' ) ); ?></strong>
            <span><?php echo nl2br( esc_html( brewco_row( $o, 'address' ) ), false ); ?></span>
            <?php $tel = brewco_row( $o, 'phone_link' ); $ph = brewco_row( $o, 'phone' ); ?>
            <?php if ( $ph ) : ?>
              <a href="tel:<?php echo esc_attr( $tel ? $tel : preg_replace( '/[^0-9+]/', '', $ph ) ); ?>"><?php echo esc_html( $ph ); ?></a>
            <?php endif; ?>
          </li>
        <?php endforeach; ?>
      </ul>
    </div>
  </div>
</section>

<!-- SECTION 11 — HOW IT WORKS -->
<section class="how" id="how">
  <div class="brewco-container">
    <div class="section-head" data-reveal>
      <span class="eyebrow"><?php echo brewco_t( 'how_eyebrow', 'How It Works' ); ?></span>
      <h2><?php echo brewco_heading( 'how_heading', 'From first conversation', 'how_heading_accent', 'to the road' ); ?></h2>
    </div>
    <div class="bento">
      <?php $i = 0; foreach ( brewco_rows( 'steps', $fb_steps, array( 'title', 'text' ) ) as $step ) : ?>
        <div class="bento__cell<?php echo 0 === $i ? ' bento__cell--lg' : ''; ?>" data-reveal<?php echo $i ? ' data-reveal-delay="' . ( 100 * $i ) . '"' : ''; ?>>
          <span class="bento__step"><?php echo esc_html( brewco_row( $step, 'step_label', 'Step ' . ( $i + 1 ) ) ); ?></span>
          <div class="bento__glow"></div>
          <h3><?php echo esc_html( brewco_row( $step, 'title' ) ); ?></h3>
          <p><?php echo esc_html( brewco_row( $step, 'text' ) ); ?></p>
        </div>
      <?php $i++; endforeach; ?>
    </div>
  </div>
</section>

<!-- SECTION 12 — PARTNER STORIES (marquee)
     Replaces the template's testimonial marquee — no real testimonials exist and
     invented quotes attributed to named people are not an option. These are
     brewco.com's own words from "Who We Are". The track is emitted twice for the
     seamless loop, so each story is authored once. -->
<section class="stories">
  <div class="brewco-container">
    <div class="section-head" data-reveal>
      <span class="eyebrow"><?php echo brewco_t( 'stories_eyebrow', 'Our Work' ); ?></span>
      <h2><?php echo brewco_heading( 'stories_heading', 'The partner these brands', 'stories_heading_accent', 'trusted' ); ?></h2>
    </div>
  </div>
  <div class="marquee marquee--cards" data-marquee data-reveal>
    <div class="marquee__track">
      <?php for ( $pass = 0; $pass < 2; $pass++ ) : ?>
        <?php foreach ( $stories as $st ) : ?>
          <figure class="story"<?php echo $pass ? ' aria-hidden="true"' : ''; ?>>
            <h3 class="story__brand"><?php echo esc_html( brewco_row( $st, 'brand' ) ); ?></h3>
            <blockquote><?php echo esc_html( brewco_row( $st, 'text' ) ); ?></blockquote>
          </figure>
        <?php endforeach; ?>
      <?php endfor; ?>
    </div>
  </div>
</section>

</main>

<!-- SECTION 13 — FINAL CTA -->
<section class="finalcta" id="contact">
  <div class="brewco-container finalcta__inner" data-reveal>
    <h2><?php echo brewco_heading( 'finalcta_heading', 'Let’s', 'finalcta_heading_accent', 'get started' ); ?>.</h2>
    <p><?php echo brewco_t( 'finalcta_text', 'Contact us for a no-cost consultation.' ); ?></p>
    <!-- CONFIRM: the default link is /contact/ — set the Button link field if the
         final URL differs. -->
    <a href="<?php echo esc_url( brewco_field( 'finalcta_cta_url', '/contact/' ) ); ?>" class="btn btn--cta btn--lg"><?php echo brewco_t( 'finalcta_cta_label', 'Contact Us' ); ?></a>
  </div>
</section>

<!-- SECTION 14 — FOOTER (nav columns and legal are structural, kept in template) -->
<footer class="footer">
  <div class="brewco-container">
    <div class="footer__features" data-reveal>
      <?php foreach ( brewco_rows( 'footer_features', $fb_ffeat, array( 'title', 'text' ) ) as $f ) : ?>
        <div class="feature">
          <span class="feature__icon"><?php echo esc_html( brewco_row( $f, 'icon', '◈' ) ); ?></span>
          <div><strong><?php echo esc_html( brewco_row( $f, 'title' ) ); ?></strong><span><?php echo esc_html( brewco_row( $f, 'text' ) ); ?></span></div>
        </div>
      <?php endforeach; ?>
    </div>

    <div class="footer__main">
      <div class="footer__brand">
        <p><?php echo brewco_t( 'footer_text', 'Brewco Marketing Group designs, fabricates and manages custom mobile experiences that engage audiences where they work, live and play.' ); ?></p>
        <div class="footer__pills">
          <?php $fph = brewco_field( 'footer_phone', '270-754-2264' ); ?>
          <a href="tel:<?php echo esc_attr( brewco_field( 'footer_phone_link', '+12707542264' ) ); ?>" class="pill pill--contact">✆ <?php echo esc_html( $fph ); ?></a>
          <a href="<?php echo esc_url( brewco_field( 'finalcta_cta_url', '/contact/' ) ); ?>" class="pill pill--contact">✉ Contact Us</a>
        </div>
        <div class="footer__social">
          <?php foreach ( brewco_rows( 'footer_socials', $fb_socials, array( 'url' ) ) as $s ) : ?>
            <a href="<?php echo esc_url( brewco_row( $s, 'url' ) ); ?>" rel="noopener" target="_blank"><?php echo esc_html( brewco_row( $s, 'label' ) ); ?></a>
          <?php endforeach; ?>
        </div>
      </div>
      <nav class="footer__nav">
        <div><h4>Company</h4><a href="#approach">Who We Are</a><a href="#services">What We Do</a><a href="#work">Our Work</a><a href="#fleet">Vehicles</a></div>
        <div><h4>Services</h4><a href="#services">Experiential Marketing</a><a href="#services">Sponsorship</a><a href="#services">Design &amp; Fabrication</a><a href="#services">Brewco Health</a></div>
        <div><h4>Offices</h4><?php foreach ( brewco_rows( 'offices', $fb_offices, array( 'name', 'city', 'address', 'phone' ) ) as $o ) : ?><span><?php echo esc_html( brewco_row( $o, 'city', brewco_row( $o, 'name' ) ) ); ?></span><?php endforeach; ?></div>
      </nav>
    </div>

    <div class="footer__bottom">
      <span>&copy; <?php echo esc_html( gmdate( 'Y' ) ); ?> Brewco Marketing Group. All Rights Reserved.</span>
      <span>Site Design &amp; Development by New Wave Creative</span>
    </div>
  </div>
</footer>
