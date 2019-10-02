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
class quicklinks implements \templatable, \renderable {

	/**
     * Function to export the renderer data in a format that is suitable for a
     * mustache template. This means:
     * 1. No complex types - only stdClass, array, int, string, float, bool
     * 2. Any additional info that is required for the template is pre-calculated (e.g. capability checks).
     *
     * @param renderer_base $output Used to do a final render of any components that need to be rendered for export.
     * @return array
     */
    public function export_for_template(\renderer_base $output) {
        $theme = theme_config::load('elegance');
        $settings = $theme->settings;

        switch ($settings->togglequicklinks) {
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

        $template = new stdClass();

        $template->quicklinksicon = $settings->quicklinksicon;
        $template->quicklinkstitle = $settings->quicklinkstitle;
        $quicklinksnumber = $settings->quicklinksnumber;

        if ($quicklinksnumber == 0) {
            return '';
        }

        $template->quicklinks = array();
        foreach (range(1, $quicklinksnumber ) as $i) {
            $icon = 'quicklinkicon' . $i;
            $buttontext = 'quicklinkbuttontext' . $i;
            $url = 'quicklinkbuttonurl' . $i;
            $iconclass = 'quicklinkiconcolor' . $i;
            $buttonclass = 'quicklinkbuttoncolor' . $i;

            $quicklink = new stdClass();

            if (!empty($settings->$icon)) {
                $quicklink->icon = $settings->$icon;
            } else {
                $quicklink->icon = 'check';
            }
            if (!empty($settings->$buttontext)) {
                $quicklink->buttontext = $settings->$buttontext;
            } else {
                $quicklink->buttontext = 'Click here';
            }
            if (!empty($settings->$url)) {
                $quicklink->url = $settings->$url;
            }
            $quicklink->iconclass = $iconclass;
            $quicklink->buttonclass = $buttonclass;
            $template->quicklinks[] = $quicklink;
        }

        $count = count($template->quicklinks);

        if ($count < 4) {
            $template->classlarge = 'col-lg-' . (12 / $count);
        } else {
            $template->classlarge = 'col-lg-3';
        }
        if ($count < 3) {
            $template->classmedium = 'col-md-' . (12 / $count);
        } else {
            $template->classmedium = 'col-md-4';
        }
        return $template;
    }
}