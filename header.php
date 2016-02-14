<!DOCTYPE html>
<html <?php language_attributes() ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>" />
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="pingback" href="<?php bloginfo('pingback_url') ?>"/>
	<title><?php wp_title(); ?></title>

	<?php wp_head() ?>
</head>

<body <?php body_class() ?>>
	<div class="container-fluid"> <!-- site container -->
		<div class="container navbar-container"> <!-- navbar container -->
			<nav class="navbar">
				<div class="navbar-header">
					<h1 class="navbar-brand"><a href="<?php echo home_url() ?>" alt="<?php bloginfo('name') ?>"><?php bloginfo('name') ?></a></h1>
				</div>

				<?php nth_get_menu(); ?>	
			</nav>
		</div> <!-- navbar container -->

		<div class="container content-container"> <!-- content container -->
			<div class="row"> <!-- content row -->