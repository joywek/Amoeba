<?php

class OptionsBasePage {

	public $page_title;
	public $menu_title;
	public $menu_slug;
	protected $option_key;

	function render_page() {
	?>
		<div class="wrap">
		<h1><?php $this->page_title; ?></h1>
		<form name="form" action="options.php" method="post">
		<?php
				settings_fields($this->option_key);
				do_settings_sections($this->menu_slug);
				submit_button();
		?>
		</form>
	<?php
	}
}

?>
