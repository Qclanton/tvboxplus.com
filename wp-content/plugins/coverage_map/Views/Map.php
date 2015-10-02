<div 
    id="map" 
    style="
        height: <?= $map->height ?>px; 
        width: <?= $map->width ?>px;
    ">
</div>

<label for="address-for-checking">Type your address: </label>
<input id="address-for-checking" type="text" class="address"/>
<img id="address-loading" style="display: none" width="32px" height="32px" src="<?= content_url() ?>/plugins/coverage_map/Views/Images/loading.gif">
<div id="address-approved" style="display: none" >
    <img width="32px" height="32px" src="<?= content_url() ?>/plugins/coverage_map/Views/Images/approved.png">
    <p>Your internet speed might be <strong id="approved-speed">0</strong> Mbps!
</div>
<img id="address-declined" style="display: none" width="32px" height="32px" src="<?= content_url() ?>/plugins/coverage_map/Views/Images/declined.png">
<a id="check-address" href="#">Check!</a>


<!-- Set the map settings -->
<script>    
var mapSettings = {
    center: {
        latitude: <?= $map->latitude ?>, 
        longitude: <?= $map->longitude ?>,
    },
    
    zoom: <?= $map->zoom ?>,    
    
    addresses: [
        <? foreach ($points as $point) { ?>
            {
                latitude: <?= $point->latitude ?>, 
                longitude: <?= $point->longitude ?>, 
                title: "<?= $point->title ?>",
                description: "<?= $point->description ?>"
            },
        <? } ?>
    ],
    
    circles: [
        <? foreach ($zones as $zone) { ?>
            {
                color: "<?= $zone->color ?>", 
                radius: <?= $zone->radius ?>, 
                speed: "<?= $zone->speed ?>",
                text: "<?= $zone->text ?>"
            },
        <? } ?>
    ]
}
</script>

<!-- Init the map -->
<script>
(function($){ $(function() {     
    google.maps.event.addDomListener(window, 'load', initMap(mapSettings));
}); })(jQuery);
</script>
