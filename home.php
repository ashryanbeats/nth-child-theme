<?php get_header() ?>

<div class="col-sm-9 col-md-10 col-lg-9 excerpts"> <!-- article column -->
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

	<?php locate_template('nth-article-nav.php', true, false) ?>	

</div> <!-- article column -->
	
<?php get_sidebar() ?>