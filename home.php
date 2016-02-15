<?php get_header() ?>

<div class="col-md-10 excerpts"> <!-- article column -->
	<?php while ( have_posts()) : the_post(); ?>
		<article>
			<a href="<?php the_permalink() ?>" title="<?php the_title() ?>">
				<h2><?php the_title() ?></h2>
				<p class="post-date"><time datetime="<?php echo get_the_date( 'Y-m-d' ); ?>"><?php echo get_the_date( 'D, M j Y' ); ?></time></p>
				<?php the_post_thumbnail('blog-thumb'); ?>
			</a>
			<?php the_excerpt() ?>
		</article>		
	<?php endwhile ?>
	
	<nav class="article-nav text-center">
		<ul>
			<li><?php posts_nav_link('', '<< Newer posts', 'Older posts >>') ?></li>
			<?php nth_get_the_archives_link() ?>
		</ul>

	</nav>
</div> <!-- article column -->
	
<?php get_sidebar() ?>