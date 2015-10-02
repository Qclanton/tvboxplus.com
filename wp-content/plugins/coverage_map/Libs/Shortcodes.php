<?php
class CoverageMap_Libs_Shortcodes
{
    public static function drawMap($params=array())
    {
        // Manually load JS
        $content = "<script src='https://maps.googleapis.com/maps/api/js?signed_in=true&libraries=places,drawing,geometry'></script>";
        $content .= "<script src='" . content_url() . "/plugins/coverage_map/Views/Js/Map.js'></script>";
        $content .= "<script src='" . content_url() . "/plugins/coverage_map/Views/Js/AddressAutocomplete.js'></script>";
        $content .= "<script src='" . content_url() . "/plugins/coverage_map/Views/Js/AddressChecker.js'></script>";
        
        // Get options
        $options = CoverageMap_Libs_Manage::getStoredOptions();        
        
        // Set some options from params
        $options->map->height = (!empty($params['height']) ? $params['height'] : $options->map->height);
        $options->map->width = (!empty($params['width']) ? $params['width'] : $options->map->width);
        
        // Render template
        $content .= CoverageMap_Libs_Helper::render(__DIR__ . "/../Views/Map.php", $options);
        echo $content;
    }
}
?>
