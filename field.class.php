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
 * @package    datafield
 * @subpackage linkedcheckbox
 * @copyright  2015 onwards Andrew Hancox (andrewdchancox@googlemail.com)
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

require_once($CFG->dirroot . '/mod/data/field/checkbox/field.class.php');

class data_field_linkedcheckbox extends data_field_checkbox {

    public $type = 'linkedcheckbox';

    public function display_browse_field($recordid, $template) {
        global $DB, $CFG;

        if ($content = $DB->get_record('data_content', array('fieldid'=>$this->field->id, 'recordid'=>$recordid))) {
            if (empty($content->content)) {
                return false;
            }

            $options = explode("\n", $this->field->param1);
            $options = array_map('trim', $options);

            $contentarray = explode('##', $content->content);
            $str = '';
            foreach ($contentarray as $line) {
                if (!in_array($line, $options)) {
                    // Somebody edited the field definition.
                    continue;
                }

                $params =  array(
                    "f_{$this->field->id}[]" => $line,
                    'd' => $this->data->id,
                    'advanced' => 1
                );
                $url = new moodle_url('/mod/data/view.php', $params);
                $link = html_writer::link($url, $line);

                $str .= $link . "<br />\n";
            }
            return $str;
        }
        return false;
    }

    /**
     * Prints the respective type icon
     *
     * @global object
     * @return string
     */
    function image() {
        global $OUTPUT;

        $params = array('d' => $this->data->id, 'fid' => $this->field->id, 'mode' => 'display', 'sesskey' => sesskey());
        $link = new moodle_url('/mod/data/field.php', $params);
        $str = '<a href="' . $link->out() . '">';
        $str .= $OUTPUT->pix_icon('linkedcheckbox', 'linkedcheckbox', 'datafield_linkedcheckbox');
        $str .= '</a>';
        return $str;
    }
}

