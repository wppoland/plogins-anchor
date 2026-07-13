=== Plogins Anchor - Sticky Add to Cart for WooCommerce ===
Contributors: motylanogha
Tags: woocommerce, add to cart, sticky, conversion, product page
Requires at least: 6.5
Tested up to: 7.0
Requires PHP: 8.1
Erfordert Plugins: woocommerce
Stable tag: 1.0.2
License: GPLv2 or later
License URI: https://www.gnu.org/licenses/gpl-2.0.html

Hält den Button „In den Warenkorb“ auf langen WooCommerce-Produktseiten in Reichweite – mit einer Sticky-Leiste, die beim Scrollen erscheint.

== Description ==

Anchor fügt am unteren Rand deiner einzelnen WooCommerce-Produktseiten eine schmale Sticky-Leiste zum Hinzufügen zum Warenkorb hinzu. Sie bleibt verborgen, bis die Kundschaft am Haupt-Button „In den Warenkorb“ vorbeiscrollt, und schiebt sich dann ins Bild – mit Produkttitel, Preis und einem Kaufen-Button, sodass der Button zum Hinzufügen zum Warenkorb auch auf langen Seiten erreichbar bleibt.

Bei variablen Produkten folgt die Leiste dem nativen Variationen-Formular. Während die Kundschaft Optionen auswählt, aktualisieren sich Preis, Lagerstatus und Kaufen-Button passend zur gewählten Variante. Anchor lädt keine eigene Kopie von jQuery, sondern lauscht auf die Variations-Events, die WooCommerce ohnehin auslöst.

Die Leiste wird per CSS `position: fixed` positioniert und startet ausgeblendet, liegt also außerhalb des Dokumentflusses und schiebt keine anderen Inhalte weg und verursacht beim Erscheinen keine Layout-Verschiebung.

Anchor ist noch nicht im WordPress.org-Verzeichnis. Wenn du also den Code lesen, einen Fehler melden oder eine Änderung vorschlagen möchtest, findest du das Repository unter https://github.com/wppoland/plogins-anchor.

= Documentation and links =

* <strong>Dokumentation</strong> - https://plogins.com/de/plogins-anchor/docs/
* <strong>Plugin-Seite</strong> - https://plogins.com/de/plogins-anchor/
* <strong>Quellcode</strong> - https://github.com/wppoland/plogins-anchor
* <strong>Fehlerberichte und Funktionswünsche</strong> - https://github.com/wppoland/plogins-anchor/issues


= Features =

* Sticky-Add-to-Cart-Leiste auf einzelnen Produktseiten, eingeblendet, sobald die Kundschaft am Haupt-Button vorbeiscrollt.
* Scroll-Schwelle, die du in Pixeln festlegst (0 bis 5000), sodass du entscheidest, wie weit unten die Leiste einsetzt.
* Zeigt Produkttitel, Preis und einen Kaufen-Button.
* Bei variablen Produkten folgen Preis und Lagerstatus der von der Kundschaft gewählten Variante.
* Als ARIA-Region ausgezeichnet, mit sichtbarem Fokus-Status und Screenreader-Beschriftung.
* Berücksichtigt prefers-reduced-motion und hat einen Dark-Mode-Stil.
* Die Leiste ist am Viewport fixiert und startet ausgeblendet, sodass sie keine Layout-Verschiebung verursacht.
* Wird mit einer POT-Datei zur Übersetzung geliefert; beim Löschen des Plugins werden die beiden gespeicherten Optionen entfernt.
* Deklariert Kompatibilität mit HPOS und den Warenkorb-/Kassen-Blöcken.

== Installation ==

1. Lade das Plugin nach `/wp-content/plugins/anchor` hoch oder installiere es über Plugins → Installieren.
2. Aktiviere es. WooCommerce muss aktiv sein.
3. Gehe zu <strong>WooCommerce → Anchor</strong>, um die Leiste zu aktivieren und die Scroll-Schwelle festzulegen.

== Frequently Asked Questions ==

= Does it require WooCommerce? =

Ja. Anchor läuft nur, wenn WooCommerce aktiv ist.

= Does it work with variable products? =

Ja. Die Leiste spiegelt das native Variationen-Formular von WooCommerce wider: Wähle auf der Seite Optionen aus, und Preis, Verfügbarkeit und Kaufen-Button der Leiste aktualisieren sich passend.

= Will it slow my product pages down or shift the layout? =

Nein. Stylesheet und Skript werden nur auf einzelnen Produktseiten geladen, das Skript wird verzögert (deferred), und die Leiste ist am Viewport fixiert und ausgeblendet, bis sie gebraucht wird. Da sie außerhalb des Dokumentflusses startet, verschiebt ihr Erscheinen die Seite nicht.

= Can I change when the bar appears? =

Ja. Lege die Scroll-Schwelle in Pixeln unter <strong>WooCommerce → Anchor</strong> fest (0–5000).

= Does it work on simple products? =

Ja. Bei einfachen Produkten zeigt die Leiste Titel, Preis und den Button „In den Warenkorb“. Bei variablen Produkten folgt sie der gewählten Variante.


= Does this plugin work on WordPress Multisite? =

Ja. Dieses Plugin ist mit WordPress Multisite kompatibel. Aktiviere es netzwerkweit oder auf einzelnen Websites; jede Website behält ihre eigenen Einstellungen und Daten.

== Screenshots ==

1. Die Sticky-Add-to-Cart-Leiste auf einer Produktseite.
2. Der Anchor-Einstellungsbildschirm unter WooCommerce.

== External Services ==

Anchor stellt keine Verbindung zu externen Diensten her. Es sendet keine Daten von deiner Website und lädt nichts von einem Drittanbieter-CDN; sein Stylesheet und Skript (`assets/css/anchor.css` und `assets/js/anchor.js`) werden von deiner eigenen Installation ausgeliefert, und das Frontend-Skript liest nur ein kleines `anchorConfig`-Objekt (die Scroll-Schwelle), das WordPress inline ausgibt.

Alle Daten von Anchor bleiben in deiner Datenbank: Es speichert zwei Optionen mit deaktiviertem Autoload, `anchor_settings` (den Aktivieren-Schalter und die Scroll-Schwelle) und `anchor_db_version`, und behält keine produktbezogenen Daten. Beide Optionen werden entfernt, wenn du das Plugin löschst. Anchor sendet keine E-Mails und stellt keine eigenen HTTP-Anfragen.

== Translations ==

Plogins Anchor enthält polnische, deutsche und spanische Übersetzungen für die Plugin-Oberfläche. Die Textdomain ist `plogins-anchor`, sodass Sprachpakete von WordPress.org diese mitgelieferten Übersetzungen ebenfalls überschreiben oder erweitern können.

== Changelog ==

= 1.0.2 =
* Mitgelieferte polnische, deutsche und spanische Übersetzungen für die Plugin-Oberfläche hinzugefügt.

= 1.0.1 =
* Erste stabile Version.

= 0.1.3 =
* In Plogins Anchor für WooCommerce umbenannt, für einen eindeutigeren Plugin-Namen.

= 0.1.2 =
* Aktion `anchor/bar_rendered` und Frontend-Event `anchor:bar-visible` für PRO-Analysen hinzugefügt.

= 0.1.1 =
* Filter `anchor/bar_visible`, damit PRO und eigener Code die Leiste pro Produkt ausblenden können, ohne Assets zu laden.

= 0.1.0 =
* Erstveröffentlichung: eine Sticky-Add-to-Cart-Leiste auf einzelnen Produktseiten, beim Scrollen eingeblendet, mit konfigurierbarer Scroll-Schwelle und variationsbewusster Preis-/Verfügbarkeitssynchronisierung.
