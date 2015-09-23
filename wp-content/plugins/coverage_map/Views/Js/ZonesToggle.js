(function($) { $(function() {
    // Add new zone 
    $('.new-zone-toggle').on('click', function(ev) { 
        ev.preventDefault();
        
        var state = $(this).attr('data-state');
        
        if (state == 'hidden') {            
            // Show "New zone" block
            $('#new-zone').show()

            
            // Hide "Existing Zones" block
            $('#zones').hide()

            
            // Mark as shown
            $(this).attr('data-state', 'shown');
            $(this).html('Show existing zones');
            
        } else {
            // Hide "New zone" block
            $('#new-zone').hide()

            
            // Show "Existing Zones" block
            $('#zones').show()

            
            // Mark as hidden
            $(this).attr('data-state', 'hidden');
            $(this).html('Add zone');
        }
    });
    
    
    // Destroy new zone if it won't added
    $('form').on('submit', function() {        
        var newPointState = $('.new-zone-toggle').attr('data-state'); 
               
        if (newPointState == 'hidden') {
            $('#new-zone').html('');            
        }  
    });
}); })(jQuery);
