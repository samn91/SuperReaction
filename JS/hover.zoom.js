(function($){

    $.fn.extend({ 

        hoverZoom: function(settings) {
 
            var defaults = {
                overlay: true,
                overlayColor: '#2e9dbd',
                overlayOpacity: 0.7,
                zoom: 25,
                speed: 300
            };
             
            var settings = $.extend(defaults, settings);
         
            return this.each(function() {
                var s = settings;
                var hz = $(this);
                var image = $('img', hz);
				
				var nn=image.attr("src").split("/");
				var imgalt=image.attr("alt");
				var upimg='upload/'+nn[1];
				var adimg='admin/'+nn[1];
				
				if(imgalt=='1')
				{
					hz.append('<div class="loader" />');
					image.load(function () {
					$('div.loader').remove();
					}).attr('src', upimg);
					return;
				}
              //  image.load(function() {
                    
                    if(s.overlay === true) {
                        hz.append('<div class="zoomOverlay" />');
                        $(this).parent().find('.zoomOverlay').css({
                            opacity:s.overlayOpacity, 
                            display: 'block', 
                            backgroundColor: s.overlayColor
                        }); 
						
                    }
                
 

				$(this).fadeIn(1000, function() {
					$(this).parent().css('background-image', 'none');
					hz.hover(function() {
						if('admin' == nn[0])
						{
							hz.append('<div class="loader" />');
							image.load(function () {
									$('div.loader').remove();
									$(this).fadeIn();
							}).attr('src', upimg);
								//image.attr("src",upimg);
							if(s.overlay === true) {
								$(this).parent().find('.zoomOverlay').stop().animate({
									opacity: 0
								}, s.speed);
							}
						}
					}, function() {
						image.attr("src",adimg);
					  
						 if(s.overlay === true) {
							$(this).parent().find('.zoomOverlay').stop().animate({
								opacity: s.overlayOpacity
							}, s.speed);
						}
					});
				});
               // });    
            });
        }
    });
})(jQuery);