# travelJournal — Minimal WordPress Theme

A lightweight starter theme for a travel blog / magazine style site. Includes a simple layout, responsive hero/featured blocks, and a few common templates to get started.

## Features

- Basic template files: `index.php`, `single.php`, `page.php`, `archive.php`, `404.php`, `comments.php`, `sidebar.php`
- Template parts: `template-parts/header/site-branding.php`, `template-parts/navigation/navigation-primary.php`
- Registered menu location: `Primary Menu`
- Widget area: `Primary Sidebar`
- Custom image sizes for featured media (added in `functions.php`)
- Simple CSS in `style.css` and placeholder `screenshot.png`

## Installed image sizes

When you upload images WordPress will generate the following theme sizes (registered in `functions.php`):

- `featured-xxl` — 2000×1200
- `featured-xl` — 1600×1000
- `featured-large` — 1400×900
- `featured-medium` — 800×500
- `featured-card` — 600×400
- `featured-landscape` — 1200×675
- `featured-portrait` — 600×900
- `featured-small` — 400×250
- `featured-thumb` — 150×150

Note: regenerate thumbnails to create these sizes for existing uploads: `wp media regenerate` or use a plugin like "Regenerate Thumbnails".

## Installation

1. Copy the `travelJournal` folder into your WordPress site's `wp-content/themes/` folder.
2. Activate the theme from WP Admin → Appearance → Themes.
3. Assign the Primary Menu at WP Admin → Appearance → Menus and set the menu location to "Primary Menu".
4. (Optional) Add widgets at WP Admin → Appearance → Widgets to the "Primary Sidebar".

## Loop / Layout

The index template uses a repeating 4-item pattern per row: large, two small side-by-side, large — and repeats. `index.php` uses theme image sizes and falls back to `screenshot.png` when a post has no featured image.

## Related posts

`single.php` includes a dynamic related-posts query that attempts to show up to 3 posts from the same categories as the current post and falls back to recent posts when none are available.

## Scripts & styles

- Bootstrap CSS/JS are included via CDN in `header.php`/`footer.php`.
- Theme stylesheet is enqueued in `functions.php` as `traveljournal-style`.

## Development

- Git remote: https://github.com/timothyblake/travelJournal.git
- To regenerate image sizes locally: `wp media regenerate`

## License

This theme is released under the GNU General Public License v2 or later. See `style.css` header for license details.

---

If you want, I can:
- Add a `.gitignore` and composer/npm setup
- Extract template parts for content blocks
- Add a block-based theme.json and starter patterns

