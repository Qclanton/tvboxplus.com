<?php
class IptvDistribution {
	public static $site_id = "75";
	public static $application_name = "TVBOXPLUS";
	

	public function getVodFeatured() {
		$xml_query = '<?xml version="1.0" encoding="utf-8"?>
			<soap:Envelope xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xmlns:xsd="http://www.w3.org/2001/XMLSchema" xmlns:soap="http://schemas.xmlsoap.org/soap/envelope/">
				<soap:Body>
					<GetVODFeatured xmlns="http://iptv-distribution.net/ds/vod/generic">
						<sApplicationName>' . self::$application_name . '</sApplicationName>
						<nSiteID>' . self::$site_id . '</nSiteID>
					</GetVODFeatured>
				</soap:Body>
			</soap:Envelope>
		';
		
		$url = "http://iptv-distribution.net/ds/vod/generic/service.asmx";
		$xpath = array(
			'url' => "http://iptv-distribution.net/ds/vod/generic",
			'tag' => "GetVODFeaturedResult"
		);
		
		$result = $this->makeIptvDistributionRequest($url, $xml_query, $xpath);
		
		$movies = array();
		$img_size = array(
			array(
				'key'=>"height", 
				'value'=>"130"
			),
			array(
				'key'=>"width", 
				'value'=>"100"
			)
		);
				
		$i = 0;
		
		foreach ($result as $elem) {			
			$j=0;
			
			foreach ($elem->kvpMovie as $movie) {
					$movies[$i*100+$j]->image_url = $this->makeImageUrl($movie->Vid, "1", $img_size);
					$movies[$i*100+$j]->Vid = $movie->Vid;
					$movies[$i*100+$j]->Name = $movie->Name;
				$j++;
			}
			$i++;
		}		
		
	
		return $movies;		
	}
	
	public function getAnnouncements($page=1, $pagelimit=50) {
		$xml_query = '<?xml version="1.0" encoding="utf-8"?>
			<soap:Envelope xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xmlns:xsd="http://www.w3.org/2001/XMLSchema" xmlns:soap="http://schemas.xmlsoap.org/soap/envelope/">
				<soap:Body>
					<GetAnnouncementsBySite xmlns="http://iptv-distribution.net/ds/epg">
						<nSiteID>' . self::$site_id . '</nSiteID>
						<sApplicationName>' . self::$application_name . '</sApplicationName>
						<dt>' . date("c") . '</dt>
						<bUseStbLogin>false</bUseStbLogin>
						<nChannelID>0</nChannelID>
						<nPageSize>' . $pagelimit . '</nPageSize>
						<nPageNumber>' . $page . '</nPageNumber>
						<CountryCode>CA</CountryCode>
						<ShowAllDay>false</ShowAllDay>
					</GetAnnouncementsBySite>
				</soap:Body>
			</soap:Envelope>
		';
		
		$url = "http://iptv-distribution.net/ds/epg/service.asmx";
		$xpath = array(
			'url' => "http://iptv-distribution.net/ds/epg",
			'tag' => "GetAnnouncementsBySiteResponse"
		);

		
		$result = $this->makeIptvDistributionRequest($url, $xml_query, $xpath);
		$img_size = array(
			array(
				'key'=>"height", 
				'value'=>"109"
			),
			array(
				'key'=>"width", 
				'value'=>"195"
			)
		);
		$i = 0;		
		$announcements = array();
		
		foreach ($result[0]->GetAnnouncementsBySiteResult->TVProgramData as $announcement) {
			$announcements[$i]->image_url = $this->makeImageUrl($announcement['DetailID'], "11", $img_size);
			$announcements[$i]->TvProgramName = $announcement['TvProgramName'];
			$announcements[$i]->Description = $announcement['Description'];
			$announcements[$i]->Date = $announcement['Date'];
			$announcements[$i]->ChannelName = $announcement['ChannelName'];
			
			$i++;		
		}
		return $announcements;		 
	}
	
	private function makeImageUrl($id, $group, array $options = array()) {
		$image_handler = "http://www2.iptv-distribution.net/ui/ImageHandler.ashx";
		$query_string = "?e=" . $id . "&t=" . $group;	
		$url = $image_handler . $query_string;
		
		if (!empty($options)) {
			foreach ($options as $option) {
				$url .= "&" . $option['key'] . "=" . $option['value'];
			}
		}
		
		return $url;	
	}
	
	private function makeIptvDistributionRequest($url, $query, $xpath) {
		$ch = curl_init($url);
		curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: text/xml; charset=utf-8'));
		curl_setopt($ch, CURLOPT_POST, 1);
		curl_setopt($ch, CURLOPT_POSTFIELDS, $query);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		$response = curl_exec($ch);
		curl_close($ch);

		$data = simplexml_load_string($response);
		$data->registerXPathNamespace('ns', $xpath['url']);
		
		return $data->xpath("//ns:" . $xpath['tag']);
	}
}
?>
