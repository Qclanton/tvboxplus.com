$(function(){
	function deleteCookie(name) {
		var exp = new Date();
		exp.setTime (exp.getTime() - 1000000000000);
		document. cookie =name + '=; expires=' + exp.toGMTString() + '; path=/'   
	}		
		
	$('#link_login').on("click", function(){
		$('#error_form').hide();
		
		var opened_fl = "no";
		var logged_fl = "no";
		var form_classes_string = $('#id_form_login').attr('class');
		var link_classes_string = $('#link_login').attr('class');
		
		if (typeof(form_classes_string) != "undefined") {
			var form_classes = form_classes_string.split(" ");
		}
		if (typeof(link_classes_string) != "undefined") {
			var link_classes = link_classes_string.split(" ");
		}
		
		if (typeof(form_classes_string) != "undefined" && form_classes.length != 0) {
			for (i=0; i<form_classes.length; i++) {
				if (form_classes[i] == "opened") {
					opened_fl = "yes";
				}				
			}
		}
		if (typeof(link_classes_string) != "undefined" && link_classes.length != 0) {
			for (i=0; i<link_classes.length; i++) {		
				if (link_classes[i] == "logged") {
					logged_fl = "yes";
				}
			}
		}			
		
		if (logged_fl == "no") {			
			if(opened_fl == "yes") {
				$('#id_form_login').css('display', "none");
				$('#id_form_login').removeClass("opened");
			}
			else {
				$('#id_form_login').css('display', "inline");
				$('#id_form_login').addClass("opened");
			}
		}
		else {
			deleteCookie("sid");
			$('#link_login').removeClass("logged");
			$('#link_login').html("Login");
			
			window.location.href = $('#login_return_url').val();
		}			
	});
});
