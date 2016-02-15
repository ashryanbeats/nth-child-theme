<?php get_header() ?>

<div class="col-sm-9 col-md-10 col-lg-9 search full-width-featured-images"> <!-- article column -->

	<?php while ( have_posts()) : the_post(); ?>
		<?php locate_template('nth-excerpt.php', true, false) ?>
	<?php endwhile ?>

	<?php locate_template('nth-article-nav.php', true, false) ?>	

</div> <!-- article column -->
	
<?php get_footer() ?>