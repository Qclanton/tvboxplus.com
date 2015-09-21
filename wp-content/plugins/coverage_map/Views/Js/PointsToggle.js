(function($) { $(function() {
    // Add new point 
    $('.new-point-toggle').on('click', function(ev) { 
        ev.preventDefault();
        
        var state = $(this).attr('data-state');
        
        if (state == 'hidden') {
            $('#new-point').show()
            $(this).attr('data-state', 'shown');
            $(this).html('Hide adding form');
        } else {
            $('#new-point').hide()
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
    
    
    // Hide existsing points
    $('.existing-points-toggle ').on('click', function(ev) {
        ev.preventDefault();
        
        var state = $(this).attr('data-state');
        
        if (state == 'hidden') {
            $('#points').show()
            $(this).attr('data-state', 'shown');
            $(this).html('Hide points');
        } else {
            $('#points').hide()
            $(this).attr('data-state', 'hidden');
            $(this).html('Show points');
        }  
    }); 
}); })(jQuery);
