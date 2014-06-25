<?php
            // This file is part of Moodle - http://moodle.org/
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
             * The Elegance theme is built upon  Bootstrapbase 3 (non-core).
             *
             * @package    theme
             * @subpackage theme_elegance
             * @author     Julian (@moodleman) Ridden
             * @author     Based on code originally written by G J Bernard, Mary Evans, Bas Brands, Stuart Lamour and David Scotson.
             * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
             */

            $hassidepost = $PAGE->blocks->region_has_content('side-post', $OUTPUT);
            $hascopyright = (empty($PAGE->theme->settings->copyright)) ? false : $PAGE->theme->settings->copyright;
            $hasfootnote = (empty($PAGE->theme->settings->footnote)) ? false : $PAGE->theme->settings->footnote;
            $hastiles = (!empty($PAGE->theme->settings->tiles));
            $haslogo = (empty($PAGE->theme->settings->logo)) ? false : $PAGE->theme->settings->logo;
            $invert = (!empty($PAGE->theme->settings->invert)) ? true : $PAGE->theme->settings->invert;
            $fluid = (!empty($PAGE->layout_options['fluid']));
            $sidebar = "RIGHT";

            if ($haslogo) {
                $logo = '<div id="logo"></div>';
            } else {
                $logo = $SITE->shortname;
            }

            if ($invert) {
              $navbartype = 'navbar-inverse';
            } else {
              $navbartype = 'navbar-default';
            }

            $container = 'container';
            if (isset($PAGE->theme->settings->fluidwidth) && ($PAGE->theme->settings->fluidwidth == true)) {
                $container = 'container-fluid';
            }
            if ($fluid) {
                $container = 'container-fluid';
            }


            $knownregionpost = $PAGE->blocks->is_known_region('side-post');

            $regions = theme_elegance_bootstrap3_grid($hassidepost);
            $PAGE->set_popup_notification_allowed(false);
            $PAGE->requires->jquery();

            echo $OUTPUT->doctype() ?>
            <html <?php echo $OUTPUT->htmlattributes(); ?>>
            <head>
                <title><?php echo $OUTPUT->page_title(); ?></title>
                <link rel="shortcut icon" href="<?php echo $OUTPUT->favicon(); ?>" />
                <?php echo $OUTPUT->standard_head_html() ?>
                <meta name="viewport" content="width=device-width, initial-scale=1.0">
            </head>

            <body <?php echo $OUTPUT->body_attributes(); ?>>

            <?php echo $OUTPUT->standard_top_of_body_html() ?>

            <nav role="navigation" class="navbar <?php echo $navbartype; ?>">
                <div class="<?php echo $container; ?>">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#moodle-navbar">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand" href="<?php echo $CFG->wwwroot;?>"><?php echo $logo; ?></a>
                </div>

                <div id="moodle-navbar" class="navbar-collapse collapse">
                    <?php echo $OUTPUT->custom_menu(); ?>
                    <?php echo $OUTPUT->user_menu(); ?>
                    <ul class="nav pull-right">
                        <li><?php echo $OUTPUT->page_heading_menu(); ?></li>
                    </ul>
                </div>
                </div>
            </nav>

            <header id="moodleheader" class="clearfix">
                <div id="page-navbar" class="container">
                    <nav class="breadcrumb-nav" role="navigation" aria-label="breadcrumb"><?php echo $OUTPUT->navbar(); ?></nav>
                    <div class="breadcrumb-button"><?php echo $OUTPUT->page_heading_button(); ?></div>
                </div>

                <div id="course-header">
                    <?php echo $OUTPUT->course_header(); ?>
                </div>
            </header>


            <div id="page" class="<?php echo $container; ?>">
                <header id="page-header" class="clearfix">
                    <div id="course-header">
                        <?php echo $OUTPUT->course_header(); ?>
                    </div>
                </header>

                <div id="page-content" class="row">
                    <div id="region-main" class="<?php echo $regions['content']; ?>">

			<div id="heading"><?php echo $OUTPUT->page_heading(); ?></div>
            <?php
            echo $OUTPUT->course_content_header();
			echo $OUTPUT->main_content();
			echo $OUTPUT->course_content_footer();
			?>
        </div>

        <?php
        if ($knownregionpost) {
            echo $OUTPUT->blocks('side-post', $regions['post']);
        }?>
    </div>

</div>

<footer id="page-footer">
  <?php require_once(dirname(__FILE__).'/includes/footer.php'); ?>
</footer>

<?php echo $OUTPUT->standard_end_of_body_html() ?>

<script>
    $('body').show();
    $('.version').text(NProgress.version);
    NProgress.start();
    setTimeout(function() { NProgress.done(); $('.fade').removeClass('out'); }, 1000);

    $("#b-0").click(function() { NProgress.start(); });
    $("#b-40").click(function() { NProgress.set(0.4); });
    $("#b-inc").click(function() { NProgress.inc(); });
    $("#b-100").click(function() { NProgress.done(); });
</script>

<script type="text/javascript">
jQuery(document).ready(function() {
    var offset = 220;
    var duration = 500;
    jQuery(window).scroll(function() {
        if (jQuery(this).scrollTop() > offset) {
            jQuery('.back-to-top').fadeIn(duration);
        } else {
            jQuery('.back-to-top').fadeOut(duration);
        }
    });

    jQuery('.back-to-top').click(function(event) {
        event.preventDefault();
        jQuery('html, body').animate({scrollTop: 0}, duration);
        return false;
    })
});
</script>
 <a href="#top" class="back-to-top"><i class="fa fa-angle-up "></i></a>
</body>
</html>
