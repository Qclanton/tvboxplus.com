(function($) { $(function() {
    // Add new zone 
    $('.new-zone-toggle').on('click', function(ev) { 
        ev.preventDefault();
        
        var state = $(this).attr('data-state');
        
        if (state == 'hidden') {
            $('#new-zone').show()
            $(this).attr('data-state', 'shown');
            $(this).html('Hide adding form');
        } else {
            $('#new-zone').hide()
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
    
    
    // Hide existsing zones
    $('.existing-zone-toggle ').on('click', function(ev) {
        ev.preventDefault();
        
        var state = $(this).attr('data-state');
        
        if (state == 'hidden') {
            $('#points').show()
            $(this).attr('data-state', 'shown');
            $(this).html('Hide zones');
        } else {
            $('#points').hide()
            $(this).attr('data-state', 'hidden');
            $(this).html('Show zones');
        }  
    }); 
}); })(jQuery);
