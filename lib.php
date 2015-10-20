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

function elegance_grid($hassidepre, $hassidepost) {

    if ($hassidepre && $hassidepost) {
        $regions = array('content' => 'col-sm-6 col-sm-push-3');
        $regions['pre'] = 'col-sm-3 col-sm-pull-6';
        $regions['post'] = 'col-sm-3';
    } else if ($hassidepre && !$hassidepost) {
        $regions = array('content' => 'col-sm-9 col-sm-push-3');
        $regions['pre'] = 'col-sm-3 col-sm-pull-9';
        $regions['post'] = 'emtpy';
    } else if (!$hassidepre && $hassidepost) {
        $regions = array('content' => 'col-sm-9');
        $regions['pre'] = 'empty';
        $regions['post'] = 'col-sm-3';
    } else if (!$hassidepre && !$hassidepost) {
        $regions = array('content' => 'col-md-12');
        $regions['pre'] = 'empty';
        $regions['post'] = 'empty';
    }

    if ('rtl' === get_string('thisdirection', 'langconfig')) {
        if ($hassidepre && $hassidepost) {
            $regions['pre'] = 'col-sm-3  col-sm-push-3';
            $regions['post'] = 'col-sm-3 col-sm-pull-9';
        } else if ($hassidepre && !$hassidepost) {
            $regions = array('content' => 'col-sm-9');
            $regions['pre'] = 'col-sm-3';
            $regions['post'] = 'empty';
        } else if (!$hassidepre && $hassidepost) {
            $regions = array('content' => 'col-sm-9 col-sm-push-3');
            $regions['pre'] = 'empty';
            $regions['post'] = 'col-sm-3 col-sm-pull-9';
        }
    }
    return $regions;
}


function theme_elegance_extra_less($theme) {

}

/**
 * Returns variables for LESS.
 *
 * We will inject some LESS variables from the settings that the user has defined
 * for the theme. No need to write some custom LESS for this.
 *
 * @param theme_config $theme The theme config object.
 * @return array of LESS variables without the @.
 */
function theme_elegance_less_variables($theme) {
    $variables = array();
    $settings = $theme->settings;

    $images = array('headerbg', 'bodybg', 'logo');

    foreach ($images as $image) {
        if (!empty($settings->$image)) {
            $imagefile = $theme->setting_file_url($image, $image);
            $variables[$image] = "'" . $imagefile . "'";
        }
    }

    $textvars = array('themecolor', 'fontcolor', 'headingcolor', 'videowidth', 'transparency');

    foreach ($textvars as $textvar) {
        if (!empty($settings->$textvar)) {
            $variables[$textvar] = $settings->$textvar;
        }
    }

    if (!empty($settings->maxwidth)) {
        $variables['maxwidth'] = $settings->maxwidth . 'px';
    }

    foreach (range(1, 12) as $i) {
        $textvar = "quicklinkiconcolor" . $i;
        if (!empty($settings->$textvar)) {
            $variables[$textvar] = $settings->$textvar;
        }

        $textvar = "quicklinkbuttoncolor" . $i;
        if (!empty($settings->$textvar)) {
            $variables[$textvar] = $settings->$textvar;
        }
    }

    return $variables;
}

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

function theme_elegance_initialise_reader(moodle_page $page) {
    $page->requires->yui_module('moodle-theme_elegance-reader', 'M.theme_elegance.initreader', array());
}

function theme_elegance_process_css($css, $theme) {

    // Set the background image for the logo.

    // Set custom CSS.
    if (!empty($theme->settings->customcss)) {
        $customcss = $theme->settings->customcss;
    } else {
        $customcss = null;
    }
    $css = theme_elegance_set_customcss($css, $customcss);

    // Set custom Moodle Mobile CSS.
    if (!empty($theme->settings->moodlemobilecss)) {
        $moodlemobilecss = $theme->settings->moodlemobilecss;
    } else {
        $moodlemobilecss = null;
    }
    $css = theme_elegance_set_moodlemobilecss($css, $moodlemobilecss);

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

        if (!array_key_exists('cacheability', $options)) {
            $options['cacheability'] = 'public';
        }

        if ($filearea === 'logo') {
            return $theme->setting_file_serve('logo', $args, $forcedownload, $options);
        } else if ($filearea === 'headerbg') {
            return $theme->setting_file_serve('headerbg', $args, $forcedownload, $options);
        } else if ($filearea === 'bodybg') {
            return $theme->setting_file_serve('bodybg', $args, $forcedownload, $options);
        } else if (preg_match('/bannerimage\d+/', $filearea)) {
            return $theme->setting_file_serve($filearea, $args, $forcedownload, $options);
        } else if (preg_match('/loginimage\d+/', $filearea)) {
            return $theme->setting_file_serve($filearea, $args, $forcedownload, $options);
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
    $tag = '"[[setting:customcss]]"';
    $replacement = $customcss;
    if (is_null($replacement)) {
        $replacement = '';
    }

    $css = str_replace($tag, $replacement, $css);

    return $css;
}

/**
 * Adds any custom Moodle Mobile CSS to the CSS before it is cached.
 *
 * @param string $css The original CSS.
 * @param string $moodlemobilecss The custom CSS to add.
 * @return string The CSS which now contains our custom Moodle Mobile CSS.
 */
function theme_elegance_set_moodlemobilecss($css, $moodlemobilecss) {
    $tag = '"[[setting:moodlemobilecss]]"';
    $replacement = $moodlemobilecss;
    if (is_null($replacement)) {
        $replacement = '';
    }

    $css = str_replace($tag, $replacement, $css);

    return $css;
}


function theme_elegance_set_transparency($css, $transparency) {
    $tag = '"[[setting:transparency]]"';
    $replacement = $transparency;
    if (is_null($replacement)) {
        $replacement = '1';
    }
    $css = str_replace($tag, $replacement, $css);
    return $css;
}

