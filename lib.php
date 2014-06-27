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


function theme_elegance_get_nav_links($course, $sections, $sectionno) {
  // FIXME: This is really evil and should by using the navigation API.
  $courseformat = course_get_format($course);
  $course = $courseformat->get_course();
  $previousarrow= '<i class="nav_icon fa fa-chevron-circle-left"></i>';
  $nextarrow= '<i class="nav_icon fa fa-chevron-circle-right"></i>';
  $canviewhidden = has_capability('moodle/course:viewhiddensections', context_course::instance($course->id))
    or !$course->hiddensections;

  $links = array('previous' => '', 'next' => '');
  $back = $sectionno - 1;
  while ($back > 0 and empty($links['previous'])) {
    if ($canviewhidden || $sections[$back]->uservisible) {
      $params = array('id' => 'previous_section');
      if (!$sections[$back]->visible) {
        $params = array('id' => 'previous_section', 'class' => 'dimmed_text');
      }
      $previouslink = $previousarrow;
      $previouslink .= html_writer::start_tag('span', array('class' => 'text'));
      $previouslink .= html_writer::start_tag('span', array('class' => 'nav_guide'));
      $previouslink .= get_string('previoussection', 'theme_elegance');
      $previouslink .= html_writer::end_tag('span');
      $previouslink .= html_writer::empty_tag('br');
      $previouslink .= $courseformat->get_section_name($sections[$back]);
      $previouslink .= html_writer::end_tag('span');
      $links['previous'] = html_writer::link(course_get_url($course, $back), $previouslink, $params);
    }
    $back--;
  }

  $forward = $sectionno + 1;
  while ($forward <= $course->numsections and empty($links['next'])) {
    if ($canviewhidden || $sections[$forward]->uservisible) {
      $params = array('id' => 'next_section');
      if (!$sections[$forward]->visible) {
        $params = array('id' => 'next_section', 'class' => 'dimmed_text');
      }
      $nextlink = $nextarrow;
      $nextlink .= html_writer::start_tag('span', array('class' => 'text'));
      $nextlink .= html_writer::start_tag('span', array('class' => 'nav_guide'));
      $nextlink .= get_string('nextsection', 'theme_elegance');
      $nextlink .= html_writer::end_tag('span');
      $nextlink .= html_writer::empty_tag('br');
      $nextlink .= $courseformat->get_section_name($sections[$forward]);
      $nextlink .= html_writer::end_tag('span');
      $links['next'] = html_writer::link(course_get_url($course, $forward), $nextlink, $params);
    }
    $forward++;
  }

  return $links;
}

function theme_elegance_bootstrap3_grid($hassidepost) {

        $regions = array('content' => 'col-sm-8 col-md-9');
        $regions['pre'] = 'empty';
        $regions['post'] = 'col-sm-4 col-md-3';

       return $regions;
}

function theme_elegance_initialise_reader(moodle_page $page) {
    $page->requires->yui_module('moodle-theme_elegance-reader', 'M.theme_elegance.initreader', array());
}

function theme_elegance_process_css($css, $theme) {

    // Set the background image for the logo.
    $logo = $theme->setting_file_url('logo', 'logo');
    $css = theme_elegance_set_logo($css, $logo);

    // Set the background image for the header.
    $setting = 'headerbg';
    $headerbg = $theme->setting_file_url($setting, $setting);
    $css = theme_elegance_set_headerbg($css, $headerbg, $setting);

    // Set the background image for the Page.
    $setting = 'bodybg';
    $bodybg = $theme->setting_file_url($setting, $setting);
    $css = theme_elegance_set_bodybg($css, $bodybg, $setting);

    // Set custom CSS.
    if (!empty($theme->settings->customcss)) {
        $customcss = $theme->settings->customcss;
    } else {
        $customcss = null;
    }
    $css = theme_elegance_set_customcss($css, $customcss);

    // Set the theme main color.
    if (!empty($theme->settings->themecolor)) {
        $themecolor = $theme->settings->themecolor;
    } else {
        $themecolor = null;
    }
    $css = theme_elegance_set_themecolor($css, $themecolor);

    // Set the theme backgroundcolor.
    if (!empty($theme->settings->bodycolor)) {
        $bodycolor = $theme->settings->bodycolor;
    } else {
        $bodycolor = null;
    }
    $css = theme_elegance_set_bodycolor($css, $bodycolor);

    // Set the font color.
    if (!empty($theme->settings->fontcolor)) {
        $fontcolor = $theme->settings->fontcolor;
    } else {
        $fontcolor = null;
    }
    $css = theme_elegance_set_fontcolor($css, $fontcolor);

    // Set the heading color.
    if (!empty($theme->settings->headingcolor)) {
        $headingcolor = $theme->settings->headingcolor;
    } else {
        $headingcolor = null;
    }
    $css = theme_elegance_set_headingcolor($css, $headingcolor);

    // Set the Defaut Category Icon.
    if (!empty($theme->settings->defaultcategoryicon)) {
        $defaultcategoryicon = $theme->settings->defaultcategoryicon;
    } else {
        $defaultcategoryicon = null;
    }
    $css = theme_elegance_set_defaultcategoryicon($css, $defaultcategoryicon);

    // Set Category Icons.
    foreach (range(1, 20) as $categorynumber) {
        $categoryicon = $defaultcategoryicon;
        if (!empty($theme->settings->usecategoryicon)) {
            if (!empty($theme->settings->{'categoryicon' . $categorynumber})) {
                $categoryicon = $theme->settings->{'categoryicon' . $categorynumber};
            }
        }
        $css = theme_elegance_set_categoryicon($css, $categoryicon, $categorynumber);
    }

    // Set the Video Max width.
    if (!empty($theme->settings->videowidth)) {
        $videowidth = $theme->settings->videowidth;
    } else {
        $videowidth = null;
    }
    $css = theme_elegance_set_videowidth($css, $videowidth);

    // Set Quicklink Icon Color.
    foreach (range(1, 12) as $quicklinksnumber) {
        $quicklinkiconcolor = $theme->settings->themecolor;
            if (!empty($theme->settings->{'quicklinkiconcolor' . $quicklinksnumber})) {
                $quicklinkiconcolor = $theme->settings->{'quicklinkiconcolor' . $quicklinksnumber};
            }
        $css = theme_elegance_set_quicklinkiconcolor($css, $quicklinkiconcolor, $quicklinksnumber);
    }

    // Set Quicklink Button Color.
    foreach (range(1, 12) as $quicklinksnumber) {
        $quicklinkbuttoncolor = '#ecedf0';
            if (!empty($theme->settings->{'quicklinkbuttoncolor' . $quicklinksnumber})) {
                $quicklinkbuttoncolor = $theme->settings->{'quicklinkbuttoncolor' . $quicklinksnumber};
            }
        $css = theme_elegance_set_quicklinkbuttoncolor($css, $quicklinkbuttoncolor, $quicklinksnumber);
    }


    // Set the Slide 1 color.
    if (!empty($theme->settings->bannercolor1)) {
        $bannercolor1 = $theme->settings->bannercolor1;
    } else {
        $bannercolor1 = null;
    }
    $css = theme_elegance_set_bannercolor1($css, $bannercolor1);

    // Set the Slide 2 color.
    if (!empty($theme->settings->bannercolor2)) {
        $bannercolor2 = $theme->settings->bannercolor2;
    } else {
        $bannercolor2 = null;
    }
    $css = theme_elegance_set_bannercolor2($css, $bannercolor2);

    // Set the Slide 3 color.
    if (!empty($theme->settings->bannercolor3)) {
        $bannercolor3 = $theme->settings->bannercolor3;
    } else {
        $bannercolor3 = null;
    }
    $css = theme_elegance_set_bannercolor3($css, $bannercolor3);

    // Set the Slide 4 color.
    if (!empty($theme->settings->bannercolor4)) {
        $bannercolor4 = $theme->settings->bannercolor4;
    } else {
        $bannercolor4 = null;
    }
    $css = theme_elegance_set_bannercolor4($css, $bannercolor4);

    // Set the Slide 5 color.
    if (!empty($theme->settings->bannercolor5)) {
        $bannercolor5 = $theme->settings->bannercolor5;
    } else {
        $bannercolor5 = null;
    }
    $css = theme_elegance_set_bannercolor5($css, $bannercolor5);

    // Set the Slide 6 color.
    if (!empty($theme->settings->bannercolor6)) {
        $bannercolor6 = $theme->settings->bannercolor6;
    } else {
        $bannercolor6 = null;
    }
    $css = theme_elegance_set_bannercolor6($css, $bannercolor6);

    // Set the Slide 7 color.
    if (!empty($theme->settings->bannercolor7)) {
        $bannercolor7 = $theme->settings->bannercolor7;
    } else {
        $bannercolor7 = null;
    }
    $css = theme_elegance_set_bannercolor7($css, $bannercolor7);

    // Set the Slide 8 color.
    if (!empty($theme->settings->bannercolor8)) {
        $bannercolor8 = $theme->settings->bannercolor8;
    } else {
        $bannercolor8 = null;
    }
    $css = theme_elegance_set_bannercolor8($css, $bannercolor8);

    // Set the Slide 9 color.
    if (!empty($theme->settings->bannercolor9)) {
        $bannercolor9 = $theme->settings->bannercolor9;
    } else {
        $bannercolor9 = null;
    }
    $css = theme_elegance_set_bannercolor9($css, $bannercolor9);

    // Set the Slide 10 color.
    if (!empty($theme->settings->bannercolor10)) {
        $bannercolor10 = $theme->settings->bannercolor10;
    } else {
        $bannercolor10 = null;
    }
    $css = theme_elegance_set_bannercolor10($css, $bannercolor10);

    // Set the Transparency.
    if (!empty($theme->settings->transparency)) {
        $transparency = $theme->settings->transparency;
    } else {
        $transparency = null;
    }
    $css = theme_elegance_set_transparency($css, $transparency);

    return $css;
}

/**
 * Adds the logo to CSS.
 *
 * @param string $css The CSS.
 * @param string $logo The URL of the logo.
 * @return string The parsed CSS
 */
function theme_elegance_set_logo($css, $logo) {
    global $OUTPUT;
    $tag = '[[setting:logo]]';
    $replacement = $logo;
    if (is_null($replacement)) {
        $replacement = $OUTPUT->pix_url('bg/logo', 'theme');
    }

    $css = str_replace($tag, $replacement, $css);

    return $css;
}

function theme_elegance_set_themecolor($css, $themecolor) {
    $tag = '[[setting:themecolor]]';
    $replacement = $themecolor;
    if (is_null($replacement)) {
        $replacement = '#0098e0';
    }
    $css = str_replace($tag, $replacement, $css);
    return $css;
}

function theme_elegance_set_bodycolor($css, $bodycolor) {
    $tag = '[[setting:bodycolor]]';
    $replacement = $bodycolor;
    if (is_null($replacement)) {
        $replacement = '#f1f1f4';
    }
    $css = str_replace($tag, $replacement, $css);
    return $css;
}

function theme_elegance_set_fontcolor($css, $fontcolor) {
    $tag = '[[setting:fontcolor]]';
    $replacement = $fontcolor;
    if (is_null($replacement)) {
        $replacement = '#666';
    }
    $css = str_replace($tag, $replacement, $css);
    return $css;
}

function theme_elegance_set_headingcolor($css, $headingcolor) {
    $tag = '[[setting:headingcolor]]';
    $replacement = $headingcolor;
    if (is_null($replacement)) {
        $replacement = '#27282a';
    }
    $css = str_replace($tag, $replacement, $css);
    return $css;
}

/**
 * Serves any files associated with the theme settings.
 *
 * @param stdClass $course
 * @param stdClass $cm
 * @param context $context
 * @param string $filearea
 * @param array $args
 * @param bool $forcedownload
 * @param array $options
 * @return bool
 */

function theme_elegance_pluginfile($course, $cm, $context, $filearea, $args, $forcedownload, array $options = array()) {
    if ($context->contextlevel == CONTEXT_SYSTEM) {
        $theme = theme_config::load('elegance');
        if ($filearea === 'logo') {
            return $theme->setting_file_serve('logo', $args, $forcedownload, $options);
        } else if ($filearea === 'headerbg') {
            return $theme->setting_file_serve('headerbg', $args, $forcedownload, $options);
        } else if ($filearea === 'bodybg') {
            return $theme->setting_file_serve('bodybg', $args, $forcedownload, $options);
        } else if ($filearea === 'bannerimage1') {
            return $theme->setting_file_serve('bannerimage1', $args, $forcedownload, $options);
        } else if ($filearea === 'bannerimage2') {
            return $theme->setting_file_serve('bannerimage2', $args, $forcedownload, $options);
        } else if ($filearea === 'bannerimage3') {
            return $theme->setting_file_serve('bannerimage3', $args, $forcedownload, $options);
        } else if ($filearea === 'bannerimage4') {
            return $theme->setting_file_serve('bannerimage4', $args, $forcedownload, $options);
        } else if ($filearea === 'bannerimage5') {
            return $theme->setting_file_serve('bannerimage5', $args, $forcedownload, $options);
        } else if ($filearea === 'bannerimage6') {
            return $theme->setting_file_serve('bannerimage6', $args, $forcedownload, $options);
        } else if ($filearea === 'bannerimage7') {
            return $theme->setting_file_serve('bannerimage7', $args, $forcedownload, $options);
        } else if ($filearea === 'bannerimage8') {
            return $theme->setting_file_serve('bannerimage8', $args, $forcedownload, $options);
        } else if ($filearea === 'bannerimage9') {
            return $theme->setting_file_serve('bannerimage9', $args, $forcedownload, $options);
        } else if ($filearea === 'bannerimage10') {
            return $theme->setting_file_serve('bannerimage10', $args, $forcedownload, $options);
        } else if ($filearea === 'loginimage1') {
            return $theme->setting_file_serve('loginimage1', $args, $forcedownload, $options);
        } else if ($filearea === 'loginimage2') {
            return $theme->setting_file_serve('loginimage2', $args, $forcedownload, $options);
        } else if ($filearea === 'loginimage3') {
            return $theme->setting_file_serve('loginimage3', $args, $forcedownload, $options);
        } else if ($filearea === 'loginimage4') {
            return $theme->setting_file_serve('loginimage4', $args, $forcedownload, $options);
        } else if ($filearea === 'loginimage5') {
            return $theme->setting_file_serve('loginimage5', $args, $forcedownload, $options);
        } else {
            send_file_not_found();
        }
    } else {
        send_file_not_found();
    }
}

/**
 * Adds any custom CSS to the CSS before it is cached.
 *
 * @param string $css The original CSS.
 * @param string $customcss The custom CSS to add.
 * @return string The CSS which now contains our custom CSS.
 */
function theme_elegance_set_customcss($css, $customcss) {
    $tag = '[[setting:customcss]]';
    $replacement = $customcss;
    if (is_null($replacement)) {
        $replacement = '';
    }

    $css = str_replace($tag, $replacement, $css);

    return $css;
}

/**
 * Returns an object containing HTML for the areas affected by settings.
 *
 * @param renderer_base $output Pass in $OUTPUT.
 * @param moodle_page $page Pass in $PAGE.
 * @return stdClass An object with the following properties:
 *      - navbarclass A CSS class to use on the navbar. By default ''.
 *      - heading HTML to use for the heading. A logo if one is selected or the default heading.
 *      - footnote HTML to use as a footnote. By default ''.
 */
function theme_elegance_get_html_for_settings(renderer_base $output, moodle_page $page) {
    global $CFG;
    $return = new stdClass;

    $return->navbarclass = ' ';
    if (!empty($page->theme->settings->invert)) {
        $return->navbarclass .= 'navbar-inverse';
    } else {
    	$return->navbarclass .= 'navbar-default';
    }

    $return->footnote = '';
    if (!empty($page->theme->settings->footnote)) {
        $return->footnote = '<div class="footnote text-center">'.$page->theme->settings->footnote.'</div>';
    }

    return $return;
}

/**
 * All theme functions should start with theme_elegance_
 * @deprecated since 2.5.1
 */
function elegance_process_css() {
    throw new coding_exception('Please call theme_'.__FUNCTION__.' instead of '.__FUNCTION__);
}

/**
 * All theme functions should start with theme_elegance_
 * @deprecated since 2.5.1
 */
function elegance_set_logo() {
    throw new coding_exception('Please call theme_'.__FUNCTION__.' instead of '.__FUNCTION__);
}

/**
 * All theme functions should start with theme_elegance_
 * @deprecated since 2.5.1
 */
function elegance_set_customcss() {
    throw new coding_exception('Please call theme_'.__FUNCTION__.' instead of '.__FUNCTION__);
}

function theme_elegance_set_headerbg($css, $headerbg, $setting) {
    global $OUTPUT;
    $tag = '[[setting:headerbg]]';
    $replacement = $headerbg;
    if (is_null($replacement)) {
        // Get default image from themes 'bg' folder of the name in $setting.
        $replacement = $OUTPUT->pix_url('bg/header', 'theme');
    }
    $css = str_replace($tag, $replacement, $css);
    return $css;
}

function theme_elegance_set_bodybg($css, $bodybg, $setting) {
    global $OUTPUT;
    $tag = '[[setting:bodybg]]';
    $replacement = $bodybg;
    if (is_null($replacement)) {
        // Get default image from themes 'bg' folder of the name in $setting.
        $replacement = $OUTPUT->pix_url('bg/body', 'theme');
    }
    $css = str_replace($tag, $replacement, $css);
    return $css;
}

function theme_elegance_set_defaultcategoryicon($css, $defaultcategoryicon) {
    $tag = '[[setting:defaultcategoryicon]]';
    $replacement = $defaultcategoryicon;
    if (is_null($replacement)) {
        $replacement = 'f07c';
    }
    $css = str_replace($tag, $replacement, $css);
    return $css;
}

function theme_elegance_set_categoryicon($css, $categoryicon, $categorynumber) {
    $tag = '[[setting:categoryicon' . $categorynumber . ']]';
    $replacement = $categoryicon;

    if (is_null($replacement)) {
        $replacement = 'f07c';
    }
    $css = str_replace($tag, $replacement, $css);
    return $css;
}

function theme_elegance_set_quicklinkiconcolor($css, $quicklinkiconcolor, $quicklinksnumber) {
    $tag = '[[setting:quicklinkiconcolor' . $quicklinksnumber . ']]';
    $replacement = $quicklinkiconcolor;

    if (is_null($replacement)) {
        $replacement = $theme->settings->themecolor;
    }
    $css = str_replace($tag, $replacement, $css);
    return $css;
}

function theme_elegance_set_quicklinkbuttoncolor($css, $quicklinkbuttoncolor, $quicklinksnumber) {
    $tag = '[[setting:quicklinkbuttoncolor' . $quicklinksnumber . ']]';
    $replacement = $quicklinkbuttoncolor;

    if (is_null($replacement)) {
        $replacement = '#ecedf0';
    }
    $css = str_replace($tag, $replacement, $css);
    return $css;
}

function theme_elegance_set_bannercolor1($css, $bannercolor1) {
    $tag = '[[setting:slide1color]]';
    $replacement = $bannercolor1;
    if (is_null($replacement)) {
        $replacement = '#000000';
    }
    $css = str_replace($tag, $replacement, $css);
    return $css;
}

function theme_elegance_set_bannercolor2($css, $bannercolor2) {
    $tag = '[[setting:slide2color]]';
    $replacement = $bannercolor2;
    if (is_null($replacement)) {
        $replacement = '#000000';
    }
    $css = str_replace($tag, $replacement, $css);
    return $css;
}

function theme_elegance_set_bannercolor3($css, $bannercolor3) {
    $tag = '[[setting:slide3color]]';
    $replacement = $bannercolor3;
    if (is_null($replacement)) {
        $replacement = '#000000';
    }
    $css = str_replace($tag, $replacement, $css);
    return $css;
}

function theme_elegance_set_bannercolor4($css, $bannercolor4) {
    $tag = '[[setting:slide4color]]';
    $replacement = $bannercolor4;
    if (is_null($replacement)) {
        $replacement = '#000000';
    }
    $css = str_replace($tag, $replacement, $css);
    return $css;
}

function theme_elegance_set_bannercolor5($css, $bannercolor5) {
    $tag = '[[setting:slide5color]]';
    $replacement = $bannercolor5;
    if (is_null($replacement)) {
        $replacement = '#000000';
    }
    $css = str_replace($tag, $replacement, $css);
    return $css;
}

function theme_elegance_set_bannercolor6($css, $bannercolor6) {
    $tag = '[[setting:slide6color]]';
    $replacement = $bannercolor6;
    if (is_null($replacement)) {
        $replacement = '#000000';
    }
    $css = str_replace($tag, $replacement, $css);
    return $css;
}

function theme_elegance_set_bannercolor7($css, $bannercolor7) {
    $tag = '[[setting:slide7color]]';
    $replacement = $bannercolor7;
    if (is_null($replacement)) {
        $replacement = '#000000';
    }
    $css = str_replace($tag, $replacement, $css);
    return $css;
}

function theme_elegance_set_bannercolor8($css, $bannercolor8) {
    $tag = '[[setting:slide8color]]';
    $replacement = $bannercolor8;
    if (is_null($replacement)) {
        $replacement = '#000000';
    }
    $css = str_replace($tag, $replacement, $css);
    return $css;
}

function theme_elegance_set_bannercolor9($css, $bannercolor9) {
    $tag = '[[setting:slide9color]]';
    $replacement = $bannercolor9;
    if (is_null($replacement)) {
        $replacement = '#000000';
    }
    $css = str_replace($tag, $replacement, $css);
    return $css;
}

function theme_elegance_set_bannercolor10($css, $bannercolor10) {
    $tag = '[[setting:slide10color]]';
    $replacement = $bannercolor10;
    if (is_null($replacement)) {
        $replacement = '#000000';
    }
    $css = str_replace($tag, $replacement, $css);
    return $css;
}

function theme_elegance_set_transparency($css, $transparency) {
    $tag = '[[setting:transparency]]';
    $replacement = $transparency;
    if (is_null($replacement)) {
        $replacement = '1';
    }
    $css = str_replace($tag, $replacement, $css);
    return $css;
}

function theme_elegance_set_videowidth($css, $videowidth) {
    $tag = '[[setting:videowidth]]';
    $replacement = $videowidth;
    if (is_null($replacement)) {
        $replacement = '100%';
    }
    $css = str_replace($tag, $replacement, $css);
    return $css;
}


function theme_elegance_page_init(moodle_page $page) {
    $page->requires->jquery();
    $page->requires->jquery_plugin('fitvids', 'theme_elegance');
    $page->requires->jquery_plugin('nprogress', 'theme_elegance');
    $page->requires->jquery_plugin('unslider', 'theme_elegance');
    $page->requires->jquery_plugin('eventswipe', 'theme_elegance');
    $page->requires->jquery_plugin('backstretch', 'theme_elegance');
    $page->requires->jquery_plugin('modernizr', 'theme_elegance');
}
