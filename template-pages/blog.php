<?php
/* 
 * Template Name: Blog
 *
 * @package Amoeba
 */

get_header(); ?>

<?php query_posts('posts_per_page=20'); ?>

<?php if (have_posts()): ?>
	<div id="site-body">
		<div class="wrap blog-wrap">
			<div class="blog-content">
			<?php
				global $more;
				while (have_posts()) : the_post();
					$more = false;
					get_template_part('template-parts/content', get_post_format());
					$more = true;
				endwhile;
				the_posts_pagination(array(
					'prev_text'          => __('Previous page', 'amoeba'),
					'next_text'          => __('Next page', 'amoeba'),
					'before_page_number' => '<span class="meta-nav screen-reader-text">' . __('Page', 'amoeba') . ' </span>',
				));
			?>
			</div>
			<?php get_sidebar(); ?>
		</div>
	</div>
<?php else: ?>
	<?php get_template_part('no-results', 'archive'); ?>
<?php endif; ?>

get_footer();
