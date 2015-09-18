<?php
namespace CoverageMap\Libs;

class Helper 
{
    public static function render($view, $vars=[]) 
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
}
