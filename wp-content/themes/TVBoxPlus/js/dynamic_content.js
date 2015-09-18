$(function(){
	$('#cursor-vod-next').on("click",function(){
		nextPage("vod");
	});	
	$('#cursor-vod-prev').on("click",function(){
		prevPage("vod");
	});
	
	
	$('#cursor-announcement‏-next').on("click",function(){
		nextPage("announcement");
	});
	
	$('#cursor-announcement‏-prev').on("click",function(){
		prevPage("announcement");
	});
	
	
	
	
	function nextPage(content_title) {
		var current_page = $('#' + content_title + '_page').val()*1;
		var last_page = $('#' + content_title + '_last_page').val()*1;
		var first_page = 1;
		
		if (current_page != last_page) {
			var next_page = current_page + 1;
		}
		else {
			var next_page = first_page;
		}
		
		
		for (var i=first_page; i<=last_page; i++) {
			if (i==next_page) {
				$('.' + content_title + '_page--' + i).show("fast");
			}
			else {
				$('.' + content_title + '_page--' + i).hide("fast");
			}			
		}
		
		
		$('#' + content_title + '_page').val(next_page);
	}
	
	function prevPage(content_title) {
		var current_page = $('#' + content_title + '_page').val()*1;
		var last_page = $('#' + content_title + '_last_page').val()*1;
		var first_page = 1;
		if (current_page != first_page) {
			var prev_page = current_page - 1;
		}
		else {
			var prev_page = last_page;
		}

		for (var i=first_page; i<=last_page; i++) {
			if (i==prev_page) {
				$('.' + content_title + '_page--' + i).show("fast");
			}
			else {
				$('.' + content_title + '_page--' + i).hide("fast");
			}			
		}

		$('#' + content_title + '_page').val(prev_page);
	}
});
