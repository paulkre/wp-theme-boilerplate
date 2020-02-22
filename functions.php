<?php

require_once get_template_directory() . DIRECTORY_SEPARATOR . 'vendor' . DIRECTORY_SEPARATOR . 'autoload.php';

\ThemeLib\Theme::get_instance()->register_page(
	new \ThemeLib\Page(
		'home',
		'Home',
		[
			[
				'name' => 'welcome_message',
				'key' => 'welcome_message',
				'type' => 'text',
				'label' => 'Welcome Message'
			]
		]
	)
);

add_action('admin_menu', function () {
	// remove_menu_page('index.php'); //Dashboard
	// remove_menu_page('upload.php'); //Media
	// remove_menu_page('options-general.php'); //Settings
	// remove_menu_page('users.php'); //Users
	// remove_menu_page('plugins.php'); //Plugins
	remove_menu_page('edit.php'); //Posts
	// remove_menu_page('edit.php?post_type=page'); //Pages
	remove_menu_page('edit-comments.php'); //Comments
	// remove_menu_page('themes.php'); //Appearance
	remove_menu_page('tools.php'); //Tools
});

add_action('admin_init', function () {
	remove_meta_box('dashboard_incoming_links', 'dashboard', 'normal');
	remove_meta_box('dashboard_plugins', 'dashboard', 'normal');
	remove_meta_box('dashboard_primary', 'dashboard', 'normal');
	remove_meta_box('dashboard_secondary', 'dashboard', 'normal');
	remove_meta_box('dashboard_quick_press', 'dashboard', 'side');
	remove_meta_box('dashboard_recent_drafts', 'dashboard', 'side');
	remove_meta_box('dashboard_recent_comments', 'dashboard', 'normal');
	remove_meta_box('dashboard_right_now', 'dashboard', 'normal');
	remove_meta_box('dashboard_activity', 'dashboard', 'normal');
});

add_action('admin_bar_menu', function ($admin_bar) {
	// $admin_bar->remove_node('site-name');
	$admin_bar->remove_node('new-post');
	$admin_bar->remove_node('wp-logo');
	$admin_bar->remove_node('comments');
	// $admin_bar->remove_node('new-page');
}, 999);

add_action('admin_init', function () {
	add_editor_style('style-editor.css');
});

add_theme_support('align-wide');
add_theme_support('editor-styles');
add_theme_support('title-tag');
