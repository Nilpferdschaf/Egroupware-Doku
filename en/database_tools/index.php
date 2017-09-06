<?php
$back_link = "../using_etemplate";
$forw_link = "../hooks_and_sidebox";
$back_text = "Using eTemplate";
$forw_text = "Using Hooks and Accessing the sidebox";
$title = "Database Tools";
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
	<a class="back" href="../index.php">Back to Index</a>

	<h2>EGroupware's Database Tools</h2>

	<p>EGroupware comes with a built-in database which you can use in your
		applications. Using this database is made easy by a graphical
		interface and some helpful functions, that provide full CRUD
		functionality.</p>
	<h3>Creating a Table</h3>

	<p>
		The first table you will create will just be a simple list of
		departments, containing the columns <span class="column">dep_id</span>
		and <span class="column">dep_name</span>. You will use this column to
		replace the hard-coded list of departments from the previous tutorial.
	</p>

	<p>
		Open up the eTemplate editor to begin and click on <span
			class="button">DB tools</span> in the sidebox. This opens the table
		editor.
	</p>

	<img class="sidebox" src="img/24-db_tools.png" alt="Click on DB tools" />

	<p>
		To create your first table, select your application (<span
			class="option">helloworld</span> if you are following the tutorial)
		from the <span class="option">Application</span> dropdown, then enter
		<span class="string">departments</span> into the text field on the
		right. Now click on <span class="button">Add table</span> to start
		editing.
	</p>

	<img src="img/25-table_editor.png" alt="The table editor" />
	<img src="img/26-add_departments.png"
		alt="Adding the departments table" />

	<p>
		Now that you have created the table it is time to add the columns. For
		the first one, enter <span class="string">dep_id</span> as <span
			class="option">Column name</span>. Set the <span class="option">Type</span>
		to <span class="option">int</span> and tick the check boxes <span
			class="option">NOT NULL</span>, <span class="option">Primary Key</span>
		and <span class="option">Unique</span>. Now click on the <span
			class="button">Add Column</span> button (The page symbol with a small
		+-sign, you can see it in the screenshot below).
	</p>

	<img src="img/27-add_dep_id" alt="Creating the column for dep_id" />

	<p>
		A new column has appeared. For this one, use <span class="string">dep_name</span>,
		<span class="option">varchar</span>, <span class="option">NOT NULL</span>
		and <span class="option">Unique</span> as in the screenshot below.
	</p>

	<p>
		You are now almost ready to click <span class="button">Write tables</span>.
		Before you do, make sure EGroupware has writing rights to the <span
			class="file">helloworld/setup/</span> folder. If this is not the
		case, execute
	</p>

	<pre class="command">chown -R www-data $egw_installation/helloworld/setup</pre>

	<p>
		in a terminal. Once that is done, click <span class="button">Write
			tables</span>.
	</p>

	<img src="img/28-write_table.png"
		alt="Click on Write Table to confirm your changes" />

	<p>
		If you now take a look at <span class="file">helloworld/setup/setup.inc.php</span>
		you will notice a new line at the end:
	</p>

	<pre class="code">$setup_info['helloworld']['tables'] = array('departments');</pre>

	<p>EGW added this line automatically. During installation, this assigns
		the newly created table to your app.</p>

	<p>
		There is now also an entirely new file, <span class="file">helloworld/setup/tables_current.inc.php</span>.
		It contains information about setting up the table departments.
	</p>

	<p>
		Now go to the <span class="url">http://$your_domain/egroupware/setup</span>
		page and completely reinstall the application. Simply upgrading will
		not work. The automatic upgrade manager does not know how to initially
		create the first table, whereas the installer does. After uninstalling
		and reinstalling the table will have automatically been created. In
		the next step, you will take a look at it and insert some values.
	</p>

	<h3>Using MySQL to manually access and edit the EGroupware database</h3>

	<p>EGroupware has created the table for you, but it is still empty. To
		insert the data entries, go the command line of your EGW server and
		type</p>

	<pre class="command">mysql -u $egw_db_root -p</pre>

	<p>
		where <span class="var">$egw_db_root</span> is the database root
		username you set during the installation of EGroupware. When you run
		the command, it will ask you for a password. This is the db root
		password, also set during installation. Hit enter again and a mysql
		command prompt should open.
	</p>
	<p>
		Now type in <span class="string">SHOW DATABASES;</span>. A list of
		databases should appear.
	</p>

	<pre class="command">
mysql> SHOW DATABASES;
+--------------------+
| Database           |
+--------------------+
| information_schema |
| egroupware         |
+--------------------+</pre>

	<p>
		To access the EGW database, type <span class="string">USE egroupware;</span>.
		Now type <span class="string">SHOW tables;</span> and a long list of
		tables should appear. Look through the list and find the departments
		table. It should be in there. To print the contents of the table, type
		<span class="string">SELECT * from departments;</span>. This should
		return an empty set.
	</p>

	<pre class="command">
mysql> SELECT * FROM departments;
Empty set (0.00 sec)</pre>

	<p>To fill the table up, enter the following command:</p>

	<pre class="command">
mysql> 	insert into departments(dep_id, dep_name) values \
		(0, "Human Resources"), (1, "Marketing"), \
		(2, "Tech Support"), (3, "Sales"), (4, "Management");
Query OK, 5 rows affected (0.15 sec)
Records: 5  Duplicates: 0  Warnings: 0</pre>

	<p>
		If you run the select command again, you can see the changes you made.
		Type <span class="string">exit</span> to exit the mysql command
		prompt.
	</p>

	<pre class="command">
mysql> SELECT * FROM departments;
+--------+-----------------+
| dep_id | dep_name        |
+--------+-----------------+
|      0 | Human Resources |
|      4 | Management      |
|      1 | Marketing       |
|      3 | Sales           |
|      2 | Tech Support    |
+--------+-----------------+
5 rows in set (0.00 sec)

mysql> exit
Bye</pre>

	<h3>Accessing a table from your app</h3>

	<p>
		Now that you have a table with content it is time to use it inside the
		application. To do this, you should first create a new class <span
			class="class">helloworld_so</span> inside <span class="file">inc/class.helloworld_so.inc.php</span>.
		This class will have two fields, a private <span class="var">$db</span>
		containing the database object and a public <span class="var">$dep_names</span>
		to buffer the department names from the table you created.
	</p>

	<pre class="code">
&lt;?php

class helloworld_so {
	
	private $db;
	
	var $dep_names;
}</pre>

	<p>The class also needs two functions. The first one is the
		constructor, which clones the global EGroupware database object, sets
		it up for usage within your app and then buffers the table. The second
		one is just a getter-function.</p>

	<pre id="egw_db" class="code">
function __construct()
{
	$this->db = clone ($GLOBALS ['egw']->db);
	$this->db->set_app ('helloworld');
	$dep_select = $this->db->select ("departments", array("dep_id", "dep_name"));
	
	$this->dep_names = array();
	foreach ($dep_select as $record)
	{
		$this->departments [$record ['dep_id']] = $record ['dep_name'];
	}
}

function get_department_names()
{
	return $this->departments;
}</pre>

	<p>
		The most interesting part here is the <span class="function">egw_db->select</span>
		function. It takes a string with a table name and an array of columns
		within that table. There are also other parameters which are not used
		here. You will require them further down. The function parses these
		parameters into an SQL SELECT command which will then get sent to the
		database. The returned object is an <span class="class">ADORecordSet</span>
		that can be used in a foreach loop like in the code above. Everything
		else is just setup. The <span class="function">select</span> function
		and many other query functions are part of the <span class="class">egw_db</span>
		class. Its source code can be found in <span class="file">$egw_install/phpgroupwareapi/inc/class.egw_db.inc.php</span>.
	</p>

	<p>
		To use the new class, go back to <span class="class">helloworld_ui</span>,
		add the field <span class="var">$so</span> and initialize it within
		the constructor.
	</p>

	<pre class="code">
private $so;

function __construct()
{
	$this->so = new helloworld_so();
	
	$GLOBALS ['egw_info'] ['flags'] ['app_header'] = 'Enter your position.';
}</pre>

	<p>
		You can now completely remove the field <span class="var">$departments</span>
		and replace the line that sets the <span class="var">$selection_options</span>.
	</p>

	<pre class="code">
$selection_options = array(
	'dep_id' => $this->so->get_department_names()
);</pre>

	<p>plus the line that outputs into the debug area</p>

	<pre class="code">
$content ['debug'] = 
"Hello " . $content ['fname'] . " " . $content ['sname'] . 
". You are working as " . $content ['position'] . " in " . 
$this->so->get_department_names () [$content ['dep_id']] . ".\n";</pre>

	<p>The next step is to open up Egroupware to check wether you have done
		everything correctly. Nothing should have changed visually. The only
		thing that is different is the place where the select box entries are
		stored. If you think this is rather disappointing, log back into the
		EGW database and execute the SQL command</p>

	<pre class="command">
mysql> insert into departments (dep_id, dep_name) values (5, "Quality Assurance");
Query OK, 1 row affected (0.13 sec)
</pre>

	<p>After a refresh the new entry should show up in the list. All
		without further editing the code.</p>

	<img class="small" src="img/29.5-qa.png"
		alt="The new entry appears in the list" />

	<h3>Advanced Queries (SELECT ... WHERE, DELETE, INSERT, UPDATE)</h3>

	<p>
		Now that you can read from the database, you might want to write back
		to it. The form you created already supports inserting a name and a
		position, but these are not saved anywhere at the moment. To change
		that, go back to the DB tools from the eTemplate editor and select
		your app (helloworld) again. Add a new table <span class="string">employees.</span>
	</p>

	<img src="img/30-employees.png" alt="Add table employees" />

	<p>
		Add new columns like in the screenshot below. Afterwards, click on <span
			class="button">Write Tables</span>. Egroupware will ask you to
		increase the version number of your app. This needs to be done,
		because having multiple database definitions associated to the same
		version number would make it impossible to upgrade an app. Confirm the
		new version number by clicking on <span class="button">Yes</span>
	</p>

	<img src="img/31-table_rows.png" alt="Table rows for employees table" />
	<img class="small" src="img/32-confirm.png"
		alt="Increase version number again and confirm" />
	<pre class="code">
$setup_info ['helloworld']['version] = '0.002';</pre>

	<p>
		Do not forget to also increase the version number in <span
			class="file">setup/setup.inc.php</span> - This is not done
		automatically!. While you are there, take a look at the newly
		generated file <span class="file">setup/tables_update.inc.php</span>.
		It was generated by Egroupware and contains information on how to
		update the database when upgrading from one version number to another.
		When you created the first table, EGW was not able to generate this
		file, that is why you had to completely reinstall the application
		earlier.
	</p>

	<p>The file currently contains the following function:</p>

	<pre class="code">
function helloworld_upgrade0_001()
{
	$GLOBALS['egw_setup']->oProc->CreateTable('employees',array(
		'fd' => array(
			'emp_id' => array(
				'type' => 'int','precision' => '4','nullable' => False
			),
			'fname' => array(
				'type' => 'varchar','precision' => '255','nullable' => False
			),
			'sname' => array(
				'type' => 'varchar','precision' => '255','nullable' => False
			),
			'position' => array(
				'type' => 'varchar','precision' => '255','nullable' => False
			),
			'dep_id' => array(
				'type' => 'int','precision' => '4','nullable' => False
			)
		),
		'pk' => array('emp_id'),
		'fk' => array(),
		'ix' => array(),
		'uc' => array('emp_id')
	));

	return $GLOBALS['setup_info']['helloworld']['currentver'] = '0.002';
}</pre>

	<p>The function name contains the version number and the function
		itself has instructions on how to upgrade that version to some higher
		version number, which is set and returned at the end of the function.
		When upgrading, EGroupware will check for the upgrade function
		corresponding the version that is currently installed. If the returned
		newer version is still smaller than the target version, subsequent
		calls to further upgrade functions are made until the version numbers
		match. What this means for you is that from now on you will have to
		add an upgrade function for every version number increase you make.
		Otherwise that version can not be upgraded.</p>

	<p>
		Luckily writing an upgrade function is really simple if the table
		layout has not changed between versions. To get from version <span
			class="var">$a</span> to version <span class="var">$b</span>, the
		upgrade function could look like this:
	</p>

	<pre class="code">
function $appname_upgrade$a()
{
	return $GLOBALS['setupinfo'][$appname]['currentver'] = $b;
}</pre>

	<p>
		When you change the table layout, EGroupware will automatically
		generate the upgrade functions for you. You can just go to <span
			class="url">$your_domain/egroupware/setup</span> and upgrade.
	</p>

	<p>
		Open up <span class="file">inc/class.helloworld_so.inc.php</span>. You
		will now write a function that inserts a new value into the employee
		table.
	</p>

	<pre class="code">
function insert_employee($fname, $sname, $position, $dep_id)
{
	$this->db->insert ('employees', array(
			'fname' => $fname,
			'sname' => $sname,
			'position' => $position,
			'dep_id' => $dep_id,
			'emp_id' => $this->increment_emp_id()
	));
}

function increment_emp_id() {
	$max = $this->db->select("employees", "max(emp_id) as max")->fields['max'];
	return 1+$max;
}</pre>

	<p>
		This code makes use of the <span class="function">db->insert</span>
		function, which takes as parameters a string containing the table name
		and an array of <span class="var">$column => $value</span> pairs.
		There are a few optional parameters:
	</p>

	<ul>

		<li><span class="var">$where</span> is a string with a WHERE clause or
			array with column-name / values pairs to check if a row with that key
			already exists. If the row exists db::update is called.</li>

		<li><span class="var">$line</span> is for debugging purposes and
			should be set to the line number via <span class="var">__LINE__</span>.</li>

		<li><span class="var">$file</span> is also for debugging purposes and
			should contain the file name via <span class="var">__FILE__</span>.</li>

		<li><span class="var">$app</span> is the name of your app. If set to
			false, the app that is currently running will be used.</li>

	</ul>

	<p>
		The function <span class="function">increment_emp_id</span> queries
		the database for the maximum <span class="var">emp_id</span>,
		increases it by 1 and returns it. This is sadly necessary, since
		Egroupware can not make columns AUTO_INCREMENT. You could add
		functionality this manually via
	</p>

	<pre class="command">mysql> ALTER TABLE employees MODIFY column emp_id INT AUTO_INCREMENT;</pre>

	<p>
		but you would have to do this every time the app is installed. A
		possible workaround involves directly manipulating the database and
		sending the ALTER query through the <a
			href="http://www.w3schools.com/php/php_mysql_intro.asp">PHP MySQL
			library</a>. Another way to do it is the <span class="function">egw_db->query</span>
		function which will be discussed later.
	</p>

	<p>
		You need to use the new <span class="function">insert</span> function
		in <span class="class">helloworld_ui</span>. Update the <span
			class="function">index</span> function like this:
	</p>
	<pre class="code">
function index($content = null)
{
	<span class="change">$departments = $this->so->get_department_names ();</span>
	if (is_array ($content))
	{
		<span class="change">$this->so->insert_employee (
			$content ['fname'], 
			$content ['sname'], 
			$content ['position'], 
			$content ['dep_id']
		);</span>
		$content ['debug'] = 
			"Hello " . $content ['fname'] . " " . $content ['sname'] . 
			". You are working as " . $content ['position'] . " in " . 
			 <span class="change">$departments[$content ['dep_id']] . ".\n";</span>
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
}</pre>

	<p>Only the red lines have changed. This will write every newly entered
		employee into the database in addition to displaying the welcome
		message. You can now try it out and insert a few random people. When
		you think you are done, go to the mysql command line and enter</p>

	<pre class="command">
mysql> select emp_id, sname, fname, position, dep_name 
	   from departments, employees
	   where employees.dep_id = departments.dep_id
	   order by emp_id;
+--------+---------+---------+-------------------+-------------------+
| emp_id | sname   | fname   | position          | dep_name          |
+--------+---------+---------+-------------------+-------------------+
|      1 | Snow    | John    | intern            | Tech Support      |
|      2 | Joe     | Banana  | accountant        | Management        |
|      4 | Gilmore | Lorelai | reporter          | Marketing         |
|      5 | McFly   | Marty   | product tester    | Quality Assurance |
|      7 | Bond    | James   | firing consultant | Human Resources   |
+--------+---------+---------+-------------------+-------------------+
5 rows in set (0.00 sec)</pre>

	<p>
		If you want to show the results of this query in your app, you will
		need a slightly more advanced select query that joins the two tables,
		departments and employees, together. You can use the same <span
			class="function">egw_db->select</span> function, except now you must
		set a few additional parameters.
	</p>

	<pre class="code">
function get_employees()
{
	$sel_result = $this->db->select (
		<span class="comment">tables</span>
		'departments, employees',
		<span class="comment">columns</span>
		array(
			'emp_id',
			'fname',
			'sname',
			'position',
			'departments.dep_id as dep_id',
			'dep_name',
		),
		<span class="comment">WHERE (only for comparing columns to constants.)</span>
		null,
		<span class="comment">line number (for debugging)</span>
		__LINE__,
		<span class="comment">file name (for debugging)</span>
		__FILE__,
		<span class="comment">OFFSET</span>
		false,
		<span class="comment">Additional suffix to append to the query</span>
		'ORDER BY sname DESC',
		<span class="comment">The name of you app (false means use current app)</span>
		false,
		<span class="comment">LIMIT (0 for no limit)</span>
		0,
		<span class="comment">JOIN (for comparing columns to columns.)</span>
		"where employees.dep_id = departments.dep_id"
	);
	
	$employees = array();
	foreach ($sel_result as $record)
	{
		$employees [] = $record;
	}
	
	return $employees;
}</pre>

	<p>
		Those are a lot of parameters! In order, they are called: <span
			class="var">$tables</span>, <span class="var">$columns</span>, <span
			class="var">$where</span>, <span class="var">$line</span>, <span
			class="var">$file</span>, <span class="var">$offset</span>, <span
			class="var">$suffix</span>, <span class="var">$app</span>, <span
			class="var">$limit</span> and <span class="var">$join</span>.
	</p>

	<ul>
		<li><span class="var">$table</span> contains a string with all the
			tables that are used by the query, separated by a <span
			class="string">,</span>.</li>

		<li><span class="var">$columns</span> is an array of column names.</li>

		<li><span class="var">$where</span> is an array of <span class="var">$key
				=> $value</span> pairs. Only table rows where the entry on column <span
			class="var">$key</span> matches <span class="var">$value</span> will
			be returned.</li>

		<li><span class="var">$line</span> is for debugging purposes and
			should be set to the line number via <span class="var">__LINE__</span>.</li>

		<li><span class="var">$file</span> is also for debugging purposes and
			should contain the file name via <span class="var">__FILE__</span>.</li>

		<li><span class="var">$offset</span> determines how many rows of the
			return set should be skipped. If set to false, no rows will be
			skipped.</li>

		<li><span class="var">$suffix</span> is an optional suffix that will
			be concatenated to the end of the query. You could use it to order
			the result set by a certain value, as was done in the example above.</li>

		<li><span class="var">$app</span> is the name of your app. If set to
			false, the app that is currently running will be used.</li>

		<li><span class="var">$limit</span> limits the result to a certain
			length. If it is set to 0, no limit is set.</li>

		<li>Finally, <span class="var">$join</span> can be used to join
			multiple tables together. You can not do this via the <span
			class="var">$where</span> parameter. The <span class="var">$value</span>
			of the <span class="var">$key => $value</span> pairs is expected to
			be a constant and <span class="var">$column1 => $column2</span> would
			thus be parsed to <span class="string">$column1 = '$column2'</span>.
			The result is a comparison of the content in column 1 to the <i>name</i>
			of column 2.
		</li>

	</ul>

	<p>
		Add the code above to <span class="class">helloworld_so</span>.
		Afterwards, you want to create a new file/class <span class="file">inc/class.helloworld_bo.inc.php</span>.
		It will contain all of your business logic to neatly separate it from
		all user interface and storage code. In this class, the information
		returned by <span class="function">get_employees</span> will be parsed
		into a nicely formatted string that can then be displayed by <span
			class="class">helloworld_ui</span>.
	</p>

	<pre class="code">
&lt;?php

class helloworld_bo {
	
	private $so;
	
	function __construct() {
		$this->so = new helloworld_so();
	}
	
	function get_formatted_employee_list() {
		$formatted_string = "\n\n";
		
		$employees = $this->so->get_employees();
		foreach($employees as $employee) {
			$formatted_string.= $this->emp_to_string($employee);
		}
		return $formatted_string;
	}
	
	function emp_to_string($employee) {
		return $employee ['sname'] . ", " . $employee ['fname'] . " works as " . 
		$employee ['position'] . " in " . $employee ['dep_name'] . ".\n";
	}
}</pre>

	<p>
		You should add two additional functions, <span class="function">get_department_names</span>
		and <span class="function">insert_employee</span>, which only call the
		equivalent function in <span class="class">helloworld_so</span>. This
		way, the ui object does not need direct access to the storage object.
		This is part of Egroupwares <a
			href="http://community.egroupware.org/index.php?wikipage=CodingRules">conding
			rules</a>. Everything should be structured into ui, business and
		storage objects, where higher layers call the layer directly beneath
		them.
	</p>

	<pre class="code">
function get_department_names() {
	return $this->so->get_department_names();
}

function insert_employee($fname, $sname, $position, $dep_id) {
	return $this->so->insert_employee($fname, $sname, $position, $dep_id);
}</pre>

	<p>
		Having done this, all references to the storage object can now be
		removed from <span class="class">helloworld_ui</span> and replaced by
		the business object.
	</p>

	<pre class="code">
&lt;?php
use EGroupware\Api\Etemplate;

class helloworld_ui
{
	public $public_functions = array(
			'index' => true,
	);
	<span class="change">private $bo;</span>

	function __construct()
	{
		<span class="change">$this->bo = new helloworld_bo ();</span>
		
		$GLOBALS ['egw_info'] ['flags'] ['app_header'] = 'Enter your position.';
	}

	function index($content = null)
	{
		<span class="change">$departments = $this->bo->get_department_names ();</span>
		if (is_array ($content))
		{
			<span class="change">$this->bo->insert_employee (</span>
				$content ['fname'], 
				$content ['sname'], 
				$content ['position'], 
				$content ['dep_id']
			);
			$content ['debug'] = 
				"Hello " . $content ['fname'] . " " . $content ['sname'] . ". 
				You are working as " . $content ['position'] . " in " . 
				$departments [$content ['dep_id']] . ".\n";
			<span class="change">$content ['debug'] .= $this->bo->get_formatted_employee_list();</span>
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
}</pre>

	<p>If you run the app now, you will se the following:</p>

	<img src="img/33-visible_db_entries"
		alt="The app now shows all entries within the database." />

	<p>Of course you might also want to delete or update existing database
		records. To make this possible, you will first need to update the
		interface a bit:</p>


	<img src="img/34-modified_template"
		alt="New controls for deleting and updating records." />

	<p>
		You should be able to create this yourself with the help of the <a
			href="../using_etemplate">previous section</a>. If you want to
		copy-paste the code that follows, you will need to set the <span
			class="option">Name</span> option in the editor of the select box,
		text fields and submit buttons to:
	</p>

	<ul>
		<li>Text field "First name" : select[fname]</li>

		<li>Text field "Second name" : select[sname]</li>

		<li>Submit Button "delete it" : delete</li>

		<li>Text field "New first name" : change[fname]</li>

		<li>Text field "New second name" : change[sname]</li>

		<li>Text field "New position" : change[position]</li>

		<li>Select box : change[dep_id]</li>

		<li>Submit Button "Modify" : modify</li>

	</ul>

	<p>
		Note that setting the <span class="option">Name</span> of a widget to
		<span class="string">$namespace[$key]</span> makes Egroupware group
		all widgets with equal <span class="var">$namespace</span> into the
		same subarray of <span class="var">$content</span>. This means that
		$content will not have entries like <span class="string">change[fname]</span>
		or <span class="string">change[position]</span>. It will, however,
		have an entry <span class="string">change</span>, which in turn will
		have the keys <span class="string">fname</span>, <span class="string">sname</span>,
		<span class="string">position</span> and <span class="string">dep_id</span>.
		Doing things this way keeps the <span class="var">$content</span>
		array nice and organized and prevents accidentally using the same name
		twice.
	</p>

	<p id="delete_image">
		When you do this, you will see that Egroupware automatically adds a
		little trashcan inside the delete button, if the <span class="option">Name</span>
		option is set to <span class="string">delete</span>. EGW recognizes
		quite a few keywords in this manner. Others you can try are <span
			class="string">close</span>,<span class="string">cancel</span>,<span
			class="string">edit</span> or <span class="string">create</span>. You
		will learn more about this feature in the section about <a
			href=../images_and_css>images and CSS</a>.
	</p>

	<p>
		Copy the <span class="function">delete</span> and <span
			class="function">update</span> functions below into <span
			class="class">helloworld_so</span>
	</p>

	<pre class="code"> 
function delete_employee($fname_select, $sname_select)
{
	return $this->db->delete (
		<span class="comment">table</span>
		'employees',
		<span class="comment">WHERE (comparing columns to constants)</span>
		array(
			'fname' => $fname_select,
			'sname' => $sname_select
		)
	);
}

function update_employee(
		$fname_select, $sname_select, 
		$fname_change, $sname_change, 
		$position_change, $dep_id_change
	)
{
	return $this->db->update (
		<span class="comment">table</span>
		'employees',
		<span class="comment">updated values</span>
		array(
			'fname' => $fname_change,
			'sname' => $sname_change,
			'position' => $position_change,
			'dep_id' => $dep_id_change
		),
		<span class="comment">WHERE (comparing columns to constants)</span>
		array(
			'fname' => $fname_select,
			'sname' => $sname_select
		)
	);
}</pre>

	<p>
		These both work very similarly to the <span class="function">insert</span>
		function. <span class="function">egw_db->delete</span> takes the table
		name as the first argument and an array containing <span class="var">$key
			=> $value</span> pairs as the second argument. The keys are the
		columns and the values are the constants to compare them to. All table
		rows whose entries in the key-columns match the constants will be
		deleted.
	</p>

	<p>
		<span class="function">egw_db->modify</span> also takes the table name
		as the first argument. The second argument is the data that will be
		modified. This is again an array of <span class="var">$key => $value</span>
		pairs, in the same format that was used in the <span class="function">insert</span>
		function. The third argument determines where the record should be
		updated.
	</p>

	<p>
		Both functions have additional parameters: the line number (use <span
			class="var">__LINE__</span>), file name (use <span class="var">__FILE__</span>)
		and app name. These do not need to be set, but it can be helpful for
		debugging. Both functions return an ADORecordSet if the query executed
		successfully, or false if it did not.
	</p>

	<p>
		You still should not access the storage object directly from the ui
		object. Add the following functions to <span class="class">helloworld_bo</span>.
	</p>

	<pre class="code">
function delete_employee($fname_select, $sname_select)
{
	return $this->so->delete_employee($fname_select, $sname_select);
}

function update_employee(
		$fname_select, $sname_select, 
		$fname_change, $sname_change, 
		$position_change, $dep_id_change
	)
{
	return $this->so->update_employee(
		$fname_select, $sname_select, 
		$fname_change, $sname_change, 
		$position_change, $dep_id_change
	);
}</pre>

	<p>
		Finally, it is time to update the <span class="function">index</span>
		function again.
	</p>

	<pre class="code">
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
			$this->bo->insert_employee (
				$content ['fname'], 
				$content ['sname'], 
				$content ['position'], 
				$content ['dep_id']
			);
			$content ['debug'] .= 
				"Hello " . $content ['fname'] . " " . $content ['sname'] . 
				". You are working as " . $content ['position'] . " in " . 
				$departments [$content ['dep_id']] . ".\n\n";
		}
		if ($content ['delete'] == 'pressed')
		{
			if ($this->bo->delete_employee (
				$select ['fname'], 
				$select ['sname']
			))
			{
				$content ['debug'] .= 
					$select ['fname'] . " " . 
					$select ['sname'] . 
					" was removed.\n\n";
			}
		}
		if ($content ['modify'] == 'pressed')
		{
			if ($this->bo->update_employee (
				$select ['fname'], 
				$select ['sname'], 
				$change ['fname'], 
				$change ['sname'], 
				$change ['position'], 
				$change ['dep_id']
			))
			{
				$content ['debug'] .= 
					$select ['fname'] . " " . 
					$select ['sname'] . 
					" was changed.\n\n";
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
			'change' => array('dep_id' => $departments)
	);
	
	$tmpl = new Etemplate ('helloworld.index');
	$tmpl->exec ('helloworld.helloworld_ui.index', $content, $selection_options);
}</pre>

	<p>
		This needs some explanation. First of all, after checking wether <span
			class="var">$content</span> is an array, it is now unclear which
		button was pressed. Previously this was obviously the submit button,
		because that was the only one. You can check wether a button was
		pressed via <span class="var">$content[$button_name]</span>. If the
		entry is set to <span class="string">pressed</span>, the button was
		pressed.
	</p>

	<p>If a button is determined to be pressed, the respective function
		call is made and if the query executed successfully, a note is printed
		to the debugging area.</p>

	<p>
		Note that the department-changed select box also needs to be populated
		with the department entries through the <span class="var">$selection_options</span>.
	</p>

	<p>
		Go back to Egroupware to check wether everything works. Banana Joe is
		a terrible accountant. Go and fire him. Also, Mr. Smith has
		accidentally put <span class="string">Mr.</span> as his first name. He
		is actually called <span class="string">John</span>. You should
		correct that.
	</p>


	<img src="img/35-delete_banana_joe.png" alt="Let's fire Banana Joe" />
	<img src="img/36-joe_deleted.png" alt="Banana Joe was removed." />
	<img src="img/37-rename_mr_smith.png"
		alt="Mr. Smith accidentally chose Mr. as his first name" />
	<img src="img/38-mr_smith_renamed.png"
		alt="Mr. Smith is nor John Smith" />

	<h3>Other queries</h3>

	<p>
		The functions that are part of <span class="class">egw_db</span> are
		powerful enough for most use cases, but they only represent a subset
		of possible SQL queries. Occasionally you will run into a situation
		where they just do not cut it. For these cases there is another
		function, <span class="function">egw_db->query</span>. This one only
		takes a query string and again, some debug information like line
		number and file name. Whatever the query string may be, it gets send
		to the database. This obviously means that you will have to generate
		the query string manually.
	</p>

	<h3>Conclusion</h3>

	<p>They way it is right now, the app looks a little bit ugly.
		Everything is on a single page making it cluttered and not user
		friendly. Regular users should also not have the power to delete or
		modify the entire data set. This can all be alleviated by spreading
		the ui over multiple pages and to navigate between them, you will need
		to access the sidebox. This will all be part of the next section.</p>


	<div class="download">
		<h3>Download</h3>
		<p>
			You can download the result of this section <a
				href="../../downloads/03-database_tools.zip">here</a>.
		</p>
	</div>




	<a class="back" href="#top">^ Back to top</a>

	<div class="navigation">
		<a class="prev" href="<?php echo $back_link;?>">&lt; <?php echo $back_text;?></a><a
			class="next" href="<?php echo $forw_link;?>"><?php echo $forw_text;?> &gt;</a>
	</div>




</body>
</html>