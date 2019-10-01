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
 * Report main page
 *
 * @package    report
 * @copyright  2019 Paulo Jr
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
require __DIR__ . '/../../config.php';
require_once $CFG->libdir . '/adminlib.php';

admin_externalpage_setup('reporteduardoatv5', '', null, '', array('pagelayout' => 'report'));

echo $OUTPUT->header();
echo $OUTPUT->heading(get_string('pluginname', 'report_eduardoatv5'));

$categories = $DB->get_records('course_categories', null, 'name');

$table = new html_table();
$table->size = array('85%', '15%');
$table->head = array(
    get_string('col_catname', 'report_eduardoatv5'),
    get_string('col_numofcourses', 'report_eduardoatv5')
);

foreach ($categories as $cat) {
    $numofcourses = $DB->count_records(
        'course',
        array('visible' => '1', 'category' => $cat->id)
    );

    $table->data[] = array(
        html_writer::link(
            $CFG->wwwroot . '/report/eduardoatv5/courses.php?categoryId=' . $cat->id,
            $cat->name
        ),
        $numofcourses
    );
}

echo html_writer::table($table);

echo $OUTPUT->footer();
