			<footer id="site-footer">
				<div class="inner">
					<ul>
						<li class="site-footer-item">Copyright © 2019 Simon Wang</li>•
						<li class="site-footer-item">Proudly powered by <a href="http://wordpress.org">WordPress</a></li>
					</ul>
				</div>
			</footer>
		</div>
		<a href="#" id="back-to-top" style="display:none"></a>
		<?php 
			wp_footer();
			//get_template_part('template-parts/quick-access');
			include_once("analytics.php");
			if (is_page('gallery')) {
				echo '<script src="' . get_stylesheet_directory_uri() . '/js/salvattore.min.js"></script>';
			}
		?>
	</body>
</html>
