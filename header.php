<!DOCTYPE html>

<html <?php language_attributes(); ?>>

<head>

	<meta charset="<?php bloginfo('charset'); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">

	<link href="https://fonts.googleapis.com/css?family=Roboto:400,700&display=swap" rel="stylesheet">

	<?php wp_head(); ?>

</head>

<body <?php body_class(); ?>>

	<?php
	wp_body_open();
	?>

	<header class="header__wrapper">
		<div class="header__logo">
			<a href="<?= esc_url(get_home_url(null, '/')) ?>">
				<?= esc_html(get_bloginfo('name')) ?>
			</a>
		</div>
		<div class="header__nav">
			<button class="header__nav__button">Menu</button>
			<?php
			wp_nav_menu([
				'container' => '',
				'theme_location' => 'primary',
			]);
			?>
		</div>
	</header>

	<div class="main__wrapper">