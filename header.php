<!DOCTYPE html>
<html <?php language_attributes() ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>" />
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="pingback" href="<?php bloginfo('pingback_url') ?>"/>
	<title><?php wp_title(); ?></title>

<!-- 	<link rel="stylesheet" href="/bower_components/bootstrap/dist/css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" media="all" href="<?php bloginfo( 'stylesheet_url' ); ?>" />

	<script src="/bower_components/jquery/dist/jquery.min.js"></script>
	<script src="/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
 -->
	<?php wp_head() ?>
</head>

<body <?php body_class() ?>>
	<div class="container-fluid"> <!-- site container -->
		<div class="container navbar-container"> <!-- navbar container -->
			<nav class="navbar">
				<div class="navbar-header">
					<h1 class="navbar-brand"><a href="<?php echo home_url() ?>" alt="<?php bloginfo('name') ?>"><?php bloginfo('name') ?></a></h1>
				</div>
				<ul class="nav navbar-nav">
					<li class="menu-item active"><a href="#" alt="Articles">Articles</a></li>
					<li class="menu-item"><a href="#" alt="Archives">Archives</a></li>
					<li class="menu-item"><a href="#" alt="About">About</a></li>
				</ul>
					
				</div>
			</nav>
		</div> <!-- navbar container -->

		<div class="container content-container"> <!-- content container -->
			<div class="row"> <!-- content row -->