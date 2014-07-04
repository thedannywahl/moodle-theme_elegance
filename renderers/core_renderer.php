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

defined('MOODLE_INTERNAL') || die();

/**
 * Renderers to align Moodle's HTML with that expected by Bootstrap
 *
 * @package    theme_elegance
 * @copyright  2012
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
 
include_once($CFG->dirroot . "/theme/bootstrap/renderers/core_renderer.php");

class theme_elegance_core_renderer extends theme_bootstrap_core_renderer {

    public function navbar() {
        $breadcrumbs = '';
        foreach ($this->page->navbar->get_items() as $item) {
            $item->hideicon = true;
            $breadcrumbs .= '<li>'.$this->render($item).'</li>';
        }
        return "<ol class=breadcrumb>$breadcrumbs</ol>";
    }

    protected function render_custom_menu(custom_menu $menu) {
        global $CFG, $USER;

        // TODO: eliminate this duplicated logic, it belongs in core, not
        // here. See MDL-39565.

        $content = '<ul class="nav navbar-nav">';
        foreach ($menu->get_children() as $item) {
            $content .= $this->render_custom_menu_item($item, 1);
        }

        return $content.'</ul>';
    }
    
    protected function render_custom_menu_item(custom_menu_item $menunode, $level = 0 ) {
        static $submenucount = 0;

        if ($menunode->has_children()) {

            if ($level == 1) {
                $dropdowntype = 'dropdown';
            } else {
                $dropdowntype = 'dropdown-submenu';
            }

            $content = html_writer::start_tag('li', array('class' => $dropdowntype));
            // If the child has menus render it as a sub menu.
            $submenucount++;
            if ($menunode->get_url() !== null) {
                $url = $menunode->get_url();
            } else {
                $url = '#cm_submenu_'.$submenucount;
            }
            $linkattributes = array(
                'href' => $url,
                'class' => 'dropdown-toggle',
                'data-toggle' => 'dropdown',
                'title' => $menunode->get_title(),
            );
            $content .= html_writer::start_tag('a', $linkattributes);
            $content .= $menunode->get_text();
            if ($level == 1) {
                $content .= '<b class="caret"></b>';
            }
            $content .= '</a>';
            $content .= '<ul class="dropdown-menu">';
            foreach ($menunode->get_children() as $menunode) {
                $content .= $this->render_custom_menu_item($menunode, 0);
            }
            $content .= '</ul>';
        } else {
            $content = '<li>';
            // The node doesn't have children so produce a final menuitem.
            if ($menunode->get_url() !== null) {
                $url = $menunode->get_url();
            } else {
                $url = '#';
            }
            $content .= html_writer::link($url, $menunode->get_text(), array('title' => $menunode->get_title()));
        }
        return $content;
    }

    public function user_menu() {
        global $CFG;
        $usermenu = new custom_menu('', current_language());
        return $this->render_user_menu($usermenu);
    }

    protected function render_user_menu(custom_menu $menu) {
        global $CFG, $USER, $DB, $PAGE; //Elegance add $PAGE;

        $addusermenu = true;
        $addlangmenu = true;
        $addmessagemenu = true;

        //Elegance add Check for messaging start
        if (!$CFG->messaging) {
          $addmessagemenu = false;
        } else {
          // Check whether or not the "popup" message output is enabled
          // This is after we check if messaging is enabled to possibly save a DB query
          $popup = $DB->get_record('message_processors', array('name'=>'popup'));
          if(!$popup) {
            $addmessagemenu = false;
          }
        }
        //Elegance add Check for messaging end

        if (!isloggedin() || isguestuser()) {
            $addmessagemenu = false;
        }

        if ($addmessagemenu) {
            $messages = $this->get_user_messages();
            $messagecount = 0;
            foreach ($messages as $message) {
                if (!$message->from) { // Workaround for issue #103.
                    continue;
                }
                $messagecount++;
            }
            $messagemenutext = $messagecount . ' ';
            if ($messagecount == 1) {
                 $messagemenutext .= get_string('message', 'message');
            } else {
                 $messagemenutext .= get_string('messages', 'message');
            }
            $messagemenu = $menu->add(
                $messagemenutext,
                new moodle_url('/message/index.php', array('viewing' => 'recentconversations')),
                get_string('messages', 'message'),
                9999
            );
            foreach ($messages as $message) {
                if (!$message->from) { // Workaround for issue #103.
                    continue;
                }
                $senderpicture = new user_picture($message->from);
                $senderpicture->link = false;
                $senderpicture = $this->render($senderpicture);

                $messagecontent = $senderpicture;
                $messagecontent .= html_writer::start_span('msg-body');
                $messagecontent .= html_writer::start_span('msg-title');
                $messagecontent .= html_writer::span($message->from->firstname . ': ', 'msg-sender');
                $messagecontent .= $message->text;
                $messagecontent .= html_writer::end_span();
                $messagecontent .= html_writer::start_span('msg-time');
                $messagecontent .= html_writer::tag('i', '', array('class' => 'icon-time'));
                $messagecontent .= html_writer::span($message->date);
                $messagecontent .= html_writer::end_span();

                $messageurl = new moodle_url('/message/index.php', array('user1' => $USER->id, 'user2' => $message->from->id));
                $messagemenu->add($messagecontent, $messageurl, $message->text);
            }
        }

        $langs = get_string_manager()->get_list_of_translations();
        if (count($langs) < 2
        or empty($CFG->langmenu)
        or ($this->page->course != SITEID and !empty($this->page->course->lang))) {
            $addlangmenu = false;
        }

        if ($addlangmenu) {
            $language = $menu->add(get_string('language'), new moodle_url('#'), get_string('language'), 10000);
            foreach ($langs as $langtype => $langname) {
                $language->add($langname, new moodle_url($this->page->url, array('lang' => $langtype)), $langname);
            }
        }

        if ($addusermenu) {
            if (isloggedin()) {
                $usermenu = $menu->add(
                  //Elegance custom line start
                  '<i class="fa fa-user"></i>' .
                  //Elegance custom line end
                  fullname($USER), new moodle_url('#'), fullname($USER), 10001
                );

                if (!empty($PAGE->theme->settings->enablemy)) {
                  $usermenu->add(
                    '<i class="fa fa-briefcase"></i>' . get_string('mydashboard','theme_elegance'),
                    new moodle_url('/my', array('id'=>$USER->id)),
                    get_string('mydashboard','theme_elegance')
                  );
                }

                if (!empty($PAGE->theme->settings->enableprofile)) {
                  $usermenu->add(
                    '<i class="fa fa-user"></i>' . get_string('viewprofile'),
                    new moodle_url('/user/profile.php', array('id' => $USER->id)),
                    get_string('viewprofile')
                  );
                }

                if (!empty($PAGE->theme->settings->enableeditprofile)) {
                  $usermenu->add(
                    '<i class="fa fa-cog"></i>' . get_string('editmyprofile'),
                    new moodle_url('/user/edit.php', array('id' => $USER->id)),
                    get_string('editmyprofile')
                  );
                }

                if (!empty($PAGE->theme->settings->enableprivatefiles)) {
                  $usermenu->add(
                    '<i class="fa fa-file"></i>' . get_string('privatefiles', 'block_private_files'),
                    new moodle_url('/user/files.php', array('id' => $USER->id)),
                    get_string('privatefiles', 'block_private_files')
                  );
                }

                if (!empty($PAGE->theme->settings->enablebadges)) {
                  $usermenu->add(
                    '<i class="fa fa-certificate"></i>' . get_string('badges'),
                    new moodle_url('/badges/mybadges.php', array('id' => $USER->id)),
                    get_string('badges')
                  );
              }

                if (!empty($PAGE->theme->settings->enablecalendar)) {
                  $usermenu->add(
                    '<i class="fa fa-calendar"></i>' . get_string('pluginname', 'block_calendar_month'),
                    new moodle_url('/calendar/view.php', array('id' => $USER->id)),
                    get_string('pluginname', 'block_calendar_month')
                  );
                }

                // Add custom links to menu
                $customlinksnum = (empty($PAGE->theme->settings->usermenulinks)) ? false : $PAGE->theme->settings->usermenulinks;
                if ($customlinksnum !=0) {
                    foreach (range(1, $customlinksnum) as $customlinksnumber) {
                        $cli = "customlinkicon$customlinksnumber";
                        if(!empty($PAGE->theme->settings->$cli)) {
                            $cli = '<i class="fa fa-'. $PAGE->theme->settings->$cli . '"></i>';
                        } else {
                            $cli = '';
                        }
                        $cln = "customlinkname$customlinksnumber";
                        $clu = "customlinkurl$customlinksnumber";

                        if (!empty($PAGE->theme->settings->$cln) && !empty($PAGE->theme->settings->$clu)) {
                            $usermenu->add(
                                $cli . $PAGE->theme->settings->$cln,
                                new moodle_url($PAGE->theme->settings->$clu),
                                $PAGE->theme->settings->$cln
                            );
                        }
                    }
                }

                $usermenu->add(
                    '<i class="fa fa-lock"></i>' . get_string('logout'),
                    new moodle_url('/login/logout.php', array('sesskey' => sesskey(), 'alt' => 'logout')),
                    get_string('logout')
                );

            } else {
                $usermenu = $menu->add(
                  '<i class="fa fa-key"></i>' . get_string('login'),
                  new moodle_url('/login/index.php'), get_string('login'), 10001
                );
            }
        }

        $content = '<ul class="nav navbar-nav navbar-right">';
        foreach ($menu->get_children() as $item) {
            $content .= $this->render_custom_menu_item($item, 1);
        }

        return $content.'</ul>';
    }

    protected function process_user_messages() {

        $messagelist = array();

        foreach ($usermessages as $message) {
            $cleanmsg = new stdClass();
            $cleanmsg->from = fullname($message);
            $cleanmsg->msguserid = $message->id;

            $userpicture = new user_picture($message);
            $userpicture->link = false;
            $picture = $this->render($userpicture);

            $cleanmsg->text = $picture . ' ' . $cleanmsg->text;

            $messagelist[] = $cleanmsg;
        }

        return $messagelist;
    }

    protected function get_user_messages() {
        global $USER, $DB;
        $messagelist = array();

        $newmessagesql = "SELECT id, smallmessage, useridfrom, useridto, timecreated, fullmessageformat, notification
                            FROM {message}
                           WHERE useridto = :userid";

        $newmessages = $DB->get_records_sql($newmessagesql, array('userid' => $USER->id));

        foreach ($newmessages as $message) {
            $messagelist[] = $this->bootstrap_process_message($message);
        }

        $showoldmessages = (empty($this->page->theme->settings->showoldmessages)) ? 0 : $this->page->theme->settings->showoldmessages;
        if ($showoldmessages) {
            $maxmessages = 5;
            $readmessagesql = "SELECT id, smallmessage, useridfrom, useridto, timecreated, fullmessageformat, notification
                                 FROM {message_read}
                                WHERE useridto = :userid
                             ORDER BY timecreated DESC
                                LIMIT $maxmessages";

            $readmessages = $DB->get_records_sql($readmessagesql, array('userid' => $USER->id));

            foreach ($readmessages as $message) {
                $messagelist[] = $this->bootstrap_process_message($message);
            }
        }

        return $messagelist;
    }

    protected function bootstrap_process_message($message) {
        global $DB;
        $messagecontent = new stdClass();

        if ($message->notification) {
            $messagecontent->text = get_string('unreadnewnotification', 'message');
        } else {
            if ($message->fullmessageformat == FORMAT_HTML) {
                $message->smallmessage = html_to_text($message->smallmessage);
            }
            if (core_text::strlen($message->smallmessage) > 15) {
                $messagecontent->text = core_text::substr($message->smallmessage, 0, 15).'...';
            } else {
                $messagecontent->text = $message->smallmessage;
            }
        }

        if ((time() - $message->timecreated ) <= (3600 * 3)) {
            $messagecontent->date = format_time(time() - $message->timecreated);
        } else {
            $messagecontent->date = userdate($message->timecreated, get_string('strftimetime', 'langconfig'));
        }

        $messagecontent->from = $DB->get_record('user', array('id' => $message->useridfrom));
        return $messagecontent;
    }

    protected function render_pix_icon(pix_icon $icon) {
        if ($this->page->theme->settings->fonticons === '1'
            && $icon->attributes["alt"] === ''
            && $this->replace_moodle_icon($icon->pix) !== false) {
            return $this->replace_moodle_icon($icon->pix);
        }
        return parent::render_pix_icon($icon);
    }

    protected function replace_moodle_icon($name) {
        $icons = array(
            'add' => 'plus',
            'book' => 'book',
            'chapter' => 'file',
            'docs' => 'question-sign',
            'generate' => 'gift',
            'i/backup' => 'download',
            't/backup' => 'download',
            'i/checkpermissions' => 'user',
            'i/edit' => 'pencil',
            'i/filter' => 'filter',
            'i/grades' => 'grades',
            'i/group' => 'user',
            'i/hide' => 'eye-open',
            'i/import' => 'upload',
            'i/info' => 'info',
            'i/move_2d' => 'move',
            'i/navigationitem' => 'chevron-right',
            'i/publish' => 'globe',
            'i/reload' => 'refresh',
            'i/report' => 'list-alt',
            'i/restore' => 'upload',
            't/restore' => 'upload',
            'i/return' => 'repeat',
            'i/roles' => 'user',
            'i/settings' => 'cog',
            'i/show' => 'eye-close',
            'i/switchrole' => 'user',
            'i/user' => 'user',
            'i/users' => 'user',
            'spacer' => 'spacer',
            't/add' => 'plus',
            't/assignroles' => 'user',
            't/copy' => 'plus-sign',
            't/delete' => 'remove',
            't/down' => 'arrow-down',
            't/edit' => 'edit',
            't/editstring' => 'tag',
            't/hide' => 'eye-open',
            't/left' => 'arrow-left',
            't/move' => 'resize-vertical',
            't/right' => 'arrow-right',
            't/show' => 'eye-close',
            't/switch_minus' => 'minus-sign',
            't/switch_plus' => 'plus-sign',
            't/up' => 'arrow-up',
        );
        if (isset($icons[$name])) {
            return '<span class="glyphicon glyphicon-'.$icons[$name].'"></span> ';
        } else {
            return false;
        }
    }
}