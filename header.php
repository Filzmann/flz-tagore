<?php
/** @package FlzTagore */
?><!doctype html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo('charset'); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<?php wp_body_open(); ?>
<a class="screen-reader-text" href="#main-content"><?php esc_html_e('Zum Inhalt springen', 'flz-tagore'); ?></a>
<header class="flz-site-header">
	<div class="flz-site-header__inner">
		<div class="flz-site-identity">
			<?php the_custom_logo(); ?>
			<p class="flz-site-title"><a href="<?php echo esc_url(home_url('/')); ?>" rel="home"><?php
				$site_name_parts = preg_split('/\s*[-–—]\s*/u', (string) get_bloginfo('name'), 2);
				foreach ($site_name_parts as $site_name_part) {
					printf('<span class="flz-site-title__line">%s</span>', esc_html($site_name_part));
				}
			?></a></p>
		</div>
		<div class="flz-site-search"><?php get_search_form(); ?></div>
		<nav class="flz-header-application" aria-label="<?php esc_attr_e('Schulanmeldung', 'flz-tagore'); ?>">
			<?php
			wp_nav_menu(
				array(
					'theme_location' => 'application',
					'container'      => false,
					'fallback_cb'    => false,
					'menu_class'     => 'flz-header-application__list',
				)
			);
			?>
		</nav>
		<button class="flz-navigation-toggle" type="button" aria-expanded="false" aria-controls="flz-primary-navigation-menu">
			<span aria-hidden="true">☰</span><span class="screen-reader-text"><?php esc_html_e('Hauptnavigation öffnen', 'flz-tagore'); ?></span>
		</button>
		<nav class="flz-primary-navigation" aria-label="<?php esc_attr_e('Hauptnavigation', 'flz-tagore'); ?>">
			<?php
			wp_nav_menu(
				array(
					'theme_location' => 'primary',
					'container'      => false,
					'fallback_cb'    => false,
					'menu_class'     => 'flz-primary-navigation__list',
					'menu_id'        => 'flz-primary-navigation-menu',
				)
			);
			?>
		</nav>
	</div>
</header>
<main id="main-content" class="flz-site-main">
