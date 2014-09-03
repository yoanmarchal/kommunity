<?php 
// check ajout custom post type video depuis le front
add_action('template_redirect', 'add_bonplan');
function add_bonplan(){ 
//fonction enregistrement utilisateur
//si la fontion est appelée avec un "do" et si le do = register
  if(isset($_GET['do']) && $_GET['do'] == 'add_bonplan'):
    $errors = array();
    $succes = array();
    $current_user = wp_get_current_user();
	
	// si le titre est vide -> envoyer une erreur
    if(empty($_POST['postTitle'])) {
    	$errors[] = 'Veuillez indiquer un titre';
    }

    $Title = $_POST['postTitle'];

    // si la description est vide -> envoyer une erreur
	if(empty($_POST['postcontent'])) {
    	$errors[] = 'Veuillez ajouter une description';
    }

    if (!function_exists('wp_generate_attachment_metadata')){
        require_once(ABSPATH . "wp-admin" . '/includes/image.php');
        require_once(ABSPATH . "wp-admin" . '/includes/file.php');
        require_once(ABSPATH . "wp-admin" . '/includes/media.php');
    }
    

    // si il n'y a pas d'erreur
    if(empty($errors)):

    	// mettre les informations recoltées dans un array
	    $post_information = array(
			'post_title' => esc_attr(strip_tags($_POST['postTitle'])),
			'post_content' => esc_attr(strip_tags($_POST['postcontent'])),
			'post_type' => 'bonplan',
            'post_author' => $current_user->ID,
			'post_status' => 'publish'
		);

		// inserer l'array post_information dans la base de données
		$post_id = wp_insert_post($post_information, $errors);

        if($post_id){
            if(isset($_POST['rue'])){
                update_post_meta($post_id, '_rue', esc_attr(strip_tags($_POST['rue'])));
            }                   
            if(isset($_POST['postal-code'])){
                update_post_meta($post_id, '_code_postal', esc_attr(strip_tags($_POST['postal-code'])));
            }
            if(isset($_POST['ville'])){
                update_post_meta($post_id, '_ville', esc_attr(strip_tags($_POST['ville'])));  
            }
            if(isset($_POST['region_selection'])){
                update_post_meta($post_id, '_region', esc_attr(strip_tags($_POST['region_selection'])));
            }
            if(isset($_POST['startDate'])){
                update_post_meta($post_id, '_debut_date', sanitize_text_field($_POST['startDate']));
            }
            if(isset($_POST['startHour'])){
                update_post_meta($post_id, '_debut_heure', esc_attr(strip_tags($_POST['startHour'])));
            }
            if(isset($_POST['endDate'])){
                update_post_meta($post_id, '_fin_date', sanitize_text_field($_POST['endDate'])); 
            }
            if(isset($_POST['endDate'])){                    
                update_post_meta($post_id, '_fin_heure', esc_attr(strip_tags($_POST['endHour'])));
            }            
        }

        if ($_FILES) {
            foreach ($_FILES as $file => $array) {
                if ($_FILES[$file]['error'] !== UPLOAD_ERR_OK) {
                    return "upload error : " . $_FILES[$file]['error'];
                }
                $attach_id = media_handle_upload( $file, $post_id );
            }   
        }
        if ($attach_id > 0){
            //and if you want to set that image as Post  then use:
            update_post_meta($post_id,'_thumbnail_id',$attach_id);
        }


       

		//creer le lien de redirection vers le post une fois sauvegardé
		$link = get_permalink( $post_id );
        $succes[] = 'Votre bon plan as bien été envoyé <a href="'. $link .'">Voir mon bon plan</a></div>';

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
    endif;
}