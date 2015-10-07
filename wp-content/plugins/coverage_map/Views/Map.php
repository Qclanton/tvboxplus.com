<div 
    id="map" 
    style="
        height: <?= $map->height ?>px; 
        width: <?= $map->width ?>px;
    ">
</div>

<div class="address-for-checking--wrapper">
    <label class="address-for-checking" for="address-for-checking">Service Availability Quick Lookup </label>
    <input id="address-for-checking" type="text" class="address"/>
    <a id="check-address" href="#">Check!</a>
    
    <img id="address-loading" style="display: none" width="32px" height="32px" src="<?= content_url() ?>/plugins/coverage_map/Views/Images/loading.gif">
    
    <div id="address-approved" style="display: none" >
        <img width="32px" height="32px" src="<?= content_url() ?>/plugins/coverage_map/Views/Images/approved.png">
        <p>Available Internet download speed up to <strong id="approved-speed">0</strong> Mb/s.
    </div>
    
    <div id="address-declined" style="display: none">
        <p>We could not verify the address. Please contact Support at 888.757.8477. Thank you</p>
    </div>    
</div>

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
