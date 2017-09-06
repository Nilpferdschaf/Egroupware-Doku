<?php

class helloworld_ui
{
	public $public_functions = array(
			'index' => true,
			'db_controls' => true
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
			$content ['debug'] = '';
			$this->bo->insert_employee ($content ['fname'], $content ['sname'], $content ['position'], $content ['dep_id']);
			
			$content ['debug'] .= "\nHello " . $content ['fname'] . " " . $content ['sname'] . ". You are working as " . $content ['position'] . " in " . $departments [$content ['dep_id']] . ".";
		}
		else
		{
			$content = array();
		}
		
		$selection_options = array(
				'dep_id' => $departments
		);
		
		$tmpl = new etemplate_new ('helloworld.index');
		$tmpl->exec ('helloworld.helloworld_ui.index', $content, $selection_options);
	}

	function db_controls($content = null)
	{
		$departments = $this->bo->get_department_names ();
		if (is_array ($content))
		{
			$select = $content ['select'];
			$change = $content ['change'];
			if ($content ['delete'] == 'pressed')
			{
				if ($this->bo->delete_employee ($select ['fname'], $select ['sname']))
				{
					$content ['debug'] .= $select ['fname'] . " " . $select ['sname'] . " was removed.";
				}
			}
			if ($content ['modify'] == 'pressed')
			{
				if ($this->bo->update_employee ($select ['fname'], $select ['sname'], $change ['fname'], $change ['sname'], $change ['position'], $change ['dep_id']))
				{
					$content ['debug'] .= $select ['fname'] . " " . $select ['sname'] . " was changed.";
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
				'change' => array(
						'dep_id' => $departments
				)
		);
		
		$tmpl = new etemplate_new ('helloworld.db_controls');
		$tmpl->exec ('helloworld.helloworld_ui.db_controls', $content, $selection_options);
	}

	function sidebox_menu()
	{
		$appname = 'helloworld';
		$title = "Links";
		
		$items = array();
		$items ['Input name and position'] = egw::link ('/index.php', array(
				'menuaction' => 'helloworld.helloworld_ui.index'
		));
		if ($GLOBALS ['egw_info'] ['user'] ['apps'] ['admin'])
		{
			$items ['Database controls'] = egw::link ('/index.php', array(
					'menuaction' => 'helloworld.helloworld_ui.db_controls'
			));
		}
		
		display_sidebox ($appname, $title, $items);
		$title2 = "HTML";
		$items2 = array(
				array(
						'text' => '<br>Not a link',
						'nolang' => true,
						'link' => false,
						'icon' => false
				),
				array(
						'text' => '<br><br><label>
				<input type="checkbox">HTML object
			</label>',
						'nolang' => true,
						'link' => false,
						'icon' => false
				),
				array(
						'text' => '<br><br><table>' . '<tr><th>More</th><th>HTML</th></tr>' . '<tr><td>1</td><td>2</td></tr>' . '<tr><td>3</td><td>4</td></tr>' . '</table>',
						'nolang' => true,
						'link' => false,
						'icon' => false
				)
		);
		
		$fav_instrument = $GLOBALS ['egw']->preferences->data ['helloworld'] ['favourite_instrument'];
		
		$items2 [] = array(
				'text' => "<br>Favourite Instrument: $fav_instrument",
				'nolang' => true,
				'link' => false,
				'icon' => false
		);
		display_sidebox ($appname, $title2, $items2);
	}
}