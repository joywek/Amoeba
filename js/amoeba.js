var $jquery = jQuery.noConflict();

$jquery(function($) {

	var $adminbar = $('#wpadminbar');
	var $header = $('#site-header');
	var $sidebar = $('#sidebar');
	var $widgets = $('#widget-area');
	
	function layout() {
		$header.css('top', $adminbar.is(':visible') ? $adminbar.height() + 'px' : 0);
		var height = $(window).height() - $header.position().top - $header.height();
		$sidebar.css({ top: ($header.position().top + $header.height()) + 'px', height: height + 'px'});
	}
	layout();

	$(window).resize(function() {
		layout();
		if ($(this).width() > 960) {
			$sidebar.css('left', '');
		}
	});


	$('#nav-menu-toggle').on('click', function() {
		var $menu = $('#nav-menu');
		$menu.toggle(300, function() {
			if ($(this).css("display") == "none") {
				$(this).css("display", "");
			}
		});
	});

	$(window).scroll(function() {
		if ($widgets.is(':visible') && $('#sidebar-toggle').is(':visible')) {
			$widgets.toggle();
		}
		var $backToTopButton = $('#back-to-top');
		var st = $(window).scrollTop();
		if (st > 200) {
			$backToTopButton.fadeIn(1000);
		}
		else {
			$backToTopButton.fadeOut(1000);
		}
	});

	$('#sidebar-toggle').click(function() {
		$widgets.toggle(200, function() {
			if (!$widgets.is(':visible')) {
				$widgets.css('display', '');
			}
		});
		//if ($sidebar.position().left == 0) {
		//	$sidebar.animate({left:'-220px'}, function() {
		//		$sidebar.css('left', '');
		//	});
		//}
		//else {
		//	$sidebar.animate({left:'0px'});
		//}
	});
});
