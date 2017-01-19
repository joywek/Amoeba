<?php
/* 
 * Template Name: Home
 *
 * @package Amoeba
 */

get_header(); ?>

<?php if (have_posts()): ?>
<div id="site-body">
	<div class="wrap blog-wrap">
		<div class="blog-main">
			<?php
			while (have_posts()) : the_post();
				get_template_part('template-parts/content', get_post_format());
			endwhile;
			?>
		</div>
	</div>
</div>
<?php else: ?>
<?php get_template_part('no-results', 'archive'); ?>		
<?php endif; ?>

<?php get_footer(); ?>

