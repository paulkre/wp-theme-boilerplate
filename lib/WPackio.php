<?php

namespace ThemeLib;

class WPackio
{
	function __construct()
	{
		$enqueue = new \WPackio\Enqueue('theme', 'dist', THEME_VERSION, 'theme');
		add_action('wp_enqueue_scripts', function () use ($enqueue) {
			$enqueue->enqueue('app', 'main', []);
		});
	}
}
