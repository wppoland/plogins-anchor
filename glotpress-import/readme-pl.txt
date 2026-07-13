=== Plogins Anchor - Sticky Add to Cart for WooCommerce ===
Contributors: motylanogha
Tags: woocommerce, add to cart, sticky, conversion, product page
Requires at least: 6.5
Tested up to: 7.0
Requires PHP: 8.1
Wymaga wtyczek: woocommerce
Stable tag: 1.0.2
License: GPLv2 or later
License URI: https://www.gnu.org/licenses/gpl-2.0.html

Utrzymuje przycisk „Dodaj do koszyka” w zasięgu na długich stronach produktów WooCommerce dzięki przyklejonemu paskowi, który pojawia się podczas przewijania.

== Description ==

Anchor dodaje smukły, przyklejony pasek „Dodaj do koszyka” na dole stron pojedynczych produktów WooCommerce. Pozostaje ukryty, dopóki kupujący nie przewinie poza główny przycisk „Dodaj do koszyka”, a następnie wsuwa się do widoku, pokazując tytuł produktu, cenę i przycisk zakupu, dzięki czemu element dodawania do koszyka jest wciąż w zasięgu na długich stronach.

W przypadku produktów zmiennych pasek podąża za natywnym formularzem wariantów WooCommerce. Gdy kupujący wybiera opcje, cena, stan magazynowy i przycisk zakupu aktualizują się, aby odpowiadały wybranemu wariantowi. Anchor nie ładuje własnej kopii jQuery — nasłuchuje zdarzeń wariantów, które WooCommerce już wywołuje.

Pasek jest pozycjonowany za pomocą CSS `position: fixed` i początkowo jest ukryty, więc znajduje się poza normalnym układem dokumentu i nie przesuwa innych treści ani nie powoduje przeskoku układu, gdy się pojawia.

Anchor nie jest jeszcze w katalogu WordPress.org, więc jeśli chcesz przejrzeć kod, zgłosić błąd lub zaproponować zmianę, repozytorium znajdziesz pod adresem https://github.com/wppoland/plogins-anchor.

= Documentation and links =

* <strong>Dokumentacja</strong> - https://plogins.com/pl/plogins-anchor/docs/
* <strong>Strona wtyczki</strong> - https://plogins.com/pl/plogins-anchor/
* <strong>Kod źródłowy</strong> - https://github.com/wppoland/plogins-anchor
* <strong>Zgłoszenia błędów i propozycje funkcji</strong> - https://github.com/wppoland/plogins-anchor/issues


= Features =

* Przyklejony pasek „Dodaj do koszyka” na stronach pojedynczych produktów, odsłaniany, gdy kupujący przewinie poza główny przycisk.
* Próg przewijania ustawiany w pikselach (od 0 do 5000), więc to Ty decydujesz, jak nisko pasek się pojawia.
* Pokazuje tytuł produktu, cenę i przycisk zakupu.
* W przypadku produktów zmiennych cena i stan magazynowy śledzą wariant wybrany przez kupującego.
* Oznaczony jako region ARIA z widocznym stanem fokusu i etykietą dla czytników ekranu.
* Uwzględnia preferencję ograniczonego ruchu (prefers-reduced-motion) i ma styl trybu ciemnego.
* Pasek jest przypięty do okna przeglądarki i początkowo ukryty, więc nie powoduje przeskoku układu.
* Dostarczany z plikiem POT do tłumaczenia, a usunięcie wtyczki usuwa dwie przechowywane przez nią opcje.
* Deklaruje zgodność z HPOS oraz blokami koszyka/kasy.

== Installation ==

1. Wgraj wtyczkę do `/wp-content/plugins/anchor` lub zainstaluj przez Wtyczki → Dodaj nową.
2. Włącz ją. WooCommerce musi być aktywne.
3. Przejdź do <strong>WooCommerce → Anchor</strong>, aby włączyć pasek i ustawić próg przewijania.

== Frequently Asked Questions ==

= Does it require WooCommerce? =

Tak. Anchor działa tylko wtedy, gdy WooCommerce jest aktywne.

= Does it work with variable products? =

Tak. Pasek odzwierciedla natywny formularz wariantów WooCommerce: wybierz opcje na stronie, a cena, dostępność i przycisk zakupu na pasku zaktualizują się, aby pasowały.

= Will it slow my product pages down or shift the layout? =

Nie. Arkusz stylów i skrypt ładują się tylko na stronach pojedynczych produktów, skrypt jest odroczony, a pasek jest przypięty do okna przeglądarki i ukryty, dopóki nie jest potrzebny. Ponieważ zaczyna poza układem dokumentu, jego wyświetlenie nie przesuwa strony.

= Can I change when the bar appears? =

Tak. Ustaw próg przewijania w pikselach w <strong>WooCommerce → Anchor</strong> (0–5000).

= Does it work on simple products? =

Tak. W przypadku produktów prostych pasek pokazuje tytuł, cenę i przycisk „Dodaj do koszyka”. W przypadku produktów zmiennych śledzi wybrany wariant.


= Does this plugin work on WordPress Multisite? =

Tak. Ta wtyczka jest zgodna z WordPress Multisite. Włącz ją dla całej sieci lub w pojedynczych witrynach; każda witryna zachowuje własne ustawienia i dane.

== Screenshots ==

1. Przyklejony pasek „Dodaj do koszyka” na stronie produktu.
2. Ekran ustawień Anchor w WooCommerce.

== External Services ==

Anchor nie łączy się z żadną usługą zewnętrzną. Nie wysyła żadnych danych poza Twoją witrynę i nie ładuje niczego z zewnętrznego CDN; jego arkusz stylów i skrypt (`assets/css/anchor.css` i `assets/js/anchor.js`) są serwowane z Twojej własnej instalacji, a skrypt front-endu odczytuje jedynie mały obiekt `anchorConfig` (próg przewijania), który WordPress wypisuje w kodzie strony.

Wszystkie dane Anchor pozostają w Twojej bazie danych: przechowuje dwie opcje z wyłączonym autoloadem, `anchor_settings` (przełącznik włączenia i próg przewijania) oraz `anchor_db_version`, i nie przechowuje żadnych danych dla poszczególnych produktów. Obie opcje są usuwane po usunięciu wtyczki. Anchor nie wysyła e-maili ani nie wykonuje własnych żądań HTTP.

== Translations ==

Plogins Anchor zawiera polskie, niemieckie i hiszpańskie tłumaczenia interfejsu wtyczki. Domena tekstowa to `plogins-anchor`, więc pakiety językowe z WordPress.org mogą również nadpisać lub rozszerzyć te dołączone tłumaczenia.

== Changelog ==

= 1.0.2 =
* Dodano dołączone polskie, niemieckie i hiszpańskie tłumaczenia interfejsu wtyczki.

= 1.0.1 =
* Pierwsza stabilna wersja.

= 0.1.3 =
* Zmieniono nazwę na Plogins Anchor dla WooCommerce, aby nazwa wtyczki była bardziej charakterystyczna.

= 0.1.2 =
* Dodano akcję `anchor/bar_rendered` oraz zdarzenie front-endu `anchor:bar-visible` na potrzeby analityki PRO.

= 0.1.1 =
* Filtr `anchor/bar_visible`, dzięki któremu wersja PRO i własny kod mogą ukryć pasek dla danego produktu bez ładowania zasobów.

= 0.1.0 =
* Pierwsze wydanie: przyklejony pasek „Dodaj do koszyka” na stronach pojedynczych produktów, odsłaniany podczas przewijania, z konfigurowalnym progiem przewijania i synchronizacją ceny/dostępności uwzględniającą wariant.
