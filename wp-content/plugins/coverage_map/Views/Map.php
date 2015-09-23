<div id="map" style="height:500px; width:500px;"></div>
<pre><? var_dump($map) ?></pre>
<script>
    // Set coordinates
	var center = {latitude: 34.1447154, longitude: -118.2564655};
	var addresses = [
		{
			latitude: 34.1447154, 
			longitude: -118.2564655, 
			title: "GLDLCA11",
			description: ""
		},

		{
			latitude: 34.1738209,
			longitude: -118.132404, 
			title: "PSDNCA12",
			description: "1615 N Lake Ave, Pasadena, CA 91104, USA"
		},

		{
			latitude: 34.1445894,
			longitude: -118.1383543, 
			title: "PSDNCA11",
			description: "600 E Green St, Pasadena, CA 91101, USA"
		},

		{
			latitude: 34.1647079,
			longitude: -118.3772694, 
			title: "NHWDCA02",
			description: "11272 Magnolia Blvd, North Hollywood, CA 91601, USA"
		},

		{
			latitude: 34.2119924,
			longitude: -118.387634, 
			title: "NHWDCA01",
			description: "7744 Lankershim Blvd, North Hollywood, CA 91605, USA"
		},

		{
			latitude: 34.0946524,
			longitude: -118.2919394, 
			title: "LSANCA12",
			description: "1255 N Vermont Ave, Los Angeles, CA 90029, USA"
		},

		{
			latitude: 34.1942732,
			longitude: -118.453544, 
			title: "VNNYCA02",
			description: "6803 Cedros Ave, Van Nuys, CA 91405, USA"
		},

		{
			latitude: 34.0970417,
			longitude: -118.3226404, 
			title: "HLWDCA01",
			description: "1429 N Gower St, Los Angeles, CA 90028, USA"
		},

		{
			latitude: 34.1831737,
			longitude: -118.3094767, 
			title: "BRBNCA11",
			description: "280 E Palm Ave, Burbank, CA 91502, USA"
		}
	];
    
    var circles = [
        {color: "#b0c731", radius: 1219, speed: "15"},
        {color: "#f3ac6e", radius: 2438, speed: "10"},
        {color: "#dcca74", radius: 3657, speed: "6"},
        {color: "#eccdca", radius: 4267, speed: "1,5"}
    ];
</script>

<!-- Init the map -->
<script>
(function($){ $(function() {     
    google.maps.event.addDomListener(window, 'load', initMap);
}); })(jQuery);
</script>
