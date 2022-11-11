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
 * @package datafield_linkedcheckbox
 * @author Andrew Hancox <andrewdchancox@googlemail.com>
 * @author Open Source Learning <enquiries@opensourcelearning.co.uk>
 * @link https://opensourcelearning.co.uk
 * @license http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 * @copyright 2021, Andrew Hancox
 */

defined('MOODLE_INTERNAL') || die();

// We need to override the core_course_get_module web service function so that when the activity
// is moved the correct renderer gets used to re-insert into the DOM.
function datafield_linkedcheckbox_override_webservice_execution($externalfunctioninfo, $params) {
    if (is_string($externalfunctioninfo->name) && strpos($externalfunctioninfo->name, 'mod_data') === false) {
        return false;
    }

    $callable = array($externalfunctioninfo->classname, $externalfunctioninfo->methodname);
    $result = call_user_func_array($callable, $params);

    $callbacks = get_plugins_with_function('recursivestrreplace');
    foreach ($callbacks as $plugintype => $plugins) {
        foreach ($plugins as $plugin => $callback) {
            $callback($result);
        }
    }

    return $result;
}

function datafield_linkedcheckbox_recursivestrreplace(&$obj) {
    foreach ($obj as $key => $value) {
        if (is_string($value)) {
            $obj->$key = str_replace('linkedcheckbox', 'checkbox', $value);
        } else if (is_iterable($value)) {
            datafield_linkedcheckbox_recursivestrreplace($value);
        }
    }
}
