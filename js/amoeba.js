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

			var self = {};

			self.sidebar = $('#sidebar');
			self.container = $('#container');

			if (self.sidebar.length == 0 || self.sidebar.is(":hidden")) {
				self.container.css('margin-left', '0');
			}

			$('#main').click(function() {
				if ($(window).width() <= 800) {
					self.closeSidebar();
				}
			});
			$('#sidebar-toggle').click(function() {
				self.toggleSidebar();
			});

			self.openSidebar = function() {
				self.sidebar.css('left', '0');
				self.container.css('margin-left', '250px');
			}

			self.closeSidebar = function() {
				$(document.body).addClass('sidebar-close');
				self.sidebar.css('left', '-250px');
				self.container.css('margin-left', '0');
			}
			
			self.toggleSidebar = function() {
				if (self.sidebar.position().left == 0) {
					self.closeSidebar();
				}
				else {
					self.openSidebar();
				}
			}

			self.layoutSidebar = function() {
				var $socailBar = $('.widget_social');
				var socailBarHeight = ($socailBar.length && $socailBar.is(':visible')) ? $socailBar.height() : 0;
				var sidebarTop = self.sidebar.length ? self.sidebar.position().top : 0;
				self.sidebar.css({'height': $(window).height() - sidebarTop - socailBarHeight + 'px'});
			}

			self.layoutSidebar();

			return self;
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

	var magnificPopup = function() {
		$('.image-popup').magnificPopup({
			type: 'image',
			removalDelay: 300,
			mainClass: 'mfp-with-zoom',
			titleSrc: 'title',
			gallery:{
				enabled:true
			},
			zoom: {
				enabled: true, // By default it's false, so don't forget to enable it

				duration: 300, // duration of the effect, in milliseconds
				easing: 'ease-in-out', // CSS transition easing function

				// The "opener" function should return the element from which popup will be zoomed in
				// and to which popup will be scaled down
				// By defailt it looks for an image tag:
				opener: function(openerElement) {
					// openerElement is the element on which popup was initialized, in this case its <a> tag
					// you don't need to add "opener" option if this code matches your needs, it's defailt one.
					return openerElement.is('img') ? openerElement : openerElement.find('img');
				}
			}
		});
	};

	var JQuickAccess = {

		create: function() {
		
			var qa = {};

			var linkList = $("body a");
			qa.actionIndex = [];
			qa.tagIndex = [];
			$(linkList).each(function (idx, ele) {
				if (!!$(ele).data("action")) {
					qa.actionIndex.push({
						"title"  : $(ele).data("title") || $(ele).text(),
						"action" : $(ele).data("action")
					});
				}
	
				var tags = [];
				if (!!$(ele).attr("href") && $(ele).attr("href").length > 0) {
					tags = $(ele).attr("href").toLowerCase().replace(/http:|https:/g, "").replace(/[^a-zA-Z0-9]+/g, ".").split(".");
					var title = ele.text.trim();
					if (title.length > 0) {
						tags.push(title);
					}
					qa.tagIndex.push({
						"tags" : tags,
						"title" : title,
						"href" : $(ele).attr("href"),
					});
				}
			});

			$("#J-qa-input").focus();

			qa.onKeyDown = function(e) {
				if ((e.metaKey && e.keyCode == 67) || (e.ctrlKey && e.keyCode == 67)) {
					return;
				}

				switch (e.keyCode) {
					case 13:
					case 16:
					case 17:
					case 18:
					case 91: {
					}
					break;

					case 38: {
						qa.focusMove(-1);
						e.preventDefault();
					}
					break;

					case 9:
					case 40: {
						qa.focusMove(1);
						e.preventDefault();
					}
					break;

					case 27: {
						// ESC
						qa.hide(true);
					}
					break;

					default: {
						$("#J-quick-access").removeClass("qa-hide");
						$("#J-qa-input").focus();
					}
					break;
				}
			};

			qa.hide = function(force) {
				if ($("#J-qa-input").val().length == 0 || force) {
					$("#J-quick-access").addClass("qa-hide");
					$("#J-qa-input").val("");
				}
			};
			
			qa.search = function(e) {
				window.clearInterval(qa.tagSearchInterval);
				qa.tagSearchInterval = window.setInterval(function() {
					window.clearInterval(qa.tagSearchInterval);
					var keyword = $("#J-qa-input").val().toLowerCase();
					if (qa.lastKeyword == keyword)
						return;
					keyword = keyword.replace(/ /g, "");
					qa.lastKeyword = keyword;
					qa.clearItems();
					if (keyword.length == 0) {
						return;
					}
					$(qa.tagIndex).each(function (idx, ele) {
						if (ele["tags"].join(",").indexOf(keyword) >= 0) {
							qa.appendItem(ele);
						}
					});

					$(qa.actionIndex).each(function (idx, ele) {
						$.getJSON(ele["action"].replace(/\{keyword\}/g, keyword), function (data) {
							if (!!data.result) {
								for (var i = data.result.length - 1; i >= 0; i--) {
									qa.appendItem(data.result[i]);
								};
							}
						});
					});

					$("#J-qa-list li a").first().focus();
				}, 300);
			};

			qa.foucsMove = function(delta) {
				var items = $("#J-qa-list li a");
				var currentIndex = -1;
				$(items).each (function (idx, ele) {
					if (ele == document.activeElement) {
						currentIndex = idx;
					}
				});

				currentIndex = currentIndex + delta;
				currentIndex = currentIndex < 0 ? (items.length-1) : currentIndex;
				currentIndex = (currentIndex == items.length) ? 0 : currentIndex;

				$(items[currentIndex]).focus();
			};

			qa.clearItems = function() {
				$($("#J-qa-list").children()).each (function (idx, ele) {
					$(ele).remove();
				});
			};

			qa.appendItem = function(item) {
				if ($("#J-qa-list li a").length > 10)
					return;

				$("#J-qa-list").append($('<li class="qa-item"><a href="' + item["href"] +
					'"><strong>' + item["title"] + '</strong> ' +
					item["href"] + '</a></li>'));

				if ($("#J-qa-list li a").length == 1) {
					$("#J-qa-list li a").first().focus();
				}
			};

			// 解析 # 参数
			if (window.location.hash.length > 1) {
				$("#J-qa-input").val(window.location.hash.replace(/^#/, ""));
				qa.search();
			}

			$(document.body).on("keyup", qa.search);
			$(document.body).on("keydown", qa.onKeyDown);

			return qa;
		}

	};

	$(function() {
		magnificPopup();
	});

	var pager = Pager.create();
	var blog = Blog.create();

	$(window).resize(function() {
		blog.layoutSidebar();
	});

});
