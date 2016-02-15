<article>
	<?php nth_get_post_title(); ?>
	<?php locate_template('nth-title-byline.php', true, false) ?>
	<?php nth_get_featured_image(); ?>
	
	<?php the_content() ?>
</article>