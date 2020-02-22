<?php

namespace ThemeLib;

class OptionsPage
{
	static function register(string $name, string $title, array $fields)
	{
		Theme::sanitize_field_props($fields);

		acf_add_options_page([
			'page_title' 	=> $title,
			'menu_title'	=> $title,
			'menu_slug' 	=> $name,
			'capability'	=> 'edit_posts',
			'redirect'		=> false
		]);

		acf_add_local_field_group([
			'key' => $name,
			'title' => __('Settings'),
			'fields' => $fields,
			'location' => [[[
				'param' => 'options_page',
				'operator' => '==',
				'value' => $name
			]]]
		]);
	}
}
