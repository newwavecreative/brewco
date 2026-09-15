<?php
/**
 * Landing page markup. Section order started from the reference (quad.medvi.org),
 * with Services moved up to follow the statement, How It Works and the closing
 * CTA removed, and the quote section moved last as the page's call to action:
 *   nav · hero · logos · statement · services · integrated · stats ·
 *   photo CTA · fleet · partner stories · FAQ · quote · footer
 *
 * Included by templates/landing-template.php, which defines $A = plugin assets base URL.
 * Animation hooks: data-reveal | data-reveal-delay | data-parallax | data-scroll-zoom | data-rotate | data-count | data-flip | data-carousel
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
$fb_stories = array(
	array( 'brand' => 'IBM',                                   'text' => 'Fabricated and managed a mobile Cyber Tactical Operations Center and launched a tour in the United States. All assets were subsequently shipped to Europe for an ongoing mobile tour consisting of 3 assets and a large touring staff.', 'url' => '/work/ibm/' ),
	array( 'brand' => 'McDonald’s',                            'text' => 'Builds and manages the fleet of McDonald’s Mobile Restaurants that activate throughout the United States — the 53’ McRig, 35’ Snack Truck, 14’ McCafe and two food trucks.', 'url' => '/work/mcdonalds/' ),
	array( 'brand' => 'PSEG Long Island',                      'text' => 'Fabricated and managed the first-ever mobile experience powered by solar. “My Smart Energy Lab” was self-sufficient and capable of 10 hours of solar-powered runtime per activation.', 'url' => '/work/pseg-long-island/' ),
	array( 'brand' => 'Major League Baseball',                 'text' => 'Took 52 artifacts from the National Baseball Hall of Fame and Museum on the road for the “We Are Baseball” mobile experience — 14 trailers, 2 mobile stages and the first mobile IMAX theater.', 'url' => '/work/the-national-baseball-hall-of-fame-and-museum/' ),
	array( 'brand' => 'Texas Division of Emergency Management','text' => 'Trusted during a pandemic to fabricate and deliver 4 mobile medical ICUs that can function independently or together as a field hospital.', 'url' => '/work/the-texas-division-of-emergency-management/' ),
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

/* FAQ fallbacks. Every answer is compiled from brewco.com's "Who We Are", "What
   We Do", "Vehicles" and "Contact" pages; nothing is added. Each answer names the
   company and stands on its own, so it still makes sense when an AI assistant or
   search engine quotes it without the question. */
$fb_faqs = array(
	array(
		'question' => 'What does Brewco Marketing Group do?',
		'answer'   => 'Brewco Marketing Group designs, fabricates and manages custom mobile experiences that immerse customers in face-to-face interactions that educate and entertain. Its services include experiential marketing, sponsorship negotiation and activation, and design and fabrication, along with Brewco Health, Brewco Staging and Brewco Hospitality.',
	),
	array(
		'question' => 'Is Brewco Marketing Group employee-owned?',
		'answer'   => 'Yes. Brewco Marketing Group is a 100% employee-owned company dedicated to producing excellent mobile experiences. For 25 years, it has created memorable mobile programs that engage audiences where they work, live and play.',
	),
	array(
		'question' => 'What kinds of vehicles does Brewco Marketing Group offer?',
		'answer'   => 'Brewco Marketing Group’s vehicles include box trucks, bumper pull trailers, custom buses, custom containers, expandable trailers, gooseneck trailers, mobile hospitality trailers, mobile kitchens, mobile stages and Sprinter vans.',
	),
	array(
		'question' => 'Does Brewco Marketing Group design and build its mobile assets in-house?',
		'answer'   => 'Yes. Brewco Marketing Group is a completely integrated company that removes the hassle and costs associated with third-party vendors. Its in-house team includes a designer, fabricators, electricians, HVAC experts, maintenance technicians and support staff.',
	),
	array(
		'question' => 'Where does Brewco Marketing Group operate?',
		'answer'   => 'Brewco Marketing Group’s team of experiential marketing experts executes thousands of event days annually across North America and Europe. The company is headquartered in Central City, Kentucky, with offices in Nashville, Tennessee; Charlotte, North Carolina; and London, England.',
	),
	array(
		'question' => 'Which brands has Brewco Marketing Group worked with?',
		'answer'   => 'Brewco Marketing Group’s partners include IBM, McDonald’s, PSEG Long Island, Major League Baseball and the National Baseball Hall of Fame and Museum, and the Texas Division of Emergency Management. Projects range from building and managing McDonald’s fleet of Mobile Restaurants to fabricating and delivering four mobile medical ICUs for Texas during a pandemic.',
	),
	array(
		'question' => 'What are Brewco Health, Brewco Staging and Brewco Hospitality?',
		'answer'   => 'Brewco Health works with regional healthcare systems and emergency management departments to build mobile health solutions that increase medical access for underserved populations and communities in crisis. Brewco Staging provides mobile stages for entertainment and corporate events. Brewco Hospitality offers mobile hospitality assets for short-term or long-term lease, featuring viewing decks, TVs, lounging furniture, private bathrooms and dining tables.',
	),
	array(
		'question' => 'How do I get a quote from Brewco Marketing Group?',
		'answer'   => 'Every Brewco Marketing Group project is quoted to spec. Contact Brewco for a no-cost consultation, or send a message or request a project quote through the contact page.',
	),
);

$clients = brewco_rows( 'logobar_clients', $fb_clients, array( 'name', 'logo' ) );
$stories = brewco_rows( 'stories', $fb_stories, array( 'brand', 'text', 'logo', 'image', 'url' ) );
/* FAQ rows need both halves: a question with no answer (or the reverse) would
   show an empty panel and publish an invalid FAQPage entry, so it's skipped. */
$faqs = array_values( array_filter( brewco_rows( 'faqs', $fb_faqs, array( 'question', 'answer' ) ), function ( $f ) {
	return '' !== trim( (string) brewco_row( $f, 'question' ) ) && '' !== trim( (string) brewco_row( $f, 'answer' ) );
} ) );
if ( ! $faqs ) { $faqs = $fb_faqs; }
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
      <a href="#our-work">Our Work</a>
      <a href="#fleet">Vehicles</a>
    </nav>
    <a href="<?php echo brewco_link( 'nav_cta_url', '#contact' ); ?>" class="btn btn--cta nav__cta"><?php echo brewco_t( 'nav_cta_label', 'Get a Custom Quote' ); ?></a>
    <button class="nav__burger" aria-label="Open menu" aria-expanded="false" data-menu-toggle>
      <span></span><span></span><span></span>
    </button>
  </div>
  <div class="nav__mobile" data-mobile-menu>
    <a href="#approach">Who We Are</a>
    <a href="#services">What We Do</a>
    <a href="#our-work">Our Work</a>
    <a href="#fleet">Vehicles</a>
    <a href="<?php echo brewco_link( 'nav_cta_url', '#contact' ); ?>" class="btn btn--cta"><?php echo brewco_t( 'nav_cta_label', 'Get a Custom Quote' ); ?></a>
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

  /* A background video, when set, replaces the slideshow. It is a plain <video>
     on a Media Library MP4 rather than a Vimeo/YouTube embed: no player to boot,
     so it starts as soon as the first part of the file arrives. The still is the
     chosen poster, else the first slide. The <source> only matches with reduced
     motion off, so those visitors get the still and never request the file;
     main.js backs this up for browsers that ignore `media` on <source>. */
  $hero_video  = brewco_file_url( 'hero_video' );
  $hero_poster = '';
  if ( $hero_video ) {
      $poster      = brewco_image_data( brewco_field( 'hero_video_poster', null ) );
      $hero_poster = $poster ? $poster['url'] : $hero_slides[0];
  }
  ?>
  <div class="hero__bg" data-slide-seconds="<?php echo esc_attr( $hero_secs ); ?>">
    <?php if ( $hero_video ) : ?>
      <video class="hero__video" autoplay muted loop playsinline preload="auto"
             poster="<?php echo $hero_poster; /* already escaped by the helper */ ?>"
             aria-hidden="true" tabindex="-1" disablepictureinpicture>
        <source src="<?php echo $hero_video; /* already escaped by the helper */ ?>" type="video/mp4"
                media="(prefers-reduced-motion: no-preference)">
      </video>
    <?php else : ?>
      <?php foreach ( $hero_slides as $i => $slide_url ) : ?>
        <img class="hero__slide<?php echo 0 === $i ? ' is-active' : ''; ?>"
             src="<?php echo $slide_url; /* already escaped by the helper */ ?>"
             alt="" aria-hidden="true"
             <?php echo 0 === $i ? 'fetchpriority="high"' : 'loading="lazy" decoding="async"'; ?>>
      <?php endforeach; ?>
    <?php endif; ?>
    <div class="hero__overlay"></div>
  </div>
  <div class="brewco-container hero__grid">
    <div class="hero__left">
      <h1 class="hero__title" data-reveal data-reveal-delay="80"><?php echo brewco_t_br( 'hero_headline', 'The Marketing Vehicle for the World’s Most Trusted Brands' ); ?></h1>
    </div>
    <div class="hero__right" data-reveal data-reveal-delay="180">
      <div class="hero__actions">
        <a href="<?php echo brewco_link( 'hero_cta_url', '#contact' ); ?>" class="btn btn--cta btn--lg"><?php echo brewco_t( 'hero_cta_label', 'Get a Custom Quote' ); ?></a>
        <a href="<?php echo brewco_link( 'hero_link_url', '#work' ); ?>" class="hero__link"><?php echo brewco_t( 'hero_link_label', 'See our work' ); ?> &rarr;</a>
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

<!-- SECTION 05 — SERVICES -->
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
            <?php /* Cards alternate sides: odd cards hold the image right, even
                     cards left. 1 = enter from the right, -1 = from the left. */ ?>
            <div class="featurecard__icon featurecard__icon--img featurecard__icon--<?php echo $sfit; ?>" data-slide-in="<?php echo 0 === $i % 2 ? '1' : '-1'; ?>">
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

<!-- SECTION 06 — INTEGRATED TEAM -->
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
      <a href="<?php echo brewco_link( 'showcase_cta_url', '#services' ); ?>" class="btn btn--dark"><?php echo brewco_t( 'showcase_cta_label', 'What We Do' ); ?></a>
    </div>
  </div>
</section>

<!-- SECTION 07 — STATS -->
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

<!-- SECTION 08 — PHOTO CTA -->
<section class="photocta">
  <div class="photocta__bg" data-parallax="0.08">
    <img src="<?php echo brewco_image_url( 'photocta_image', 'img/placeholder.svg' ); ?>" alt="" aria-hidden="true" data-scroll-zoom>
    <div class="photocta__overlay"></div>
  </div>
  <div class="brewco-container photocta__content" data-reveal>
    <span class="eyebrow eyebrow--light"><?php echo brewco_t( 'photocta_eyebrow', 'North America · Europe' ); ?></span>
    <h2><?php echo brewco_t_br( 'photocta_heading', "Millions of miles.\nThousands of event days." ); ?></h2>
    <p><?php echo brewco_t( 'photocta_text', 'Our team executes thousands of event days annually across North America and Europe.' ); ?></p>
    <a href="<?php echo brewco_link( 'photocta_cta_url', '#contact' ); ?>" class="btn btn--cta btn--lg"><?php echo brewco_t( 'photocta_cta_label', 'Get a Custom Quote' ); ?></a>
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

<!-- SECTION 10 — OUR WORK (partner-story carousel)
     Replaces the template's testimonial marquee — no real testimonials exist and
     invented quotes attributed to named people are not an option. The copy is
     brewco.com's own words. Each story is a large photo slide with the client, a
     blurb and a link to its case study; the photo is the row's own image, else the
     featured image of the Brewco page it links to. It's a native horizontal
     scroller with scroll-snap, so swipes, trackpads and the keyboard work without
     JS; main.js adds mouse drag, the arrows and the dots. -->
<section class="stories" id="our-work">
  <div class="brewco-container">
    <div class="section-head" data-reveal>
      <span class="eyebrow"><?php echo brewco_t( 'stories_eyebrow', 'Our Work' ); ?></span>
      <h2><?php echo brewco_heading( 'stories_heading', 'The partner these brands', 'stories_heading_accent', 'trusted' ); ?></h2>
    </div>
  </div>
  <?php
  $story_rows       = array_values( $stories );
  $story_count      = count( $story_rows );
  $story_link_label = trim( (string) brewco_field( 'stories_link_label', 'See the work' ) );
  ?>
  <div class="storycar" data-carousel data-reveal>
    <div class="storycar__track" data-carousel-track tabindex="0" role="region" aria-roledescription="carousel"
         aria-label="<?php echo esc_attr( brewco_field( 'stories_eyebrow', 'Our Work' ) ); ?>" data-lenis-prevent-horizontal>
      <?php foreach ( $story_rows as $si => $st ) : ?>
        <?php
        $sbrand  = (string) brewco_row( $st, 'brand' );
        $slogo   = brewco_image_data( is_array( $st ) && isset( $st['logo'] ) ? $st['logo'] : null );
        $surl    = esc_url( trim( (string) brewco_row( $st, 'url' ) ) );
        $simg_id = brewco_story_image_id( $st );
        ?>
        <article class="storycard<?php echo $simg_id ? '' : ' storycard--noimg'; ?>" data-carousel-slide
                 aria-roledescription="slide" aria-label="<?php echo esc_attr( ( $si + 1 ) . ' of ' . $story_count ); ?>">
          <?php if ( $simg_id ) : ?>
            <?php
            // The 2048px copy is the src fallback; WordPress adds a srcset, so each
            // browser downloads the size it needs rather than the original upload.
            echo wp_get_attachment_image( $simg_id, '2048x2048', false, array(
                'class'     => 'storycard__img',
                'alt'       => '',
                'sizes'     => '(max-width: 700px) 86vw, min(74vw, 1080px)',
                'loading'   => 0 === $si ? 'eager' : 'lazy',
                'decoding'  => 'async',
                'draggable' => 'false',
            ) );
            ?>
          <?php endif; ?>
          <div class="storycard__body">
            <?php if ( $slogo ) : ?>
              <span class="storycard__logo"><img src="<?php echo $slogo['url']; ?>"<?php echo brewco_img_dims( $slogo ); ?> alt="" loading="lazy" decoding="async" draggable="false"></span>
            <?php endif; ?>
            <h3 class="storycard__title">
              <?php if ( '' !== $surl ) : ?>
                <a class="storycard__link" href="<?php echo $surl; ?>" draggable="false"><?php echo esc_html( $sbrand ); ?></a>
              <?php else : ?>
                <?php echo esc_html( $sbrand ); ?>
              <?php endif; ?>
            </h3>
            <p class="storycard__text"><?php echo esc_html( brewco_row( $st, 'text' ) ); ?></p>
            <?php if ( '' !== $surl && '' !== $story_link_label ) : ?>
              <span class="storycard__cta" aria-hidden="true"><?php echo esc_html( $story_link_label ); ?> <span class="storycard__arrow">&rarr;</span></span>
            <?php endif; ?>
          </div>
        </article>
      <?php endforeach; ?>
    </div>
    <?php /* Hidden until main.js wires them up, so no-JS visitors don't get dead buttons. */ ?>
    <div class="storycar__controls brewco-container" data-carousel-controls hidden>
      <div class="storycar__dots" data-carousel-dots></div>
      <div class="storycar__arrows">
        <button type="button" class="storycar__btn" data-carousel-prev aria-label="Previous story">
          <svg viewBox="0 0 24 24" width="22" height="22" aria-hidden="true" focusable="false"><path d="M15 5l-7 7 7 7" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg>
        </button>
        <button type="button" class="storycar__btn" data-carousel-next aria-label="Next story">
          <svg viewBox="0 0 24 24" width="22" height="22" aria-hidden="true" focusable="false"><path d="M9 5l7 7-7 7" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg>
        </button>
      </div>
    </div>
  </div>
</section>

<!-- SECTION 11 — FAQ (accordion + FAQPage structured data)
     Native <details>/<summary>: no JS, keyboard-accessible, and every answer is in
     the page source even while collapsed, for search engines and AI assistants.
     The JSON-LD at the end is built from the same rows, so the structured data
     always matches what's on the page. CONFIRM: the built-in answers are compiled
     from brewco.com; have the client review them. -->
<section class="faq" id="faq">
  <div class="brewco-container">
    <div class="section-head" data-reveal>
      <span class="eyebrow"><?php echo brewco_t( 'faq_eyebrow', 'FAQ' ); ?></span>
      <h2><?php echo brewco_heading( 'faq_heading', 'Frequently asked', 'faq_heading_accent', 'questions' ); ?></h2>
    </div>
    <div class="faq__list" data-reveal>
      <?php foreach ( $faqs as $fi => $faq ) : ?>
        <?php /* name= makes these an exclusive accordion (opening one closes the
                 others) where supported; elsewhere each simply opens on its own. */ ?>
        <details class="faq__item" name="brewco-faq"<?php echo 0 === $fi ? ' open' : ''; ?>>
          <summary class="faq__q"><h3><?php echo esc_html( brewco_row( $faq, 'question' ) ); ?></h3></summary>
          <div class="faq__a"><p><?php echo nl2br( esc_html( brewco_row( $faq, 'answer' ) ), false ); ?></p></div>
        </details>
      <?php endforeach; ?>
    </div>
  </div>
  <?php
  // FAQPage structured data from the same rows as the accordion. JSON_HEX_TAG
  // escapes < and >, so nothing typed into an answer can close this script tag.
  $faq_schema = array(
      '@context'   => 'https://schema.org',
      '@type'      => 'FAQPage',
      'mainEntity' => array(),
  );
  foreach ( $faqs as $faq ) {
      $faq_schema['mainEntity'][] = array(
          '@type'          => 'Question',
          'name'           => trim( (string) brewco_row( $faq, 'question' ) ),
          'acceptedAnswer' => array(
              '@type' => 'Answer',
              'text'  => trim( (string) brewco_row( $faq, 'answer' ) ),
          ),
      );
  }
  ?>
  <script type="application/ld+json"><?php echo wp_json_encode( $faq_schema, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE | JSON_HEX_TAG ); ?></script>
</section>

<!-- SECTION 12 — QUOTE / CONTACT (the page's closing call to action)
     Replaces the template's $114/mo pricing card; Brewco quotes to spec. It sits
     last and has the contact id, so every "Get a Custom Quote" button on the
     page lands here. -->
<section class="quote" id="contact">
  <div class="brewco-container">
    <div class="section-head" data-reveal>
      <span class="eyebrow"><?php echo brewco_t( 'quote_eyebrow', 'Get Started' ); ?></span>
      <h2><?php echo brewco_heading( 'quote_heading', 'Every project is', 'quote_heading_accent', 'quoted to spec' ); ?></h2>
    </div>
    <div class="quotecard" data-reveal>
      <div class="quotecard__lead">
        <h3><?php echo brewco_t( 'quote_lead_heading', 'Contact us for a no-cost consultation.' ); ?></h3>
        <p><?php echo brewco_t( 'quote_lead_text', 'Tell us what you are trying to accomplish and where you need to be. We will scope the asset, the build and the tour, and come back with a custom quote.' ); ?></p>
        <?php /* CONFIRM: goes to /contact/ unless the Button link field is set. This
                 section is where #contact now lands, so its own button leads to the
                 contact page itself. */ ?>
        <a href="<?php echo brewco_link( 'finalcta_cta_url', '/contact/' ); ?>" class="btn btn--cta btn--lg"><?php echo brewco_t( 'quote_cta_label', 'Get a Custom Quote' ); ?></a>
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

</main>

<!-- SECTION 13 — FOOTER (nav columns and legal are structural, kept in template) -->
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
          <a href="<?php echo brewco_link( 'finalcta_cta_url', '/contact/' ); ?>" class="pill pill--contact">✉ Contact Us</a>
        </div>
        <div class="footer__social">
          <?php foreach ( brewco_rows( 'footer_socials', $fb_socials, array( 'url' ) ) as $s ) : ?>
            <a href="<?php echo esc_url( brewco_row( $s, 'url' ) ); ?>" rel="noopener" target="_blank"><?php echo esc_html( brewco_row( $s, 'label' ) ); ?></a>
          <?php endforeach; ?>
        </div>
      </div>
      <nav class="footer__nav">
        <div><h4>Company</h4><a href="#approach">Who We Are</a><a href="#services">What We Do</a><a href="#our-work">Our Work</a><a href="#fleet">Vehicles</a></div>
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
