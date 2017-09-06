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
			if ($content ['nm'] ['action'] == 'delete')
			{
				$this->bo->delete_employee_by_id ($content ['nm'] ['selected'] [0]);
			}
			if ($content ['nm'] ['action'] == 'select')
			{
				$data = $this->bo->read_employee ($content ['nm'] ['selected'] [0]);
				$content ['select'] = $data;
				$content ['change'] = $data;
			}
			
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
		}
		else
		{
			$content = array();
		}
		
		$selection_options = array(
				'change' => array(
						'dep_id' => $departments
				)
		);
		
		$this->init_nextmatch ($content);
		
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

	function init_nextmatch(&$content)
	{
		$nm_settings = array(
				'get_rows' => 'helloworld.helloworld_so.get_employees_nm',
				'filter_label' => '',
				'filter_help' => '',
				'no_filter' => True,
				'no_filter2' => True,
				'no_cat' => True,
				'lettersearch' => False,
				'searchletter' => '',
				'start' => 0,
				'order' => 'sname',
				'sort' => 'ASC',
				'col_filter' => array(),
				'row_id' => 'emp_id'
		);
		
		$nm_settings ['actions'] = array(
				'select' => array(
						'caption' => 'Select',
						'default' => true,
						'group' => 1,
						'allowOnMultiple' => false,
						'nm_action' => 'submit'
				),
				'delete' => array(
						'caption' => 'Delete',
						'default' => false,
						'group' => 1,
						'allowOnMultiple' => false,
						'nm_action' => 'submit'
				)
		);
		
		if (is_array ($content ['nm']))
		{
			$content ['nm'] = array_merge ($content ['nm'], $nm_settings);
		}
		else
		{
			$content ['nm'] = $nm_settings;
		}
	}
}