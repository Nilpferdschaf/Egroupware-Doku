<?php
$back_link = "../javascript";
$forw_link = "../";
$back_text = "Javascript";
$forw_text = "Index";
$title = "Other Helpful Tools";
?>

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
	<a class="back" href="index.php">Back to Index</a>

	<h2><?php echo $title?></h2>

	<h3>Eclipse</h3>

	<p>
		If you want to code your app inside a fully-fledged IDE on a client
		computer instead of directly on the server, you should take a look at
		Eclipse. It is free and open source and supports many useful plugins.
		There is even a version specifically designed for web development
		called Eclipse-PHP. The download together with installation
		instructions can be found <a
			href="http://www.eclipse.org/downloads/packages/eclipse-php-developers/heliosr">here</a>.
	</p>

	<h4>Connecting to a Server</h4>

	<p>
		To connect to your server, open Eclipse and choose <span
			class="option">Window > Perspective > Open Perspective > Remote
			System Explorer</span>. Now right click into the left sidebar and
		chose <span class="option">New > Connection...</span>. Choose the kind
		of connection you want, enter your server details and connect. Your
		server should now show up in the sidebar.
	</p>

	<img src="img/70-remote_system_explorer.png" class="small"
		alt="Open Remote System Explorer Perspective">
	<img src="img/71-new_connection.png" alt="Setup new Connection">
	<img src="img/72-remote_system_connect.png"
		alt="Choose Connection Type">

	<h4>Creating a Remote Project</h4>

	<p>
		Your server is now visible in the sidebar, but Eclipse shows you the
		entire file system, starting at <span class="file">/</span>. If you
		want to work on multiple projects at once, where each has its own
		directory, the current setup is unnecessarily messy. If you want to
		single out a specific directory, navigate to it in the folder tree,
		then right click on it to select <span class="option">Create Remote
			Project</span>.
	</p>

	<img src="img/73-remote_project.png"
		alt="Creating a remote project from a server directory">

	<p>
		Now switch to the <span class="option">PHP</span> tab at the top of
		the window. You should see the newly created project in the sidebar,
		where you can start opening and editing files.
	</p>

	<img src="img/74-php_tab.png" alt="The project inside the sidebar">

	<h4>XDebug</h4>

	<p>
		<a href="https://en.wikipedia.org/wiki/Xdebug" target="_blank">XDebug</a> allows you
		to set breakpoints and step through each line of php code that you
		have written, while the program is running on your server. You can
		even see the values of each variable adn a stack trace, so you always
		know exactly what is going on. This is a tremendous help when trying
		to find bugs in large projects. It already comes preinstalled with
		Eclipse-PHP, but some additional setup is required. If you want to use
		this tool, follow the instructions described <a
			href="https://wiki.eclipse.org/Debugging_using_XDebug" target="_blank">here</a>.
	</p>
	
	<h3>Important Egroupware API Functions</h3>
	
	<h4>Messages</h4>
	
	<p>If you want to notify your users of something, you can show them </p>
	
	<h4>File Downloads</h4>
	
	<p>Sometimes your users might want to export data from your app so they can use it in external programs. If you want to do this, </p>






	<a class="back" href="#top">^ Back to top</a>

	<div class="navigation">
		<a class="prev" href="<?php echo $back_link;?>">&lt; <?php echo $back_text;?></a><a
			class="next" href="<?php echo $forw_link;?>"><?php echo $forw_text;?> &gt;</a>
	</div>
</body>
</html>