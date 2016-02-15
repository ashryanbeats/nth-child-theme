<article>
	<a href="<?php the_permalink() ?>" title="<?php the_title() ?>">
		<h2><?php the_title() ?></h2>
		<p class="post-date"><time datetime="<?php echo get_the_date( 'Y-m-d' ); ?>"><?php echo get_the_date( 'D, M j Y' ); ?></time></p>
		<?php the_post_thumbnail('blog-thumb'); ?>
	</a>
	<?php the_excerpt() ?>
</article>	