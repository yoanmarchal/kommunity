<?php 
// check ajout custom post type photo depuis le front
add_action('template_redirect', 'add_photo');
function add_photo(){ 
//fonction enregistrement utilisateur
//si la fontion est appelée avec un "do" et si le do = register
    if(isset($_GET['do']) && $_GET['do'] == 'add_photo'):
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



        // si il n'y a pas d'erreur
        if(empty($errors)):

        	// mettre les informations recoltées dans un array
    	    $post_information = array(
    			'post_title' => esc_attr(strip_tags($_POST['postTitle'])),
    			'post_content' => esc_attr(strip_tags($_POST['postcontent'])),
    			'post_type' => 'photo',
    			'post_status' => 'publish'
    		);

    		// inserer l'array post_information dans la base de données
    		$post_id = wp_insert_post($post_information);


            if (!function_exists('wp_generate_attachment_metadata')){
                require_once(ABSPATH . "wp-admin" . '/includes/image.php');
                require_once(ABSPATH . "wp-admin" . '/includes/file.php');
                require_once(ABSPATH . "wp-admin" . '/includes/media.php');
            }

            // si il y a des fichiers 
            if ($_FILES) {
                foreach ($_FILES as $file => $array) {
                    if ($_FILES[$file]['error'] !== UPLOAD_ERR_OK) {
                        return "upload error : " . $_FILES[$file]['error'];
                    }
                    $attach_id = media_handle_upload( $file, $post_id );
                }   
            } else {
                $errors[] = 'Veuillez ajouter une photo';
            }
            if ($attach_id > 0){
                //and if you want to set that image as Post  then use:
                update_post_meta($post_id,'_thumbnail_id',$attach_id);
            }



    		//rediriger vers le post une fois sauvegardé
    		$link = get_permalink( $post_id );
            $succes[] = 'Votre photo as bien été envoyé <a href="'. $link .'">Voir ma photo</a></div>';
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
                
            /*  define('ADD_PHOTO_LINK', $link); */
    endif;
}
