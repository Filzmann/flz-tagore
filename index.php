<?php
/** @package FlzTagore */
get_header();
if (have_posts()) {
	while (have_posts()) {
		the_post();
		get_template_part('template-parts/content', get_post_type());
	}
	the_posts_navigation();
} else {
	get_template_part('template-parts/content', 'none');
}
get_footer();
