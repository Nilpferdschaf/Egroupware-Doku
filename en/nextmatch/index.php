<?php
$back_link = "../hooks_and_sidebox";
$forw_link = "../images_and_css";
$back_text = "Using Hooks and Accessing the Sidebox";
$forw_text = "Images and CSS";
$title = "The Nextmatch Widget";
?>

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
	<a class="back" href="../index.php">Back to Index</a>

	<h2><?php echo $title;?></h2>

	<p>The Nextmatch widget is a part of eTemplate that will come in very
		handy whenever you want to display a list of items to the user.
		Nextmatch will make the list searchable and sortable and also makes it
		possible to select entries and perform actions on them. Using all
		these features requires minimal work from you, so you should
		definitely know how to use it.</p>

	<h3>Setup through the eTemplate editor</h3>

	<p>
		The Nextmatch widget is an eTemplate widget just like all the other UI
		elements. If you want to use one, you need add it to the UI via the
		eTemplate editor. Open the <span class="file">helloworld.db_controls</span>
		template file and add a new widget after the debug text area. Set the
		<span class="option">Type</span> of the widget to <span class="option">Nextmatch</span>,
		its <span class="option">Name</span> to <span class="string">nm</span>
		and fill in the <span class="option">Options</span> field with <span
			class="string">helloworld.db_controls.rows</span>. The result should
		look like the screenshot below.
	</p>

	<img alt="Adding the Nextmatch Widget." src="img/86-add_nm_widget.png">
	<img alt="The nm widget as part of the app."
		src="img/87-added_nm_widget.png">

	<p>
		Double click on the pink rectangle that appears right below the
		Nextmatch header when you hover over it. There will be an error <span
			class="string">Error: Template not found</span>. The widget looks for
		a template <span class="file">helloworld.db_controls.rows</span> as
		specified by the <span class="option">Options</span> field. Create
		this template to continue.
	</p>

	<p>
		<img alt="Adding the rows template." src="img/88-pink_rectangle.png">
		<img alt="Adding the rows template." src="img/89-rows_template.png">

		This template will contain the body of the Nextmatch widget. The body
		will basically be an HTML table with a row of table headers and
		multiple rows of table data. It consists of a grid with two rows,
		where the first row is made up of the table headers and the second row
		contains the items that will be displayed inside the table. Start
		creating the body by opening the widget editor and adding a new <span
			class="option">Nextmatch Sort Header</span>. Set the <span
			class="option">Name</span> to fname and the <span class="option">Label</span>
		to <span class="string">First name</span>
	</p>

	<img alt="Creating the first header." src="img/90-sort_header.png">

	<p>
		Now add more headers to the template. Their <span class="option">Name</span>s
		and <span class="option">Label</span>s are:
	</p>

	<ul>
		<li>sname, Second Name
		
		<li>position, Position
		
		<li>dep_name, Department
	
	</ul>

	<p>
		The <span class="option">Label</span> texts are just what will be
		shown on the header, while the <span class="option">Name</span> tells
		eTemplate where to put the data. When you are done adding the table
		headers, it should look like this:
	</p>

	<img alt="All the headers, once they are created."
		src="img/91-sort_headers.png">

	<p>
		The second row will be entirely made up of labels, because the table
		will display nothing but strings. It is important to set their <span
			class="option">Name</span>s correctly. These are all instances of the
		following scheme: <span class="string">${row}[key]</span>. When
		eTemplate parses this string and creates the table rows, it will
		automatically replace <span class="string">${row}</span> with an
		identifier for the data point that will be displayed in that row. The
		data points will later be given to the widget via arrays of <span
			class="var">$key => $value</span> pairs and the <span class="var">$value</span>s
		of the different data points will be shown under the corresponding <span
			class="var">$key</span> column. Keeping all this in mind, set the <span
			class="option">Name</span> option of the labels in the second row to
		these values:
	</p>

	<ul>
		<li>${row}[fname]
		
		<li>${row}[sname]
		
		<li>${row}[position]
		
		<li>${row}[dep_name]
	
	</ul>

	<img alt="The first data label." src="img/92-rows_label.png">

	<p>When you export the final result, it should look like the screenshot
		below.</p>

	<img alt="The exported file." src="img/93-rows_export.png">

	<p>
		If you open the <span class="file">helloworld.db_controls</span>
		template again, you will see the rows template inside the Nextmatch
		widget.
	</p>

	<img alt="The final template inside the editor."
		src="img/94-nm_done.png">

	<h3>Initialisation, Sorting and Filtering</h3>

	<p>At this point the Nextmatch widget will not actually show up as part
		of the user interface when you open up your app. You need to properly
		initialize it from your codebase. A typical initialization function
		looks like this:</p>

	<pre id="init-nm" class="code">
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
			'row_id' => 'emp_id',
	);
	
	if (is_array ($content ['nm']))
	{
		$content ['nm'] = array_merge ($content ['nm'], $nm_settings);
	}
	else
	{
		$content ['nm'] = $nm_settings;
	}
}</pre>

	<p>
		Add this function to <span class="class">helloworld_ui</span>. There
		are all sorts of parameters being set here and there are many more. To
		find out what they all do, take a look at <span class="file">$egw_installation/etemplate/inc/class.etemplate_widget_nextmatch.inc.php</span>.
		The most important one for now is <span class="option">get_rows</span>.
		With this you can set a callback function that Nextmatch uses to fetch
		the data that will be displayed. Implementing this function is quite
		easy.
	</p>

	<pre class="code">
function get_employees_nm($query, &$rows, &$readonlys)
{
	$rows = $this->get_employees ();
	
	return count ($rows);
}</pre>

	<p>
		As suggested by the get_rows callback string, <span class="string">helloworld.helloworld_so.get_employees_nm</span>,
		this function needs to be part of <span class="class">helloworld_so</span>.
		The return value should be the number of data points and the <span
			class="var">$rows</span> parameter is supposed to contain all the
		data once the function has run through. <span class="var">$query</span>
		has all kinds of information about the widget itself, like all the
		initialization you just set, but also information about the string
		that was inserted into the search field that is part of the widget.
		Finally, $readonlys makes it so you can not perform actions on some
		data rows.
	</p>

	<p>
		With the current setup, Nextmatch will display only a minimal
		interface, containing nothing but a search field apart from the actual
		data. The <span class="function">init_nextmatch</span> functions needs
		to be called from the <span class="function">db_controls</span>
		function before the call to <span class="function">etemplate->exec</span>.
	</p>

	<pre class="code">
function db_controls($content = null)
{
	<span class="comment">Do other stuff</span>
	
	$this->init_nextmatch ($content);
	
	$tmpl = new Etemplate ('helloworld.db_controls');
	$tmpl->exec ('helloworld.helloworld_ui.db_controls', $content, $selection_options);
}</pre>

	<p>You can also remove the code for dumping all the data to the debug
		text area. That is now the purpose of the Nextmatch widget. The
		minimal amount of setup is done now and you can reopen your app.</p>

	<img alt="Unsorted data, because sorting is not implemented"
		src="img/95-nm_unsorted.png">

	<p>
		If you play around with the widget, you will notice that sorting and
		searching does not work yet. You need to tell the widget manually how
		to do this. Use the following code in <span class="class">helloworld_so</span>
		to enable these features.
	</p>

	<pre class="code">
function get_employees_nm($query, &$rows, &$readonlys)
{
	$rows = $this->get_employees ();
	

	if ($query ['search'])
	{
		$rows = array_filter ($rows, $this->get_string_filter ($query ['search']));
	}
	usort ($rows, $this->get_sort ($query ['order']));
	

	if ($query ['sort'] == 'DESC') $rows = array_reverse ($rows);
	return count ($rows);
}

function get_string_filter($string)
{
	$string = strtolower ($string);
	return function ($cmp_arr) use ($string)
	{
		foreach ($cmp_arr as $entry)
		{
			if (strpos (strtolower ($entry), $string) !== false)
			{
				return true;
			}
		}
		return false;
	};
}

function get_sort($key)
{
	return function ($a, $b) use ($key)
	{
		return strcmp (strtolower ($a [$key]), strtolower ($b [$key]));
	};
}</pre>

	<p>The widget is now fully functional.</p>

	<img alt="Now the data is sorted" src="img/96-nm_sorted.png">
	<img alt="The data with a filter applied and then sorted."
		src="img/97-nm_filtered.png">

	<h3>Performing Actions</h3>

	<p>Nextmatch also provides a convenient way for your users to select
		entries and perform actions on them. All it takes is a simple change
		in the initiation.</p>

	<pre class="code">
function init_nextmatch(&$content)
{
	$nm_settings = array(
		<span class="comment">Set other options</span>
	);
	
	$nm_settings['actions'] = array(
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
}</pre>

	<p>
		All this does is set <span class="var">$nm_settings['actions']</span>
		to an array that encodes the actions that should be displayed to the
		user. The array contains <span class="var">$key => $value</span>
		pairs, where <span class="var">$key</span> is an identifier for the
		action and <span class="var">$value</span> an array containing its
		parameters. The parameters that are set by this array are also
		described in <span class="file">class.etemplate_widget_nextmatch.inc.php</span>.
	</p>

	<p>
		Right clicking on an entry will now reveal a context menu, where you
		can choose to select or to delete it. Both options will not do anything
		at the moment. The functionality behind them needs to be added first.
		The chosen <span class="option">nm_action</span> for both actions in
		this case is submit. This means that once an action is clicked by a
		user, the callback that was given for the call to <span
			class="function">etemplate->exec</span> will be executed. The
		callback in this case is <span class="function">helloworld_ui->db_control</span>.
	</p>

	<pre class="code">
function db_controls($content = null)
{
	$departments = $this->bo->get_department_names ();
	if (is_array ($content))
	{
		if($content['nm']['action'] == 'delete') {
			$this->bo->delete_employee_by_id($content['nm']['selected'][0]);
		}
		if($content['nm']['action'] == 'select') {
			$data = $this->bo->read_employee($content['nm']['selected'][0]);
			$content['select'] = $data;
			$content['change'] = $data;
		}
		
		<span class="comment">Handle button presses</span>
	}
	
	<span class="comment">Other Code</span>
}</pre>

	<p>
		As you can see, eTemplate tells us which action was selected by
		writing its identifier to <span class="var">$content['nm']['action']</span>.
		The selected rows are written to <span class="var">$content['nm']['selected']</span>.
		The rows are identified by the field that is defined by the <span
			class="option">row_id</span> parameter for the Nextmatch widget, <a
			href="#init-nm">which in this case is set to <span class="string">emp_id</span></a>.
		<span class="var">$content['nm']['selected']</span> will therefore be
		a list of emp_ids.
	</p>

	<p>
		The functions <span class="function">helloworld_bo->delete_employee_by_id</span>
		and <span class="function">helloworld_bo->read_employee</span> only
		pass the function call through to the stack object.
	</p>

	<pre class="code">
function read_employee($emp_id) {
	return $this->so->read_employee($emp_id);
}

function delete_employee_by_id($emp_id)
{
	return $this->so->delete_employee_by_id($emp_id);
}</pre>

	<p>And finally, the implementation of the functions on the stack
		object.</p>

	<pre class="code">
function delete_employee_by_id($emp_id)
{
	return $this->db->delete (
		'employees', 
		array(
			'emp_id' => $emp_id
		)
	);
}

function read_employee($emp_id)
{
	$sel_result = $this->db->select (
		'departments, 
		employees', 
		array(
			'fname',
			'sname',
			'departments.dep_id as dep_id',
			'position'
		), 
		array(
			'emp_id' => $emp_id
		), 
		__LINE__, 
		__FILE__, 
		false, 
		'ORDER BY sname desc', 
		false, 
		0, 
		"WHERE employees.dep_id = departments.dep_id"
	);
	
	foreach ($sel_result as $record)
	{
		return $record;
	}
}</pre>

	<p>With the implementation ready to go, it is time to test wether
		everything works. Just right click on any entry and select one of the
		actions.</p>

	<img alt="The context menu with the two actions."
		src="img/98-context_menu.png">

	<h3>Conclusion</h3>

	<p>The Nextmatch widget is an incredibly powerful tool for displaying
		lists of data to the user. You are now able to utilize this power in
		your own projects and display data in a nice-looking, user-friendly
		way. The next task is to polish the user interface even more with the
		power of images and CSS.</p>


	<div class="download">
		<h3>Download</h3>
		<p>
			You can download the result of this section <a
				href="../../downloads/05-nextmatch_widget.zip">here</a>.
		</p>
	</div>


	<a class="back" href="#top">^ Back to top</a>

	<div class="navigation">
		<a class="prev" href="<?php echo $back_link;?>">&lt; <?php echo $back_text;?></a><a
			class="next" href="<?php echo $forw_link;?>"><?php echo $forw_text;?> &gt;</a>
	</div>
</body>
</html>