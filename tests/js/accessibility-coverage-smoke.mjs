import assert from 'node:assert/strict';

class ClassList {
	values = new Set();
	toggle(name, force) { force ? this.values.add(name) : this.values.delete(name); }
	contains(name) { return this.values.has(name); }
}
class Element {
	constructor() { this.hidden = true; this.attributes = new Map(); this.listeners = new Map(); this.dataset = {}; this.classList = new ClassList(); }
	setAttribute(name, value) { this.attributes.set(name, String(value)); }
	getAttribute(name) { return this.attributes.get(name) ?? null; }
	addEventListener(name, listener) { this.listeners.set(name, listener); }
	contains(target) { return target === this; }
	closest() { return this; }
	focus() { this.focused = true; }
}

const panel = new Element();
const toggle = new Element();
const listeners = new Map();
const stored = new Map();
const document = {
	body: new Element(),
	getElementById: (id) => id === 'flz-accessibility-panel' ? panel : null,
	querySelector: (selector) => selector === '.flz-accessibility__toggle' ? toggle : null,
	addEventListener: (name, listener) => listeners.set(name, listener),
};
const root = {style: {setProperty(name, value) { root[name] = value; }}};
const window = {localStorage: {getItem: (key) => stored.get(key) ?? null, setItem: (key, value) => stored.set(key, value)}};
document.documentElement = root;
globalThis.window = window;
globalThis.document = document;
await import('../../assets/js/accessibility.js');

assert.equal(root['--flz-font-scale'], '1');
toggle.listeners.get('click')();
assert.equal(panel.hidden, false);
assert.equal(toggle.getAttribute('aria-expanded'), 'true');

const increase = new Element();
increase.dataset.flzFont = 'increase';
panel.listeners.get('click')({target: increase});
assert.equal(root['--flz-font-scale'], '1.1');
assert.match(stored.get('flz_tagore_accessibility'), /110/);

const contrast = new Element();
contrast.dataset.flzContrast = 'high';
panel.listeners.get('click')({target: contrast});
assert.equal(document.body.classList.contains('flz-accessibility--high-contrast'), true);

listeners.get('keydown')({key: 'Escape'});
assert.equal(panel.hidden, true);
assert.equal(toggle.focused, true);

toggle.listeners.get('click')();
listeners.get('click')({target: new Element()});
assert.equal(panel.hidden, true);
