<?php

namespace ThemeLib;

class Page
{
	public $name;
	public $title;

	public function __construct(string $name, string $title, array $fields = null)
	{
		$this->name = $name;
		$this->title = $title;

		if (!empty($fields))
			acf_add_local_field_group([
				'key' => $name . '_group',
				'title' => $title . ' ' . __('Settings'),
				'fields' => $fields,
				'location' => [[[
					'param' => 'post_name',
					'operator' => '==',
					'value' => $name
				]]]
			]);
	}

	public function handle_activation()
	{
		if (
			!empty(get_posts([
				'name' => $this->name,
				'post_type' => 'page'
			]))
		) return;

		wp_insert_post([
			'post_name' => $this->name,
			'post_title' => $this->title,
			'post_type' => 'page',
			'post_status' => 'publish'
		]);
	}
}
