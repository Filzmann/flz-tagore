<?php
/**
 * Compact post card for archives and the blog overview.
 *
 * @package FlzTagore
 */
?>
<article id="post-<?php the_ID(); ?>" <?php post_class(array('flz-entry', 'flz-entry--post')); ?>>
	<header class="flz-entry-header">
		<h2 class="flz-entry-title"><a href="<?php echo esc_url(get_permalink()); ?>"><?php the_title(); ?></a></h2>
		<p class="flz-entry-meta"><time datetime="<?php echo esc_attr(get_the_date(DATE_W3C)); ?>"><?php echo esc_html(get_the_date()); ?></time></p>
	</header>
	<div class="flz-entry-summary"><?php the_excerpt(); ?></div>
	<p><a class="flz-entry-more" href="<?php echo esc_url(get_permalink()); ?>"><?php esc_html_e('Beitrag lesen', 'flz-tagore'); ?></a></p>
</article>
