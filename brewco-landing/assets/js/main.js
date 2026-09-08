/* =============================================================
   New Wave Creative — Landing Template
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
  var heroImg = document.querySelector('.hero__bg video, .hero__bg img');
  // Reduced-motion: hold the hero video on its poster frame instead of looping.
  if (reduce) {
    var hv = document.querySelector('.hero__bg video');
    if (hv) { hv.removeAttribute('autoplay'); hv.pause && hv.pause(); }
  }
  if (!reduce && (parallaxEls.length || rotateEls.length || heroImg)) {
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
      if (heroImg) {
        var hy = window.scrollY;
        if (hy < vh * 1.3) {
          heroImg.style.transform =
            'translate3d(0,' + (hy * 0.28).toFixed(1) + 'px,0) scale(' + (1 + hy * 0.00035).toFixed(4) + ')';
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
