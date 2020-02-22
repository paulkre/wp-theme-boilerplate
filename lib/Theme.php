<?php

namespace ThemeLib;

class Theme
{
	static function init()
	{
		!defined('DS') ? define('DS', DIRECTORY_SEPARATOR) : null;
		!defined('THEME_DIR') ? define('THEME_DIR', get_template_directory() . DS) : null;
		!defined('THEME_URL') ? define('THEME_URL', get_template_directory_uri() . '/') : null;
		!defined('THEME_VERSION') ? define('THEME_VERSION', '0.1.0') : null;

		self::init_acf();
		self::init_wpackio();

		add_action('init', function () {
			register_nav_menus(['primary' => 'Main']);
		});

		add_filter('login_head', function () { ?>
			<style type="text/css">
				#login>h1 {
					display: none;
				}
			</style>
		<?php });
	}

	private static function init_acf()
	{
		require_once THEME_DIR . 'vendor' . DS . 'advanced-custom-fields-pro' . DS . 'acf.php';

		add_filter('acf/settings/show_admin', '__return_false');
		add_filter('acf/settings/url', function () {
			return THEME_URL . 'vendor/advanced-custom-fields-pro/';
		});

		add_filter('acf/location/rule_match/post_name', function ($match, $rule) {
			$post = get_post();
			if (empty($post)) return $match;
			return $post->post_name == $rule['value'];
		}, 10, 2);
	}

	private static function init_wpackio()
	{
		$enqueue = new \WPackio\Enqueue('theme', 'dist', THEME_VERSION, 'theme');
		add_action('wp_enqueue_scripts', function () use ($enqueue) {
			$enqueue->enqueue('app', 'main', []);
		});
	}

	static function sanitize_field_props(array &$fields)
	{
		foreach ($fields as &$field) $field['key'] = $field['name'];
	}

	static function print($msg, int $code = -1)
	{
		if (is_array($msg)) $msg = var_export($msg, true);
		$style = $code < 0 ? '' : $code == 0 ? 'notice-success' : 'notice-error';
		add_action('admin_notices', function () use ($msg, $style) { ?>
			<div class="notice is-dismissible <?= $style ?>">
				<p><?= $msg ?></p>
			</div>
<?php });
	}
}
