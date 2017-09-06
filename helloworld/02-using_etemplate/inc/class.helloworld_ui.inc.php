<?php

class helloworld_ui
{
	public $public_functions = array(
			'index' => true
	);
	private $departments;

	function __construct()
	{
		$this->departments = array(
				'Human Resources',
				'Marketing',
				'Tech Support',
				'Sales',
				'Management'
		);
		
		$GLOBALS ['egw_info'] ['flags'] ['app_header'] = 'Enter your position.';
	}

	function index($content = null)
	{
		if (is_array ($content))
		{
			$content ['debug'] =
				"Hello " . $content ['fname'] . " " . $content ['sname'] .
				". You are working as " . $content ['position'] .
				" in " . $this->departments [$content ['dep_id']] . ".\n";
		}
		else
		{
			$content = array();
		}
		
		$selection_options = array(
				'dep_id' => $this->departments
		);
		
		$tmpl = new etemplate_new ('helloworld.index');
		$tmpl->exec ('helloworld.helloworld_ui.index', $content, $selection_options);
	}
}