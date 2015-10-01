<?php
class CoverageMap_Libs_Helper 
{
    public static function render($view, $vars=array()) 
    {    
        extract((array)$vars);
        
        ob_start();        
        require_once($view);
        $content = ob_get_contents();
        ob_end_clean();
        
        return $content;
    }
    
    public static function toObject(array $array) 
    {
        return json_decode(json_encode($array));
    }
    
    public static function arrayReplaceRecursive(array $some, array $other)
    {
        foreach ($other as $key => $value) {
            if (!isset($some[$key]) || (isset($some[$key]) && !is_array($some[$key]))) {
                $some[$key] = array();
            }

            if (is_array($value)) {
                $value = self::arrayReplaceRecursive($some[$key], $value);
            }
            
            $some[$key] = $value;
        }
        
        return $some;
    }
}
?>
