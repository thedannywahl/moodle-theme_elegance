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
 * Class renderer
 *
 * @package     theme_elegance
 * @copyright   2019 Bas Brands
 * @license     http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

namespace theme_elegance\output;

defined('MOODLE_INTERNAL') || die();

/**
 * Class renderer
 *
 * @package     theme_elegance
 * @copyright   2019 Bas Brands
 * @license     http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
class renderer extends \plugin_renderer_base {

    /**
     * Renderer for the carousel slides
     *
     * @param carousel $carousel
     * @return bool|string
     */
    protected function render_carousel(carousel $carousel) {
        $context = $carousel->export_for_template($this);
        return $this->render_from_template('theme_elegance/widget_carousel', $context);
    }

    /**
     * Renderer for the marketingspots
     *
     * @param marketingspots $view
     * @return bool|string
     */
    protected function render_marketingspots(marketingspots $marketingspots) {
        $context = $marketingspots->export_for_template($this);
        return $this->render_from_template('theme_elegance/widget_marketingspots', $context);
    }

    /**
     * Renderer for the quicklinks
     *
     * @param quicklinks $view
     * @return bool|string
     */
    protected function render_quicklinks(quicklinks $quicklinks) {
        $context = $quicklinks->export_for_template($this);
        return $this->render_from_template('theme_elegance/widget_quicklinks', $context);
    }

    /**
     * Renderer for the frontpage_content
     *
     * @param frontpage_content $view
     * @return bool|string
     */
    protected function render_frontpage_content(frontpage_content $frontpage_content) {
        $context = $frontpage_content->export_for_template($this);
        return $this->render_from_template('theme_elegance/widget_frontpage_content', $context);
    }
}
