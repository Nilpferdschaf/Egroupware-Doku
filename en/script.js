window.addEventListener('load', function() {
	var comments = document.getElementsByClassName('comment');
	for (var i = 0; i < comments.length; i++) {
		comments[i].innerHTML = '// ' + comments[i].innerHTML;
	}
	
	var strings = document.getElementsByClassName('string');
	for (var i = 0; i < strings.length; i++) {
		strings[i].innerHTML = '"' + strings[i].innerHTML + '"';
	}
	
	var functions = document.getElementsByClassName('function');
	for (var i = 0; i < functions.length; i++) {
		functions[i].innerHTML = functions[i].innerHTML + '()';
	}
});