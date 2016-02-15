<article>
	<a href="<?php the_permalink() ?>" title="<?php the_title() ?>">

		<?php locate_template('nth-title-byline.php', true, false) ?>	
		<?php the_post_thumbnail('blog-thumb'); ?>

	</a>
	
	<?php the_excerpt() ?>
</article>	