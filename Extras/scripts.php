<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.4.2/jquery.min.js"></script>
<script type="text/javascript" src="jquery.easing.1.3.js"></script>
<script type="text/javascript">
	$(function () {
		/**
		* for each menu element, on mouseenter, 
		* we enlarge the image, and show both sdt_active span and 
		* sdt_wrap span. If the element has a sub menu (sdt_box),
		* then we slide it - if the element is the last one in the menu
		* we slide it to the left, otherwise to the right
		*/
		$('#sdt_menu > li').bind('mouseenter', function () {
			var $elem = $(this);
			$elem.find('img')
				.stop(true)
				.animate({
					'width': '170px',
					'height': '170px',
					'left': '0px'
				}, 400, 'easeOutBack')
				.andSelf()
				.find('.sdt_wrap')
				.stop(true)
				.animate({ 'top': '140px' }, 500, 'easeOutBack')
				.andSelf()
				.find('.sdt_active')
				.stop(true)
				.animate({ 'height': '170px' }, 300, function () {
					var $sub_menu = $elem.find('.sdt_box');
					if ($sub_menu.length) {
						var left = '170px';
						if ($elem.parent().children().length == $elem.index() + 1)
							left = '-170px';
						$sub_menu.show().animate({ 'left': left }, 200);
					}
				});
		}).bind('mouseleave', function () {
			var $elem = $(this);
			var $sub_menu = $elem.find('.sdt_box');
			if ($sub_menu.length)
				$sub_menu.hide().css('left', '0px');

			$elem.find('.sdt_active')
				.stop(true)
				.animate({ 'height': '0px' }, 300)
				.andSelf().find('img')
				.stop(true)
				.animate({
					'width': '0px',
					'height': '0px',
					'left': '85px'
				}, 400)
				.andSelf()
				.find('.sdt_wrap')
				.stop(true)
				.animate({ 'top': '25px' }, 500);
		});
	});
</script>


<!--===============================================================================================-->
<script src="form/vendor/animsition/js/animsition.min.js"></script>
<!--===============================================================================================-->
<script src="form/vendor/bootstrap/js/popper.js"></script>
<script src="form/vendor/bootstrap/js/bootstrap.min.js"></script>
<!--===============================================================================================-->
<script src="form/vendor/select2/select2.min.js"></script>
<!--===============================================================================================-->
<script src="form/vendor/daterangepicker/moment.min.js"></script>
<script src="form/vendor/daterangepicker/daterangepicker.js"></script>
<!--===============================================================================================-->
<script src="form/vendor/countdowntime/countdowntime.js"></script>
<!--===============================================================================================-->
<script src="form/js/main.js"></script>

<!-- Global site tag (gtag.js) - Google Analytics -->
<script async src="https://www.googletagmanager.com/gtag/js?id=UA-23581568-13"></script>
<script>
	window.dataLayer = window.dataLayer || [];
	function gtag() { dataLayer.push(arguments); }
	gtag('js', new Date());

	gtag('config', 'UA-23581568-13');
</script>