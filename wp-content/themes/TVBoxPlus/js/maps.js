(function($){ $(function() {

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



	// Zones functions
	function drawZones(map, center) {
		// Draw circles
		var drawnZones = [];
		var openedCirclesInfoWindows = [];

		var circles = [
			{color: "#b0c731", radius: 1219, speed: "15"},
			{color: "#f3ac6e", radius: 2438, speed: "10"},
			{color: "#dcca74", radius: 3657, speed: "6"},
			{color: "#eccdca", radius: 4267, speed: "1,5"}
		];

		circles.forEach(function(circle) {        
			// Draw circle
			var highlightedCircle = new google.maps.Circle({
				strokeColor: circle.color,
				strokeOpacity: 0.8,
				strokeWeight: 2,
				fillColor: circle.color,
				fillOpacity: 0.35,
				map: map,
				center: center,
				radius: circle.radius,
				clickable: true,
				zIndex: -circle.radius
			});        



			// Create new Info window
			var circleInfoWindow = new google.maps.InfoWindow({
				content: "Download Speed up to " + circle.speed + " Mb/sec"
			});        



			// Handle events
			highlightedCircle.addListener('mouseover', function(ev) {
				// Close old info windows
				openedCirclesInfoWindows.forEach(function(openedcircleInfoWindow) {
					openedcircleInfoWindow.close();
				});

				// Open info window
				circleInfoWindow.setPosition(ev.latLng);
				circleInfoWindow.open(this.get('map'), this);

				// Place info window in array of opened infowindows.
				openedCirclesInfoWindows.push(circleInfoWindow);
			});

			highlightedCircle.addListener('mouseout', function() {
				circleInfoWindow.close();
			});



			// Publish info
			drawnZones.push(highlightedCircle);
		});

		return drawnZones;
	}

	function eraseZones(zones) {
		zones.forEach(function(zone) {
			zone.setMap(null);
		});
	}




	// Map 
	function initMap() {
		// Init map
		var centerMap = new google.maps.LatLng(center.latitude, center.longitude);  

		var map = new google.maps.Map(document.getElementById('map'), {
			center: centerMap,
			zoom: 11,
			panControl: true,
			zoomControl: true,
			zoomControlOptions: {
				style: google.maps.ZoomControlStyle.SMALL
			}
		});	


		addresses.forEach(function(address) {
			var position = new google.maps.LatLng(address.latitude, address.longitude);

			// Create the marker
			var marker = new google.maps.Marker({
				map: map,
				position: position,
				clickable: true
			});

			// Hadle click on the marker
			var infowindow = new google.maps.InfoWindow();

			marker.addListener('click', function() {
				var isShown = address.isShown || false;

				if (!isShown) {
					// Show infowindow                
					infowindow.setContent(''
						+'<h4>' + address.title + '</h4>'
						+'<p>' + address.description + '</p>'
					);

					infowindow.open(map, this);


					// Draw zones
					address.zones = drawZones(map, position);


					// Mark as shown
					address.isShown = true;
				}
				else {
					// Erase zones
					eraseZones(address.zones);
					address.zones = [];


					// Close infowindow
					infowindow.close();


					// Mark as not mshown
					address.isShown = false;
				}
			});
		});  
	}

	google.maps.event.addDomListener(window, 'load', initMap);
	
}); })(jQuery);