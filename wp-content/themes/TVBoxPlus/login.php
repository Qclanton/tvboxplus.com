<form 
		name="form_login" 
		style="display: none;" 
		id="id_form_login"
		method="POST" 
		action="https://www.iptv-distribution.net/api/login/login_process.asp"
	>
	<input type="hidden" name="aid" value="320"></input>
	<input type="hidden" name="siteID" value="75"></input>	
	<input type="hidden" name="return" id="login_return_url" value="<?php echo get_site_url(); ?>?frame=tv"></input>
	<input type="hidden" name="return_failed" value="<?php echo get_site_url(); ?>?show_error_form=yes"></input>
	
	<label for="id_login">Login: </label>
	<input id="id_login" name="login"></input>
	
	<label for="id_password">Password: </label>
	<input id="id_password" name="password"></input>
	
	<input type="submit" value="Sign In"></input>
</form>

