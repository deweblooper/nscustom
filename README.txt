=== NS Custom Theme ===
Contributors: the WordPress team
Requires at least: WordPress 4.4
Tested up to: WordPress 4.5
Version: 1.3
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html
Tags: one-column, two-columns, right-sidebar, accessibility-ready, custom-background, custom-colors, custom-header, custom-menu, editor-style, featured-images, flexible-header, microformats, post-formats, rtl-language-support, sticky-post, threaded-comments, translation-ready, blog

== Description ==
NS Custom Theme is a modernized take on an ever-popular WordPress layout — the horizontal masthead with an optional right sidebar that works perfectly for blogs and websites. It has custom color options with beautiful default color schemes, a harmonious fluid grid using a mobile-first approach, and impeccable polish in every detail. NS Custom Theme will make your WordPress look beautiful everywhere.

* Mobile-first, Responsive Layout
* Custom Colors
* Custom Header
* Social Links
* Post Formats
* The GPL v2.0 or later license. :) Use it to make something cool.



- stabilizovaná z TwentySixteen
- odstránené externé linky na google fonts a pod.
- doplnené default fonty
- doplnené o custom šablónu pre page, post+portfolio (dá sa aj osobitne ak sa definuje v single-landing.php)
- preddefinované portfolio aj jeho funkciami (okrem permalinks slug, ten sa zatiaľ nedá v Options, len ručne.) V child sa dá override
- pridaná jquery BlueImp Gallery pre post format gallery
- zamenený pôvodný shortcode gallery, upravený o kód pre BlueImp, ale vyzerá rovnako: napr. [gallery columns="4" ids="32,31"]
- shortcode pre BlueImp, pridaný aj do RTEditora s vlastnou ikonkou vo vizuálnom editore [carousel link="file" ids="32,31"] ale pre získanie ID obrázkov musí byť najprv spravená [gallery columns="4" ids="32,31"] cez "Pridať súbor" a znej vytiahnuť (alebo len prepísať gallery na carousel)
- doplnené o child template so screenshotom
- template: vyčistenie css fontov
- template: breadcrumb, aj pre portfolio + možnosť pridať nadradený link pre portfolio ktoré je bez kategórií (ASAP› ?? ›Channel Islands)
- child template: pridanie do child/style.css všetky definície font-family
- child template: deaktivovanie naťahovania default fontov css a genericons css do html
- vlastný screenshot
- footer credits default override s 'ns_custom_credits' z child (treba aktivovať a vyplniť premenné podľa potreby)
- blueimp js fix: odobratie zbytočného .map z \lib\blueimp\js\jquery.blueimp-gallery.min.js
- pridané footer widget hooky (5)
- upravený genericons.css aby nespomaľoval
- widget: Widget Custom post type menu
- admin RTE editor zmena fontu z Merriweather na Georgia kvôli prehľadnosti




For more information about NS Custom Theme please go to https://codex.wordpress.org/NS_Custom_Theme.

== Installation ==

1. In your admin panel, go to Appearance -> Themes and click the 'Add New' button.
2. Type in NS Custom Theme in the search form and press the 'Enter' key on your keyboard.
3. Click on the 'Activate' button to use your new theme right away.
4. Go to https://codex.wordpress.org/NS_Custom_Theme for a guide on how to customize this theme.
5. Navigate to Appearance > Customize in your admin panel and customize to taste.

== Copyright ==

NS Custom Theme WordPress Theme, Copyright 2014-2015 WordPress.org
NS Custom Theme is distributed under the terms of the GNU GPL

This program is free software: you can redistribute it and/or modify
it under the terms of the GNU General Public License as published by
the Free Software Foundation, either version 2 of the License, or
(at your option) any later version.

This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
GNU General Public License for more details.

NS Custom Theme Theme bundles the following third-party resources:

HTML5 Shiv v3.7.0, Copyright 2014 Alexander Farkas
Licenses: MIT/GPL2
Source: https://github.com/aFarkas/html5shiv

Genericons icon font, Copyright 2013-2015 Automattic.com
License: GNU GPL, Version 2 (or later)
Source: http://www.genericons.com

Image used in screenshot.png: A photo by Austin Schmid (https://unsplash.com/schmidy/), licensed under Creative Commons Zero(http://creativecommons.org/publicdomain/zero/1.0/)

== Changelog ==

= 1.3 =
* Released: August 16, 2016

https://codex.wordpress.org/NS_Custom_Theme_Theme_Changelog#Version_1.3

= 1.2 =
* Released: April 12, 2016

https://codex.wordpress.org/NS_Custom_Theme_Theme_Changelog#Version_1.2

= 1.1 =
* Released: January 6, 2016

https://codex.wordpress.org/NS_Custom_Theme_Theme_Changelog#Version_1.1

= 1.0 =
* Released: December 8, 2015

Initial release

== Notes ==

Only the default and dark color schemes are accessibility ready.
