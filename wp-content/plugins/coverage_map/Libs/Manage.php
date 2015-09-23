<?php
namespace CoverageMap\Libs;

class Manage
{
    const OPTIONS_PREFIX = "coverage_map_";
    const OPTIONS_LIST = "center,zones,points,map";
    
    
    // Actions
    public static function show()
    {   
        // Get options   
        $options = self::getStoredOptions();
        
        
        // Tune options
        if (isset($options->points)) { 
            // "Points" should be numeric array
            $options->points = array_values((array)$options->points);
            
            // "Zones" should be numeric array ordere by radius
            $options->zones = array_values((array)$options->zones);
            usort($options->zones, function($some, $other) { 
                return ($some->radius > $other->radius ? 1 : -1);
            });
        }
        
        $options->activeTab = (isset($_COOKIE['coverage-map-active-tab'])
            ? $_COOKIE['coverage-map-active-tab']
            : "map"
        );
        
        
        // Show content
        $content = Helper::render(__DIR__ . "/../Views/Options.php", $options);
        echo $content;
    }
    
    public static function set()
    {   
        // Save options
        $options = (isset($_POST['options']) ? $_POST['options'] : []);
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
    
    private static function getStoredOptions() 
    {
        $list = explode(",", self::OPTIONS_LIST);
        $stored = [];
        
        foreach ($list as $name) {
            $value = get_option(self::OPTIONS_PREFIX . $name);
            
            $decoded = json_decode($value, true);
            if(!json_last_error()) {
                $value = $decoded;
            }
            
            $stored[$name] = self::mergeWithDefaultValues($name, $value);
        }
        
        return Helper::toObject($stored);
    }
    
    private static function mergeWithDefaultValues($name, $value)
    {
        $default = [
            'map' => [
                'address' => null,
                'longitude' => null,
                'latitude' => null,
                'zoom' => 13,
                'width' => 500,
                'height' => 500,
            ]
        ];
        
        if (array_key_exists($name, $default)) {  
            $value = array_replace_recursive($default[$name], (array)$value);
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
