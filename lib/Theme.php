<?php

namespace ThemeLib;

class Theme
{
	private $pages;

	public function __construct(string $dir, string $url)
	{
		!defined('DS') ? define('DS', DIRECTORY_SEPARATOR) : null;
		!defined('THEME_DIR') ? define('THEME_DIR', $dir) : null;
		!defined('THEME_URL') ? define('THEME_URL', $url) : null;
		!defined('THEME_VERSION') ? define('THEME_VERSION', '0.1.0') : null;

		ACF::init();
		WPackio::enqueue_assets();

		$this->pages = [];

		add_action('init', function () {
			register_nav_menus([
				'primary' => 'Main'
			]);

			if (isset($_GET['activated']) && is_admin())
				$this->handle_activation();
		});
	}

	function register_page(Page $page)
	{
		$this->pages[$page->name] = $page;
	}

	function handle_activation()
	{
		foreach ($this->pages as $page) $page->handle_activation();
	}

	public static function print(string $msg)
	{
		add_action('admin_notices', function () use ($msg) {
?>
			<div class="notice is-dismissible">
				<p><?= $msg ?></p>
			</div>
<?php
		});
	}
}
