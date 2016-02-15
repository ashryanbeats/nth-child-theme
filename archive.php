<?php get_header(); ?>

<div class="col-sm-9 col-md-10 col-lg-9 single"> <!-- archive column -->
	
	<h1>This is the archive for 
		<?php if (is_category()) : ?>
			the category "<?php single_cat_title() ?>".
		<?php elseif (is_tag()) : ?>
			posts tagged with "<?php single_tag_title() ?>".
		<?php elseif (is_day()) : ?>	
			posts published on <?php echo get_the_date() ?>.
		<?php elseif (is_month()) : ?>
			posts published in <?php echo get_the_date('F Y') ?>.
		<?php elseif (is_year()) : ?>
			posts published in <?php echo get_the_date('Y') ?>.
		<?php else : ?>
			your selection.
		<?php endif ?>
	</h1>

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
</div> <!-- archive column -->

<?php get_sidebar(); ?>