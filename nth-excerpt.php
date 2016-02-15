<article>
	<?php nth_get_post_title(); ?>
	<?php locate_template('nth-byline.php', true, false) ?>	
	<?php nth_get_featured_image(); ?>	
	
	
	<?php the_excerpt() ?>
</article>	