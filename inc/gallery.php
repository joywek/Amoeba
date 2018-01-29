<?php

if (!function_exists('amoeba_gallery_style')) :
function amoeba_gallery_style($gallery_div) {
	return substr_replace($gallery_div, " data-columns", -1, 0);
}
endif;
add_filter('gallery_style', 'amoeba_gallery_style', 10, 3);

function am_post_gallery($output, $attr) {

	$post = get_post();
	if (empty($post)) {
		return __( 'Missing Attachment' );
	}

	static $instance = 0;
	$instance++;

	if (!empty($attr['ids'])) {
		if (empty($attr['orderby']))
			$attr['orderby'] = 'post__in';
		$attr['include'] = $attr['ids'];
	}

	// We're trusting author input, so let's at least make sure it looks like a valid orderby statement
	if (isset($attr['orderby'])) {
		$attr['orderby'] = sanitize_sql_orderby($attr['orderby']);
		if (!$attr['orderby'])
			unset($attr['orderby']);
	}

	extract(shortcode_atts(array(
		'order'      => 'ASC',
		'orderby'    => 'menu_order ID',
		'id'         => $post ? $post->ID : 0,
		'itemtag'    => 'div',
		'icontag'    => 'div',
		'captiontag' => 'div',
		'columns'    => 1,
		'size'       => '-slimwriter-gallery-small',
		'include'    => '',
		'exclude'    => ''
	), $attr, 'gallery'));

	$id = intval($id);
	if ('RAND' == $order)
		$orderby = 'none';

	if ( !empty($include) ) {
		$_attachments = get_posts( array('include' => $include, 'post_status' => 'inherit', 'post_type' => 'attachment', 'post_mime_type' => 'image', 'order' => $order, 'orderby' => $orderby) );

		$attachments = array();
		foreach ( $_attachments as $key => $val ) {
			$attachments[$val->ID] = $_attachments[$key];
		}
	} elseif ( !empty($exclude) ) {
		$attachments = get_children( array('post_parent' => $id, 'exclude' => $exclude, 'post_status' => 'inherit', 'post_type' => 'attachment', 'post_mime_type' => 'image', 'order' => $order, 'orderby' => $orderby) );
	} else {
		$attachments = get_children( array('post_parent' => $id, 'post_status' => 'inherit', 'post_type' => 'attachment', 'post_mime_type' => 'image', 'order' => $order, 'orderby' => $orderby) );
	}

	if (empty($attachments))
		return '';

	if (is_feed()) {
		$output = "\n";
		foreach ($attachments as $att_id => $attachment)
			$output .= wp_get_attachment_link($att_id, $size, true) . "\n";
		return $output;
	}

	$itemwidth = $columns > 0 ? floor(100/$columns) : 100;
	$float = is_rtl() ? 'right' : 'left';

	$output = "<div id='gallery-$instance' class='gallery galleryid-{$id}' data-columns>";

	$i = 0;
	foreach ( $attachments as $id => $attachment ) {
		$image = wp_get_attachment_image_src($id, 'thumbnail', false);
		list($thumbnail_src, $width, $height) = $image;
		$image = wp_get_attachment_image_src($id, '', false);
		list($original_src, $width, $height) = $image;

		$image_meta  = wp_get_attachment_metadata( $id );
		$orientation = '';
		if (isset( $image_meta['height'], $image_meta['width']))
			$orientation = ($image_meta['height'] > $image_meta['width']) ? 'portrait' : 'landscape';

		$output .= "<{$itemtag} class='gallery-item'>";
		$output .= "
			<{$icontag} class='gallery-icon {$orientation}'>
				<a href='{$original_src}' class='image-popup'><img src='{$thumbnail_src}' alt='' /></a>
			</{$icontag}>";
		if ($captiontag && trim($attachment->post_excerpt) ) {
			$output .= "
				<{$captiontag} class='gallery-caption'>
				" . wptexturize($attachment->post_excerpt) . "
				</{$captiontag}>";
		}
		$output .= "</{$itemtag}>";
	}

	$output .= "
		</div>\n";

	return $output;
}
add_filter('post_gallery', 'am_post_gallery', 10, 3);

?>
