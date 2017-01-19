var $jquery = jQuery.noConflict();

$jquery(function($) {

	$('#nav-menu-toggle').on('click', function() {
		
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
			$('#blog-sidebar').animate({left:'-220px'});
		}
		else {
			$('#blog-sidebar').animate({left:'0px'});
		}
	});
});
