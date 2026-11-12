import assert from 'node:assert/strict';

class ClassList {
	values = new Set();
	contains(name) { return this.values.has(name); }
	remove(name) { this.values.delete(name); }
	toggle(name, force) { force ? this.values.add(name) : this.values.delete(name); }
}

class Element {
	constructor() { this.attributes = new Map(); this.listeners = new Map(); this.classList = new ClassList(); this.textContent = ''; }
	setAttribute(name, value) { this.attributes.set(name, String(value)); }
	getAttribute(name) { return this.attributes.get(name) ?? null; }
	addEventListener(name, listener) { this.listeners.set(name, listener); }
	focus() { this.focused = true; }
}

const navigation = new Element();
const toggle = new Element();
const menu = new Element();
const submenu = new Element();
const link = new Element();
link.textContent = 'Untermenü';
const item = new Element();
let submenuToggle;
link.insertAdjacentElement = (position, element) => { assert.equal(position, 'afterend'); submenuToggle = element; };
item.querySelector = (selector) => selector.includes('.sub-menu') ? submenu : link;
const nestedSubmenu = new Element();
const nestedLink = new Element();
nestedLink.textContent = 'Ebene drei';
const nestedItem = new Element();
let nestedSubmenuToggle;
nestedLink.insertAdjacentElement = (position, element) => { assert.equal(position, 'afterend'); nestedSubmenuToggle = element; };
nestedItem.querySelector = (selector) => selector.includes('.sub-menu') ? nestedSubmenu : nestedLink;
menu.querySelectorAll = () => [item, nestedItem, {querySelector: () => null}];

const listeners = new Map();
const document = {
	querySelector: (selector) => selector === '.flz-primary-navigation' ? navigation : toggle,
	getElementById: () => menu,
	createElement: () => new Element(),
	addEventListener: (name, listener) => listeners.set(name, listener),
};
globalThis.document = document;
await import('../../assets/js/navigation.js');

toggle.listeners.get('click')();
assert.equal(navigation.classList.contains('is-open'), true);
assert.equal(toggle.getAttribute('aria-expanded'), 'true');

submenuToggle.listeners.get('click')();
assert.equal(item.classList.contains('is-submenu-open'), true);
assert.equal(submenuToggle.getAttribute('aria-expanded'), 'true');
assert.equal(submenuToggle.getAttribute('aria-label'), 'Untermenü Untermenü schließen');
assert.match(submenu.id, /^flz-submenu-/);

nestedSubmenuToggle.listeners.get('click')();
assert.equal(nestedItem.classList.contains('is-submenu-open'), true);
assert.equal(nestedSubmenuToggle.getAttribute('aria-expanded'), 'true');
assert.equal(nestedSubmenuToggle.getAttribute('aria-label'), 'Untermenü Ebene drei schließen');
assert.match(nestedSubmenu.id, /^flz-submenu-/);

listeners.get('keydown')({key: 'Escape'});
assert.equal(navigation.classList.contains('is-open'), false);
assert.equal(toggle.getAttribute('aria-expanded'), 'false');
assert.equal(toggle.focused, true);
