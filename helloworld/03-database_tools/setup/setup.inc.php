<?php
$setup_info ['helloworld'] = array(
		'name' => 'helloworld',
		'title' => 'Hello World',
		'version' => '0.002',
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
);	$setup_info['helloworld']['tables'] = array('departments','employees');
