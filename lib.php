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
 * The Elegance theme is built upon theme boost.
 *
 * @package    theme
 * @subpackage theme_elegance
 * @author     Julian (@moodleman) Ridden
 * @copyright  2019 Bas Brands <bas@sonsbeekmedia.nl>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

/**
 * Returns the main SCSS content.
 *
 * @param theme_config $theme The theme config object.
 * @return string
 */
function theme_elegance_get_main_scss_content($theme) {
    global $CFG;

    $scss = file_get_contents($CFG->dirroot . '/theme/elegance/scss/variables.scss');
    $scss .= file_get_contents($CFG->dirroot . '/theme/boost/scss/fontawesome.scss');
    $scss .= file_get_contents($CFG->dirroot . '/theme/boost/scss/bootstrap.scss');
    $scss .= file_get_contents($CFG->dirroot . '/theme/boost/scss/moodle.scss');
    $scss .= file_get_contents($CFG->dirroot . '/theme/elegance/scss/post.scss');

    return $scss;
}

/**
 * Returns variables for Sass.
 *
 * We will inject some Sass variables from the settings that the user has defined
 * for the theme.
 *
 * @param theme_config $theme The theme config object.
 * @return array of Sass variables without the $.
 */
function theme_elegance_get_pre_scss($theme) {
    $variables = array();
    $settings = $theme->settings;

    $images = array('headerbg', 'bodybg', 'logo');

    foreach ($images as $image) {
        if (!empty($settings->$image)) {
            $imagefile = $theme->setting_file_url($image, $image);
            $variables[$image] = "url('" . $imagefile . "')";
        }
    }

    $textvars = array('themecolor', 'fontcolor', 'headingcolor', 'videowidth', 'transparency', 'bodycolor');

    foreach ($textvars as $textvar) {
        if (!empty($settings->$textvar)) {
            $variables[$textvar] = $settings->$textvar;
        }
    }

    if (!empty($settings->maxwidth)) {
        $variables['maxwidth'] = $settings->maxwidth . 'px';
    }

    if (!empty($settings->fixednavbar)) {
        $variables['navbarpadding'] = '50px';
    }

    if (!empty($settings->loginbgnumber)) {
        if ($settings->loginbgnumber > 0) {
            $variables['loginbgcolor'] = 'transparent';
            $variables['loginbg'] = 'none';
        }
    }

    if (!empty($settings->bodybgconfig)) {
        switch($settings->bodybgconfig) {
            case 1:
                $variables['bodybgrepeat'] = 'repeat';
                $variables['bodybgposition'] = 'initial';
                $variables['bodybgsize'] = 'initial';
                $variables['bodybgattach'] = 'initial';
                break;
            case 2:
                $variables['bodybgrepeat'] = 'no-repeat';
                $variables['bodybgposition'] = 'fixed center center';
                $variables['bodybgsize'] = 'cover';
                $variables['bodybgattach'] = 'fixed';
                break;
            case 3:
                $variables['bodybgrepeat'] = 'no-repeat';
                $variables['bodybgposition'] = 'fixed center center';
                $variables['bodybgsize'] = 'cover';
                $variables['bodybgattach'] = 'scroll';
                break;
        }
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

    $scss = '';
    foreach ($variables as $key => $value) {
        $scss .= "$" . $key . ": " . $value . ";\n";
    }

    return $scss;
}

function theme_elegance_process_css($css, $theme) {
    global $CFG;


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
        } else if (preg_match('/marketingimage\d+/', $filearea)) {
            return $theme->setting_file_serve($filearea, $args, $forcedownload, $options);
        } else {
            send_file_not_found();
        }
    } else {
        send_file_not_found();
    }
}
