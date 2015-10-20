// Init map globally
var coverageMap = null;



function drawZones(coverageMap, center, circles) {
    // Draw circles
    var drawnZones = [];
    var openedCirclesInfoWindows = [];



    circles.forEach(function(circle) {        
        // Draw circle
        var highlightedCircle = new google.maps.Circle({
            strokeColor: circle.color,
            strokeOpacity: 0.8,
            strokeWeight: 2,
            fillColor: circle.color,
            fillOpacity: 0.35,
            map: coverageMap,
            center: center,
            radius: circle.radius,
            clickable: true,
            zIndex: -circle.radius
        });        



        // Create new Info window
        var circleInfoWindow = new google.maps.InfoWindow({
            content: circle.text
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
function initMap(settings) {
    // Init map
    var centerMap = new google.maps.LatLng(settings.center.latitude, settings.center.longitude);  

    coverageMap = new google.maps.Map(document.getElementById('map'), {
        center: centerMap,
        zoom: settings.zoom,
        panControl: true,
        zoomControl: true,
        zoomControlOptions: {
            style: google.maps.ZoomControlStyle.SMALL
        }
    });	

    settings.addresses.forEach(function(address) {
        var position = new google.maps.LatLng(address.latitude, address.longitude);

        // Create the marker
        var marker = new google.maps.Marker({
            map: coverageMap,
            position: position,
            clickable: true
        });

        // Hadle click on the marker
        var infowindow = new google.maps.InfoWindow();

        marker.addListener('click', function() {
            var isShown = address.isShown || false;

            if (!isShown) {
                // Show infowindow 
                /*               
                infowindow.setContent(''
                    +'<h4>' + address.title + '</h4>'
                    +'<p>' + address.description + '</p>'
                );

                infowindow.open(coverageMap, this);
                */

                // Draw zones
                address.zones = drawZones(coverageMap, position, settings.circles);


                // Mark as shown
                address.isShown = true;
            }
            else {
                // Erase zones
                eraseZones(address.zones);
                address.zones = [];


                // Close infowindow
                // infowindow.close();


                // Mark as not mshown
                address.isShown = false;
            }
        });
    });  
}
