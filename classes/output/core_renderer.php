<?php
// This file is part of the elegance theme for Moodle
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

namespace theme_elegance\output;

use \theme_boost\output\core_renderer as boost_core_renderer;
use stdClass;
use theme_config;

defined('MOODLE_INTERNAL') || die;

/**
 * Renderers to align Moodle's HTML with that expected by Bootstrap
 *
 * @package    theme_elegance
 * @copyright  2019 Bas Brands
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

class core_renderer extends boost_core_renderer {


    /**
     * Fetch the social links from the theme settings.
     *
     * @return Object Object with array of footerlinks.
     */
    public function social_links() {
        $theme = theme_config::load('elegance');
        $settings = $theme->settings;

        $template = new stdClass();
        $template->links = [];

        $socialoptions = [
            'facebook' => 'facebook',
            'twitter' => 'twitter',
            'linkedin' => 'linkedin',
            'youtube' => 'youtube',
            'flickr' => 'flickr',
            'vk' => 'vk',
            'pinterest' => 'pinterest',
            'instagram' => 'instagram',
            'skype' => 'skype',
            'website' => 'home',
            'blog' => 'blog',
            'vimeo' => 'vimeo',
            'tumblr' => 'tumblr'
        ];

        foreach ($socialoptions as $so => $icon) {
            if (!empty($settings->$so)) {
                $social = new stdClass();
                $social->url = $settings->$so;
                $social->name = $so;
                $social->icon = $icon;
                $social->stringname = get_string($so, 'theme_elegance');
                $template->links[] = $social;
                $template->hasicons = true;
            }
        }
        return $this->render_from_template('theme_elegance/widget_social', $template);
    }

    /**
     * Fetch the custom footer text from the theme settings.
     *
     * @return Object Object with footer text.
     */
    public function footertext() {
        $theme = theme_config::load('elegance');
        $settings = $theme->settings;
        $template = new stdClass();
        $template->footnote = $settings->footnote;
        return $template;
    }
}
