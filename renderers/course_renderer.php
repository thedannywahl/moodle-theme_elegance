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
 * @package    theme_bootstrap
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

require_once($CFG->dirroot . "/course/renderer.php");

class theme_elegance_core_course_renderer extends core_course_renderer {

    protected function coursecat_coursebox_content(coursecat_helper $chelper, $course) {
        global $CFG;
        // if ($chelper->get_show_courses() < self::COURSECAT_SHOW_COURSES_EXPANDED) {
        //     return '';
        // }
        if ($course instanceof stdClass) {
            require_once($CFG->libdir. '/coursecatlib.php');
            $course = new course_in_list($course);
        }
        $content = '';

        // display course overview files
        $contentimages = $contentfiles = '';
        foreach ($course->get_course_overviewfiles() as $file) {
            $isimage = $file->is_valid_image();
            $url = file_encode_url("$CFG->wwwroot/pluginfile.php",
                    '/'. $file->get_contextid(). '/'. $file->get_component(). '/'.
                    $file->get_filearea(). $file->get_filepath(). $file->get_filename(), !$isimage);
            if ($isimage) {
                $contentimages .= html_writer::tag('div',
                        html_writer::empty_tag('img', array('src' => $url, 'alt' => 'Course Image '. $course->fullname)),
                        array('class' => 'courseimage'));
            } else {
                $image = $this->output->pix_icon(file_file_icon($file, 24), $file->get_filename(), 'moodle');
                $filename = html_writer::tag('span', $image, array('class' => 'fp-icon')).
                        html_writer::tag('span', $file->get_filename(), array('class' => 'fp-filename'));
                $contentfiles .= html_writer::tag('span',
                        html_writer::link($url, $filename),
                        array('class' => 'coursefile fp-filename-icon'));
            }
        }
        $content .= $contentimages. $contentfiles;

        // display course summary
        if ($course->has_summary()) {
            $content .= html_writer::start_tag('div', array('class' => 'summary'));
            $content .= $chelper->get_course_formatted_summary($course,
                    array('overflowdiv' => true, 'noclean' => true, 'para' => false));
            $content .= html_writer::end_tag('div'); // .summary
        }

        // display course contacts. See course_in_list::get_course_contacts()
        if ($course->has_course_contacts()) {
            $content .= html_writer::start_tag('ul', array('class' => 'teachers'));
            foreach ($course->get_course_contacts() as $userid => $coursecontact) {
                $name = $coursecontact['rolename'].': '.
                        html_writer::link(new moodle_url('/user/view.php',
                                array('id' => $userid, 'course' => SITEID)),
                            $coursecontact['username']);
                $content .= html_writer::tag('li', $name);
            }
            $content .= html_writer::end_tag('ul'); // .teachers
        }

        // display course category if necessary (for example in search results)
        if ($chelper->get_show_courses() == self::COURSECAT_SHOW_COURSES_EXPANDED_WITH_CAT) {
            require_once($CFG->libdir. '/coursecatlib.php');
            if ($cat = coursecat::get($course->category, IGNORE_MISSING)) {
                $content .= html_writer::start_tag('div', array('class' => 'coursecat'));
                $content .= get_string('category').': '.
                        html_writer::link(new moodle_url('/course/index.php', array('categoryid' => $cat->id)),
                                $cat->get_formatted_name(), array('class' => $cat->visible ? '' : 'dimmed'));
                $content .= html_writer::end_tag('div'); // .coursecat
            }
        }

        $content .= html_writer::tag('div', '', array('class' => 'boxfooter')); // .coursecat

        return $content;
    }

    public function course_search_form($value = '', $format = 'plain') {
        static $count = 0;
        $formid = 'coursesearch';
        if ((++$count) > 1) {
            $formid .= $count;
        }
        $inputid = 'coursesearchbox';
        $inputsize = 30;

        if ($format === 'navbar') {
            $formid = 'coursesearchnavbar';
            $inputid = 'navsearchbox';
        }

        $strsearchcourses = get_string("searchcourses");
        $searchurl = new moodle_url('/course/search.php');

        $form = array('id' => $formid, 'action' => $searchurl, 'method' => 'get', 'class' => "form-inline", 'role' => 'form');
        $output = html_writer::start_tag('form', $form);
        $output .= html_writer::start_div('form-group');
        $output .= html_writer::tag('label', $strsearchcourses, array('for' => $inputid, 'class' => 'sr-only'));
        $search = array('type' => 'text', 'id' => $inputid, 'size' => $inputsize, 'name' => 'search',
                        'class' => 'form-control', 'value' => s($value), 'placeholder' => $strsearchcourses);
        $output .= html_writer::empty_tag('input', $search);
        $output .= html_writer::end_div(); // Close form-group.
        $button = array('type' => 'submit', 'class' => 'btn btn-default');
        $output .= html_writer::tag('button', get_string('go'), $button);
        $output .= html_writer::end_tag('form');

        return $output;
    }
}

function theme_elegance_get_nav_links($course, $sections, $sectionno) {
  // FIXME: This is really evil and should by using the navigation API.
  $courseformat = course_get_format($course);
  $course = $courseformat->get_course();
  $previousarrow= '<i class="nav_icon fa fa-chevron-circle-left"></i>';
  $nextarrow= '<i class="nav_icon fa fa-chevron-circle-right"></i>';
  $canviewhidden = has_capability('moodle/course:viewhiddensections', context_course::instance($course->id))
    or !$course->hiddensections;

  $links = array('previous' => '', 'next' => '');
  $back = $sectionno - 1;
  while ($back > 0 and empty($links['previous'])) {
    if ($canviewhidden || $sections[$back]->uservisible) {
      $params = array('id' => 'previous_section');
      if (!$sections[$back]->visible) {
        $params = array('id' => 'previous_section', 'class' => 'dimmed_text');
      }
      $previouslink = $previousarrow;
      $previouslink .= html_writer::start_tag('span', array('class' => 'text'));
      $previouslink .= html_writer::start_tag('span', array('class' => 'nav_guide'));
      $previouslink .= get_string('previoussection', 'theme_elegance');
      $previouslink .= html_writer::end_tag('span');
      $previouslink .= html_writer::empty_tag('br');
      $previouslink .= $courseformat->get_section_name($sections[$back]);
      $previouslink .= html_writer::end_tag('span');
      $links['previous'] = html_writer::link(course_get_url($course, $back), $previouslink, $params);
    }
    $back--;
  }

  $forward = $sectionno + 1;
  while ($forward <= $course->numsections and empty($links['next'])) {
    if ($canviewhidden || $sections[$forward]->uservisible) {
      $params = array('id' => 'next_section');
      if (!$sections[$forward]->visible) {
        $params = array('id' => 'next_section', 'class' => 'dimmed_text');
      }
      $nextlink = $nextarrow;
      $nextlink .= html_writer::start_tag('span', array('class' => 'text'));
      $nextlink .= html_writer::start_tag('span', array('class' => 'nav_guide'));
      $nextlink .= get_string('nextsection', 'theme_elegance');
      $nextlink .= html_writer::end_tag('span');
      $nextlink .= html_writer::empty_tag('br');
      $nextlink .= $courseformat->get_section_name($sections[$forward]);
      $nextlink .= html_writer::end_tag('span');
      $links['next'] = html_writer::link(course_get_url($course, $forward), $nextlink, $params);
    }
    $forward++;
  }

  return $links;
}
