(function($) { $(function() {
    $('.remove-zone').on('click', function(ev) {
        ev.preventDefault();
        
        var zone = $(this).attr('data-zone');
        var isConfirmed  = confirm('Do you really want to delete zone?');
        
        if (isConfirmed) {         
            $('[data-zone="' + zone + '"]').remove();
        }
    })
}); })(jQuery);
