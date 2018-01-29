<article id="post-<?php the_ID(); ?>" <?php post_class('post-entry'); ?>>
	<div class="inner">
		<header class="entry-header">
		<?php if (!is_single()) : ?>
			<h1><a href="<?php the_permalink(); ?>" rel="bookmark" title="Permanent Link to <?php the_title_attribute(); ?>"><?php the_title(); ?></a></h1>
		<?php else : ?>
			<h1><?php the_title() ?></h1>
		<?php endif ?>

		<?php get_template_part('template-parts/entry-meta'); ?>

		</header>
		<div class="entry-content">
			<?php the_content(__('Read More', 'amoeba')); ?>
		</div>
	</div>
</article>
