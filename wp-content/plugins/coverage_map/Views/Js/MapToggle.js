(function($) { $(function() {
    $('#map-toggle').on('click', function(ev) { 
        ev.preventDefault();
        
        var state = $(this).attr('data-state');
        
        if (state == 'hidden') {   
            $('#map-wrapper').show();
            
            $(this).attr('data-state', 'shown');
            $(this).html('Hide Map');
        } else {
            $('#map-wrapper').hide();
            
             $(this).attr('data-state', 'hidden');
            $(this).html('Show Map');
        }
    });
}); })(jQuery);
