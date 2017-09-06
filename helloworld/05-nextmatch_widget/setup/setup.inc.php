<?php
$setup_info ['helloworld'] = array(
		'name' => 'helloworld',
		'title' => 'Hello World',
		'version' => '0.005',
		'description' => 'Hello World in EGroupware',
		'author' => 'Your name',
		'maintainer' => 'Your organisations name',
		'maintainer_email' => 'Your organisations email',
		'app_order' => 100,
		'enable' => 1,
		'autoinstall' => true,
		'license' => 'Your License'
);

$setup_info ['helloworld'] ['depends'] = array(
		array(
				'appname' => 'phpgwapi',
				'versions' => array(
						'14.1'
				)
		),
		array(
				'appname' => 'etemplate',
				'versions' => Array(
						'14.1'
				)
		)
);

$setup_info ['helloworld'] ['hooks'] = array(
		
		// Populate the sidebox menu
		'sidebox_menu' => "helloworld.helloworld_ui.sidebox_menu",
		
		// Create settings menu in EGroupwares settings link
		'settings' => "helloworld_hooks::settings",
		
		// Verify settings once user is done editing them
		'verify_settings' => "helloworld_hooks::verify_settings",
		
		// Access to the admin sidebox, where administration-settings can be changed
		'admin' => "helloworld_hooks::admin",
		
		// Access Control List. Determine who can do what.
		'acl_rights' => "helloworld_hooks::acl_rights",
		
		// If you want to use categories
		'categories' => "helloworld_hooks::categories",
		
		// What to do if a user account is deleted
		'deleteaccount' => "helloworld_hooks::deleteaccount"
);


$setup_info ['helloworld'] ['tables'] = array(
		'departments',
		'employees'
);
