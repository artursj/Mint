(function ($){
	"use strict";

	$(document).ready(function () {
		var svg = 'no-svg';
		if (!!document.createElementNS && !!document.createElementNS('http://www.w3.org/2000/svg', 'svg').createSVGRect) {
			svg = 'svg';
		}
		$('html').addClass(svg);

		var $facebookWidgets = $('.tcw-widget-facebook-inner');

		if ($facebookWidgets.length) {
			$('body').append('<div id="fb-root">');

			var $first = $facebookWidgets.eq(0),
				locale = '' + $first.data('locale'),
				appId = '' + $first.data('app-id');

			var url = '//connect.facebook.net/' + locale + '/sdk.js#xfbml=1&version=v2.6';
			if (appId !== '') {
				url += '&appId=' + appId;
			}

			(function(d, s, id) {
				var js, fjs = d.getElementsByTagName(s)[0];
				if (d.getElementById(id)) return;
				js = d.createElement(s); js.id = id;
				js.src = url;
				fjs.parentNode.insertBefore(js, fjs);
			}(document, 'script', 'facebook-jssdk'));
		}
	});
})(jQuery);
