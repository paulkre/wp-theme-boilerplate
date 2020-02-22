<?php

namespace ThemeLib;

class Page
{
	static function register(string $name, string $title, array $fields)
	{
		Theme::sanitize_field_props($fields);

		if (!empty($fields))
			acf_add_local_field_group([
				'key' => $name,
				'title' => $title . ' ' . __('Settings'),
				'fields' => $fields,
				'location' => [[[
					'param' => 'post_name',
					'operator' => '==',
					'value' => $name
				]]]
			]);

		add_action('init', function () use ($name, $title) {
			if (isset($_GET['activated']) && is_admin())
				self::handle_activation($name, $title);
		});
	}

	private static function handle_activation(string $name, string $title)
	{
		if (
			!empty(get_posts([
				'name' => $name,
				'post_type' => 'page'
			]))
		) return;

		$id = wp_insert_post([
			'post_name' => $name,
			'post_title' => $title,
			'post_type' => 'page',
			'post_status' => 'publish'
		]);

		Theme::print(
			__('Page') . ' "' . $title . '" ' . __('created') . '. '
				. '<a href="/wp-admin/post.php?post=' . $id . '&action=edit">' . __('Edit') . '</a>',
			0
		);
	}
}
