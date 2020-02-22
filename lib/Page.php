<?php

namespace ThemeLib;

class Page
{
	public $name;
	public $title;

	public function __construct(string $name, string $title)
	{
		$this->name = $name;
		$this->title = $title;
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
