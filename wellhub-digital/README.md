# WellHub Digital

A premium, production-ready WordPress + WooCommerce theme for digital-product businesses. It ships configured for a **Women's Health & Pregnancy** flagship category but is architected to expand into unlimited future product categories (Fitness, Finance, Education, Productivity, Templates, Courses, e-books…) without a redesign or code changes.

Built for standard WordPress + WooCommerce hosting, including Hostinger shared/managed WordPress. No Node.js, Docker, Python, Redis, Elasticsearch or custom server infrastructure is required to run the theme.

---

## 1. What this theme is (and isn't)

- It is a real WordPress theme using the template hierarchy, hooks, `wp_nav_menu()`, widgets, the Customizer, and WooCommerce's own product/cart/checkout/account system.
- It does **not** reimplement the cart, checkout, payments, or downloads — those stay 100% native WooCommerce, so nothing here locks your data in. If you switch themes later, every page, post, product, order and download stays intact because it all lives in WordPress/WooCommerce core tables, not theme-only storage.
- It does **not** bundle a page builder (Elementor, Divi, etc.) or a payment gateway. Install whichever WooCommerce-compatible gateway suits your business/country separately.
- Demo/sample content (products, pages) is clearly demo-only. **Replace it before launching a real store.**

---

## 2. Requirements

- WordPress 6.3+
- WooCommerce 8.0+ (theme still activates without it, with a shop-disabled admin notice)
- PHP 7.4+
- Any standard WordPress host (developed and tested for Hostinger shared/managed hosting)

---

## 3. Installation

1. **Set up WordPress on Hostinger** (via hPanel's WordPress installer or a manual install).
2. **Install WooCommerce** — Plugins → Add New → search "WooCommerce" → Install → Activate → run its setup wizard (store address, currency, etc).
3. **Upload the theme**: zip the `wellhub-digital` folder (so `style.css` sits at the zip root) → WordPress Admin → Appearance → Themes → Add New → Upload Theme → choose the zip → Install → Activate.
4. **Configure menus**: Appearance → Menus. Create a menu, assign it to **Primary Menu**, and optionally create separate menus for **Footer: Shop**, **Footer: Resources**, **Footer: Company**, **Footer: Legal**.
5. **Configure WooCommerce pages**: WooCommerce → Status → Tools (or the setup wizard) ensures Shop, Cart, Checkout and My Account pages exist. These are standard WordPress pages — edit their content like any other page.
6. **Add digital products** — see §5 below.
7. **Upload downloadable files** on each product (WooCommerce's native Downloadable Product panel — never expose the paid file anywhere else).
8. **Configure a payment gateway** separately (WooCommerce → Settings → Payments). The theme does not include or assume any specific gateway.
9. **Configure homepage content** via Appearance → Customize (see §6).
10. **Replace demo branding and content** before going live (see §9).
11. Optionally run **Appearance → Demo Content** to preview the theme with sample pages/categories/products (see §4).

### Setting the homepage

Settings → Reading → "A static page" → set **Homepage** to a page using the front page (the theme's `front-page.php` is used automatically once a static homepage is set) and, if you want a separate blog/resources listing, set **Posts page** to another page (rendered by `home.php`).

---

## 4. Demo content (optional)

Appearance → **Demo Content** → "Install Demo Content" creates, if they don't already exist:

- Pages: About, Contact, Refund Policy, Disclaimer
- WooCommerce categories: Women's Health → Pregnancy, Postpartum, Women's Wellness, Motherhood
- 7 demo digital products (virtual + downloadable, placeholder prices): Pregnancy Planning Workbook, First Trimester Guide, Pregnancy Checklist, Hospital Bag Checklist, New Mom Planner, Prenatal Wellness Journal, Pregnancy Starter Bundle

**These are demo products only, with placeholder copy, prices and no real files attached.** No medical claims are made in the sample copy. Delete or fully rewrite every demo product before accepting real orders, and upload your own downloadable files.

Safe to run more than once — items with a matching title are skipped, nothing is duplicated.

---

## 5. Adding digital products

For each product: Products → Add New →

1. Set **Product data → General**: regular price, optional sale price.
2. Check **Virtual** and **Downloadable** (Product data → General tab) and add the file(s) under **Downloadable files**. Optionally set **Download limit** and **Download expiry**.
3. Assign one or more **Product categories** (create new ones any time — the whole site adapts automatically, see §7).
4. Fill in **Short description** (used on product cards) and the main **Description** (used on the single product page).
5. Open the **Digital Details** tab (added by this theme) to set:
   - Format (PDF, EPUB, ZIP…)
   - Pages
   - Access / Delivery text (defaults to "Digital Download" / "Instant Digital Access")
   - Preview / Sample URL — link to a *sample* file in the Media Library, never the paid file
   - What's Included — one line per bundled item
   - Product FAQ — one line per question, formatted `Question | Answer`
   - Buy Now — skips the cart and sends the customer straight to checkout
   - Merchandising badges — New / Bestseller / Featured / Popular / Bundle (the Sale badge is automatic)
6. To feature a product on the homepage "Featured Products" section, use WooCommerce's native **Featured** toggle (the star icon in the Products list, or Product data → General → "Featured product").
7. "Best Sellers" on the homepage is automatic — it's ordered by WooCommerce's own sales-popularity metric, no manual flag needed.

---

## 6. Customization (Appearance → Customize)

| Section | Controls |
|---|---|
| **Brand Colors** | Primary color, Accent color (the accent can be different per category — see §7) |
| **Homepage Hero** | Eyebrow, headline, supporting text, two CTA buttons + links, hero image |
| **Featured Category** | Which WooCommerce category is the homepage flagship section, plus its subcategory slugs |
| **Contact & Social** | Email, phone, Facebook/Instagram/Pinterest/YouTube/TikTok URLs |
| **Footer & Disclaimer** | Footer copyright text, the health disclaimer text, and which category slugs trigger it |
| **Free Resource & Newsletter** | Lead-magnet heading/description/button, and a shortcode field for any email marketing plugin |

Logo, site title and tagline are the standard WordPress Customizer → Site Identity controls.

**Newsletter integration**: install any WordPress-compatible email plugin (Mailchimp for WooCommerce, MC4WP, ConvertKit, Brevo, etc.), create a form, and paste its shortcode into Customizer → Free Resource & Newsletter → Newsletter Shortcode. No provider is hard-coded.

---

## 7. Adding a new product category (now or in the future)

1. Products → Categories → Add New Category (with an optional parent, e.g. make "Fitness" top-level, or "Workout Plans" a child of it).
2. Assign products to it. It immediately appears in:
   - The full "Shop by Category" homepage grid (`template-parts/homepage/category-grid.php`) — pulled live from `product_cat`, nothing hard-coded.
   - Shop page filters, breadcrumbs, and the primary navigation (if you add it to a menu).
3. To make it the homepage's flagship spotlight instead of Women's Health, just change Customizer → Featured Category — no template edits required.
4. To give a category its own accent color (instead of the global `--accent`), add a rule to your child theme / Additional CSS:
   ```css
   body.term-fitness { --accent: #2d6a4f; --accent-soft: #e6f2ec; }
   ```
   The slug comes from `body_class()`, added automatically by `wellhub_body_classes()` in `inc/setup.php`.

No PHP changes are ever required to add, rename, or reorganize categories.

---

## 8. Template & hook reference

### Template hierarchy
`front-page.php` (homepage) · `home.php` (blog/resources index) · `page.php` · `single.php` · `archive.php` · `search.php` · `404.php` · `woocommerce.php` (WooCommerce wrapper) · `index.php` (fallback)

### Homepage sections (`template-parts/homepage/`)
Each file is independent and renders nothing if it has no content to show (no broken/empty sections): `hero`, `featured-category`, `featured-products`, `best-sellers`, `benefits`, `how-it-works`, `category-grid`, `bundles`, `free-resource`, `testimonials`, `resources`, `newsletter`, `final-cta`.

### Key theme hooks/filters
- `wellhub_benefits` — filter the 4 homepage trust points
- `wellhub_how_it_works_steps` — filter the 3-step process
- `wellhub_content_width` — filter the content width in pixels

### WooCommerce integration points (all via hooks, see `inc/woocommerce/woocommerce-hooks.php`)
- `woocommerce_before_main_content` / `_after_main_content` — page wrapper + breadcrumbs
- `woocommerce_single_product_summary` — badges (priority 4), digital info box (25), health disclaimer (36)
- `woocommerce_after_single_product_summary` — "What's Included" + preview link (priority 4)
- `woocommerce_product_tabs` — adds the FAQ tab when a product has FAQ content
- `woocommerce_before_cart_table` / `woocommerce_review_order_before_payment` — "no physical shipping" note
- `woocommerce_add_to_cart_redirect` — optional per-product "Buy Now" redirect to checkout
- `woocommerce_product_data_tabs` / `_panels` — the custom "Digital Details" product data tab

---

## 9. WooCommerce template overrides

Only **one** WooCommerce template is overridden, in `woocommerce/content-product.php` (the individual product-card markup used on the shop, category archives, related products and homepage grids).

**Why it's overridden:** to add the badge system, category label, trimmed excerpt and custom price row required by the design. Every core action hook (`woocommerce_before_shop_loop_item`, `_shop_loop_item_title`, `_after_shop_loop_item_title`, `_after_shop_loop_item`) still fires in the same order, so plugins that hook into the product loop keep working. Two default callbacks are intentionally unhooked in `inc/woocommerce/woocommerce-hooks.php` (the sale flash, replaced by the unified badge component; and the loop price hook, replaced by the manual price row) — this is documented at the top of the override file itself.

**Everything else** — `archive-product.php`, `single-product.php`, cart, checkout, and My Account pages — uses WooCommerce's own default templates, styled entirely through `assets/css/woocommerce.css` and extended through action/filter hooks. This keeps the theme compatible with future WooCommerce core updates.

**Maintenance note:** when WooCommerce releases a new version, compare `woocommerce/content-product.php` against the latest `templates/content-product.php` in the WooCommerce plugin (WooCommerce → Status → look for "outdated templates" warnings) and port forward any new hooks.

---

## 10. Recommended plugins

None are required for the theme to function. Recommended, install separately as needed:

- An SEO plugin (Yoast SEO, Rank Math, or All in One SEO) — the theme's breadcrumb function automatically steps aside if one of these is active.
- A caching plugin compatible with Hostinger (e.g. WP Super Cache, or Hostinger's built-in cache).
- An email marketing plugin for the newsletter shortcode field (Mailchimp for WooCommerce, MC4WP, Brevo, etc).
- A backup plugin (UpdraftPlus or similar) — always recommended before major changes.

Avoid page builder plugins (Elementor, Divi, WPBakery, Brizy) — the theme is built on core WordPress + Gutenberg and does not depend on any of them.

---

## 11. Accessibility & performance notes

- Skip link, visible focus states, keyboard-accessible mobile menu (focus trap + Escape to close) and accordions (`<details>`/`<summary>`), `prefers-reduced-motion` support.
- WooCommerce CSS/JS only enqueue on shop/cart/checkout/account pages (`wellhub_is_shop_context()` in `inc/enqueue.php`); a plain blog post stays lightweight.
- No hard-coded product IDs, category IDs, menu items, or business name anywhere in the templates.

---

## 12. Health & safety content policy

The theme includes an optional, configurable disclaimer (Customizer → Footer & Disclaimer) intended for informational use only:

> "Health-related resources are provided for general educational and informational purposes and are not a substitute for professional medical advice, diagnosis or treatment."

It is shown on products in the configured category slugs (default: `womens-health, pregnancy, postpartum, womens-wellness, motherhood`) and in the site footer. Do not use product or marketing copy that implies medical guarantees, cures, doctor endorsements, or fabricated statistics/credentials — this is a content responsibility for whoever manages the store, the theme only provides the display mechanism.

---

## 13. Changelog

### 1.0.0
- Initial release: full WordPress + WooCommerce theme, homepage builder sections, Customizer-driven branding/hero/disclaimer/newsletter, custom digital-product fields (format, pages, access, delivery, preview, what's included, FAQ, badges, buy-now), one WooCommerce template override (`content-product.php`), demo content installer, accessibility and performance passes.
