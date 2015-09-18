<?php
if (isset($_GET['sid'])) { 
	$sid = $_GET['sid'];
	setcookie("sid", $sid, time()+86400); 
}
elseif (isset($_COOKIE['sid'])) { 
	$sid = $_COOKIE['sid']; 
}
else {
	$sid = null;
}
// phpinfo();
// Fetch cleaned url

$uri_arr = explode("/", $_SERVER['REQUEST_URI']);
if ($uri_arr[1] == "frame" || ($uri_arr[1] == "index.php" && isset($uri_arr[2]) && $uri_arr[2] == "frame")) {
	$_GET['frame'] = ($uri_arr[1] == "frame" ? $uri_arr[2] : $uri_arr[3]); 
}

$site_id = "75";
$frame_url = null;
$frame = (isset($_GET['frame']) ? $_GET['frame'] : null);

if ($frame) {    
    $frame_url_base = "http://iptv-distribution.net";
    $frame_url_separator = (in_array($frame,  array("vod", "profile")) ? "&" : "?");
    $frame_url_additionals = array(
        'archive' => "/ui/archiveplus/ArchivePlusSearch.aspx",
        'tv' => "/ui/epg/internet-tv-online.aspx",
        'vod' => "/api/interface/?page=vod",
        'profile'=>"/api/interface/?page=account/index.asp"
    );

    $frame_url = $frame_url_base . $frame_url_additionals[$frame] . $frame_url_separator . "siteid=" . $site_id . "&sid=" . $sid;
}
?>
