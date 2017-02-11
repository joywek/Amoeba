<?php
/**
 * The template for displaying all single posts.
 *
 * @package Amoeba
 */

$script = '<script type="text/javascript">(function($){window.onload=function(){$("#main").append($("#site-footer"));}})(jQuery);</script>';

get_header(); ?>

<div id="site-body">
	<div id="main">
		<?php
		while (have_posts()) : the_post();
			get_template_part('template-parts/content', get_post_format());
		endwhile;
		if (comments_open() || get_comments_number()) :
			comments_template();
		endif;
		?>
	</div>
	<?php get_sidebar(); ?>
</div>

<?php get_footer(); ?>
