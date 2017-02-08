<?php 
/**
 * The main template file.
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 *
 * @package Amoeba
 */

get_header();
?>

<div id="site-body">
	<?php if (have_posts()): ?>
		<div id="blog-content" class="blog-content">
		<?php
			while (have_posts()) : the_post();
				get_template_part('template-parts/content', get_post_format());
			endwhile;
			the_posts_pagination(array(
				'mid_size'           => 5,
				'prev_text'          => __('Previous page', 'amoeba'),
				'next_text'          => __('Next page', 'amoeba'),
				'before_page_number' => '<span class="meta-nav screen-reader-text">' . __('Page', 'amoeba') . ' </span>',
			));
		?>
		</div>
	<?php else: ?>
		<?php get_template_part('no-results', 'archive'); ?>		
	<?php endif; ?>
	<?php get_sidebar(); ?>
</div>

<?php get_footer(); ?>

