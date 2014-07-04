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
 * @authors    Julian Ridden -  Bootstrap 3 work by Bas Brands, David Scotson
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

$settings = null;

defined('MOODLE_INTERNAL') || die;

	global $PAGE;

	$ADMIN->add('themes', new admin_category('theme_elegance', 'Elegance'));

	// "geneicsettings" settingpage
	$temp = new admin_settingpage('theme_elegance_generic',  get_string('geneicsettings', 'theme_elegance'));

    // Invert Navbar to dark background.
    $name = 'theme_elegance/invert';
    $title = get_string('invert', 'theme_elegance');
    $description = get_string('invertdesc', 'theme_elegance');
    $setting = new admin_setting_configcheckbox($name, $title, $description, 0);
    $setting->set_updatedcallback('theme_reset_all_caches');
    $temp->add($setting);

    // Turn on fluid width
    $name = 'theme_elegance/fluidwidth';
    $title = get_string('fluidwidth', 'theme_elegance');
    $description = get_string('fluidwidthdesc', 'theme_elegance');
    $default = '0';
    $setting = new admin_setting_configcheckbox($name, $title, $description, $default);
    $temp->add($setting);

    // Font Icons
    $name = 'theme_elegance/fonticons';
    $title = get_string('fonticons', 'theme_elegance');
    $description = get_string('fonticonsdesc', 'theme_elegance');
    $default = '0';
    $setting = new admin_setting_configcheckbox($name, $title, $description, $default);
    $temp->add($setting);

    // Frontpage Content.
    $name = 'theme_elegance/frontpagecontent';
    $title = get_string('frontpagecontent', 'theme_elegance');
    $description = get_string('frontpagecontentdesc', 'theme_elegance');
    $default = '';
    $setting = new admin_setting_confightmleditor($name, $title, $description, $default);
    $setting->set_updatedcallback('theme_reset_all_caches');
    $temp->add($setting);

     // Copyright setting.
    $name = 'theme_elegance/copyright';
    $title = get_string('copyright', 'theme_elegance');
    $description = get_string('copyrightdesc', 'theme_elegance');
    $default = '';
    $setting = new admin_setting_configtext($name, $title, $description, $default);
    $temp->add($setting);

    // Footnote setting.
    $name = 'theme_elegance/footnote';
    $title = get_string('footnote', 'theme_elegance');
    $description = get_string('footnotedesc', 'theme_elegance');
    $default = '';
    $setting = new admin_setting_confightmleditor($name, $title, $description, $default);
    $setting->set_updatedcallback('theme_reset_all_caches');
    $temp->add($setting);

    // Embedded Video Max Width.
    $name = 'theme_elegance/videowidth';
    $title = get_string('videowidth', 'theme_elegance');
    $description = get_string('videowidthdesc', 'theme_elegance');
    $default = '100%';
    $setting = new admin_setting_configtext($name, $title, $description, $default);
    $temp->add($setting);

    // Show old messages.
    $name = 'theme_elegance/showoldmessages';
    $title = get_string('showoldmessages', 'theme_elegance');
    $description = get_string('showoldmessagesdesc', 'theme_elegance');
    $default = '0';
    $setting = new admin_setting_configcheckbox($name, $title, $description, $default);
    $temp->add($setting);

    // Custom CSS file.
    $name = 'theme_elegance/customcss';
    $title = get_string('customcss', 'theme_elegance');
    $description = get_string('customcssdesc', 'theme_elegance');
    $default = '';
    $setting = new admin_setting_configtextarea($name, $title, $description, $default);
    $setting->set_updatedcallback('theme_reset_all_caches');
    $temp->add($setting);

    $ADMIN->add('theme_elegance', $temp);

    /* Color and Logo Settings */
    $temp = new admin_settingpage('theme_elegance_colors', get_string('colorsettings', 'theme_elegance'));
    $temp->add(new admin_setting_heading('theme_elegance_colors', get_string('colorsettingssub', 'theme_elegance'),
    		format_text(get_string('colorsettingsdesc' , 'theme_elegance'), FORMAT_MARKDOWN)));

    	// Main theme colour setting.
    	$name = 'theme_elegance/themecolor';
    	$title = get_string('themecolor', 'theme_elegance');
    	$description = get_string('themecolordesc', 'theme_elegance');
    	$default = '#0098e0';
    	$previewconfig = null;
    	$setting = new admin_setting_configcolourpicker($name, $title, $description, $default, $previewconfig);
    	$setting->set_updatedcallback('theme_reset_all_caches');
    	$temp->add($setting);

    	// Main Font colour setting.
    	$name = 'theme_elegance/fontcolor';
    	$title = get_string('fontcolor', 'theme_elegance');
    	$description = get_string('fontcolordesc', 'theme_elegance');
    	$default = '#666';
    	$previewconfig = null;
    	$setting = new admin_setting_configcolourpicker($name, $title, $description, $default, $previewconfig);
    	$setting->set_updatedcallback('theme_reset_all_caches');
    	$temp->add($setting);

    	// Heading colour setting.
    	$name = 'theme_elegance/headingcolor';
    	$title = get_string('headingcolor', 'theme_elegance');
    	$description = get_string('headingcolordesc', 'theme_elegance');
    	$default = '#27282a';
    	$previewconfig = null;
    	$setting = new admin_setting_configcolourpicker($name, $title, $description, $default, $previewconfig);
    	$setting->set_updatedcallback('theme_reset_all_caches');
    	$temp->add($setting);

    	// Logo Image.
    	$name = 'theme_elegance/logo';
    	$title = get_string('logo', 'theme_elegance');
    	$description = get_string('logodesc', 'theme_elegance');
    	$setting = new admin_setting_configstoredfile($name, $title, $description, 'logo');
    	$setting->set_updatedcallback('theme_reset_all_caches');
    	$temp->add($setting);

    	// Header Background Image.
    	$name = 'theme_elegance/headerbg';
    	$title = get_string('headerbg', 'theme_elegance');
    	$description = get_string('headerbgdesc', 'theme_elegance');
    	$setting = new admin_setting_configstoredfile($name, $title, $description, 'headerbg');
    	$setting->set_updatedcallback('theme_reset_all_caches');
    	$temp->add($setting);

    	// Body Background Image.
    	$name = 'theme_elegance/bodybg';
    	$title = get_string('bodybg', 'theme_elegance');
    	$description = get_string('bodybgdesc', 'theme_elegance');
    	$setting = new admin_setting_configstoredfile($name, $title, $description, 'bodybg');
    	$setting->set_updatedcallback('theme_reset_all_caches');
    	$temp->add($setting);

    	// Main theme colour setting.
    	$name = 'theme_elegance/bodycolor';
    	$title = get_string('bodycolor', 'theme_elegance');
    	$description = get_string('bodycolordesc', 'theme_elegance');
    	$default = '#f1f1f4';
    	$previewconfig = null;
    	$setting = new admin_setting_configcolourpicker($name, $title, $description, $default, $previewconfig);
    	$setting->set_updatedcallback('theme_reset_all_caches');
    	$temp->add($setting);

    	// Set Transparency.
    	$name = 'theme_elegance/transparency';
    	$title = get_string('transparency' , 'theme_elegance');
    	$description = get_string('transparencydesc', 'theme_elegance');
    	$default = '1';
    	$choices = array(
    		'.10'=>'10%',
    		'.15'=>'15%',
    		'.20'=>'20%',
    		'.25'=>'25%',
    		'.30'=>'30%',
    		'.35'=>'35%',
    		'.40'=>'40%',
    		'.45'=>'45%',
    		'.50'=>'50%',
    		'.55'=>'55%',
    		'.60'=>'60%',
    		'.65'=>'65%',
    		'.70'=>'70%',
    		'.75'=>'75%',
    		'.80'=>'80%',
    		'.85'=>'85%',
    		'.90'=>'90%',
    		'.95'=>'95%',
   		'1'=>'100%');
    	$setting = new admin_setting_configselect($name, $title, $description, $default, $choices);
   	$setting->set_updatedcallback('theme_reset_all_caches');
    	$temp->add($setting);

    $ADMIN->add('theme_elegance', $temp);

    /* Banner Settings */
    $temp = new admin_settingpage('theme_elegance_usermenu', get_string('usermenusettings', 'theme_elegance'));
    $temp->add(new admin_setting_heading('theme_elegance_usermenu', get_string('usermenusettingssub', 'theme_elegance'),
    		format_text(get_string('usermenusettingsdesc' , 'theme_elegance'), FORMAT_MARKDOWN)));

    	// Enable My.
    	$name = 'theme_elegance/enablemy';
    	$title = get_string('enablemy', 'theme_elegance');
    	$description = get_string('enablemydesc', 'theme_elegance');
    	$default = true;
    	$setting = new admin_setting_configcheckbox($name, $title, $description, $default, true, false);
    	$setting->set_updatedcallback('theme_reset_all_caches');
    	$temp->add($setting);

    	// Enable View Profile.
    	$name = 'theme_elegance/enableprofile';
    	$title = get_string('enableprofile', 'theme_elegance');
    	$description = get_string('enableprofiledesc', 'theme_elegance');
    	$default = true;
    	$setting = new admin_setting_configcheckbox($name, $title, $description, $default, true, false);
    	$setting->set_updatedcallback('theme_reset_all_caches');
    	$temp->add($setting);

    	// Enable Edit Profile.
    	$name = 'theme_elegance/enableeditprofile';
    	$title = get_string('enableeditprofile', 'theme_elegance');
    	$description = get_string('enableeditprofiledesc', 'theme_elegance');
    	$default = true;
    	$setting = new admin_setting_configcheckbox($name, $title, $description, $default, true, false);
    	$setting->set_updatedcallback('theme_reset_all_caches');
    	$temp->add($setting);

    	// Enable Calendar.
    	$name = 'theme_elegance/enablecalendar';
    	$title = get_string('enablecalendar', 'theme_elegance');
    	$description = get_string('enablecalendardesc', 'theme_elegance');
    	$default = true;
    	$setting = new admin_setting_configcheckbox($name, $title, $description, $default, true, false);
    	$setting->set_updatedcallback('theme_reset_all_caches');
    	$temp->add($setting);

    	// Enable Private Files.
    	$name = 'theme_elegance/enableprivatefiles';
    	$title = get_string('enableprivatefiles', 'theme_elegance');
    	$description = get_string('enableprivatefilesdesc', 'theme_elegance');
    	$default = false;
    	$setting = new admin_setting_configcheckbox($name, $title, $description, $default, true, false);
    	$setting->set_updatedcallback('theme_reset_all_caches');
    	$temp->add($setting);

    	// Enable Badges.
    	$name = 'theme_elegance/enablebadges';
    	$title = get_string('enablebadges', 'theme_elegance');
    	$description = get_string('enablebadgesdesc', 'theme_elegance');
    	$default = false;
    	$setting = new admin_setting_configcheckbox($name, $title, $description, $default, true, false);
    	$setting->set_updatedcallback('theme_reset_all_caches');
    	$temp->add($setting);

    	// Additional number of links.
    		$name = 'theme_elegance/usermenulinks';
    		$title = get_string('usermenulinks' , 'theme_elegance');
    		$description = get_string('usermenulinksdesc', 'theme_elegance');
    		$default = '0';
    		$choices = array(
    			'0'=>'0',
    			'1'=>'1',
    			'2'=>'2',
    			'3'=>'3',
    			'4'=>'4',
    			'5'=>'5',
    			'6'=>'6',
    			'7'=>'7',
    			'8'=>'8',
    			'9'=>'9',
    			'10'=>'10');
    		$setting = new admin_setting_configselect($name, $title, $description, $default, $choices);
    		$setting->set_updatedcallback('theme_reset_all_caches');
    		$temp->add($setting);

    		$hascustomlinknum = (!empty($PAGE->theme->settings->usermenulinks));
    			if ($hascustomlinknum) {
    				$usermenulinks = $PAGE->theme->settings->usermenulinks;
    			} else {
    				$usermenulinks = '0';
    			}
    if ($hascustomlinknum !=0) {
		foreach (range(1, $usermenulinks) as $customlinknumber) {

		// This is the descriptor for the Custom Link.
		$name = 'theme_elegance/customlink';
		$title = get_string('customlinkindicator', 'theme_elegance');
		$information = get_string('customlinkindicatordesc', 'theme_elegance');
		$setting = new admin_setting_heading($name.$customlinknumber, $title.$customlinknumber, $information);
		$setting->set_updatedcallback('theme_reset_all_caches');
		$temp->add($setting);

		// Icon for Custom Link
		$name = 'theme_elegance/customlinkicon' . $customlinknumber;
		$title = get_string('customlinkicon', 'theme_elegance', $customlinknumber);
		$description = get_string('customlinkicondesc', 'theme_elegance', $customlinknumber);
		$default = 'dot-circle-o';
		$setting = new admin_setting_configtext($name, $title, $description, $default);
		$setting->set_updatedcallback('theme_reset_all_caches');
		$temp->add($setting);

		// Text for Custom Link
		$name = 'theme_elegance/customlinkname' . $customlinknumber;
		$title = get_string('customlinkname', 'theme_elegance', $customlinknumber);
		$description = get_string('customlinknamedesc', 'theme_elegance', $customlinknumber);
		$default = '';
		$setting = new admin_setting_configtext($name, $title, $description, $default);
		$setting->set_updatedcallback('theme_reset_all_caches');
		$temp->add($setting);

		// Destination URL for Custom Link
		$name = 'theme_elegance/customlinkurl' . $customlinknumber;
		$title = get_string('customlinkurl', 'theme_elegance', $customlinknumber);
		$description = get_string('customlinkurldesc', 'theme_elegance', $customlinknumber);
		$default = '';
		$previewconfig = null;
		$setting = new admin_setting_configtext($name, $title, $description, $default);
		$setting->set_updatedcallback('theme_reset_all_caches');
		$temp->add($setting);
		}
	}

    	$ADMIN->add('theme_elegance', $temp);

    /* Banner Settings */
    $temp = new admin_settingpage('theme_elegance_banner', get_string('bannersettings', 'theme_elegance'));
    $temp->add(new admin_setting_heading('theme_elegance_banner', get_string('bannersettingssub', 'theme_elegance'),
            format_text(get_string('bannersettingsdesc' , 'theme_elegance'), FORMAT_MARKDOWN)));

    // Set Number of Slides.
    $name = 'theme_elegance/slidenumber';
    $title = get_string('slidenumber' , 'theme_elegance');
    $description = get_string('slidenumberdesc', 'theme_elegance');
    $default = '1';
    $choices = array(
		'0'=>'0',
    	'1'=>'1',
    	'2'=>'2',
    	'3'=>'3',
    	'4'=>'4',
    	'5'=>'5',
    	'6'=>'6',
    	'7'=>'7',
    	'8'=>'8',
    	'9'=>'9',
    	'10'=>'10');
    $setting = new admin_setting_configselect($name, $title, $description, $default, $choices);
    $setting->set_updatedcallback('theme_reset_all_caches');
    $temp->add($setting);

    // Set the Slide Speed.
    $name = 'theme_elegance/slidespeed';
    $title = get_string('slidespeed' , 'theme_elegance');
    $description = get_string('slidespeeddesc', 'theme_elegance');
    $default = '600';
    $setting = new admin_setting_configtext($name, $title, $description, $default );
    $setting->set_updatedcallback('theme_reset_all_caches');
    $temp->add($setting);

    $hasslidenum = (!empty($PAGE->theme->settings->slidenumber));
    if ($hasslidenum) {
    		$slidenum = $PAGE->theme->settings->slidenumber;
	} else {
		$slidenum = '1';
	}

	$bannertitle = array('Slide One', 'Slide Two', 'Slide Three','Slide Four','Slide Five','Slide Six','Slide Seven', 'Slide Eight', 'Slide Nine', 'Slide Ten');

    foreach (range(1, $slidenum) as $bannernumber) {

    	// This is the descriptor for the Banner Settings.
    	$name = 'theme_elegance/banner';
        $title = get_string('bannerindicator', 'theme_elegance');
    	$information = get_string('bannerindicatordesc', 'theme_elegance');
    	$setting = new admin_setting_heading($name.$bannernumber, $title.$bannernumber, $information);
    	$setting->set_updatedcallback('theme_reset_all_caches');
    	$temp->add($setting);

        // Enables the slide.
        $name = 'theme_elegance/enablebanner' . $bannernumber;
        $title = get_string('enablebanner', 'theme_elegance', $bannernumber);
        $description = get_string('enablebannerdesc', 'theme_elegance', $bannernumber);
        $default = false;
        $setting = new admin_setting_configcheckbox($name, $title, $description, $default, true, false);
        $setting->set_updatedcallback('theme_reset_all_caches');
        $temp->add($setting);

        // Slide Title.
        $name = 'theme_elegance/bannertitle' . $bannernumber;
        $title = get_string('bannertitle', 'theme_elegance', $bannernumber);
        $description = get_string('bannertitledesc', 'theme_elegance', $bannernumber);
        $default = $bannertitle[$bannernumber - 1];
        $setting = new admin_setting_configtext($name, $title, $description, $default );
        $setting->set_updatedcallback('theme_reset_all_caches');
        $temp->add($setting);

        // Slide text.
        $name = 'theme_elegance/bannertext' . $bannernumber;
        $title = get_string('bannertext', 'theme_elegance', $bannernumber);
        $description = get_string('bannertextdesc', 'theme_elegance', $bannernumber);
        $default = 'Bacon ipsum dolor sit amet turducken jerky beef ribeye boudin t-bone shank fatback pork loin pork short loin jowl flank meatloaf venison. Salami meatball sausage short loin beef ribs';
        $setting = new admin_setting_configtextarea($name, $title, $description, $default);
        $setting->set_updatedcallback('theme_reset_all_caches');
        $temp->add($setting);

        // Text for Slide Link.
        $name = 'theme_elegance/bannerlinktext' . $bannernumber;
        $title = get_string('bannerlinktext', 'theme_elegance', $bannernumber);
        $description = get_string('bannerlinktextdesc', 'theme_elegance', $bannernumber);
        $default = 'Read More';
        $setting = new admin_setting_configtext($name, $title, $description, $default);
        $setting->set_updatedcallback('theme_reset_all_caches');
        $temp->add($setting);

        // Destination URL for Slide Link
        $name = 'theme_elegance/bannerlinkurl' . $bannernumber;
        $title = get_string('bannerlinkurl', 'theme_elegance', $bannernumber);
        $description = get_string('bannerlinkurldesc', 'theme_elegance', $bannernumber);
        $default = '#';
        $previewconfig = null;
        $setting = new admin_setting_configtext($name, $title, $description, $default);
        $setting->set_updatedcallback('theme_reset_all_caches');
        $temp->add($setting);

        // Slide Image.
    	$name = 'theme_elegance/bannerimage' . $bannernumber;
    	$title = get_string('bannerimage', 'theme_elegance', $bannernumber);
    	$description = get_string('bannerimagedesc', 'theme_elegance', $bannernumber);
    	$setting = new admin_setting_configstoredfile($name, $title, $description, 'bannerimage'.$bannernumber);
    	$setting->set_updatedcallback('theme_reset_all_caches');
    	$temp->add($setting);

    	// Slide Background Color.
    	$name = 'theme_elegance/bannercolor' . $bannernumber;
    	$title = get_string('bannercolor', 'theme_elegance', $bannernumber);
    	$description = get_string('bannercolordesc', 'theme_elegance', $bannernumber);
    	$default = '#000';
    	$previewconfig = null;
    	$setting = new admin_setting_configcolourpicker($name, $title, $description, $default, $previewconfig);
    	$setting->set_updatedcallback('theme_reset_all_caches');
    	$temp->add($setting);

    }

 	$ADMIN->add('theme_elegance', $temp);

 	/* Marketing Spot Settings */
 		$temp = new admin_settingpage('theme_elegance_marketing', get_string('marketingheading', 'theme_elegance'));
 		$temp->add(new admin_setting_heading('theme_elegance_marketing', get_string('marketingheadingsub', 'theme_elegance'),
 				format_text(get_string('marketingdesc' , 'theme_elegance'), FORMAT_MARKDOWN)));

 		// Toggle Marketing Spots.
 		$name = 'theme_elegance/togglemarketing';
 		$title = get_string('togglemarketing' , 'theme_elegance');
 		$description = get_string('togglemarketingdesc', 'theme_elegance');
 		$alwaysdisplay = get_string('alwaysdisplay', 'theme_elegance');
 		$displaybeforelogin = get_string('displaybeforelogin', 'theme_elegance');
 		$displayafterlogin = get_string('displayafterlogin', 'theme_elegance');
 		$dontdisplay = get_string('dontdisplay', 'theme_elegance');
 		$default = 'display';
 		$choices = array('1'=>$alwaysdisplay, '2'=>$displaybeforelogin, '3'=>$displayafterlogin, '0'=>$dontdisplay);
 		$setting = new admin_setting_configselect($name, $title, $description, $default, $choices);
 		$setting->set_updatedcallback('theme_reset_all_caches');
 		$temp->add($setting);

 		$name = 'theme_elegance/marketingtitle';
 		$title = get_string('marketingtitle', 'theme_elegance');
 		$description = get_string('marketingtitledesc', 'theme_elegance');
 		$default = 'More about Us';
 		$setting = new admin_setting_configtext($name, $title, $description, $default);
 		$setting->set_updatedcallback('theme_reset_all_caches');
 		$temp->add($setting);

 		$name = 'theme_elegance/marketingtitleicon';
 		$title = get_string('marketingtitleicon', 'theme_elegance');
 		$description = get_string('marketingtitleicondesc', 'theme_elegance');
 		$default = 'globe';
 		$setting = new admin_setting_configtext($name, $title, $description, $default);
 		$setting->set_updatedcallback('theme_reset_all_caches');
 		$temp->add($setting);

 		//This is the descriptor for Marketing Spot One
 		$name = 'theme_elegance/marketing1info';
 		$heading = get_string('marketing1', 'theme_elegance');
 		$information = get_string('marketinginfodesc', 'theme_elegance');
 		$setting = new admin_setting_heading($name, $heading, $information);
 		$temp->add($setting);

 		//Marketing Spot One.
 		$name = 'theme_elegance/marketing1';
 		$title = get_string('marketingtitle', 'theme_elegance');
 		$description = get_string('marketingtitledesc', 'theme_elegance');
 		$default = '';
 		$setting = new admin_setting_configtext($name, $title, $description, $default);
 		$setting->set_updatedcallback('theme_reset_all_caches');
 		$temp->add($setting);

 		$name = 'theme_elegance/marketing1icon';
 		$title = get_string('marketingicon', 'theme_elegance');
 		$description = get_string('marketingicondesc', 'theme_elegance');
 		$default = 'star';
 		$setting = new admin_setting_configtext($name, $title, $description, $default);
 		$setting->set_updatedcallback('theme_reset_all_caches');
 		$temp->add($setting);

 		$name = 'theme_elegance/marketing1content';
 		$title = get_string('marketingcontent', 'theme_elegance');
 		$description = get_string('marketingcontentdesc', 'theme_elegance');
 		$default = '';
 		$setting = new admin_setting_confightmleditor($name, $title, $description, $default);
 		$setting->set_updatedcallback('theme_reset_all_caches');
 		$temp->add($setting);

 		//This is the descriptor for Marketing Spot Two
 		$name = 'theme_elegance/marketing2info';
 		$heading = get_string('marketing2', 'theme_elegance');
 		$information = get_string('marketinginfodesc', 'theme_elegance');
 		$setting = new admin_setting_heading($name, $heading, $information);
 		$temp->add($setting);

 		//Marketing Spot Two.
 		$name = 'theme_elegance/marketing2';
 		$title = get_string('marketingtitle', 'theme_elegance');
 		$description = get_string('marketingtitledesc', 'theme_elegance');
 		$default = '';
 		$setting = new admin_setting_configtext($name, $title, $description, $default);
 		$setting->set_updatedcallback('theme_reset_all_caches');
 		$temp->add($setting);

 		$name = 'theme_elegance/marketing2icon';
 		$title = get_string('marketingicon', 'theme_elegance');
 		$description = get_string('marketingicondesc', 'theme_elegance');
 		$default = 'star';
 		$setting = new admin_setting_configtext($name, $title, $description, $default);
 		$setting->set_updatedcallback('theme_reset_all_caches');
 		$temp->add($setting);

 		$name = 'theme_elegance/marketing2content';
 		$title = get_string('marketingcontent', 'theme_elegance');
 		$description = get_string('marketingcontentdesc', 'theme_elegance');
 		$default = '';
 		$setting = new admin_setting_confightmleditor($name, $title, $description, $default);
 		$setting->set_updatedcallback('theme_reset_all_caches');
 		$temp->add($setting);

 		//This is the descriptor for Marketing Spot Three
 		$name = 'theme_elegance/marketing3info';
 		$heading = get_string('marketing3', 'theme_elegance');
 		$information = get_string('marketinginfodesc', 'theme_elegance');
 		$setting = new admin_setting_heading($name, $heading, $information);
 		$temp->add($setting);

 		//Marketing Spot Three.
 		$name = 'theme_elegance/marketing3';
 		$title = get_string('marketingtitle', 'theme_elegance');
 		$description = get_string('marketingtitledesc', 'theme_elegance');
 		$default = '';
 		$setting = new admin_setting_configtext($name, $title, $description, $default);
 		$setting->set_updatedcallback('theme_reset_all_caches');
 		$temp->add($setting);

 		$name = 'theme_elegance/marketing3icon';
 		$title = get_string('marketingicon', 'theme_elegance');
 		$description = get_string('marketingicondesc', 'theme_elegance');
 		$default = 'star';
 		$setting = new admin_setting_configtext($name, $title, $description, $default);
 		$setting->set_updatedcallback('theme_reset_all_caches');
 		$temp->add($setting);

 		$name = 'theme_elegance/marketing3content';
 		$title = get_string('marketingcontent', 'theme_elegance');
 		$description = get_string('marketingcontentdesc', 'theme_elegance');
 		$default = '';
 		$setting = new admin_setting_confightmleditor($name, $title, $description, $default);
 		$setting->set_updatedcallback('theme_reset_all_caches');
 		$temp->add($setting);

 		//This is the descriptor for Marketing Spot Four
 		$name = 'theme_elegance/marketing4info';
 		$heading = get_string('marketing4', 'theme_elegance');
 		$information = get_string('marketinginfodesc', 'theme_elegance');
 		$setting = new admin_setting_heading($name, $heading, $information);
 		$temp->add($setting);

 		//Marketing Spot Four.
 		$name = 'theme_elegance/marketing4';
 		$title = get_string('marketingtitle', 'theme_elegance');
 		$description = get_string('marketingtitledesc', 'theme_elegance');
 		$default = '';
 		$setting = new admin_setting_configtext($name, $title, $description, $default);
 		$setting->set_updatedcallback('theme_reset_all_caches');
 		$temp->add($setting);

 		$name = 'theme_elegance/marketing4icon';
 		$title = get_string('marketingicon', 'theme_elegance');
 		$description = get_string('marketingicondesc', 'theme_elegance');
 		$default = 'star';
 		$setting = new admin_setting_configtext($name, $title, $description, $default);
 		$setting->set_updatedcallback('theme_reset_all_caches');
 		$temp->add($setting);

 		$name = 'theme_elegance/marketing4content';
 		$title = get_string('marketingcontent', 'theme_elegance');
 		$description = get_string('marketingcontentdesc', 'theme_elegance');
 		$default = '';
 		$setting = new admin_setting_confightmleditor($name, $title, $description, $default);
 		$setting->set_updatedcallback('theme_reset_all_caches');
 		$temp->add($setting);

 	$ADMIN->add('theme_elegance', $temp);

 	/* Quick Link Settings */
 		$temp = new admin_settingpage('theme_elegance_quicklinks', get_string('quicklinksheading', 'theme_elegance'));
 		$temp->add(new admin_setting_heading('theme_elegance_quicklinks', get_string('quicklinksheadingsub', 'theme_elegance'),
 				format_text(get_string('quicklinksdesc' , 'theme_elegance'), FORMAT_MARKDOWN)));

 		// Toggle Quick Links.
 		$name = 'theme_elegance/togglequicklinks';
 		$title = get_string('togglequicklinks' , 'theme_elegance');
 		$description = get_string('togglequicklinksdesc', 'theme_elegance');
 		$alwaysdisplay = get_string('alwaysdisplay', 'theme_elegance');
 		$displaybeforelogin = get_string('displaybeforelogin', 'theme_elegance');
 		$displayafterlogin = get_string('displayafterlogin', 'theme_elegance');
 		$dontdisplay = get_string('dontdisplay', 'theme_elegance');
 		$default = 'display';
 		$choices = array('1'=>$alwaysdisplay, '2'=>$displaybeforelogin, '3'=>$displayafterlogin, '0'=>$dontdisplay);
 		$setting = new admin_setting_configselect($name, $title, $description, $default, $choices);
 		$setting->set_updatedcallback('theme_reset_all_caches');
 		$temp->add($setting);

 		// Set Number of Quick Links.
 		$name = 'theme_elegance/quicklinksnumber';
 		$title = get_string('quicklinksnumber' , 'theme_elegance');
 		$description = get_string('quicklinksnumberdesc', 'theme_elegance');
 		$default = '4';
 		$choices = array(
 			'1'=>'1',
 			'2'=>'2',
 			'3'=>'3',
 			'4'=>'4',
 			'5'=>'5',
 			'6'=>'6',
 			'7'=>'7',
 			'8'=>'8',
 			'9'=>'9',
 			'10'=>'10',
 			'11'=>'11',
 			'12'=>'12');
 		$setting = new admin_setting_configselect($name, $title, $description, $default, $choices);
 		$setting->set_updatedcallback('theme_reset_all_caches');
 		$temp->add($setting);

 		$hasquicklinksnum = (!empty($PAGE->theme->settings->quicklinksnumber));
 			if ($hasquicklinksnum) {
 				$quicklinksnum = $PAGE->theme->settings->quicklinksnumber;
 			} else {
 				$quicklinksnum = '4';
 			}
 		//This is the title for the Quick Links area
 		$name = 'theme_elegance/quicklinkstitle';
 		$title = get_string('quicklinkstitle', 'theme_elegance');
 		$description = get_string('quicklinkstitledesc', 'theme_elegance');
 		$default = 'Site Quick Links';
 		$setting = new admin_setting_configtext($name, $title, $description, $default);
 		$setting->set_updatedcallback('theme_reset_all_caches');
 		$temp->add($setting);

 		//This is the icon for the Quick Links area
 		$name = 'theme_elegance/quicklinksicon';
 		$title = get_string('quicklinksicon', 'theme_elegance');
 		$description = get_string('quicklinksicondesc', 'theme_elegance');
 		$default = 'link';
 		$setting = new admin_setting_configtext($name, $title, $description, $default);
 		$setting->set_updatedcallback('theme_reset_all_caches');
 		$temp->add($setting);

 		foreach (range(1, $quicklinksnum) as $quicklinksnumber) {

 			//This is the descriptor for Quick Link One
 			$name = 'theme_elegance/quicklinkinfo';
 			$title = get_string('quicklinks', 'theme_elegance');
 			$information = get_string('quicklinksdesc', 'theme_elegance');
 			$setting = new admin_setting_heading($name.$quicklinksnumber, $title.$quicklinksnumber, $information);
 			$setting->set_updatedcallback('theme_reset_all_caches');
 			$temp->add($setting);

 			//Quick Link Icon.
 			$name = 'theme_elegance/quicklinkicon' . $quicklinksnumber;
 			$title = get_string('quicklinkicon', 'theme_elegance', $quicklinksnumber);
 			$description = get_string('quicklinkicondesc', 'theme_elegance', $quicklinksnumber);
 			$default = 'star';
 			$setting = new admin_setting_configtext($name, $title, $description, $default);
 			$setting->set_updatedcallback('theme_reset_all_caches');
 			$temp->add($setting);

 			// Quick Link Icon Color.
 			$name = 'theme_elegance/quicklinkiconcolor' . $quicklinksnumber;
 			$title = get_string('quicklinkiconcolor', 'theme_elegance', $quicklinksnumber);
 			$description = get_string('quicklinkiconcolordesc', 'theme_elegance', $quicklinksnumber);
 			$default = '';
 			$previewconfig = null;
 			$setting = new admin_setting_configcolourpicker($name, $title, $description, $default, $previewconfig);
 			$setting->set_updatedcallback('theme_reset_all_caches');
 			$temp->add($setting);

 			// Quick Link Button Text.
 			$name = 'theme_elegance/quicklinkbuttontext' . $quicklinksnumber;
 			$title = get_string('quicklinkbuttontext', 'theme_elegance', $quicklinksnumber);
 			$description = get_string('quicklinkbuttontextdesc', 'theme_elegance', $quicklinksnumber);
 			$default = 'Click Here';
 			$setting = new admin_setting_configtext($name, $title, $description, $default);
 			$setting->set_updatedcallback('theme_reset_all_caches');
 			$temp->add($setting);

 			// Quick Link Button Color.
 			$name = 'theme_elegance/quicklinkbuttoncolor' . $quicklinksnumber;
 			$title = get_string('quicklinkbuttoncolor', 'theme_elegance', $quicklinksnumber);
 			$description = get_string('quicklinkbuttoncolordesc', 'theme_elegance', $quicklinksnumber);
 			$default = '';
 			$previewconfig = null;
 			$setting = new admin_setting_configcolourpicker($name, $title, $description, $default, $previewconfig);
 			$setting->set_updatedcallback('theme_reset_all_caches');
 			$temp->add($setting);

 			// Quick Link Button URL.
 			$name = 'theme_elegance/quicklinkbuttonurl' . $quicklinksnumber;
 			$title = get_string('quicklinkbuttonurl', 'theme_elegance', $quicklinksnumber);
 			$description = get_string('quicklinkbuttonurldesc', 'theme_elegance', $quicklinksnumber);
 			$default = '';
 			$setting = new admin_setting_configtext($name, $title, $description, '', PARAM_URL);
 			$setting->set_updatedcallback('theme_reset_all_caches');
 			$temp->add($setting);
 		}


 	$ADMIN->add('theme_elegance', $temp);

 	/* Login Page Settings */
    $temp = new admin_settingpage('theme_elegance_loginsettings', get_string('loginsettings', 'theme_elegance'));
    $temp->add(new admin_setting_heading('theme_elegance_loginsettings', get_string('loginsettingssub', 'theme_elegance'),
            format_text(get_string('loginsettingsdesc' , 'theme_elegance'), FORMAT_MARKDOWN)));

    // Enable Custom Login Page.
    $name = 'theme_elegance/enablecustomlogin';
    $title = get_string('enablecustomlogin', 'theme_elegance');
    $description = get_string('enablecustomlogindesc', 'theme_elegance');
    $setting = new admin_setting_configcheckbox($name, $title, $description, 1);
    $setting->set_updatedcallback('theme_reset_all_caches');
    $temp->add($setting);

    // Set Number of Slides.
    $name = 'theme_elegance/loginbgumber';
    $title = get_string('loginbgumber' , 'theme_elegance');
    $description = get_string('loginbgumberdesc', 'theme_elegance');
    $default = '1';
    $choices = array(
    	'1'=>'1',
    	'2'=>'2',
    	'3'=>'3',
    	'4'=>'4',
    	'5'=>'5');
    $setting = new admin_setting_configselect($name, $title, $description, $default, $choices);
    $setting->set_updatedcallback('theme_reset_all_caches');
    $temp->add($setting);

    $hasloginbgnum = (!empty($PAGE->theme->settings->loginbgumber));
    if ($hasloginbgnum) {
    	$loginbgnum = $PAGE->theme->settings->loginbgumber;
	} else {
		$loginbgnum = '1';
	}

    foreach (range(1, $loginbgnum) as $loginbgnumber) {

    // Login Background Image.
    	$name = 'theme_elegance/loginimage' . $loginbgnumber;
    	$title = get_string('loginimage', 'theme_elegance');
    	$description = get_string('loginimagedesc', 'theme_elegance');
    	$setting = new admin_setting_configstoredfile($name, $title.$loginbgnumber, $description, 'loginimage'.$loginbgnumber);
    	$setting->set_updatedcallback('theme_reset_all_caches');
    	$temp->add($setting);

    }

 	$ADMIN->add('theme_elegance', $temp);

 	/* Social Network Settings */
	$temp = new admin_settingpage('theme_elegance_social', get_string('socialheading', 'theme_elegance'));
	$temp->add(new admin_setting_heading('theme_elegance_social', get_string('socialheadingsub', 'theme_elegance'),
            format_text(get_string('socialdesc' , 'theme_elegance'), FORMAT_MARKDOWN)));

    // Website url setting.
    $name = 'theme_elegance/website';
    $title = get_string('website', 'theme_elegance');
    $description = get_string('websitedesc', 'theme_elegance');
    $default = '';
    $setting = new admin_setting_configtext($name, $title, $description, $default);
    $setting->set_updatedcallback('theme_reset_all_caches');
    $temp->add($setting);

    // Blog url setting.
    $name = 'theme_elegance/blog';
    $title = get_string('blog', 'theme_elegance');
    $description = get_string('blogdesc', 'theme_elegance');
    $default = '';
    $setting = new admin_setting_configtext($name, $title, $description, $default);
    $setting->set_updatedcallback('theme_reset_all_caches');
    $temp->add($setting);

    // Facebook url setting.
    $name = 'theme_elegance/facebook';
    $title = get_string(    	'facebook', 'theme_elegance');
    $description = get_string(    	'facebookdesc', 'theme_elegance');
    $default = '';
    $setting = new admin_setting_configtext($name, $title, $description, $default);
    $setting->set_updatedcallback('theme_reset_all_caches');
    $temp->add($setting);

    // Flickr url setting.
    $name = 'theme_elegance/flickr';
    $title = get_string('flickr', 'theme_elegance');
    $description = get_string('flickrdesc', 'theme_elegance');
    $default = '';
    $setting = new admin_setting_configtext($name, $title, $description, $default);
    $setting->set_updatedcallback('theme_reset_all_caches');
    $temp->add($setting);

    // Twitter url setting.
    $name = 'theme_elegance/twitter';
    $title = get_string('twitter', 'theme_elegance');
    $description = get_string('twitterdesc', 'theme_elegance');
    $default = '';
    $setting = new admin_setting_configtext($name, $title, $description, $default);
    $setting->set_updatedcallback('theme_reset_all_caches');
    $temp->add($setting);

    // Google+ url setting.
    $name = 'theme_elegance/googleplus';
    $title = get_string('googleplus', 'theme_elegance');
    $description = get_string('googleplusdesc', 'theme_elegance');
    $default = '';
    $setting = new admin_setting_configtext($name, $title, $description, $default);
    $setting->set_updatedcallback('theme_reset_all_caches');
    $temp->add($setting);

    // LinkedIn url setting.
    $name = 'theme_elegance/linkedin';
    $title = get_string('linkedin', 'theme_elegance');
    $description = get_string('linkedindesc', 'theme_elegance');
    $default = '';
    $setting = new admin_setting_configtext($name, $title, $description, $default);
    $setting->set_updatedcallback('theme_reset_all_caches');
    $temp->add($setting);

    // Tumblr url setting.
    $name = 'theme_elegance/tumblr';
    $title = get_string('tumblr', 'theme_elegance');
    $description = get_string('tumblrdesc', 'theme_elegance');
    $default = '';
    $setting = new admin_setting_configtext($name, $title, $description, $default);
    $setting->set_updatedcallback('theme_reset_all_caches');
    $temp->add($setting);

    // Pinterest url setting.
    $name = 'theme_elegance/pinterest';
    $title = get_string('pinterest', 'theme_elegance');
    $description = get_string('pinterestdesc', 'theme_elegance');
    $default = '';
    $setting = new admin_setting_configtext($name, $title, $description, $default);
    $setting->set_updatedcallback('theme_reset_all_caches');
    $temp->add($setting);

    // Instagram url setting.
    $name = 'theme_elegance/instagram';
    $title = get_string('instagram', 'theme_elegance');
    $description = get_string('instagramdesc', 'theme_elegance');
    $default = '';
    $setting = new admin_setting_configtext($name, $title, $description, $default);
    $setting->set_updatedcallback('theme_reset_all_caches');
    $temp->add($setting);

    // YouTube url setting.
    $name = 'theme_elegance/youtube';
    $title = get_string('youtube', 'theme_elegance');
    $description = get_string('youtubedesc', 'theme_elegance');
    $default = '';
    $setting = new admin_setting_configtext($name, $title, $description, $default);
    $setting->set_updatedcallback('theme_reset_all_caches');
    $temp->add($setting);

    // Vimeo url setting.
    $name = 'theme_elegance/vimeo';
    $title = get_string('vimeo', 'theme_elegance');
    $description = get_string('vimeodesc', 'theme_elegance');
    $default = '';
    $setting = new admin_setting_configtext($name, $title, $description, $default);
    $setting->set_updatedcallback('theme_reset_all_caches');
    $temp->add($setting);

    // Skype url setting.
    $name = 'theme_elegance/skype';
    $title = get_string('skype', 'theme_elegance');
    $description = get_string('skypedesc', 'theme_elegance');
    $default = '';
    $setting = new admin_setting_configtext($name, $title, $description, $default);
    $setting->set_updatedcallback('theme_reset_all_caches');
    $temp->add($setting);

    // VKontakte url setting.
    $name = 'theme_elegance/vk';
    $title = get_string('vk', 'theme_elegance');
    $description = get_string('vkdesc', 'theme_elegance');
    $default = '';
    $setting = new admin_setting_configtext($name, $title, $description, $default);
    $setting->set_updatedcallback('theme_reset_all_caches');
    $temp->add($setting);

    $ADMIN->add('theme_elegance', $temp);

    /* Category Settings */
    $temp = new admin_settingpage('theme_elegance_categoryicon', get_string('categoryiconheading', 'theme_elegance'));

    $name = 'theme_elegance_categoryicon';
    $heading = get_string('categoryiconheadingsub', 'theme_elegance');
    $information = format_text(get_string('categoryiconheadingdesc' , 'theme_elegance'), FORMAT_MARKDOWN);
    $setting = new admin_setting_heading($name, $heading, $information);
    $temp->add($setting);

    // Category Icons.
    $name = 'theme_elegance/enablecategoryicon';
    $title = get_string('enablecategoryicon', 'theme_elegance');
    $description = get_string('enablecategoryicondesc', 'theme_elegance');
    $setting = new admin_setting_configcheckbox($name, $title, $description, 0);
    $setting->set_updatedcallback('theme_reset_all_caches');
    $temp->add($setting);

    // We only want to output category icon options if the parent setting is enabled
    $enablecategoryicon = (!empty($PAGE->theme->settings->enablecategoryicon));
    if($enablecategoryicon) {
    
        // Default Icon Selector.
    	$name = 'theme_elegance/defaultcategoryicon';
    	$title = get_string('defaultcategoryicon', 'theme_elegance');
    	$description = get_string('defaultcategoryicondesc', 'theme_elegance');
    	$default = 'folder-open';
    	$setting = new admin_setting_configtext($name, $title, $description, $default);
    	$setting->set_updatedcallback('theme_reset_all_caches');
    	$temp->add($setting);
    
        // This is the descriptor for Category Icons
        $name = 'theme_elegance/categoryiconinfo';
        $heading = get_string('categoryiconinfo', 'theme_elegance');
        $information = get_string('categoryiconinfodesc', 'theme_elegance');
        $setting = new admin_setting_heading($name, $heading, $information);
        $temp->add($setting);
        
        // Get the default category icon
        $defaultcategoryicon = (!empty($PAGE->theme->settings->defaultcategoryicon));
        if($defaultcategoryicon) {
            // Same as theme_elegance/defaultcategoryicon
            $defaultcategoryicon = $PAGE->theme->settings->defaultcategoryicon;
        } else {
            $defaultcategoryicon = 'folder-open';
        }
        
        // Get all category IDs and their pretty names
        require_once($CFG->libdir. '/coursecatlib.php');
        $coursecats = coursecat::make_categories_list();
        
        // Go through all categories and create the necessary settings
        foreach($coursecats as $key => $value) {
        
            // Category Icons for each category.
            $name = 'theme_elegance/categoryicon';
            $title = $value;
            $description = get_string('categoryicondesc', 'theme_elegance') . $value;
        	$default = $defaultcategoryicon;
        	$setting = new admin_setting_configtext($name.$key, $title, $description, $default);
            $setting->set_updatedcallback('theme_reset_all_caches');
            $temp->add($setting);
        }
        unset($coursecats);
    }

    $ADMIN->add('theme_elegance', $temp);