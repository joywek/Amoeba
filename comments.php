<?php
/**
 * The template for displaying comments.
 *
 * The area of the page that contains both current comments
 * and the comment form.
 *
 * @package Amoeba
 */

/*
 * If the current post is protected by a password and
 * the visitor has not yet entered the password we will
 * return early without loading the comments.
 */
if (post_password_required()) {
	return;
}

function comment_callback($comment, $args, $depth) {
	if ('div' == $args['style']) {
		$add_below = 'comment';
	} else {
		$add_below = 'div-comment';
	}
?>
	<li id="comment-<?php echo $comment->comment_ID; ?>" <?php comment_class('', $comment); ?>>
		<div class="comment-header">
			<div class="author-avatar">
				<?php echo get_avatar($comment, $args['avatar_size']); ?>
			</div>
			<div class="author-name">
				<?php comment_author_link($comment); ?>
			</div>
		</div>
		<div class="comment-meta">
			<span class="comment-date">
				<a href="<?php echo esc_url(get_comment_link($comment, $args)); ?>">
					<time datetime="<?php comment_time('c'); ?>">
					<?php printf(__('%1$s at %2$s'), get_comment_date('', $comment), get_comment_time()); ?>
					</time>
				</a>
			</span>
			<?php
				comment_reply_link(array_merge($args, array(
					'add_below' => 'div-comment',
					'depth'     => $depth,
					'max_depth' => $args['max_depth'],
					'before'    => '<span class="reply">',
					'after'     => '</span>'
				)));
				edit_comment_link(__('Edit'), '<span class="edit-link">', '</span>');
			?>
		</div>
		<div class="comment-body">
			<?php if ('0' == $comment->comment_approved) : ?>
				<p><em class="comment-awaiting-moderation"><?php _e('Your comment is awaiting moderation.') ?></em></p>
			<?php else: ?>
				<p>
				<?php if ($comment->comment_parent != 0) : ?>
					<span class="comment-parent"><?php echo '回复 @', get_comment_author_link($comment->comment_parent), ' '; ?></span>
				<?php endif; ?>
				<?php echo get_comment_text($comment, array_merge($args, array('add_below' => $add_below, 'depth' => $depth, 'max_depth' => $args['max_depth']))); ?>
				</p>
			<?php endif; ?>
			<div class="comment-footer">
			</div>
		</div>
	</li>
<?php
}
?>

<div id="comments" class="comments-area">
	<div class="inner">
		<?php if (have_comments()) : ?>
			<h2 class="comments-title">
				<?php printf('共 %1$s 个评论', get_comments_number()); ?>
			</h2>
			<ul class="comment-list">
			<?php
				wp_list_comments(array(
					'style'       => 'ul',
					'short_ping'  => true,
					'avatar_size' => 50,
					'callback'    => 'comment_callback',
				));
			?>
			</ul>
			<?php if (get_comment_pages_count() > 1 && get_option('page_comments')) : ?>
				<nav class="navigation comment-navigation" role="navigation">
					<h2 class="screen-reader-text"><?php _e('Comment navigation', 'nisarg'); ?></h2>
					<div class="nav-links">
					<?php
						if ($prev_link = get_previous_comments_link(__('Older Comments', 'nisarg'))) :
							printf('<div class="nav-previous">%s</div>', $prev_link);
						endif;
						if ($next_link = get_next_comments_link(__('Newer Comments', 'nisarg'))) :
							printf('<div class="nav-next">%s</div>', $next_link);
						endif;
					?>
					</div>
				</nav>
			<?php endif; ?>
			<?php if (!comments_open() && get_comments_number()) : ?>
				<p class="no-comments"><?php _e('Comments are closed.' , 'nisarg'); ?></p>
			<?php endif; ?>
		<?php endif; ?>
		<?php comment_form(); ?>
	</div>
</div>

