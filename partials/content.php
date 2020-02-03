<?php
the_post();

if (is_singular()) {
	the_title('<h1>', '</h1>');
	the_content();

	$children = new WP_Query([
		'post_parent' => get_the_ID(),
		'post_type' => 'page',
		'order' => 'ASC',
		'orderby' => 'menu_order'
		// 'posts_per_page' => -1
	]);

	if ($children->have_posts()) : ?>
		<ul>
			<?php while ($children->have_posts()) : $children->the_post(); ?>
				<li>
					<a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>">
						<?php the_title(); ?>
					</a>
				</li>
			<?php endwhile; ?>
		</ul>
<?php endif;
} else while (have_posts()) {
	the_title('<h2>', '</h2>');
	the_excerpt();
}
