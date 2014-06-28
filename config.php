<?php
// This file is part of the custom Moodle elegance theme
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
 * Renderers to align Moodle's HTML with that expected by elegance
 *
 * @package    theme_elegance
 * @copyright  2014 Julian Ridden http://moodleman.net
 * @authors    Julian Ridden - Bootstrap 3 work by Bas Brands and David Scotson.
 *                           - Contributions by Gareth J Barnard.
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

$THEME->doctype = 'html5';

$THEME->yuicssmodules = array();

$THEME->name = 'elegance';

$THEME->parents = array('bootstrap');

$THEME->supportscssoptimisation = false;

$THEME->editor_sheets = array('editor');

$THEME->plugins_exclude_sheets = array(
    'block' => array(
        'html',
        'search_forums'
    ),
    'tool' => array(
        'customlang'
    ),
);
if ('ltr' === get_string('thisdirection', 'langconfig')) {
    $THEME->parents_exclude_sheets = array(
        'bootstrap'=>array( 
            'custom',
            'moodle-rtl',
            'forms-rtl',
            'yui2-rtl'
        )
    );
} else {
    $THEME->parents_exclude_sheets = array(
        'bootstrap'=>array( 
            'custom',
            'moodle'
        )
    );
}

$THEME->rendererfactory = 'theme_overridden_renderer_factory';

if ((!empty($THEME->settings->enablecategoryicon)) && ($THEME->settings->enablecategoryicon == '1')) {
	$categorysheet='categories';
} else {
	$categorysheet='';
}

if ((!empty($THEME->settings->enablecustomlogin)) && ($THEME->settings->enablecustomlogin == '1')) {
	$loginlayout='login.php';
  $loginsheet='login1';
} else {
  $loginlayout='default.php';
  $loginsheet='login2';
}

if ('ltr' === get_string('thisdirection', 'langconfig')) {
    $THEME->sheets = array('font-awesome', 'google-fonts', $categorysheet, $loginsheet, 'nprogress', 'elegance');
} else {
    $THEME->sheets = array('tinymce-rtl', 'font-awesome', 'google-fonts', $categorysheet, $loginsheet, 'nprogress', 'elegance');
}

$THEME->layouts = array(
    // Most backwards compatible layout without the blocks - this is the layout used by default.
    'base' => array(
        'file' => 'default.php',
        'regions' => array(),
    ),
    // Standard layout with blocks, this is recommended for most pages with general information.
    'standard' => array(
        'file' => 'default.php',
        'regions' => array('side-post'),
        'defaultregion' => 'side-post',
    ),
    // Main course page.
    'course' => array(
        'file' => 'default.php',
        'regions' => array('side-post'),
        'defaultregion' => 'side-post',
        'options' => array('langmenu'=>true),
    ),
    'coursecategory' => array(
        'file' => 'default.php',
        'regions' => array('side-post'),
        'defaultregion' => 'side-post',
    ),
    // part of course, typical for modules - default page layout if $cm specified in require_login().
    'incourse' => array(
        'file' => 'default.php',
        'regions' => array('side-post'),
        'defaultregion' => 'side-post',
    ),
    // The site home page.
    'frontpage' => array(
        'file' => 'frontpage.php',
        'regions' => array('side-post','side-middle','hidden-dock'),
        'defaultregion' => 'side-post',
        'options' => array('nonavbar'=>false),
    ),
    // Server administration scripts.
    'admin' => array(
        'file' => 'default.php',
        'regions' => array('side-post'),
        'defaultregion' => 'side-post',
    ),
    // My dashboard page.
    'mydashboard' => array(
        'file' => 'my.php',
        'regions' => array('side-post'),
        'defaultregion' => 'side-post',
        'options' => array('langmenu'=>true),
    ),
    // My public page.
    'mypublic' => array(
        'file' => 'default.php',
        'regions' => array('side-post'),
        'defaultregion' => 'side-post',
    ),
    'login' => array(
    	'file' => $loginlayout,
        'regions' => array(),
        'options' => array('langmenu'=>true, 'nonavbar'=>false),
    ),

    // Pages that appear in pop-up windows - no navigation, no blocks, no header.
    'popup' => array(
        'file' => 'default.php',
        'regions' => array(),
        'options' => array('nofooter'=>true, 'nonavbar'=>false),
    ),
    // No blocks and minimal footer - used for legacy frame layouts only!
    'frametop' => array(
        'file' => 'default.php',
        'regions' => array(),
        'options' => array('nofooter'=>true, 'nocoursefooter'=>true),
    ),
    // Embeded pages, like iframe/object embeded in moodleform - it needs as much space as possible.
    'embedded' => array(
        'file' => 'embedded.php',
        'regions' => array()
    ),
    // Used during upgrade and install, and for the 'This site is undergoing maintenance' message.
    // This must not have any blocks, links, or API calls that would lead to database or cache interaction.
    // Please be extremely careful if you are modifying this layout.
    'maintenance' => array(
        'file' => 'maintenance.php',
        'regions' => array(),
    ),
    // Should display the content and basic headers only.
    'print' => array(
        'file' => 'default.php',
        'regions' => array(),
        'options' => array('nofooter'=>true, 'nonavbar'=>false),
    ),
    // The pagelayout used when a redirection is occuring.
    'redirect' => array(
        'file' => 'embedded.php',
        'regions' => array(),
    ),
    // The pagelayout used for reports.
    'report' => array(
        'file' => 'default.php',
        'regions' => array('side-post'),
        'defaultregion' => 'side-post',
    ),
    // The pagelayout used for safebrowser and securewindow.
    'secure' => array(
        'file' => 'secure.php',
        'regions' => array('side-post'),
        'defaultregion' => 'side-post'
    ),
);

$THEME->csspostprocess = 'theme_elegance_process_css';

$THEME->javascripts = array(
);

$THEME->javascripts_footer = array(
    'fitvid', 'blocks','reader'
);

if (core_useragent::is_ie() && !core_useragent::check_ie_version('9.0')) {
    $THEME->javascripts[] = 'html5shiv';
    $THEME->javascripts[] = 'respond.min';
}

$THEME->hidefromselector = false;
