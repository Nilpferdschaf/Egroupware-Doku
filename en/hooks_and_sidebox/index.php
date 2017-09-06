<?php
$back_link = "../database_tools";
$forw_link = "../nextmatch";
$back_text = "Database Tools";
$forw_text = "The NextMatch Widget";
$title = "Using hooks and accessing the sidebox";
?>

<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<link rel="stylesheet" type="text/css" href="../style.css">
<script type="text/javascript" src="../script.js"></script>
<title>Writing Apps for EGroupware: <?php echo $title;?></title>
</head>
<body id="top">
	<div class="navigation">
		<a class="prev" href="<?php echo $back_link;?>">&lt; <?php echo $back_text;?></a><a
			class="next" href="<?php echo $forw_link;?>"><?php echo $forw_text;?> &gt;</a>
	</div>
	<a class="back" href="../index.php">&lt;&lt; Back to Index</a>

	<h2>Using hooks and accessing the sidebox</h2>

	<h3>About hooks and registering them in EGroupware</h3>

	<p>Hooks are a software design pattern used to create an easy way to
		extend existing programs without knowing or editing their source code.
		An interface for registering new hooks has to be provided by the
		existing program. The hooks will then be called once necessary.
		EGroupware defines hooks for multiple purposes. You could, for
		example, use a hook to create a settings page which will show up under
		the "official" settings menu. You could also use it to populate the
		sidebox. This is especially helpful if you want to have multiple pages
		in your app and make navigating between them fast and easy. You will
		do all of these things in this tutorial.</p>


	<h3>Using the sidebox_menu hook</h3>

	<p>
		To register the sidebox hook, add the following line to the <span
			class="file">setup.inc.php</span> of your app.
	</p>

	<pre class="code">
$setup_info ['helloworld'] ['hooks'] = array(
	'sidebox_menu' => 'helloworld.helloworld_ui.sidebox_menu'
);</pre>

	<p>
		It tells EGroupware to call the function <span class="function">sidebox_menu</span>
		of class <span class="class">helloworld_ui</span> . From there you can
		then start populating the sidebox. To register this change with
		EGroupware, increase the version number of the app,
	</p>

	<pre class="code">'version' => '0.003',</pre>

	<p>
		then go to <span class="url">http://$your_domain/egroupware/setup/</span>,
		log in, click <span class="button">Manage applications</span> and
		upgrade helloworld.
	</p>

	<p>
		Now you need to add the function <span class="function">sidebox_menu</span>
		to <span class="file">class.helloworld_ui.inc.php</span>. It will
		create one menu containing two links and another containing some text,
		a checkbox and a table.
	</p>

	<pre class="code">
function sidebox_menu()
{
	$appname = 'helloworld';
	$title = "Links";
	$items = array(
		'Input name and position' =&gt; egw::link ('/index.php', array(
			'menuaction' =&gt; 'helloworld.helloworld_ui.index'
		)),
		'Database controls' =&gt; egw::link ('/index.php', array(
			'menuaction' =&gt; 'helloworld.helloworld_ui.db_controls'
		))
	);
	display_sidebox ($appname, $title, $items);
	$title2 = "HTML";
	$items2 = array(
		array(
			'text' =&gt; '&lt;br&gt;Not a link',
			'nolang' =&gt; true,
			'link' =&gt; false,
			'icon' =&gt; false
		),
		array(
			'text' =&gt;
			'&lt;br&gt;&lt;br&gt;&lt;label&gt;
				&lt;input type="checkbox"&gt;HTML object
			&lt;/label&gt;',
			'nolang' =&gt; true,
			'link' =&gt; false,
			'icon' =&gt; false
		),
		array(
			'text' =&gt; 
			'&lt;br&gt;&lt;br&gt;&lt;table&gt;' . 
				'&lt;tr&gt;&lt;th&gt;More&lt;/th&gt;&lt;th&gt;HTML&lt;/th&gt;&lt;/tr&gt;' . 
				'&lt;tr&gt;&lt;td&gt;1&lt;/td&gt;&lt;td&gt;2&lt;/td&gt;&lt;/tr&gt;' . 
				'&lt;tr&gt;&lt;td&gt;3&lt;/td&gt;&lt;td&gt;4&lt;/td&gt;&lt;/tr&gt;' . 
			'&lt;/table&gt;',
			'nolang' =&gt; true,
			'link' =&gt; false,
			'icon' =&gt; false
		)
	);
	display_sidebox ($appname, $title2, $items2);
}</pre>

	<p>
		<span class="function">display_sidebox</span> creates the menu. This
		function takes as parameters the name of you app, a <span class="var">$title</span>
		for the menu and an array <span class="var">$items</span> containing
		information about the content of the menu. Inside the array you can
		either have <span class="var">$key =&gt; $value</span> pairs or
		arrays. The <span class="var">$key =&gt; $value</span> pairs encode
		links, where <span class="var">$value</span> contains the hyperlink
		and <span class="var">$key</span> is the string shown in the sidebox.
	</p>

	<p>
		The arrays can encode any HTML you want by using the <span
			class="string">text</span> key. The corresponding value will be
		copied directly into the pages' HTML code. The other keys that can be
		used are <span class="string">nolang</span>, specifying wether
		EGroupware should try translating the value of <span class="string">text</span>,
		<span class="string">link</span> can be a url the item should link to
		and <span class="string">icon</span> can point to an image that will
		be displayed next to the item.
	</p>

	<p>
		Another new feature that is used in the sidebox code is the <span
			class="function">egw::link</span> function. It takes a string
		containing a base url and an array specifying <span class="var">$_GET</span>
		<span class="var">$key =&gt; $value</span> pairs. It will then return
		a link to the url with all the parameters concatenated to the end.
	</p>

	<p>
		As you can see, the second link points EGW to a function <span
			class="function">db_controls</span> inside <span class="class">helloworld_ui</span>.
		Go on and add this function. Do not forget to include the
		corresponding entry in <span class="var">$public_functions</span>.
	</p>

	<pre class="code">
public $public_functions = array(
		'index' => true,
		'db_controls' => true
);</pre>

	<pre class="code">
function db_controls()
{
	$tmpl = new Etemplate ('helloworld.db_controls');
	$tmpl->exec('helloworld.helloworld_ui.db_controls', array());
}</pre>

	<p>
		The code expects a template <span class="file">helloworld.db_controls</span>,
		so go to the eTemplate editor and create it. Add the controls for
		removing and editing entries in the database to this page and remove
		them from the index template.
	</p>

	<img src="img/16.7-update_index.png"
		alt="Updated helloworld.index template." />
	<img src="img/16.3-db_controls.png" alt="New helloworld.db_controls." />

	<p>
		Move the code that manipulates the database from <span
			class="function">index</span> to <span class="function">db_controls</span>.
	</p>

	<pre class="code">
function index($content = null)
{
	$departments = $this->bo->get_department_names ();
	if (is_array ($content))
	{
		$content ['debug'] = '';
		$this->bo->insert_employee 
		(
			$content ['fname'], 
			$content ['sname'], 
			$content ['position'], 
			$content ['dep_id']
		);
		
		$content ['debug'] .= 
			"\nHello " . $content ['fname'] . " " . $content ['sname'] . 
			". You are working as " . $content ['position'] . 
			" in " . $departments [$content ['dep_id']] . ".";
	}
	else
	{
		$content = array();
	}
	
	$selection_options = array(
			'dep_id' => $departments
	);
	
	$tmpl = new Etemplate ('helloworld.index');
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
				$content ['debug'] .= 
					$select ['fname'] . " " . $select ['sname'] . " was removed.";
			}
		}
		if ($content ['modify'] == 'pressed')
		{
			if ($this->bo->update_employee 
				(
					$select ['fname'], 
					$select ['sname'], 
					$change ['fname'], 
					$change ['sname'], 
					$change ['position'], 
					$change ['dep_id']
				))
			{
				$content ['debug'] .= 
					$select ['fname'] . " " . $select ['sname'] . " was changed.";
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
	
	$tmpl = new Etemplate ('helloworld.db_controls');
	$tmpl->exec ('helloworld.helloworld_ui.db_controls', $content, $selection_options);
}</pre>

	<p>Now it is finally time to load up EGroupware and experience
		everything you have done in action. Clicking the links should take you
		from the main page to the db control page and vice versa.</p>

	<img src="img/17-sidebox.png" alt="The app with sidebox support." />

	<p>The database controls should probably not be visible to regular
		users. If you want to show it only to admin users, surround the code
		that adds the entry to the sidebox with a check for admin rights.</p>

	<pre class="code">
function sidebox_menu()
{
	$appname = 'helloworld';
	$title = "Links";
	<span class="change">
	$items = array();
	$items ['Input name and position'] = egw::link ('/index.php', array(
			'menuaction' => 'helloworld.helloworld_ui.index'
	));
	if ($GLOBALS ['egw_info'] ['user'] ['apps'] ['admin'])
	{
		$items ['Database controls'] = egw::link ('/index.php', array(
				'menuaction' => 'helloworld.helloworld_ui.db_controls'
		));
	}</span>
	
	display_sidebox ($appname, $title, $items);
	$title2 = "HTML";
	$items2 = array(
			array(
					'text' => '&lt;br>Not a link',
					'nolang' => true,
					'link' => false,
					'icon' => false
			),
			array(
					'text' => 
						'&lt;br>&lt;br>'.
						'&lt;label>&lt;input type="checkbox">HTML object&lt;/label>',
					'nolang' => true,
					'link' => false,
					'icon' => false
			),
			array(
					'text' => 
						'&lt;br>&lt;br>'.
						'&lt;table>' . 
							'&lt;tr>&lt;th>More&lt;/th>&lt;th>HTML&lt;/th>&lt;/tr>' . 
							'&lt;tr>&lt;td>1&lt;/td>&lt;td>2&lt;/td>&lt;/tr>' . 
							'&lt;tr>&lt;td>3&lt;/td>&lt;td>4&lt;/td>&lt;/tr>' . 
						'&lt;/table>',
					'nolang' => true,
					'link' => false,
					'icon' => false
			)
	);
	display_sidebox ($appname, $title2, $items2);
}</pre>

	<p>Log in with a different account that does not have admin privileges
		to see wether it worked. The account should have access to your app,
		of course.</p>

	<img src="img/17.5-sidebox_without_admin.png"
		alt="The sidebox without admin rights." />

	<h3>Other hooks</h3>

	<p>There is a whole range of other hooks you can use. The most
		important ones are:</p>

	<pre class="code">
$setup_info['helloworld']['hooks'] = array(
		
	<span class="comment">Populate the sidebox menu</span>
	'sidebox_menu' => "helloworld.helloworld_ui.sidebox_menu",

	<span class="comment">Create settings menu in EGroupwares settings link</span>
	'settings' => "helloworld_hooks::settings",
	
	<span class="comment">Verify settings once user is done editing them</span>
	'verify_settings' => "helloworld_hooks::verify_settings",
	
	<span class="comment">Access to the admin sidebox, where administration-settings can be changed</span>
	'admin' => "helloworld_hooks::admin",
	
	<span class="comment">Access Control List. Determine who can do what.</span>
	'acl_rights' => "helloworld_hooks::acl_rights",
	
	<span class="comment">If you want to use categories</span>
	'categories' => "helloworld_hooks::categories",
	
	<span class="comment">What to do if a user account is deleted</span>
	'deleteaccount' => "helloworld_hooks::deleteaccount"
);</pre>

	<p>
		You can add this code to your <span class="file">setup/setup.inc.php</span>.
		Sometimes your hook functions do not need to be part of an object
		instance and should just be static. In that case, you should make a
		new class <span class="class">helloworld_hooks</span> inside <span
			class="file">inc/class.helloworld_hooks.inc.php</span> that contains
		all your hook functions in one place.<br>What follows is a quick and
		basic description of each of these, including some sample code.<br> If
		you want to use any of them, you should not forget to add them to the
		<span class="var">$setup_info['helloworld']['hooks']</span> array and
		upgrading the app on the setup page.
	</p>

	<h4>Settings and verify_settings</h4>

	<p>
		If your user account has access rights to the <span class="app">Preferences</span>
		app, there will be a button with the equivalent name at the top of
		each page. Because you have not defined any app-specific settings yet,
		clicking on it right now will take you to the general preferences
		page. If you want to allow user specific settings in your app, you
		will need to implement the <span class="function">settings</span>
		hook. The function is expected to return an array specifying how to
		populate the settings menu. A sample implementation is shown below.
	</p>

	<pre class="code">
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
}</pre>

	<p>
		Do not forget to increase the version number and to add an upgrade function. Then go to setup to
		upgrade your app. Once you are back, you should be able to see these
		settings options if you click on the <span class="button">Preferences</span>
		button.
	</p>

	<img src="img/18-settings.png" alt="The settings menu" />

	<p>
		Before the settings are saved, you might want to verify them in case
		you have some potentially conflicting options. Use the <span
			class="function">verify_settings</span> hook for this.
	</p>

	<pre class="code">
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
}</pre>

	<img src="img/19-mayonnaise.png" alt="The verification did not work." />

	<p>
		To access the settings, you can read from <span class="var">$GLOBALS['egw']->preferences->data[$appname]</span>.
		One of the settings is for the user's favourite instrument. If you
		append the code in <span class="function">sidebox_menu</span>, you can
		show this setting.
	</p>

	<pre class="code">
<span class="comment">Get settings for favourite instrument</span>
$fav_instrument = 
	$GLOBALS['egw']->preferences->data['helloworld']['favourite_instrument'];

$items2[] = array(
				'text' => "&lt;br>Favourite Instrument: $fav_instrument",
				'nolang' => true,
				'link' => false,
				'icon' => false
			);</pre>

	<p>
		You can now set $favourite_instrument to anything you like, e.g. <span
			class="string">accordion</span> and it will show up in the sidebox.
	</p>

	<img id="sidebox-img" src="img/20-accordion.png"
		alt="There is now an entry in the sidebox that lists the user's favourite instrument." />

	<h4>Admin Menu</h4>

	<p>Using this hook, you can specify admin specific settings that will
		only be shown in the Admin app's sidebox. It works similar to the
		sidebox_menu hook in that you can use the same functions and formats.</p>

	<pre class="code">
static function admin()
{
	$items = Array(
		'Site Configuration' => egw::link ('/index.php',
			'menuaction=admin.uiconfig.index&appname=helloworld'),
		'Custom fields' => egw::link ('/index.php',
			'menuaction=admin.customfields.index&appname=helloworld'),
		'Global Categories' => egw::link ('/index.php',
			'menuaction=admin.admin_categories.index&appname=helloworld'),
		'Main page' => egw::link ('/index.php',
			'menuaction=helloworld.helloworld_ui.index')
	);
	display_section ('helloworld', 'Hello World', $items);
}</pre>

	<p>
		If you now go to the <span class="app">Admin</span> app and open the <span
			class="option">Applications</span> tab, you will see the entry for <span
			class="app">helloworld</span> that you have just defined.
	</p>

	<img src="img/21-admin_menu.png" alt="The admin menu for the app" />

	<h4>ACL rights</h4>

	<p>ACL stands for Access Control List. Using this hook you can tell
		EGroupware of all restricted data your app might save. EGroupware will
		then handle the entire problem of who is allowed access to what data
		in which way. This hook takes a parameter containing information about
		the current user and the location from which the hook was called. In
		return it expects an array of <span class="var">$key => $value</span> pairs, where the key is an
		access right identifier and value is a string representation of its
		meaning in context of your app.</p>

	<pre class="code">
static function acl_rights($params)
{
	return array(
		acl::READ    => 'read data',
		acl::ADD     => 'add data',
		acl::EDIT    => 'edit data',
		acl::DELETE  => 'delete data',
		acl::CUSTOM1  => 'sell data',
	);
}</pre>

	<p>
		Now you can click on <span class="button">Access</span> in the top
		menu, right next to <span class="button">Preferences</span>. Click <span
			class="button">Add</span> and select <span class="option">helloworld</span>.
		You can now determine who can do what to whose data based on your
		custom access controls.
	</p>

	<img src="img/22-acl.png" alt="The acl custom list" />

	<h4>Categories</h4>

	<p>To make use of EGroupwares category system, just use this hook and
		return true.</p>

	<pre class="code">
static function categories() {
	return true;
}</pre>

	<p>
		Clicking on <span class="button">Categories</span> in the top menu now
		opens an interface where you can add, edit and delete custom
		categories specific to your app.
	</p>

	<img src="img/23-categories.png" alt="Category editor" />

	<h4>Delete account</h4>

	<p>Finally there is the delete account hook. It gets called whenever a
		user account gets deleted. There is no example code for this as its
		implementation depends highly on the functions of your app. In general
		you should do some cleanup here. Delete any data you might have stored
		about the user and make sure you are not causing any database
		inconsistencies in the process.</p>

	<h3>Conclusion</h3>

	<p>Your new knowledge of the different hooks in EGroupware gives you
		access to all the pre-implemented standard features, like the settings
		menu or navigation through the sidebox. This is great for you, because
		you do not need to manually implement these features, but also great
		for the users, because they have standardized places to look for them.
		The user interface is now complete, but it still looks and behaves
		pretty basic. The following sections will show you how you can change
		this, beginning with an introduction to the NextMatch widget.</p>
		
		
	<div class="download">
		<h3>Download</h3>
		<p>
			You can download the result of this section <a
				href="../../downloads/04-hooks_and_sidebox.zip">here</a>.
		</p>
	</div>
	
	

	<a class="back" href="#top">^ Back to top</a>

	<div class="navigation">
		<a class="prev" href="<?php echo $back_link;?>">&lt; <?php echo $back_text;?></a><a
			class="next" href="<?php echo $forw_link;?>"><?php echo $forw_text;?> &gt;</a>
	</div>
</body>
</html>