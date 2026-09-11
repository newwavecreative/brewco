/* =============================================================
   Brewco Marketing Group — Landing Template
   Animation layer. Vanilla JS, no dependencies. Loaded once globally.
   Mirrors the reference's Framer-Motion feel with:
     - scroll reveals (IntersectionObserver)
     - transparent -> solid navbar on scroll
     - mobile menu toggle
     - parallax translate on scroll
     - flip cards (click / keyboard)
     - count-up stats
   All effects no-op gracefully under prefers-reduced-motion.
   ============================================================= */
(function () {
  'use strict';
  var reduce = window.matchMedia('(prefers-reduced-motion: reduce)').matches;

  /* ---------- 1. Scroll reveal ---------- */
  var reveals = document.querySelectorAll('[data-reveal]');
  if (reduce) {
    reveals.forEach(function (el) { el.classList.add('is-in'); });
  } else if ('IntersectionObserver' in window) {
    var io = new IntersectionObserver(function (entries) {
      entries.forEach(function (entry) {
        if (!entry.isIntersecting) return;
        var el = entry.target;
        var delay = parseInt(el.getAttribute('data-reveal-delay') || '0', 10);
        setTimeout(function () { el.classList.add('is-in'); }, delay);
        io.unobserve(el);
      });
    }, { threshold: 0.14, rootMargin: '0px 0px -8% 0px' });
    reveals.forEach(function (el) { io.observe(el); });
  } else {
    reveals.forEach(function (el) { el.classList.add('is-in'); });
  }

  /* ---------- 2. Navbar solid-on-scroll ---------- */
  var nav = document.querySelector('[data-nav]');
  if (nav) {
    var onScrollNav = function () {
      nav.classList.toggle('is-scrolled', window.scrollY > 40);
    };
    onScrollNav();
    window.addEventListener('scroll', onScrollNav, { passive: true });
  }

  /* ---------- 3. Mobile menu ---------- */
  var toggle = document.querySelector('[data-menu-toggle]');
  if (toggle && nav) {
    toggle.addEventListener('click', function () {
      var open = nav.classList.toggle('is-open');
      toggle.setAttribute('aria-expanded', String(open));
    });
    nav.querySelectorAll('[data-mobile-menu] a').forEach(function (a) {
      a.addEventListener('click', function () {
        nav.classList.remove('is-open');
        toggle.setAttribute('aria-expanded', 'false');
      });
    });
  }

  /* ---------- 4. Parallax + hero zoom + showcase card rotation ---------- */
  var parallaxEls = Array.prototype.slice.call(document.querySelectorAll('[data-parallax]'));
  var rotateEls = Array.prototype.slice.call(document.querySelectorAll('[data-rotate]'));
  var heroMedia = Array.prototype.slice.call(document.querySelectorAll('.hero__bg video, .hero__bg img'));
  // Reduced-motion: hold the hero video on its poster frame instead of looping.
  if (reduce) {
    var hv = document.querySelector('.hero__bg video');
    if (hv) { hv.removeAttribute('autoplay'); hv.pause && hv.pause(); }
  }
  if (!reduce && (parallaxEls.length || rotateEls.length || heroMedia.length)) {
    var ticking = false;
    var applyParallax = function () {
      var vh = window.innerHeight;
      parallaxEls.forEach(function (el) {
        var factor = parseFloat(el.getAttribute('data-parallax')) || 0.1;
        var rect = el.getBoundingClientRect();
        var offset = (rect.top + rect.height / 2 - vh / 2) * -factor;
        el.style.transform = 'translate3d(0,' + offset.toFixed(1) + 'px,0)';
      });
      // Showcase card turns toward the viewer as it scrolls through the viewport.
      rotateEls.forEach(function (el) {
        var rect = el.getBoundingClientRect();
        var progress = 1 - (rect.top + rect.height / 2) / (vh + rect.height); // ~0 entering .. ~1 leaving
        progress = Math.max(0, Math.min(1, progress));
        var rotY = -10 + progress * 16;   // -10deg -> +6deg (subtle)
        el.style.transform = 'rotateY(' + rotY.toFixed(1) + 'deg)';
      });
      // Hero image drifts down and zooms slightly as you scroll past it.
      if (heroMedia.length) {
        var hy = window.scrollY;
        if (hy < vh * 1.3) {
          // Same transform on every slide, or the inactive ones would sit still
          // while the visible one drifts — visible the moment a slide fades in.
          var ht = 'translate3d(0,' + (hy * 0.28).toFixed(1) + 'px,0) scale(' + (1 + hy * 0.00035).toFixed(4) + ')';
          heroMedia.forEach(function (m) { m.style.transform = ht; });
        }
      }
      ticking = false;
    };
    var requestParallax = function () {
      if (!ticking) { window.requestAnimationFrame(applyParallax); ticking = true; }
    };
    window.addEventListener('scroll', requestParallax, { passive: true });
    window.addEventListener('resize', requestParallax);
    applyParallax();
  }

  /* ---------- 3b. Constant-speed marquees ----------
     A CSS marquee has a fixed duration, so its SPEED depends on how much is in
     it — adding clients made the logo bar race. Any .marquee[data-speed] (px/s)
     gets its duration recomputed from the track's width instead, so the pace
     holds steady however many items the page has. A ResizeObserver re-fits it
     when the web font or the logos finish loading and change the width.
     Marquees without data-speed keep their CSS duration untouched. */
  var speedMarquees = Array.prototype.slice.call(document.querySelectorAll('.marquee[data-speed]'));
  if (speedMarquees.length && !reduce) {
    speedMarquees.forEach(function (mq) {
      var track = mq.querySelector('.marquee__track');
      var speed = parseFloat(mq.getAttribute('data-speed'));
      if (!track || !isFinite(speed) || speed <= 0) { return; }
      var lastLoop = 0;
      var fit = function () {
        // The track holds two identical sets and animates by -50%,
        // so one loop travels half its width.
        var loop = track.offsetWidth / 2;
        if (!loop || Math.abs(loop - lastLoop) < 1) { return; }
        lastLoop = loop;
        track.style.animationDuration = (loop / speed).toFixed(2) + 's';
      };
      fit();
      if ('ResizeObserver' in window) {
        new ResizeObserver(function () { window.requestAnimationFrame(fit); }).observe(track);
      } else {
        window.addEventListener('load', fit);
        window.addEventListener('resize', fit);
      }
    });
  }

  /* ---------- 4a. Hero background slideshow ----------
     Cross-fades the stacked .hero__slide images. Only runs with 2+ slides, so a
     single-image hero is untouched. Under reduced-motion it holds slide 1.
     Pauses while the tab is hidden — no point burning timers in the background. */
  var heroSlides = Array.prototype.slice.call(document.querySelectorAll('.hero__bg .hero__slide'));
  if (heroSlides.length > 1 && !reduce) {
    var heroBg = document.querySelector('.hero__bg');
    var slideSecs = parseFloat(heroBg && heroBg.getAttribute('data-slide-seconds'));
    if (!isFinite(slideSecs) || slideSecs < 2) { slideSecs = 6; }

    var slideIdx = 0;
    for (var si = 0; si < heroSlides.length; si++) {
      if (heroSlides[si].classList.contains('is-active')) { slideIdx = si; break; }
    }

    var slideTimer = null;
    var advanceSlide = function () {
      heroSlides[slideIdx].classList.remove('is-active');
      slideIdx = (slideIdx + 1) % heroSlides.length;
      heroSlides[slideIdx].classList.add('is-active');
    };
    var startSlides = function () {
      if (!slideTimer) { slideTimer = window.setInterval(advanceSlide, slideSecs * 1000); }
    };
    var stopSlides = function () {
      if (slideTimer) { window.clearInterval(slideTimer); slideTimer = null; }
    };
    document.addEventListener('visibilitychange', function () {
      if (document.hidden) { stopSlides(); } else { startSlides(); }
    });
    startSlides();
  }

  /* ---------- 4b. Lenis smooth scroll (the library the reference/Framer uses) ----------
     Tuning knobs:
       lerp           0.1  -> smoothing; LOWER = smoother/slower, HIGHER = snappier
       wheelMultiplier 1   -> scroll distance per wheel notch
     Off under reduced-motion (native scroll). Native scroll events still fire,
     so the reveal + parallax effects above keep working. */
  if (!reduce && typeof window.Lenis === 'function') {
    var lenis = new window.Lenis({ lerp: 0.1, wheelMultiplier: 1, smoothWheel: true });
    window.__nwcLenis = lenis;
    (function raf(t){ lenis.raf(t); window.requestAnimationFrame(raf); })(0);
    // Smooth in-page anchor links (#services, etc.), offset for the fixed nav.
    document.querySelectorAll('a[href^="#"]').forEach(function (a) {
      a.addEventListener('click', function (e) {
        var id = a.getAttribute('href');
        if (id.length > 1) {
          var target = document.querySelector(id);
          if (target) { e.preventDefault(); lenis.scrollTo(target, { offset: -76 }); }
        }
      });
    });
  }

  /* ---------- 5. Flip cards ---------- */
  document.querySelectorAll('[data-flip]').forEach(function (card) {
    card.setAttribute('tabindex', '0');
    card.setAttribute('role', 'button');
    var flip = function () { card.classList.toggle('is-flipped'); };
    card.addEventListener('click', flip);
    card.addEventListener('keydown', function (e) {
      if (e.key === 'Enter' || e.key === ' ') { e.preventDefault(); flip(); }
    });
  });

  /* ---------- 6. Count-up stats ---------- */
  var counters = document.querySelectorAll('[data-count]');
  var runCount = function (el) {
    var target = parseFloat(el.getAttribute('data-count')) || 0;
    if (reduce) { el.textContent = target.toLocaleString(); return; }
    var dur = 1600, start = null;
    var step = function (ts) {
      if (!start) start = ts;
      var p = Math.min((ts - start) / dur, 1);
      var eased = 1 - Math.pow(1 - p, 3); // easeOutCubic
      el.textContent = Math.floor(eased * target).toLocaleString();
      if (p < 1) requestAnimationFrame(step);
      else el.textContent = target.toLocaleString();
    };
    requestAnimationFrame(step);
  };
  if ('IntersectionObserver' in window && counters.length) {
    var cio = new IntersectionObserver(function (entries) {
      entries.forEach(function (entry) {
        if (!entry.isIntersecting) return;
        runCount(entry.target);
        cio.unobserve(entry.target);
      });
    }, { threshold: 0.5 });
    counters.forEach(function (el) { cio.observe(el); });
  } else {
    counters.forEach(runCount);
  }
})();
