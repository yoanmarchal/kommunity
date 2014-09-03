<?php
/**
 * A unique identifier is defined to store the options in the database and reference them from the theme.
 * By default it uses the theme name, in lowercase and without spaces, but this can be changed if needed.
 * If the identifier changes, it'll appear as if the options have been reset.
 *
 */


add_action('optionsframework_after','kommunity_options_after', 100);

function kommunity_options_after() { ?>
    <p>developpement by <a href="http://yoanmarchal.com">yo_0</a></p>
<?php }





/**
 * Returns an array of all files in $directory_path of type $filetype.
 *
 * The $directory_uri + file name is used for the key
 * The file name is the value
 */
 
function options_stylesheets_get_file_list( $directory_path, $filetype, $directory_uri ) {
	$alt_stylesheets = array();
	$alt_stylesheet_files = array();
	if ( is_dir( $directory_path ) ) {
		$alt_stylesheet_files = glob( $directory_path . "*.$filetype");
		foreach ( $alt_stylesheet_files as $file ) {
			$file = str_replace( $directory_path, "", $file);
			$alt_stylesheets[ $directory_uri . $file] = $file;
		}
	}
	return $alt_stylesheets;
}




function optionsframework_option_name() {

	// This gets the theme name from the stylesheet (lowercase and without spaces)
	$themename = get_option( 'stylesheet' );
	$themename = preg_replace("/\W/", "_", strtolower($themename) );

	$optionsframework_settings = get_option('optionsframework');
	$optionsframework_settings['id'] = $themename;
	update_option('optionsframework', $optionsframework_settings);

	// echo $themename;
}

/**
 * Defines an array of options that will be used to generate the settings page and be saved in the database.
 * When creating the 'id' fields, make sure to use all lowercase and no spaces.
 *
 */

function optionsframework_options() {

	// Test data
	$test_array = array(
		'one' => __('One', 'options_check'),
		'two' => __('Two', 'options_check'),
		'three' => __('Three', 'options_check'),
		'four' => __('Four', 'options_check'),
		'five' => __('Five', 'options_check')
	);

	// Multicheck Array
	$multicheck_array = array(
		'one' => __('French Toast', 'options_check'),
		'two' => __('Pancake', 'options_check'),
		'three' => __('Omelette', 'options_check'),
		'four' => __('Crepe', 'options_check'),
		'five' => __('Waffle', 'options_check')
	);

	// Multicheck Defaults
	$multicheck_defaults = array(
		'one' => '1',
		'five' => '1'
	);

	// Background Defaults
	$background_defaults = array(
		'color' => '',
		'image' => '',
		'repeat' => 'repeat',
		'position' => 'top center',
		'attachment'=>'scroll' );

	// Typography Defaults
	$typography_defaults = array(
		'size' => '15px',
		'face' => 'georgia',
		'style' => 'bold',
		'color' => '#bada55' );
		
	// Typography Options
	$typography_options = array(
		'sizes' => array( '6','12','14','16','20' ),
		'faces' => array( 'Helvetica Neue' => 'Helvetica Neue','Arial' => 'Arial' ),
		'styles' => array( 'normal' => 'Normal','bold' => 'Bold' ),
		'color' => false
	);

	// Pull all the categories into an array
	$options_categories = array();
	$options_categories_obj = get_categories();
	foreach ($options_categories_obj as $category) {
		$options_categories[$category->cat_ID] = $category->cat_name;
	}
	
	// Pull all tags into an array
	$options_tags = array();
	$options_tags_obj = get_tags();
	foreach ( $options_tags_obj as $tag ) {
		$options_tags[$tag->term_id] = $tag->name;
	}

	// Pull all the pages into an array
	$options_pages = array();
	$options_pages_obj = get_pages('sort_column=post_parent,menu_order');
	$options_pages[''] = 'Select a page:';
	foreach ($options_pages_obj as $page) {
		$options_pages[$page->ID] = $page->post_title;
	}

	// If using image radio buttons, define a directory path
	$imagepath =  get_template_directory_uri() . '/images/';

	$options = array();


	/* page n1 
	social
	*/
	$options[] = array(
	'name' => __('social', 'options_check'),
	'type' => 'heading');
			
		$options[] = array(
		'name' => __('Url de votre page facebook', 'options_check'),
		'desc' => __('url complete de votre page facebook.', 'options_check'),
		'id' => 'facebook_url',
		'std' => 'Default Value',
		'type' => 'text');

		$options[] = array(
		'name' => __('Url de votre page twitter', 'options_check'),
		'desc' => __('url complete de votre page twitter.', 'options_check'),
		'id' => 'twitter_url',
		'std' => 'Default Value',
		'type' => 'text');

		$options[] = array(
		'name' => __('Url de votre page pinterest', 'options_check'),
		'desc' => __('url complete de votre page pinterest.', 'options_check'),
		'id' => 'pinterest_url',
		'std' => 'Default Value',
		'type' => 'text');

		$options[] = array(
		'name' => __('Url de votre page google plus', 'options_check'),
		'desc' => __('url complete de votre page google plus.', 'options_check'),
		'id' => 'google_plus_url',
		'std' => 'Default Value',
		'type' => 'text');



/* page n1 
	Basic Settings
	*/
	$options[] = array(
		'name' => __('Style', 'options_check'),
		'type' => 'heading');
	// Generated list of stylesheets in the "CSS" directory
	// Use template_directory paths if you're using a parent theme
		
	$alt_stylesheets = options_stylesheets_get_file_list(
		get_stylesheet_directory() . '/css/styles/', // $directory_path
		'css', // $filetype
		get_stylesheet_directory_uri() . '/css/styles/' // $directory_uri
	);

	$options[] = array( "name" => "Automatically Load List of Stylesheets",
		"desc" => 'Choix du style',
		"id" => "auto_stylesheet",
		"type" => "select",
		"options" => $alt_stylesheets );


	


/* changement de page  */
/* Advanced Settings  */
/* logo */
	$options[] = array(
		'name' => __('Header', 'options_check'),
		'type' => 'heading');


	$options[] = array(
	'name' => __('Logo', 'options_check'),
	'desc' => __('Ajoutez votre logo ici 65px * 65px.', 'options_check'),
	'id' => 'logo_custom',
	'type' => 'upload');

	$options[] = array(
		'name' => __('Couleur du background', 'options_check'),
		'desc' => __('Couleurs du background', 'options_check'),
		'id' => 'site_background',
		'std' => '',
		'type' => 'color' );



	$options[] = array(
		'name' => __('Couleur du header', 'options_check'),
		'desc' => __('Couleurs du header background', 'options_check'),
		'id' => 'header_background',
		'std' => '',
		'type' => 'color' );

	$options[] = array(
		'name' => __('Menu', 'options_check'),
		'desc' => __('Couleurs du menu dans le header', 'options_check'),
		'id' => 'header_nav_color',
		'std' => '',
		'type' => 'color' );

	$options[] = array(
		'name' => __('Couleurs du menu connete', 'options_check'),
		'desc' => __('Couleurs du menu connete ', 'options_check'),
		'id' => 'header_nav_connected_background',
		'std' => '',
		'type' => 'color' );

	$options[] = array(
		'name' => __('Couleurs du menu connecte text', 'options_check'),
		'desc' => __('Couleurs du menu connecte text', 'options_check'),
		'id' => 'header_nav_connected_color_text',
		'std' => '',
		'type' => 'color' );





	$options[] = array(
		'name' => __('Couleurs des textes', 'options_check'),
		'desc' => __('Couleurs des textes', 'options_check'),
		'id' => 'textes_colorpicker',
		'std' => '',
		'type' => 'color' );

	

	$options[] = array(
		'name' => __('Couleurs des liens', 'options_check'),
		'desc' => __('Couleurs des liens', 'options_check'),
		'id' => 'link_colorpicker',
		'std' => '',
		'type' => 'color' );



	$options[] = array(
		'name' =>  __('Example Background', 'options_check'),
		'desc' => __('Change the background CSS.', 'options_check'),
		'id' => 'example_background',
		'std' => $background_defaults,
		'type' => 'background' );

	$options[] = array(
		'name' => __('Multicheck', 'options_check'),
		'desc' => __('Multicheck description.', 'options_check'),
		'id' => 'example_multicheck',
		'std' => $multicheck_defaults, // These items get checked by default
		'type' => 'multicheck',
		'options' => $multicheck_array);


		
	$options[] = array( 'name' => __('Typography', 'options_check'),
		'desc' => __('Example typography.', 'options_check'),
		'id' => "example_typography",
		'std' => $typography_defaults,
		'type' => 'typography' );



	$options[] = array(
		'name' => __('Check to Show a Hidden Text Input', 'options_check'),
		'desc' => __('Click here and see what happens.', 'options_check'),
		'id' => 'example_showhidden',
		'type' => 'checkbox');

		
	$options[] = array(
		'name' => __('Hidden Text Input', 'options_check'),
		'desc' => __('This option is hidden unless activated by a checkbox click.', 'options_check'),
		'id' => 'example_text_hidden',
		'std' => 'Hello',
		'class' => 'hidden',
		'type' => 'text');


	/* changement de page  */
	/* Slider homepage */
	$options[] = array(
		'name' => __('Slider homepage ', 'options_check'),
		'type' => 'heading');

	$options[] = array(
		'name' => "Example Image Selector",
		'desc' => "Images for layout.",
		'id' => "example_images",
		'std' => "2c-l-fixed",
		'type' => "images",
		'options' => array(
			'1col-fixed' => $imagepath . 'slider/homepage/1-sample-img.png',
			'2c-l-fixed' => $imagepath . 'slider/homepage/2-sample-img.png',
			'2c-r-fixed' => $imagepath . 'slider/homepage/2-sample-img.png')
	);


/* changement de page  */
/* Publicités */
	$options[] = array(
		'name' => __('Publicites', 'options_check'),
		'type' => 'heading');

		/* pub top sidebar*/
		$options[] = array(
		'name' => __('pub top sidebar', 'options_check'),
		'desc' => __('Ajoutez votre pub ici 200px * 200px.', 'options_check'),
		'id' => 'pub_top_sidebar',
		'type' => 'upload');

		/* pub middle sidebar */
		$options[] = array(
		'name' => __('pub middle sidebar ', 'options_check'),
		'desc' => __('Ajoutez votre pub ici 200px * 200px.', 'options_check'),
		'id' => 'pub_middle_sidebar',
		'type' => 'upload');
		
		/* pub bottom sidebar*/
		$options[] = array(
		'name' => __('pub bottom sidebar', 'options_check'),
		'desc' => __('Ajoutez votre pub ici 200px * 200px.', 'options_check'),
		'id' => 'pub_bottom_sidebar',
		'type' => 'upload');


		

/* changement de page  */
/* Text Editor  */

	$options[] = array(
		'name' => __('Text Editor', 'options_check'),
		'type' => 'heading' );

		/**
		 * For $settings options see:
		 * http://codex.wordpress.org/Function_Reference/wp_editor
		 *
		 * 'media_buttons' are not supported as there is no post to attach items to
		 * 'textarea_name' is set by the 'id' you choose
		 */

		$wp_editor_settings = array(
			'wpautop' => true, // Default
			'textarea_rows' => 5,
			'tinymce' => array( 'plugins' => 'wordpress' )
		);
		
	$options[] = array(
		'name' => __('Default Text Editor', 'options_check'),
		'desc' => sprintf( __( 'You can also pass settings to the editor.  Read more about wp_editor in <a href="%1$s" target="_blank">the WordPress codex</a>', 'options_check' ), 'http://codex.wordpress.org/Function_Reference/wp_editor' ),
		'id' => 'example_editor',
		'type' => 'editor',
		'settings' => $wp_editor_settings );

		return $options;
	}