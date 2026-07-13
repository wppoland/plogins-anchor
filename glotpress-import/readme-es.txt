=== Plogins Anchor - Sticky Add to Cart for WooCommerce ===
Contributors: motylanogha
Tags: woocommerce, add to cart, sticky, conversion, product page
Requires at least: 6.5
Tested up to: 7.0
Requires PHP: 8.1
Requiere plugins: woocommerce
Stable tag: 1.0.2
License: GPLv2 or later
License URI: https://www.gnu.org/licenses/gpl-2.0.html

Mantiene el botón «Añadir al carrito» al alcance en las páginas largas de producto de WooCommerce con una barra fija que aparece al desplazarte.

== Description ==

Anchor añade una barra fina y fija para añadir al carrito en la parte inferior de tus páginas de producto individuales de WooCommerce. Permanece oculta hasta que el cliente se desplaza más allá del botón principal de añadir al carrito y, entonces, aparece deslizándose y muestra el título del producto, el precio y un botón de compra, de modo que el control de añadir al carrito sigue estando al alcance en las páginas largas.

En los productos variables, la barra sigue el formulario de variaciones nativo. A medida que el cliente elige opciones, el precio, el estado del stock y el botón de compra se actualizan para coincidir con la variación seleccionada. Anchor no carga su propia copia de jQuery: escucha los eventos de variación que WooCommerce ya dispara.

La barra se posiciona con CSS `position: fixed` y empieza oculta, así que queda fuera del flujo del documento y no desplaza el resto del contenido ni provoca saltos de diseño cuando aparece.

Anchor todavía no está en el directorio de WordPress.org, así que si quieres leer el código, informar de un error o proponer un cambio, el repositorio está en https://github.com/wppoland/plogins-anchor.

= Documentation and links =

* <strong>Documentación</strong> - https://plogins.com/es/plogins-anchor/docs/
* <strong>Página del plugin</strong> - https://plogins.com/es/plogins-anchor/
* <strong>Código fuente</strong> - https://github.com/wppoland/plogins-anchor
* <strong>Informes de errores y peticiones de funciones</strong> - https://github.com/wppoland/plogins-anchor/issues


= Features =

* Barra fija para añadir al carrito en las páginas de producto individuales, que se muestra en cuanto el cliente se desplaza más allá del botón principal.
* Umbral de desplazamiento que defines en píxeles (de 0 a 5000), para que decidas a qué altura aparece la barra.
* Muestra el título del producto, el precio y un botón de compra.
* En los productos variables, el precio y el estado del stock siguen la variación que ha seleccionado el cliente.
* Marcada como región ARIA, con un estado de foco visible y una etiqueta para lectores de pantalla.
* Respeta prefers-reduced-motion y tiene un estilo para modo oscuro.
* La barra está fijada a la ventana del navegador y empieza oculta, así que no provoca saltos de diseño.
* Se entrega con un archivo POT para traducir, y al borrar el plugin se eliminan las dos opciones que guarda.
* Declara compatibilidad con HPOS y con los bloques de carrito/pago.

== Installation ==

1. Sube el plugin a `/wp-content/plugins/anchor` o instálalo desde Plugins → Añadir nuevo.
2. Actívalo. WooCommerce debe estar activo.
3. Ve a <strong>WooCommerce → Anchor</strong> para activar la barra y definir el umbral de desplazamiento.

== Frequently Asked Questions ==

= Does it require WooCommerce? =

Sí. Anchor solo funciona cuando WooCommerce está activo.

= Does it work with variable products? =

Sí. La barra refleja el formulario de variaciones nativo de WooCommerce: elige las opciones en la página y el precio, la disponibilidad y el botón de compra de la barra se actualizan para coincidir.

= Will it slow my product pages down or shift the layout? =

No. La hoja de estilos y el script se cargan solo en las páginas de producto individuales, el script se difiere y la barra está fijada a la ventana del navegador y oculta hasta que hace falta. Como empieza fuera del flujo del documento, mostrarla no desplaza la página.

= Can I change when the bar appears? =

Sí. Define el umbral de desplazamiento en píxeles en <strong>WooCommerce → Anchor</strong> (0–5000).

= Does it work on simple products? =

Sí. En los productos simples, la barra muestra el título, el precio y el botón de añadir al carrito. En los productos variables, sigue la variación seleccionada.


= Does this plugin work on WordPress Multisite? =

Sí. Este plugin es compatible con WordPress Multisite. Actívalo en red o en sitios concretos; cada sitio conserva sus propios ajustes y datos.

== Screenshots ==

1. La barra fija para añadir al carrito en la página de un producto.
2. La pantalla de ajustes de Anchor en WooCommerce.

== External Services ==

Anchor no se conecta a ningún servicio externo. No envía datos fuera de tu sitio y no carga nada desde una CDN de terceros; su hoja de estilos y su script (`assets/css/anchor.css` y `assets/js/anchor.js`) se sirven desde tu propia instalación, y el script del frontend solo lee un pequeño objeto `anchorConfig` (el umbral de desplazamiento) que WordPress imprime en línea.

Todos los datos de Anchor permanecen en tu base de datos: guarda dos opciones sin autocarga, `anchor_settings` (el interruptor de activación y el umbral de desplazamiento) y `anchor_db_version`, y no guarda datos por producto. Ambas opciones se eliminan cuando borras el plugin. Anchor no envía ningún correo electrónico ni realiza peticiones HTTP propias.

== Translations ==

Plogins Anchor incluye traducciones al polaco, al alemán y al español para la interfaz del plugin. El dominio de texto es `plogins-anchor`, así que los paquetes de idioma de WordPress.org también pueden sustituir o ampliar estas traducciones incluidas.

== Changelog ==

= 1.0.2 =
* Añadidas traducciones incluidas al polaco, al alemán y al español para la interfaz del plugin.

= 1.0.1 =
* Primera versión estable.

= 0.1.3 =
* Renombrado a Plogins Anchor para WooCommerce, para un nombre de plugin más distintivo.

= 0.1.2 =
* Añadida la acción `anchor/bar_rendered` y el evento de frontend `anchor:bar-visible` para la analítica PRO.

= 0.1.1 =
* Filtro `anchor/bar_visible` para que PRO y el código personalizado puedan ocultar la barra por producto sin cargar recursos.

= 0.1.0 =
* Lanzamiento inicial: una barra fija para añadir al carrito en las páginas de producto individuales, que se muestra al desplazarse, con un umbral de desplazamiento configurable y sincronización de precio/disponibilidad según la variación.
