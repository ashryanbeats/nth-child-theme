<article>
	<?php nth_get_post_title(); ?>
	<?php if(is_single()) : ?>
		<?php locate_template('nth-byline.php', true, false) ?>
	<?php endif; ?>
	<a href="<?php the_permalink()?>" title="<?php the_title() ?>"><?php nth_get_featured_image(); ?></a>
	
	<?php the_content() ?>
</article>