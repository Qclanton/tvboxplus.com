(function($) { $(function() {
    $('.remove-point').on('click', function(ev) {
        ev.preventDefault();
        
        var point = $(this).attr('data-point');
        var isConfirmed  = confirm('Do you really want to delete point?');
        
        if (isConfirmed) {         
            $('[data-point="' + point + '"]').remove();
        }
    })
}); })(jQuery);
