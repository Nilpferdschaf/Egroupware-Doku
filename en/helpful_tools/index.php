<?php
$back_link = "../javascript";
$forw_link = "../";
$back_text = "Javascript";
$forw_text = "Back to Index";
$title = "Other Helpful Tools";
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
		choose <span class="option">New > Connection...</span>. Choose the
		kind of connection you want, enter your server details and connect.
		Your server should now show up in the sidebar.
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
		directory, the current setup is unnecessarily messy. To single out a
		specific directory, navigate to it in the folder tree, then right
		click to select <span class="option">Create Remote Project</span>.
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
		<a href="https://en.wikipedia.org/wiki/Xdebug" target="_blank">XDebug</a>
		allows you to set breakpoints and step through each line of php code
		that you have written, while the program is running on your server.
		You can even see the values of each variable and a stack trace, so you
		always know exactly what is going on. This is a tremendous help when
		trying to find bugs in large projects. It already comes preinstalled
		with Eclipse-PHP, but some additional setup is required. If you want
		to use this tool, follow the instructions described <a
			href="https://wiki.eclipse.org/Debugging_using_XDebug"
			target="_blank">here</a>.
	</p>

	<h3>File Downloads</h3>

	<p>Sometimes your users might want to export data from your app so they
		can use it in external programs. If you want to enable this, you will
		need the following lines of code</p>

	<pre class="code">
function download_csv (
		$file_name, 
		$file_content, 
		$mime='',
		$length=0,
		$nocache=True,
		$forceDownload=true
	)
{
	html::content_header (
		$file_name, 
		$mime, 
		$length, 
		$nocache, 
		$forceDownload
	);
	
	echo $file_content;
	
	common::egw_exit ();
}</pre>

	<p>
		This works mostly like downloading files works usually, except now
		there are special EGW API functions that make sure your download does
		not interfere with everything else EGW is doing in the background. <span
			class="function">html::content_header</span> automatically generates
		download headers and <span class="function">common::egw_exit</span>
		stops the execution of the program.
	</p>

	<h3>Translation Tools</h3>

	<p>The translation tools can be used if you want to support multiple
		languages in your app. You can add them like any other plugin via the
		access control dialog in the admin app. Once you are done, it will
		show up in the sidebar.</p>

	<img alt="The link to the translation tools"
		src="img/75-translation_tools.png">

	<p>
		Before you start using the translation tools, you should first create
		a subdirectory <span class="file">helloworld/lang/</span> and give
		your server writing rights to it. To do this, navigate to the <span
			class="file">helloworld/</span> directory and execute the following
		commands:
	</p>

	<pre class="command">
mkdir lang
chown www-data lang</pre>

	<p>The first thing you will see when you click on it is a long list of
		all the installed apps. You want to add translations for helloworld,
		so click on the edit button after it.</p>

	<img alt="Choosing the app to translate for" src="img/76-edit_lang.png">

	<p>
		Now you need to specify the source and target language. Your app is
		written in English and in this case, the translation will be German.
		Click on <span class="button">Load</span> once you are done.
	</p>

	<img alt="Choosing the languages to translate between"
		src="img/77-load_translation.png">

	<p>
		You can now start adding new phrases. To do so, click on <span
			class="button">Add new Phrases</span>.
	</p>

	<img alt="Adding new phrases" src="img/78-new_phrase.png">

	<p>Enter some translations for phrases in you UI.</p>

	<img alt="Entering translation for first name"
		src="img/79-trans_fname.png">
	<img alt="Entering translation for second name"
		src="img/80-trans_sname.png">

	<p>
		Up until now, all the translations that you entered will only be
		applied to your app. You can choose the scope of your translations in
		the select box at the top of the screen. If you select <span
			class="option">helloworld</span>, the translations will only work
		within your app. <span class="option">common</span> is the most broad
		scope. These translations will be applied everywhere and should
		therefore be used sparsely, because they might interfere with
		translations from other apps. You need to use this scope to translate
		the actual name of your app.
	</p>

	<img alt="Common translations" src="img/81-choose_common.png">

	<p>
		If you are done translating, click the <span class="button">Add</span>
		button to go back to the main view.
	</p>

	<img alt="Entering translation for helloworld"
		src="img/82-trans_helloworld.png">

	<p>
		EGroupware presents to you a list of all the translations and you are
		able to make some last minute changes, before you commit them. Do not
		forget to click <span class="button">Save</span>. Once you are happy
		with everything, click on the <span class="button">Write</span> button
		under Step #3.
	</p>

	<img alt="Write file for en-de translation" src="img/83-write_file.png">

	<p>
		There is one more thing you should do, which is writing an English to
		English translation. This is helpful, because it allows you to change
		the text inside your app, without editing the code. Start by selecting
		<span class="option">English</span> as your target language, click <span
			class="button">Load</span>, enter the translations for everything and
		click on <span class="button">Write</span> once you are happy with
		them.
	</p>

	<img alt="Write file for en-en translation"
		src="img/84-write_en_file.png">

	<p>To see the results of your work, you just need to go to the
		preferences and change the language of EGroupware.</p>

	<img alt="Switch language" src="img/85-switch_language.png">

	<p>
		You might also want to take a look at the <span class="file">lang</span>
		directory again. EGroupware has generated two files in this directory:
		<span class="file">egw_en.lang</span> and <span class="file">egw_de.lang</span>.
	</p>

	<h3>How everything works together</h3>

	<p>The last thing you need to know is a bit of trivia on how to
		navigate EGroupwares codebase and how the program sets up its
		functionality. This is partly because there are still a lot of
		functions which were not presented in this tutorial and which are not
		centrally documented anywhere else, and partly because it can be quite
		helpful see sample code of the things you want to implement yourself.</p>

	<h4>API functions</h4>

	<p>
		All API functions that EGroupware provides are somewhere within the <span
			class="file">phpgwapi</span> and <span class="file">api</span>
		directories. Though you should be aware that <span class="file">phpgwapi</span>
		is slowly being deprecated and will be phased out over time. The most
		notable files are <span class="file">phpgwapi/inc/class.egw_framework.inc.php</span>
		and <span class="file">phpgwapi/inc/class.html.inc.php</span>. These
		provide all the static functions that enable you to display messages
		or enable file downloads. Basically all HTML-related features you can
		not use with eTemplate.
	</p>

	<h4>eTemplate</h4>

	<p>
		Speaking of which, everything related to eTemplate is inside the <span
			class="file">api/src/etemplate/</span> and <span class="file">api/js/etemplate</span>
		folder. Most of the functionality is implemented in Javascript, so you
		should look inside <span class="file">api/js/etemplate/</span> first.
	</p>

	<h4>Calendar, Mail and Admin</h4>

	<p>These programs do not provide an API, but they are fairly large and
		well documented plugins. Whenever you are not sure how to do a certain
		task, you should look here first, because the chance to find a working
		implementation of the thing you need somewhere in their codebases is
		quite high.</p>

	<h4>Global variables</h4>

	<p>Finally, there are some global variables and objects you should know
		of that can provide helpful services to you. You can view all of these
		and their contents if you have already set up XDebug.</p>

	<p>
		<span class="var">$GLOBALS['egw']</span> is one that you have already
		used in the <a href="../database_tools#egw_db">database section</a> to
		access the global database connection object, <span class="var">$GLOBALS['egw']->db</span>.
		Most API related objects are accessible somewhere through <span
			class="var">$GLOBALS['egw']</span>. If you want to change some
		account settings of a user, you will need <span class="var">$GLOBALS['egw']->accounts</span>
		or if you want to provide your own hooks, that other plugins can use,
		take a look at <span class="var">$GLOBALS['egw']->hooks</span> and the
		corresponding implementation <span class="file">phpgwapi/inc/class.hooks.inc.php</span>.
	</p>

	<p>
		The other global variable you should know is <span class="var">$GLOBALS['egw_info']</span>.
		This is the main object you want to use if you need any meta
		information about EGroupware or the user of your app. <span
			class="var">$GLOBALS['egw_info']['server']</span> contains all kinds
		of information about the instance of EGroupware that is running in the
		background, <span class="var">$GLOBALS['egw_info']['apps']</span> has
		all the information you need about the apps that are installed and <span
			class="var">$GLOBALS['egw_info']['user']</span> is full of user
		related data, like their name, when they last logged in, or their
		email address.
	</p>

	<h3>Conclusion</h3>

	<p>This concludes the tutorial. If you have played around with
		everything that was shown, you will now have extensive knowledge about
		the workings of EGroupware. You should be able to set up your own
		applications, design their user interface, make it pretty and connect
		to a database to populate it. You are able to customize the behaviour
		of the app to your needs using JavaScript and if you do not know how
		to implement a specific feature, you can just go through the codebase
		and find the thing you need. Some of the most sophisticated tools in
		web development aid you in this task.</p>

	<p>Congratulations, you can now rightly call yourself an EGroupware
		developer.</p>



	<a class="back" href="#top">^ Back to top</a>

	<div class="navigation">
		<a class="prev" href="<?php echo $back_link;?>">&lt; <?php echo $back_text;?></a><a
			class="next" href="<?php echo $forw_link;?>"><?php echo $forw_text;?> &gt;</a>
	</div>
</body>
</html>