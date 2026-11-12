<?php
/**
 * Search form matching the FLZ Tagore header presentation.
 *
 * @package FlzTagore
 */
?>
<form role="search" method="get" class="search-form flz-site-search__form" action="<?php echo esc_url(home_url('/')); ?>">
	<label>
		<span class="screen-reader-text"><?php esc_html_e('Suche nach:', 'flz-tagore'); ?></span>
		<input type="search" class="search-field flz-site-search__field" placeholder="<?php echo esc_attr_x('Suche', 'placeholder', 'flz-tagore'); ?>" value="<?php echo esc_attr(get_search_query()); ?>" name="s">
	</label>
	<button type="submit" class="flz-site-search__submit">
		<span class="screen-reader-text"><?php esc_html_e('Suchen', 'flz-tagore'); ?></span>
		<span aria-hidden="true">⌕</span>
	</button>
</form>
