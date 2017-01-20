var $jquery = jQuery.noConflict();

$jquery(function($) {

	$('#nav-menu-toggle').on('click', function() {
		var $menu = $('#nav-menu');
		$menu.toggle(300, function() {
			if ($(this).css("display") == "none") {
				$(this).css("display", "");
			}
		});
	});

	var $header = $('#site-header');
	var $sidebar = $('#blog-sidebar');
	var headerBottom = $header.position().top + $header.height();
	
	function sidebarLayout() {
		var height = $(window).height() - $header.position().top - 40;
		$sidebar.css({ top: headerBottom + 'px', height: height + 'px'});
	}
	sidebarLayout();

	$(window).resize(function() {
		sidebarLayout();
		if ($(this).width() > 960) {
			$sidebar.css('left', '');
		}
	});

	$(window).scroll(function() {
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
		if ($sidebar.position().left == 0) {
			$sidebar.animate({left:'-220px'}, function() {
				$sidebar.css('left', '');
			});
		}
		else {
			$sidebar.animate({left:'0px'});
		}
	});
});
