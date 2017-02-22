<?php
/**
 * The template for the sidebar containing the main widget area
 *
 * @package Amoeba
 * @since Amoeba 1.0
 */
?>

<?php if (is_active_sidebar('blog-sidebar')) : ?>
	<div id="sidebar" class="sidebar clearfix" role="complementary">
		<div id="widget-area">
		<?php dynamic_sidebar('blog-sidebar'); ?>
		</div>
		<!--<button id="sidebar-toggle">
			<i class="fa fa-bars"></i>
			<span></span>
		</button>-->
	</div>
<?php endif; ?>

