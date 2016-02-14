<div class="sidebar col-md-2 col-md-offset-0 col-sm-4 col-sm-offset-4 col-xs-6 col-xs-offset-3"> <!-- sidebar column -->
	
	<?php if (is_active_sidebar('blog-sidebar')) : ?>
		<?php dynamic_sidebar('blog-sidebar'); ?>
	<?php endif ?>
	
</div> <!-- sidebar column -->

<?php get_footer(); ?>