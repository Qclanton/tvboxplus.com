<div 
    id="map" 
    style="
        height: <?= $map->height ?>px; 
        width: <?= $map->width ?>px;
    ">
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
