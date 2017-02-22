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

	class Blog {

		constructor() {
			this.sidebar = $('#sidebar');
			this.container = $('#container');

			var blog = this;

			$('#main').click(function() {
				if ($(window).width() <= 800) {
					blog.closeSidebar();
				}
			});
			$('#sidebar-toggle').click(function() {
				blog.toggleSidebar();
			});
		}

		openSidebar() {
			this.sidebar.css('left', '0');
			this.container.css('margin-left', '250px');
		}

		closeSidebar() {
			$(document.body).addClass('sidebar-close');
			this.sidebar.css('left', '-250px');
			this.container.css('margin-left', '0');
		}
		
		toggleSidebar() {
			if (this.sidebar.position().left == 0) {
				this.closeSidebar();
			}
			else {
				this.openSidebar();
			}
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
		}
	};

	Pager.create();

	let blog = new Blog();
	
	function layout() {
		blog.sidebar.css({'height': $(window).height() - blog.sidebar.position().top - 45 + 'px'});
	}
	layout();
	$(window).resize(function() {
		layout();
	});
});
