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



// Enqueue Javascript files
add_action("admin_enqueue_scripts", function() {
    // Load Google Maps Api Library
    wp_enqueue_script("google-maps-api", "https://maps.googleapis.com/maps/api/js?signed_in=true&libraries=places,drawing,geometry");
    
    
    
    // For autocomplete
    wp_enqueue_script("coverage-map-address-autocomplete", plugin_dir_url(__FILE__) . "Views/Js/AddressAutocomplete.js", ["jquery"]);
    
    
    
    // For tabs navigation
    wp_enqueue_script("coverage-map-tabs", plugin_dir_url(__FILE__) . "Views/Js/Tabs.js", ["jquery"]);

    // For tab "points"
    wp_enqueue_script("coverage-map-points-toggle", plugin_dir_url(__FILE__) . "Views/Js/PointsToggle.js", ["jquery"]);
    wp_enqueue_script("coverage-map-points-remove", plugin_dir_url(__FILE__) . "Views/Js/PointsRemove.js", ["jquery"]);
    
    // For tab "zones"
    wp_enqueue_style("wp-color-picker");  
    wp_enqueue_script("coverage-map-zones-toggle", plugin_dir_url(__FILE__) . "Views/Js/ZonesToggle.js", ["jquery"]);
    wp_enqueue_script("coverage-map-zone-remove", plugin_dir_url(__FILE__) . "Views/Js/ZonesRemove.js", ["jquery"]);            
    wp_enqueue_script("coverage-map-zone-color-picker", plugin_dir_url(__FILE__) . "Views/Js/ZonesColorPicker.js", ["jquery", "wp-color-picker"]);
    
    
    
    
    // For Map
    wp_enqueue_script("coverage-map-map",  plugin_dir_url(__FILE__) . "Views/Js/Map.js", ["jquery"]);
});
        
        
        
// Define action
$action = (isset($_POST['action']) && in_array($_POST['action'], ["show", "set"]) ? $_POST['action'] : "show");



// Add menu item
add_action("admin_menu", function() use ($action) { 
    add_menu_page("Coverage Map", "Coverage Map", "edit_posts", "coverage_map", ["\CoverageMap\Libs\Manage", $action], "dashicons-location", "6.1");
});



// Install and unsinstall
register_activation_hook(__FILE__, ["\CoverageMap\Libs\Manager", "install"]);
register_uninstall_hook(__FILE__, ["\CoverageMap\Libs\Manager", "uninstall"]);
