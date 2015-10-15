# Elegance

## A Bootstrap 3 Moodle Theme

### Features

[Elegance](https://moodle.org/plugins/view.php?plugin=theme_elegance) is a beautiful three column Moodle theme with robust functionality and lots of custom settings.

* [Font Awesome](http://fortawesome.github.io/Font-Awesome/) icons
* [Google Web Fonts](http://www.google.com/fonts/)
* Custom "Quick Links" and "Marketing" spots
* Custom "Front Page Content" and "Footer" content
* Custom colors
* Custom "User Menu"
* Custom log in screen

### Demo

A video showing many of the core features is available for viewing at [Vimeo](https://vimeo.com/channels/moodleman/87749717).

If you would like to see it in action, head to the [2014 iMoot](http://2014.imoot.org) site.

### Contributors

*   [Aaron Marr](https://github.com/aaronmarruk)
*   [Julian Ridden](http://moodleman.net/)
*   [Gareth J. Barnard](http://about.me/gjbarnard)
*   [mpuusaar](https://github.com/mpuusaar)
*   [Danny Wahl](http://www.iyware.com)
*   [David Bezemer](http://www.davidbezemer.nl)

### Notes
* This theme requires the theme "[Bootstrap](https://moodle.org/plugins/view.php?plugin=theme_bootstrap)".  If you're using Moodle auto-updater it will automatically install it too.
* Please do not use the github version of this theme in a production environment.  The current plugin repository version will always be the most stable.

### Changelog

[v2.9]
rewrote most renderers to use mustache templates
Migrate from css to less
Using one layout file only
Removed category icon logic
Removed custom login page
Rewrote all settings options
Using upstream bootstrap course renderer
Cleanup navbar
Using upstream user dropdown
Using flexbox for marketing spots
Removed most border-radius css
Changed block headings
Reset all font sizes / weight
Many CSS cleanups

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