<?php

namespace ThemeLib;

class Theme
{
	private static $instance = null;

	private $pages;

	static function get_instance()
	{
		if (self::$instance == null) $instance = new Theme();
		return $instance;
	}

	private function __construct()
	{
		!defined('DS') ? define('DS', DIRECTORY_SEPARATOR) : null;
		!defined('THEME_DIR') ? define('THEME_DIR', get_template_directory() . DS) : null;
		!defined('THEME_URL') ? define('THEME_URL', get_template_directory_uri() . '/') : null;
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

		add_filter('login_head', function () { ?>
			<style type="text/css">
				#login>h1 {
					display: none;
				}
			</style>
		<?php });
	}

	function register_page(Page $page)
	{
		$this->pages[$page->name] = $page;
	}

	function handle_activation()
	{
		foreach ($this->pages as $page) $page->handle_activation();
	}



	static function print(string $msg, int $code = -1)
	{
		add_action('admin_notices', function () use ($msg, $code) { ?>
			<div class="notice is-dismissible<?= $code < 0 ? '' : $code > 0 ? ' notice-error' : ' notice-success' ?>">
				<p><?= $msg ?></p>
			</div>
<?php });
	}
}
