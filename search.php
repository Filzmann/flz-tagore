<?php
/** @package FlzTagore */
get_header();
?>
<header class="flz-archive-header"><h1><?php printf(esc_html__('Suchergebnisse für: %s', 'flz-tagore'), esc_html(get_search_query())); ?></h1></header>
<?php
if (have_posts()) {
	while (have_posts()) {
		the_post();
		get_template_part('template-parts/content', 'search');
	}
	the_posts_navigation();
} else {
	get_template_part('template-parts/content', 'none');
}
get_footer();
