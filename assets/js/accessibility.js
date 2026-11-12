(() => {
	'use strict';

	const storageKey = 'flz_tagore_accessibility';
	const sizes = [80, 90, 100, 110, 120, 130, 140, 150];
	const root = document.documentElement;
	const panel = document.getElementById('flz-accessibility-panel');
	const toggle = document.querySelector('.flz-accessibility__toggle');

	if (!panel || !toggle) {
		return;
	}

	let settings = { fontSize: 100, contrast: 'normal' };
	try {
		const saved = JSON.parse(window.localStorage.getItem(storageKey));
		settings = {
			fontSize: sizes.includes(saved?.fontSize) ? saved.fontSize : 100,
			contrast: saved?.contrast === 'high' ? 'high' : 'normal',
		};
	} catch (error) {
		// Storage may be unavailable; the controls still work for this page view.
	}

	const apply = () => {
		root.style.setProperty('--flz-font-scale', String(settings.fontSize / 100));
		document.body.classList.toggle('flz-accessibility--high-contrast', settings.contrast === 'high');
	};
	const save = () => {
		try {
			window.localStorage.setItem(storageKey, JSON.stringify(settings));
		} catch (error) {
			// Storage consent or browser settings can prevent persistence.
		}
	};
	const close = () => {
		panel.hidden = true;
		toggle.setAttribute('aria-expanded', 'false');
	};

	toggle.addEventListener('click', () => {
		const open = panel.hidden;
		panel.hidden = !open;
		toggle.setAttribute('aria-expanded', String(open));
	});
	document.addEventListener('click', (event) => {
		if (!panel.hidden && !panel.contains(event.target) && !toggle.contains(event.target)) {
			close();
		}
	});
	document.addEventListener('keydown', (event) => {
		if (event.key === 'Escape' && !panel.hidden) {
			close();
			toggle.focus();
		}
	});
	panel.addEventListener('click', (event) => {
		const button = event.target.closest('button');
		if (!button) {
			return;
		}
		if (button.dataset.flzFont) {
			const current = sizes.indexOf(settings.fontSize);
			if (button.dataset.flzFont === 'increase') settings.fontSize = sizes[Math.min(current + 1, sizes.length - 1)];
			if (button.dataset.flzFont === 'decrease') settings.fontSize = sizes[Math.max(current - 1, 0)];
			if (button.dataset.flzFont === 'reset') settings.fontSize = 100;
		}
		if (button.dataset.flzContrast) settings.contrast = button.dataset.flzContrast === 'high' ? 'high' : 'normal';
		save();
		apply();
	});

	apply();
})();
