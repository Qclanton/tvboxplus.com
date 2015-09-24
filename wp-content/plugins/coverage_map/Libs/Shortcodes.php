<?php
namespace CoverageMap\Libs;

class Shortcodes
{
    public static function drawMap()
    {
        // Manually load JS
        $content = "<script src='https://maps.googleapis.com/maps/api/js?signed_in=true&libraries=places,drawing,geometry'></script>";
        $content .="<script src='" . content_url() . "/plugins/coverage_map/Views/Js/Map.js'></script>";
        
        // Get options
        $options = Manage::getStoredOptions();
        
        // Render template
        $content .= Helper::render(__DIR__ . "/../Views/Map.php", $options);
        echo $content;
    }
}
