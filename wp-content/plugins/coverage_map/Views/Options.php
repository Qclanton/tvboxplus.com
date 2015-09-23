<div class="wrap">
    <h1>Options</h1>
    
    <h2 class="nav-tab-wrapper">
        <a href="#" class="nav-tab nav-tab-active" data-tab="center" >Center</a>
        <a href="#" class="nav-tab" data-tab="points">Points</a>
        <a href="#" class="nav-tab" data-tab="zones">Zones</a>
    </h2>
    
    
    <form method="POST" action="">
        <input type="hidden" name="action" value="set">
        
        <div class="tabs-wrapper">
            <!-- Tab 'center'-->
            <div class="tab-content" data-tab="center">
                <table class="form-table">
                    <tbody>
                        <tr>
                            <th scope="row">
                                <label for="options[center][address]">Address</label>
                            </th>
                            <td>
                                <input id="center-address"name="options[center][address]" type="text" value="<?= $center->address ?>" class="regular-text address">
                                <input data-address-id="center-address" name="options[center][longitude]" class="longitude" type="hidden" value="<?= $center->longitude ?>">
                                <input data-address-id="center-address" name="options[center][latitude]" class="latitude" type="hidden" value="<?= $center->latitude ?>">
                            </td>
                        </tr>
                    <tbody>
                </table>
            </div>
            
            
            
            <!-- Tab 'points'-->
            <div class="tab-content" data-tab="points" style="display:none">
                <br>
                <a href="#" class="page-title-action new-point-toggle" data-state="hidden">Add point</a>
                <a href="#" class="page-title-action existing-points-toggle" data-state="shown">Hide Points</a>
                
                <!-- 'New Point' block -->
                <div id="new-point" style="display: none">
                    <table class="form-table">
                        <tbody>
                            <tr>
                                <th scope="row">
                                    <label for="options[points][<?= count($points)+1 ?>][address]">Address</label>
                                </th>
                                <td>
                                    <input id="new-point-address" name="options[points][<?= count($points)+1 ?>][address]" type="text" class="large-text address">
                                    <input data-address-id="new-point-address" name="options[points][<?= count($points)+1 ?>][longitude]" type="hidden" class="longitude">
                                    <input data-address-id="new-point-address" name="options[points][<?= count($points)+1 ?>][latitude]" type="hidden" class="latitude">
                                </td>
                            </tr>
                            
                            <tr>
                                <th scope="row">
                                    <label for="options[points][<?= count($points)+1 ?>][title]">Title</label>
                                </th>
                                <td>
                                    <input name="options[points][<?= count($points)+1 ?>][title]" type="text" class="large-text">
                                </td>
                            </tr>

                            <tr>
                                <th scope="row">
                                    <label for="options[points][<?= count($points)+1 ?>][title]">Description</label>
                                </th>
                                <td>
                                    <textarea name="options[points][<?= count($points)+1 ?>][description]" rows="10" cols="50" class="large-text code"></textarea>
                                </td>
                            </tr>                     
                        <tbody>
                    </table>
                </div>
                
        
                <!-- List of existing points -->
                <div id="points">                    
                    <table class="form-table">
                        <tbody>
                            <? foreach ($points as $i=>$point) { ?>
                                <tr data-point="<?= $i ?>">
                                    <th scope="row">
                                        <a href="#" class="remove-point button" data-point="<?= $i ?>">Delete</a>
                                    </th>
                                </tr>                                
                                
                                <tr data-point="<?= $i ?>">
                                    <th scope="row">
                                        <label for="options[points][<?= $i ?>][address]">Address</label>
                                    </th>
                                    <td>
                                        <input id="point-address-<?= $i ?>" name="options[points][<?= $i ?>][address]" type="text" class="large-text address" value="<?= $point->address ?>">
                                        <input data-address-id="point-address-<?= $i ?>" name="options[points][<?= $i ?>][longitude]" type="hidden" class="longitude" value="<?= $point->longitude ?>">
                                        <input data-address-id="point-address-<?= $i ?>" name="options[points][<?= $i ?>][latitude]" type="hidden" class="latitude" value="<?= $point->latitude ?>">
                                    </td>
                                </tr>
                                
                                <tr data-point="<?= $i ?>">
                                    <th scope="row">
                                        <label for="options[points][<?= $i ?>][title]">Title</label>
                                    </th>
                                    <td>
                                        <input name="options[points][<?= $i ?>][title]" type="text" class="large-text" value="<?= esc_attr($point->title) ?>">
                                    </td>
                                </tr>

                                <tr data-point="<?= $i ?>">
                                    <th scope="row">
                                        <label for="options[points][<?= $i ?>][title]">Description</label>
                                    </th>
                                    <td>
                                        <textarea name="options[points][<?= $i ?>][description]" rows="10" cols="50" class="large-text code"><?= (esc_textarea($point->description)) ?></textarea>
                                    </td>
                                </tr>
                            <? } ?>
                        </tbody>
                    </table>
                </div>
            </div>
            
            
            
            <!-- Tab 'zones'-->
            <div class="tab-content" data-tab="zones" style="display:none">
                <br>
                <a href="#" class="page-title-action new-zone-toggle" data-state="hidden">Add zone</a>
                <a href="#" class="page-title-action existing-zone-toggle" data-state="shown">Hide zones</a>
                
                <!-- 'New Zone' block -->
                <div id="new-zone" style="display: none">
                    <table class="form-table">
                        <tbody>
                            <tr>
                                <th scope="row">
                                    <label for="options[zones][<?= count($zones)+1 ?>][radius]">Radius</label>
                                </th>
                                <td>
                                    <input name="options[zones][<?= count($zones)+1 ?>][radius]" type="text" class="short-text"> meters
                                </td>
                            </tr>
                            
                            <tr>
                                <th scope="row">
                                    <label for="options[zones][<?= count($zones)+1 ?>][color]">Color</label>
                                </th>
                                <td>
                                    <input name="options[zones][<?= count($zones)+1 ?>][color]" type="text" class="short-text color-picker">
                                </td>
                            </tr>
                        <tbody>
                    </table>
                </div>
                
        
                <!-- List of existing zones -->
                <div id="zones">                    
                    <table class="form-table">
                        <tbody>
                            <? foreach ($zones as $i=>$zone) { ?>
                                <tr data-zone="<?= $i ?>">
                                    <th scope="row">
                                        <a href="#" class="remove-zone button" data-zone="<?= $i ?>">Delete</a>
                                    </th>
                                </tr> 
                                
                                <tr data-zone="<?= $i ?>">
                                    <th scope="row">
                                        <label for="options[zones][<?= $i ?>][radius]">Radius</label>
                                    </th>
                                    <td>
                                        <input name="options[zones][<?= $i ?>][radius]" type="text" class="short-text" value="<?= $zone->radius ?>"> meters
                                    </td>
                                </tr>
                                
                                <tr data-zone="<?= $i ?>">
                                    <th scope="row">
                                        <label for="options[zones][<?= $i ?>][color]">Color</label>
                                    </th>
                                    <td>
                                        <input name="options[zones][<?= $i ?>][color]" type="text" class="short-text color-picker" value="<?= $zone->color ?>">
                                    </td>
                                </tr>
                            <? } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        
        
        <input type="submit" class="button-primary" value="Save">
        <div id="map">There will be map</div>
    </form>
</div>






<!-- Address autocomplete -->
<script>
function autocompleteAddresses() {
    var addresses = document.getElementsByClassName('address');

    for (var i=0; i<addresses.length; i++) {
        var address = addresses[i];

        var id = address.getAttribute('id');
        var longitude = null;
        var latitude = null;



        // Define longitude and latitude    
        var dependsElements = document.querySelectorAll('input[data-address-id="' + id + '"');

        for (var j=0; j<dependsElements.length; j++) {
            dependElement = dependsElements[j];

            var classes = dependElement.getAttribute('class').split(' ');

            if (classes.indexOf('longitude') !== -1) {
                longitude = dependElement;
            } else if (classes.indexOf('latitude') !== -1) {
                latitude = dependElement;
            }
        }


        // Set autocomplete to address field
        autocomplete = new google.maps.places.Autocomplete(
            address,
            {types: ['geocode']}
        );


        // Add auto-filling longitude and latitude after autocomplete
        autocomplete.addListener('place_changed', function() {
            var place = this.getPlace();

            longitude.setAttribute('value', place.geometry.location.lng());
            latitude.setAttribute('value', place.geometry.location.lat());
        });
	}
}
</script>
<script src="https://maps.googleapis.com/maps/api/js?signed_in=true&libraries=places&callback=autocompleteAddresses" async defer></script>
