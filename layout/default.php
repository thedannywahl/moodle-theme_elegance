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
 * The Elegance theme is built upon  Bootstrapbase 3 (non-core).
 *
 * @package    theme
 * @subpackage theme_elegance
 * @author     Bas Brands
 * @copyright  2015 Bas Brands http://basbrands.nl
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

$hassidepost = $PAGE->blocks->region_has_content('side-post', $OUTPUT);
$hassidemiddle = $PAGE->blocks->region_has_content('side-middle', $OUTPUT);
$hassidepre = $PAGE->blocks->region_has_content('side-pre', $OUTPUT);

$knownregionpre = $PAGE->blocks->is_known_region('side-pre');
$knownregionpost = $PAGE->blocks->is_known_region('side-post');

$regions = elegance_grid($hassidepre, $hassidepost);

if ($PAGE->user_is_editing()) {
    $hassidemiddle = true;
}

$widgets = $PAGE->get_renderer('theme_elegance', 'widgets');

$fixednavbar = (!empty($PAGE->theme->settings->fixednavbar));

$hasbanner = (!empty($PAGE->layout_options['hasbanner']));
$hasmarketing = (!empty($PAGE->layout_options['hasmarketing']));
$hasnavbar = (empty($PAGE->layout_options['nonavbar']));
$hasbreadcrumb = (empty($PAGE->layout_options['nobreadcrumb']));
$hasfooter = (empty($PAGE->layout_options['nofooter']));
$hasquicklinks = (!empty($PAGE->layout_options['hasquicklinks']));
$transparentmain = (!empty($PAGE->layout_options['transparentmain']));
$hasmoodleheader = (empty($PAGE->layout_options['nomoodleheader']));
$hassidemiddle = (!empty($PAGE->layout_options['hassidemiddle']));
$hasfrontpagecontent = (!empty($PAGE->layout_options['hasfrontpagecontent']));


if ($transparentmain) {
    $mainclass = 'm-t-30';
} else {
    $mainclass = 'eboxshadow bg-white p-20';
}

$knownregionpost = $PAGE->blocks->is_known_region('side-post');

$PAGE->set_popup_notification_allowed(false);

$PAGE->requires->jquery();
$PAGE->requires->jquery_plugin('fitvids', 'theme_elegance');
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
    <?php echo $widgets->navbar($hasnavbar); ?>

    <?php echo $widgets->banner($hasbanner); ?>

    <?php echo $widgets->frontpage_content($hasfrontpagecontent); ?>

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

    <?php echo $widgets->breadcrumb($hasbreadcrumb); ?>

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
                <div class="col-sm-6">
                    <?php echo $widgets->footerleft($hasfooter); ?>

                </div>
                <div class="col-sm-6">
                    <div class="text-right m-b-10">
                        <?php echo $OUTPUT->page_doc_link(); ?>
                        <?php echo $OUTPUT->login_info(); ?>
                    </div>
                    <?php echo $widgets->footerright($hasfooter); ?>
                </div>
                <?php echo $OUTPUT->standard_end_of_body_html() ?>
                <div class="clearfix"></div>
            </div>
        </div>

        <?php echo $OUTPUT->standard_footer_html(); ?>
    </div>
    
</footer>



<script>

</script>


 <a href="#top" class="back-to-top"><i class="fa fa-angle-up "></i></a>
</body>
</html>
