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
 * Class theme_elegance
 *
 * @package     theme_elgance
 * @copyright   2019 Bas Brands
 * @license     http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

namespace theme_elegance\output;

use stdClass;
use theme_config;

/**
 * Class renderer
 *
 * @package     theme_elgance
 * @copyright   2019 Bas Brands
 * @license     http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
class marketingspots implements \templatable, \renderable {

    /**
     * Function to export the renderer data in a format that is suitable for a
     * mustache template. This means:
     * 1. No complex types - only stdClass, array, int, string, float, bool
     * 2. Any additional info that is required for the template is pre-calculated (e.g. capability checks).
     *
     * @param renderer_base $output Used to do a final render of any components that need to be rendered for export.
     * @return array
     */
    public function export_for_template($output) {
        $theme = theme_config::load('elegance');
        $settings = $theme->settings;

        switch ($settings->togglemarketing) {
            case 1:
                break;
            case 2:
                if (isloggedin()) {
                    return '';
                }
                break;
            case 3:
                if (!isloggedin()) {
                    return '';
                }
                break;
            case 4:
                return '';
                break;
        }

        $spotsnr = $settings->marketingspotsnr;

        if ($spotsnr == 0) {
            return '';
        }

        $template = new stdClass();
        $template->spots = [];
        $template->title = '';
        $template->marketingtitletitleicon = '';

        if (!empty($settings->marketingtitle)) {
            $template->marketingtitle = $settings->marketingtitle;

        }
        if (!empty($settings->marketingtitleicon)) {
            $template->marketingtitleicon = $settings->marketingtitleicon;
        }

        $choices = array();
        $choices[1] = 'col-sm-6 col-md-6';//2;
        $choices[2] = 'col-6 col-sm-4 col-md-3';//4
        $choices[3] = 'col-6 col-sm-3 col-md-2';//6;
        $choices[4] = 'col-6 col-sm-3 col-md-2 col-lg-1';//12;

        if (!empty($settings->marketingspotsinrow)) {
            $template->spotclass = $choices[$settings->marketingspotsinrow];
        } else {
            $template->spotclass = $choices[2];
        }

        foreach (range(1, $spotsnr) as $spot) {
            $title = 'marketingtitle' . $spot;
            $icon = 'marketingicon' . $spot;
            $content = 'marketingcontent' . $spot;
            $url = 'marketingurl' . $spot;
            $image = 'marketingimage' . $spot;

            $marketingspot = new stdClass();
            if (!empty($settings->$title)) {
                $marketingspot->title = $settings->$title;
            }
            if (!empty($settings->$image)) {
                $marketingspot->image = $theme->setting_file_url($image, $image);
            }
            if (!empty($settings->$icon)) {
                $marketingspot->icon = $settings->$icon;
            }
            if (!empty($settings->$content)) {
                $marketingspot->content = $settings->$content;
            }
            if (!empty($settings->$url)) {
                $marketingspot->url = $settings->$url;
            }
            $template->spots[] = $marketingspot;
        }

        return $template;
    }
}