<?php
class CoverageMap_Libs_AddressChecker
{
    private static function makeRequest($address, $city, $state, $zip) 
    {
        $api_root = "http://iomdsl.ipservices.att.com/ordering/prequal.cgi";
        $tid = "1443736506356151512";
        $api_url = "{$api_root}?tid={$tid}&current_page=PREQUAL";
        
        $params = array(
            'I_SITE_PHONE' => "9085551234",
            'I_SITE_ADDRESS1' => $address,
            'I_SITE_CITY' => $city,
            'I_SITE_STATE' => $state,
            'I_SITE_ZIP' => $zip
        );
        
        $context = stream_context_create(
            array(
                'http' => array(
                    'timeout' => 120, // 2 minutes
                    'method' => "POST",
                    'header' => "Content-Type: application/x-www-form-urlencoded" . PHP_EOL,
                    'content' => http_build_query($params),
                )
            )
        );
        
        return file_get_contents($api_url, false, $context);         
    }
    
    private static function findMeters($answer) 
    {
        $parsed = new CoverageMap_Libs_ThirdParty_Nokogiri($answer);
        $result_blocks = @$parsed->get("table.ltGreyShade td[valign=top]")->toArray();
        $result_string_array = @array_pop($result_blocks[0]['p']);
        $result_string = $result_string_array['#text'];
        
        $meters = 0;
        $success_pattern = "/This location is estimated to be (.*) feet from the central office/s";
        
        if (!empty($result_string) && preg_match($success_pattern, $result_string, $matches)) {
            $meters = ceil($matches[1]*0.3048); // API provide data in feets
        }
        
        return $meters;
    }
    
    
    
    
    public static function check($address, $city, $state, $zip)
    {
        $answer = self::makeRequest($address, $city, $state, $zip);
        $meters = self::findMeters($answer);
        
        if ($meters == 0) {
            return false;
        }
        
        // Find speed by distance
        $options = CoverageMap_Libs_Manage::getStoredOptions();

        foreach ($options->zones as $i=>$zone) {
            if ($meters <= $zone->radius || ($i+1 == count($options->zones))) {
                $speed = $zone->speed;
                break;
            }
        }
        
        return $speed;  
    }
    
    public static function getAddressInfo($address) 
    {
        // Set default data
        $default_info = (object)array(
            'address' => "Los Angeles",
            'city' => "Los Angeles",
            'state' => "CA",
            'zip' => "90001"
        );
        
        
        // Send request to API
        $api_url = "https://maps.googleapis.com/maps/api/geocode/json?address=";
        $context = stream_context_create(
            array(
                'http' => array(
                    'timeout' => 5
                )
            )
        ); 
        $api_data = json_decode(@file_get_contents($api_url . urlencode($address), false, $context));        

        // Return default data if request failed
        if (
            !isset($api_data->status) || 
            $api_data->status !== "OK" || 
            !isset($api_data->results[0]->address_components) ||
            !isset($api_data->results[0]->formatted_address)
        ) {
                
            return $default_info;
        }
        
        
        // Extract necessary data drom API answer
        $info = $default_info;
        $result = $api_data->results[0];
        $address_components = $result->address_components;        
        $info->address = $result->formatted_address;
        
        foreach ($address_components as $component) {
            // Check object
            if (
                !isset($component->short_name) ||
                !isset($component->types) ||
                !is_array($component->types)                
            ) {
                continue;
            }
            
            // Try to extract data
            if (in_array("locality", $component->types)) {
                $info->city = $component->short_name;
            } elseif (in_array("administrative_area_level_1", $component->types)) {
                $info->state = $component->short_name;
            } elseif (in_array("postal_code", $component->types)) {
                $info->zip = $component->short_name;
            }    
        }
        
        
        // Return collected information
        return $info;
    }
    
    public static function checkThruAjax() {
        if (!isset($_POST['address'])) {
            die("0");
        }
        
        $recognized = self::getAddressInfo($_POST['address']);
        $result = self::check($recognized->address, $recognized->city, $recognized->state, $recognized->zip);
        
        die((string)$result);
    }
}
?>
