=== Plogins Anchor - Sticky Add to Cart for WooCommerce ===
Contributors: motylanogha
Tags: woocommerce, add to cart, sticky, conversion, product page
Requires at least: 6.5
Tested up to: 7.0
Requires PHP: 8.1
Requiere complementos: woocommerce
Stable tag: 1.0.1
License: GPLv2 or later
License URI: https://www.gnu.org/licenses/gpl-2.0.html

Mantiene el botón Añadir al carrito al alcance en páginas largas de productos WooCommerce con una barra adhesiva que aparece al desplazarse.

== Description ==

Anchor añade una barra delgada y adhesiva para añadir al carrito en la parte inferior de tu WooCommerce
páginas de un solo producto. Permanece oculto hasta que el comprador pasa por la página principal.
botón Añadir al carrito, luego se desliza a la vista mostrando el título del producto, el precio y un
botón de compra, por lo que aún se puede acceder al control de añadir al carrito en páginas largas.

En productos variables, la barra sigue la forma de variaciones nativas. como el comprador
elige opciones, el precio, el estado de las existencias y el botón de compra se actualizan para que coincidan con el
variación seleccionada. Anchor no carga su propia copia de jQuery; escucha
los eventos de variación WooCommerce ya se activan.

La barra se posiciona con CSS `posición: fija` y comienza oculta, por lo que se ubica
fuera del flujo de documentos y no empuja otros contenidos ni causa
el diseño cambia cuando aparece.

Anchor aún no está en el directorio de WordPress.org, por lo que si desea leer el
código, informar un error o sugerir un cambio, el repositorio está en
https://github.com/wppoland/plogins-anchor.

= Documentation and links =

* <strong>Documentación</strong> - https://plogins.com/es/plogins-anchor/docs/
* <strong>Página de complementos</strong> - https://plogins.com/es/plogins-anchor/
* <strong>Código fuente</strong> - https://github.com/wppoland/plogins-anchor
* <strong>Informes de errores y solicitudes de funciones</strong> - https://github.com/wppoland/plogins-anchor/issues


= Features =

* Barra adhesiva para añadir al carrito en páginas de productos individuales, que se revela una vez que el comprador pasa por el botón principal.
* Umbral de desplazamiento que estableces en píxeles (0 a 5000), para que decidas hasta dónde llega la barra.
* Muestra el título del producto, el precio y un botón de compra.
* En productos variables, el precio y el estado del stock rastrean la variación que el comprador ha seleccionado.
* Marcado como región ARIA con un estado de enfoque visible y una etiqueta de lector de pantalla.
* Honors prefiere el movimiento reducido y tiene un estilo de modo oscuro.
* La barra está fijada a la ventana gráfica y comienza oculta, por lo que no provoca cambios en el diseño.
* Se envía con un archivo POT para traducir y al eliminar el complemento se eliminan las dos opciones que almacena.
* Declara compatibilidad con HPOS y bloques de carrito/pago.

== Installation ==

1. Cargue el complemento en `/wp-content/plugins/anchor`, o instálelo a través de Complementos → Añadir nuevo.
2. Actívalo. WooCommerce debe estar activo.
3. Vaya a <strong>WooCommerce → Anchor</strong> para habilitar la barra y establecer el umbral de desplazamiento.

== Frequently Asked Questions ==

= Does it require WooCommerce? =

Sí. Anchor solo se ejecuta cuando WooCommerce está activo.

= Does it work with variable products? =

Sí. La barra refleja la forma de variaciones nativas de WooCommerce: elija opciones en la
La página y el precio de la barra, la disponibilidad y el botón de compra se actualizan para coincidir.

= Will it slow my product pages down or shift the layout? =

No. La hoja de estilo y el script se cargan solo en páginas de un solo producto, el script es
se difiere, y la barra se fija a la ventana gráfica y se oculta hasta que sea necesaria.
Debido a que comienza fuera del flujo del documento, mostrarlo no cambia la página.

= Can I change when the bar appears? =

Sí. Establezca el umbral de desplazamiento en píxeles en <strong>WooCommerce → Anchor</strong> (0–5000).

= Does it work on simple products? =

Sí. En productos simples, la barra muestra el título, el precio y el botón de añadir al carrito. En productos variables, rastrea la variación seleccionada.


= Does this plugin work on WordPress Multisite? =

Sí. Este complemento es compatible con WordPress Multisite. Activarlo en red o activarlo en sitios individuales; Cada sitio mantiene su propia configuración y datos.

== Screenshots ==

1. La barra adhesiva para añadir al carrito en la página de un producto.
2. La pantalla de configuración de Anchor en WooCommerce.

== External Services ==

Anchor no se conecta a ningún servicio externo. No envía datos fuera de tu sitio.
y no carga nada desde una CDN de terceros; su hoja de estilo y script (`assets/css/anchor.css`
y `assets/js/anchor.js`) se entregan desde su propia instalación y el script de front-end dice
solo un pequeño objeto `anchorConfig` (el umbral de desplazamiento) que WordPress imprime en línea.

Todos los datos de Anchor permanecen en tu base de datos: almacena dos opciones de carga automática,
`anchor_settings` (el umbral de activación y desplazamiento) y `anchor_db_version`,
y no guarda datos por producto. Ambas opciones se eliminan cuando eliminas el complemento.
Anchor no envía ningún correo electrónico ni realiza ninguna solicitud HTTP propia.

== Changelog ==

= 1.0.1 =
* Primera versión estable.

= 0.1.3 =
* Renombrado a Plogins Anchor para WooCommerce para obtener un nombre de complemento más distintivo.

= 0.1.2 =
* Añade la acción `anchor/bar_rendered` y el evento frontal `anchor:bar-visible` para análisis PRO.

= 0.1.1 =
* Filtro `anchor/bar_visible` para que PRO y el código personalizado puedan ocultar la barra por producto sin cargar activos.

= 0.1.0 =
* Lanzamiento inicial: una barra adhesiva para añadir al carrito en páginas de productos individuales, que se revela al desplazarse, con un umbral de desplazamiento configurable y sincronización de precio/disponibilidad según las variaciones.
