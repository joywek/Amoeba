<?php

/**
 * The template for displaying 404 pages (Not Found)
 *
 * @package Amoeba
 */

get_header(); ?>

<div id="site-body">
	<div class="inner">
		<div id="main">
			<h1 class="page-title">404</h1>
			<div class="content">
				<h2 class="content-title">Something’s wrong.</h2>
				<p>Remember those old 404 pages from the 90s that said something like “Something’s gone wrong, but don’t worry, our webmasters have been notified.” But were the webmasters ever notified? I mean, were they really?</p>
				<a href="<?php echo get_home_url(); ?>" class="goto-home">Go Home</a>
			</div>
		</div>
		<div class="image">
			<img src="http://7xnua6.com1.z0.glb.clouddn.com/2017/02/cat.jpg" />
		</div>
	</div>
</div>

<?php get_footer(); ?>
