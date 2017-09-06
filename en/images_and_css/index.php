<?php
$back_link = "../nextmatch";
$forw_link = "../javascript";
$back_text = "The Nextmatch Widget";
$forw_text = "Javascript";
$title = "Images and CSS";
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

	<h2><?php echo $title;?></h2>

	<p>Images and CSS are essential tools for building good looking user
		interfaces. A little icon here or there can make your app look much
		more vibrant and make navigating faster and easier. With CSS you have
		full control over everything from textsize to color or even
		animations. Egroupware makes using these technologies easy for you as
		a programmer. In this tutorial you will see how.</p>

	<h3>Images</h3>

	<p>
		The default folder where images are stored in an app is <span
			class='file'>templates/default/images</span>. If you want special
		images for non-default skins, like pixelegg, those images go into <span
			class='file'>templates/$skin/images</span>.
	</p>

	<h4>Setting a Navbar Image</h4>

	<p>
		One of the first things you might want to do is get rid of the default
		navbar icon. The only thing you need to do to achieve this is
		designing a nice navbar icon and saving it as <span class="file">navbar.png</span>
		to the <span class="file">images/</span> folder. The image should be
		exactly 32x32 pixels in size. If you do not want to design your own,
		just use <a href="img/navbar.png">this one</a>.
	</p>

	<p>It can take a while until EGroupware clears the cache where all the
		images are stored, so you do not have to worry if it does not show up
		immediatly. Usually it helps to restart the server.</p>

	<pre class="command">apachectl restart</pre>

	<p>Once it updates, the sidebox and navbar with your app will look like
		this:</p>

	<img class="sidebox" src="img/40-sidebox.png"
		alt="The sidebox with navbar image">
	<img class="small" src="img/40.5-navbar.png"
		alt="The navbar with navbar image">

	<h4>Creating Image Buttons</h4>

	<p>
		You have already seen one part of this feature back in the section
		about <a href="../database_tools#delete_image">databases</a>. When you
		created the <span class="button">Delete</span> submit button and set
		its <span class="option">Name</span> option to <span class="string">delete</span>,
		a little trashcan appeared inside the button. These are standard
		keywords that are automatically detected by EGroupware. Here are all
		of them:
	</p>

	<img class="small" src="img/41-custom_buttons.png"
		alt="All the previously styled buttons.">

	<p>
		To make one, just use the corresponding keyword as the <span
			class="option">Name</span> option in the widget editor. As you can
		see from the screenshot, some of them even have their own special
		styling, like the <span class="button">Delete</span> button.
	</p>

	<h4>Image-only Buttons</h4>

	<p>
		You can also create buttons that only contain images. One way to do
		this is to use the preexisting ones and just leaving the <span
			class="option">Label</span> option empty, but this way you can not
		use your own images. The images for image-only buttons should be 18x18
		pixels. You can download a small collection of samples <a
			href=img/icons.zip download>here</a>. The image files should all go
		into <span class="file">$egw_installation/helloworld/templates/images</span>.
		To actually use them, create a new submit button in the eTemplate
		editor and put the filename of the image, <b>without the extension!</b>,
		into the <span class="option">Options</span> text field.
	</p>

	<img src="img/42-creating_schedule_button.png"
		alt="The image shows how to fill out the widget editor.">

	<p>If you do this and hit apply, the button should appear in the
		template. If it does not, then there might be caching problems again.
		Just wait a bit or restart the server. Below is a screenshot of
		buttons that make use of the sample button images. You can click on
		them and they work just like regular buttons.</p>

	<img class="small" src="img/43-custom_buttons.png"
		alt="The sample icons converted to buttons.">

	<h4>Big Images</h4>

	<p>
		Finally, you might want to include big images into the ui of your app.
		For that, eTemplate comes with an image widget that does nothing but
		display an image. Open the widget editor, set the <span class="option">Type</span>
		to <span class="option">Image</span> and set the <span class="option">Name</span>
		to the image filename, <b>without the file extension!</b>
	</p>

	<img src="img/44-image_settings.png"
		alt="The image shows how to configure the Image widget.">

	<h3>CSS</h3>

	<h4>Setting classes</h4>

	<p>eTemplate has some great features to layout the differrent ui
		elements of your app. You can control how everything is ordered using
		the Grid, HBox, VBox and other widgets. But if that is not enough or
		if you want some fine tuning, CSS is a quick and easy way to make your
		app look just the way you want it to.</p>

	<p>
		First of all, all styling information goes into a single file, <span
			class="file">helloworld/templates/default/app.css</span>. Now you
		just need to set the classes and ids of the ui elements to actually
		use it. In the widget editor, there is an option <span class="option">Span,
			Class</span>. Here you can enter a span and classes for each widget,
		separated by a <span class="string">,</span>. Try it out by opening
		the template <span class="string">helloworld.db_controls</span>. Open
		the widget editor for the two text fields <span class="string">select[fname]</span>
		and <span class="string">select[sname]</span> and enter <span
			class="string">,entry-select</span> to give it the class <span
			class="string">entry-select</span>.
	</p>

	<img src="img/45-fname_with_classes.png"
		alt="The select[fname] field now has CSS class entry-select">
	<img src="img/46-sname_with_classes.png"
		alt="The select[sname] field now has CSS class entry-select">

	<p>
		Now open <span class="file">helloworld/templates/default/app.css</span>
		and insert a little bit of CSS code.
	</p>

	<pre class="code">
.entry-select {
	background: pink;
}</pre>

	<p>Now open the database control page of your app and see if it worked.
		The two entry select boxes should have a pink background.</p>

	<img src="img/47-pink_boxes.png"
		alt="The entry select field with pink background">

	<h4>Using IDs</h4>

	<p>
		In addition to classes, eTemplate also assigns a unique identifier to
		each ui element whose <span class="option">Name</span> option has been
		set. Specifically, a ui element with the <span class="option">Name</span>
		<span class="string">$widgetname</span> will be assigned the id <span
			class="string">$appname-$templatename_$widgetname</span>.
	</p>

	<p>
		The <span class="button">delete it</span> button, whose <span
			class="option">Name</span> is <span class="string">delete</span>
		still looks a bit out of place. That is because EGroupware
		automatically adds a certain margin before every delete button to
		separate it from other ui elements. This is usually very convenient,
		but looks bad in this specific case. You can remove the margin by
		adding the following CSS to <span class="file">app.css</span>.
	</p>

	<pre class="code">
#helloworld-db_controls_delete {
	margin-left: 0;
}</pre>

	<p>Save the file and refresh EGroupware. The button will now be right
		next to the text.</p>

	<img src="img/48-button_margin.png"
		alt="The delete button is now right next to the text.">

	<h4>Using Firefox' Developer Tools to Make Styling Easier</h4>

	<p>The Firefox web browser provides some very helpful tools that let
		you edit the page's CSS without having to constantly refresh. The way
		EGroupware sets up each page makes using them a little bit tricky
		though. If you want to try them anyway, just follow these steps.</p>

	<p>
		First of all, if you have not done so already, you should install <a
			href="https://www.mozilla.org/de/firefox/new/?utm_medium=referral&utm_source=firefox-com">Firefox</a>.
		When you are done, open up your EGroupware installation in Firefox,
		then right click somewhere onto the page and select <span
			class="option">Inspect Element</span> from the context menu.
	</p>

	<img src="img/49-inspect_element.png" alt="The inspect element option">

	<p>
		At the bottom of your screen, an area with lots of tabs and buttons
		should pop up. These are the developer tools. The way Egroupware works
		is that it renders each app in its own individual iframe. At the
		moment the development tools only target the root frame of the
		EGroupware website. Before you can use the developer tools, you will
		have to target the iframe containing your app. To do this, click on
		the button <span class="string">Select an iframe as the currently
			targeted document.</span>, as shown in the screenshot below. The
		iframe you want to choose is the one that ends in <span class="string">menuaction=helloworld.xyz.zyx</span>.
	</p>

	<img src="img/50-select_iframe.png"
		alt="How to choose the right iFrame.">

	<p>
		Now open the style editor by clicking on the corresponding tab. If you
		want to know what all the other Tabs and buttons do, take a look at <a
			href="https://developer.mozilla.org/en-US/docs/Tools/Page_Inspector">Mozilla's
			official documentation</a>.
	</p>

	<img src="img/51-style_editor.png" alt="Opening the style editor.">

	<p>
		Firefox will now present you with a list of CSS files which are all
		included in the page somewhere. The one that belongs to your app is <span
			class="file">app.css</span>. Select it in the left pane of the style
		editor.
	</p>

	<img src="img/52-app_css.png" alt="Select the correct file.">

	<p>
		<span class="file">app.css</span> currently only has two rules: the
		ones you added earlier. It would be cool if the data rows within the
		Nextmatch widget had different colors to make them stand out a little
		bit. Type the following code into the style editor and watch every
		second row get slightly darker.
	</p>

	<pre class="code">
.egwGridView_grid tr:nth-of-type(even) {
	background: lightgrey;
}</pre>

	<p>
		<span class="class">.egwGridView_grid</span> is a CSS class that is
		set by EGroupware and is used for the HTML &lt;table&gt; that contains
		all the data of a Nextmatch widget.
	</p>

	<img src="img/53-nm_rows.png"
		alt="The Nextmatch widget with differently colored rows.">

	<p>Now you can go crazy and try adding all kinds of rules. The
		following one will indent the "change" ui elements a little bit to
		make them stand out.</p>

	<pre class="code">
#helloworld-db_controls_change\[fname\], 
#helloworld-db_controls_change\[sname\], 
#helloworld-db_controls_change\[position\], 
#helloworld-db_controls_change\[dep_id\]{
	margin-left: 20px;
}</pre>

	<img src="img/54-prettyfied.png" alt="The change ui is now indented.">

	<p>
		Once you are happy with your design, <b style>DO NOT FORGET!</b> to
		copy and paste everything you edited into the <span class="file">app.css</span>
		file. When you are editing in the Style Editor, you are only editing a
		local copy of the CSS file. Your changes need to be made permanent
		manually or all your work will be lost.
	</p>

	<h3>Conclusion</h3>

	<p>This is all you need to know to get started with CSS and images in
		Egroupware. You now have access to everything they have to offer and
		full creative freedom over the look and feel of the user interface.
		The last big technology you might want to use is Javascript. This will
		be covered in the next section.</p>



	<div class="download">
		<h3>Download</h3>
		<p>
			You can download the result of this section <a
				href="../../downloads/06-images_and_css.zip">here</a>.
		</p>
	</div>










	<a class="back" href="#top">^ Back to top</a>

	<div class="navigation">
		<a class="prev" href="<?php echo $back_link;?>">&lt; <?php echo $back_text;?></a><a
			class="next" href="<?php echo $forw_link;?>"><?php echo $forw_text;?> &gt;</a>
	</div>
</body>
</html>