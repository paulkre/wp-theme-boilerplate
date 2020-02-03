<?php get_header(); ?>

<?php if (is_home()) : ?>
	<h1>Willkommen!</h1>
<?php endif; ?>

<?php get_template_part('partials/content') ?>

<?php get_footer(); ?>