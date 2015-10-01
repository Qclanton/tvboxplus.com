<?php
class CoverageMap_Libs_Manage
{
    const OPTIONS_PREFIX = "coverage_map_";
    const OPTIONS_LIST = "center,zones,points,map";
    
    
    // Actions
    public static function show()
    {   
        // Get options   
        $options = self::getStoredOptions();        
                
        $options->activeTab = (isset($_COOKIE['coverage-map-active-tab'])
            ? $_COOKIE['coverage-map-active-tab']
            : "map"
        );
        
        
        // Show content
        $content = CoverageMap_Libs_Helper::render(dirname(__FILE__). "/../Views/Options.php", $options);
        echo $content;
    }
    
    public static function set()
    {   
        // Save options
        $options = (isset($_POST['options']) ? $_POST['options'] : array());
        self::storeOptions($options);


        // Show
        self::show();
    }
    
    
    
    
    
    // Store
    public static function storeOptions(array $options)
    {
        foreach ($options as $name=>$value) {
            if (is_array($value) || is_object($value)) {
                $value = json_encode($value);
            }
            
            update_option(self::OPTIONS_PREFIX . $name, $value);
        }   
    }
    
    public static function getStoredOptions() 
    {
        $list = explode(",", self::OPTIONS_LIST);
        $stored = array();
        
        foreach ($list as $name) {
            $value = get_option(self::OPTIONS_PREFIX . $name);
            
            $decoded = json_decode($value, true);
            $value = $decoded;
            
            $stored[$name] = self::mergeWithDefaultValues($name, $value);
        }
        
        return self::tuneOptions(CoverageMap_Libs_Helper::toObject($stored));;
    }
    
    
    public static function sortZones($some, $other)
    {
        return ($some->radius > $other->radius ? 1 : -1);
    }
    
    public static function tuneOptions($options) 
    {
        if (isset($options->points)) { 
            // "Points" should be numeric array
            $options->points = array_values((array)$options->points);
        }
        
        
        if (isset($options->zones)) {    
            // "Zones" should be numeric array ordere by radius
            $options->zones = array_values((array)$options->zones);
            usort($options->zones, array("CoverageMap_Libs_Manage", "sortZones"));
        }
        
        return $options;
    }
    
    private static function mergeWithDefaultValues($name, $value)
    {
        $default = array(
            'map' => array(
                'address' => null,
                'longitude' => null,
                'latitude' => null,
                'zoom' => 13,
                'width' => 500,
                'height' => 500,
            )
        );
        
        if (array_key_exists($name, $default)) {  
            $value = CoverageMap_Libs_Helper::arrayReplaceRecursive($default[$name], (array)$value);
        }

        return $value;
    }
    
    
    
    
    // Install and uninstall
    public static function install()
    {
        $options = explode(",", self::OPTIONS_LIST);
        
        foreach ($options as $option) {
            add_option(self::OPTIONS_PREFIX . $option);
        };        
    }
    
    public static function uninstall()
    {
        $options = explode(",", self::OPTIONS_LIST);
        
        foreach ($options as $option) {
            delete_option(self::OPTIONS_PREFIX . $option);
        };        
    }
}
?>
