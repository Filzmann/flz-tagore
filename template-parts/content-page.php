<?php
/**
 * Page content with explicitly selected presentation variants.
 *
 * @package FlzTagore
 */

$show_title = ! isset($args['show_title']) || (bool) $args['show_title'];
$wide = ! empty($args['wide']);
?>
<article id="post-<?php the_ID(); ?>" <?php post_class(array('flz-entry', $wide ? 'flz-entry--wide' : '')); ?>>
	<?php if ($show_title && ! is_front_page() && '' !== trim((string) get_the_title())) : ?>
		<header class="flz-entry-header"><h1 class="flz-entry-title"><?php the_title(); ?></h1></header>
	<?php endif; ?>
	<div class="flz-entry-content"><?php the_content(); ?></div>
</article>
