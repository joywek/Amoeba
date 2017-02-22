<!DOCTYPE html>

<?php
	global $script;
?>

<html <?php language_attributes(); ?>>
	<head>
		<meta charset="<?php bloginfo('charset'); ?>" />
		<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
		<?php wp_head(); ?>
		<?php echo $script; ?>
	</head>

	<body <?php body_class(); ?>>
		<div id="container">
			<header id="site-header">
				<div class="inner">
					<div class="navbar">
						<a class="site-logo" href="/">
							<span><?php bloginfo('name'); ?></span>
						</a>
						<a id="nav-menu-toggle" class="nav-menu-toggle"></a>
					</div>
					<?php wp_nav_menu(array(
						'theme_location' => 'primary',
						'container' => '', 
						'menu_id' => 'nav-menu',
						'menu_class' => 'nav-menu'));
					?>
				</div>
			</header>
