$(window).on('load resize', function(){
		var width = $(window).width();
		if(width < 1024){
			$(document).find('.flip-table').each(function() {
				object = $(this).attr('id').valueOf();
					var i=0;
					var n=i;
					var content =[];
					$('#'+object+' th .tb-head').each(function() {
						content[i] =  $(this).html();
						i++;
						n=i;
					});
					
					$('#'+object+' tbody > tr').each(function() {
						$(this).children('td').each(function() {
							$(this).attr('data-content',content[n-i])
							i--;	
						});
						i=n;
					});
				
            });
			
		}
		
	})