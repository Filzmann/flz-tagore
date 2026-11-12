<?php
/**
 * Theme setup and asset registration for FLZ Tagore.
 *
 * @package FlzTagore
 */

declare(strict_types=1);

if (! defined('ABSPATH')) {
	exit;
}

function flz_tagore_setup(): void {
	add_theme_support('title-tag');
	add_theme_support('post-thumbnails');
	add_theme_support('custom-logo', array('height' => 160, 'width' => 480, 'flex-height' => true, 'flex-width' => true));
	add_theme_support('html5', array('comment-form', 'comment-list', 'gallery', 'caption', 'search-form', 'style', 'script'));
	add_theme_support('align-wide');
	register_nav_menus(array(
		'primary'     => __('Hauptnavigation', 'flz-tagore'),
		'application' => __('Schulanmeldung', 'flz-tagore'),
		'footer'  => __('Footer-Navigation', 'flz-tagore'),
	));
}
add_action('after_setup_theme', 'flz_tagore_setup');

/**
 * Restrict numeric presentation settings to their documented range.
 *
 * @param mixed                $value Submitted value.
 * @param WP_Customize_Setting $setting Setting context.
 */
function flz_tagore_sanitize_measure($value, $setting): int {
	$number = absint($value);
	return min(100, max(40, $number));
}

/**
 * Restrict named, central layout dimensions to practical rem ranges.
 *
 * @param mixed                $value Submitted value.
 * @param WP_Customize_Setting $setting Setting context.
 */
function flz_tagore_sanitize_layout_measure($value, $setting): float {
	$definitions = array(
		'flz_tagore_wide_content_width'  => array(60.0, 140.0, 100.0),
		'flz_tagore_layout_gutter_min'   => array(0.5, 3.0, 1.0),
		'flz_tagore_layout_gutter_max'   => array(1.0, 6.0, 2.5),
		'flz_tagore_header_logo_max'     => array(3.0, 18.0, 10.0),
		'flz_tagore_header_control_height' => array(2.0, 5.0, 3.25),
		'flz_tagore_nav_submenu_width'   => array(12.0, 32.0, 18.5),
		'flz_tagore_feedback_offset'     => array(0.5, 4.0, 1.5),
		'flz_tagore_feedback_size'       => array(2.5, 6.0, 3.5),
	);
	$definition = $definitions[$setting->id] ?? array(0.25, 100.0, 1.0);
	$number = is_numeric($value) ? (float) $value : $definition[2];

	return min($definition[1], max($definition[0], $number));
}

/**
 * Keep the base rhythm relative to the visitor's root font size.
 *
 * @param mixed $value Submitted value.
 */
function flz_tagore_sanitize_space_unit($value): float {
	$number = is_numeric($value) ? (float) $value : 1.0;

	return min(3.0, max(0.25, $number));
}

/** @param mixed $value Submitted checkbox value. */
function flz_tagore_sanitize_checkbox($value): bool {
	return (bool) $value;
}

/**
 * Register a deliberately small set of presentation controls.
 *
 * @param WP_Customize_Manager $customize_manager Customizer manager.
 */
function flz_tagore_customize_register($customize_manager): void {
	$customize_manager->add_section('flz_tagore_design', array(
		'title'       => __('Design-Grundlagen', 'flz-tagore'),
		'description' => __('Zentrale Farben, Inhaltsbreite und Grundabstand.', 'flz-tagore'),
		'priority'    => 30,
	));

	$colors = array(
		'primary'      => array(__('Akzentfarbe', 'flz-tagore'), '#d66f02'),
		'primary_dark' => array(__('Dunkle Akzentfarbe', 'flz-tagore'), '#9d5000'),
		'text'         => array(__('Textfarbe', 'flz-tagore'), '#202a33'),
		'surface'      => array(__('Hintergrundfarbe', 'flz-tagore'), '#ffffff'),
		'muted'        => array(__('Flächenfarbe', 'flz-tagore'), '#edf3f5'),
		'control_border' => array(__('Rahmen von Suche und Anmeldung', 'flz-tagore'), '#e6ad4c'),
		'border'       => array(__('Neutrale Rahmenfarbe', 'flz-tagore'), '#c8d5da'),
		'meta'         => array(__('Meta- und Hilfstextfarbe', 'flz-tagore'), '#59636a'),
		'feedback'     => array(__('Feedback-Button', 'flz-tagore'), '#005ca9'),
		'feedback_hover' => array(__('Feedback-Button bei Hover', 'flz-tagore'), '#004b8a'),
		'accessibility' => array(__('Bedienhilfe-Button', 'flz-tagore'), '#0b57d0'),
		'error'        => array(__('Fehlerfarbe für Formulare', 'flz-tagore'), '#b42318'),
		'navigation'   => array(__('Menütext', 'flz-tagore'), '#202a33'),
		'navigation_active' => array(__('Aktives Hauptmenü', 'flz-tagore'), '#333333'),
		'navigation_submenu' => array(__('Untermenü-Hintergrund', 'flz-tagore'), '#f1f1f1'),
		'navigation_submenu_text' => array(__('Untermenü-Text', 'flz-tagore'), '#666666'),
		'navigation_hover' => array(__('Untermenü bei Hover', 'flz-tagore'), '#dddddd'),
		'navigation_mobile_submenu' => array(__('Mobiles Untermenü', 'flz-tagore'), '#414141'),
		'navigation_mobile_deep' => array(__('Mobiles tiefes Untermenü', 'flz-tagore'), '#4b4b4b'),
		'navigation_mobile_hover' => array(__('Mobiles Menü bei Hover', 'flz-tagore'), '#5d5d5d'),
	);
	foreach ($colors as $name => $definition) {
		$id = 'flz_tagore_color_' . $name;
		$customize_manager->add_setting($id, array('default' => $definition[1], 'sanitize_callback' => 'sanitize_hex_color'));
		$customize_manager->add_control(new WP_Customize_Color_Control($customize_manager, $id, array('label' => $definition[0], 'section' => 'flz_tagore_design')));
	}

	$measures = array(
		'flz_tagore_content_width' => array(__('Inhaltsbreite (rem)', 'flz-tagore'), 86, 40, 100),
	);
	foreach ($measures as $id => $definition) {
		$customize_manager->add_setting($id, array('default' => $definition[1], 'sanitize_callback' => 'flz_tagore_sanitize_measure'));
		$customize_manager->add_control($id, array('label' => $definition[0], 'section' => 'flz_tagore_design', 'type' => 'number', 'input_attrs' => array('min' => $definition[2], 'max' => $definition[3], 'step' => 1)));
	}

	$layout_measures = array(
		'flz_tagore_wide_content_width'    => array(__('Gesamtansicht-Breite (rem)', 'flz-tagore'), 100, 60, 140, 1),
		'flz_tagore_layout_gutter_min'     => array(__('Minimaler Seitenabstand (rem)', 'flz-tagore'), 1, .5, 3, .125),
		'flz_tagore_layout_gutter_max'     => array(__('Maximaler Seitenabstand (rem)', 'flz-tagore'), 2.5, 1, 6, .125),
		'flz_tagore_header_logo_max'       => array(__('Logo-Maximalgröße (rem)', 'flz-tagore'), 10, 3, 18, .25),
		'flz_tagore_header_control_height' => array(__('Höhe von Suche und Anmeldung (rem)', 'flz-tagore'), 3.25, 2, 5, .125),
		'flz_tagore_nav_submenu_width'     => array(__('Breite der Untermenüs (rem)', 'flz-tagore'), 18.5, 12, 32, .25),
		'flz_tagore_feedback_offset'       => array(__('Abstand der Floating-Buttons (rem)', 'flz-tagore'), 1.5, .5, 4, .125),
		'flz_tagore_feedback_size'         => array(__('Mindestgröße des Feedback-Buttons (rem)', 'flz-tagore'), 3.5, 2.5, 6, .125),
	);
	foreach ($layout_measures as $id => $definition) {
		$customize_manager->add_setting($id, array('default' => $definition[1], 'sanitize_callback' => 'flz_tagore_sanitize_layout_measure'));
		$customize_manager->add_control($id, array('label' => $definition[0], 'section' => 'flz_tagore_design', 'type' => 'number', 'input_attrs' => array('min' => $definition[2], 'max' => $definition[3], 'step' => $definition[4])));
	}

	$customize_manager->add_setting('flz_tagore_space_unit', array('default' => 1, 'sanitize_callback' => 'flz_tagore_sanitize_space_unit'));
	$customize_manager->add_control('flz_tagore_space_unit', array(
		'label'       => __('Grundabstand (rem)', 'flz-tagore'),
		'description' => __('Ein relativer Abstand passt sich der eingestellten Grundschriftgröße an.', 'flz-tagore'),
		'section'     => 'flz_tagore_design',
		'type'        => 'number',
		'input_attrs' => array('min' => 0.25, 'max' => 3, 'step' => 0.125),
	));

	$customize_manager->add_section('flz_tagore_utilities', array(
		'title'       => __('Bedienhilfen und Feedback', 'flz-tagore'),
		'description' => __('Globale Bedienelemente, die unabhängig voneinander ein- oder ausgeblendet werden können.', 'flz-tagore'),
		'priority'    => 31,
	));
	foreach (array(
		'flz_tagore_enable_accessibility'  => __('Bedienhilfe anzeigen', 'flz-tagore'),
		'flz_tagore_enable_feedback_button' => __('Feedback-Button anzeigen', 'flz-tagore'),
	) as $id => $label) {
		$customize_manager->add_setting($id, array('default' => true, 'sanitize_callback' => 'flz_tagore_sanitize_checkbox'));
		$customize_manager->add_control($id, array('label' => $label, 'section' => 'flz_tagore_utilities', 'type' => 'checkbox'));
	}

}
add_action('customize_register', 'flz_tagore_customize_register');

/**
 * Add the documented, editable CSS starter only once per active stylesheet.
 * Existing Customizer CSS is retained verbatim.
 */
function flz_tagore_seed_custom_css_on_activation(): void {
	$stylesheet = get_stylesheet();
	$source = get_theme_file_path('assets/css/custom-css-defaults.css');
	if (! is_readable($source)) {
		return;
	}

	$starter = trim((string) file_get_contents($source));
	if ('' === $starter || ! str_contains($starter, 'FLZ TAGORE: BEARBEITBARES CUSTOM CSS')) {
		return;
	}

	$post = wp_get_custom_css_post($stylesheet);
	$existing = $post ? trim((string) $post->post_content) : '';
	if (str_contains($existing, 'FLZ TAGORE: BEARBEITBARES CUSTOM CSS')) {
		return;
	}

	wp_update_custom_css_post('' === $existing ? $starter : $existing . "\n\n" . $starter, $stylesheet);
}
add_action('after_switch_theme', 'flz_tagore_seed_custom_css_on_activation');

function flz_tagore_enqueue_assets(): void {
	$theme = wp_get_theme();
	wp_enqueue_style('flz-tagore', get_stylesheet_uri(), array(), $theme->get('Version'));
	if (get_theme_mod('flz_tagore_enable_accessibility', true)) {
		wp_enqueue_script(
			'flz-tagore-accessibility',
			get_theme_file_uri('assets/js/accessibility.js'),
			array(),
			$theme->get('Version'),
			array('in_footer' => true, 'strategy' => 'defer')
		);
	}
	wp_enqueue_script(
		'flz-tagore-navigation',
		get_theme_file_uri('assets/js/navigation.js'),
		array(),
		$theme->get('Version'),
		array('in_footer' => true, 'strategy' => 'defer')
	);

	$colors = array(
		'primary'      => '#d66f02',
		'primary-dark' => '#9d5000',
		'text'         => '#202a33',
		'surface'      => '#ffffff',
		'muted'        => '#edf3f5',
		'control-border' => '#e6ad4c',
		'border'       => '#c8d5da',
		'meta'         => '#59636a',
		'feedback'     => '#005ca9',
		'feedback-hover' => '#004b8a',
		'accessibility' => '#0b57d0',
		'error'        => '#b42318',
		'navigation'   => '#202a33',
		'navigation-active' => '#333333',
		'navigation-submenu' => '#f1f1f1',
		'navigation-submenu-text' => '#666666',
		'navigation-hover' => '#dddddd',
		'navigation-mobile-submenu' => '#414141',
		'navigation-mobile-deep' => '#4b4b4b',
		'navigation-mobile-hover' => '#5d5d5d',
	);
	$variables = array();
	foreach ($colors as $name => $default) {
		$value = sanitize_hex_color((string) get_theme_mod('flz_tagore_color_' . str_replace('-', '_', $name), $default));
		$variables[] = '--flz-color-' . $name . ':' . ($value ?: $default);
	}
	$variables[] = '--flz-content-width:' . flz_tagore_sanitize_measure(get_theme_mod('flz_tagore_content_width', 86), (object) array('id' => 'flz_tagore_content_width')) . 'rem';
	$variables[] = '--flz-space-unit:' . flz_tagore_sanitize_space_unit(get_theme_mod('flz_tagore_space_unit', 1)) . 'rem';
	foreach (array('wide_content_width', 'layout_gutter_min', 'layout_gutter_max', 'header_logo_max', 'header_control_height', 'nav_submenu_width', 'feedback_offset', 'feedback_size') as $name) {
		$id = 'flz_tagore_' . $name;
		$variables[] = '--flz-' . str_replace('_', '-', $name) . ':' . flz_tagore_sanitize_layout_measure(get_theme_mod($id, null), (object) array('id' => $id)) . 'rem';
	}
	wp_add_inline_style('flz-tagore', ':root{' . implode(';', $variables) . ';}');

	if (is_singular('page')) {
		$page_css = flz_tagore_sanitize_page_css((string) get_post_meta(get_queried_object_id(), '_flz_tagore_page_css', true));
		if ('' !== $page_css) {
			wp_add_inline_style('flz-tagore', $page_css);
		}
	}
}
add_action('wp_enqueue_scripts', 'flz_tagore_enqueue_assets');

/** Limit page-specific CSS to stylesheet text, never markup. */
function flz_tagore_sanitize_page_css(string $css): string {
	return trim(wp_strip_all_tags(wp_kses_no_null($css)));
}

/** Register a page-scoped CSS field for trusted editors. */
function flz_tagore_add_page_css_meta_box(): void {
	add_meta_box('flz-tagore-page-css', __('Seitenbezogenes CSS', 'flz-tagore'), 'flz_tagore_render_page_css_meta_box', 'page', 'normal', 'default');
}
add_action('add_meta_boxes_page', 'flz_tagore_add_page_css_meta_box');

/** @param WP_Post $post Current page. */
function flz_tagore_render_page_css_meta_box($post): void {
	if (! current_user_can('unfiltered_html')) {
		echo '<p>' . esc_html__('Dieses Feld ist nur für Benutzer*innen mit der Berechtigung „unfiltered_html“ verfügbar.', 'flz-tagore') . '</p>';
		return;
	}

	wp_nonce_field('flz_tagore_save_page_css', 'flz_tagore_page_css_nonce');
	$value = (string) get_post_meta($post->ID, '_flz_tagore_page_css', true);
	?>
	<p><?php esc_html_e('Diese Regeln werden nur auf dieser Seite nach dem Theme-Stylesheet geladen. Verwende möglichst die dokumentierten --flz-Variablen oder die body.page-id-Klasse.', 'flz-tagore'); ?></p>
	<textarea class="widefat code" name="flz_tagore_page_css" id="flz_tagore_page_css" rows="12"><?php echo esc_textarea($value); ?></textarea>
	<?php
}

/** @param int $post_id Saved post ID. */
function flz_tagore_save_page_css_meta($post_id): void {
	if (! isset($_POST['flz_tagore_page_css_nonce']) || ! wp_verify_nonce(sanitize_text_field(wp_unslash($_POST['flz_tagore_page_css_nonce'])), 'flz_tagore_save_page_css')) {
		return;
	}
	if (wp_is_post_revision($post_id) || ! current_user_can('edit_post', $post_id) || ! current_user_can('unfiltered_html')) {
		return;
	}

	$css = isset($_POST['flz_tagore_page_css']) ? flz_tagore_sanitize_page_css(wp_unslash($_POST['flz_tagore_page_css'])) : '';
	if ('' === $css) {
		delete_post_meta($post_id, '_flz_tagore_page_css');
		return;
	}

	update_post_meta($post_id, '_flz_tagore_page_css', $css);
}
add_action('save_post_page', 'flz_tagore_save_page_css_meta');

/**
 * Render local, optional reading and contrast controls at the WordPress body boundary.
 */
function flz_tagore_render_accessibility_controls(): void {
	if (! get_theme_mod('flz_tagore_enable_accessibility', true)) {
		return;
	}

	?>
	<section class="flz-accessibility" aria-label="<?php esc_attr_e('Bedienhilfen', 'flz-tagore'); ?>">
		<button class="flz-accessibility__toggle" type="button" aria-expanded="false" aria-controls="flz-accessibility-panel">
			<span aria-hidden="true">A</span><span class="screen-reader-text"><?php esc_html_e('Bedienhilfen öffnen', 'flz-tagore'); ?></span>
		</button>
		<div class="flz-accessibility__panel" id="flz-accessibility-panel" hidden>
			<h2><?php esc_html_e('Bedienhilfen', 'flz-tagore'); ?></h2>
			<div class="flz-accessibility__group">
				<p><?php esc_html_e('Schriftgröße', 'flz-tagore'); ?></p>
				<div class="flz-accessibility__buttons">
					<button type="button" data-flz-font="decrease"><?php esc_html_e('Kleiner', 'flz-tagore'); ?></button>
					<button type="button" data-flz-font="reset"><?php esc_html_e('Standard', 'flz-tagore'); ?></button>
					<button type="button" data-flz-font="increase"><?php esc_html_e('Größer', 'flz-tagore'); ?></button>
				</div>
			</div>
			<div class="flz-accessibility__group">
				<p><?php esc_html_e('Kontrast', 'flz-tagore'); ?></p>
				<div class="flz-accessibility__buttons">
					<button type="button" data-flz-contrast="normal"><?php esc_html_e('Normal', 'flz-tagore'); ?></button>
					<button type="button" data-flz-contrast="high"><?php esc_html_e('Hoch', 'flz-tagore'); ?></button>
				</div>
			</div>
		</div>
	</section>
	<?php
}
add_action('wp_body_open', 'flz_tagore_render_accessibility_controls');

/**
 * Render the site-wide feedback link as theme presentation, independent of a code-snippet plugin.
 */
function flz_tagore_render_feedback_button(): void {
	if (! get_theme_mod('flz_tagore_enable_feedback_button', true) || is_page('kontakt')) {
		return;
	}
	?>
	<a class="flz-feedback-button open-feedback" id="feedbackBtn" href="<?php echo esc_url(home_url('/eure-wuensche/')); ?>" aria-label="<?php esc_attr_e('Feedback', 'flz-tagore'); ?>">
		<?php esc_html_e('Feedback', 'flz-tagore'); ?>
		<span class="flz-feedback-button__tooltip"><?php esc_html_e('Waren wir hilfreich? Sind alle Fragen beantwortet? Dein Feedback hilft uns, besser zu werden.', 'flz-tagore'); ?></span>
	</a>
	<?php
}
add_action('wp_body_open', 'flz_tagore_render_feedback_button', 20);
