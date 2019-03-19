(function($){
	$(document).ready(function() {
		var
		closeOpenBoxes = function($exclude) {
			if ($('.eitf-wrap.eitf-open').not($exclude).length) {
				$('.eitf-wrap.eitf-open').not($exclude).each(function(i, el){
					closeBox($(el));
				});
			}
		},
		closeBox = function($wrap) {
			var
			effect = $wrap.data('effect'),
			effect_duration = $wrap.data('effect_duration');

			$wrap.removeClass('eitf-open');
			$wrap.find('.open-icon').hide();
			$wrap.find('.close-icon').show();

			if ('slide' == effect) {
				$wrap.find('.eitf-text').slideUp(effect_duration, function(){
					$wrap.find('.eitf-image').slideDown(effect_duration, function(){
						$wrap.removeClass('eitf-animating');
					});
				});
			} else if ('fade' == effect) {
				$wrap.find('.eitf-text').fadeOut(effect_duration, function(){
					$wrap.find('.eitf-image').fadeIn(effect_duration, function(){
						$wrap.removeClass('eitf-animating');
					});
				});
			} else {
				$wrap.find('.eitf-image').show();
				$wrap.find('.eitf-text').hide();
				$wrap.removeClass('eitf-animating');
			}
		},
		openBox = function($wrap) {
			var
			effect = $wrap.data('effect'),
			effect_duration = $wrap.data('effect_duration');

			$wrap.addClass('eitf-open');
			$wrap.find('.open-icon').show();
			$wrap.find('.close-icon').hide();

			if ('slide' == effect) {
				$wrap.find('.eitf-image').slideUp(effect_duration, function(){
					$wrap.find('.eitf-text').slideDown(effect_duration, function(){
						$wrap.removeClass('eitf-animating');
					});
				});
			} else if ('fade' == effect) {
				$wrap.find('.eitf-image').fadeOut(effect_duration, function(){
					$wrap.find('.eitf-text').fadeIn(effect_duration, function(){
						$wrap.removeClass('eitf-animating');
					});
				});
			} else {
				$wrap.find('.eitf-text').show();
				$wrap.find('.eitf-image').hide();
				$wrap.removeClass('eitf-animating');
			}
		};

		/* toggle button */
		$(document.body).on('click', '.eitf-button, .eitf-image', function(){
			var $wrap = $(this).closest('.eitf-wrap');

			closeOpenBoxes($wrap);

			if ($wrap.hasClass('eitf-animating')) {
				return false;
			}
			$wrap.addClass('eitf-animating');

			if (! $wrap.hasClass('eitf-open')) {
				openBox($wrap);
			} else {
				closeBox($wrap);
			}

			return false;
		});
	});
})(jQuery);
