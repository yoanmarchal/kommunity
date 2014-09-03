<?php 
// check ajout custom post type video depuis le front
add_action('init', 'add_my_video');

function add_my_video(){ 
	global $post;
    //fonction enregistrement utilisateur
    //si la fontion est appelée avec un "do" et si le do = register
    if(isset($_GET['do']) && $_GET['do'] == 'add_video'){
    $errors = array();
    $succes = array();
	
	// si le titre est vide -> envoyer une erreur
    if(empty($_POST['postTitle'])) {
    	$errors[] = 'Veuillez indiquer un titre';
    }

    $Title = $_POST['postTitle'];

    // si la description est vide -> envoyer une erreur
	if(empty($_POST['postcontent'])) {
    	$errors[] = 'Veuillez ajouter une description';
    }

    // si la description est vide -> envoyer une erreur
	if(empty($_POST['videoUrl'])) {
    	$errors[] = 'Veuillez ajouter une video';
    }


	
    // si il n'y a pas d'erreur
    if(empty($errors)):

    	// mettre les informations recoltées dans un array
	    $post_information = array(
			'post_title' => esc_attr(strip_tags($_POST['postTitle'])),
			'post_content' => esc_attr(strip_tags($_POST['postcontent'])),
			'post_type' => 'video',
			'post_status' => 'publish'
		);

		// inserer l'array post_information dans la base de données
		$post_id = wp_insert_post($post_information);
          

        $url = $_POST['videoUrl'];
        $directory = get_bloginfo('template_directory');

        // dectection youtube ou vimeo
        
        $video = parseVideos($url);
        
        /*
        $video = wp_oembed_get($url);
        */

        if (empty($video)) {
        //si la transformation échoue on affiche une image standart
                
        } else {

            $video_thumb_url = $video[0]['fullsize'];

            set_time_limit(300);

            if ( ! empty($url) ) { //detection si il y a une url
     

                require_once(ABSPATH . 'wp-admin/includes/file.php');
                require_once(ABSPATH . 'wp-admin/includes/media.php');
                require_once(ABSPATH . 'wp-admin/includes/image.php');


                // media_sideload_image() doesnt return the attachment id :<
                // Download file to temp location and setup a fake $_FILE handler
                // with a new name 
                $tmp = download_url( $video_thumb_url );
                // retourne '/home/devellop/public_html/wp-content/i3Jv9fNPjgk'

                if ($tmp){

                    if ( ! strlen( $Title ) )  $Title = null;


                    // Set variables for storage
                    // fix file filename for query strings
                    $file_array = array(
                        'name' => basename($video_thumb_url),
                        'type' => 'image/jpeg',
                        'tmp_name' => $tmp,
                        'error' => 0
                         //normally, this is used to store an error, should the upload fail. but since this isnt actually an instance of $_FILES we can default it to zero here
                    );

                    /*
                    print_r($file_array);
                    */

                    // If error storing temporarily, unlink
                    if ( is_wp_error( $tmp ) ) {
                        @unlink($file_array['tmp_name']); // efface le fichier 
                        $file_array['tmp_name'] = ''; //vide la variable tmp_name
                        $errors[] = 'error storing temporarily'; //si ya un probleme de stockage on previent
                    }

                    

                    // do the validation and storage stuff.  Make a description based on the title or slug
                    $attachment_id = media_handle_sideload( $file_array, $post_id, $Title );


                    // If error storing permanently, unlink
                    if ( is_wp_error($attachment_id) ) {@unlink($file_array['tmp_name']);}


                    // Set as the post attachment
                    add_post_meta( $post_id, '_thumbnail_id', $attachment_id, true );


                    // and set it as the post thumbnail
                    set_post_thumbnail( $post_id, $attachment_id );

                }
            }
        }

    	//and if you want to set that image as Post  then use:
    	update_post_meta($post_id,'_url_video', esc_attr(strip_tags($_POST['videoUrl'])));
            
          
    	//rediriger vers le post une fois sauvegardé
    	$link = get_permalink( $post_id );
        $succes[] = 'Votre video as bien été ajoutée <a href="'. $link .'">Voir ma vidéo</a></div>';
    endif;

    // si il y a des erreur d'envoie de fichier 
    if(!empty($errors)) {
        define('SUBMISSION_ERROR', serialize($errors));
        add_action( 'wp_footer', 'notify_error', 1, $errors);   

    } else {
        define('SUBMISSION_LINK', serialize($succes), $link);
        add_action( 'wp_footer', 'notify_succes', 1, $succes); 
        unset($_POST);
    } 
  }
}