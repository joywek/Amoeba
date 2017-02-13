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
					<h2><?php echo amoeba_get_option($options, 'profile', 'name', __('Not Configured')); ?></h2>
					<h6><?php echo amoeba_get_option($options, 'profile', 'status', __('Not Configured')); ?></h6>
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
		<div class="section profile-section">
			<div class="inner">
				<h1 id="intro" class="section-header">
					<span>About Me</span>
				</h1>
				<?php amoeba_markdown(amoeba_get_option($options, 'profile', 'introduction', __('Not Configured'))); ?>
			</div>
		</div>
		<div class="section contact-section">
			<div class="inner">
				<div class="contact-description">
					<h2>CONTACT</h2>
					<p>I'm a paragraph. Click here to add your own text and edit me. I’m a great place for you to tell a story and let your users know a little more about you.</p>
					<p>info@mysite.com<br />Tel: 1-800-000-0000</p>
				</div>
				<div class="contact-form">
					<input type="text" name="name" class="name" placeholder="Name" />
					<input type="text" name="email" class="email" placeholder="Email" />
					<input type="text" name="subject" class="subject" placeholder="Subject" />
					<textarea name="message" class="message" placeholder="Message"></textarea>
					<button id="send" class="send">Send</button>
				</div>
			</div>
		</div>
		<div class="section experience-section">
			<h1 class="section-header">EXPERIENCE</h1>
			<div class="timeline">
			</div>
			<div class="experience-item left">
				<div class="dot"></div>
				<span class="date">2014-2016</span>
				<h4 class="company">HOP!</h4>
				<h6 class="title">Creative Design Lead</h6>
				<p>I'm a paragraph. Click here to add your own text and edit me. It’s easy. Just click “Edit Text” or double click me to add your own content and make changes to the font.</p>
			</div>
			<div class="experience-item right">
				<div class="dot"></div>
				<span class="date">2014-2016</span>
				<h4 class="company">HOP!</h4>
				<h6 class="title">Creative Design Lead</h6>
				<p>I'm a paragraph. Click here to add your own text and edit me. It’s easy. Just click “Edit Text” or double click me to add your own content and make changes to the font.</p>
			</div>
			<div class="experience-item left">
				<div class="dot"></div>
				<span class="date">2014-2016</span>
				<h4 class="company">HOP!</h4>
				<h6 class="title">Creative Design Lead</h6>
				<p>I'm a paragraph. Click here to add your own text and edit me. It’s easy. Just click “Edit Text” or double click me to add your own content and make changes to the font.</p>
			</div>
		</div>
		<div class="section profile-section" style="background:#ccc">
			<div class="inner">
				<h1 id="intro" class="section-header">
					<span>About Me</span>
				</h1>
				<?php amoeba_markdown(amoeba_get_option($options, 'profile', 'introduction', __('Not Configured'))); ?>
			</div>
		</div>
	</div>
</div>

<?php get_footer(); ?>

