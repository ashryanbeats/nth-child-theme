<?php get_header() ?>

<div class="col-md-10 excerpts"> <!-- article column -->
	<?php while ( have_posts()) : the_post(); ?>
		<article>
			<a href="<?php the_permalink() ?>" alt="<?php the_title() ?>">
				<h2><?php the_title() ?></h2>
				<?php the_post_thumbnail('blog-thumb'); ?>
			</a>
			<?php the_excerpt() ?>

			<!-- <?php locate_template('post-category.php', true, false) ?> -->
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