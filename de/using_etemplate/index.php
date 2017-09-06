<?php
$back_link = "../getting_started";
$forw_link = "../database_tools";
$back_text = "Getting Started";
$forw_text = "Database tools";
$title = "Using eTemplate";
?>

<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<link rel="stylesheet" type="text/css" href="../style.css">
<title>Writing Apps for EGroupware: <?php echo $title;?></title>
</head>
<body id="top">
	<div class="navigation">
		<a class="prev" href="<?php echo $back_link;?>">&lt; <?php echo $back_text;?></a><a
			class="next" href="<?php echo $forw_link;?>"><?php echo $forw_text;?> &gt;</a>
	</div>
	<a class="back" href="../index.php">Back to Index</a>



	<h2>Using eTemplate</h2>

	<p>eTemplate is the custom templating engine used by EGroupware. It is
		based on XML, but luckily you don't need to worry about that most of
		the time. EGroupware comes included with a graphical editor for
		eTemplates. Some features are missing from it, so you will have to
		dive into the code at some point, but thanks to the XML structure,
		editing is relatively straightforward.</p>

	<h3>The eTemplate Editor</h3>

	<p>
		To access the eTemplate editor you will have to go to your <span
			class="app">Admin</span> tab and give yourself access rights to it,
		just like you did with the <span class="app">Hello World</span>
		application during the previous tutorial. You should see the <span
			class="app">eTemplate</span> tab on the left after a page refresh.
		Click on it.
	</p>

	<img src="img/05-access_etemplate.png"
		alt="Accessing the eTemplate Editor" />
	<img src="img/06-etemplate_editor.png" alt="A first look at the editor" />

	<p>What we are going to create now is a small form to input a name,
		position and department. This could be shown to every new user of your
		EGroupware installation so they can input their information and
		automatically be assigned to their appropriate user groups. It will
		also display a personalized Hello World message. This is what it
		should look like after you are done.</p>

	<img src="img/16-full_form.png" alt="The full UI" />

	<p>
		To start editing a new template, enter <span class="string">helloworld.index</span>
		into the name field. By naming it this way, you tell EGW that you want
		to create a template called <span class="name">index</span> for the
		app <span class="string">helloworld</span>. You will see this naming
		convention a lot in the future. For now, it is important for you to
		remember to begin all template names with <span class="string">$appname.</span>.<br>
		Enter some version number and press <span class="button">Read</span>.
		Just ignore the <span class="option">Template</span> and <span
			class="option">Lang</span> fields for now.
	</p>

	<p>Now hover with your mouse in the upper left corner of the big white
		area below the menu bar. A small pink rectangle should appear beneath
		the mouse pointer. If you can't find it, try pressing Ctrl-A to make
		it more visible. Once you have found it, double click to open the
		widget editor.</p>

	<img src="img/07-pink_rectangle.png"
		alt="Accessing the eTemplate Editor" />
	<img src="img/08-widget_editor.png"
		alt="Accessing the eTemplate Editor" />

	<p>
		There is quite a lot going on here. The first thing we will look at in
		detail is the dropdown menu labeled <span class="option">Type</span>.
		This determines what kind of UI element we want to create. Have a look
		through the list. The default type is <span class="option">Label</span>,
		but you can have all common UI elements and even some pre-configured
		selectors for dates, times, priorities, and many more.<br> You will
		also notice some structural widgets like grids, h- and vboxes, tables
		or tabs. These are different from normal widgets in that they can
		contain other widgets and lay them out in a predefined way.<br> If you
		take a look at the <span class="option">Path</span>, you will see that
		you are currently working within a grid structure. This is the default
		that is loaded every time you create a new template: Just a label
		within a 1x1 grid. To set the content of the label, type <span
			class="string">Position:</span> into the <span class="option">Label</span>
		field and click <span class="button">Apply</span>. You should see your
		changes appear in the background.
	</p>

	<img src="img/08.5-pos_label.png" alt="Settings for position label" />

	<p>Have a look at the top row of selection boxes now. Here you have
		options to edit the grid, like cut-copy-pasting widgets or
		inserting/deleting rows and columns. Use these to insert a new row
		below the current one. The widget editor will close and you will be
		taken back to the template view. If you hover your mouse below the
		label you just edited, a new pink rectangle will have appeared.</p>


	<img src="img/09-new_pink_rectangle.png"
		alt="The newly appeared pink rectangle" />

	<p>
		Double click it to reopen the widget editor. Select <span
			class="option">Label</span> as the <span class="option">Type</span>
		and insert <span class="string">Department:</span> as the content.
		Click <span class="button">Apply</span> and insert a column into the
		grid, after the column we are in now. There are two new pink
		rectangles now, one after each label. Double click the top one. This
		time the <span class="option">Type</span> should be <span
			class="option">Text</span>. Click <span class="button">Apply</span>
		and a text box will appear in the template view in the background. Now
		enter <span class="string">Enter position</span> into the field after
		<span class="option">blurText</span> and hit <span class="button">Apply</span>
		again. The string will appear inside the text box. We will also give
		this text box an identifier by which we can address it from our code.
		That's what the <span class="option">Name</span> field is for. Insert
		the string <span class="string">position</span> here and then hit <span
			class="button">Apply</span> one more time.
	</p>

	<img src="img/10-position_text.png"
		alt="Settings for position text box." />

	<p>
		Take a look at <span class="option">Path</span> again. You might
		notice the arrows that have appeared here. You can use these to
		navigate within the grid. Play around with these to make yourself
		familiar with the navigation. You can also go up a level by clicking
		on <span class="button">grid</span>. This allows you to change
		settings for the grid itself. To get back, click on the little <span
			class="button">x</span> that has now appeared in the path. It is
		meant to resemble an arrow pointing away from you and into the screen,
		meaning "Go inside". Using the arrows, navigate to the one widget we
		haven't touched yet, the one after <span class="option">Department:</span>
		and underneath <span class="option">Enter position</span>. Its <span
			class="option">Type</span> will be <span class="option">Select Box</span>
		and its <span class="option">Name</span> <span class="string">department</span>.
		Click <span class="button">Apply</span> again.
	</p>

	<img src="img/11-department_box.png"
		alt="Settings for the department selector" />

	<p>
		Now navigate to the grid widget using the <span class="option">Path</span>
		arrows again. At the top, instead of the options for inserting rows
		and columns into the grid, you now have options to insert widgets
		before and after the grid itself. Use these options to insert a widget
		before the grid. Set its <span class="option">Type</span> to <span
			class="option">HBox</span> and put a <span class="string">4</span>
		into the <span class="option">Options</span> field. This last step
		ensures the hbox will have space for exactly four widgets, which will
		be aligned horizontally in a row. Click <span class="button">Apply</span>
		to make the changes visible. Then navigate into the hbox (press the x
		after <span class="option">Path</span>) and insert two labels and two
		text fields, such that the form looks like the picture below.
	</p>


	<img src="img/11.5-create_hbox.png"
		alt="Creating a new widget before the grid" />
	<img src="img/11.6-hbox.png" alt="Settings for the hbox." />
	<img src="img/11.7-name_fields.png" alt="The form with the name fields" />

	<p>
		For the submit button, navigate back to the grid widget again. Create
		a new widget after the grid, set its <span class="option">Type</span>
		to <span class="option">Submit Button</span> and set both the <span
			class="option">Label</span> and <span class="option">Name</span> to <span
			class="string">submit</span>. Finally, click <span class="button">Save</span>.
	</p>

	<img src="img/12-create_button.png"
		alt="Creating a new widget after the grid" />
	<img src="img/13-save.png" alt="Settings for the submit button." />

	<p>
		Try clicking <span class="button">Export XML</span> now. If <span
			class="file">helloworld.index.xet</span> starts downloading, that
		means the EGW server does not have writing rights to the templates
		folder of your app. To fix this, execute
	</p>

	<pre class="command">chown -R www-data:www-data $egw_installation/helloworld/templates</pre>

	<p>
		in a terminal, then try <span class="button">Export XML</span> again.
		Every time you edit a template, you should click <span class="button">Save</span>
		and then <span class="button">Export XML</span>. <span class="button">Save</span>
		only writes your changes into a buffer, while <span class="button">Export
			XML</span> actually writes the changes into the file.<br> If you take
		a look at <span class="file">$egw_installation/helloworld/templates/default/</span>
		now, you should find a new file there called <span class="file">index.xet</span>.
		This has been written by the editor.

	</p>

	<h3>Updating the code</h3>

	<p>
		Now that you have the template, you need to integrate it with your
		code somehow. You will now start writing actual PHP code. Before you
		begin, you should take a look at Egrouwares <a
			href="http://community.egroupware.org/index.php?wikipage=CodingRules">coding
			standards</a>. This will help you write code that looks and feels the
		same as the EGW source code. There is also a <a
			href="http://community.egroupware.org/index.php?wikipage=DevelGuide">developer
			guide</a> and a <a
			href="http://community.egroupware.org/index.php?wikipage=StyleGuide">style
			guide</a>.
	</p>

	<p>
		As previously mentioned, most of the code should be inside the <span
			class="file">helloworld/inc/</span> folder. Create a new file <span
			class="file">class.helloworld_ui.inc.php</span> inside this folder.
		This is another naming convention. All ui object classnames should end
		in <i>_ui</i>, all business obejects in <i>_bo</i> and all storage
		objects in <i>_so</i>. Files containing a class should be named <span
			class="string">class.$classname.inc.php</span>. Insert the following
		code into this file:
	</p>

	<pre class="code">
&lt;?php

class helloworld_ui {

	function index($content = null)
	{
		$content = array();
	
		$departments = array(
			'Human Resources',
			'Marketing',
			'Tech Support',
			'Sales',
			'Management'
		);
		
		$selection_options = array(
			'department' => $departments
		);
		
		$tmpl = new etemplate_new ('helloworld.index');
		$tmpl->exec ('helloworld.helloworld_ui.index', $content, $selection_options);
	}
}</pre>

	<p>
		Note that the function is named <span class="function">index</span>
		after the template you just created. It does not have to be the same
		name, but again, it is convention to make it so. Let's take a closer
		look at the last two lines. First of all, we create a new
		etemplate-object called <span class="var">$tmpl</span>. The
		constructor takes one argument, which is the name of our template
		file. In the last line, the <span class="function">exec</span>
		function is called, which then automatically generates the entire
		page, now additional work required. It takes three arguments, the
		first is a callback string in the format <span class="string">$app.$class.$function</span>.
		This method is called whenever the user submits data back to the
		server, as will be the case once you click on the submit button. The
		second argument is the <span class="var">$content</span> array. It
		contains all the information needed to fill the template with content.
		There is nothing to fill in at this point, so it will be empty. The
		last argument is an array used to populate things like selection
		boxes, content lists, or content trees. We use it to set some options
		for the department selection box.
	</p>

	<p>
		If you now go to EGroupware and open the app, you will see... Hello
		World!. That's because we still need to edit <span class="file">index.php</span>
		to point to the newly created function. Delete everything that is in
		there at the moment and replace it with
	</p>

	<pre class="code">
&lt;?php
header('Location: ../index.php?menuaction=helloworld.helloworld_ui.index');</pre>

	<p>
		This is basically the same you did with the callback method. It tells
		EGroupware to create an instance of <span class="class">helloworld_ui</span>
		and call its <span class="function">index</span> function.<br>
		Finally, add the following code to <span class="file">class.helloworld_ui.inc.php</span>:
	</p>

	<pre class="code">
public $public_functions = array(
	'index' => true
);
</pre>

	<p>EGroupware only allows calling functions through the menuaction
		parameter which are registered in this array. Otherwise, it would be
		easy to call any function by passing the corresponding string to the
		menuaction.</p>

	<p>
		Reopen the app in EGroupware. You will now see the form you created.
		It does not do anything though. Clicking on <span class="button">Submit</span>
		just resets everything. This is no surprise, because there is nothing
		interesting happening inside the <span class="function">index</span>
		function. This will change now. Quickly go back to the eTemplate
		editor and add a <span class="option">Text Area</span> underneath the
		<span class="button">Submit</span> button. Name it debug and tick the
		<span class="option">readonly</span> option. Now it will only be
		possible to edit the content of the text area through code. It will
		also be invisible unless it has content, so do not wonder if you can
		not see it yet.
	</p>

	<img src="img/14-debug.png" alt="Settings for the debug text area." />

	<p>
		You will now use this text area to output some debug information. When
		<span class="file">index.php</span> calls <span class="function">index</span>
		for the first time, it will do so without any parameters. <span
			class="var">$content</span> will therefore be set to <span
			class="value">null</span>, by default. When you click <span
			class="button">Submit</span>, <span class="function">index</span> is
		called once again, this time as the callback method, and as such, it
		will be passed an array as parameter containing the entire content of
		the template. To see how it works, update the <span class="funcion">index</span>
		function like this:
	</p>


	<pre class="code">
function index($content = null) 
{
	$departments = array(
		'Human Resources',
		'Marketing',
		'Tech Support',
		'Sales',
		'Management'
	);
	
	if (is_array ($content))
	{
		$content ['debug'] =
			"Hello " . $content ['fname'] . " " . $content ['sname'] .
			". You are working as " . $content['position'] .
			" in " . $departments[$content['department']] . ".\n";
	}
	else
	{
		$content = array();
	}
	
	$selection_options = array(
		'department' => $departments
	);
	
	$tmpl = new etemplate_new ('helloworld.index');
	$tmpl->exec ('helloworld.helloworld_ui.index', $content, $selection_options);
}</pre>

	<p>
		The code is now checking wether <span class="var">$content</span> is
		an array and if it is not, initializes it with an empty array. More
		interestingly, if <span class="var">$content</span> is an array, the data from the form is parsed into a string and
		output to the debug area. Try it out now.
	</p>

	<img src="img/15-debug_output.png" alt="Trying out the form." />

	<p>
		Defining the <span class="var">$departments</span> array inside the <span
			class="function">index</span> function is bad style. This definition
		should be moved to the constructor. The constructor will be called
		automatically by EGW. In fact, a new instance of <span class="class">helloworld_ui</span>
		is created every time you run <span class="function">index</span> via
		the <span class="string">helloworld.helloworld_ui.index</span> calling
		string. Inside the constructor you can also do some other fancy
		things, like setting the page title of your app. The updated file
		looks like this:
	</p>

	<pre class="code">
&lt;?php

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
				" in " . $this->departments [$content ['department']] . ".\n";
		}
		else
		{
			$content = array();
		}
		
		$selection_options = array(
				'department' => $this->departments
		);
		
		$tmpl = new etemplate_new ('helloworld.index');
		$tmpl->exec ('helloworld.helloworld_ui.index', $content, $selection_options);
	}
}</pre>

	<p>and the final thing running in EGroupware looks like this:</p>

	<img src="img/16-full_form.png" alt="The full UI" />

	<h3>Conclusion</h3>

	<p>
		As you have probably guessed by now, eTemplate is quite powerfull, but
		also extensive and complicated. This was only a quick look at some of
		the more basic features. To get a full description on how to use
		specific widgets and eTemplate in general, have a look at the <a
			href="google.com">eTemplate documentation</a>
	</p>

	<p>We will now have a look at EGroupwares database tools.</p>
	
	
	
	
	


	<a class="back" href="#top">^ Back to top</a>

	<div class="navigation">
		<a class="prev" href="<?php echo $back_link;?>">&lt; <?php echo $back_text;?></a><a
			class="next" href="<?php echo $forw_link;?>"><?php echo $forw_text;?> &gt;</a>
	</div>
</body>
</html>