<div class="sidebar col-sm-3 col-md-2 col-lg-3"> <!-- sidebar column -->
	
	<?php if (is_active_sidebar('blog-sidebar')) : ?>
		<?php dynamic_sidebar('blog-sidebar'); ?>
	<?php endif ?>
	
</div> <!-- sidebar column -->

<?php get_footer(); ?>