<?php
/**
 * Template Name: Seite ohne Überschrift
 * Template Post Type: page
 *
 * @package FlzTagore
 */

get_header();
while (have_posts()) {
	the_post();
	get_template_part('template-parts/content', 'page', array('show_title' => false));
}
get_footer();
