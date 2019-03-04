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

/**
 * classic config.
 *
 * @package   theme_elegance
 * @copyright 2019 Bas Brands <bas@sonsbeekmedia.nl>
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

// This line protects the file from being accessed by a URL directly.
defined('MOODLE_INTERNAL') || die();

$THEME->name = 'elegance';
$THEME->sheets = [];
$THEME->editor_sheets = [];
$THEME->parents = ['boost'];
$THEME->layouts['frontpage'] = [
    'file' => 'frontpage.php',
    'regions' => ['side-pre'],
    'defaultregion' => 'side-pre',
    'options' => ['nonavbar'],
];
$THEME->layouts['login'] = [
    'file' => 'login.php',
    'options' => ['nonavbar'],
];
$THEME->enable_dock = false;
$THEME->extrascsscallback = 'theme_elegance_get_extra_scss';
$THEME->prescsscallback = 'theme_elegance_get_pre_scss';
$THEME->yuicssmodules = array();
$THEME->rendererfactory = 'theme_overridden_renderer_factory';
$THEME->scss = function($theme) {
    return theme_elegance_get_main_scss_content($theme);
};
