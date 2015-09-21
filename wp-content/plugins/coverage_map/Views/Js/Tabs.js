(function($) { $(function() { 
    $('a.nav-tab').on('click', function(ev) {
        // Disable defualt link functionality
        ev.preventDefault();
        
        
        // Define active tab
        var activeTab = $(this).attr('data-tab');
        
        
        // Mark current tab as acive
    	$('.nav-tab').removeClass('nav-tab-active');
        $(this).addClass('nav-tab-active');
        
        
        // Show content of active tab
        $('.tab-content').each(function() {             
        	if ($(this).attr('data-tab') == activeTab) {
            	$(this).show();
            } else {
            	$(this).hide();
            }         
        });
    });    
}); })(jQuery); 
