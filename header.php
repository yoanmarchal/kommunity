<?php 

/** 

 * @HTLM5-boilerplate-ajax template for wordpress

 * 

 */ 

?>

<!doctype html>

<!--[if lt IE 7 ]> <html lang="en" class="no-js ie6"> <![endif]-->

<!--[if IE 7 ]>    <html lang="en" class="no-js ie7"> <![endif]-->

<!--[if IE 8 ]>    <html lang="en" class="no-js ie8"> <![endif]-->

<!--[if IE 9 ]>    <html lang="en" class="no-js ie9"> <![endif]-->

<!--[if (gt IE 9)|!(IE)]><!--> <html <?php language_attributes(); ?> class="no-js"> <!--<![endif]-->

<head>

	<meta charset="utf-8">

	<title><?php wp_title(''); ?></title>

	<?php

	$site_background = of_get_option('site_background', 'tranparent');

	$header_background = of_get_option('header_background', '#ffffff');

	$header_nav_color = of_get_option('header_nav_color', '#fff');

	$header_nav_connected_background = of_get_option('header_nav_connected_background', '#222226');

	$header_nav_connected_color_text = of_get_option('header_nav_connected_color_text', '#fff');

	$content_text_color = of_get_option('textes_colorpicker', '#fff');

	$content_link_color = of_get_option('link_colorpicker');

	?>

	<style>

		body {background: <?php  echo $site_background; ?>;}

		.menu-item a {color: <?php echo $header_nav_color; ?>;}

		#administration-bar {background-color: <?php echo $header_nav_connected_background; ?>;}

		#administration-bar .btn {color: <?php  /* echo $header_nav_connected_color_text; */ ?>;}

		

		.primary-color-background {background-color: #232323;}

		/*

		#content { color:  <?php echo $content_text_color; ?>; }

		*/

		#content a, a{ color:  <?php echo $content_link_color; ?>; }

		.share-box{color:  <?php echo $content_link_color; ?>;}

	</style>

	

	<!-- CSS : implied media="all" -->

	<link rel="stylesheet" href="<?php bloginfo('template_directory'); ?>/style.css">

	<!--  Mobile viewport optimized: -->

	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">



	<!-- Place favicon.ico & apple-touch-icon.png in the root of your domain and delete these references -->



	<link rel="apple-touch-icon" href="<?php bloginfo('template_directory'); ?>/assets/images/apple-touch-icon-iphone.png" /> 

	<link rel="apple-touch-icon" sizes="72x72" href="<?php bloginfo('template_directory'); ?>/assets/images/apple-touch-icon-ipad.png" /> 

	<link rel="apple-touch-icon" sizes="114x114" href="<?php bloginfo('template_directory'); ?>/assets/images/apple-touch-icon-iphone4.png" />

	<link rel="apple-touch-icon" sizes="144x144" href="<?php bloginfo('template_directory'); ?>/assets/images/apple-touch-icon-ipad3.png" />





	<link rel="shortcut icon" href="<?php bloginfo('template_directory'); ?>/assets/images/favicon.ico" type="image/x-icon">

	<link rel="icon" href="<?php bloginfo('template_directory'); ?>/assets/images/favicon.ico" type="image/x-icon">





	<!-- All JavaScript at the bottom, except for Modernizr which enables HTML5 elements & feature detects -->

	<script src="<?php bloginfo('template_directory'); ?>/assets/js/vendor/modernizr-transitions.js"></script>



	<meta name="msvalidate.01" content="" />

	<meta name="alexaVerifyID" content="" />

	<meta name="google-site-verification" content="" />
	<link href="//maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css" rel="stylesheet">
	<?php wp_head();?>

</head>

<body <?php body_class(); ?> role="document">

	<header class="primary-color-background" id="header" role="banner">

		<section class="container">

            <div class="navbar-header">

        		<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">

        			<span class="sr-only">Toggle navigation</span>

                  	<span class="icon-bar"></span>

                  	<span class="icon-bar"></span>

                  	<span class="icon-bar"></span>

            	</button>



				<a class="logo tooltips-b navbar-brand" title="Retour à la page d'acceuil" href="<?php echo home_url(); ?>" rel="home">

				<?php if ( of_get_option('logo_custom') ) { ?>

					<img src="<?php echo of_get_option('logo_custom'); ?>" class="logo"/>

				<?php } else { ?>

					<img src="<?php bloginfo('template_directory'); ?>/assets/images/kommunity-logo.gif" alt="logo"  class="logo">

				<?php } ?>

				</a>

	        </div>

	        <nav class="navbar-collapse  collapse" role="navigation">

        		<?php wp_nav_menu( 

        		array(

        			'menu' => '',

        		 	'container' => false, 

        		 	'container_class' => false, 

        		 	'container_id' => false, 

        		 	'menu_class' => 'nav navbar-nav',

        		 	 //Process nav menu using our custom nav walker

  					'walker' => new wp_bootstrap_navwalker()

        		 	)); ?>

    		</nav>



			<form id="search-box" name="searchform" method="get" action="<?php bloginfo("url"); ?>" class="navbar-form navbar-left pull-right hidden-xs" role="search">

				<div class="form-group">

					<input type="text" name="s" id="s" title="Recherchez" placeholder="Rechercher" class="form-control">

				</div>

				<div class="form-group">

					<button type="submit" class="btn  btn-primary">

						<span class="glyphicon glyphicon-search icon-white"></span>

					</button>

				</div>

			</form>

		</section>

	</header>

	<section id="main" role="main">

		<div class="container">

			<div class="row">

				<nav class="btn-toolbar add-top col-md-12" role="navigation">

				  <!-- Collect the nav links, forms, and other content for toggling -->

				    <div class="btn-group btn-group-lg ">

				    	<?php
						$current_user = wp_get_current_user();
						if ( is_user_logged_in() ) { 
						//logged in
						?>						
						<a class="btn  btn-primary" href="<?php echo get_author_posts_url($current_user->ID); ?>" title="Voir mon profil" data-placement="bottom">
							<i class="fa fa-user"></i>
							<?php echo $current_user->user_login ;	?>
						</a>

						<a class="btn  btn-primary" href="<?php echo home_url(); ?>/mes-bons-plans" data-toggle="tooltip" title="Voir mes bons plans" data-placement="bottom">
							<i class="fa fa-tag"></i>
						</a>

						<a class="btn btn-primary" href="<?php echo home_url(); ?>/mes-videos" title="Voir mes vidéos" data-placement="bottom">
							<i class="fa fa-video-camera"></i>
						</a>

						<a class="btn  btn-primary" href="<?php echo home_url(); ?>/mes-photos" title="Voir mes photos" data-placement="bottom">
							<i class="fa fa-camera-retro"></i>
						</a>

						<a class="btn  btn-primary" href="<?php echo home_url(); ?>/profil" title="" data-placement="bottom">
							<i class="fa fa-sliders"></i>
						</a>

						<a class="btn  btn-primary" href="<?php echo home_url() ?>/logout" title="Se déconnecter" data-placement="bottom">
							<i class="fa fa-toggle-off"></i>
						</a>

					<?php

					} else {

					//Not logged in

					?>

						<a class="btn  btn-primary" href="<?php echo home_url();  ?>/login" title="Login">Connexion</a>

					

						<a class="btn  btn-primary" href="<?php echo home_url();  ?>/register" title="Login">Créer un compte</a>
					<?php

					}

					?>
				    </div>

				</nav>