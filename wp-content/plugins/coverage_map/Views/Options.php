<br clear="all" />

<h1>Options</h1>



<form method="POST" action="">
    <input type="hidden" name="action" value="set"/>
    
    <h2>Center</h2>
    <table class="form-table">
        <tbody>
            <tr>
                <th scope="row">
                    <label for="options[center][address]">Address</label>
                </th>
                <td>
                    <input id="center-address" name="options[center][address]" type="text" value="<?= $center->address ?>" class="regular-text">
                    <input id="center-longitude" name="options[center][longitude]" type="hidden" value="<?= $center->longitude ?>">
                    <input id="center-latitude" name="options[center][latitude]" type="hidden" value="<?= $center->latitude ?>">
                </td>
            </tr>
        <tbody>
    </table>
    
    <h2>Points</h2>
    <p>There is no points yet</p>
    
    <div class="tablenav bottom">
		<button class="button button-primary">Save</button>
	</div>
</form>



<!-- Address autocomplete -->
<script>
function autocompleteAddress() {
    autocomplete = new google.maps.places.Autocomplete(
        document.getElementById('center-address'),
        {types: ['geocode']}
    );

    autocomplete.addListener('place_changed', function() {
        var place = this.getPlace();
        
        document.getElementById('center-longitude').setAttribute('value', place.geometry.location.lng());
        document.getElementById('center-latitude').setAttribute('value', place.geometry.location.lat());
    });
}
</script>
<script src="https://maps.googleapis.com/maps/api/js?signed_in=true&libraries=places&callback=autocompleteAddress" async defer></script>
