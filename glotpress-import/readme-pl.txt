=== Plogins Anchor - Sticky Add to Cart for WooCommerce ===
Contributors: motylanogha
Tags: woocommerce, add to cart, sticky, conversion, product page
Requires at least: 6.5
Tested up to: 7.0
Requires PHP: 8.1
Wymaga wtyczek: woocommerce
Stable tag: 1.0.1
License: GPLv2 or later
License URI: https://www.gnu.org/licenses/gpl-2.0.html

Utrzymuje przycisk „dodaj do koszyka” na długich stronach produktów WooCommerce za pomocą lepkiego paska wyświetlanego podczas przewijania.

== Description ==

Anchor dodaje smukły, lepki pasek dodawania do koszyka na dole Twojego WooCommerce
strony pojedynczych produktów. Pozostaje ukryty, dopóki kupujący nie przejdzie obok strony głównej
przycisk „dodaj do koszyka”, a następnie wyświetli się tytuł produktu, cena i a
przycisk kup, dzięki czemu opcja dodawania do koszyka będzie nadal dostępna na długich stronach.

W przypadku produktów zmiennych pasek ma formę natywnych odmian. Jako kupujący
wybiera opcje, cenę, stan zapasów i aktualizację przycisku Kup, aby odpowiadały
wybrana odmiana. Anchor nie ładuje własnej kopii jQuery; tego słucha
zdarzenia związane z odmianą WooCommerce już się uruchamia.

Pasek jest pozycjonowany za pomocą CSS „position: fix” i zaczyna być ukryty, więc pozostaje
poza obiegiem dokumentów i nie przesuwa innych treści ani nie powoduje
zmiana układu, gdy się pojawi.

Kotwicy nie ma jeszcze w katalogu WordPress.org, więc jeśli chcesz przeczytać
kodu, zgłoś błąd lub zasugeruj zmianę, repozytorium znajduje się pod adresem
https://github.com/wppoland/plogins-anchor.

= Documentation and links =

* <strong>Dokumentacja</strong> - https://plogins.com/pl/plogins-anchor/docs/
* <strong>Strona wtyczki</strong> - https://plogins.com/pl/plogins-anchor/
* <strong>Kod źródłowy</strong> - https://github.com/wppoland/plogins-anchor
* <strong>Raporty o błędach i prośby o nowe funkcje</strong> - https://github.com/wppoland/plogins-anchor/issues


= Features =

* Przyklejony pasek dodawania do koszyka na stronach poszczególnych produktów, widoczny po przewinięciu przez kupującego obok głównego przycisku.
* Próg przewijania ustawiony w pikselach (od 0 do 5000), więc decydujesz, jak daleko w dół pasek się zacznie.
* Pokazuje tytuł produktu, cenę i przycisk Kup.
* W przypadku produktów zmiennych cena i stan zapasów śledzą odmianę wybraną przez kupującego.
* Oznaczony jako region ARIA z widocznym stanem skupienia i etykietą czytnika ekranu.
* Honors preferuje tryb ograniczonego ruchu i ma styl ciemny.
* Pasek jest przymocowany do rzutni i zaczyna być ukryty, więc nie powoduje zmiany układu.
* Dostarczany z plikiem POT do tłumaczenia, a usunięcie wtyczki powoduje usunięcie dwóch przechowywanych w niej opcji.
* Deklaruje kompatybilność HPOS i bloków koszyka/kasy.

== Installation ==

1. Prześlij wtyczkę do `/wp-content/plugins/anchor` lub zainstaluj poprzez Wtyczki → Dodaj nową.
2. Aktywuj. WooCommerce musi być aktywny.
3. Przejdź do <strong>WooCommerce → Anchor</strong>, aby włączyć pasek i ustawić próg przewijania.

== Frequently Asked Questions ==

= Does it require WooCommerce? =

Tak. Anchor działa tylko wtedy, gdy WooCommerce jest aktywny.

= Does it work with variable products? =

Tak. Pasek odzwierciedla natywną formę odmian WooCommerce: wybierz opcje na stronie
stronę oraz cenę paska, dostępność i aktualizację przycisku Kup.

= Will it slow my product pages down or shift the layout? =

Nie. Arkusz stylów i skrypt ładują się tylko na stronach pojedynczych produktów
zostaje odroczone, a pasek jest przymocowany do rzutni i ukryty do czasu, aż będzie potrzebny.
Ponieważ zaczyna się poza obiegiem dokumentu, pokazanie go nie powoduje przesunięcia strony.

= Can I change when the bar appears? =

Tak. Ustaw próg przewijania w pikselach w obszarze <strong>WooCommerce → Anchor</strong> (0–5000).

= Does it work on simple products? =

Tak. W przypadku prostych produktów pasek pokazuje tytuł, cenę i przycisk „dodaj do koszyka”. W przypadku produktów zmiennych śledzi wybraną odmianę.


= Does this plugin work on WordPress Multisite? =

Tak. Ta wtyczka jest kompatybilna z WordPress Multisite. Aktywuj go w sieci lub aktywuj na poszczególnych stronach; każda witryna przechowuje własne ustawienia i dane.

== Screenshots ==

1. Przyklejony pasek „dodaj do koszyka” na stronie produktu.
2. Ekran ustawień Anchor w WooCommerce.

== External Services ==

Anchor nie łączy się z żadnymi usługami zewnętrznymi. Nie wysyła żadnych danych z Twojej witryny
i nie ładuje niczego z zewnętrznego CDN; jego arkusz stylów i skrypt (`assets/css/anchor.css`
i `assets/js/anchor.js`) są obsługiwane z Twojej własnej instalacji, a skrypt front-end czyta
tylko mały obiekt `anchorConfig` (próg przewijania), który WordPress drukuje w tekście.

Wszystkie dane Anchora pozostają w Twojej bazie danych: przechowuje dwie automatycznie ładowane opcje,
`anchor_settings` (próg włączania i przewijania) oraz `anchor_db_version`,
i nie przechowuje żadnych danych dotyczących poszczególnych produktów. Obie opcje zostaną usunięte po usunięciu wtyczki.
Anchor nie wysyła żadnych wiadomości e-mail ani nie wysyła własnych żądań HTTP.

== Changelog ==

= 1.0.1 =
* Pierwsza stabilna wersja.

= 0.1.3 =
* Zmieniono nazwę na Plogins Anchor dla WooCommerce, aby uzyskać bardziej charakterystyczną nazwę wtyczki.

= 0.1.2 =
* Dodaj akcję `anchor/bar_rendered` i zdarzenie front-end `anchor:bar-visible` dla analityki PRO.

= 0.1.1 =
* Filtr „anchor/bar_visible”, dzięki któremu PRO i kod niestandardowy mogą ukryć pasek dla każdego produktu bez ładowania zasobów.

= 0.1.0 =
* Pierwsza wersja: przyklejony pasek dodawania do koszyka na stronach poszczególnych produktów, widoczny podczas przewijania, z konfigurowalnym progiem przewijania i synchronizacją ceny/dostępności uwzględniającą różnice.
