(function($) { $(function() {
    function autocompleteAddress(field) {
        var id = $(field).attr('id');
        var longitude = $('input[data-address-id="' + id + '"].longitude');
        var latitude = $('input[data-address-id="' + id + '"].latitude'); 
        
        // Init autocomplete
        autocomplete = new google.maps.places.Autocomplete(
            field,
            {types: ['geocode']}
        );
        
        // Add auto-filling longitude and latitude after autocomplete
        autocomplete.addListener('place_changed', function() {
            var place = this.getPlace();

            longitude.val(place.geometry.location.lng());
            latitude.val(place.geometry.location.lat());
        });
    }

    
    var addresses = $('input.address');
    
    // Init for all address fields
    addresses.each(function() { 
        autocompleteAddress(this);
    });
    
    // Re-init by the click
    addresses.on('click', function() {
        autocompleteAddress(this); 
    });    
}); })(jQuery);
