<?php



function add_ajaxurl_cdata_to_front(){ //ajoute l'url ajax wordpress dans le head
?>
<script type="text/javascript">
//<![CDATA[
ajax_url = '<?php echo admin_url( 'admin-ajax.php'); ?>';
//]]>
</script>
<?php
}
add_action( 'wp_head', 'add_ajaxurl_cdata_to_front', 1);	



/*


add_action( 'wp_ajax_view_site_description', 'view_site_description' );
add_action( 'wp_ajax_nopriv_view_site_description', 'view_site_description' );
function view_site_description(){ //fonction voir la description si la fonction est appeleé
	echo get_bloginfo( 'description', 'display' );
	die();
}






add_action( 'wp_ajax_post_video', 'post_video' );
add_action( 'wp_ajax_nopriv_post_video', 'post_video' );

function post_video(){ //fonction voir la description si la fonction est appeleé
	if( 'POST' == $_SERVER['REQUEST_METHOD'] && !empty( $_POST['action'] )) {
		
		 // Do some minor form validation to make sure there is content
		if(trim($_POST['postTitle']) === '') {
		$postTitleError = 'Please enter a title.';
		$hasError = true;
		} else {
			$postTitle = trim($_POST['postTitle']);
		}
		
		
		
		
		if (isset ($_POST['postContent'])) { 
				$description = htmlentities(trim(stripcslashes($_POST['postContent'])));
		
		} else {
			echo 'Please enter the content';
		}

			
		$post_information = array(
			'post_title' => esc_attr(strip_tags($_POST['postTitle'])),
			'post_content' => esc_attr(strip_tags($_POST['postContent'])),
			'post_type' => 'video',
			'post_status' => 'publish'
		);

		$post_id = wp_insert_post($post_information);

		if($post_id)
		{
			// Update Custom Meta
			update_post_meta($post_id, '_url_video', esc_attr(strip_tags($_POST['customMetaOne'])));
		}
		
		
		//rediriger vers le post une fois sauvegardé
		$link = get_permalink( $post_id );
		wp_redirect( $link );
		
		echo 'voir le lien';
		// important, pour bien récupérer la valeur de retour
		 die ();
	}
}
	


	*/