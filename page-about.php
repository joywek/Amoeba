<?php
/**
 * Template Name: About
 *
 * The template for displaying about page.
 *
 * @package Amoeba
 */

get_header(); ?>

<?php $options = get_option('amoeba_option_about'); ?>

<div id="site-body">
	<div class="sidebar">
		<div class="widget-area">
			<aside class="widget widget-profile">
				<div class="avatar"></div>
				<div class="title">
					<h2><?php echo amoeba_get_option($options, 'profile', 'name'); ?></h2>
					<h6><?php echo amoeba_get_option($options, 'profile', 'status'); ?></h6>
				</div>
			</aside>
			<ul class="nav">
				<li class="current">
					<a href="#intro">
						<i class="fa fa-user"></i>
						<div class="text"><?php _e('About Me', 'amoeba') ?></div>
					</a>
				</li>
				<li>
					<a href="#contact">
						<i class="fa fa-envelope"></i>
						<div class="text"><?php _e('Contact', 'amoeba') ?></div>
					</a>
				</li>
				<li>
					<a href="#skills">
						<i class="fa fa-wrench"></i>
						<div class="text"><?php _e('Skills', 'amoeba') ?></div>
					</a>
				</li>
			</ul>
		</div>
		<ul class="social">
			<li><a href="#"><i class="fa fa-facebook"></i></a></li>
			<li><a href="#"><i class="fa fa-twitter"></i></a></li>
			<li><a href="#"><i class="fa fa-linkedin"></i></a></li>
		</ul>
	</div>
	<div class="main">
		<div class="section experience">
			<h4 id="intro" class="section-header">
				<span>About Me</span>
			</h4>
			<p><?php echo amoeba_get_option($options, 'profile', 'introduction'); ?></p>
		</div>
	</div>
</div>

<?php get_footer(); ?>

