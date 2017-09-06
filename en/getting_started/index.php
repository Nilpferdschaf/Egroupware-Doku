<?php
$back_link = "../index.php";
$forw_link = "../using_etemplate";
$back_text = "Index";
$forw_text = "Using eTemplate";
$title = "Getting Started";
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




	<h2>Writing Apps for EGroupware: Getting started</h2>
	<h3>About EGroupware</h3>
	<p>EGroupware is an online open source group collaboration tool whose
		features include email, calendar appointments, project tracking
		systems and many more. But all that does not matter if you require a
		specific feature unique to your organisation. In this case Egroupware
		provides programming interfaces that make it easy to write your own
		custom plugins.</p>
	<p>
		In this section of the tutorial you will build a minimal application,
		the classic <span class="app">Hello world</span>. The hardest part
		will be to get Egroupware to recognize your application. To follow
		this tutorial, EGroupware should already be installed. If it is not,
		take a look at the <a
			href="https://github.com/EGroupware/egroupware/tree/16.1">EGroupware
			Github page</a> and come back once you are done.
	</p>
	<h3>Writing the application</h3>
	<p>To start off, you need to add some files to the EGroupware
		installation directory. EGroupware will look for these files and if it
		finds them, make the application available for installation.</p>
	<p>The application structure looks like this:</p>
	<div class="code">
		$egw_installation/<br>
		<div class="folder">
			helloworld/<br>
			<div class="folder">
				index.php<br> inc/<br> setup/
				<div class="folder">setup.inc.php</div>
				templates/
				<div class="folder">
					default/
					<div class="folder">images/</div>
				</div>
			</div>
		</div>
	</div>
	<p>
		Everything you do from now on will happen within the folder <span
			class="file">helloworld/</span>. This will also be the name of your
		application. Within this folder is <span class="file">index.php</span>.
		EGroupware returns this file every time the application is accessed
		and it will therefore mark the entry point to all other code your
		write. If you know Java or C, you can think of this file as the <span
			class="function">main</span> function. It should set everything up,
		but ultimately call some other code. That is what <span class="file">inc/</span>
		is for: It contains the entire rest of the codebase.
	</p>

	<p>
		The <span class="file">setup/</span> folder contains everything EGW
		needs to know to install the application. For now, the only content
		will be <span class="file">setup.inc.php</span>.
	</p>

	<p>
		Next up, <span class="file">templates/</span> will contain UI
		templates and images used within the application. We will not use this
		until later, so it is empty for now except for some basic structure.
	</p>

	<p>
		You will now fill <span class="file">index.php</span> with the Hello
		World code. As there is so little to it, there is no need to use <span
			class="file">inc/</span> yet. This will change in the future, of
		course.
	</p>

	<pre class="code">
&lt;html&gt;
	&lt;head&gt;
		&lt;title&gt;Hello World&lt;/title&gt;
	&lt;/head&gt;
	&lt;body&gt;
		&lt;h1&gt;Hello World!&lt;/h1&gt;
	&lt;/body&gt;
&lt;/html&gt;</pre>

	<p>
		Now head over to your EGroupware installation at <span class="url">http://$your_domain/egroupware</span>.
		You will notice the app is not there yet. Before you can access it, it
		needs to be registered and installed within EGW and made available to
		your account. For the first step, you just need to edit <span
			class="file">setup.inc.php</span> to contain some basic
		meta-information:

	</p>

	<pre class="code">
&lt;?php
$setup_info ['helloworld'] = array(
	'name' => 'helloworld',
	'title' => 'Hello World',
	'version' => '0.001',
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
</pre>

	<h3>Registering, Installation and Access Control</h3>

	<p>
		To install the application, you should now go to <span class="url">http://$your_domain/egroupware/setup</span>,
		log in and click on <span class="button">Manage Applications</span>.
		You should be able to find the name of the app within the list that is
		displayed to you. Once you have, tick the installation checkmark next
		to it and then press <span class="button">Save</span> at the bottom of
		the page. If everything goes alright, the app is now installed.
	</p>

	<img src="img/00-setup_page.png" alt="The EGroupware setup page" />
	<img src="img/01-install.png" alt="Installing an App" />

	<p>
		There is one more step, which is giving you the rights to actually
		launch the application. To do so, go back to <span class="url">http://$your_domain/egroupware/</span>
		and log in again, this time using an account with admin rights. Select
		the admin-tab on the left, right click on your account, choose <span
			class="button">Access Control</span>, click on <span class="button">Add</span>,
		tick <span class="option">Hello World</span>, press <span
			class="button">OK</span> and then <span class="button">Close</span>.<br>Refresh
		the page and you should see <span class="app">helloworld</span> in the
		sidebar. Click on it.
	</p>

	<img src="img/02-admin_page.png"
		alt="Choose Access Control on the admin page" />
	<img src="img/03-access_control.png"
		alt="Give yourself access to the app" />
	<img src="img/04-hello_world.png" alt="The Hello World app" />

	<h3>Conclusion</h3>

	<p>Congratulations! You have written your first plugin for EGroupware!</p>

	<p>Next up, we will have a look at using eTemplate, EGroupwares very
		own templating engine.</p>


	<div class="download">
		<h3>Download</h3>
		<p>
			You can download the result of this section <a
				href="../../downloads/01-getting_started.zip">here</a>.
		</p>
	</div>


	<a class="back" href="#top">^ Back to top</a>

	<div class="navigation">
		<a class="prev" href="<?php echo $back_link;?>">&lt; <?php echo $back_text;?></a><a
			class="next" href="<?php echo $forw_link;?>"><?php echo $forw_text;?> &gt;</a>
	</div>
</body>
</html>