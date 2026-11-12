<?php
/**
 * Full single-post view with one semantic, unlinked H1.
 *
 * @package FlzTagore
 */
?>
<article id="post-<?php the_ID(); ?>" <?php post_class(array('flz-entry', 'flz-entry--single')); ?>>
	<header class="flz-entry-header">
		<h1 class="flz-entry-title"><?php the_title(); ?></h1>
		<p class="flz-entry-meta"><time datetime="<?php echo esc_attr(get_the_date(DATE_W3C)); ?>"><?php echo esc_html(get_the_date()); ?></time></p>
	</header>
	<div class="flz-entry-content"><?php the_content(); ?></div>
</article>
