<?php

function profile_image_upload($redirect, $user_id, $profile_image)
{
    $errors = []; //reset $errors for safety
    $message = '';  //reset $message for safety
    require_once ABSPATH.'wp-admin/includes/admin.php';
    //check if it is an image file
    if (!eregi('image/', $_FILES['async-upload']['type'])) {
        $errors[] = "Le fihier uploadé n'est pas une image veuillez uploader un fichier valide !";
        $message = "Le fihier uploadé n'est pas une image veuillez uploader un fichier valide !";
        $message = str_replace(' ', '%20', $message);
    } else { //it is an image, upload it
      $message = '';
      //media_handle_upload() is what actually does the uploading
      $id = media_handle_upload('async-upload', ''); //post id of Client Files page
      unset($_FILES);
    }
    try {
        if ($errors == '') {
            //delete the old image
         if (!empty($profile_image)) {
             wp_delete_attachment($profile_image);
         }
         //add, or update the new one
         update_user_meta($user_id, 'profile_image', $id, false);
            $message = 'Image emvoyé';
            $message = str_replace(' ', '%20', $message);
        }
    } catch (Exception $e) {
        $ok = 'Caught%20exception:%20'.$e->getMessage()."\n";
        $ok = str_replace(' ', '%20', $message);
    }
    // si il y a des erreur d'envoie de fichier
    if (!empty($errors)) {
        define('ADD_AVATAR_ERROR', serialize($errors));
    } else {
        define('ADD_AVATAR_OK', $ok);
    }
}

//display the image if one exists
/*  $size accepts
 *  thumbnail, medium, large or full
 *  or 2-dimensional array e.g  $size = array(32,32);
*/
function profile_image_display($size, $img_id)
{
    if (!empty($img_id)) {
        echo wp_get_attachment_image($img_id, $size);
    }
}
