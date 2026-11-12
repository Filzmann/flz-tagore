<?php
/**
 * Executable contract for pure theme setting sanitizers.
 *
 * @package FlzTagore
 */

declare(strict_types=1);

define('ABSPATH', __DIR__ . '/');

function add_action(): void {}

function absint($value): int {
	return abs((int) $value);
}

require dirname(__DIR__) . '/functions.php';

function flz_tagore_coverage_assert(bool $condition, string $message): void {
	if (! $condition) {
		throw new RuntimeException($message);
	}
}

$content_width = (object) array('id' => 'flz_tagore_content_width');
flz_tagore_coverage_assert(40 === flz_tagore_sanitize_measure(-1, $content_width), 'Content width must clamp to its lower bound.');
flz_tagore_coverage_assert(100 === flz_tagore_sanitize_measure(101, $content_width), 'Content width must clamp to its upper bound.');

$logo = (object) array('id' => 'flz_tagore_header_logo_max');
flz_tagore_coverage_assert(3.0 === flz_tagore_sanitize_layout_measure(1, $logo), 'Logo size must clamp to its lower bound.');
flz_tagore_coverage_assert(18.0 === flz_tagore_sanitize_layout_measure(99, $logo), 'Logo size must clamp to its upper bound.');
flz_tagore_coverage_assert(10.0 === flz_tagore_sanitize_layout_measure('invalid', $logo), 'Invalid logo input must use the documented default.');

flz_tagore_coverage_assert(0.25 === flz_tagore_sanitize_space_unit(0), 'Space unit must clamp to its lower bound.');
flz_tagore_coverage_assert(3.0 === flz_tagore_sanitize_space_unit(9), 'Space unit must clamp to its upper bound.');
flz_tagore_coverage_assert(true === flz_tagore_sanitize_checkbox('1'), 'Truthy checkbox values must remain enabled.');
flz_tagore_coverage_assert(false === flz_tagore_sanitize_checkbox(''), 'Empty checkbox values must remain disabled.');

echo "Theme PHP coverage smoke: OK\n";
