	(function($) {
		$.fn.extend({
			fireme: function(options){
				var defaults={
					fadein:2000,
					fadeout:5000,
					me:$(this).text(),
					texto:' !Sin aceptar!',
					checks:'off'
					}
				var options = $.extend(defaults,options);
				var mensaje = '<span class="redmssg" style="color:red;">'+defaults.texto+'</span>';
//Para los checkboxes
				var is_checkbox=$(this).prev().is(':checkbox');
				var checked=$(this).prev().is(':checked')
				var mique=$(this);
				console.log(mique);
				if(!is_checkbox) return false;

				
				if(!checked){
					$(this).after(mensaje);
					$(this).fadeIn(defaults.fadein);
					$('.redmssg').fadeOut(defaults.fadeout);
				}

//			$(this).after(mensaje);
//				$(this).fadeIn(defaults.fadein);
//				$('.redmssg').fadeOut(defaults.fadeout);
			
			}
		});	
	})(jQuery);
		(function($) {
		$.fn.extend({
			colorme: function(options){
				var defaults={
					fadein:2000,
					fadeout:5000,
					me:$(this).text(),
					texto:' !Sin aceptar!',
					checks:'off'
					}
				var options = $.extend(defaults,options);
				var mensaje = '<span class="redmssg" style="color:red;">'+defaults.texto+'</span>';
//Para los checkboxes
				var is_checkbox=$(this).prev().is(':checkbox');
				var checked=$(this).prev().is(':checked')

				if(!is_checkbox) return false;

				
				if(!checked){
					$(this).css('color', '#202020');

				}

//			$(this).after(mensaje);
//				$(this).fadeIn(defaults.fadein);
//				$('.redmssg').fadeOut(defaults.fadeout);
			
			}
		});	
	})(jQuery);
