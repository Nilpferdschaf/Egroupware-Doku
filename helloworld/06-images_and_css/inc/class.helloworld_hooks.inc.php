<?php

class helloworld_hooks
{

	static function settings()
	{
		$sel_options = array(
				'a' => 'A',
				'b' => 'B',
				'c' => 'C'
		);
		$multi_sel_options = array(
				'1' => '1',
				'2' => '2',
				'3' => '3'
		);
		
		$prefs = array();
		$prefs ['section 1'] = array(
				'type' => 'section',
				'title' => 'Section 1',
				'no_lang' => true,
				'xmlrpc' => False,
				'admin' => False
		);
		$prefs ['selection'] = array(
				'type' => 'select',
				'label' => 'Favourite letter:',
				'name' => 'sel',
				'values' => $sel_options,
				'help' => 'This is a selection option',
				'xmlrpc' => True,
				'admin' => False,
				'default' => 'b'
		);
		$prefs ['multiselection'] = array(
				'type' => 'multiselect',
				'label' => 'Favourite number:',
				'name' => 'mulsel',
				'values' => $multi_sel_options,
				'help' => 'This is a multi selection option',
				'xmlrpc' => True,
				'admin' => False,
				'default' => '1,3'
		);
		$prefs ['section 2'] = array(
				'type' => 'section',
				'title' => 'Section 2',
				'no_lang' => true,
				'xmlrpc' => False,
				'admin' => False
		);
		$prefs ['text_input'] = array(
				'type' => 'input',
				'size' => 10,
				'label' => 'Favourite instrument:',
				'name' => 'favourite_instrument',
				'help' => 'This is a text input option',
				'default' => 'tuba',
				'xmlrpc' => True,
				'admin' => False
		);
		$prefs ['checkbox_option'] = array(
				'type' => 'check',
				'label' => 'Enable bugs',
				'name' => 'checkbox',
				'help' => 'This is a boolean option',
				'default' => 'false',
				'xmlrpc' => True,
				'admin' => False
		);
		
		return $prefs;
	}

	static function verify_settings($data)
	{
		if ($data ['prefs'] ['favourite_instrument'] == "mayonnaise")
		{
			egw_framework::message ("Mayonnaise is not an instrument", "error");
		}
		if ($data ['prefs'] ['favourite_instrument'] == "horseradish")
		{
			egw_framework::message ("Horseradish isn't an instrument either", "error");
		}
	}

	static function admin()
	{
		$items = Array(
				'Site Configuration' => egw::link ('/index.php', 'menuaction=admin.uiconfig.index&appname=helloworld'),
				'Custom fields' => egw::link ('/index.php', 'menuaction=admin.customfields.index&appname=helloworld'),
				'Global Categories' => egw::link ('/index.php', 'menuaction=admin.admin_categories.index&appname=helloworld'),
				'Main page' => egw::link ('/index.php', 'menuaction=helloworld.helloworld_ui.index')
		);
		display_section ('helloworld', 'Hello World', $items);
	}

	static function acl_rights($params)
	{
		return array(
				acl::READ => 'read data',
				acl::ADD => 'add data',
				acl::EDIT => 'edit data',
				acl::DELETE => 'delete data',
				acl::CUSTOM1 => 'sell data'
		);
	}

	static function categories()
	{
		return true;
	}
}