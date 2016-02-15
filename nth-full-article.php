<article>
	<?php locate_template('nth-title-byline.php', true, false) ?>
	<?php the_post_thumbnail(); ?>

	<!-- Show the feature image caption -->
	<?php get_featured_image_caption() ?>
	<?php the_content() ?>
</article>