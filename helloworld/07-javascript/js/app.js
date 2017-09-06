app.classes.helloworld = AppJS.extend({
	appname : 'helloworld',

	et2 : null,
	pass1: null,
	pass2: null,

	init : function() {
		this._super.apply(this, arguments);
	},

	et2_ready : function(et2, templ_name) {
		this._super.apply(this, arguments);
		
		if (templ_name == "helloworld.index") {
			this.pass1 = this.et2.getWidgetById("pass1");
			this.pass2 = this.et2.getWidgetById("pass2");

			this.pass1.getInputNode().addEventListener("keyup", this.pass1_key_evt);
			this.pass2.getInputNode().addEventListener("keyup", this.pass2_key_evt);
		
			this.et2.getWidgetById("submit").set_readonly(true);
		}
	},

	destroy : function() {
		this._super.apply(this, arguments);

		delete this.et2;
	},
	
	preview : function() {
		var fname = this.et2.getWidgetById("fname").get_value();
		var sname = this.et2.getWidgetById("sname").get_value();
		var position = this.et2.getWidgetById("position").get_value();
		var dep_widget = this.et2.getWidgetById("dep_id")
		var dep_id = dep_widget.get_value();

		var department = 0;
		for (var i = 0; i < dep_widget.options.select_options.length; i++) {
			if (dep_widget.options.select_options[i].value == dep_id) {
				department = dep_widget.options.select_options[i].label;
			}
		}

		var prev_text = this.et2.getWidgetById("preview-text");
		var prev_string = "";
		if (fname.length > 0) {
			prev_string += "If you click submit, you will be entered as "
					+ fname;

			if (sname.length > 0) {
				prev_string += " " + sname;

				if (position.length > 0) {

					prev_string += ", working as " + position + " in "
							+ department;
				}
			}
		}
		prev_text.set_value(prev_string + ".");
	},
	
	pass1_key_evt : function(evt) {
		var pass1 = app.helloworld.pass1;
		var pass2 = app.helloworld.pass2;
		pass2.set_value("");
		pass2.hideMessage();
		
		app.helloworld.et2.getWidgetById("submit").set_readonly(true);
		if (pass1.get_value().length < 8) {
			pass1.showMessage("Password needs to have 8 characters or more!","error");
			
		} else if (pass1.get_value().length < 12) {
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
	},
});