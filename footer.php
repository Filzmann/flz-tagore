<?php
/** @package FlzTagore */
?>
</main>
<footer class="flz-site-footer">
	<div class="flz-site-footer__inner">
		<nav class="flz-footer-navigation" aria-label="<?php esc_attr_e('Footer-Navigation', 'flz-tagore'); ?>">
			<?php
			wp_nav_menu(array(
				'theme_location' => 'footer',
				'container'      => false,
				'fallback_cb'    => false,
				'menu_class'     => 'flz-footer-navigation__list',
			));
			?>
		</nav>
		<p class="flz-site-credit"><a href="<?php echo esc_url('https://simonbeyer.de'); ?>" target="_blank" rel="noopener noreferrer">Implemented by S. Beyer</a></p>
	</div>
</footer>
<?php wp_footer(); ?>
</body>
</html>
