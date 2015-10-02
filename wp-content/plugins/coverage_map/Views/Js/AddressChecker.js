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
            address: $('#address-for-checking').val()
        }



        $.post(url, params, function(response) { 
            // Show 'check' button against 'loading.gif'
            $('#address-loading').hide();
            checkAddressButton.show();
            
            
            if (response == '0' || !(/[0-9\.,]{1,10}/.test(response))) {
                $('#address-approved').hide();
                $('#address-declined').show();   
            } else {
                $('#approved-speed').html(response);       
                $('#address-declined').hide();
                $('#address-approved').show();
            }
        });
    });
}); })(jQuery);
