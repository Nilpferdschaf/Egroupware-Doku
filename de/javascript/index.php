<?php
$back_link = "../images_and_css";
$forw_link = "../helpful_tools";
$back_text = "Images and CSS";
$forw_text = "Other Helpful Tools";
$title = "Javascript";
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

	<h2>JavaScript</h2>

	<p>
		JavaScript has quickly become the status quo for creating rich
		interactive web apps and has been the most popular technology on <a
			href="http://stackoverflow.com/research/developer-survey-2016#technology-most-popular-technologies">StackOverflow</a>
		developer surveys for over the last three years. It is only natural
		that EGroupware integrates well with JavaScript. You will learn how it
		works in this section.
	</p>

	<h3>Setup</h3>

	<p>
		The first thing you need to do to start adding JavaScript is to create
		a new folder <span class="file">helloworld/js</span> and then add a
		file <span class="file">app.js</span> inside. Add the following code
		to this file.
	</p>

	<pre class="code">
@augments AppJS
app.classes.helloworld = AppJS.extend({
	appname : 'helloworld',
	
	
	init : function() {
		this._super.apply(this, arguments);
	},
	
	et2_ready : function(et2, templ_name) {
		this._super.apply(this, arguments);
	},
	
	destroy : function() {
		this._super.apply(this, arguments);
	},
});</pre>

	<p>
		You are basically setting up a JavaScript library for your app that
		can then be used by EGroupware. Use the <span class="function">init</span>
		function to set up everything you need to use the library. <span
			class="function">destroy</span> is a destructor function that should
		contain everything necessary to clean up resources once the app is
		closed. Finally, <span class="function">et2_ready</span> is called
		once all eTemplate functionality is loaded and ready to go. The
		arguments to this function contain references to the eTemplate2 object
		that was created and the name of the template. All three functions
		should first call their parent functions.
	</p>

	<p>
		Saving the et2 reference to a library variable is often useful,
		because it contains some helpful functions for manipulating the
		template. This can be done very easily by just including a variable <span
			class="var">et2</span> and setting it to <span class="var">null</span>.
		The variable will automatically be set to be a reference to the
		eTemplate object. Whenever you do this, you should not forget to clean
		up the reference in the <span class="function">destroy</span>
		function.

	</p>

	<pre class="code">
@augments AppJS
app.classes.helloworld = AppJS.extend({
	appname : 'helloworld',
	
	<span class="change">et2: null,</span>
	
	init : function() {
		this._super.apply(this, arguments);
	},
	
	et2_ready : function(et2, templ_name) {
		this._super.apply(this, arguments);
	},
	
	destroy : function() {
		this._super.apply(this, arguments);
		
		<span class="change">delete this.et2;</span>
	},
});</pre>

	<h3>Executing Code on UI Widget State Change</h3>

	<p>
		Before you start adding mor JavaScript, you will need to go to the
		eTemplate editor once more. Open the <span class="file">helloworld.index</span>
		template and double click on one of the text boxes. The widget editor
		that opens has two options near the bottom that you have not yet
		looked at. Both <span class="option">onClick</span> and <span
			class="option">onChange</span> can be used to trigger JavaScript.
		Just select <span class="option">custom</span> in the dropdown and
		write whatever JavaScript code you want in the text box next to it.
		This can be a simple <span class="var">alert("hi");</span> or
		something like <span class="var">app.helloworld.preview();</span>,
		which will call a function <span class="function">preview</span>
		inside your <span class="file">app.js</span> library.
	</p>

	<img src="img/55-choose_custom.png"
		alt="Setting a custom onChange() function">

	<p>
		Add this code to the text fields and to the department select box. The
		<span class="function">preview</span> function will be triggered
		whenever the content of one of these ui elements changes and update a
		little preview text that shows the user what will be inserted into the
		database.
	</p>

	<pre class="code">
preview : function() {
	var fname = this.et2.getWidgetById("fname").get_value();
	var sname = this.et2.getWidgetById("sname").get_value();
	var position = this.et2.getWidgetById("position").get_value();
	var dep_widget = this.et2.getWidgetById("department")
	var dep_id = dep_widget.get_value();
	var department = dep_widget.options.select_options[dep_id].label;
	
	var prev_text = this.et2.getWidgetById("preview-text");
	var prev_string = "";
	if (fname.length > 0) {
		prev_string += "If you click submit, you will be entered as " + fname;
		
		if(sname.length > 0) {
			prev_string += " " + sname;
			
			if (position.length > 0) {

				prev_string += ", working as " + position + " in " + department;
			}
		}
	}
	prev_text.set_value(prev_string + ".");
},</pre>

	<p>
		This code utilizes the reference to the <span class="var">et2</span>
		object and its <span class="function">getWidgetById</span> function.
		It works similar to <span class="function">document.getElementById</span>
		in that it returns the eTemplate 2 widget with the given id, which is
		set by the <span class="option">Name</span> option in the eTemplate
		editor. Calling <span class="function">get_value</span> on an et2
		widget returns its value, i.e. the content of a text field or the
		selected entry of a select box. The selected entry needs to be
		dereferenced first by accessing the <span class="var">options</span>
		property of the select box. It contains, next to other information,
		the options that can be selected by the user.
	</p>

	<p>
		Depending on how much information has already been input by the user,
		a string is generated that describes the information that will be
		written to the database. Lastly the content of a label whose <span
			class="option">Name</span> is <span class="string">preview-text</span>
		will be set to this string. You need to create this label first before
		you can continue.
	</p>

	<img src="img/56-prev_label.png"
		alt="The settings of the preview label">

	<p>Save the template and open your app. You can now start inputing a
		name and position. Whenever you switch to a new field, the text of the
		preview label will change to accomodate for your input.</p>

	<img src="img/57-no_input.png" class="small" alt="No input set yet">

	<img src="img/58-fname_set.png" class="small"
		alt="The preview label when only the first name is set">

	<img src="img/59-sname_set.png" class="small"
		alt="The preview label when the first and second name a re set">

	<img src="img/60-filled.png" class="small"
		alt="The preview label when everything is set.">


	<h3>The eTemplate 2 JavaScript Library</h3>

	<p>
		If you want to manipulate the user interface with JavaScript, it is
		helpful to know a few important functions that are part of the
		eTemplate 2 JavaScript library. These are all accessed through the et2
		variable. You have already seen one of these functions, namely <span
			class="function">getWidgetById</span>.
	</p>

	<h4>Class diagram of selected widgets and functions</h4>

	<p>
		As we have seen earlier, the <span class="function">getWidgetById</span>
		function can be used to get an eTemplate 2 UI widget object. Widgets
		all augment the <span class="class">et2_widget</span> prototype. Its
		source code can be found at <span class="file">$egw_install/etemplate/js/et2_core_widget.js</span>.
		The augmentations can be found inside the <span class="file">$egw_install/etemplate/js/et2_widget_$widgettype.js</span>
		files.
	</p>

	<p>If you want to know the architecture of the et2 JavaScript library,
		you can take a look at the following class diagram (click to enlarge).
		It does not contain every widget, attribute and function in the entire
		library, but it will give you a good overview about the different
		augmentations and functionalities.</p>

	<a href="img/61-et2_js_uml.png" target="_blank"><img
		src="img/61-et2_js_uml.png"
		alt="A class diagramm of the et2 js library."></a>

	<p>As you can see, there are a lot of possibilities to make your app
		behave exactly the way you want it to. To see how it works, you will
		now implement a simple password checker that informs users of how
		strong their password is. The end result is supposed to look like the
		screenshot below.</p>

	<img src="img/62-ui_with_pass.png"
		alt="User interface with two password fields">
	<img src="img/63-ui_with_pass_fill.png"
		alt="User interface with two password fields in action">

	<p>
		To get started, add the two password boxes to the UI. This can be done
		in the eTemplate editor by chosing the widget <span class="option">Type</span>
		Password. The first Password box has the <span class="option">Name</span>
		<span class="string">pass1</span> and the second one has <span
			class="string">pass2</span>.
	</p>

	<img src="img/64-pass1.png" alt="Settings for the first password box">

	<p>
		Now that the password boxes exist, it is time to turn them
		interactive. Open your application's <span class="file">app.js</span>
		file to add EventListeners to the password boxes inside the <span
			class="function">et2_ready</span> function.
	</p>

	<pre class="code">
pass1: null,
pass2: null,
	
et2_ready : function(et2, templ_name) {
	this._super.apply(this, arguments);
	
	if (templ_name == "helloworld.index") {
		this.pass1 = this.et2.getWidgetById("pass1");
		this.pass2 = this.et2.getWidgetById("pass2");

		this.pass1.getInputNode().addEventListener("keyup", this.pass1_key_evt);
		this.pass2.getInputNode().addEventListener("keyup", this.pass2_key_evt);
	
		this.et2.getWidgetById("submit").set_readonly(true);
	}
},</pre>

	<p>
		The first thing that happens here is we create two additional
		references to <span class="var">pass1</span> and <span class="var">pass2</span>
		and initialize them using <span class="function">getWidgetById</span>.
	</p>

	<p>
		The next step is to call <span class="function">getInputNode</span> on
		them. This function can be called on any given <span class="class">et2_inputWidget</span>
		and returns the DOM object that creates the widget. Adding the
		KeyListeners ist now just a regular call to <span class="function">addEventListener</span>.
	</p>

	<p>
		One last thing you can do is disabling the submit button by calling <span
			class="function">set_readonly</span>. This way users can not submit
		the form for now. You will reenable it later once the password boxes
		are filled in correctly.
	</p>

	<p>
		Now you need to implement the two EventListener functions <span
			class="function">check_passw_strength</span> and <span
			class="function">check_equal</span>.
	</p>

	<pre class="code">
pass1_key_evt : function(evt) {
	var pass1 = app.helloworld.pass1;
	var pass2 = app.helloworld.pass2;
	pass2.set_value("");
	pass2.hideMessage();
	
	app.helloworld.et2.getWidgetById("submit").set_readonly(true);
	if (pass1.get_value().length &lt; 8) {
		pass1.showMessage("Password needs to have 8 characters or more!","error");
		
	} else if (pass1.get_value().length &lt; 12) {
		pass1.showMessage("Password is fine, but could be stronger", 'hint');
		
	} else {
		pass1.showMessage("Great password","success");
		
	}
	
	this.focus();
},

pass2_key_evt : function(evt) {
	var pass1 = app.helloworld.pass1;
	var pass2 = app.helloworld.pass2;
	
	app.helloworld.et2.getWidgetById("submit").set_readonly(true);
	
	var strong = pass1.get_value().length >= 8;
	var equal = pass1.get_value() == pass2.get_value();
	
	if (equal) {
		pass2.showMessage("Passwords match.","success");
	} else {
		pass2.showMessage("The passwords do not match!","error");
	}
	app.helloworld.et2.getWidgetById("submit").set_readonly(!(strong && equal));
	
	this.focus();
},</pre>

	<p>
		Two new functions are used in this code. <span class="function">showMessage</span>
		is part of <span class="class">baseWidget</span> and displays a
		message to the user. It takes two arguments. The first contains the
		string that will be displayed to the user, the second one is an
		identifier string that specifies what type of message will be
		displayed. The three types of message are <span class="string">validation_error</span>,
		<span class="string">hint</span> and <span class="string">success</span>.
		The example uses all three of them, so you can see what they look
		like. The other new function is <span class="function">hideMessage</span>
		which removes the message again.
	</p>

	<h3>The Firefox Developer Console and debugger</h3>

	<p>Once your projects get bigger, it can become quite painful to debug
		all of your JavaScript code. Most major browsers provide developer
		tools for this purpose, except using them with EGroupware can be a bit
		tricky unless you know a few tricks. The following hints can be used
		with the Firefox web browser.</p>

	<h4>The Developer Console</h4>

	<p>
		To open the console in Firefox, go to your open EGroupware tab and
		press ctrl+shift+k. To give you an idea of what you can go to <a
			href="https://developer.mozilla.org/en-US/docs/Tools/Web_Console">the
			official developer console documentation</a>. There is only one
		additional step you need to take before you can get going. EGroupware
		places you app inside an iFrame on the page. You need to select this
		iFrame as the currently targeted document, which can be done in the
		upper right corner of the developer tools.
	</p>

	<img src="img/66-select_iframe.png"
		alt="How to select the right iFrame.">

	<p>
		You can now directly access all JavaScript objects that are part of
		your app through the console. They are all inside <span class="var">app.helloworld</span>.
		Type this into the command line and press return. If you now click on
		the object that is being returned, you can see on all its attributes
		on the right, including the <span class="var">pass1</span>, <span
			class="var">pass2</span> and <span class="var">et2</span> variables.
	</p>

	<img src="img/67-helloworld_object.png" alt="The helloworld object.">

	<p>
		Now it is time to play around. Try out the different functions from
		the library and see what they do and how they work. If you have no
		idea what a function might do, you are encouraged to check out its
		source code in the corresponding <span class="file">etemplate/js/et2_*.js</span>
		file. The class diagram from earlier is very helpful for this, because
		it shows you how everything augments everything else.
	</p>

	<pre class="code">
>app.helloworld;
	Object { _super: undefined, egw: Object, et2: Object, pass1: Object, pass2: Object }
>var et2 = app.helloworld.et2;
	undefined
>var pass1 = app.helloworld.pass1;
	undefined
>var pass2 = app.helloworld.pass2
	undefined
>pass1.showMessage("This is a hint", "hint");
	undefined
>pass2.showMessage("This is a success", "success");
	undefined
>et2.getWidgetById("fname").set_value("Jim");
	undefined
>et2.getWidgetById("sname").set_blur("Clark");
	undefined
>et2.getWidgetById("position").set_height(50);
	undefined
>et2.getWidgetById("department").set_multiple(true);
	undefined
>et2.getWidgetById("department").set_height(150);
	undefined
>et2.getWidgetById("department").set_width(150);
	undefined
>et2.getWidgetById("department").set_value("0,2,3");
>var submit = et2.getWidgetById("submit");
	undefined
>submit.set_readonly(true);
	undefined
>submit.getDOMNode().style.background = "red";
	"red"
>submit.getDOMNode().style.transform="rotate(-30deg)"
	"rotate(-30deg)"</pre>

	<img src="img/68-console_result.png" class="small"
		alt="Playing around with the console.">


	<h4>The Debugger</h4>

	<p>
		You can open the debugger by pressing ctrl+shift+s. The official
		documentation for this tool can be found <a
			href="https://developer.mozilla.org/en-US/docs/Tools/Debugger">here</a>.
		Like before, you need to select the right iframe in the rop right
		corner, but once you have done that, you are good to go.
	</p>

	<p>On the left inside the debugging window, you will see a list of
		source files. All except app.js are provided by EGroupware. If you
		click on app.js, you should see the source code that you have written
		earlier. You can now start setting breakpoints and debugging as much
		as you want.</p>

	<h3>Conclusion</h3>

	<p>You should now have a good idea how the EGroupware JavaScript
		library works and how you can work with it in practice. This tutorial
		did not cover every function in detail, but you know how and where to
		find the missing information. The next and last section will cover
		some other tools and functions that might help you in the future.</p>







	<a class="back" href="#top">^ Back to top</a>

	<div class="navigation">
		<a class="prev" href="<?php echo $back_link;?>">&lt; <?php echo $back_text;?></a><a
			class="next" href="<?php echo $forw_link;?>"><?php echo $forw_text;?> &gt;</a>
	</div>
</body>
</html>