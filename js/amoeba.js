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

	var Pager = {

		create: function() {
			var pager = {};
		
			pager.navigation = $('ul.nav');
			pager.navigation.data('sel', 0);
			pager.navigation.on('click', 'li:not(.external)', function(e) {
				var $li = $(this);
				var $target = $($li.children('a').attr('href'));
				var index = pager.navigation.children().index($li);
				pager.handleMenu(index);
			});

			pager.handleMenu = function(index) {
				pager.navigation.children().eq(index)
					.addClass('current')
					.siblings().removeClass('current');
			}
		}
	};

	Pager.create();

	//$('.main').click(function() {
	//	$e = $('.widget-area');
	//	if ($e.position().left == 0) {
	//		$e.stop().animate({'left':'-250px'}, 300);
	//	}
	//	else {
	//		$e.stop().animate({'left':'0'}, 300);
	//	}
	//});

});
