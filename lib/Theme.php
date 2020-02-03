<?php

namespace ThemeLib;

class Theme
{
	public function __construct(string $dir, string $url)
	{
		!defined('DS') ? define('DS', DIRECTORY_SEPARATOR) : null;
		!defined('THEME_DIR') ? define('THEME_DIR', $dir) : null;
		!defined('THEME_URL') ? define('THEME_URL', $url) : null;
		!defined('THEME_VERSION') ? define('THEME_VERSION', '0.1.0') : null;

		new ACF();
		new WPackio();

		add_action('init', function () {
			register_nav_menus([
				'primary' => 'Main'
			]);
		});
	}
}
