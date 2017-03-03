var $jquery = jQuery.noConflict();

$jquery(function($) {

	var $adminbar = $('#wpadminbar');
	
	$('#nav-menu-toggle').on('click', function() {
		var $menu = $('#nav-menu');
		$menu.toggle(300, function() {
			if ($(this).css("display") == "none") {
				$(this).css("display", "");
			}
		});
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

	var Blog = {

		create: function() {

			var blog = {};

			blog.sidebar = $('#sidebar');
			blog.container = $('#container');

			$('#main').click(function() {
				if ($(window).width() <= 800) {
					blog.closeSidebar();
				}
			});
			$('#sidebar-toggle').click(function() {
				blog.toggleSidebar();
			});

			blog.openSidebar = function() {
				blog.sidebar.css('left', '0');
				blog.container.css('margin-left', '250px');
			}

			blog.closeSidebar = function() {
				$(document.body).addClass('sidebar-close');
				blog.sidebar.css('left', '-250px');
				blog.container.css('margin-left', '0');
			}
			
			blog.toggleSidebar = function() {
				if (blog.sidebar.position().left == 0) {
					blog.closeSidebar();
				}
				else {
					blog.openSidebar();
				}
			}

			return blog;
		}

	}

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

			return pager;
		}
	};

	Pager.create();
	var blog = Blog.create();
	
	function layout() {
		var $socailBar = $('.widget_social');
		var socailBarHeight = ($socailBar.length && $socailBar.is(':visible')) ? $socailBar.height() : 0;
		var sidebarTop = blog.sidebar.length ? blog.sidebar.position().top : 0;
		blog.sidebar.css({'height': $(window).height() - sidebarTop - socailBarHeight + 'px'});
	}
	layout();
	$(window).resize(function() {
		layout();
	});
});
