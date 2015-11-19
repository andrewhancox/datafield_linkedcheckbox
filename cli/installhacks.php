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

define('CLI_SCRIPT', true);

require(__DIR__.'/../../../../../config.php');
require_once($CFG->libdir.'/clilib.php');

$targettextfile = $CFG->dirroot . '/mod/data/lang/en/data.php';
$targetcontents = file_get_contents($targettextfile);
$sourcetextfile = $CFG->dirroot . '/mod/data/field/linkedcheckbox/cli/resources/lang_en_data.php';
$sourcecontents = file_get_contents($sourcetextfile);
if (!strpos($targetcontents, $sourcecontents)) {
    $file = fopen($targettextfile, "w");
    fwrite($file, $targetcontents . $sourcecontents);
    fclose($file);
} else {
    fwrite(STDERR, "Language string already exists\n");
}