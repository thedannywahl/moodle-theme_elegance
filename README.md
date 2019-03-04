# Elegance

## A Boost child theme

### Features

[Elegance](https://moodle.org/plugins/view.php?plugin=theme_elegance) is a beautiful Free Moodle theme with robust functionality and lots of custom settings. This theme is a full rewrite of the Moodle 2.8 theme elegance version.

Custom Settings
* Custom "Quick Links".
* "Marketing" spots.
* Custom Footer.
* A frontpage Slide Show.
* Customizable colours.
* Login Page backgroud images.

### Contributors version 2.9

*   [Emma Richardson](https://www.linkedin.com/in/edconsulting)
*   [Mary Evans](https://moodle.org/user/profile.php?id=713800)
*   [Usman Asar](https://moodle.org/user/profile.php?id=1183102)

### Contributors version 2.8

*   [Danny Wahl](http://www.iyware.com)
*   [Aaron Marr](https://github.com/aaronmarruk)
*   [Julian Ridden](http://moodleman.net/)
*   [Gareth J. Barnard](http://about.me/gjbarnard)
*   [mpuusaar](https://github.com/mpuusaar)
*   [David Bezemer](http://www.davidbezemer.nl)

### Notes
*
* Please do not use the github version of this theme in a production environment.  The current plugin repository version will always be the most stable.

### Changelog

### Version 3.0 Beta

Moved to theme Boost as a parent theme_elegance.
Removed options:

* blocks configuration, the theme only has the right blocks column
* videowidth
* mobilecss
* transparency

Added features.

* Show available courses on front page in a card layout
* Use the Boost navdrawer
* New Caroussel
* New style marketing spot

[v2.9](https://github.com/bmbrands/moodle-theme_elegance)

### New Features:

* Mustache templates for widgets
* Support for columns left and right (configurable)
* rewrote most renderers to use mustache templates
* Migrate from css to less
* Using one layout file only
* Switch to Bootstrap Caroussel
* Rewrote all JS
* Rewrote all setting options
* New Favicon
* Flexbox for marketing spots
* Option to have fixed navbar

### Removed:

* Single section course navigation
* Replace Moodle icons with Glyphicons
* Category icon logic
* Custom login page
* Obsolete CSS
* Most renderers


[v2.7.1](https://github.com/thedannywahl/moodle-theme_elegance/issues?q=milestone%3Av2.7.1+is%3Aclosed)
fixed: show/hide resources broken
fixed: long category names look strange in icon view
fixed: login page footer layout
fixed: front page course image mobile layout
fixed: remember username checkbox broken
fixed: popups don’t use full window
fixed: some fonts look bad in some browsers
fixed: paragraphs aren’t all the same size
fixed: “logged in” user block can’t be moved or edited
fixed: “Log in” block has inconsistent fonts
fixed: H1-H6 sizes not sequential
fixed: default category icons don’t show up
enhanced: all default images are public domain from [unsplash](http://unsplash.com)
enhanced: fontawesome updated to latest version
added: new custom css field for Moodle Mobile app
