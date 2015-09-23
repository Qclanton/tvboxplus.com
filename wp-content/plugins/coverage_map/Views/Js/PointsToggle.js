(function($) { $(function() {
    // Add new point 
    $('.new-point-toggle').on('click', function(ev) { 
        ev.preventDefault();
        
        var state = $(this).attr('data-state');
        
        if (state == 'hidden') {            
            // Show "New point" block
            $('#new-point').show()

            
            // Hide "Existing Points" block
            $('#points').hide()

            
            // Mark as shown
            $(this).attr('data-state', 'shown');
            $(this).html('Show existing points');
            
        } else {
            // Hide "New point" block
            $('#new-point').hide()

            
            // Show "Existing Points" block
            $('#points').show()

            
            // Mark as hidden
            $(this).attr('data-state', 'hidden');
            $(this).html('Add point');
        }
    });
    
    
    // Destroy new point if it won't added
    $('form').on('submit', function() {        
        var newPointState = $('.new-point-toggle').attr('data-state'); 
               
        if (newPointState == 'hidden') {
            $('#new-point').html('');            
        }  
    });
}); })(jQuery);
