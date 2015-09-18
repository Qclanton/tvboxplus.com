<?php
/*
Plugin Name: Coverage Map
Description: Plugin set and display map with internet coverage
Version: 100
Author: Vividcrest
*/

// Autoload
spl_autoload_register(function($class) {
    // Set params
    $prefix = "CoverageMap";
    $base_dir = __DIR__;

    // Check namespace
    $len = strlen($prefix);
    if (strncmp($prefix, $class, $len) !== 0) {
        return;
    }

    // Get the file
    $relative_class = substr($class, $len);
    $file = $base_dir . str_replace("\\", "/", $relative_class) . ".php";
    
    
    // Require file
    if (file_exists($file)) {
        require $file;
    }
});



// Define action
$action = (isset($_POST['action']) && in_array($_POST['action'], ["show", "set"]) ? $_POST['action'] : "show");



// Add menu item
add_action("admin_menu", function() use ($action) { 
    add_menu_page("Coverage Map", "Coverage Map", "edit_posts", "coverage_map", ["\CoverageMap\Libs\Manage", $action], "dashicons-location", "6.1");
});
