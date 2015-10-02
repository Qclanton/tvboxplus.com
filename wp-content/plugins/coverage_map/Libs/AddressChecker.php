<?php
class CoverageMap_Libs_AddressChecker
{
    private static function makeRequest($address, $city, $state, $zip) 
    {
        $api_root = "http://iomdsl.ipservices.att.com";
        $tid = "1443736506356151512";
        $api_url = "{$api_root}/ordering/prequal.cgi?tid={$tid}&current_page=PREQUAL";
        
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
    
    private static function findOutResult($answer) 
    {
        $parsed = new CoverageMap_Libs_ThirdParty_Nokogiri($answer);
        $result_block = @$parsed->get("table.ltGreyShade td[valign=top]")->toArray()[0];
        $result_string = @array_pop($result_block['p'])['#text'];
        
        $success_pattern = "/This location is estimated to be .* feet from the central office/s";
        
        return (!empty($result_string) && preg_match($success_pattern, $result_string));
    }
    
    public static function check($address, $city, $state, $zip)
    {
        $answer = self::makeRequest($address, $city, $state, $zip);
        $result = self::findOutResult($answer);
        
        return $result;  
    }
    
    public static function checkThruAjax() {
        if (
            !isset($_POST['address']) ||
            !isset($_POST['city']) ||
            !isset($_POST['state']) ||
            !isset($_POST['zip'])
        ) {
            die("0");
        }
        
        die((string)self::check($_POST['address'], $_POST['city'], $_POST['state'], $_POST['zip']));
    }
}
    
?>
