<?php
// This file is part of the custom Moodle elegance theme
//
// Moodle is free software: you can redistribute it and/or modify
// it under the terms of the GNU General Public License as published by
// the Free Software Foundation, either version 3 of the License, or
// (at your option) any later version.
//
// Moodle is distributed in the hope that it will be useful,
// but WITHOUT ANY WARRANTY; without even the implied warranty of
// MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
// GNU General Public License for more details.
//
// You should have received a copy of the GNU General Public License
// along with Moodle.  If not, see <http://www.gnu.org/licenses/>.


/**
 * Renderers to align Moodle's HTML with that expected by elegance
 *
 * @package    theme_elegance
 * @copyright  2014 Julian Ridden http://moodleman.net
 * @copyright  2015 Bas Brands
 * @authors    Bas Brands -  Bootstrap 3 work by Bas Brands, David Scotson
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

$string['choosereadme'] = '
<div class="clearfix">
<div class="well">
<h2>Elegance</h2>
<p><img class=img-polaroid src="elegance/pix/screenshot.png" /></p>
<p>Elegance es un tema de 2 columnas, limpio and muy personalizable, basado en Bootstrap 3.</p>
</div></div>';

$string['pluginname'] = 'Elegance';
$string['configtitle'] = 'Elegance';

$string['region-side-middle'] = 'Centro de la Home';
$string['region-hidden-dock'] = 'Sólo Admin';

$string['reader'] = 'Lector';

$string['mydashboard'] = 'Mi Tablero';

$string['customcss'] = 'CSS Personalizado';
$string['customcssdesc'] = 'Cualquier regla CSS que agregues a aquí se reflejará en todas las página, haciendo más fácil la personalización de este tema.';

$string['moodlemobilecss'] = 'CSS para la aplicación Moodle Mobile';
$string['moodlemobilecssdesc'] = 'La aplicación Moodle Mobile te permite deifinir una hoja de estilos externa para personalizar la aplicación.  Cualquier regla CSS que agregues aquí se mostrará en la aplicación oficial Moodle Mobile. Simplemente copya la URL de aquí abajo y agrégala en la configuración "mobilecssurl", dentro de "Web Services -> Mobile".';

$string['moodlemobilecsssettings'] = 'Hoja de estilos para Mobile';
$string['moodlemobilecsssettingsdesc'] = '{$a}';

$string['frontpagecontent'] = 'Contenido de la página principal';
$string['frontpagecontentdesc'] = 'Esta hubicación aparece como un texto destacado, debajo del slideshow en la página principal.';

$string['footnote'] = 'Nota al pié';
$string['footnotedesc'] = 'Lo que agregues aquí se mostrará en el pié de página de todas las páginas de tu sitio Moodle.';

$string['fixednavbar'] = 'Barra de navegación fija';
$string['fixednavbardesc'] = 'Activa la barra de navegación fija en la parte superior de las páginas';

$string['invert'] = 'Invertir Barra de Navegación';
$string['invertdesc'] = 'Invierte el color del texto y del fondo de la barra de navegación en la parte superior de las páginas, entre negro y blanco.';

$string['blocksleft'] = 'Bloques solamente a la izquierda';
$string['blocksright'] = 'Bloques solamente a la izquierda';
$string['blocksleftandright'] = 'Bloqus a la izquierda y a la derecha';
$string['blocksconfig'] = 'Configuración de bloques';
$string['blocksconfigdesc'] = 'Elige tu preferencia para la configuración de bloques';

$string['maxwidth'] = 'Ancho máximo de la página';
$string['maxwidthdesc'] = 'Por favor establece un número razonable entre 850 y 1400 pixeles';

$string['fonticons'] = 'Usar fuente de íconos';
$string['fonticonsdesc'] = 'Activa la opción de usar la fuente de íconos Glyphicon.';

$string['transparency'] = 'Transparencia de conteido';
$string['transparencydesc'] = 'Si quieres que el fondo se muestre más, establece la transparencia del contenido de los Moodle content y de los bloques.';

$string['region-side-post'] = 'Derecha';
$string['region-side-pre'] = 'Izquierda';

$string['showoldmessages'] = 'Mostrar mensajes antiguos';
$string['showoldmessagesdesc'] = 'Mostrar mensajes antiguos en el menú de mensajes.';
$string['unreadnewnotification'] = 'Nueva notificación';

$string['visibleadminonly'] = 'Los boques colocados en el área de abajo sólo serán vistos por los administradores.';

$string['backtotop'] = 'Volver arriba';
$string['nextsection'] = 'Próxima Sección';
$string['previoussection'] = 'Sección Anterior';

$string['copyright'] = 'Copyright';
$string['copyrightdesc'] = 'El nombre de tu organización.';

/* General */
$string['geneicsettings'] = 'Configuración general';

$string['videowidth'] = 'Establecer el ancho máximo de los videos';
$string['videowidthdesc'] = 'Este tema determina el tamaño de los videos dinámicamente. Por defecto ocuparán el 100% del ancho. Puedes modificarlo aquí.<br>
<strong>Importante:</strong> Recuerda agregar el signo de porcentaje (%) o la cantidad de pixeles (px) después del número, o no funcionará';

$string['alwaysdisplay'] = 'Mostrar siempre';
$string['displaybeforelogin'] = 'Mostrar sólo antes de iniciar sesión';
$string['displayafterlogin'] = 'Mostrar sólo después de iniciar sesión';
$string['dontdisplay'] = 'No mostrar nunca';

/* User Menu */

$string['usermenusettings'] = 'Menú de usuario';
$string['usermenusettingssub'] = 'Opciones para usuarios que iniciaron sesión.';
$string['usermenusettingsdesc'] = 'Determina qué links mostrar en el menú de usuario, una vez iniciada la sesión.';

$string['enablemy'] = 'Mi Tablero';
$string['enablemydesc'] = 'Muestra un link a la página de Moodle del usuario.';

$string['enableprofile'] = 'Mi Perfil';
$string['enableprofiledesc'] = 'Muestra un link a la página de perfil.';

$string['enableeditprofile'] = 'Editar Perfil';
$string['enableeditprofiledesc'] = 'Muestra un link a la página de edición del perfil de usuario.';

$string['enablebadges'] = 'Medallas';
$string['enablebadgesdesc'] = 'Muestra un link a las medallas del usuario.';

$string['enablecalendar'] = 'Mi Calendario';
$string['enablecalendardesc'] = 'Muestra un link al calendario del usuario.';

$string['enableprivatefiles'] = 'Archivos privados';
$string['enableprivatefilesdesc'] = 'Muestra un link a los archivos privados del usaurio.';

$string['usermenulinks'] = 'Número de Links Personalizados';
$string['usermenulinksdesc'] = 'Determina cuántos links adicionales deseas agregar para los usuarios.<br>Deberás guardar la configuración para que aparezcan las opciones para configurar los nuevos links.';

$string['customlinkindicator'] = 'Número del link personalizado ';
$string['customlinkindicatordesc'] = 'Establece el número de este link personalizado.';

$string['customlinkicon'] = 'Ícono del link';
$string['customlinkicondesc'] = 'Nombre del ícono con el que deseas identificar el link.<br> La lista de opciones está <a href="http://fortawesome.github.io/Font-Awesome/icons/" target="_new">aquí</a>. Luego ingresa el nombre que se muestra luego de "fa-".';

$string['customlinkname'] = 'Nombre del link';
$string['customlinknamedesc'] = 'El nombre que se mostrará al usuario.';

$string['customlinkurl'] = 'URL de destino del link';
$string['customlinkurldesc'] = 'La URL absoluta o relativa de la página de destino del link.';


/* Colors and Logos */

$string['colorsettings'] = 'Logos & Colores';
$string['colorsettingssub'] = 'Cambiar el aspecto de la página.';
$string['colorsettingsdesc'] = 'Sube tus logos y cambia el tema con estas configuraciones.';

$string['logo'] = 'Logo';
$string['logodesc'] = 'Sube tu logo personalizado aquí si deseas agregarlo en el encabezado de la página.<br>
Como el espacio de la barra de navegación es limitado, el logo no debería tener más de 30 pixeles de altura.';

$string['headerbg'] = 'Fondo del encabezado';
$string['headerbgdesc'] = 'Si quieres reemplazar el fondo por defecto puedes subir una imagen aquí.<br>
El tamaño recomendado es 110 pixeles de alto por 1600 de ancho.<br>
<strong>Consejo útil</strong>: si la imagen usa transparencia el color del tema se mostrará por debajo.';

$string['bodybg'] = 'Imagen de fondo';
$string['bodybgdesc'] = 'Si deseas reemplazar el fondo por defecto, puedes subir uno personalizado aquí.<br>
<strong>Consejo útil</strong>: si la imagen usa transparencia el color del tema se mostrará por debajo.';

$choices = array();
$string['bodybgrepeat'] = 'Repetir el fondo (patrón)';
$string['bodybgfixed'] = 'Fondo completo, fijo, sin scroll';
$string['bodybgscroll'] = 'Fondo completo, scroll con el contenido de la página';

$string['bodybgconfig'] = 'Configurar el comportamiento del cuerpo principal';
$string['bodybgconfigdesc'] = 'Configura el comportamiento del fondo. Usa imágenes pequeñas para que funcionen como patrón e imágenes grandes para ocupar toda la página';

$string['bodycolor'] = 'Color de fondo';
$string['bodycolordesc'] = 'Si no subes ninguna imagen de fondo, Moodle mostrará este color de fondo.';

$string['themecolor'] = 'Color del tema';
$string['themecolordesc'] = 'Determina el color para resaltar en este tema. Este color ambién se utilizará para los links.';

$string['fontcolor'] = 'Color de tipografía';
$string['fontcolordesc'] = 'Determina el color de la fuente tipográfica principal para todo el sitio.';

$string['headingcolor'] = 'Colores del encabezado';
$string['headingcolordesc'] = 'Determina el color de la mayoría de los encabezados de las páginas de todo el sitio.';

/* Banners */

$string['togglebanner'] = 'Mostrar pase de diapositivas';
$string['togglebannerdesc'] = 'Determina si deseas ocultar o mostrar el pase de diapositivas.';
$string['enableslideshow'] = 'Activar pase de diapositivas';
$string['enableslideshowdesc'] = 'Usa esta opción para desactivar por completo el pase de diapositivas';

$string['bannersettings'] = 'Configuración del pase de diapositivas';
$string['bannersettingssub'] = 'Esta congiguración controla el pase de diapositivas que aparece en la página principal de Moodle.';
$string['bannersettingsdesc'] = 'Activa y determina la configuración para cada diapositiva aquí abajo.';


$string['bannerindicator'] = 'Diapositiva Nº {$a}';
$string['bannerindicatordesc'] = 'Configura esta diapositiva.';

$string['slidespeed'] = 'Duración de cada diapositiva';
$string['slidespeeddesc'] = 'Determina cuánto tiempo debe aparecer cada diapositiva en milisegundos.';


$string['slidenumber'] = 'Número de diapositivas ';
$string['slidenumberdesc'] = 'La cantidad de diapositivas no cambiará hasta que le guardes este formulario, luego de modificar este número.';

$string['enablebanner'] = 'Activar esta diapositiva';
$string['enablebannerdesc'] = '¿Deseas que aparezca esta diapositiva?';

$string['bannertitle'] = 'Título de la diapositiva';
$string['bannertitledesc'] = 'Dale un nombre a esta diapositiva.';

$string['bannertext'] = 'Texto de la diapositiva';
$string['bannertextdesc'] = 'Texto a mostrar en la diapositiva.';

$string['bannerlinktext'] = 'Nombre para la URL';
$string['bannerlinktextdesc'] = 'Texto del link a mostrar.';

$string['bannerlinkurl'] = 'Dirección URL';
$string['bannerlinkurldesc'] = 'El link al que debe dirigir la diapositiva al darle click.';

$string['bannerimage'] = 'Imagen de la diapositiva';
$string['bannerimagedesc'] = 'La imagen grande que va como fondo del texto del texto.';

$string['bannercolor'] = 'Color de la diapositiva';
$string['bannercolordesc'] = 'Si no deseas usar una imagen, en vez de eso puedes especificar un color de fondo';

/* Login Screen */
$string['loginsettings'] = 'Pantalla de inicio de sesión';
$string['loginsettingssub'] = 'Configuraciones de la pantalla de inicio de sesión';
$string['loginsettingsdesc'] = 'La versión presonalizada tiene un aspecto más limpio, además de la opción de un pase de diapositivas personalizables en el fondo.';

$string['enablecustomlogin'] = 'Usar pantalla de inicio de sesión personalizada';
$string['enablecustomlogindesc'] = 'Al activar esta opción se utilizará la versión personalizada de la pantalla de inicio de sesión, de lo contrario, se utilizará la pantalla de inicio de sesión por defecto de Moodle.<br>La versión personalizada permite subir imágenes de fondo.';

$string['loginbgnumber'] = 'Cantidad de imágenes de fondo';
$string['loginbgnumberdesc'] = '¿Cuántas imágenes de fondo necesitas que se pasen al cargar la página de inicio de sesión?';

$string['loginimage'] = 'Imagen de fondo Nº {$a}';
$string['loginimagedesc'] = 'El tamaño ideal para las imágenes de fondo de la pantalla de inicio de sesión es 1200x800 pixeles.';

/* Marketing Spots */
$string['marketingheading'] = 'Destacados de marketing';
$string['marketinginfodesc'] = 'Ingresa la configuración de los destacados marketing.';
$string['marketingheadingsub'] = 'Tres espacios en la página principal para agregar información y links.';
$string['marketingheight'] = 'Altura de las imágenes de marketing';
$string['marketingheightdesc'] = 'Si deseas mostrar imágenes en los recuadros de marketing, puedes especificar la altura aquí.';
$string['marketingdesc'] = 'Este tema puede mostrar destacados de marketgind debajo del pase de diapositivas. Esto permite identificar fácilmente información importante para los usarios asociándola con links directos.';

$string['togglemarketing'] = 'Mostrar destacados de marketing';
$string['togglemarketingdesc'] = 'Determina si deseas o no mostrar la sección de destacados de marketing en la página principal.';

$string['marketingtitleicon'] = 'Ícono del encabezado';
$string['marketingtitleicondesc'] = 'Nombre del ícono que deseas usar en el encabezado del área de destacados de marketing. La lista de íconos está <a href="http://fortawesome.github.io/Font-Awesome/icons/" target="_new">aquí</a>.  Basta con que ingreses el texto que aparece al después de "fa-".';

$string['marketingspots'] = 'Destacados de marketing';

$string['marketingheading'] = 'Destacado Nº {$a}';
$string['marketingheadingdesc'] = '';

$string['marketingurl'] = 'URL del destacado';
$string['marketingurldesc'] = 'Link a una URL externa';


$string['marketingtitle'] = 'Título';
$string['marketingtitledesc'] = 'Título a mostrar en el destacado de marketing.';
$string['marketingicon'] = 'Ícono';
$string['marketingicondesc'] = 'Nombre del ícono que deseas utilizar. La lista de íconos está <a href="http://fortawesome.github.io/Font-Awesome/icons/" target="_new">aquí</a>.  Basta con que ingreses el texto que aparece al después de "fa-".';
$string['marketingimage'] = 'Imagen';
$string['marketingimagedesc'] = 'Tienes la opción de mostrar una imagen encima del texto de este destacado de marketing.';
$string['marketingcontent'] = 'Contenido';
$string['marketingcontentdesc'] = 'Texto a mostra en el destacado de marketing. Prferentemente ingresa un texto breve.';
$string['marketingbuttontext'] = 'Texto del botón';
$string['marketingbuttontextdesc'] = 'Este texto es el que se mostrará en el botón del destacado de marketing.';
$string['marketingbuttonurl'] = 'URL';
$string['marketingbuttonurldesc'] = 'URL a la que debe apuntar el botón.';

$string['marketingspotsinrow'] = 'Cantidad de destacados de marketing por renglón';
$string['marketingspotsinrowdesc'] = 'Selecciona el número de destacados de marketing que deseas en un renglón utilizando pantalla completa. Considera que este número será dividido por dos en los dipositivos de pantallas pequeñas';
$string['marketingspotsnr'] = 'Cantidad de destacados de marketing';
$string['marketingspotsnrdesc'] = 'Determina el número de destacados de marketing a mostrar';

/* Quick Links */
$string['quicklinksheading'] = 'Links rápidos';
$string['quicklinksheadingdesc'] = 'Ingresa la configuración de los links rápidos de la página principal de Moodle.';
$string['quicklinksheadingsub'] = 'Espacios en la página principal para agregar información y links destacados.';
$string['quicklinksdesc'] = 'Este tema permite activar "Links rápidos". Con esta opción podrás agregar links a cualquier URL.';

$string['togglequicklinks'] = 'Mostrar Links rápidos';
$string['togglequicklinksdesc'] = 'Determina si quieres mostrar u ocultar el área de links rápidos.';

$string['quicklinksicon'] = 'Ícono del encabezado';
$string['quicklinksicondesc'] = 'Nombre del ícono que deseas usar en el encabezado del área de links rápidos. La lista de íconos está <a href="http://fortawesome.github.io/Font-Awesome/icons/" target="_new">aquí</a>.  Basta con que ingreses el texto que aparece al después de "fa-".';

$string['quicklinks'] = 'Link rápido Nº {$a}';

$string['quicklinksnumber'] = 'Cantidad de Links';
$string['quicklinksnumberdesc'] = 'Cuántos links deseas mostrar en la página principal.';

$string['quicklinkstitle'] = 'Encabezado del área';
$string['quicklinkstitledesc'] = 'Nombre para el área de links rápidos.';

$string['quicklinkicon'] = 'Ícono';
$string['quicklinkicondesc'] = 'Nombre del ícono que deseas utilizar. La lista de opciones está <a href="http://fortawesome.github.io/Font-Awesome/icons/" target="_new">aquí</a>.  Basta con que ingreses el texto que aparece al después de "fa-".';
$string['quicklinkiconcolor'] = 'Color del link rápido';
$string['quicklinkiconcolordesc'] = 'Color de fondo debajo del ícono del link.';
$string['quicklinkbuttontext'] = 'Texto del link';
$string['quicklinkbuttontextdesc'] = 'Este texto aparecerá en el botón.';
$string['quicklinkbuttoncolor'] = 'Color del botón';
$string['quicklinkbuttoncolordesc'] = 'Color del botón del link rápido';
$string['quicklinkbuttonurl'] = 'URL';
$string['quicklinkbuttonurldesc'] = 'Link de la página a la que debe apuntar el botón.';


/* Social Networks */
$string['socialheading'] = 'Configuración de Redes Sociales';
$string['socialheadingsub'] = 'Conecta con tus usuarios en las redes sociales.';
$string['socialdesc'] = 'Ingresa links directos a las principales redes en las que promueves tu marca. Estos aparecerán al pié de todas las páginas.';
$string['socialnetworks'] = 'Redes Sociales';

$string['facebook'] = 'URL de Facebook';
$string['facebookdesc'] = 'Ingresa la URL de tu página de Facebook. (Ej.: http://www.facebook.com/pukunui)';

$string['twitter'] = 'URL de Twitter';
$string['twitterdesc'] = 'Ingresa la URL de tu línea de tiempo de Twitter. (Ej.: http://www.twitter.com/pukunui)';

$string['googleplus'] = 'URL de Google+';
$string['googleplusdesc'] = 'Ingresa la URL de tu perfil de Google+. (Ej.: https://google.com/+Pukunui/)';

$string['linkedin'] = 'URL de LinkedIn';
$string['linkedindesc'] = 'Ingresa la URL de tu perfil de empresa en LinkedIn. (Ej.: http://www.linkedin.com/company/pukunui-technology)';

$string['youtube'] = 'URL de YouTube';
$string['youtubedesc'] = 'Ingresa la URL de tu canal de YouTube. (Ej.: http://www.youtube.com/moodleman)';

$string['tumblr'] = 'URL de Tumblr';
$string['tumblrdesc'] = 'Ingresa la URL de tu Tumblr. (Ej.: http://moodleman.tumblr.com)';

$string['vimeo'] = 'URL de Vimeo';
$string['vimeodesc'] = 'Ingresa la URL de tu canal de Vimeo. (Ej.: http://vimeo.com/moodleman)';

$string['flickr'] = 'URL de Flickr';
$string['flickrdesc'] = 'Ingresa la URL de tu página de Flickr. (Ej.: http://www.flickr.com/mycollege)';

$string['vk'] = 'URL de VKontakte';
$string['vkdesc'] = 'Ingresa la URL de tu página de Vkontakte. (Ej.: http://www.vk.com/mycollege)';

$string['skype'] = 'Cuenta Skype';
$string['skypedesc'] = 'Ingresa el nombre de usuario de Skype de tu organización.';

$string['pinterest'] = 'URL de Pinterest';
$string['pinterestdesc'] = 'Ingresa la URL de tu página de Pinterest. (Ej.: http://pinterest.com/mycollege)';

$string['instagram'] = 'URL de Instagram';
$string['instagramdesc'] = 'Ingresa la URL de tu página de Instagram. (Ej.: http://instagram.com/mycollege)';

$string['website'] = 'URL de tu Sitio Web';
$string['websitedesc'] = 'Ingresa la URL del Sitio Web de tu organización. (Ej.: http://www.pukunui.com)';

$string['blog'] = 'URL de tu Blog';
$string['blogdesc'] = 'Ingresa la URL del blog de tu organización. (Ej.: http://www.moodleman.net)';


/* Category Icons */
$string['categoryiconheading'] = 'Íconos de categorías';
$string['categoryiconheadingsub'] = 'Usa íconos para representar tus categorías.';
$string['categoryiconheadingdesc'] = 'Si esta opción está activada te permitirá elegir un ícono para cada categoría.';

$string['defaultcategoryicon'] = 'Íconos de categoría por defecto';
$string['defaultcategoryicondesc'] = 'Si no ingresas ningún valor en tus categorías (aquí abajo) se utilizará este valor por defecto. Este es un modo fácil de cambiar varios íconos de categorías rápidamente.';

$string['categoryiconinfo'] = 'Íconos de categorías personalizados';
$string['categoryiconinfodesc'] = 'Cada ícono se establece en base al "ID" de la categoría. Puedes encontrar los ID en la URL de cada categoría. La lista está <a href="http://fortawesome.github.io/Font-Awesome/icons/">aquí</a>. Basta con que ingreses el texto que aparece al después de "fa-".';

$string['enablecategoryicon'] = 'Activar los íconos para las categoríasz';
$string['enablecategoryicondesc'] = 'Si activas esta opción podrás seleccionar íconos para las categorías, luego de guardar este formulario.';

$string['categoryicondesc'] = 'Selecciona el ícono a utilizar para la categoría ';

/* Social Networks Icon Descriptions */
$string['socioblog'] = 'Lee nuestro Blog';
$string['sociowebsite'] = 'Visita nuestro Sitio Web';
$string['sociogoogleplus'] = 'Síguenos en Google Plus';
$string['sociotwitter'] = 'Síguenos en Twitter';
$string['sociofacebook'] = 'Me gusta en Facebook';
$string['sociolinkedin'] = 'Connectar con nosotros en LinkedIn';
$string['socioyoutube'] = 'Síguenos en Youtube';
$string['sociovimeo'] = 'Síguenos en Vimeo';
$string['socioflickr'] = 'Síguenos en Flickr';
$string['sociopinterest'] = 'Síguenos en Pinterest';
$string['sociotumblr'] = 'Síguenos en Tumblr';
$string['socioinstagram'] = 'Síguenos en Instagram';
$string['sociovk'] = 'Me gusta en VK';
$string['socioskype'] = 'Llámanos por Skype';

/* Moodle Mobile Application links */
$string['mobileappsheading'] = 'Applicación Móvil';
$string['mobileappsheadingsub'] = 'Link a la App, para que los alumnos la utilicen';
$string['mobileappsdesc'] = '¿Tienes una web app en el App Store o en Google Play Store? Ingresa un link aquí para que los usuarios puedan encontrarla online.';
$string['android'] = 'Descargar la App para Android de Google Play';
$string['androiddesc'] = 'Ingresa la URL to your mobile App on the Google Play Store. Si no tienes una App propia, considera agregar el link a la App oficial de Moodle (https://play.google.com/store/apps/details?id=com.moodle.moodlemobile)';
$string['androidurl'] = 'Android (Google Play)';
$string['windows'] = 'Descargar la aplicación de escritorio de Windows store';
$string['windowsdesc'] = 'Ingresa la URL tu App en Windows Store. Si no tienes una App propia, considera agregar el link a la App oficial de Moodle (http://apps.microsoft.com/windows/en-us/app/9df51338-015c-41b7-8a85-db2fdfb870bc)';
$string['windowsurl'] = 'Windows Desktop';
$string['winphone'] = 'Descargar la aplicación móvil de Windows Phone Store';
$string['winphonedesc'] = 'Ingresa la URL tu App para móvil en Windows Phone Store. Si no tienes una App propia, considera agregar el link a la App oficial de Moodle. (http://www.windowsphone.com/en-us/store/app/moodlemobile/d0732b88-3c6d-4127-8f24-3fca2452a4dc)';
$string['winphoneurl'] = 'Windows Mobile';
$string['ios'] = 'Descarga la app para iPhone/iPad del App store';
$string['iosdesc'] = 'Ingresa la URL de tu App en el App Store. Si no tienes una App propia, considera agregar el link a la App oficial de Moodle. (https://itunes.apple.com/en/app/moodle-mobile/id633359593).';
$string['iosurl'] = 'iPhone/iPad (App Store)';
