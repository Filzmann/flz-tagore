# FLZ Tagore Theme 0.2.1

`flz-tagore` ist ein schlankes, eigenständiges Classic Theme für das
Tagore-Gymnasium. Es enthält ausschließlich Templates, Styles und
präsentationsbezogene WordPress-Integration; fachliche Daten und Workflows
bleiben in Plugins.

## Architekturentscheidung

Das Theme startet als **Classic Theme**. Die lokale Ausgangsinstanz nutzt ein
Classic Theme; für eine Block-Theme-Migration gibt es noch keine belastbare
Inventur redaktioneller Blockstrukturen. Die Entscheidung ist bewusst
reversibel: Der Rückbau erfolgt durch Wechsel auf das zuvor aktive Theme.

Der Code ist Clean Room. Er übernimmt weder Dateien noch Assets aus
`deep-light`, `deepcore` oder anderen Fremdkomponenten.

Unter **Design → Customizer → Design-Grundlagen** lassen sich die zentralen
Farben für Inhalte, Navigation, Formulare und Floating-Buttons sowie
Inhaltsbreiten, Abstände, Header- und Untermenümaße ändern. Alle Werte werden
validiert und bleiben innerhalb sinnvoller Grenzen. **Bedienhilfen und
Feedback** schaltet die beiden Floating-Buttons unabhängig voneinander.

Bei der Aktivierung ergänzt das Theme das vorhandene **Zusätzliche CSS** um
einen kommentierten, editierbaren Starter. Bereits vorhandenes CSS bleibt
unverändert. CSS, das nur für eine Seite gelten soll, gehört in das
Metafeld **Seitenbezogenes CSS** im jeweiligen Seiteneditor. CSS von Tangible
Templates oder Popup Maker bleibt in den zugehörigen Inhaltstypen.

`screenshot.png` ist die Vorschau im WordPress-Theme-Bildschirm.

## Unterstützte Umgebung

- WordPress ab 6.6
- PHP 8.1 bis 8.5
- aktuelle Firefox-, Chromium- und Safari-Versionen

## Lokale Prüfung

```bash
./scripts/check-fast
```

Der aktuelle Abnahmestatus und die offenen Nachweise stehen in
[`docs/manual-acceptance.md`](docs/manual-acceptance.md).
