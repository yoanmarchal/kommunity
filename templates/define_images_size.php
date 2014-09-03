<?php 

/* ajoute le support thumbnails  */
add_theme_support( 'post-thumbnails' );
/* definie la taille standart des thumbnails  */
set_post_thumbnail_size( 247, 154, true );

if ( function_exists( 'add_image_size' ) ) {
	add_image_size( 'thumb', 247, 154, true); ////   tumb partout
	add_image_size( 'full', 1140, 9999 ); ///full size  for slider
	add_image_size( 'single-page', 844, 9999, true ); ///full size for pages
}