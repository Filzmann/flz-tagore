<?php
/**
 * Minimal structural contract for the clean-room Classic Theme scaffold.
 *
 * @package FlzTagore
 */

declare(strict_types=1);

$root = dirname(__DIR__);
$requiredFiles = array(
	'style.css',
	'screenshot.png',
	'functions.php',
	'header.php',
	'searchform.php',
	'footer.php',
	'index.php',
	'page.php',
	'page-no-title.php',
	'page-wide.php',
	'page-wide-no-title.php',
	'single.php',
	'archive.php',
	'search.php',
	'404.php',
	'template-parts/content.php',
	'template-parts/content-page.php',
	'template-parts/content-post.php',
	'template-parts/content-single.php',
	'template-parts/content-none.php',
	'assets/js/accessibility.js',
	'assets/js/navigation.js',
	'assets/css/custom-css-defaults.css',
);

foreach ($requiredFiles as $file) {
	if (! is_file($root . '/' . $file)) {
		fwrite(STDERR, "Missing required theme file: {$file}\n");
		exit(1);
	}
}

$style = (string) file_get_contents($root . '/style.css');
foreach (array('Theme Name: FLZ Tagore', 'Text Domain: flz-tagore') as $expected) {
	if (false === strpos($style, $expected)) {
		fwrite(STDERR, "Missing theme header: {$expected}\n");
		exit(1);
	}
}

foreach (array('.flz-primary-navigation .sub-menu', ':focus-within > .sub-menu', '.flz-primary-navigation > .flz-primary-navigation__list { display: flex; flex-wrap: wrap; align-items: stretch; justify-content: center;', '.flz-primary-navigation > .flz-primary-navigation__list > .menu-item { position: relative; }', '.flz-primary-navigation > .flz-primary-navigation__list > .menu-item-has-children:hover > .sub-menu', 'grid-template-columns: minmax(0, 1fr);', '.flz-primary-navigation__list > .menu-item-has-children > .sub-menu > .menu-item-has-children > .sub-menu', 'min-width: 12.8rem;', 'left: 0;', 'width: min(var(--flz-nav-submenu-width), calc(100vw - (var(--flz-layout-gutter) * 2)));', 'min-height: 2.9rem;', '.flz-primary-navigation .menu-item-has-children > a::after') as $expected) {
	if (false === strpos($style, $expected)) {
		fwrite(STDERR, "Missing accessible navigation rule: {$expected}\n");
		exit(1);
	}
}

foreach (array('.flz-site-header { position: sticky;', '.flz-accessibility__toggle', '--flz-color-accessibility: #0b57d0;', 'background: var(--flz-color-accessibility);', 'z-index: 99999;', '.flz-accessibility--high-contrast', 'body.flz-accessibility--high-contrast :is(main, article, section, div, header, footer, nav, aside, form, fieldset, table, tr, td, th)', 'body.flz-accessibility--high-contrast .flz-primary-navigation .sub-menu { background: #000 !important; }', 'body.flz-accessibility--high-contrast .flz-primary-navigation a:hover, body.flz-accessibility--high-contrast .flz-primary-navigation a:focus-visible { color: #0ff !important; background: #111 !important; }', '.flz-feedback-button', '.flz-navigation-toggle', '.flz-primary-navigation.is-open', '.flz-primary-navigation > .flz-primary-navigation__list > .menu-item { position: relative; display: block; width: 100%; border-bottom: 1px solid var(--flz-color-navigation-submenu-text);', '.flz-primary-navigation > .flz-primary-navigation__list > .menu-item-has-children:hover > .sub-menu, .flz-primary-navigation > .flz-primary-navigation__list > .menu-item-has-children:focus-within > .sub-menu { display: none; }', '.flz-primary-navigation > .flz-primary-navigation__list > .menu-item-has-children > .sub-menu > .menu-item > a { color: #fff; }', '.wpcf7-form label:has(input[type="date"]) { display: inline-flex;', '.wpcf7-form input[type="date"] { width: auto; max-width: 100%; }', '.wpcf7-form-control-wrap', '.wpcf7-not-valid') as $expected) {
	if (false === strpos($style, $expected)) {
		fwrite(STDERR, "Missing header or accessibility style contract: {$expected}\n");
		exit(1);
	}
}

foreach (array('.flz-site-title__line', '.flz-header-application', '.flz-header-application__list', '.flz-site-search__submit', 'min-width: 16rem;', 'min-height: var(--flz-header-control-height);', 'background: var(--flz-color-navigation-submenu);', '.flz-site-search, .flz-header-application { align-self: start;', '.flz-primary-navigation { grid-column: 1 / -1; position: relative; margin-top: 0;') as $expected) {
	if (false === strpos($style, $expected)) {
		fwrite(STDERR, "Missing target-header presentation: {$expected}\n");
		exit(1);
	}
}

foreach (array('--flz-color-primary: #d66f02;', '--flz-color-secondary: #f6a500;', '--flz-space-unit: 1rem;', '--flz-layout-gutter: clamp(1rem, 3vw, 2.5rem);', '--flz-wide-content-width: 100rem;', 'CUSTOM CSS: Anpassbare Layoutwerte', '.page-template-page-wide-php .flz-site-main', '.flz-site-main :is(h1, h2, h3, h4, h5)', '.flz-content-table-wrap', '.flz-site-main .wp-block-list', '.flz-site-main .schulprofil-kachel-container > a:hover', '.flz-site-footer { border-top: 1px solid var(--flz-color-primary); background: var(--flz-color-surface); }') as $expected) {
	if (false === strpos($style, $expected)) {
		fwrite(STDERR, "Missing migrated Deep content style: {$expected}\n");
		exit(1);
	}
}

if (file_exists($root . '/assets/css/third-party-custom-css.css')) {
	fwrite(STDERR, "Unused third-party custom CSS migration source must not remain in the theme.\n");
	exit(1);
}
if (false !== strpos($style, '.tg-floating-button')) {
	fwrite(STDERR, "Tangible-specific CSS must not live in the general theme stylesheet.\n");
	exit(1);
}

$header = (string) file_get_contents($root . '/header.php');
$footer = (string) file_get_contents($root . '/footer.php');
$functions = (string) file_get_contents($root . '/functions.php');
$content = (string) file_get_contents($root . '/template-parts/content.php');
foreach (
	array(
		array($header, 'wp_head'),
		array($header, '<main id="main-content"'),
		array($header, 'flz-site-title__line'),
		array($header, "'theme_location' => 'application'"),
		array($header, 'flz-header-application__list'),
		array($header, 'flz-navigation-toggle'),
		array($header, 'flz-primary-navigation-menu'),
		array($content, '! is_front_page()'),
		array($footer, 'wp_footer'),
		array($functions, 'wp_enqueue_style'),
		array($functions, 'register_nav_menus'),
		array($functions, "'footer'  => __('Footer-Navigation', 'flz-tagore')"),
		array($functions, 'customize_register'),
		array($functions, 'WP_Customize_Color_Control'),
		array($functions, 'sanitize_hex_color'),
		array($functions, 'flz_tagore_sanitize_measure'),
		array($functions, 'flz_tagore_sanitize_layout_measure'),
		array($functions, 'flz_tagore_sanitize_space_unit'),
		array($functions, 'Feedback-Button'),
		array($functions, 'Bedienhilfe-Button'),
		array($functions, 'flz_tagore_wide_content_width'),
		array($functions, 'flz_tagore_header_logo_max'),
		array($functions, 'flz_tagore_nav_submenu_width'),
		array($functions, 'flz_tagore_sanitize_checkbox'),
		array($functions, 'flz_tagore_seed_custom_css_on_activation'),
		array($functions, 'after_switch_theme'),
		array($functions, 'wp_update_custom_css_post'),
		array($functions, 'flz_tagore_enable_accessibility'),
		array($functions, 'flz_tagore_enable_feedback_button'),
		array($functions, "'application' => __('Schulanmeldung', 'flz-tagore')"),
		array($functions, 'wp_add_inline_style'),
		array($functions, 'flz_tagore_render_accessibility_controls'),
		array($functions, 'flz_tagore_render_feedback_button'),
		array($functions, 'open-feedback'),
		array($functions, 'feedbackBtn'),
		array($functions, 'flz_tagore_page_css'),
		array($functions, 'add_meta_box'),
		array($functions, 'wp_verify_nonce'),
		array($functions, "current_user_can('unfiltered_html')"),
		array($functions, 'wp_enqueue_script'),
		array($functions, 'flz-tagore-navigation'),
		array($functions, 'wp_body_open'),
		array($footer, 'flz-footer-navigation'),
		array($footer, 'https://simonbeyer.de'),
		array($footer, 'Implemented by S. Beyer'),
		array($footer, 'target="_blank"'),
		array($footer, 'rel="noopener noreferrer"'),
	) as $assertion
) {
	if (false === strpos($assertion[0], $assertion[1])) {
		fwrite(STDERR, "Missing required WordPress or landmark contract: {$assertion[1]}\n");
		exit(1);
	}
}

$page_content = (string) file_get_contents($root . '/template-parts/content-page.php');
foreach (array('show_title', 'flz-entry--wide') as $expected) {
	if (false === strpos($page_content, $expected)) {
		fwrite(STDERR, "Missing page template contract: {$expected}\n");
		exit(1);
	}
}

$single_content = (string) file_get_contents($root . '/template-parts/content-single.php');
if (false === strpos($single_content, 'flz-entry--single') || false !== strpos($single_content, 'get_permalink')) {
	fwrite(STDERR, "Single-post template must render an unlinked, semantic heading.\n");
	exit(1);
}

if (strpos($footer, 'flz-footer-navigation') > strpos($footer, 'flz-site-credit')) {
	fwrite(STDERR, "Footer navigation must precede the implementation credit.\n");
	exit(1);
}

echo "Theme structure smoke: OK\n";
