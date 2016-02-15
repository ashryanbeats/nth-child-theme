<article>
	<a href="<?php the_permalink() ?>" title="<?php the_title() ?>">
		<?php locate_template('nth-title-byline.php', true, false) ?>
		<?php nth_get_featured_image(); ?>
	</a>

	<?php the_content() ?>
</article>