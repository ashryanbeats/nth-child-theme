<?php get_header() ?>

<div class="col-md-10 "> <!-- article column -->
	<?php while ( have_posts()) : the_post(); ?>

		<article>
			<h1><a href="<?php the_permalink() ?>"><?php the_title() ?></a></h1>
			<?php the_post_thumbnail(); ?>

			<!-- Show the feature image caption -->
			<?php get_featured_image_caption() ?>
			<?php the_content() ?>
		</article>

	<?php endwhile; ?>
</div> <!-- article column -->
	
<?php get_sidebar() ?>