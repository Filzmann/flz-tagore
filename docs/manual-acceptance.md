# Manuelles Abnahmeprotokoll

## Kopfdaten

- Komponente: `flz-tagore` (Classic Theme)
- Stand: lokal aktiv; eine getrennte Vergleichsinstanz unter
  `https://tagore-deep-baseline.ddev.site` hält denselben Snapshot mit
  `flz-tagore` und deaktiviertem Max Mega Menu bereit.
- Rückbau: Max Mega Menu in der jeweiligen Instanz wieder aktivieren; der
  Theme-Rückbau bleibt der Wechsel auf das zuvor aktive Theme.
- Deepcore bleibt in der normalen Laufzeit bis zur Browserabnahme aktiv. Es
  lädt themefremde Basis-, Icon-, Header- und Navigation-Assets global; seine
  Deaktivierung ist deshalb ein eigener, prüfbarer Schritt und kein Teil eines
  bloßen Themewechsels.

## Automatisierte Nachweise

- `./scripts/check-fast` prüft Theme-Struktur und JavaScript-Smoke.
- Die PHP-Line-Coverage liegt lokal bei 7,87 Prozent, die JavaScript-
  Line-Coverage bei 92,24 Prozent; beide Gates sind als No-Regression-
  Baseline `configured`, bis ein grüner Remote-Lauf vorliegt. Die PHP-
  Baseline enthält bewusst keine künstliche WordPress-Simulation und muss
  mit echten Theme-Integrationstests ausgebaut werden.
- Die getrennte Vergleichsinstanz belegt, dass `flz-tagore` mit deaktiviertem
  Max Mega Menu und Deepcore bootet. Die visuelle Startseitenprüfung erfolgte
  bei 1440 und 390 CSS-Pixeln; die vollständige Tastatur- und Seitenabnahme
  steht noch aus.
- Die Sichtprüfung der Erstausgabe wurde am 2026-10-25 abgeschlossen. Die
  nachstehenden weitergehenden Prüffälle bleiben bewusst als Nachweise für
  spätere Kundenanforderungen dokumentiert.

## Manuelle Prüffälle

- [ ] Referenzseiten (Start, Seite, Beitrag, Archiv, Suche, 404) auf Desktop,
  Tablet und Mobil inventarisieren.
- [ ] Sichtbare Pluginformulare einschließlich AGs, Probeunterricht und
  Elternsprechtag prüfen.
- [ ] Header, Navigation, Footer, Logo, Widgets, zusätzliches CSS und
  Theme-Mods als Migrationsmatrix dokumentieren.
- [ ] Die FLZ-Footer-Navigation mit dem bisherigen Footer-Menü (Term-ID `7`)
  belegen und Inhalt, Links sowie kleine Viewports prüfen.
- [ ] Die vier belegten Flyouts (UNSERE SCHULE, FACHBEREICHE,
  FÖRDERVEREIN, LERNFÖRDERUNG) in der Vergleichsinstanz mit Maus und
  Tab/Shift+Tab prüfen: Öffnen, Unterseiten erreichen, Fokus sichtbar,
  Schließen durch Verlassen des Menüs.
- [ ] Dieselben Flyouts bei 320, 768 und 1440 CSS-Pixeln prüfen; auf kleinen
  Viewports dürfen sie einspaltig bleiben und weder horizontal scrollen noch
  Inhalte verdecken.
- [ ] Seiten mit Menüebene drei prüfen (insbesondere Schulprofil,
  Organisation und Fachbereiche); keine Unterseite darf aus der Navigation
  verschwinden.
- [ ] In der Vergleichsinstanz prüfen, dass kein Frontend-Asset, Shortcode
  oder PHP-Fatal von Max Mega Menu abhängt.
- [ ] In der Vergleichsinstanz Deepcore deaktivieren und auf jeder
  Referenzseite prüfen: keine `/deepcore/`-Assets, keine `.whb-*`- oder
  `.deep-*`-Abhängigkeiten, Header/Sticky-Navigation, Popup Maker, Complianz
  und Contact Form 7 funktionieren weiterhin.
- [ ] Vor der endgültigen Deaktivierung Deep-spezifische CPTs (`wbf_footer`,
  `mega_menu`) und die drei belegten alten Sidebar-Widgets inventarisieren;
  nur tatsächlich sichtbare Inhalte werden in die neue Verantwortung
  überführt.
- [ ] Erst nach diesen Prüffällen Max Mega Menu in der normalen lokalen
  FLZ-Instanz deaktivieren; Rückbau ist `wp plugin activate megamenu`.
- [ ] Erst nach der Deepcore-Prüfung das Plugin in der normalen lokalen
  FLZ-Instanz deaktivieren; Rückbau ist `wp plugin activate deepcore`.
- [ ] Tastatur, sichtbaren Fokus, Skip-Link, Landmarken und Kontrast prüfen.
- [ ] Rückbau auf das bisherige Theme dokumentieren und testen.

## Abschlussentscheidung

Erstausgabe visuell abgenommen. Das formale Release-Gate bleibt bis zu den
noch offenen weitergehenden Nachweisen blockiert; das betrifft dieses lokale
Theme-Paket und keine produktive Auslieferung.
