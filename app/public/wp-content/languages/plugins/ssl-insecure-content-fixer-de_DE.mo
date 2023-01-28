��    L      |  e   �      p  1   q     �  }   �  �   6  i   �  g   9  j   �  #   	     0	     A	  5   \	  �   �	  �   (
  #   �
      �
  l   �
     a  T   r  ;   �       Y     S   f  #   �     �     �       I   3  6   }  5   �  4   �          6  Q   P  R   �     �  [     a   l  ^   �  �   -  ;   �  ^   �  .   ]  +   �  0   �  q   �  s   [     �     �  .   
  I   9  d   �     �               7  !   U     w     �     �  9   �  =   
  ^   H  0   �     �  w   �  W   o  1   �  P   �  4   J  8     Q   �  *   
  %   5  #   [  1     3  �  :   �        �   >  �   �  {   �  }     �   �  2        ?     [  :   v  �   �  �   Q  (   �         �   A     �  z   �  :   e      �   c   �   b   !  &   p!  	   �!     �!     �!  +   �!  $   �!  %   "  +   ."     Z"     ^"  A   f"  W   �"      #  T   #  ^   ]#  f   �#  �   #$  ?   �$  f   �$     b%     }%     �%  l   �%  n   !&     �&     �&     �&  @   �&  o   ('     �'  	   �'     �'     �'  	   �'  	   �'     �'     �'  -   �'  <   +(  O   h(  $   �(     �(  g   �(  Z   U)  "   �)  G   �)  ,   *  /   H*  R   x*     �*  !   �*  "   	+  2   ,+                 7      5   =       *   6                        8   1       H      2   %   @   B       I   .          ?   4   G       >                ,           ;      9   !          F       -      J          '   #   +      A   "          )      	   (      <       K      L      :      &          E   /       
                    0          D          C          3      $    Clean up WordPress website HTTPS insecure content Fix insecure content If you know of a way to detect HTTPS on your server, please <a href="%s" target="_blank" rel="noopener">tell me about it</a>. It looks like your server is behind Amazon CloudFront, not configured to send HTTP_X_FORWARDED_PROTO. The recommended setting for HTTPS detection is %s. It looks like your server is behind Windows Azure ARR. The recommended setting for HTTPS detection is %s. It looks like your server is behind a reverse proxy. The recommended setting for HTTPS detection is %s. It looks like your server uses Cloudflare Flexible SSL. The recommended setting for HTTPS detection is %s. Multisite network settings updated. Running tests... SSL Insecure Content Fixer SSL Insecure Content Fixer multisite network settings SSL Insecure Content Fixer requires <a target="_blank" rel="noopener" href="%1$s">PCRE</a> version %2$s or higher; your website has PCRE version %3$s SSL Insecure Content Fixer requires these missing PHP extensions. Please contact your website host to have these extensions installed. SSL Insecure Content Fixer settings SSL Insecure Content Fixer tests Select the level of fixing. Try the Simple level first, it has the least impact on your website performance. Tests completed. These settings affect all sites on this network that have not been set individually. This page checks to see whether WordPress can detect HTTPS. WebAware Your server can detect HTTPS normally. The recommended setting for HTTPS detection is %s. Your server cannot detect HTTPS. The recommended setting for HTTPS detection is %s. Your server environment shows this: fix level settingsCapture fix level settingsCapture All fix level settingsContent fix level settingsEverything on the page, from the header to the footer: fix level settingsEverything that Content does, plus: fix level settingsEverything that Simple does, plus: fix level settingsNo insecure content will be fixed fix level settingsOff fix level settingsSimple fix level settingsThe biggest potential to break things, but sometimes necessary fix level settingsThe fastest method with the least impact on website performance fix level settingsWidgets fix level settingscapture the whole page and fix scripts, stylesheets, and other resources fix level settingsdata returned from <code>wp_upload_dir()</code> (e.g. for some CAPTCHA images) fix level settingsexcludes AJAX calls, to prevent some compatibility and performance problems fix level settingsimages and other media loaded by calling <code>wp_get_attachment_image()</code>, <code>wp_get_attachment_image_src()</code>, etc. fix level settingsimages loaded by the plugin Image Widget fix level settingsincludes AJAX calls, which can cause compatibility and performance problems fix level settingsresources in "Text" widgets fix level settingsresources in any widgets fix level settingsresources in the page content fix level settingsscripts registered using <code>wp_register_script()</code> or <code>wp_enqueue_script()</code> fix level settingsstylesheets registered using <code>wp_register_style()</code> or <code>wp_enqueue_style()</code> https://shop.webaware.com.au/ https://ssl.webaware.net.au/ ignore external settingsIgnore external sites ignore external settingsOnly fix content pointing to this WordPress site ignore external settingsSelect only if you wish to leave content pointing to external sites as http menu linkSSL Insecure Content menu linkSSL Tests plugin details linksDonate plugin details linksGet help plugin details linksInstructions plugin details linksRating plugin details linksSettings plugin details linksTranslate plugin fix settingsFixes for specific plugins and themes plugin fix settingsSelect only the fixes your website needs. plugin fix settingsWooCommerce  + Google Chrome HTTP_HTTPS bug (fixed in WooCommerce v2.3.13) proxy settings* detected as recommended setting proxy settingsHTTPS detection proxy settingsHTTP_CF_VISITOR (Cloudflare Flexible SSL); deprecated, since Cloudflare sends HTTP_X_FORWARDED_PROTO now proxy settingsHTTP_CLOUDFRONT_FORWARDED_PROTO (Amazon CloudFront HTTPS cached content) proxy settingsHTTP_X_ARR_SSL (Windows Azure ARR) proxy settingsHTTP_X_FORWARDED_PROTO (e.g. load balancer, reverse proxy, NginX) proxy settingsHTTP_X_FORWARDED_SCHEME (e.g. KeyCDN) proxy settingsHTTP_X_FORWARDED_SSL (e.g. reverse proxy) proxy settingsSelect how WordPress should detect that a page is loaded via HTTPS proxy settingsstandard WordPress function proxy settingsunable to detect HTTPS settings errorFix level is invalid settings errorHTTPS detection setting is invalid PO-Revision-Date: 2021-05-18 20:32:40+0000
MIME-Version: 1.0
Content-Type: text/plain; charset=UTF-8
Content-Transfer-Encoding: 8bit
Plural-Forms: nplurals=2; plural=n != 1;
X-Generator: GlotPress/3.0.0-alpha.2
Language: de
Project-Id-Version: Plugins - SSL Insecure Content Fixer - Stable (latest release)
 Unsichere Inhalte einer HTTPS-WordPress-Website aufräumen Unsichere Inhalte korrigieren Wenn du eine Möglichkeit kennst, HTTPS auf deinem Server zu erkennen, teile sie mir <a href="%s" target="_blank" rel="noopener">bitte mit</a>. Es sieht so aus, als wäre der Server hinter Amazon CloudFront und nicht für das Senden von HTTP_X_FORWARDED_PROTO konfiguriert ist. Die empfohlene Einstellung für die HTTPS-Erkennung ist %s. Es sieht so aus, als wäre der Server hinter Windows Azure ARR. Die empfohlene Einstellung für die HTTPS-Erkennung ist %s. Es sieht so aus, als wäre der Server hinter einem Reverse Proxy. Die empfohlene Einstellung für die HTTPS-Erkennung ist %s. Es sieht so aus, als ob der Server CloudFlare Flexible SSL verwendet. Die empfohlene Einstellung für die HTTPS-Erkennung ist %s. Multisite-Netzwerk-Einstellungen wurden geändert. Tests werden ausgeführt... SSL Insecure Content Fixer SSL Insecure Content Fixer Multisite Netzwerkeinstellungen SSL Insecure Content Fixer erfordert <a target="_blank" rel="noopener" href="%1$s">PCRE</a>-Version %2$s oder höher; deine Website verwendet PCRE-Version %3$s SSL Insecure Content Fixer benötigt die folgenden fehlenden PHP-Erweiterungen. Bitte kontaktiere deinen Website-Host, um diese Erweiterungen installieren zu lassen. SSL Insecure Content Fixer Einstellungen SSL Insecure Content Fixer Tests Wähle die Korrekturstufe aus. Probiere zunächst die Stufe „Einfach“ aus, sie hat die geringsten Auswirkungen auf die Leistung deiner Website. Tests abgeschlossen. Diese Einstellungen betreffen alle Websites in diesem Netzwerk, für die keine individuellen Einstellungen gesetzt wurden. Diese Seite überprüft, ob WordPress HTTPS erkennen kann. WebAware Dein Server kann HTTPS normal erkennen. Die empfohlene Einstellung für die HTTPS-Erkennung ist %s. Dein Server kann HTTPS nicht erkennen. Die empfohlene Einstellung für die HTTPS-Erkennung ist %s. Deine Server-Umgebung zeigt folgendes: Erfassung Alles erfassen Inhalt Alles auf der Seite, von Header bis Footer: Alles, was „Inhalt“ macht, plus: Alles, was „Einfach“ macht, plus: Es werden keine unsicheren Inhalte behoben. Aus Einfach Das größte Potential, etwas zu zerstören, aber manchmal nötig Die schnellste Methode mit den geringsten Auswirkungen auf die Performance der Website. Widgets Erfasst die gesamte Seite und korrigiert Skripte, Stylesheets und andere Ressourcen. Von <code>wp_upload_dir()</code> zurückgegebene Daten (z.&nbsp;B. für manche CAPTCHA-Bilder) Schließt AJAX-Aufrufe aus, welche Kompatibilitäts- und Geschwindigkeitsprobleme verursachen können. Bilder und andere Medien, die durch Aufrufe von <code>wp_get_attachment_image()</code>, <code>wp_get_attachment_image_src()</code> etc. geladen wurden. Bilder, die durch das Plugin „Image Widget“ geladen werden. Schließt AJAX-Aufrufe ein, welche Kompatibilitäts- und Geschwindigkeitsprobleme verursachen können. Ressourcen in Text-Widgets Ressourcen in allen Widgets Ressourcen im Seiteninhalt Skripte, die mit <code>wp_register_script()</code> oder <code>wp_enqueue_script()</code> registriert wurden. Stylesheets, die mit <code>wp_register_style()</code> oder <code>wp_enqueue_style()</code> registriert wurden. https://shop.webaware.com.au/ https://ssl.webaware.net.au/ Externe Websites ignorieren Nur Inhalte korrigieren, die auf diese WordPress-Website zeigen. Nur auswählen, falls du möchtest, dass Inhalte, die auf externe Websites verweisen, weiterhin http verwenden. Unsicherer SSL-Inhalt SSL-Tests Spenden Hilfe erhalten Anleitung Bewertung Einstellungen Übersetzen Korrekturen für bestimmte Plugins und Themes Wähle nur die Korrekturen aus, die deine Website benötigt. WooCommerce  + Google Chrome HTTP_HTTPS Fehler (behoben in WooCommerce v2.3.13) * als empfohlene Einstellung erkannt HTTPS-Erkennung HTTP_CF_VISITOR (Cloudflare Flexibles SSL); veraltet, da Cloudflare jetzt HTTP_X_FORWARDED_PROTO sendet HTTP_CLOUDFRONT_FORWARDED_PROTO (Von Amazon CloudFront HTTPS zwischengespeicherter Inhalt) HTTP_X_ARR_SSL (Windows Azure ARR) HTTP_X_FORWARDED_PROTO (z.&nbsp;B. Load Balancer, Reverse Proxy, NginX) HTTP_X_FORWARDED_SCHEME (z.&nbsp;B. KeyCDN)  HTTP_X_FORWARDED_SSL (z.&nbsp;B. Reverse Proxy) Wähle aus, wie WordPress erkennen soll, dass eine Seite über HTTPS geladen wird. Standard-WordPress-Funktion HTTPS konnte nicht erkannt werden Das Korrektur-Level ist ungültig. Die Einstellung zur HTTPS-Erkennung ist ungültig. 