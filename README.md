# Brewco Marketing Group — Landing

A custom-coded landing page whose structure and animations mirror a reference
layout ([quad.medvi.org](https://quad.medvi.org/)). Shipped as a
**self-contained WordPress plugin** that registers a "Brewco Landing" page
template, and **auto-deploys to WP Engine over SSH on every push.**

This repo is a rebrand of New Wave Creative's landing template. The section
layout and animation layer are shared; the branding and copy are being adapted
to Brewco Marketing Group.

> **Status — placeholders in place, pending Brewco assets.**
> - **Copy:** Lorem Ipsum, to be rewritten to match Brewco's actual services.
> - **Logo:** placeholder wordmarks in `assets/logo.svg` / `logo-white.svg`.
> - **Colors/fonts:** the `:root` block in `styles.css` still carries the New
>   Wave palette as a temporary placeholder — to be replaced with Brewco's brand
>   colors and typefaces once pulled from [brewco.com](https://www.brewco.com/).

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
  template-parts/landing.php       the section blocks (edit copy/images here)
  assets/
    css/styles.css                 design system (brand vars) + all styles
    js/main.js                     animation layer (Lenis smooth scroll + reveals)
    js/lenis.min.js                bundled Lenis library
    logo.svg / logo-white.svg      placeholder wordmarks
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

## Editing

- **Copy & images:** `brewco-landing/template-parts/landing.php`
- **Look, scroll, layering, animation:** `brewco-landing/assets/css/styles.css`
  and `brewco-landing/assets/js/main.js`
- **Colors/fonts:** the `:root` block at the top of `styles.css`

Asset URLs auto cache-bust on deploy (the plugin versions them with `filemtime`),
so changes show up on a normal refresh.

## Local preview (for development)

There's no build step. To eyeball changes without WordPress, generate a static
preview from the partial:

```bash
{
  echo '<!doctype html><html><head><meta charset=utf-8><meta name=viewport content="width=device-width,initial-scale=1">'
  echo '<link rel=stylesheet href="brewco-landing/assets/css/styles.css"></head><body>'
  sed -n '/<!-- SECTION 01/,$p' brewco-landing/template-parts/landing.php | sed 's#<?php echo \$A; ?>#brewco-landing/assets/#g'
  echo '<script src="brewco-landing/assets/js/lenis.min.js"></script>'
  echo '<script src="brewco-landing/assets/js/main.js"></script></body></html>'
} > preview.html   # gitignored; open in a browser
```
