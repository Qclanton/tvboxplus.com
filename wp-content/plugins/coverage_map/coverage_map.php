<?php
/*
Plugin Name: Coverage Map
Description: Plugin for set and display map with internet coverage
Version: 101
Author: Vividcrest
*/

// Autoload
function autoloadCoveragemapClasses($class) {
     // Set params
    $prefix = "CoverageMap";
    $base_dir = dirname(__FILE__);

    // Check namespace
    $len = strlen($prefix);
    if (strncmp($prefix, $class, $len) !== 0) {
        return;
    }

    // Get the file
    $relative_class = substr($class, $len);
    $file = $base_dir . str_replace("_", "/", $relative_class) . ".php";
    
    
    // Require file
    if (file_exists($file)) {
        require $file;
    }
}

spl_autoload_register("autoloadCoveragemapClasses");




// Enqueue Javascript files
function enqueueCoveragemapScripts() {
    // Load Google Maps Api Library
    wp_enqueue_script("google-maps-api", "https://maps.googleapis.com/maps/api/js?signed_in=true&libraries=places,drawing,geometry");
    
    
    // For Map
    wp_enqueue_script("coverage-map-map",  plugin_dir_url(__FILE__) . "Views/Js/Map.js");
    wp_enqueue_script("coverage-map-map-toggle", plugin_dir_url(__FILE__) . "Views/Js/MapToggle.js", array("jquery"));
    wp_enqueue_script("coverage-map-map-address-checker", plugin_dir_url(__FILE__) . "Views/Js/AddressChecker.js", array("jquery")); 
    
    
    // For autocomplete
    wp_enqueue_script("coverage-map-address-autocomplete", plugin_dir_url(__FILE__) . "Views/Js/AddressAutocomplete.js", array("jquery"));
    
    
    
    // For tabs navigation
    wp_enqueue_script("coverage-map-tabs", plugin_dir_url(__FILE__) . "Views/Js/Tabs.js", array("jquery"));

    // For tab "points"
    wp_enqueue_script("coverage-map-points-toggle", plugin_dir_url(__FILE__) . "Views/Js/PointsToggle.js", array("jquery"));
    wp_enqueue_script("coverage-map-points-remove", plugin_dir_url(__FILE__) . "Views/Js/PointsRemove.js", array("jquery"));
    
    // For tab "zones"
    wp_enqueue_style("wp-color-picker");  
    wp_enqueue_script("coverage-map-zones-toggle", plugin_dir_url(__FILE__) . "Views/Js/ZonesToggle.js", array("jquery"));
    wp_enqueue_script("coverage-map-zone-remove", plugin_dir_url(__FILE__) . "Views/Js/ZonesRemove.js", array("jquery"));            
    wp_enqueue_script("coverage-map-zone-color-picker", plugin_dir_url(__FILE__) . "Views/Js/ZonesColorPicker.js", array("jquery", "wp-color-picker"));     
}

add_action("admin_enqueue_scripts", "enqueueCoveragemapScripts");
        
        
        

// Add menu item
function doCoveragemapAction() {
    $action = (isset($_POST['action']) && in_array($_POST['action'], array("show", "set")) ? $_POST['action'] : "show");
    
    add_menu_page("Coverage Map", "Coverage Map", "edit_posts", "coverage_map", array("CoverageMap_Libs_Manage", $action), "dashicons-location", "6.1");
}

add_action("admin_menu", "doCoveragemapAction");




// Shortcodes
add_shortcode("coverage_map", array("CoverageMap_Libs_Shortcodes", "drawMap"));




// Install and unsinstall
register_activation_hook(__FILE__, array("CoverageMap_Libs_Manager", "install"));
register_uninstall_hook(__FILE__, array("CoverageMap_Libs_Manager", "uninstall"));



// Register AJAX actions
add_action("wp_ajax_coverage_map_check_address", array("CoverageMap_Libs_AddressChecker", "checkThruAjax"));
add_action("wp_ajax_nopriv_coverage_map_check_address", array("CoverageMap_Libs_AddressChecker", "checkThruAjax"));
?>
