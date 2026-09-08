<?php
/**
 * Landing page markup — section order mirrors the reference (quad.medvi.org):
 *   nav · hero · logos · statement · product showcase · stats · feature cards ·
 *   photo CTA · comparison chart · pricing · how it works · testimonials · CTA · footer
 *
 * Included by templates/landing-template.php, which defines $A = plugin assets base URL.
 * Placeholder copy = Lorem Ipsum; placeholder imagery = assets/img/placeholder.svg.
 * Animation hooks: data-reveal | data-reveal-delay | data-parallax | data-rotate | data-count | data-flip
 */
if ( ! defined( 'ABSPATH' ) ) { exit; }
if ( ! isset( $A ) ) { $A = ''; }
?>
<!-- SECTION 01 — NAVBAR -->
<header class="nav" id="nav" data-nav>
  <div class="nav__inner brewco-container">
    <a class="nav__logo" href="#top" aria-label="Brewco Marketing Group home">
      <img class="nav__logo-img nav__logo-img--light" src="<?php echo brewco_landing_asset( 'logo-white.svg' ); ?>" alt="Brewco Marketing Group">
      <img class="nav__logo-img nav__logo-img--dark" src="<?php echo brewco_landing_asset( 'logo.svg' ); ?>" alt="Brewco Marketing Group">
    </a>
    <nav class="nav__links" aria-label="Primary">
      <a href="#services">Services</a>
      <a href="#approach">Approach</a>
      <a href="#work">Work</a>
      <a href="#pricing">Pricing</a>
    </nav>
    <a href="#contact" class="btn btn--gold nav__cta">Contact Us</a>
    <button class="nav__burger" aria-label="Open menu" aria-expanded="false" data-menu-toggle>
      <span></span><span></span><span></span>
    </button>
  </div>
  <div class="nav__mobile" data-mobile-menu>
    <a href="#services">Services</a>
    <a href="#approach">Approach</a>
    <a href="#work">Work</a>
    <a href="#pricing">Pricing</a>
    <a href="#contact" class="btn btn--gold">Contact Us</a>
  </div>
</header>

<main id="top">

<!-- SECTION 02 — HERO (two-column: headline left, copy + CTA right) -->
<section class="hero" id="hero">
  <div class="hero__bg">
    <!-- Hero background. Placeholder image for now — swap for Brewco's hero
         image, or restore the looping <video> from the template when they
         supply footage (see the New Wave build for the video markup). -->
    <img src="<?php echo brewco_landing_asset( 'img/placeholder.svg' ); ?>" alt="" aria-hidden="true">
    <div class="hero__overlay"></div>
  </div>
  <div class="brewco-container hero__grid">
    <div class="hero__left">
      <div class="hero__badges" data-reveal>
        <span class="pill pill--rating"><span class="stars" aria-hidden="true">★★★★★</span> Excellent 4.9 out of 5</span>
        <span class="pill pill--flag">★ USA Made</span>
      </div>
      <h1 class="hero__title" data-reveal data-reveal-delay="80">Ipsum.<br>Dolor.<br>Amet.</h1>
    </div>
    <div class="hero__right" data-reveal data-reveal-delay="180">
      <p class="hero__sub">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed do eiusmod
        tempor incididunt ut labore et dolore magna aliqua.</p>
      <div class="hero__actions">
        <a href="#pricing" class="btn btn--gold btn--lg">Find Your Perfect Program</a>
        <a href="#approach" class="hero__link">Learn more →</a>
      </div>
    </div>
  </div>
  <a href="#work" class="hero__cue" aria-label="Scroll down"></a>
</section>

<!-- SECTION 03 — LOGO BAR (marquee) -->
<section class="logobar" id="work">
  <div class="brewco-container">
    <p class="logobar__label" data-reveal>Trusted by teams everywhere</p>
    <div class="marquee" data-marquee>
      <div class="marquee__track">
        <span class="logobar__logo">LOGO</span><span class="logobar__logo">BRAND</span>
        <span class="logobar__logo">COMPANY</span><span class="logobar__logo">STUDIO</span>
        <span class="logobar__logo">AGENCY</span><span class="logobar__logo">GROUP</span>
        <span class="logobar__logo">LOGO</span><span class="logobar__logo">BRAND</span>
        <span class="logobar__logo">COMPANY</span><span class="logobar__logo">STUDIO</span>
        <span class="logobar__logo">AGENCY</span><span class="logobar__logo">GROUP</span>
      </div>
    </div>
  </div>
</section>

<!-- SECTION 04 — STATEMENT (centered intro) -->
<section class="about" id="approach">
  <span class="section-watermark" aria-hidden="true">Approach</span>
  <div class="brewco-container about__inner">
    <span class="eyebrow" data-reveal>Our Approach</span>
    <h2 class="about__title" data-reveal data-reveal-delay="80">
      Lorem ipsum dolor sit amet consectetur adipiscing elit <span class="text-accent">sed do eiusmod</span>
    </h2>
    <p class="about__text" data-reveal data-reveal-delay="160">
      Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor
      incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam.
    </p>
  </div>
</section>

<!-- SECTION 05 — PRODUCT SHOWCASE (card rotates on scroll) -->
<section class="showcase">
  <span class="section-watermark" aria-hidden="true">Showcase</span>
  <div class="brewco-container showcase__grid">
    <div class="showcase__stage" data-reveal>
      <div class="showcase__card" data-rotate>
        <img src="<?php echo $A; ?>img/placeholder.svg" alt="Showcase">
      </div>
    </div>
    <div class="showcase__body" data-reveal data-reveal-delay="140">
      <span class="eyebrow">The Difference</span>
      <h2>Lorem ipsum dolor <span class="text-accent">sit amet</span></h2>
      <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor
        incididunt ut labore et dolore magna aliqua.</p>
      <ul class="checklist">
        <li>Lorem ipsum dolor sit amet</li>
        <li>Consectetur adipiscing elit</li>
        <li>Sed do eiusmod tempor incididunt</li>
      </ul>
      <a href="#pricing" class="btn btn--dark">Learn More</a>
    </div>
  </div>
</section>

<!-- SECTION 06 — STATS (count-up) + heading -->
<section class="stats">
  <div class="brewco-container">
    <div class="stats__grid">
      <div class="stat" data-reveal>
        <div class="stat__num"><span data-count="12000">0</span>+</div>
        <div class="stat__label">Active Members</div>
      </div>
      <div class="stat" data-reveal data-reveal-delay="100">
        <div class="stat__num"><span data-count="48">0</span></div>
        <div class="stat__label">Programs</div>
      </div>
      <div class="stat" data-reveal data-reveal-delay="200">
        <div class="stat__num"><span data-count="99">0</span>%</div>
        <div class="stat__label">Satisfaction</div>
      </div>
    </div>
    <div class="stats__headline" data-reveal>
      <h2>Lorem ipsum dolor <span class="text-accent">for your goals</span></h2>
      <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit sed do eiusmod tempor.</p>
    </div>
  </div>
</section>

<!-- SECTION 07 — FEATURE CARDS (stacked: text + large icon, alternating) -->
<section class="features" id="services">
  <span class="section-watermark" aria-hidden="true">Services</span>
  <div class="brewco-container">
    <div class="section-head" data-reveal>
      <span class="eyebrow">What We Do</span>
      <h2>Lorem ipsum <span class="text-accent">dolor sit amet</span></h2>
    </div>
    <div class="feature-list">
      <article class="featurecard" data-reveal>
        <div class="featurecard__body">
          <h3>Lorem Ipsum Dolor</h3>
          <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
          <ul class="checklist">
            <li>Lorem ipsum dolor sit amet</li>
            <li>Consectetur adipiscing elit</li>
            <li>Sed do eiusmod tempor</li>
          </ul>
        </div>
        <div class="featurecard__icon" aria-hidden="true">◇</div>
      </article>
      <article class="featurecard" data-reveal data-reveal-delay="80">
        <div class="featurecard__body">
          <h3>Consectetur Elit</h3>
          <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
          <ul class="checklist">
            <li>Lorem ipsum dolor sit amet</li>
            <li>Consectetur adipiscing elit</li>
            <li>Sed do eiusmod tempor</li>
          </ul>
        </div>
        <div class="featurecard__icon" aria-hidden="true">△</div>
      </article>
      <article class="featurecard" data-reveal data-reveal-delay="160">
        <div class="featurecard__body">
          <h3>Sed Do Eiusmod</h3>
          <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
          <ul class="checklist">
            <li>Lorem ipsum dolor sit amet</li>
            <li>Consectetur adipiscing elit</li>
            <li>Sed do eiusmod tempor</li>
          </ul>
        </div>
        <div class="featurecard__icon" aria-hidden="true">○</div>
      </article>
    </div>
  </div>
</section>

<!-- SECTION 08 — PHOTO CTA (full-bleed image) -->
<section class="photocta">
  <div class="photocta__bg" data-parallax="0.08">
    <img src="<?php echo $A; ?>img/placeholder.svg" alt="" aria-hidden="true">
    <div class="photocta__overlay"></div>
  </div>
  <div class="brewco-container photocta__content" data-reveal>
    <span class="eyebrow eyebrow--light">Lorem ipsum · dolor sit amet</span>
    <h2>Lorem ipsum.<br>Dolor sit amet.</h2>
    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor.</p>
    <a href="#contact" class="btn btn--gold btn--lg">Get Started</a>
  </div>
</section>

<!-- SECTION 09 — COMPARISON (animated line chart) -->
<section class="compare" id="compare">
  <div class="brewco-container">
    <div class="section-head" data-reveal>
      <span class="eyebrow">Why Choose Us</span>
      <h2>Lorem ipsum <span class="text-accent">dolor sit amet</span></h2>
    </div>
    <div class="chart" data-reveal>
      <svg class="chart__svg" viewBox="0 0 820 380" role="img" aria-label="New Wave vs Others over time">
        <!-- grid -->
        <g class="chart__grid">
          <line x1="60" y1="40"  x2="60"  y2="320"></line>
          <line x1="60" y1="320" x2="800" y2="320"></line>
          <line x1="60" y1="110" x2="800" y2="110"></line>
          <line x1="60" y1="180" x2="800" y2="180"></line>
          <line x1="60" y1="250" x2="800" y2="250"></line>
        </g>
        <!-- Others: flat / declining -->
        <polyline class="chart__line chart__line--them"
          points="60,250 200,255 340,262 480,270 620,285 800,300"></polyline>
        <!-- New Wave: rising -->
        <polyline class="chart__line chart__line--us"
          points="60,300 200,255 340,215 480,160 620,110 800,60"></polyline>
        <circle class="chart__dot chart__dot--us" cx="800" cy="60" r="7"></circle>
        <circle class="chart__dot chart__dot--them" cx="800" cy="300" r="7"></circle>
        <text class="chart__axis" x="60" y="344">Start</text>
        <text class="chart__axis" x="800" y="344" text-anchor="end">Now</text>
        <text class="chart__axis" x="20" y="185" transform="rotate(-90 20 185)" text-anchor="middle">Results</text>
        <text class="chart__lbl chart__lbl--us" x="792" y="46" text-anchor="end">New Wave</text>
        <text class="chart__lbl chart__lbl--them" x="792" y="322" text-anchor="end">The Old Way</text>
      </svg>
      <div class="chart__legend">
        <span class="chart__key chart__key--us">New Wave</span>
        <span class="chart__key chart__key--them">The Old Way</span>
      </div>
    </div>
  </div>
</section>

<!-- SECTION 10 — PRICING (single product) -->
<section class="pricing" id="pricing">
  <div class="brewco-container">
    <div class="section-head" data-reveal>
      <span class="eyebrow">Simple Pricing</span>
      <h2>Lorem ipsum <span class="text-accent">in one plan</span></h2>
    </div>
    <div class="product" data-reveal>
      <div class="product__media"><img src="<?php echo $A; ?>img/placeholder.svg" alt="Product"></div>
      <div class="product__card">
        <span class="product__badge">Most Popular</span>
        <h3 class="product__name">The Complete Plan</h3>
        <div class="product__price"><span class="plan__cur">$</span>114<span class="plan__per">/mo</span><span class="product__was">$149</span></div>
        <ul class="checklist">
          <li>Lorem ipsum dolor sit amet</li>
          <li>Consectetur adipiscing elit</li>
          <li>Sed do eiusmod tempor</li>
          <li>Incididunt ut labore</li>
        </ul>
        <a href="#contact" class="btn btn--gold btn--block btn--lg">Get Started</a>
        <p class="product__note">Lorem ipsum · cancel anytime · no hidden fees</p>
      </div>
    </div>
  </div>
</section>

<!-- SECTION 11 — HOW IT WORKS (gradient step cards) -->
<section class="how" id="how">
  <div class="brewco-container">
    <div class="section-head" data-reveal>
      <span class="eyebrow">How It Works</span>
      <h2>Lorem ipsum dolor sit <span class="text-accent">amet consectetur</span></h2>
    </div>
    <div class="bento">
      <div class="bento__cell bento__cell--lg" data-reveal>
        <span class="bento__step">Step 1</span>
        <div class="bento__glow"></div>
        <h3>Choose Your Program</h3>
        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt.</p>
      </div>
      <div class="bento__cell" data-reveal data-reveal-delay="100">
        <span class="bento__step">Step 2</span>
        <div class="bento__glow"></div>
        <h3>Get Matched</h3>
        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
      </div>
      <div class="bento__cell" data-reveal data-reveal-delay="200">
        <span class="bento__step">Step 3</span>
        <div class="bento__glow"></div>
        <h3>Start Today</h3>
        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
      </div>
    </div>
  </div>
</section>

<!-- SECTION 12 — TESTIMONIALS (marquee) -->
<section class="testimonials">
  <div class="brewco-container">
    <div class="section-head" data-reveal>
      <span class="eyebrow">Testimonials</span>
      <h2>Trusted by <span class="text-accent">10,000+</span> clients</h2>
    </div>
  </div>
  <div class="marquee marquee--cards" data-marquee data-reveal>
    <div class="marquee__track">
      <figure class="review">
        <div class="stars">★★★★★</div>
        <blockquote>“Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt.”</blockquote>
        <figcaption><img src="<?php echo $A; ?>img/avatar.svg" alt=""><span><strong>Jane Doe</strong>Client</span></figcaption>
      </figure>
      <figure class="review">
        <div class="stars">★★★★★</div>
        <blockquote>“Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor.”</blockquote>
        <figcaption><img src="<?php echo $A; ?>img/avatar.svg" alt=""><span><strong>John Smith</strong>Client</span></figcaption>
      </figure>
      <figure class="review">
        <div class="stars">★★★★★</div>
        <blockquote>“Lorem ipsum dolor sit amet, consectetur adipiscing elit.”</blockquote>
        <figcaption><img src="<?php echo $A; ?>img/avatar.svg" alt=""><span><strong>Amy Lee</strong>Client</span></figcaption>
      </figure>
      <figure class="review">
        <div class="stars">★★★★★</div>
        <blockquote>“Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt.”</blockquote>
        <figcaption><img src="<?php echo $A; ?>img/avatar.svg" alt=""><span><strong>Carlos Ruiz</strong>Client</span></figcaption>
      </figure>
      <!-- duplicate set for seamless loop -->
      <figure class="review">
        <div class="stars">★★★★★</div>
        <blockquote>“Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt.”</blockquote>
        <figcaption><img src="<?php echo $A; ?>img/avatar.svg" alt=""><span><strong>Jane Doe</strong>Client</span></figcaption>
      </figure>
      <figure class="review">
        <div class="stars">★★★★★</div>
        <blockquote>“Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor.”</blockquote>
        <figcaption><img src="<?php echo $A; ?>img/avatar.svg" alt=""><span><strong>John Smith</strong>Client</span></figcaption>
      </figure>
      <figure class="review">
        <div class="stars">★★★★★</div>
        <blockquote>“Lorem ipsum dolor sit amet, consectetur adipiscing elit.”</blockquote>
        <figcaption><img src="<?php echo $A; ?>img/avatar.svg" alt=""><span><strong>Amy Lee</strong>Client</span></figcaption>
      </figure>
      <figure class="review">
        <div class="stars">★★★★★</div>
        <blockquote>“Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt.”</blockquote>
        <figcaption><img src="<?php echo $A; ?>img/avatar.svg" alt=""><span><strong>Carlos Ruiz</strong>Client</span></figcaption>
      </figure>
    </div>
  </div>
</section>

<!-- SECTION 13 — FINAL CTA -->
<section class="finalcta" id="contact">
  <div class="brewco-container finalcta__inner" data-reveal>
    <h2>Lorem ipsum dolor sit amet <span class="text-accent">consectetur adipiscing</span></h2>
    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor.</p>
    <a href="#" class="btn btn--gold btn--lg">Find Your Perfect Program</a>
    <div class="trustbadge"><span class="stars">★★★★★</span> Excellent 4.9 out of 5 · Trustpilot</div>
  </div>
</section>

</main>

<!-- SECTION 14 — FOOTER -->
<footer class="footer">
  <div class="brewco-container">
    <div class="footer__features" data-reveal>
      <div class="feature"><span class="feature__icon">◈</span><div><strong>Lorem Ipsum</strong><span>Dolor sit amet consectetur</span></div></div>
      <div class="feature"><span class="feature__icon">✆</span><div><strong>24/7 Support</strong><span>One-on-one guidance</span></div></div>
      <div class="feature"><span class="feature__icon">✔</span><div><strong>Guaranteed</strong><span>Money-back promise</span></div></div>
    </div>

    <div class="footer__main">
      <div class="footer__brand">
        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt.</p>
        <div class="footer__pills">
          <a href="#" class="pill pill--contact">✉ hello@brewco.com</a>
          <a href="#" class="pill pill--contact">✆ (000) 000-0000</a>
        </div>
      </div>
      <nav class="footer__nav">
        <div><h4>Company</h4><a href="#services">Services</a><a href="#approach">Approach</a><a href="#work">Work</a><a href="#pricing">Pricing</a></div>
        <div><h4>Explore</h4><a href="#services">What We Do</a><a href="#how">How It Works</a><a href="#pricing">Pricing</a><a href="#contact">Contact</a></div>
        <div><h4>Legal</h4><a href="#">Terms &amp; Conditions</a><a href="#">Privacy Policy</a><a href="#">Refund Policy</a><a href="#">Contact</a></div>
      </nav>
    </div>

    <div class="footer__bottom">
      <span>© 2026 Brewco Marketing Group. All rights reserved.</span>
      <span>Made with care.</span>
    </div>
  </div>
</footer>
