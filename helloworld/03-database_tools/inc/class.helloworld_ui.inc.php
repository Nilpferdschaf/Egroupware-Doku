<?php

class helloworld_ui
{
	public $public_functions = array(
			'index' => true
	);
	private $bo;

	function __construct()
	{
		$this->bo = new helloworld_bo ();
		
		$GLOBALS ['egw_info'] ['flags'] ['app_header'] = 'Enter your position.';
	}

	function index($content = null)
	{
		$departments = $this->bo->get_department_names ();
		if (is_array ($content))
		{
			$select = $content ['select'];
			$change = $content ['change'];
			
			$content ['debug'] = '';
			if ($content ['submit'] == 'pressed')
			{
				$this->bo->insert_employee ($content ['fname'], $content ['sname'], $content ['position'], $content ['dep_id']);
				$content ['debug'] .= "Hello " . $content ['fname'] . " " . $content ['sname'] . ". You are working as " . $content ['position'] . " in " . $departments [$content ['dep_id']] . ".\n\n";
			}
			if ($content ['delete'] == 'pressed')
			{
				if ($this->bo->delete_employee ($select ['fname'], $select ['sname']))
				{
					$content ['debug'] .= $select ['fname'] . " " . $select ['sname'] . " was removed.\n\n";
				}
			}
			if ($content ['modify'] == 'pressed')
			{
				if ($this->bo->update_employee ($select ['fname'], $select ['sname'], $change ['fname'], $change ['sname'], $change ['position'], $change ['dep_id']))
				{
					$content ['debug'] .= $select ['fname'] . " " . $select ['sname'] . " was changed.\n\n";
				}
			}
			$content ['debug'] .= $this->bo->get_formatted_employee_list ();
		}
		else
		{
			$content = array();
			$content ['debug'] = $this->bo->get_formatted_employee_list ();
		}
		
		$selection_options = array(
				'dep_id' => $departments,
				'change' => array(
						'dep_id' => $departments
				)
		);
		
		$tmpl = new etemplate_new ('helloworld.index');
		$tmpl->exec ('helloworld.helloworld_ui.index', $content, $selection_options);
	}
}