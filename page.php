<?php
/**
 * The template for displaying all pages.
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site may use a
 * different template.
 *
 * @package Amoeba
 */

get_header(); ?>

<div id="site-body">
	<div id="main" class="main">
	<?php
		while (have_posts()) : the_post();
			get_template_part('template-parts/content', 'page');
		endwhile;
	?>
	</div>
</div>

<?php get_footer(); ?>

