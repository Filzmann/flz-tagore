(() => {
	'use strict';

	const navigation = document.querySelector('.flz-primary-navigation');
	const toggle = document.querySelector('.flz-navigation-toggle');
	const menu = document.getElementById('flz-primary-navigation-menu');

	if (!navigation || !toggle || !menu) {
		return;
	}

	const closeNavigation = () => {
		navigation.classList.remove('is-open');
		toggle.setAttribute('aria-expanded', 'false');
	};

	toggle.addEventListener('click', () => {
		const isOpen = !navigation.classList.contains('is-open');
		navigation.classList.toggle('is-open', isOpen);
		toggle.setAttribute('aria-expanded', String(isOpen));
	});

	menu.querySelectorAll('.menu-item-has-children').forEach((item, index) => {
		const submenu = item.querySelector(':scope > .sub-menu');
		const link = item.querySelector(':scope > a');
		if (!submenu || !link) {
			return;
		}

		const submenuId = submenu.id || `flz-submenu-${index + 1}`;
		const submenuLabel = link.textContent.trim();
		submenu.id = submenuId;
		const button = document.createElement('button');
		button.className = 'flz-submenu-toggle';
		button.type = 'button';
		button.setAttribute('aria-controls', submenuId);
		button.setAttribute('aria-expanded', 'false');
		button.setAttribute('aria-label', `Untermenü ${submenuLabel} öffnen`);
		button.innerHTML = '<span aria-hidden="true">⌄</span>';
		link.insertAdjacentElement('afterend', button);
		button.addEventListener('click', () => {
			const isOpen = !item.classList.contains('is-submenu-open');
			item.classList.toggle('is-submenu-open', isOpen);
			button.setAttribute('aria-expanded', String(isOpen));
			button.setAttribute('aria-label', `Untermenü ${submenuLabel} ${isOpen ? 'schließen' : 'öffnen'}`);
		});
	});

	document.addEventListener('keydown', (event) => {
		if (event.key === 'Escape' && navigation.classList.contains('is-open')) {
			closeNavigation();
			toggle.focus();
		}
	});
})();
