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
$hassidemiddle = $PAGE->blocks->region_has_content('side-middle', $OUTPUT);
$hassidepre = $PAGE->blocks->region_has_content('side-pre', $OUTPUT);
$hassidepost = $PAGE->blocks->region_has_content('side-post', $OUTPUT);

$knownregionpre = $PAGE->blocks->is_known_region('side-pre');
$knownregionpost = $PAGE->blocks->is_known_region('side-post');

$regions = elegance_grid($hassidepre, $hassidepost);

if ($PAGE->user_is_editing()) {
    $hassidemiddle = true;
}

$widgets = $PAGE->get_renderer('theme_elegance', 'widgets');

$haslogo = (!empty($PAGE->theme->settings->logo));
$invert = (!empty($PAGE->theme->settings->invert));

$hasbanner = (!empty($PAGE->layout_options['hasbanner']));
$hasmarketing = (!empty($PAGE->layout_options['hasmarketing']));
$hasfooter = (empty($PAGE->layout_options['nofooter']));
$hasquicklinks = (!empty($PAGE->layout_options['hasquicklinks']));
$transparentmain = (!empty($PAGE->layout_options['transparentmain']));
$hasmoodleheader = (empty($PAGE->layout_options['nomoodleheader']));

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

if ($transparentmain) {
    $mainclass = 'm-t-30';
} else {
    $mainclass = 'eboxshadow bg-white p-20';
}

$knownregionpost = $PAGE->blocks->is_known_region('side-post');

$PAGE->set_popup_notification_allowed(false);

$PAGE->requires->jquery();
$PAGE->requires->jquery_plugin('fitvids', 'theme_elegance');
$PAGE->requires->jquery_plugin('unslider', 'theme_elegance');
$PAGE->requires->jquery_plugin('eventswipe', 'theme_elegance');
$PAGE->requires->jquery_plugin('nprogress', 'theme_elegance');
$PAGE->requires->jquery_plugin('backstretch', 'theme_elegance');
$PAGE->requires->jquery_plugin('elegance', 'theme_elegance');

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

<div id="page-content-wrapper">
    <nav role="navigation" class="navbar <?php echo $navbartype; ?> eboxshadow">

        <div class="container-fluid">
            <div class="navbar-header pull-left">

                <a class="navbar-brand" href="<?php echo $CFG->wwwroot;?>"><?php echo $logo; ?></a>
            </div>

            <div class="navbar-header pull-right">
                <?php echo $OUTPUT->user_menu(); ?>
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#moodle-navbar">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
            </div>

            <div id="moodle-navbar" class="navbar-collapse collapse navbar-right">
                <?php echo $OUTPUT->custom_menu(); ?>
                <ul class="nav pull-right">
                    <li><?php echo $OUTPUT->page_heading_menu(); ?></li>
                </ul>
            </div>
        </div>

    </nav>

    <?php echo $widgets->banner($hasbanner); ?>

    <?php echo $widgets->marketing_spots($hasmarketing, $hassidemiddle); ?>
    <div class="container-fluid">
        <?php if ($hasmoodleheader) { ?>
        <header id="moodleheader" class="clearfix">
            
            <div id="course-header" class="p-l-15 p-r-15 p-b-10 p-t-10">
                <?php echo $OUTPUT->page_heading(); ?>
                <?php echo $OUTPUT->course_header(); ?>
                <?php echo $OUTPUT->course_content_header(); ?>
            </div>

        </header>
        <?php } ?>
    </div>
    <div id="page-navbar" >
        <div class="container-fluid">
            <nav class="breadcrumb-nav elegancewidth" role="navigation" aria-label="breadcrumb"><?php echo $OUTPUT->navbar(); ?></nav>
            <div class="breadcrumb-button"><?php echo $OUTPUT->page_heading_button(); ?></div>
            <div class="clearfix"></div>
        </div>
    </div>
    <div class="container-fluid">
    <section id="page" >
        <div id="page-content" class="row">
            <div id="region-main" class="<?php echo $regions['content']; ?>">
                <div class="<?php echo $mainclass; ?>">
                <?php
                echo $widgets->quicklinks($hasquicklinks);
                echo $OUTPUT->course_content_header();
                echo $OUTPUT->main_content();
                echo $OUTPUT->course_content_footer();
                echo $widgets->hiddenblocks();
                ?>
                </div>
            </div>

            <?php
            if ($knownregionpre) {
                echo $OUTPUT->blocks('side-pre', $regions['pre']);
            }?>
            <?php
            if ($knownregionpost) {
                echo $OUTPUT->blocks('side-post', $regions['post']);
            }?>
        </div>
    </section>
    </div>
</div>

<footer id="page-footer" >
    <div class="page-footer-inner">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-6">
                    <?php echo $widgets->footerleft($hasfooter); ?>
                </div>
                <div class="col-md-6">
                    <?php echo $OUTPUT->login_info(); ?>
                    <?php echo $widgets->footerright($hasfooter); ?>
                </div>
            </div>
        </div>
    </div>
</footer>

<?php echo $OUTPUT->standard_end_of_body_html() ?>

<script>

</script>


 <a href="#top" class="back-to-top"><i class="fa fa-angle-up "></i></a>
</body>
</html>
