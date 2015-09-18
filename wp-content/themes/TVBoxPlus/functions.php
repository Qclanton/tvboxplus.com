<?php
function is_home_qs() {
	return (($_SERVER['QUERY_STRING'] == "") ? true : false);
}

function is_home_ru() {
	return (in_array($_SERVER['REQUEST_URI'], array("/index.php/", "/")) ? true : false);
}

function is_home_tmpl() {
	return (is_home_qs() && is_home_ru() ? true: false);
}
/*function get_site_url_sn() {
	return $_SERVER['SERVER_NAME'];
}*/


// This theme uses wp_nav_menu() in one location.
function register_my_menus()
	{
	register_nav_menus
	(
	array( 'top-menu' => 'top-menu', 'main-menu' => 'main-menu', 'footer-menu' => 'footer-menu')
	);
	}
if (function_exists('register_nav_menus'))
	{
	add_action( 'init', 'register_my_menus' );
	}
?>
