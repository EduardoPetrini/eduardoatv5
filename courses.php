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
require(__DIR__ . '/../../config.php');
require_once($CFG->libdir . '/adminlib.php');

admin_externalpage_setup('reporteduardoatv5', '', null, '', array('pagelayout' => 'report'));

echo $OUTPUT->header();
echo $OUTPUT->heading(get_string('pluginname',  'report_eduardoatv5'));

/**
 * Recupera o parâmetro recebido na requisição usando 'optional_param'
 */
$categoryId = optional_param('categoryId', 1, PARAM_INT);

/**
 * Acessando o banco de dados para buscar todos os courses da categoria parametrizada
 * Salva em uma varíavel (array)
 */
$courses = $DB->get_records('course', array('category' => $categoryId, 'visible' => '1'), 'shortname');

/**
 * Instancia-se a tabela
 * configura o tamanho das colunas e os headers
 */
$table = new html_table();
$table->head = array(
    get_string('col_coursename', 'report_eduardoatv5')
);

/**
 * Para cada categoria, conta-se quantos courses visíveis existem
 */
foreach ($courses as $course) {
    $table->data[] = array(html_writer::link(
        $CFG->wwwroot . '/course/view.php?id=' . $course->id,
        $course->shortname
    ));
}

/**
 * Renderiza a tabela na tela
 */
echo html_writer::table($table);
echo html_writer::link(
    $CFG->wwwroot . '/report/eduardoatv5/index.php',
    get_string('link_back', 'report_eduardoatv5')
);

echo $OUTPUT->footer();
