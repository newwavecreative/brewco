<?php
/**
 * Landing page markup — section order mirrors the reference (quad.medvi.org):
 *   nav · hero · logos · statement · integrated · stats · services ·
 *   photo CTA · fleet · quote · process · partner stories · CTA · footer
 *
 * Included by templates/landing-template.php, which defines $A = plugin assets base URL.
 * Animation hooks: data-reveal | data-reveal-delay | data-parallax | data-rotate | data-count | data-flip
 *
 * COPY SOURCE: all copy below is drawn from brewco.com (Sept 2026) — the
 * "Who We Are", "What We Do", "Vehicles" and "Contact" pages. Nothing here is
 * invented. Anything still needing a real value is marked `CONFIRM:` — grep for it.
 *
 * OUTSTANDING: imagery. Every <img> still points at assets/img/placeholder.svg.
 * brewco.com loads its photography through a JS gallery, so nothing was pulled;
 * swap in real Brewco photography (hero, fabrication shot, photo CTA) before launch.
 */
if ( ! defined( 'ABSPATH' ) ) { exit; }
if ( ! isset( $A ) ) { $A = ''; }
?>
<!-- SECTION 01 — NAVBAR -->
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
    <a href="#contact" class="btn btn--cta nav__cta">Get a Custom Quote</a>
    <button class="nav__burger" aria-label="Open menu" aria-expanded="false" data-menu-toggle>
      <span></span><span></span><span></span>
    </button>
  </div>
  <div class="nav__mobile" data-mobile-menu>
    <a href="#approach">Who We Are</a>
    <a href="#services">What We Do</a>
    <a href="#work">Our Work</a>
    <a href="#fleet">Vehicles</a>
    <a href="#contact" class="btn btn--cta">Get a Custom Quote</a>
  </div>
</header>

<main id="top">

<!-- SECTION 02 — HERO (two-column: headline left, copy + CTA right) -->
<section class="hero" id="hero">
  <div class="hero__bg">
    <!-- CONFIRM: hero imagery. Placeholder for now — swap for Brewco hero
         photography (a tour asset on location reads best here), or restore the
         looping <video> from the template if they supply footage. -->
    <img src="<?php echo brewco_landing_asset( 'img/placeholder.svg' ); ?>" alt="" aria-hidden="true">
    <div class="hero__overlay"></div>
  </div>
  <div class="brewco-container hero__grid">
    <div class="hero__left">
      <div class="hero__badges" data-reveal>
        <span class="pill">100% Employee-Owned</span>
        <span class="pill">25 Years</span>
      </div>
      <h1 class="hero__title" data-reveal data-reveal-delay="80">The Marketing Vehicle for the World&rsquo;s Most Trusted Brands</h1>
    </div>
    <div class="hero__right" data-reveal data-reveal-delay="180">
      <p class="hero__sub">Brewco Marketing Group is a 100% employee-owned company dedicated to
        designing, fabricating, and managing custom experiences for our partners. For 25 years,
        we have created award-winning solutions that engage audiences where they work, live and play.</p>
      <div class="hero__actions">
        <a href="#contact" class="btn btn--cta btn--lg">Get a Custom Quote</a>
        <a href="#work" class="hero__link">See our work &rarr;</a>
      </div>
    </div>
  </div>
  <a href="#work" class="hero__cue" aria-label="Scroll down"></a>
</section>

<!-- SECTION 03 — LOGO BAR (marquee) — brands named on brewco.com's own site.
     CONFIRM: these are set as text wordmarks. If Brewco has permission to show
     client logos as artwork, drop the images in and swap the spans. -->
<section class="logobar" id="work">
  <div class="brewco-container">
    <p class="logobar__label" data-reveal>Trusted by the brands we build for</p>
    <div class="marquee" data-marquee>
      <div class="marquee__track">
        <span class="logobar__logo">McDonald&rsquo;s</span><span class="logobar__logo">IBM</span>
        <span class="logobar__logo">General Motors</span><span class="logobar__logo">LG</span>
        <span class="logobar__logo">KOHLER</span><span class="logobar__logo">Compassion International</span>
        <span class="logobar__logo">TCS New York City Marathon</span>
        <span class="logobar__logo">McDonald&rsquo;s</span><span class="logobar__logo">IBM</span>
        <span class="logobar__logo">General Motors</span><span class="logobar__logo">LG</span>
        <span class="logobar__logo">KOHLER</span><span class="logobar__logo">Compassion International</span>
        <span class="logobar__logo">TCS New York City Marathon</span>
      </div>
    </div>
  </div>
</section>

<!-- SECTION 04 — STATEMENT (centered intro) -->
<section class="about" id="approach">
  <span class="section-watermark" aria-hidden="true">Who We Are</span>
  <div class="brewco-container about__inner">
    <span class="eyebrow" data-reveal>Who We Are</span>
    <h2 class="about__title" data-reveal data-reveal-delay="80">
      Award-Winning <span class="text-accent">Experiential Brand Strategy</span>
    </h2>
    <p class="about__text" data-reveal data-reveal-delay="160">
      Brewco Marketing Group is a 100% employee-owned company that is dedicated to producing
      excellent mobile experiences. For 25 years, we have created memorable mobile programs to
      engage audiences where they work, live and play.
    </p>
  </div>
</section>

<!-- SECTION 05 — INTEGRATED TEAM (card rotates on scroll) -->
<section class="showcase">
  <span class="section-watermark" aria-hidden="true">Integrated</span>
  <div class="brewco-container showcase__grid">
    <div class="showcase__stage" data-reveal>
      <div class="showcase__card" data-rotate>
        <!-- CONFIRM: imagery — a shot from the Central City fabrication shop belongs here. -->
        <img src="<?php echo $A; ?>img/placeholder.svg" alt="">
      </div>
    </div>
    <div class="showcase__body" data-reveal data-reveal-delay="140">
      <span class="eyebrow">The Difference</span>
      <h2>One integrated team, <span class="text-accent">start to finish</span></h2>
      <p>Brewco Marketing Group is a completely integrated company that removes the hassle and
        costs associated with 3rd-party vendors. We have an experienced team ready to bring your
        project to life.</p>
      <ul class="checklist">
        <li>In-house designer and fabricators</li>
        <li>Electricians and HVAC experts</li>
        <li>Maintenance technicians and support staff</li>
      </ul>
      <a href="#services" class="btn btn--dark">What We Do</a>
    </div>
  </div>
</section>

<!-- SECTION 06 — STATS (count-up) + heading.
     All three figures are verifiable on brewco.com: 25 years, 100% employee-owned,
     and four offices (Central City KY, Nashville TN, Charlotte NC, London UK). -->
<section class="stats">
  <div class="brewco-container">
    <div class="stats__grid">
      <div class="stat" data-reveal>
        <div class="stat__num"><span data-count="25">0</span></div>
        <div class="stat__label">Years in Business</div>
      </div>
      <div class="stat" data-reveal data-reveal-delay="100">
        <div class="stat__num"><span data-count="100">0</span>%</div>
        <div class="stat__label">Employee-Owned</div>
      </div>
      <div class="stat" data-reveal data-reveal-delay="200">
        <div class="stat__num"><span data-count="4">0</span></div>
        <div class="stat__label">Offices, US &amp; UK</div>
      </div>
    </div>
    <div class="stats__headline" data-reveal>
      <h2>Experience that shows up <span class="text-accent">where your audience is</span></h2>
      <p>Our team of experiential marketing experts have logged millions of miles and executed
        thousands of event days across North America and Europe.</p>
    </div>
  </div>
</section>

<!-- SECTION 07 — SERVICES (the six lines of business on brewco.com/what-we-do) -->
<section class="features" id="services">
  <span class="section-watermark" aria-hidden="true">Services</span>
  <div class="brewco-container">
    <div class="section-head" data-reveal>
      <span class="eyebrow">What We Do</span>
      <h2>Completely <span class="text-accent">integrated solutions</span></h2>
    </div>
    <div class="feature-list">
      <article class="featurecard" data-reveal>
        <div class="featurecard__body">
          <h3>Experiential Marketing</h3>
          <p>Brewco Marketing Group immerses customers in face-to-face interactions and experiences
            that educate and entertain. Let us transform your marketing mix with innovative
            experiential marketing strategies and efficient implementation.</p>
          <ul class="checklist">
            <li>Mobile marketing tours and pop-up retail</li>
            <li>Retail activation and product sampling</li>
            <li>Mobile training, command centers and STEM education</li>
          </ul>
        </div>
        <div class="featurecard__icon" aria-hidden="true">◇</div>
      </article>
      <article class="featurecard" data-reveal data-reveal-delay="80">
        <div class="featurecard__body">
          <h3>Sponsorship Negotiation &amp; Activation</h3>
          <p>Negotiating and activating event sponsorships is a complex process. Brewco Marketing
            Group utilizes years of expertise and relationships to seamlessly coordinate
            sponsorship opportunities.</p>
          <ul class="checklist">
            <li>Identifying the right events</li>
            <li>Negotiating partnerships and display space</li>
            <li>Executing on-site customer engagement</li>
          </ul>
        </div>
        <div class="featurecard__icon" aria-hidden="true">△</div>
      </article>
      <article class="featurecard" data-reveal data-reveal-delay="160">
        <div class="featurecard__body">
          <h3>Design &amp; Fabrication</h3>
          <p>A completely integrated company that removes the hassle and costs associated with
            3rd-party vendors. We have an experienced team ready to bring your project to life,
            from first drawing to finished asset.</p>
          <ul class="checklist">
            <li>In-house design and fabrication</li>
            <li>Electrical and HVAC</li>
            <li>Maintenance and support staff</li>
          </ul>
        </div>
        <div class="featurecard__icon" aria-hidden="true">○</div>
      </article>
      <article class="featurecard" data-reveal>
        <div class="featurecard__body">
          <h3>Brewco Health</h3>
          <p>Mobile health solutions that directly contribute to increased medical access for
            underserved populations or communities in crisis. Working one-on-one with regional
            healthcare systems and emergency management departments, Brewco Health develops and
            builds mobile solutions to enhance medical services where they are needed the most.</p>
        </div>
        <div class="featurecard__icon" aria-hidden="true">✚</div>
      </article>
      <article class="featurecard" data-reveal data-reveal-delay="80">
        <div class="featurecard__body">
          <h3>Brewco Staging</h3>
          <p>Brewco Staging fulfills the need for mobile stages at both entertainment and corporate
            events. Based on the quality of our mobile stage inventory and a reputation for
            well-done event execution, Brewco Staging is proud to provide various mobile staging
            options.</p>
        </div>
        <div class="featurecard__icon" aria-hidden="true">▤</div>
      </article>
      <article class="featurecard" data-reveal data-reveal-delay="160">
        <div class="featurecard__body">
          <h3>Brewco Hospitality</h3>
          <p>Mobile hospitality assets for short-term or long-term lease. From VIP experiences to
            employee appreciation perks, Brewco Hospitality offers mobile assets featuring viewing
            decks, TVs, lounging furniture, private bathrooms, dining tables and more.</p>
        </div>
        <div class="featurecard__icon" aria-hidden="true">◈</div>
      </article>
    </div>
  </div>
</section>

<!-- SECTION 08 — PHOTO CTA (full-bleed image) -->
<section class="photocta">
  <div class="photocta__bg" data-parallax="0.08">
    <!-- CONFIRM: imagery — a tour asset on the road belongs here. -->
    <img src="<?php echo $A; ?>img/placeholder.svg" alt="" aria-hidden="true">
    <div class="photocta__overlay"></div>
  </div>
  <div class="brewco-container photocta__content" data-reveal>
    <span class="eyebrow eyebrow--light">North America &middot; Europe</span>
    <h2>Millions of miles.<br>Thousands of event days.</h2>
    <p>Our team executes thousands of event days annually across North America and Europe.</p>
    <a href="#contact" class="btn btn--cta btn--lg">Get a Custom Quote</a>
  </div>
</section>

<!-- SECTION 09 — FLEET
     Replaces the template's "us vs. them" line chart. That chart plotted an
     unlabelled "results over time" trend with no data behind it — an implied
     performance claim Brewco cannot support. The real fleet list from
     brewco.com/vehicles is concrete and does the same persuasive work. -->
<section class="fleet" id="fleet">
  <div class="brewco-container">
    <div class="section-head" data-reveal>
      <span class="eyebrow">Vehicles</span>
      <h2>Built, owned and <span class="text-accent">maintained in-house</span></h2>
      <p class="section-head__sub">Every asset below is designed, fabricated and managed by our own
        team &mdash; no third-party vendors between you and the build.</p>
    </div>
    <ul class="taggrid" data-reveal>
      <li class="tag">Box Trucks</li>
      <li class="tag">Bumper Pull Trailers</li>
      <li class="tag">Custom Buses</li>
      <li class="tag">Custom Containers</li>
      <li class="tag">Expandable Trailers</li>
      <li class="tag">Gooseneck Trailers</li>
      <li class="tag">Mobile Hospitality Trailers</li>
      <li class="tag">Mobile Kitchens</li>
      <li class="tag">Mobile Stages</li>
      <li class="tag">Sprinter Vans</li>
    </ul>
  </div>
</section>

<!-- SECTION 10 — QUOTE / CONTACT
     Replaces the template's $114/mo single-product pricing card. Brewco quotes
     every project individually — brewco.com's own CTA is "no-cost consultation". -->
<section class="quote" id="quote">
  <div class="brewco-container">
    <div class="section-head" data-reveal>
      <span class="eyebrow">Get Started</span>
      <h2>Every project is <span class="text-accent">quoted to spec</span></h2>
    </div>
    <div class="quotecard" data-reveal>
      <div class="quotecard__lead">
        <h3>Contact us for a no-cost consultation.</h3>
        <p>Tell us what you are trying to accomplish and where you need to be. We will scope the
          asset, the build and the tour, and come back with a custom quote.</p>
        <a href="#contact" class="btn btn--cta btn--lg">Get a Custom Quote</a>
      </div>
      <ul class="quotecard__locations">
        <li>
          <strong>Headquarters</strong>
          <span>106 Brewer Drive<br>Central City, KY 42330</span>
          <a href="tel:+12707542264">270-754-2264</a>
        </li>
        <li>
          <strong>Nashville, TN</strong>
          <span>1 Vantage Way<br>Nashville, TN 37228</span>
          <a href="tel:+16154965264">615-496-5264</a>
        </li>
        <li>
          <strong>Charlotte, NC</strong>
          <span>4107 Rose Lake Drive, Suite G<br>Charlotte, NC 28217</span>
          <a href="tel:+19802019048">980-201-9048</a>
        </li>
        <li>
          <strong>London, England</strong>
          <span>16 Great Queen Street<br>Covent Garden, London WC2B 5AH</span>
          <a href="tel:+442036001025">+44 203 600 1025</a>
        </li>
      </ul>
    </div>
  </div>
</section>

<!-- SECTION 11 — HOW IT WORKS (gradient step cards) -->
<section class="how" id="how">
  <div class="brewco-container">
    <div class="section-head" data-reveal>
      <span class="eyebrow">How It Works</span>
      <h2>From first conversation <span class="text-accent">to the road</span></h2>
    </div>
    <div class="bento">
      <div class="bento__cell bento__cell--lg" data-reveal>
        <span class="bento__step">Step 1</span>
        <div class="bento__glow"></div>
        <h3>Consult</h3>
        <p>We start with a no-cost consultation: your goals, your audience, and where the program
          needs to go. Our team scopes the asset and the tour around that.</p>
      </div>
      <div class="bento__cell" data-reveal data-reveal-delay="100">
        <span class="bento__step">Step 2</span>
        <div class="bento__glow"></div>
        <h3>Design &amp; Fabricate</h3>
        <p>Our in-house designers, fabricators, electricians and HVAC experts build the asset under
          one roof.</p>
      </div>
      <div class="bento__cell" data-reveal data-reveal-delay="200">
        <span class="bento__step">Step 3</span>
        <div class="bento__glow"></div>
        <h3>Tour &amp; Manage</h3>
        <p>We manage the program on the road &mdash; staffing, logistics, maintenance and storage.</p>
      </div>
    </div>
  </div>
</section>

<!-- SECTION 12 — PARTNER STORIES (marquee)
     Replaces the template's testimonial marquee. No real Brewco testimonials were
     available, and inventing quotes and attributing them to named people is not an
     option — so these are the partner stories brewco.com tells in its own words on
     the "Who We Are" page. Each one is verifiable. -->
<section class="stories">
  <div class="brewco-container">
    <div class="section-head" data-reveal>
      <span class="eyebrow">Our Work</span>
      <h2>The partner these brands <span class="text-accent">trusted</span></h2>
    </div>
  </div>
  <div class="marquee marquee--cards" data-marquee data-reveal>
    <div class="marquee__track">
      <figure class="story">
        <h3 class="story__brand">IBM</h3>
        <blockquote>Fabricated and managed a mobile Cyber Tactical Operations Center and launched a
          tour in the United States. All assets were subsequently shipped to Europe for an ongoing
          mobile tour consisting of 3 assets and a large touring staff.</blockquote>
      </figure>
      <figure class="story">
        <h3 class="story__brand">McDonald&rsquo;s</h3>
        <blockquote>Builds and manages the fleet of McDonald&rsquo;s Mobile Restaurants that activate
          throughout the United States &mdash; the 53&rsquo; McRig, 35&rsquo; Snack Truck,
          14&rsquo; McCafe and two food trucks.</blockquote>
      </figure>
      <figure class="story">
        <h3 class="story__brand">PSEG Long Island</h3>
        <blockquote>Fabricated and managed the first-ever mobile experience powered by solar. &ldquo;My
          Smart Energy Lab&rdquo; was self-sufficient and capable of 10 hours of solar-powered
          runtime per activation.</blockquote>
      </figure>
      <figure class="story">
        <h3 class="story__brand">Major League Baseball</h3>
        <blockquote>Took 52 artifacts from the National Baseball Hall of Fame and Museum on the road
          for the &ldquo;We Are Baseball&rdquo; mobile experience &mdash; 14 trailers, 2 mobile
          stages and the first mobile IMAX theater.</blockquote>
      </figure>
      <figure class="story">
        <h3 class="story__brand">Texas Division of Emergency Management</h3>
        <blockquote>Trusted during a pandemic to fabricate and deliver 4 mobile medical ICUs that can
          function independently or together as a field hospital.</blockquote>
      </figure>
      <!-- duplicate set for seamless loop -->
      <figure class="story" aria-hidden="true">
        <h3 class="story__brand">IBM</h3>
        <blockquote>Fabricated and managed a mobile Cyber Tactical Operations Center and launched a
          tour in the United States. All assets were subsequently shipped to Europe for an ongoing
          mobile tour consisting of 3 assets and a large touring staff.</blockquote>
      </figure>
      <figure class="story" aria-hidden="true">
        <h3 class="story__brand">McDonald&rsquo;s</h3>
        <blockquote>Builds and manages the fleet of McDonald&rsquo;s Mobile Restaurants that activate
          throughout the United States &mdash; the 53&rsquo; McRig, 35&rsquo; Snack Truck,
          14&rsquo; McCafe and two food trucks.</blockquote>
      </figure>
      <figure class="story" aria-hidden="true">
        <h3 class="story__brand">PSEG Long Island</h3>
        <blockquote>Fabricated and managed the first-ever mobile experience powered by solar. &ldquo;My
          Smart Energy Lab&rdquo; was self-sufficient and capable of 10 hours of solar-powered
          runtime per activation.</blockquote>
      </figure>
      <figure class="story" aria-hidden="true">
        <h3 class="story__brand">Major League Baseball</h3>
        <blockquote>Took 52 artifacts from the National Baseball Hall of Fame and Museum on the road
          for the &ldquo;We Are Baseball&rdquo; mobile experience &mdash; 14 trailers, 2 mobile
          stages and the first mobile IMAX theater.</blockquote>
      </figure>
      <figure class="story" aria-hidden="true">
        <h3 class="story__brand">Texas Division of Emergency Management</h3>
        <blockquote>Trusted during a pandemic to fabricate and deliver 4 mobile medical ICUs that can
          function independently or together as a field hospital.</blockquote>
      </figure>
    </div>
  </div>
</section>

</main>

<!-- SECTION 13 — FINAL CTA -->
<section class="finalcta" id="contact">
  <div class="brewco-container finalcta__inner" data-reveal>
    <h2>Let&rsquo;s <span class="text-accent">get started</span>.</h2>
    <p>Contact us for a no-cost consultation.</p>
    <!-- CONFIRM: point this at the real contact page/form URL once this
         template's final URL on the Brewco site is settled. -->
    <a href="/contact/" class="btn btn--cta btn--lg">Contact Us</a>
  </div>
</section>

<!-- SECTION 14 — FOOTER -->
<footer class="footer">
  <div class="brewco-container">
    <div class="footer__features" data-reveal>
      <div class="feature"><span class="feature__icon">◈</span><div><strong>100% Employee-Owned</strong><span>Every owner has a stake in the outcome</span></div></div>
      <div class="feature"><span class="feature__icon">✦</span><div><strong>In-House Fabrication</strong><span>Design, build, electrical and HVAC under one roof</span></div></div>
      <div class="feature"><span class="feature__icon">✔</span><div><strong>25 Years</strong><span>Award-winning mobile programs</span></div></div>
    </div>

    <div class="footer__main">
      <div class="footer__brand">
        <p>Brewco Marketing Group designs, fabricates and manages custom mobile experiences that
          engage audiences where they work, live and play.</p>
        <div class="footer__pills">
          <a href="tel:+12707542264" class="pill pill--contact">✆ 270-754-2264</a>
          <a href="/contact/" class="pill pill--contact">✉ Contact Us</a>
        </div>
        <div class="footer__social">
          <a href="https://www.facebook.com/BrewcoMarketing" rel="noopener" target="_blank">Facebook</a>
          <a href="https://www.instagram.com/brewcomarketing/" rel="noopener" target="_blank">Instagram</a>
          <a href="https://www.linkedin.com/company/brewco-marketing-group" rel="noopener" target="_blank">LinkedIn</a>
          <a href="https://www.youtube.com/channel/UCaOpa5GiN22P3HCwk1gkMuw" rel="noopener" target="_blank">YouTube</a>
          <a href="https://twitter.com/brewcomarketing" rel="noopener" target="_blank">X</a>
        </div>
      </div>
      <nav class="footer__nav">
        <div><h4>Company</h4><a href="#approach">Who We Are</a><a href="#services">What We Do</a><a href="#work">Our Work</a><a href="#fleet">Vehicles</a></div>
        <div><h4>Services</h4><a href="#services">Experiential Marketing</a><a href="#services">Sponsorship</a><a href="#services">Design &amp; Fabrication</a><a href="#services">Brewco Health</a></div>
        <div><h4>Offices</h4><span>Central City, KY</span><span>Nashville, TN</span><span>Charlotte, NC</span><span>London, England</span></div>
      </nav>
    </div>

    <div class="footer__bottom">
      <span>&copy; <?php echo esc_html( gmdate( 'Y' ) ); ?> Brewco Marketing Group. All Rights Reserved.</span>
      <span>Site Design &amp; Development by New Wave Creative</span>
    </div>
  </div>
</footer>
