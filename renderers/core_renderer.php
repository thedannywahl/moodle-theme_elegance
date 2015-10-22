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
 

class theme_elegance_core_renderer extends theme_bootstrap_core_renderer {


    public function render_custom_menu_item(custom_menu_item $menunode, $level = 0, $direction = '') {
        return theme_bootstrap_core_renderer::render_custom_menu_item($menunode, $level, $direction);
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
            't/left' => 'arrow-left',
            't/move' => 'resize-vertical',
            't/right' => 'arrow-right',
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

        /**
     * Produces a header for a block
     *
     * @param block_contents $bc
     * @return string
     */
    protected function block_header(block_contents $bc) {

        $title = '';
        if ($bc->title) {
            $attributes = array();
            if ($bc->blockinstanceid) {
                $attributes['id'] = 'instance-'.$bc->blockinstanceid.'-header';
            }
            $title = html_writer::tag('h2', $bc->title, $attributes);
            $title .= html_writer::empty_tag('hr', array('class' => 'star-primary'));
        }

        $blockid = null;
        if (isset($bc->attributes['id'])) {
            $blockid = $bc->attributes['id'];
        }
        $controlshtml = $this->block_controls($bc->controls, $blockid);

        $output = '';
        if ($title || $controlshtml) {
            $output .= html_writer::tag('div', html_writer::tag('div', html_writer::tag('div', '', array('class'=>'block_action')). $title . $controlshtml, array('class' => 'title')), array('class' => 'header'));
        }
        return $output;
    }
}