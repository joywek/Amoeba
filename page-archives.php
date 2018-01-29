<?php
/**
 * Template Name: Archives
 *
 * The template for displaying all posts;
 *
 * @package Amoeba
 */

get_header(); ?>

<div id="site-body">
	<div id="main">
		<div class="inner">
		<?php
			query_posts(array('nopaging' => 1));
			$prev_year = null;
			if (have_posts()) {
				while (have_posts()) {
					the_post();
					$this_year = get_the_date('Y');
					if ($prev_year != $this_year) {
						if (!is_null($prev_year)) {
							echo '</ul>';
						}
						echo '<h2>' . $this_year . '</h2>';
						echo '<ul class="archives-by-year">';
					}
					get_template_part('template-parts/archive-item');
					$prev_year = $this_year;
				}
				echo '</ul>';
			}
		?>
		</div>
	</div>
	<?php get_sidebar(); ?>
</div>

<?php get_footer(); ?>
