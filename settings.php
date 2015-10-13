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


require_once(__DIR__ . "/simple_theme_settings.class.php");

defined('MOODLE_INTERNAL') || die;

	global $PAGE;

    $ss = new elegance_simple_theme_settings($settings, 'theme_elegance');

	$ADMIN->add('themes', new admin_category('theme_elegance', 'Elegance'));

	// "geneicsettings" settingpage
	$temp = new admin_settingpage('theme_elegance_generic',  get_string('geneicsettings', 'theme_elegance'));

    $temp->add($ss->add_checkbox('invert'));

    $temp->add($ss->add_text('maxwidth', '1100'));

    $temp->add($ss->add_checkbox('fonticons'));

    $temp->add($ss->add_htmleditor('frontpagecontent'));

    $temp->add($ss->add_text('frontpagecontent'));

    $temp->add($ss->add_htmleditor('footnote'));

    $temp->add($ss->add_text('videowidth'));

    $temp->add($ss->add_checkbox('showoldmessages'));

    $temp->add($ss->add_textarea('customcss'));

    $temp->add($ss->add_textarea('moodlemobilecss'));

    $ADMIN->add('theme_elegance', $temp);

    /* Color and Logo Settings */
    $temp = new admin_settingpage('theme_elegance_colors', get_string('colorsettings', 'theme_elegance'));
    $temp->add(new admin_setting_heading('theme_elegance_colors', get_string('colorsettingssub', 'theme_elegance'),
    		format_text(get_string('colorsettingsdesc' , 'theme_elegance'), FORMAT_MARKDOWN)));

    $temp->add($ss->add_colourpicker('themecolor', '#0098e0'));

    $temp->add($ss->add_colourpicker('fontcolor', '#666'));

    $temp->add($ss->add_colourpicker('headingcolor', '#27282a'));

    $temp->add($ss->add_file('logo'));

    $temp->add($ss->add_file('headerbg'));

    $temp->add($ss->add_file('bodybg'));

    $temp->add($ss->add_colourpicker('bodycolor', '#f1f1f4'));

    // Set Transparency.
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

    $temp->add($ss->add_select('transparency', '1', $choices));

    $ADMIN->add('theme_elegance', $temp);

    /* Banner Settings */
    $temp = new admin_settingpage('theme_elegance_banner', get_string('bannersettings', 'theme_elegance'));
    $temp->add(new admin_setting_heading('theme_elegance_banner', get_string('bannersettingssub', 'theme_elegance'),
            format_text(get_string('bannersettingsdesc' , 'theme_elegance'), FORMAT_MARKDOWN)));


    $temp->add($ss->add_checkbox('enableslideshow'));

    $choices = range(0, 10);

    $temp->add($ss->add_select('slidenumber', '1', $choices));

    $temp->add($ss->add_text('slidespeed', '600'));

    $hasslidenum = (!empty($PAGE->theme->settings->slidenumber));
    if ($hasslidenum) {
    		$slidenum = $PAGE->theme->settings->slidenumber;
	} else {
		$slidenum = '1';
	}

	$bannertitle = array('Slide One', 'Slide Two', 'Slide Three','Slide Four','Slide Five','Slide Six','Slide Seven', 'Slide Eight', 'Slide Nine', 'Slide Ten');

    foreach (range(1, $slidenum) as $bannernumber) {

        $temp->add($ss->add_headings('bannerindicator', $bannernumber));

        $temp->add($ss->add_checkboxes('enablebanner', $bannernumber));

        $temp->add($ss->add_texts('bannertitle', $bannernumber));

        $temp->add($ss->add_texts('bannertext', $bannernumber));

        $temp->add($ss->add_texts('bannerlinktext', $bannernumber));

        $temp->add($ss->add_texts('bannerlinkurl', $bannernumber));

        // Slide Image.
    	$name = 'theme_elegance/bannerimage' . $bannernumber;
    	$title = get_string('bannerimage', 'theme_elegance', $bannernumber);
    	$description = get_string('bannerimagedesc', 'theme_elegance', $bannernumber);
    	$setting = new admin_setting_configstoredfile($name, $title, $description, 'bannerimage'.$bannernumber);
    	$setting->set_updatedcallback('theme_reset_all_caches');
    	$temp->add($setting);
         //$temp->add($ss->add_files('bannerimage', $bannernumber));

    	// Slide Background Color.
    	// $name = 'theme_elegance/bannercolor' . $bannernumber;
    	// $title = get_string('bannercolor', 'theme_elegance', $bannernumber);
    	// $description = get_string('bannercolordesc', 'theme_elegance', $bannernumber);
    	// $default = '#000';
    	// $previewconfig = null;
    	// $setting = new admin_setting_configcolourpicker($name, $title, $description, $default, $previewconfig);
    	// $setting->set_updatedcallback('theme_reset_all_caches');
    	$temp->add($ss->add_colourpickers('bannercolor', '#000', $bannernumber));

    }

 	$ADMIN->add('theme_elegance', $temp);

 	/* Marketing Spot Settings */
 		$temp = new admin_settingpage('theme_elegance_marketing', get_string('marketingspots', 'theme_elegance'));
 		$temp->add(new admin_setting_heading('theme_elegance_marketing', get_string('marketingheadingsub', 'theme_elegance'),
 				format_text(get_string('marketingdesc' , 'theme_elegance'), FORMAT_MARKDOWN)));

 		// Toggle Marketing Spots.
 		// $name = 'theme_elegance/togglemarketing';
 		// $title = get_string('togglemarketing' , 'theme_elegance');
 		// $description = get_string('togglemarketingdesc', 'theme_elegance');

 		// $choices = array('1' => $alwaysdisplay, '2'=>$displaybeforelogin, '3'=>$displayafterlogin, '0'=>$dontdisplay);
 		// $setting = new admin_setting_configselect($name, $title, $description, $default, $choices);
 		// $setting->set_updatedcallback('theme_reset_all_caches');
 		// $temp->add($setting);

        $choices = array();
        $choices[1] = get_string('alwaysdisplay', 'theme_elegance');
        $choices[2] = get_string('displaybeforelogin', 'theme_elegance');
        $choices[3] = get_string('displayafterlogin', 'theme_elegance');
        $choices[4] = get_string('dontdisplay', 'theme_elegance');
        $temp->add($ss->add_select('togglemarketing', '1', $choices));


 		// $name = 'theme_elegance/marketingtitle';
 		// $title = get_string('marketingtitle', 'theme_elegance');
 		// $description = get_string('marketingtitledesc', 'theme_elegance');
 		// $default = 'More about Us';
 		// $setting = new admin_setting_configtext($name, $title, $description, $default);
 		// $setting->set_updatedcallback('theme_reset_all_caches');
 		// $temp->add($setting);

        $temp->add($ss->add_text('marketingtitle', '600'));

        $temp->add($ss->add_text('marketingtitleicon', '600'));

        $choices = array();
        $choices[1] = 2;
        $choices[2] = 4;
        $choices[3] = 6;
        $choices[4] = 8;
        $temp->add($ss->add_select('marketingspotsinrow', '1', $choices));

        $choices = (range(0, 24));

        $temp->add($ss->add_select('marketingspotsnr', '4', $choices));

        $hasspotsnr = (!empty($PAGE->theme->settings->marketingspotsnr));
        if ($hasspotsnr) {
            $spotsnr = $PAGE->theme->settings->marketingspotsnr;
        } else {
            $spotsnr = '4';
        }


        foreach (range(1, $spotsnr) as $spot) {
            $temp->add($ss->add_headings('marketingheading', $spot));

            $temp->add($ss->add_texts('marketingtitle', $spot));

            $temp->add($ss->add_texts('marketingicon', $spot));

            $temp->add($ss->add_texts('marketingurl', $spot));

            $temp->add($ss->add_htmleditors('marketingcontent', '', $spot));
        }


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