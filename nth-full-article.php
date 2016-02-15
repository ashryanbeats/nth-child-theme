<article>
	<?php nth_get_post_title(); ?>
	<?php if(is_single()) : ?>
		<?php locate_template('nth-byline.php', true, false) ?>
	<?php endif; ?>
	<?php nth_get_featured_image(); ?>
	
	<?php the_content() ?>
</article>