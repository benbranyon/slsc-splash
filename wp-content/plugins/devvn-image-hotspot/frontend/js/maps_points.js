(function($){

	function ihotspotInit(){
		$('.ihotspot_hastooltop').each(function(){
			$(this).data('powertip', function() {
				var htmlThis = $(this).parents('.ihotspot_tooltop_html').attr('data-html');
				return htmlThis;
			});
			var thisPlace = $(this).parents('.ihotspot_tooltop_html').data('placement');
			$(this).powerTip({
				placement: thisPlace,
				smartPlacement: true,
				mouseOnToPopup: true,
			}).on({
				powerTipClose: function() {
					$('#powerTip').html('');
				}
			});
		});
	}

	$('body').on('click','.close_ihp',function () {
		$.powerTip.hide();
	});

	$(document).ready(function(){
		ihotspotInit();
    });

	let firstLoad = true;
	function scroll_element(){
		let $top = $(window).scrollTop();
		if( $top >= 100 && firstLoad){
			ihotspotInit();
			firstLoad = false;
		}
	}

	$(window).scroll(function(){
		scroll_element();
	});

	$(window).bind('touchmove', function(e) {
		scroll_element();
	});

})(jQuery);