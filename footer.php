<?php


function privacy_item() {
	$options = get_option('amoeba_options_general');
	$page_id = amoeba_get_option($options, null, 'privacy_page');
	if ($page_id) {
		echo '<li class="site-footer-item"><a href="', get_permalink($page_id), '">Privacy and Cookies</a></li>•';
	}
}
?>

			<footer id="site-footer">
				<div class="inner">
					<ul>
						<li class="site-footer-item">Copyright © 2017 Amit</li>•
						<?php privacy_item(); ?>
						<li class="site-footer-item">Proudly powered by <a href="http://wordpress.org">WordPress</a></li>
					</ul>
				</div>
			</footer>
		</div>
		<a href="#" id="back-to-top" style="display:none"></a>
		<?php wp_footer(); ?>
		<?php include_once("analytics.php") ?>
		<script src="<?php echo get_stylesheet_directory_uri() ?>/js/salvattore.min.js"></script>
	</body>
</html>
