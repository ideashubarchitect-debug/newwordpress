# WordPress Website (WP Store)

This is a WordPress site using the **WP Store** theme with a **child theme** for safe, updatable customizations and best practices.

## Quick setup

### 1. Use the child theme

1. In **WordPress Admin** go to **Appearance → Themes**.
2. Activate **WP Store Child** (instead of WP Store).
3. All parent theme features (menus, widgets, customizer) work the same; your customizations stay in the child theme.

### 2. Set your homepage

1. Create a new **Page** (e.g. title **Home**).
2. In **Page Attributes**, set **Template** to **Homepage**.
3. Publish the page.
4. Go to **Settings → Reading**.
5. Select **A static page** and set **Homepage** to your new Home page. Optionally set **Posts page** to a “Blog” page.
6. Save changes.

### 3. Menus

1. Go to **Appearance → Menus**.
2. Create a menu and assign it to **Primary** (header) and/or **Footer**.
3. Add pages (Home, Shop, Blog, Contact, etc.) and save.

### 4. Site identity

1. Go to **Appearance → Customize**.
2. Set **Site Identity**: logo, site title, tagline, and favicon.
3. Use **Header**, **Homepage**, and **Footer** panels to configure slider, promo sections, and footer text.

## Theme structure

- **Parent theme:** `wp-content/themes/wp-store/` — do not edit; updates may overwrite changes.
- **Child theme:** `wp-content/themes/wp-store-child/` — put all custom CSS and PHP here.

## E‑commerce (WooCommerce)

WP Store is built for WooCommerce. To run a shop:

1. Install and activate **WooCommerce** (Plugins → Add New).
2. Run the WooCommerce setup wizard and create Shop, Cart, Checkout, and My Account pages.
3. Use **Appearance → Customize** and theme **Widgets** (e.g. Product Widget Area, Homepage sections) to show products on the homepage.

## Security notes

- **wp-config.php** contains database credentials. Do not commit real credentials to version control; use environment variables or a local-only config in production.
- **.htaccess** includes rules to disable directory listing and block direct access to `wp-config.php` where the server supports it.

## File overview

| Path | Purpose |
|------|--------|
| `wp-config.php` | Database and environment config (keep secure). |
| `.htaccess` | Rewrite rules and security (directory listing disabled). |
| `wp-content/themes/wp-store-child/` | Child theme (style.css, functions.php). |

## Pushing to a remote repository

This project is a Git repo (branch `main`). To push it to a new remote:

### GitHub

1. On [GitHub](https://github.com/new), click **New repository**. Name it (e.g. `wordpress-wp-store`), leave it empty (no README/license), then **Create repository**.
2. In this project folder, run (replace `YOUR_USERNAME` and `REPO_NAME` with your repo details):

   ```bash
   git remote add origin https://github.com/YOUR_USERNAME/REPO_NAME.git
   git push -u origin main
   ```

   Or with SSH: `git remote add origin git@github.com:YOUR_USERNAME/REPO_NAME.git` then `git push -u origin main`.

### GitLab

1. Create a new project on [GitLab](https://gitlab.com/projects/new) (empty, no README).
2. Run:

   ```bash
   git remote add origin https://gitlab.com/YOUR_USERNAME/REPO_NAME.git
   git push -u origin main
   ```

**Note:** `wp-config.php` and `wp-salt.php` are in `.gitignore` and are not pushed. After cloning elsewhere, copy `wp-config-sample.php` to `wp-config.php` and set your database and salts.

## Support

- [WordPress Codex](https://codex.wordpress.org/)
- [WP Store theme](https://demo.8degreethemes.com/wp-store/) (parent theme)
- [WooCommerce docs](https://woocommerce.com/documentation/) (if using the shop)
