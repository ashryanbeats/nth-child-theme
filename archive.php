<?php get_header(); ?>

<div class="col-sm-9 col-md-10 col-lg-9 single"> <!-- archive column -->
	
	<h1>This is the archive for 
		<?php if (is_category()) : ?>
			the category "<?php single_cat_title() ?>".
		<?php elseif (is_tag()) : ?>
			posts tagged with "<?php single_tag_title() ?>".
		<?php elseif (is_day()) : ?>	
			<?php echo get_the_date() ?>.
		<?php elseif (is_month()) : ?>
			<?php echo get_the_date('F Y') ?>.
		<?php elseif (is_year()) : ?>
			<?php echo get_the_date('Y') ?>.
		<?php else : ?>
			your selection.
		<?php endif ?>
	</h1>

	<?php while ( have_posts()) : the_post(); ?>
		<?php locate_template('nth-excerpt.php', true, false) ?>
	<?php endwhile ?>

	<?php locate_template('nth-article-nav.php', true, false) ?>

</div> <!-- archive column -->

<?php get_sidebar(); ?>