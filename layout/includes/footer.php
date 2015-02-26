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

$hascopyright = (empty($PAGE->theme->settings->copyright)) ? false : $PAGE->theme->settings->copyright;
$hasfootnote = (empty($PAGE->theme->settings->footnote)) ? false : $PAGE->theme->settings->footnote;

$hasiosapp = (empty($PAGE->theme->settings->ios)) ? false : $PAGE->theme->settings->ios;
$hasandroidapp = (empty($PAGE->theme->settings->android)) ? false : $PAGE->theme->settings->android;
$haswindowsapp = (empty($PAGE->theme->settings->windows)) ? false : $PAGE->theme->settings->windows;
$haswinphoneapp = (empty($PAGE->theme->settings->winphone)) ? false : $PAGE->theme->settings->winphone;

$hasfacebook    = (empty($PAGE->theme->settings->facebook)) ? false : $PAGE->theme->settings->facebook;
$hastwitter     = (empty($PAGE->theme->settings->twitter)) ? false : $PAGE->theme->settings->twitter;
$hasgoogleplus  = (empty($PAGE->theme->settings->googleplus)) ? false : $PAGE->theme->settings->googleplus;
$haslinkedin    = (empty($PAGE->theme->settings->linkedin)) ? false : $PAGE->theme->settings->linkedin;
$hasyoutube     = (empty($PAGE->theme->settings->youtube)) ? false : $PAGE->theme->settings->youtube;
$hasflickr      = (empty($PAGE->theme->settings->flickr)) ? false : $PAGE->theme->settings->flickr;
$hasvk          = (empty($PAGE->theme->settings->vk)) ? false : $PAGE->theme->settings->vk;
$haspinterest   = (empty($PAGE->theme->settings->pinterest)) ? false : $PAGE->theme->settings->pinterest;
$hasinstagram   = (empty($PAGE->theme->settings->instagram)) ? false : $PAGE->theme->settings->instagram;
$hasskype       = (empty($PAGE->theme->settings->skype)) ? false : $PAGE->theme->settings->skype;
$haswebsite     = (empty($PAGE->theme->settings->website)) ? false : $PAGE->theme->settings->website;
$hasblog     = (empty($PAGE->theme->settings->blog)) ? false : $PAGE->theme->settings->blog;
$hasvimeo     = (empty($PAGE->theme->settings->vimeo)) ? false : $PAGE->theme->settings->vimeo;
$hastumblr     = (empty($PAGE->theme->settings->tumblr)) ? false : $PAGE->theme->settings->tumblr;

// If any of the above social networks are true, sets this to true.
$hassocialnetworks = ($hasfacebook || $hastwitter || $hasgoogleplus || $hasflickr || $hasinstagram || $hasvk || $haslinkedin || $haspinterest || $hasskype || $haslinkedin || $haswebsite || $hasyoutube ) ? true : false;

// if any of the above apps are true, set to true.
$hasapp = ($hasiosapp || $hasandroidapp || $haswindowsapp || $haswinphoneapp) ? true : false;
?>
<div class="container">
	<div class="row">
		<div id="course-footer">
			<?php echo $OUTPUT->course_footer(); ?>
		</div>
	</div>

	<div class="row">
		<div class="col-lg-6">
      <?php echo $OUTPUT->home_link(); ?>

			<?php
			if ($hascopyright) {
				echo '<p class="copy">&copy; Copyright '.date("Y").' by '.$hascopyright.'</p>';
   			} ?>

   			<?php if ($hasfootnote) {
				echo  '<div class="footnote">'. $hasfootnote. '</div>';
   			} ?>

		</div>

		<div class="col-lg-6 pull-right">
			<?php echo $OUTPUT->login_info();
			if ($hassocialnetworks || $hasapp) {

				echo '<ul class="socials unstyled">';
                                    if ($hasiosapp) {
                                            echo '<a href="'.$hasiosapp.'" class="socialicon ios" title="'.get_string('ios','theme_elegance').'">';
                                            echo '<i class="fa fa-apple fa-inverse"></i>';
                                                    echo '<span class="sr-only">'.get_string('ios','theme_elegance').'</span>';
                                            echo '</a>';
                                    }
                                    if ($hasandroidapp) {
                                            echo '<a href="'.$hasandroidapp.'" class="socialicon android" title="'.get_string('android','theme_elegance').'">';
                                            echo '<i class="fa fa-android fa-inverse"></i>';
                                                    echo '<span class="sr-only">'.get_string('android','theme_elegance').'</span>';
                                            echo '</a>';
                                    }
                                    if ($haswinphoneapp) {
                                            echo '<a href="'.$haswinphoneapp.'" class="socialicon winphone" title="'.get_string('winphone','theme_elegance').'">';
                                            echo '<i class="fa fa-windows fa-inverse"></i>';
                                                    echo '<span class="sr-only">'.get_string('winphone','theme_elegance').'</span>';
                                            echo '</a>';
                                    }
                                    if ($haswindowsapp) {
                                            echo '<a href="'.$haswindowsapp.'" class="socialicon windows" title="'.get_string('windows','theme_elegance').'">';
                                            echo '<i class="fa fa-windows fa-inverse"></i>';
                                                    echo '<span class="sr-only">'.get_string('windows','theme_elegance').'</span>';
                                            echo '</a>';
                                    }
                                    if ($hasblog) {
                                            echo '<a href="'.$hasblog.'" class="socialicon blog" title="'.get_string('socialnetworksicondescriptionblog','theme_elegance').'">';
                                            echo '<i class="fa fa-bookmark fa-inverse"></i>';
                                                    echo '<span class="sr-only">'.get_string('socialnetworksicondescriptionblog','theme_elegance').'</span>';
                                            echo '</a>';
                                    }

                                    if ($haswebsite) {
                                            echo '<a href="'.$haswebsite.'" class="socialicon website" title="'.get_string('socialnetworksicondescriptionwebsite','theme_elegance').'">';
                                            echo '<i class="fa fa-globe fa-inverse"></i>';
                                                    echo '<span class="sr-only">'.get_string('socialnetworksicondescriptionwebsite','theme_elegance').'</span>';
                                            echo '</a>';
                                    }

                                    if ($hasgoogleplus) {
                                            echo '<a href="'.$hasgoogleplus.'" class="socialicon googleplus" title="'.get_string('socialnetworksicondescriptiongoogleplus','theme_elegance').'">';
                                            echo '<i class="fa fa-google-plus fa-inverse"></i>';
                                                    echo '<span class="sr-only">'.get_string('socialnetworksicondescriptiongoogleplus','theme_elegance').'</span>';
                                            echo '</a>';
                                    }

                                    if ($hastwitter) {
                                            echo '<a href="'.$hastwitter.'" class="socialicon twitter" title="'.get_string('socialnetworksicondescriptiontwitter','theme_elegance').'">';
                                            echo '<i class="fa fa-twitter fa-inverse"></i>';
                                                    echo '<span class="sr-only">'.get_string('socialnetworksicondescriptiontwitter','theme_elegance').'</span>';
                                            echo '</a>';
                                    }

                                    if ($hasfacebook) {
                                            echo '<a href="'.$hasfacebook.'" class="socialicon facebook" title="'.get_string('socialnetworksicondescriptionfacebook','theme_elegance').'">';
                                            echo '<i class="fa fa-facebook fa-inverse"></i>';
                                                    echo '<span class="sr-only">'.get_string('socialnetworksicondescriptionfacebook','theme_elegance').'</span>';
                                            echo '</a>';
                                    }

                                    if ($haslinkedin) {
                                            echo '<a href="'.$haslinkedin.'" class="socialicon linkedin" title="'.get_string('socialnetworksicondescriptionlinkedin','theme_elegance').'">';
                                            echo '<i class="fa fa-linkedin fa-inverse"></i>';
                                                    echo '<span class="sr-only">'.get_string('socialnetworksicondescriptionlinkedin','theme_elegance').'</span>';
                                            echo '</a>';
                                    }

                                    if ($hasyoutube) {
                                            echo '<a href="'.$hasyoutube.'" class="socialicon youtube" title="'.get_string('socialnetworksicondescriptionyoutube','theme_elegance').'">';
                                            echo '<i class="fa fa-youtube fa-inverse"></i>';
                                                    echo '<span class="sr-only">'.get_string('socialnetworksicondescriptionyoutube','theme_elegance').'</span>';
                                            echo '</a>';
                                    }

                                    if ($hasvimeo) {
                                            echo '<a href="'.$hasvimeo.'" class="socialicon vimeo" title="'.get_string('socialnetworksicondescriptionvimeo','theme_elegance').'">';
                                            echo '<i class="fa fa-vimeo-square fa-inverse"></i>';
                                                    echo '<span class="sr-only">'.get_string('socialnetworksicondescriptionvimeo','theme_elegance').'</span>';
                                            echo '</button>';
                                    }

                                    if ($hasflickr) {
                                            echo '<a href="'.$hasflickr.'" class="socialicon flickr" title="'.get_string('socialnetworksicondescriptionflickr','theme_elegance').'">';
                                            echo '<i class="fa fa-flickr fa-inverse"></i>';
                                                    echo '<span class="sr-only">'.get_string('socialnetworksicondescriptionflickr','theme_elegance').'</span>';
                                            echo '</a>';
                                    }

                                    if ($haspinterest) {
                                            echo '<a href="'.$haspinterest.'" class="socialicon pinterest" title="'.get_string('socialnetworksicondescriptionpinterest','theme_elegance').'">';
                                            echo '<i class="fa fa-pinterest fa-inverse"></i>';
                                                    echo '<span class="sr-only">'.get_string('socialnetworksicondescriptionpinterest','theme_elegance').'</span>';
                                            echo '</a>';
                                    }

                                    if ($hastumblr) {
                                            echo '<a href="'.$hastumblr.'" class="socialicon tumblr" title="'.get_string('socialnetworksicondescriptiontumblr','theme_elegance').'">';
                                            echo '<i class="fa fa-tumblr fa-inverse"></i>';
                                                    echo '<span class="sr-only">'.get_string('socialnetworksicondescriptiontumblr','theme_elegance').'</span>';
                                            echo '</a>';
                                    }

                                    if ($hasinstagram) {
                                            echo '<a href="'.$hasinstagram.'" class="socialicon instagram" title="'.get_string('socialnetworksicondescriptioninstagram','theme_elegance').'">';
                                            echo '<i class="fa fa-instagram fa-inverse"></i>';
                                                    echo '<span class="sr-only">'.get_string('socialnetworksicondescriptioninstagram','theme_elegance').'</span>';
                                            echo '</a>';
                                    }

                                    if ($hasvk) {
                                            echo '<a href="'.$hasvk.'" class="socialicon vk" title="'.get_string('socialnetworksicondescriptionvk','theme_elegance').'">';
                                            echo '<i class="fa fa-vk fa-inverse"></i>';
                                                    echo '<span class="sr-only">'.get_string('socialnetworksicondescriptionvk','theme_elegance').'</span>';
                                            echo '</a>';
                                    }

                                    if ($hasskype) {
                                            echo '<a href="skype:'.$hasskype.'?call" class="socialicon skype" title="'.get_string('socialnetworksicondescriptionskype','theme_elegance').'">';
                                            echo '<i class="fa fa-skype fa-inverse"></i>';
                                                    echo '<span class="sr-only">'.get_string('socialnetworksicondescriptionskype','theme_elegance').'</span>';
                                            echo '</a>';
                                    }

				echo '</ul>';
			} ?>
		</div>
	</div>

	<div class="row">
    <p class="helplink"><?php echo $OUTPUT->page_doc_link(); ?></p>
		<?php echo $OUTPUT->standard_footer_html(); ?>
	</div>

</div>
