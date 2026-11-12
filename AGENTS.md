# Regeln für flz-tagore

Dieses Repository enthält ausschließlich das Classic Theme `flz-tagore`.
Es verantwortet Templates, Styles und präsentationsbezogene WordPress-Hooks.
Fachlogik, Rollen, Datenhaltung, Formulardaten und Workflows bleiben in
Plugins. Der Startpunkt ist Clean Room: Dateien, Assets oder Code aus
`deep-light`, `deepcore` oder anderen Fremdthemes werden nicht übernommen,
ohne dass Herkunft, Lizenz und konkreter Bedarf vorab geklärt sind.

- Vor sichtbaren Änderungen einen Struktur-/Rendering-Test ergänzen und zuerst
  rot ausführen; responsive, Tastatur- und WordPress-Prüfungen separat belegen.
- Template-Ausgaben werden kontextbezogen escaped. Asset-Registrierung erfolgt
  über WordPress-Core-APIs; keine externen Font- oder Tracking-Anfragen.
- Kein Themewechsel, keine Laufzeitverlinkung, keine Import- oder DDEV-Änderung
  ohne ausdrückliche Freigabe. Der Rückbau bleibt der Wechsel auf das bisherige
  Theme.
- Mindestens `./scripts/check-fast` ausführen. Eine DDEV- oder Browserprüfung
  wird nie durch einen Strukturtest ersetzt.
## Commit-, Coverage- und Release-Gates

- Der Übernahmestand ist Phase 2: CI sowie PHP- und JavaScript-Coverage
  sind remote geprüft; die Baselines bleiben als Ratschen verbindlich.
  Die manuelle Abnahme und das Release-Gate bleiben davon unberührt.
- Die Commit-, Coverage- und Release-Gates sind im
  `docs/manual-acceptance.md` dokumentiert; für ausführbaren neuen oder
  wesentlich geänderten Code gilt das Ziel von 85 Prozent Line-Coverage.
- Keine Commits, Pushes oder Deployments ohne ausdrückliche Freigabe; niemals
  `git add .` verwenden.

## Parent-Governance-Vertrag: 1

- Die für dieses Komponenten-Repository anwendbaren Regeln des
  Parent-Workspaces sind verbindlich. Dazu gehören insbesondere gemeinsame
  Architektur-, Sicherheits-, Plugin- und Theme-Verträge,
  Repositorygrenzen sowie Workspace-, Quality-, Delivery- und Release-Gates.
- Diese lokale `AGENTS.md` und die lokalen Skills bleiben die vollständige,
  ohne Parent-Checkout arbeitsfähige Repository-Steuerung. Die anwendbaren
  Parent-Regeln werden dafür hier oder in den lokalen Skills mitgeführt.
- Vor Arbeit an der Komponente ist der lokale Skill
  `work-in-wordpress-extension` zu verwenden. Für beobachtbare Änderungen
  gilt zusätzlich der lokale Skill `test-driven-wordpress-change`.
- Repository-lokale Regeln dürfen Parent-Verträge konkretisieren und
  verschärfen, aber nicht abschwächen oder umgehen.
- Bei einem Widerspruch gilt bis zur Klärung die strengere Regel. Die Arbeit
  stoppt, bis die kanonische Quelle bestimmt, die Regelprojektionen
  synchronisiert und eine erforderliche Entscheidung dokumentiert ist.
- Ist der Parent-Workspace nicht verfügbar, bleibt die lokale Steuerung
  wirksam. Vor Cross-Component-, Release- oder Delivery-Arbeit muss ein
  vermuteter neuerer Parent-Stand oder eine Regelungslücke zuerst gegen den
  Parent geprüft werden.
