(function($) { $(function() {
    // Navigation 
    $('a.nav-tab').on('click', function(ev) {
        // Disable defualt link functionality
        ev.preventDefault();
        
        
        // Define active tab
        var activeTab = $(this).attr('data-tab');
        
        
        // Mark current tab as acive
    	$('.nav-tab').removeClass('nav-tab-active');
        $(this).addClass('nav-tab-active');
        
        
        // Save info about active tab to cookies
        var expirationDate = new Date();
        expirationDate.setTime(expirationDate.getTime() + (365*24*60*60*1000));
        document.cookie='coverage-map-active-tab=' + activeTab + '; Expires="' + expirationDate.toUTCString() + '"; path=/';
        
        
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
