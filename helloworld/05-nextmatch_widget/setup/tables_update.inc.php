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

function helloworld_upgrade0_001()
{
	$GLOBALS['egw_setup']->oProc->CreateTable('employees',array(
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
	));

	return $GLOBALS['setup_info']['helloworld']['currentver'] = '0.002';
}

function helloworld_upgrade0_002()
{
	return $GLOBALS['setup_info']['helloworld']['currentver'] = '0.003';
}

function helloworld_upgrade0_003()
{
	return $GLOBALS['setup_info']['helloworld']['currentver'] = '0.004';
}

function helloworld_upgrade0_004()
{
	return $GLOBALS['setup_info']['helloworld']['currentver'] = '0.005';
}
