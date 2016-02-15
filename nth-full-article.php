<article>
	<a href="<?php the_permalink() ?>" title="<?php the_title() ?>">
		<?php locate_template('nth-title-byline.php', true, false) ?>
		<?php the_post_thumbnail(); ?>
		<?php get_featured_image_caption() ?>
	</a>

	<?php the_content() ?>
</article>