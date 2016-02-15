<article>
	<h2><a href="<?php the_permalink() ?>" title="<?php the_title() ?>">
		<?php the_title() ?>
	</a></h2>
	<?php locate_template('nth-title-byline.php', true, false) ?>	
	<?php nth_get_featured_image(); ?>	
	
	
	<?php the_excerpt() ?>
</article>	