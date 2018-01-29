<div class="entry-meta">
	<div class="inner">
		<span class="date">
			<i class="fa fa-calendar"></i>
			<time class="entry-date"><?php echo esc_html(get_the_date()); ?></time>
		</span>
		<span class="categories">
			<i class="fa fa-folder-o"></i>
			<?php echo get_the_category_list(esc_html__(', ', 'amoeba')); ?>
		</span>
	</div>
</div>
