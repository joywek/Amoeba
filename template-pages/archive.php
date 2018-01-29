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
			if (have_posts()) :
				while (have_posts()) :
					the_post();
					$this_year = get_the_date('Y');
					if ($prev_year != $this_year) :
						if (!is_null($prev_year)) :
							echo '</ul>';
						endif;
						echo '<h3>' . $this_year . '</h3>';
						echo '<ul>';
					endif;
					echo '<li>';
					echo '<a href="', get_the_permalink(), '">', get_the_date('m-d'),  ' ',  get_the_title(), '</a>';
					echo '</li>';
					$prev_year = $this_year;
				endwhile;
				echo '</ul>';
			endif;
		?>
		</div>
	</div>
	<?php get_sidebar(); ?>
</div>

<?php get_footer(); ?>
