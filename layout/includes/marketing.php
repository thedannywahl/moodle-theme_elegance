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
 
 $hasmarketing1 = (!empty($PAGE->theme->settings->marketing1));
 if ($hasmarketing1) {
 	$marketing1title = $PAGE->theme->settings->marketing1;
 	$marketing1icon = $PAGE->theme->settings->marketing1icon;
 	$marketing1content = $PAGE->theme->settings->marketing1content;
 }
 
 $hasmarketing2 = (!empty($PAGE->theme->settings->marketing2));
 if ($hasmarketing2) {
 	$marketing2title = $PAGE->theme->settings->marketing2;
 	$marketing2icon = $PAGE->theme->settings->marketing2icon;
 	$marketing2content = $PAGE->theme->settings->marketing2content;
 }
 
 $hasmarketing3 = (!empty($PAGE->theme->settings->marketing3));
 if ($hasmarketing3) {
 	$marketing3title = $PAGE->theme->settings->marketing3;
 	$marketing3icon = $PAGE->theme->settings->marketing3icon;
 	$marketing3content = $PAGE->theme->settings->marketing3content;
 }
 
 $hasmarketing4 = (!empty($PAGE->theme->settings->marketing4));
 if ($hasmarketing4) {
 	$marketing4title = $PAGE->theme->settings->marketing4;
 	$marketing4icon = $PAGE->theme->settings->marketing4icon;
 	$marketing4content = $PAGE->theme->settings->marketing4content;
 }
 
 ?>

	<div id="page-marketing" class="row">
			<div id="sp-position1" class="col-md-5">	
				<?php echo $OUTPUT->blocks('side-middle'); ?>
			</div>

			<div id="sp-position2" class="col-md-7">

			</div>
		</div>