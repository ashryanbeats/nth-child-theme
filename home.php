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

	<article>
		<h2><a href="#" alt="Title">Title</a></h2>
		<img class="img-responsive" src="http://i0.wp.com/ashryanbeats.com/wp-content/uploads/2016/01/image.jpeg?resize=1000%2C200">
		<p>Lorem ipsum Elit minim adipisicing esse sit irure proident fugiat Duis aliqua sint est.</p>
		<p><a href="#" alt="">Read more ></a></p>
	</article>



	<article>
		<h2><a href="#" alt="Title">Title</a></h2>
		<img class="img-responsive" src="http://i0.wp.com/ashryanbeats.com/wp-content/uploads/2016/01/image.jpeg?resize=1000%2C200">
		<p>Lorem ipsum Elit minim adipisicing esse sit irure proident fugiat Duis aliqua sint est.</p>
		<p><a href="#" alt="">Read more ></a></p>
	</article>
	
	<nav class="article-nav text-center">
		<ul>
			<li><a href="#" alt="">Older posts >></a></li>
			<li><a href="#" alt="">Browser the archives</a></li>
		</ul>
	</nav>
</div> <!-- article column -->
	
<?php get_sidebar() ?>