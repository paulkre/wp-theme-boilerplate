<?php

namespace ThemeLib;

class ACF
{
	static function init()
	{
		require_once THEME_DIR . 'vendor' . DS . 'advanced-custom-fields-pro' . DS . 'acf.php';

		add_filter('acf/settings/show_admin', '__return_false');
		add_filter('acf/settings/url', function () {
			return THEME_URL . 'vendor/advanced-custom-fields-pro/';
		});
	}
}
