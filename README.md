# Brewco Marketing Group — Landing

A custom-coded landing page whose structure and animations mirror a reference
layout ([quad.medvi.org](https://quad.medvi.org/)). Shipped as a
**self-contained WordPress plugin** that registers a "Brewco Landing" page
template, and **auto-deploys to WP Engine over SSH on every push.**

This repo is a rebrand of New Wave Creative's landing template. The section
layout and animation layer are shared; the branding and copy are being adapted
to Brewco Marketing Group.

> **Status — branded from brewco.com (Sept 2026). Imagery still outstanding.**
> - **Copy:** real, sourced from brewco.com's "Who We Are", "What We Do",
>   "Vehicles" and "Contact" pages. Nothing is invented.
> - **Logo:** the real Brewco wordmark (`assets/logo.png`, plus a reversed
>   `logo-white.png` generated from it) pulled from brewco.com.
> - **Colors/fonts:** the `:root` block in `styles.css` now carries Brewco's
>   navy (`#25355A`), the logo's deeper navy (`#0E103C`), and Cero Pro Light,
>   which is loaded via `@font-face` from the site's own uploads directory.
> - **Still to do:** photography. Every `<img>` is still `placeholder.svg` —
>   brewco.com serves its photos through a JS gallery, so none were pulled.
>   Grep the markup for `CONFIRM:` to find every open question.

### What changed from the New Wave template

Three sections were rebuilt rather than reworded, because the template's
versions made claims Brewco cannot support:

| Template section | Replaced with | Why |
| --- | --- | --- |
| "Us vs. The Old Way" line chart | **Vehicles** — the real fleet list | The chart plotted an unlabelled "results over time" trend with no data behind it. |
| `$114/mo` pricing card | **Get a Custom Quote** — the four real offices | Brewco quotes every project to spec; their own CTA is a no-cost consultation. |
| Testimonial marquee (Jane Doe et al.) | **Partner stories** — IBM, McDonald's, PSEG, MLB, Texas DEM | No real testimonials exist, and invented quotes attributed to named people are not an option. The partner stories are brewco.com's own words. |

Also removed: the 4.9/Trustpilot rating badges, the "USA Made" pill, and the
12,000 members / 48 programs / 99% satisfaction stats — all inherited from the
MEDVi reference layout. The stats row now shows three figures that are
verifiable on brewco.com: 25 years, 100% employee-owned, 4 offices.

> **One open branding question.** brewco.com's palette is strictly
> navy/white/gray — it has no high-contrast call-to-action color. CTAs here use
> copper (`--cta` / `--accent`), which is currently live on brewco.com only in
> the chat widget. Confirm it with the client, or repoint those two variables.

## Why a plugin (not a Beaver Builder layout or a child theme)

- A **page template in a child theme** only works if that theme is active
  site-wide — it would take over the whole site.
- A **plugin** registers just the one template and loads its CSS/JS **only on
  pages using it**, leaving the rest of the site untouched.
- Everything (markup + CSS + JS + assets) lives in the repo, so updates flow
  through Git instead of copy/paste.

## Repo layout

```
brewco-landing/                  ← the plugin (this whole folder is deployed)
  brewco-landing.php               main file: registers template + enqueues assets
  templates/landing-template.php   full-page document (own nav/footer, wp_head/footer)
  template-parts/landing.php       the section blocks (markup + fallback copy)
  inc/fields.php                   ACF field group (registered in PHP)
  inc/helpers.php                  field accessors, each with a shipped fallback
  assets/
    css/styles.css                 design system (brand vars) + all styles
    js/main.js                     animation layer (Lenis smooth scroll + reveals)
    js/lenis.min.js                bundled Lenis library
    logo.png / logo-white.png      the real Brewco wordmark (+ reversed)
    img/placeholder.svg, avatar.svg
.github/workflows/deploy.yml     ← WP Engine SSH deploy on push
```

## One-time setup (WP Engine deploy)

**1. Create a deploy SSH key** (dedicated to this — keep it separate from your
personal key):

```bash
ssh-keygen -t ed25519 -f wpe_deploy -C "github-actions-brewco" -N ""
```

**2. Add the PUBLIC key to WP Engine:** User Portal → *Profile → SSH Keys* →
paste the contents of `wpe_deploy.pub`. (This is the SSH *Gateway* key, not a
GitPush key. Also make sure *SSH Gateway* is enabled on the environment.)

**3. Add the PRIVATE key to GitHub:** repo → *Settings → Secrets and variables →
Actions → New repository secret*:
- Name: `WPE_SSHG_KEY_PRIVATE`
- Value: the full contents of `wpe_deploy` (the private file)

**4. Add your environment name to GitHub:** same page → *Variables* tab → *New
repository variable*:
- Name: `WPE_ENV`
- Value: the Brewco WP Engine install name (e.g. `brewco`, or a staging
  install). Until this is set, the workflow uses a placeholder fallback and the
  deploy will fail.

Then delete the local key files. Every push to `main` or the working branch
rsyncs `brewco-landing/` into `wp-content/plugins/brewco-landing/`.

## One-time setup (WordPress)

1. **Plugins → Installed Plugins →** activate **"Brewco Marketing Group —
   Landing."** (Activating a plugin does *not* change your theme.)
2. **Pages → Add New →** in *Page Attributes → Template*, choose **"Brewco
   Landing."** Publish. That page now renders the landing template.
3. Upload the logo + images to the **Media Library** and point the `<img src>`
   values in `template-parts/landing.php` at their URLs (or just replace the
   bundled SVGs in `assets/` with same-named files).

## Editing the content (ACF)

Page copy is driven by an **ACF Pro** field group, so the client edits it in the
page editor rather than in PHP.

- **Field definitions:** `brewco-landing/inc/fields.php`
- **Accessors:** `brewco-landing/inc/helpers.php`
- **Markup:** `brewco-landing/template-parts/landing.php`

Three things worth knowing before you touch it:

**The field group is registered in PHP, not built in the admin.** It uses
`acf_add_local_field_group()`, so the fields live in version control and deploy
with the plugin. A group created through the ACF admin UI would live only in
that install's database — present on production, absent everywhere else, and
free to drift. The trade-off is that the group shows as read-only in the ACF
admin: **edit `inc/fields.php`, not the UI.**

**Every field falls back to the copy the template shipped with.** ACF's
`default_value` only fires when a post is *created*, so an existing page comes
back with every field empty. The accessors take the original string as a
fallback (`brewco_field( 'hero_cta_label', 'Get a Custom Quote' )`), which
means the page renders exactly as it shipped until someone deliberately
overrides a field — and still renders if ACF is ever deactivated. Verified: with
ACF off, the output is text- and structure-identical to the deployed version.

**Two-tone headings are two fields.** The copper accent is a separate
`*_heading_accent` field rather than a `<span>` typed into the editor, so no one
has to write HTML to get "Award-Winning *Experiential Brand Strategy*". The
accent always renders after the plain part.

Repeaters cover the client bar, stats, services, vehicles, offices,
stories, footer highlights and social links. The two marquees (clients and
partner stories) **emit their track twice in PHP** for the seamless loop — add
each item once; the duplicate is generated. Short bullet lists inside a service
card are a textarea, one item per line.

All output is escaped (`esc_html` / `esc_url` / `esc_attr`). Field values cannot
inject markup.

## Editing (structural)

- **Copy & images:** the page editor (see above). The fallbacks live in
  `brewco-landing/template-parts/landing.php`
- **Nav labels, section eyebrows, footer legal:** deliberately *not* fields —
  they never change; edit `template-parts/landing.php`
- **Look, scroll, layering, animation:** `brewco-landing/assets/css/styles.css`
  and `brewco-landing/assets/js/main.js`
- **Colors/fonts:** the `:root` block at the top of `styles.css`
- **Hero scrim (the darkening over the background):** five variables at the top
  of `styles.css` — `--hero-scrim-top` / `--hero-scrim-bottom` /
  `--hero-scrim-left` control the main gradient, and `--hero-nav-scrim` /
  `--hero-nav-scrim-h` a top-only band that keeps the white logo and nav links
  legible over bright photography. Set `--hero-nav-scrim` to `0` to drop it.
  Raise the scrim values if a bright image makes the headline hard to read;
  lower them to show more of the photo.
- **Client logo bar:** each row in *Client bar → Clients* takes a logo and a
  name. The name is the logo's alt text, and is shown as text instead when no
  logo is uploaded — so logos can be added one at a time. Logos share one height
  (`--logo-h`) with a width cap (`--logo-max-w`); horizontal logos read best,
  and a tall stacked logo will come out narrow. Logos display 55px tall, so
  upload at roughly twice that (~110px+) to stay sharp on high-density screens.
  **Crop each PNG tight to the mark** — empty margin baked into the file is
  drawn as part of the logo, so a padded file looks smaller than its
  neighbours at the same height. Full
  colour by default; `--logo-filter: grayscale(1)` + `--logo-opacity: .6` gives
  a muted strip that colours on hover. WordPress blocks SVG uploads without an
  SVG plugin — use transparent PNGs.
- **Marquee speed:** the client bar scrolls at a *constant* 66 px/s
  (`data-speed="66"` in the markup). A CSS marquee's speed otherwise depends on
  how much is in it, so adding clients made it race; `main.js` now recomputes
  the duration from the track's width. Change the number to change the pace.
  The partner-stories marquee still uses its fixed CSS duration.
- **Service image slide:** service card images drift in from the side they sit
  on as the card scrolls up (the cards alternate, so odd cards enter from the
  right, even from the left). It is scroll-linked, not a one-shot animation:
  `SLIDE_PX` in `main.js` sets the distance, the `0.35` beside it the pace. The
  cards don't clip it (the images overlap the card edge on wide screens, see
  below), so it's visible outside the card; the section still clips it at the
  page edge. Off below 821px, where the layout stacks and images are centred,
  and off under `prefers-reduced-motion`.
- **Partner-story logos:** each story in *Partner stories → Stories* takes a
  logo, which replaces the brand name at the top of the card. The brand name
  becomes the logo's alt text, and still shows as text when no logo is
  uploaded. Card headers are held to the logo height (`--story-logo-h`) even
  for text brands, so quotes stay level in a mixed set.
- **Vehicle links:** each row in *Vehicles → Vehicle types* has a *Link*.
  With a link the pill is clickable (and gets the hover lift); without one it's
  a plain pill. The built-in list links all ten to brewco.com's
  `/vehicles/…/` pages. The Link is a plain text field rather than ACF's URL
  field on purpose: ACF's URL type rejects root-relative paths like
  `/vehicles/box-trucks/`.
- **Blank rows are ignored.** Any list (clients, services, vehicles, offices,
  stories…) skips rows with nothing in them, and falls back to the built-in
  content if no real rows remain — so a stray empty "Add row" can't blank out a
  section.
- **Service card images:** each service takes an *Image* plus an *Image fit* —
  **Fill** crops a photo to the square's edges, **Fit** keeps an icon or logo
  whole with space around it. With no image, the card falls back to its glyph.
  Images are 330px squares (`--svc-img` in `styles.css`). From 1181px wide they
  break out past the card's outer edge by 65px, with a shadow, while the text
  column stays put; from 901–1180px the image column grows to fit them inside
  the card instead.
- **Hero slideshow:** add two or more images to the *Hero → Background
  slideshow* gallery field and they cross-fade; one image just sits still.
  *Seconds per slide* sets the interval, `--hero-fade` the fade length. It
  pauses while the browser tab is hidden and holds on the first slide under
  `prefers-reduced-motion`. The single *Background image (fallback)* field is
  only used when the gallery is empty.
- **Hero background video:** an MP4 in *Hero → Background video* plays
  silently on a loop in place of the slideshow; remove it to get the slideshow
  back. It is a plain `<video>` on a Media Library file, not a Vimeo embed, so
  there's no player to load and it starts as soon as the first part of the file
  arrives. Keep files under ~15 MB at 720p–1080p, exported with the index at
  the front ("fast start" — most exports do this; check with `ffprobe` or an
  atom viewer if a video waits to fully download before playing). *Video still*
  shows while it loads, when a phone blocks autoplay (e.g. iPhone Low Power
  Mode), and instead of the video under `prefers-reduced-motion` — the
  `<source>` only matches with reduced motion off, so current browsers don't
  request the file at all (`main.js` resets to the still in any that ignore
  that). Leave it empty to use the first slideshow image.
- **Photo banner ("Millions of miles."):** 200px taller than its original
  `70vh`. The section's `min-height` and the content's top padding both carry
  the extra, so it gains the full 200px at any screen size, as space above the
  text. Its background zooms in as the section scrolls past, at the hero's rate
  (`ZOOM_PER_PX` in `main.js`); any `<img data-scroll-zoom>` gets the effect.
  Off under `prefers-reduced-motion`.
- **Get Started (quote & offices)** is the last section and the page's call to
  action. It carries `id="contact"`, so every *Get a Custom Quote* button lands
  on it, and its own button goes to the contact page (*Quote & offices → Button
  link*, default `/contact/`, also used by the footer's *Contact Us*). It's white
  so it doesn't merge with the gray partner stories and footer around it. How It
  Works and the closing "Let's get started" band were removed.

Asset URLs auto cache-bust on deploy (the plugin versions them with `filemtime`),
so changes show up on a normal refresh.

## Local preview (for development)

There's no build step, but the partial calls `brewco_landing_asset()` and
`esc_html()`, so it needs those stubbed. Render it with a small harness:

```bash
cat > /tmp/render.php <<'EOF'
<?php
$root = getcwd();   // run this from the repo root
define('ABSPATH', $root);
function brewco_landing_asset($f){ return 'brewco-landing/assets/'.$f; }
function esc_html($s){ return htmlspecialchars($s, ENT_QUOTES); }
$A = 'brewco-landing/assets/';
ob_start(); include $root.'/brewco-landing/template-parts/landing.php'; $body = ob_get_clean();
echo '<!doctype html><html lang="en"><head><meta charset="utf-8">'
   . '<meta name="viewport" content="width=device-width,initial-scale=1">'
   . '<link rel="stylesheet" href="brewco-landing/assets/css/styles.css"></head><body>'
   . $body
   . '<script src="brewco-landing/assets/js/lenis.min.js"></script>'
   . '<script src="brewco-landing/assets/js/main.js"></script></body></html>';
EOF
php /tmp/render.php > preview.html   # gitignored
php -S 127.0.0.1:8477 -t .           # then open http://127.0.0.1:8477/preview.html
```

Serve it over HTTP rather than opening the file directly — `file://` renders as
a static snapshot with no CSS. One 404 is expected locally: the Cero Pro font is
loaded from `/wp-content/uploads/useanyfont/`, which only exists on the live
WordPress install. Everything else should be a 200.
