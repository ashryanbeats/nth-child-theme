<?php get_header() ?>

<div class="col-sm-9 col-md-10 col-lg-9 single full-width-featured-images"> <!-- article column -->
	<?php while ( have_posts()) : the_post(); ?>

		<?php locate_template('nth-full-article.php', true, false) ?>

	<?php endwhile; ?>
</div> <!-- article column -->
	
<?php get_sidebar() ?>