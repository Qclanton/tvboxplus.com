<?php
header("Content-Type: text/html; charset=utf-8");

$allowable_actions = array("getVod", "getAnnouncements");
if (!isset($_GET['action']) || !in_array($_GET['action'], $allowable_actions)) {
	echo "Content will be sooner or later";
}
else {
	$action = $_GET['action'];
	
	require_once "helpers/iptv_distribution.php";
	require_once "helpers/date.php";

	$Content = new IptvDistribution;
	$Date = new Date;

	$html="";
	switch ($action) {
		case "getVod":
			$vods = $Content->getVodFeatured($page);
			$i=1;
			$last_page = ceil(count($vods)/5);			
			foreach ($vods as $vod) {
				$style = ($i < 6 ? "display: inline;" : "display: none");
				$page = ceil($i/5);
				$html .= '
					<div style="' . $style . '" class="main-vod vod_page--' . $page . '">
						<img class="main-vod-img" src="' . $vod->image_url . '"></img>
						<h3 class="main-page-h3">' . $vod->Name . '</h3>
					</div>
				';
				$i++;
			}
			$html .= '<input id="vod_last_page" type="hidden" value="' . $last_page . '">';
			break;
		case "getAnnouncements":
			$announcements = $Content->getAnnouncements();
			
			$i=1;
			$last_page = ceil(count($announcements)/3);	
			foreach ($announcements as $announcement) {
				$style = ($i < 4 ? "display: inline;" : "display: none");
				$page = ceil($i/3);
				$html .= '
					<div style="' . $style . '" class="main-announcement announcement_page--' . $page . '">
						<img title="' . $announcement->Description . '" class="main-announcement-img" src="' . $announcement->image_url . '"></img>
						<h3 class="announcement-page-h3">' . $announcement->TvProgramName . '</h3>
						<h3 class="main-page-h2">' . $Date->format($announcement->Date) . '</h3>
						<h3 class="main-channelName">' . $announcement->ChannelName . '</h3>
					</div>
				';
				$i++;
			}
			$html .= '<input id="announcement_last_page" type="hidden" value="' . $last_page . '">';
			break;
	}
	
	echo $html;
}
?>
