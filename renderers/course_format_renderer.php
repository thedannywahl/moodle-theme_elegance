<?php
// This file is part of The Bootstrap 3 Moodle theme
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
 * Renderers to align Moodle's HTML with that expected by Bootstrap
 *
 * @package    theme
 * @subpackage bootstrap
 * @copyright  &copy; 2014-onwards G J Barnard.
 * @author     G J Barnard - gjbarnard at gmail dot com and {@link http://moodle.org/user/profile.php?id=442195}
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

include_once($CFG->dirroot . "/course/format/topics/renderer.php");
class theme_elegance_format_topics_renderer extends theme_bootstrap_format_topics_renderer {
    /**
     * Generate the content to displayed on the left part of a section
     * before course modules are included
     *
     * @param stdClass $section The course_section entry from DB
     * @param stdClass $course The course entry from DB
     * @param bool $onsectionpage true if being printed on a section page
     * @return string HTML to output.
     */
    protected function section_left_content($section, $course, $onsectionpage) {
        $o = $this->output->spacer();

        if ($section->section != 0) {
            // Only in the non-general sections.
            if (course_get_format($course)->is_section_current($section)) {
                $o .= get_accesshide(get_string('currentsection', 'format_'.$course->format));
            }
        }

        return $o;
    }

    protected function get_nav_links($course, $sections, $sectionno) {
        return theme_elegance_get_nav_links($course, $sections, $sectionno);
    }

    public function print_single_section_page($course, $sections, $mods, $modnames, $modnamesused, $displaysection) {
        global $PAGE;

        $modinfo = get_fast_modinfo($course);
        $course = course_get_format($course)->get_course();

        // Can we view the section in question?
        if (!($sectioninfo = $modinfo->get_section_info($displaysection))) {
            // This section doesn't exist
            print_error('unknowncoursesection', 'error', null, $course->fullname);
            return;
        }

        if (!$sectioninfo->uservisible) {
            if (!$course->hiddensections) {
                echo $this->start_section_list();
                echo $this->section_hidden($displaysection);
                echo $this->end_section_list();
            }
            // Can't view this section.
            return;
        }

        // Copy activity clipboard..
        echo $this->course_activity_clipboard($course, $displaysection);
        $thissection = $modinfo->get_section_info(0);
        if ($thissection->summary or !empty($modinfo->sections[0]) or $PAGE->user_is_editing()) {
            echo $this->start_section_list();
            echo $this->section_header($thissection, $course, true, $displaysection);
            echo $this->courserenderer->course_section_cm_list($course, $thissection, $displaysection);
            echo $this->courserenderer->course_section_add_cm_control($course, 0, $displaysection);
            echo $this->section_footer();
            echo $this->end_section_list();
        }

        // Start single-section div
        echo html_writer::start_tag('div', array('class' => 'single-section'));

        // The requested section page.
        $thissection = $modinfo->get_section_info($displaysection);

        // Title with section navigation links.
        $sectionnavlinks = $this->get_nav_links($course, $modinfo->get_section_info_all(), $displaysection);
        $sectiontitle = '';
        $sectiontitle .= html_writer::start_tag('div', array('class' => 'section-navigation header headingblock'));
        // Title attributes
        $titleattr = 'title';
        if (!$thissection->visible) {
            $titleattr .= ' dimmed_text';
        }
        $sectiontitle .= html_writer::tag('div', get_section_name($course, $displaysection), array('class' => $titleattr));
        $sectiontitle .= html_writer::end_tag('div');
        echo $sectiontitle;

        // Now the list of sections..
        echo $this->start_section_list();

        echo $this->section_header($thissection, $course, true, $displaysection);
        // Show completion help icon.
        $completioninfo = new completion_info($course);
        echo $completioninfo->display_help_icon();

        echo $this->courserenderer->course_section_cm_list($course, $thissection, $displaysection);
        echo $this->courserenderer->course_section_add_cm_control($course, $displaysection, $displaysection);
        echo $this->section_footer();
        echo $this->end_section_list();

        // Display section bottom navigation.
        $sectionbottomnav = '';
        $sectionbottomnav .= html_writer::start_tag('nav', array('id' => 'section_footer', 'class'=>'clearfix'));
        $sectionbottomnav .= $sectionnavlinks['previous'];
        $sectionbottomnav .= $sectionnavlinks['next'];
        // $sectionbottomnav .= html_writer::tag('div', $this->section_nav_selection($course, $sections, $displaysection), array('class' => 'mdl-align'));
        $sectionbottomnav .= html_writer::end_tag('nav');
        echo $sectionbottomnav;

        // Close single-section div.
        echo html_writer::end_tag('div');
    }
}

include_once($CFG->dirroot . "/course/format/weeks/renderer.php");
class theme_elegance_format_weeks_renderer extends theme_bootstrap_format_weeks_renderer {
    /**
     * Generate the content to displayed on the left part of a section
     * before course modules are included
     *
     * @param stdClass $section The course_section entry from DB
     * @param stdClass $course The course entry from DB
     * @param bool $onsectionpage true if being printed on a section page
     * @return string HTML to output.
     */
    protected function section_left_content($section, $course, $onsectionpage) {
        $o = $this->output->spacer();

        if ($section->section != 0) {
            // Only in the non-general sections.
            if (course_get_format($course)->is_section_current($section)) {
                $o .= get_accesshide(get_string('currentsection', 'format_'.$course->format));
            }
        }

        return $o;
    }

    protected function get_nav_links($course, $sections, $sectionno) {
        return theme_elegance_get_nav_links($course, $sections, $sectionno);
    }

    public function print_single_section_page($course, $sections, $mods, $modnames, $modnamesused, $displaysection) {
        global $PAGE;

        $modinfo = get_fast_modinfo($course);
        $course = course_get_format($course)->get_course();

        // Can we view the section in question?
        if (!($sectioninfo = $modinfo->get_section_info($displaysection))) {
            // This section doesn't exist
            print_error('unknowncoursesection', 'error', null, $course->fullname);
            return;
        }

        if (!$sectioninfo->uservisible) {
            if (!$course->hiddensections) {
                echo $this->start_section_list();
                echo $this->section_hidden($displaysection);
                echo $this->end_section_list();
            }
            // Can't view this section.
            return;
        }

        // Copy activity clipboard..
        echo $this->course_activity_clipboard($course, $displaysection);
        $thissection = $modinfo->get_section_info(0);
        if ($thissection->summary or !empty($modinfo->sections[0]) or $PAGE->user_is_editing()) {
            echo $this->start_section_list();
            echo $this->section_header($thissection, $course, true, $displaysection);
            echo $this->courserenderer->course_section_cm_list($course, $thissection, $displaysection);
            echo $this->courserenderer->course_section_add_cm_control($course, 0, $displaysection);
            echo $this->section_footer();
            echo $this->end_section_list();
        }

        // Start single-section div
        echo html_writer::start_tag('div', array('class' => 'single-section'));

        // The requested section page.
        $thissection = $modinfo->get_section_info($displaysection);

        // Title with section navigation links.
        $sectionnavlinks = $this->get_nav_links($course, $modinfo->get_section_info_all(), $displaysection);
        $sectiontitle = '';
        $sectiontitle .= html_writer::start_tag('div', array('class' => 'section-navigation header headingblock'));
        // Title attributes
        $titleattr = 'title';
        if (!$thissection->visible) {
            $titleattr .= ' dimmed_text';
        }
        $sectiontitle .= html_writer::tag('div', get_section_name($course, $displaysection), array('class' => $titleattr));
        $sectiontitle .= html_writer::end_tag('div');
        echo $sectiontitle;

        // Now the list of sections..
        echo $this->start_section_list();

        echo $this->section_header($thissection, $course, true, $displaysection);
        // Show completion help icon.
        $completioninfo = new completion_info($course);
        echo $completioninfo->display_help_icon();

        echo $this->courserenderer->course_section_cm_list($course, $thissection, $displaysection);
        echo $this->courserenderer->course_section_add_cm_control($course, $displaysection, $displaysection);
        echo $this->section_footer();
        echo $this->end_section_list();

        // Display section bottom navigation.
        $sectionbottomnav = '';
        $sectionbottomnav .= html_writer::start_tag('nav', array('id' => 'section_footer', 'class'=>'clearfix'));
        $sectionbottomnav .= $sectionnavlinks['previous'];
        $sectionbottomnav .= $sectionnavlinks['next'];
        // $sectionbottomnav .= html_writer::tag('div', $this->section_nav_selection($course, $sections, $displaysection), array('class' => 'mdl-align'));
        $sectionbottomnav .= html_writer::end_tag('nav');
        echo $sectionbottomnav;

        // Close single-section div.
        echo html_writer::end_tag('div');
    }
}

// Requires V2.6.1.3+ of Collapsed Topics format.
if (file_exists("$CFG->dirroot/course/format/topcoll/renderer.php")) {
    include_once($CFG->dirroot . "/course/format/topcoll/renderer.php");
    class theme_elegance_format_topcoll_renderer extends format_topcoll_renderer {

        protected function get_nav_links($course, $sections, $sectionno) {
            return theme_elegance_get_nav_links($course, $sections, $sectionno);
        }

        public function print_single_section_page($course, $sections, $mods, $modnames, $modnamesused, $displaysection) {
            global $PAGE;

            $modinfo = get_fast_modinfo($course);
            $course = course_get_format($course)->get_course();

            // Can we view the section in question?
            if (!($sectioninfo = $modinfo->get_section_info($displaysection))) {
                // This section doesn't exist
                print_error('unknowncoursesection', 'error', null, $course->fullname);
                return;
            }

            if (!$sectioninfo->uservisible) {
                if (!$course->hiddensections) {
                    echo $this->start_section_list();
                    echo $this->section_hidden($displaysection);
                    echo $this->end_section_list();
                }
                // Can't view this section.
                return;
            }

            // Copy activity clipboard..
            echo $this->course_activity_clipboard($course, $displaysection);
            $thissection = $modinfo->get_section_info(0);
            if ($thissection->summary or !empty($modinfo->sections[0]) or $PAGE->user_is_editing()) {
                echo $this->start_section_list();
                echo $this->section_header($thissection, $course, true, $displaysection);
                echo $this->courserenderer->course_section_cm_list($course, $thissection, $displaysection);
                echo $this->courserenderer->course_section_add_cm_control($course, 0, $displaysection);
                echo $this->section_footer();
                echo $this->end_section_list();
            }

            // Start single-section div
            echo html_writer::start_tag('div', array('class' => 'single-section'));

            // The requested section page.
            $thissection = $modinfo->get_section_info($displaysection);

            // Title with section navigation links.
            $sectionnavlinks = $this->get_nav_links($course, $modinfo->get_section_info_all(), $displaysection);
            $sectiontitle = '';
            $sectiontitle .= html_writer::start_tag('div', array('class' => 'section-navigation header headingblock'));
            // Title attributes
            $titleattr = 'title';
            if (!$thissection->visible) {
                $titleattr .= ' dimmed_text';
            }
            $sectiontitle .= html_writer::tag('div', get_section_name($course, $displaysection), array('class' => $titleattr));
            $sectiontitle .= html_writer::end_tag('div');
            echo $sectiontitle;

            // Now the list of sections..
            echo $this->start_section_list();

            echo $this->section_header($thissection, $course, true, $displaysection);
            // Show completion help icon.
            $completioninfo = new completion_info($course);
            echo $completioninfo->display_help_icon();

            echo $this->courserenderer->course_section_cm_list($course, $thissection, $displaysection);
            echo $this->courserenderer->course_section_add_cm_control($course, $displaysection, $displaysection);
            echo $this->section_footer();
            echo $this->end_section_list();

            // Display section bottom navigation.
            $sectionbottomnav = '';
            $sectionbottomnav .= html_writer::start_tag('nav', array('id' => 'section_footer', 'class'=>'clearfix'));
            $sectionbottomnav .= $sectionnavlinks['previous'];
            $sectionbottomnav .= $sectionnavlinks['next'];
            // $sectionbottomnav .= html_writer::tag('div', $this->section_nav_selection($course, $sections, $displaysection), array('class' => 'mdl-align'));
            $sectionbottomnav .= html_writer::end_tag('nav');
            echo $sectionbottomnav;

            // Close single-section div.
            echo html_writer::end_tag('div');
        }
    }
}

if (file_exists("$CFG->dirroot/course/format/grid/renderer.php")) {
    include_once($CFG->dirroot . "/course/format/grid/renderer.php");
    class theme_elegance_format_grid_renderer extends format_grid_renderer {

        protected function get_nav_links($course, $sections, $sectionno) {
            return theme_elegance_get_nav_links($course, $sections, $sectionno);
        }

        public function print_single_section_page($course, $sections, $mods, $modnames, $modnamesused, $displaysection) {
            global $PAGE;

            $modinfo = get_fast_modinfo($course);
            $course = course_get_format($course)->get_course();

            // Can we view the section in question?
            if (!($sectioninfo = $modinfo->get_section_info($displaysection))) {
                // This section doesn't exist
                print_error('unknowncoursesection', 'error', null, $course->fullname);
                return;
            }

            if (!$sectioninfo->uservisible) {
                if (!$course->hiddensections) {
                    echo $this->start_section_list();
                    echo $this->section_hidden($displaysection);
                    echo $this->end_section_list();
                }
                // Can't view this section.
                return;
            }

            // Copy activity clipboard..
            echo $this->course_activity_clipboard($course, $displaysection);
            $thissection = $modinfo->get_section_info(0);
            if ($thissection->summary or !empty($modinfo->sections[0]) or $PAGE->user_is_editing()) {
                echo $this->start_section_list();
                echo $this->section_header($thissection, $course, true, $displaysection);
                echo $this->courserenderer->course_section_cm_list($course, $thissection, $displaysection);
                echo $this->courserenderer->course_section_add_cm_control($course, 0, $displaysection);
                echo $this->section_footer();
                echo $this->end_section_list();
            }

            // Start single-section div
            echo html_writer::start_tag('div', array('class' => 'single-section'));

            // The requested section page.
            $thissection = $modinfo->get_section_info($displaysection);

            // Title with section navigation links.
            $sectionnavlinks = $this->get_nav_links($course, $modinfo->get_section_info_all(), $displaysection);
            $sectiontitle = '';
            $sectiontitle .= html_writer::start_tag('div', array('class' => 'section-navigation header headingblock'));
            // Title attributes
            $titleattr = 'title';
            if (!$thissection->visible) {
                $titleattr .= ' dimmed_text';
            }
            $sectiontitle .= html_writer::tag('div', get_section_name($course, $displaysection), array('class' => $titleattr));
            $sectiontitle .= html_writer::end_tag('div');
            echo $sectiontitle;

            // Now the list of sections..
            echo $this->start_section_list();

            echo $this->section_header($thissection, $course, true, $displaysection);
            // Show completion help icon.
            $completioninfo = new completion_info($course);
            echo $completioninfo->display_help_icon();

            echo $this->courserenderer->course_section_cm_list($course, $thissection, $displaysection);
            echo $this->courserenderer->course_section_add_cm_control($course, $displaysection, $displaysection);
            echo $this->section_footer();
            echo $this->end_section_list();

            // Display section bottom navigation.
            $sectionbottomnav = '';
            $sectionbottomnav .= html_writer::start_tag('nav', array('id' => 'section_footer', 'class'=>'clearfix'));
            $sectionbottomnav .= $sectionnavlinks['previous'];
            $sectionbottomnav .= $sectionnavlinks['next'];
            // $sectionbottomnav .= html_writer::tag('div', $this->section_nav_selection($course, $sections, $displaysection), array('class' => 'mdl-align'));
            $sectionbottomnav .= html_writer::end_tag('nav');
            echo $sectionbottomnav;

            // Close single-section div.
            echo html_writer::end_tag('div');
        }
    }
}

if (file_exists("$CFG->dirroot/course/format/noticebd/renderer.php")) {
    include_once($CFG->dirroot . "/course/format/noticebd/renderer.php");
    class theme_elegance_format_noticebd_renderer extends format_noticebd_renderer {

        protected function get_nav_links($course, $sections, $sectionno) {
            return theme_elegance_get_nav_links($course, $sections, $sectionno);
        }

        public function print_single_section_page($course, $sections, $mods, $modnames, $modnamesused, $displaysection) {
            global $PAGE;

            $modinfo = get_fast_modinfo($course);
            $course = course_get_format($course)->get_course();

            // Can we view the section in question?
            if (!($sectioninfo = $modinfo->get_section_info($displaysection))) {
                // This section doesn't exist
                print_error('unknowncoursesection', 'error', null, $course->fullname);
                return;
            }

            if (!$sectioninfo->uservisible) {
                if (!$course->hiddensections) {
                    echo $this->start_section_list();
                    echo $this->section_hidden($displaysection);
                    echo $this->end_section_list();
                }
                // Can't view this section.
                return;
            }

            // Copy activity clipboard..
            echo $this->course_activity_clipboard($course, $displaysection);

            // General section if non-empty.
            $thissection = $sections[0];
            //if ($thissection->summary or $thissection->sequence or $PAGE->user_is_editing()) {
                echo $this->start_section_list();
                echo $this->section_header($thissection, $course, true, $displaysection);
                $this->print_noticeboard($course);
                if (($PAGE->user_is_editing()) && (is_siteadmin($USER))) {
                    print_section($course, $thissection, $mods, $modnamesused, true, "100%", false, $displaysection);
                    print_section_add_menus($course, 0, $modnames, false, false, $displaysection);
                }
                echo $this->section_footer();
                echo $this->end_section_list();
            //}

            // Start single-section div
            echo html_writer::start_tag('div', array('class' => 'single-section'));

            // The requested section page.
            $thissection = $modinfo->get_section_info($displaysection);

            // Title with section navigation links.
            $sectionnavlinks = $this->get_nav_links($course, $modinfo->get_section_info_all(), $displaysection);
            $sectiontitle = '';
            $sectiontitle .= html_writer::start_tag('div', array('class' => 'section-navigation header headingblock'));
            // Title attributes
            $titleattr = 'title';
            if (!$thissection->visible) {
                $titleattr .= ' dimmed_text';
            }
            $sectiontitle .= html_writer::tag('div', get_section_name($course, $displaysection), array('class' => $titleattr));
            $sectiontitle .= html_writer::end_tag('div');
            echo $sectiontitle;

            // Now the list of sections..
            echo $this->start_section_list();

            echo $this->section_header($thissection, $course, true, $displaysection);
            // Show completion help icon.
            $completioninfo = new completion_info($course);
            echo $completioninfo->display_help_icon();

            echo $this->courserenderer->course_section_cm_list($course, $thissection, $displaysection);
            echo $this->courserenderer->course_section_add_cm_control($course, $displaysection, $displaysection);
            echo $this->section_footer();
            echo $this->end_section_list();

            // Display section bottom navigation.
            $sectionbottomnav = '';
            $sectionbottomnav .= html_writer::start_tag('nav', array('id' => 'section_footer', 'class'=>'clearfix'));
            $sectionbottomnav .= $sectionnavlinks['previous'];
            $sectionbottomnav .= $sectionnavlinks['next'];
            // $sectionbottomnav .= html_writer::tag('div', $this->section_nav_selection($course, $sections, $displaysection), array('class' => 'mdl-align'));
            $sectionbottomnav .= html_writer::end_tag('nav');
            echo $sectionbottomnav;

            // Close single-section div.
            echo html_writer::end_tag('div');
        }
    }
}

// Requires V2.6.1.1+ of Columns format.
if (file_exists("$CFG->dirroot/course/format/columns/renderer.php")) {
    include_once($CFG->dirroot . "/course/format/columns/renderer.php");
    class theme_elegance_format_columns_renderer extends format_columns_renderer {

        protected function get_nav_links($course, $sections, $sectionno) {
            return theme_elegance_get_nav_links($course, $sections, $sectionno);
        }

        public function print_single_section_page($course, $sections, $mods, $modnames, $modnamesused, $displaysection) {
            global $PAGE;

            $modinfo = get_fast_modinfo($course);
            $course = course_get_format($course)->get_course();

            // Can we view the section in question?
            if (!($sectioninfo = $modinfo->get_section_info($displaysection))) {
                // This section doesn't exist
                print_error('unknowncoursesection', 'error', null, $course->fullname);
                return;
            }

            if (!$sectioninfo->uservisible) {
                if (!$course->hiddensections) {
                    echo $this->start_section_list();
                    echo $this->section_hidden($displaysection);
                    echo $this->end_section_list();
                }
                // Can't view this section.
                return;
            }

            // Copy activity clipboard..
            echo $this->course_activity_clipboard($course, $displaysection);
            $thissection = $modinfo->get_section_info(0);
            if ($thissection->summary or !empty($modinfo->sections[0]) or $PAGE->user_is_editing()) {
                echo $this->start_section_list();
                echo $this->section_header($thissection, $course, true, $displaysection);
                echo $this->courserenderer->course_section_cm_list($course, $thissection, $displaysection);
                echo $this->courserenderer->course_section_add_cm_control($course, 0, $displaysection);
                echo $this->section_footer();
                echo $this->end_section_list();
            }

            // Start single-section div
            echo html_writer::start_tag('div', array('class' => 'single-section'));

            // The requested section page.
            $thissection = $modinfo->get_section_info($displaysection);

            // Title with section navigation links.
            $sectionnavlinks = $this->get_nav_links($course, $modinfo->get_section_info_all(), $displaysection);
            $sectiontitle = '';
            $sectiontitle .= html_writer::start_tag('div', array('class' => 'section-navigation header headingblock'));
            // Title attributes
            $titleattr = 'title';
            if (!$thissection->visible) {
                $titleattr .= ' dimmed_text';
            }
            $sectiontitle .= html_writer::tag('div', get_section_name($course, $displaysection), array('class' => $titleattr));
            $sectiontitle .= html_writer::end_tag('div');
            echo $sectiontitle;

            // Now the list of sections..
            echo $this->start_section_list();

            echo $this->section_header($thissection, $course, true, $displaysection);
            // Show completion help icon.
            $completioninfo = new completion_info($course);
            echo $completioninfo->display_help_icon();

            echo $this->courserenderer->course_section_cm_list($course, $thissection, $displaysection);
            echo $this->courserenderer->course_section_add_cm_control($course, $displaysection, $displaysection);
            echo $this->section_footer();
            echo $this->end_section_list();

            // Display section bottom navigation.
            $sectionbottomnav = '';
            $sectionbottomnav .= html_writer::start_tag('nav', array('id' => 'section_footer', 'class'=>'clearfix'));
            $sectionbottomnav .= $sectionnavlinks['previous'];
            $sectionbottomnav .= $sectionnavlinks['next'];
            // $sectionbottomnav .= html_writer::tag('div', $this->section_nav_selection($course, $sections, $displaysection), array('class' => 'mdl-align'));
            $sectionbottomnav .= html_writer::end_tag('nav');
            echo $sectionbottomnav;

            // Close single-section div.
            echo html_writer::end_tag('div');
        }
    }
}
