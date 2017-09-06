<?php
/**
 * eGroupWare - Setup
 * http://www.egroupware.org
 * Created by eTemplates DB-Tools written by ralfbecker@outdoor-training.de
 *
 * @license http://opensource.org/licenses/gpl-license.php GPL - GNU General Public License
 * @package helloworld
 * @subpackage setup
 * @version $Id$
 */


$phpgw_baseline = array(
	'departments' => array(
		'fd' => array(
			'dep_id' => array('type' => 'int','precision' => '4','nullable' => False),
			'dep_name' => array('type' => 'varchar','precision' => '255','nullable' => False)
		),
		'pk' => array('dep_id'),
		'fk' => array(),
		'ix' => array(),
		'uc' => array('dep_id','dep_name')
	),
	'employees' => array(
		'fd' => array(
			'emp_id' => array('type' => 'int','precision' => '4','nullable' => False),
			'fname' => array('type' => 'varchar','precision' => '255','nullable' => False),
			'sname' => array('type' => 'varchar','precision' => '255','nullable' => False),
			'position' => array('type' => 'varchar','precision' => '255','nullable' => False),
			'dep_id' => array('type' => 'int','precision' => '4','nullable' => False)
		),
		'pk' => array('emp_id'),
		'fk' => array(),
		'ix' => array(),
		'uc' => array('emp_id')
	)
);
