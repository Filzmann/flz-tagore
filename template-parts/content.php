<?php
/** @package FlzTagore */
?>
<article id="post-<?php the_ID(); ?>" <?php post_class('flz-entry'); ?>>
	<?php if (! is_front_page() && '' !== trim((string) get_the_title())) : ?>
		<header class="flz-entry-header"><h1 class="flz-entry-title"><a href="<?php echo esc_url(get_permalink()); ?>"><?php the_title(); ?></a></h1></header>
	<?php endif; ?>
	<div class="flz-entry-content"><?php the_content(); ?></div>
</article>
