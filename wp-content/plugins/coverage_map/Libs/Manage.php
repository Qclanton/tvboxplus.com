<?php
namespace CoverageMap\Libs;

class Manage
{
    const OPTIONS_PREFIX = "coverage_map_";
    const OPTIONS_LIST = "center,zones,points";
    
    
    
    // Actions
    public static function show()
    {
        $content = Helper::render(__DIR__ . "/../Views/Options.php", self::getStoredOptions());
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
    
    
    
    
    
    // Store options
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
            'center' => [
                'address' => null,
                'longitude' => null,
                'latitude' => null,
            ]
        ];
        
        if (array_key_exists($name, $default)) {  
            $value = array_replace_recursive($default[$name], (array)$value);
        }

        return $value;
    }
    
    
    
    

    
    
    
    
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
