<?php
/**
 * PRO upsell content, generated from the plogins.com registry by
 * scripts/gen-pro-upsell.mjs. The admin upsell renders this; curate the
 * feature list to fit this plugin's settings screen (do not invent features).
 *
 * @package plogins-anchor-pro
 */

defined('ABSPATH') || exit;

return [
    'name'       => 'Anchor Pro',
    'url'        => 'https://plogins.com/plogins-anchor-pro/pricing/',
    'sellable'   => true,
    'price_from' => 19,
    'currency'   => 'EUR',
    'lead'       => [
        'en' => 'Custom bar button colour, label, placement rules, campaign scheduling and conversion analytics ship today.',
        'pl' => 'Własny kolor i etykieta przycisku, reguły widoczności, harmonogram kampanii i analityka konwersji są już dostępne.',
    ],
    'features'   => [
        [
            'en' => ['title' => 'Custom bar button colour and label', 'desc' => 'Override the sticky bar buy-button text and colour on WooCommerce > Anchor.'],
            'pl' => ['title' => 'Własny kolor i etykieta przycisku', 'desc' => 'Nadpisz tekst i kolor przycisku zakupu na przyklejonym pasku w WooCommerce > Anchor.'],
        ],
        [
            'en' => ['title' => 'Placement rules', 'desc' => 'Show or hide the sticky bar on selected products and categories, include-only or exclude modes.'],
            'pl' => ['title' => 'Reguły widoczności', 'desc' => 'Pokaż lub ukryj pasek na wybranych produktach i kategoriach, tryb tylko wybrane lub wyklucz wybrane.'],
        ],
        [
            'en' => ['title' => 'Campaign scheduling', 'desc' => 'Reveal the sticky bar only during a start/end promotional window on WooCommerce > Anchor.'],
            'pl' => ['title' => 'Harmonogram kampanii', 'desc' => 'Pokaż pasek tylko w oknie start/koniec promocji na WooCommerce > Anchor.'],
        ],
        [
            'en' => ['title' => 'Conversion analytics', 'desc' => 'Track bar views, button taps and add-to-cart counts per product on WooCommerce > Anchor Analytics.'],
            'pl' => ['title' => 'Analityka konwersji', 'desc' => 'Zliczaj wyświetlenia paska, kliknięcia przycisku i dodania do koszyka per produkt na WooCommerce > Anchor Analytics.'],
        ],
        [
            'en' => ['title' => 'Extends free Anchor', 'desc' => 'Requires the active free Anchor plugin; delivered through Freemius with licensing and automatic updates.'],
            'pl' => ['title' => 'Rozszerza darmowy Anchor', 'desc' => 'Wymaga aktywnej darmowej wtyczki Anchor; dostarczany przez Freemius z licencją i automatycznymi aktualizacjami.'],
        ],
    ],
];
