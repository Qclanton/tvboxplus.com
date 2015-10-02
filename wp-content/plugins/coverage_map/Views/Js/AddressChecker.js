(function($) { $(function() {
    $('#check-address').on('click', function(ev) { 
        ev.preventDefault();
        
        var checkAddressButton = $(this);
        var url = '/wp-admin/admin-ajax.php';
        
        
        
        // Show 'loading' gif 
        checkAddressButton.hide();
        $('#address-approved').hide();
        $('#address-declined').hide();
        $('#address-loading').show();
        
        
        
        // Define params        
        var params = {
            action: 'coverage_map_check_address',
            address: $('#address-for-checking').val(),
            city: 'Los Angeles',
            state: 'CA',
            zip: '91101'
        }



        $.post(url, params, function(response) { 
            // Show 'check' button against 'loading.gif'
            $('#address-loading').hide();
            checkAddressButton.show();
            
            
            if (response == '1') {
                $('#address-declined').hide();
                $('#address-approved').show();
            } else {
                $('#address-approved').hide();
                $('#address-declined').show();   
                console.log(response);
            }
        });
    });
}); })(jQuery);
