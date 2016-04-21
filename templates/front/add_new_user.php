<?php


/*
// changement de l'adresse de login
add_filter('site_url',  'wplogin_filter', 10, 3);
function wplogin_filter( $url, $path, $orig_scheme )
{
 $old  = array( "/(wp-login\.php)/");
 $new  = array( "login");
 return preg_replace( $old, $new, $url, 1);
}
*/
add_action('login_form', 'redirect_after_login');
function redirect_after_login()
{
    global $redirect_to;
    if (!isset($_GET['redirect_to'])) {
        $redirect_to = get_option('siteurl');
    }
}

// enregistrement utilistateur

add_action('template_redirect', 'register_a_user');
function register_a_user()
{
    //fonction enregistrement utilisateur
//si la fontion est appelée avec un "do" et si le do = register
  if (isset($_GET['do']) && $_GET['do'] == 'register'):
    $errors = [];
    if (empty($_POST['user']) || empty($_POST['email'])) {
        $errors[] = 'Veuillez indiquer un identifiant et un mot de passe';
        add_action('wp_footer', 'add_scrool_to_error', 1);
    }

    $user_login = esc_attr($_POST['user']);
    $user_email = esc_attr($_POST['email']);

    $sanitized_user_login = sanitize_user($user_login);
    $user_email = apply_filters('user_registration_email', $user_email);

    // si le mail contient des erreur
    if (!is_email($user_email)) {
        $errors[] = 'Email invalide';
        add_action('wp_footer', 'add_scrool_to_error', 1);
    }
    // si le mail existe déjà
    elseif (email_exists($user_email)) {
        $errors[] = 'Cet email est déjà enregistré, si vous avez perdu votre mot de passe vous devez le regenerer <a href="http://pubforyou.com/wp-login.php?action=lostpassword" title="Lost Password"> Ici</a>';
        add_action('wp_footer', 'add_scrool_to_error', 1);
    }
    // si l'identifiant est vide ou contient des erreurs
    if (empty($sanitized_user_login) || !validate_username($user_login)) {
        $errors[] = 'identifiant non valide';
        add_action('wp_footer', 'add_scrool_to_error', 1);
    }
    // si l'identifiant existe deja
    elseif (username_exists($sanitized_user_login)) {
        $errors[] = 'Cet identifiant existe déjà';
        add_action('wp_footer', 'add_scrool_to_error', 1);
    }
    // si il n'y a pas d'erreur
    if (empty($errors)):
        //on genere un mot de passe
      $user_pass = wp_generate_password();
        //on creer un nouvel utilisateur et lui attribue le mot de passe generer
      $user_id = wp_create_user($sanitized_user_login, $user_pass, $user_email);

    if (!$user_id):
        $errors[] = 'L\'enregistrement à raté...';
    add_action('wp_footer', 'add_scrool_to_error', 1); else:
        //on update le mot de passe dans la db
        update_user_option($user_id, 'default_password_nag', true, true);
        //on envoie une notification sur le mail precedement indiqué grace a la fonction  wp_new_user_notification()
        wp_new_user_notification($user_id, $user_pass);
    add_action('wp_footer', 'add_scrool_to_infos', 1);
    endif;
    endif;

    if (!empty($errors)) {
        define('REGISTRATION_ERROR', serialize($errors));
    } else {
        define('REGISTERED_A_USER', $user_email);
    }
    endif;
}
