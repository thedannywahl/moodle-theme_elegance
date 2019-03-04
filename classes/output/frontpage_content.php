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
class frontpage_content implements \templatable, \renderable {

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

        $template = new stdClass();
        $template->frontpagetext = $settings->frontpagecontent;
        return $template;
    }
}