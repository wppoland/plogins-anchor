=== Plogins Anchor - Sticky Add to Cart for WooCommerce ===
Contributors: motylanogha
Tags: woocommerce, add to cart, sticky, conversion, product page
Requires at least: 6.5
Tested up to: 7.0
Requires PHP: 8.1
Erfordert Plugins: woocommerce
Stable tag: 1.0.1
License: GPLv2 or later
License URI: https://www.gnu.org/licenses/gpl-2.0.html

Hält die Schaltfläche „Zum Warenkorb hinzufügen“ auf langen WooCommerce-Produktseiten mit einer Sticky-Leiste, die beim Scrollen erscheint, in Reichweite.

== Description ==

Anchor fügt am unteren Rand Ihres WooCommerce eine schlanke, klebrige Leiste zum Hinzufügen zum Warenkorb hinzu
einzelne Produktseiten. Es bleibt verborgen, bis der Käufer am Hauptbildschirm vorbeiscrollt
Klicke auf die Schaltfläche „Zum Warenkorb hinzufügen“ und gleite dann in die Ansicht mit dem Produkttitel, dem Preis und a
Klicke auf die Schaltfläche „Kaufen“, sodass die Steuerung zum Hinzufügen zum Warenkorb auch auf langen Seiten weiterhin erreichbar ist.

Bei variablen Produkten folgt die Leiste der nativen Variationsform. Als Käufer
wählt Optionen aus, der Preis, der Lagerstatus und die Schaltfläche „Kaufen“ werden entsprechend aktualisiert
ausgewählte Variante. Anchor lädt keine eigene Kopie von jQuery; es hört zu
Die Variationsereignisse, die WooCommerce bereits auslöst.

Die Leiste wird mit CSS „position: Fixed“ positioniert und beginnt versteckt, sodass sie sitzt
außerhalb des Dokumentenflusses und schiebt keine anderen Inhalte herum oder verursacht
Layoutverschiebung, wenn es erscheint.

Anchor befindet sich noch nicht im WordPress.org-Verzeichnis, wenn du also lesen möchten
Code eingeben, einen Fehler melden oder eine Änderung vorschlagen, das Repository findest du unter
https://github.com/wppoland/plogins-anchor.

= Documentation and links =

* <strong>Dokumentation</strong> - https://plogins.com/de/plogins-anchor/docs/
* <strong>Plugin-Seite</strong> - https://plogins.com/de/plogins-anchor/
* <strong>Quellcode</strong> – https://github.com/wppoland/plogins-anchor
* <strong>Fehlerberichte und Funktionsanfragen</strong> – https://github.com/wppoland/plogins-anchor/issues


= Features =

* Klebrige Add-to-Cart-Leiste auf einzelnen Produktseiten, die angezeigt wird, sobald der Käufer über die Hauptschaltfläche scrollt.
* Du legst den Scroll-Schwellenwert in Pixeln (0 bis 5000) fest, sodass du entscheiden, wie weit nach unten die Leiste einsetzt.
* Zeigt den Produkttitel, den Preis und eine Kaufen-Schaltfläche an.
* Bei variablen Produkten verfolgen Preis und Lagerstatus die vom Käufer ausgewählte Variante.
* Markiert als ARIA-Region mit sichtbarem Fokusstatus und Screenreader-Beschriftung.
* Honors bevorzugt reduzierte Bewegung und verfügt über einen Dunkelmodus-Stil.
* Die Leiste ist am Ansichtsfenster fixiert und beginnt ausgeblendet, sodass es nicht zu einer Layoutverschiebung kommt.
* Wird mit einer POT-Datei zur Übersetzung geliefert und durch das Löschen des Plugins werden die beiden darin gespeicherten Optionen entfernt.
* Erklärt die Kompatibilität von HPOS und Warenkorb-/Checkout-Blöcken.

== Installation ==

1. Lade das Plugin nach „/wp-content/plugins/anchor“ hoch oder installiere es über Plugins → Neu hinzufügen.
2. Aktiviere es. WooCommerce muss aktiv sein.
3. Gehe zu <strong>WooCommerce → Anchor</strong>, um die Leiste zu aktivieren und den Scroll-Schwellenwert festzulegen.

== Frequently Asked Questions ==

= Does it require WooCommerce? =

Ja. Anchor läuft nur, wenn WooCommerce aktiv ist.

= Does it work with variable products? =

Ja. Die Leiste spiegelt die native Variationsform von WooCommerce wider: Wähle Optionen auf der aus
Seite und der Preis, die Verfügbarkeit und die Schaltfläche „Kaufen“ der Bar werden entsprechend aktualisiert.

= Will it slow my product pages down or shift the layout? =

Nein. Das Stylesheet und das Skript werden nur auf einzelnen Produktseiten geladen, das Skript jedoch nicht
verschoben, und die Leiste wird am Ansichtsfenster fixiert und ausgeblendet, bis sie benötigt wird.
Da es außerhalb des Dokumentflusses beginnt, wird die Seite durch die Anzeige nicht verschoben.

= Can I change when the bar appears? =

Ja. Lege den Scroll-Schwellenwert in Pixeln unter <strong>WooCommerce → Anchor</strong> fest (0–5000).

= Does it work on simple products? =

Ja. Bei einfachen Produkten zeigt die Leiste den Titel, den Preis und die Schaltfläche „In den Warenkorb“ an. Bei variablen Produkten wird die ausgewählte Variante verfolgt.


= Does this plugin work on WordPress Multisite? =

Ja. Dieses Plugin ist mit WordPress Multisite kompatibel. Aktiviere es im Netzwerk oder auf einzelnen Websites. Jede Site behält ihre eigenen Einstellungen und Daten.

== Screenshots ==

1. Die klebrige Add-to-Cart-Leiste auf einer Produktseite.
2. Der Bildschirm mit den Ankereinstellungen unter WooCommerce.

== External Services ==

Anchor stellt keine Verbindung zu externen Diensten her. Es werden keine Daten von deiner Website gesendet
und lädt nichts von einem Drittanbieter-CDN; sein Stylesheet und Skript (`assets/css/anchor.css`
und „assets/js/anchor.js“) werden von deiner eigenen Installation bereitgestellt und das Front-End-Skript liest
nur ein kleines „anchorConfig“-Objekt (der Scroll-Schwellenwert), das WordPress inline druckt.

Alle Daten von Anchor bleiben in deiner Datenbank: Es werden zwei Optionen zum automatischen Laden gespeichert:
„anchor_settings“ (der Schwellenwert zum Aktivieren des Umschaltens und Scrollens) und „anchor_db_version“,
und speichert keine produktbezogenen Daten. Beide Optionen werden entfernt, wenn du das Plugin löschen.
Anchor sendet keine E-Mails und stellt keine eigenen HTTP-Anfragen.

== Changelog ==

= 1.0.1 =
* Erste stabile Version.

= 0.1.3 =
* Für einen eindeutigeren Plugin-Namen in Plogins Anchor for WooCommerce umbenannt.

= 0.1.2 =
* Füge die Aktion „anchor/bar_rendered“ und das Front-End-Ereignis „anchor:bar-visible“ für PRO-Analysen hinzu.

= 0.1.1 =
* „anchor/bar_visible“-Filter, damit PRO- und benutzerdefinierter Code die Leiste pro Produkt ausblenden kann, ohne Assets zu laden.

= 0.1.0 =
* Erstveröffentlichung: eine klebrige Add-to-Cart-Leiste auf einzelnen Produktseiten, die beim Scrollen angezeigt wird, mit einem konfigurierbaren Scroll-Schwellenwert und einer Variations-bezogenen Preis-/Verfügbarkeitssynchronisierung.
