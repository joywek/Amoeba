<?php
/**
 * Custom template tags for this theme.
 *
 * Eventually, some of the functionality here could be replaced by core features.
 *
 * @package Amoeba
 */

if (! function_exists('amoeba_entry_meta')) :
/**
 * Prints HTML with meta information for the current post-date/time and author.
 */
function amoeba_entry_meta() {
	$meta_item_string ='<span class="%1$s"><i class="%2$s"></i>%3$s</span>';

	$date = get_the_date();
	//$date_string = '<a href="%1$s" rel="bookmark"><time class="entry-date">%2$s</time></a>';
	$date_string = '<time class="entry-date">%1$s</time>';
	$date_string = sprintf($date_string, esc_html($date));
	$meta_date = sprintf($meta_item_string, 'date', 'fa fa-calendar', $date_string);
	echo $meta_date;

	$meta_categories = sprintf($meta_item_string, 'categories', 'fa fa-folder-o', get_the_category_list(esc_html__(', ', 'amoeba')));
	echo $meta_categories;
}
endif;

if (!function_exists('amoeba_read_more_button')) :
/**
 * Prints HTML with "Read More ..." button.
 */
function amoeba_read_more_button() {
?>
	<div class="read_more clearfix">
		<a class="button">Read More ...</a>
	</div>
<?php	
}
endif;

if (!function_exists('amoeba_social_bar')) :
function amoeba_social_bar() {
?>
	<ul id="social-bar" class="social-bar">
		<li><a href=""><i class="fa fa-twitter"></i></a></li>
		<li><a href=""><i class="fa fa-facebook"></i></a></li>
		<li><a href=""><i class="fa fa-linkedin"></i></a></li>
		<li><a href=""><i class="fa fa-instagram"></i></a></li>
		<li><a href=""><i class="fa fa-dribbble"></i></a></li>
		<li><a href=""><i class="fa fa-envelope"></i></a></li>
	</ul>
<?php
}
endif;
