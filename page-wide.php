<?php
/**
 * Template Name: Seite in Gesamtansicht
 * Template Post Type: page
 *
 * @package FlzTagore
 */

get_header();
while (have_posts()) {
	the_post();
	get_template_part('template-parts/content', 'page', array('wide' => true));
}
get_footer();
