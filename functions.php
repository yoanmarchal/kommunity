<?php 
/*

function wpr_maintenance_mode() {
    if ( !current_user_can( 'edit_themes' ) || !is_user_logged_in() ) {
        wp_die('
            <img class="logo" src="http://pubforyou.com/wp-content/themes/pub4you-tpl-0.2/img/logo-pub4you.png" alt="Pub4you">
            <span class="infos">Site en Maintenance, nous revenons dans un instant</span>

            <style>
            html {
                background-color: #007A9F;
            }
            .logo{vertical-align: middle;}
            .infos{}
            #error-page p {
                font-size: 22px;
                line-height: 1.5;
                margin: 25px 0 20px;
                text-align: center;
            }
            body {
            background: transparent;
            color: #fff;
            font-family: sans-serif;
            margin: 2em auto;
            padding: 1em 2em;
            -webkit-border-radius: 3px;
            border-radius: 3px;
            border: 0px solid transparent;
            max-width: 70%;
            }

            </style>');
    }
}
add_action('get_header', 'wpr_maintenance_mode');
*/

add_action('wp_ajax_wpse_delete_post', 'wpse_delete_post');
add_action('wp_ajax_nopriv_wpse_delete_post', 'wpse_delete_post');

function wpse_delete_post()
{
    $errors = [];
    $succes = [];

    // be sure to add all the security you need, so that no post gets deleted by accident or malicious intent
    $postid = intval($_POST['post_id']);
    // also define what you want your AJAX message to return
    if (wp_delete_post($postid) === false) {
        echo 'fail';
        $errors = ' fail';
    } else {
        echo 'success';
        $succes = 'succes';
    }

    die(); // needed to function properly
     // si il y a des erreur d'envoie de fichier
    if (!empty($errors)) {
        define('SUBMISSION_ERROR', serialize($errors));
        add_action('wp_footer', 'notify_error', 1, $errors);
    } else {
        define('SUBMISSION_LINK', serialize($succes), $link);
        add_action('wp_footer', 'notify_succes', 1, $succes);
        unset($_POST);
    }

    $link = get_permalink($post_id);
}

add_action('wp_head', 'pluginname_ajaxurl');
function pluginname_ajaxurl()
{
    ?>
<script type="text/javascript">
var ajaxurl = '<?php echo admin_url('admin-ajax.php');
    ?>';
</script>
<?php

}

if (!function_exists('WP_Router_load')) {
    function WP_Router_load()
    {
        // load the base class
                require_once TEMPLATEPATH.'/lib/class/WP_Router_Utility.class.php';

        if (WP_Router_Utility::prerequisites_met(phpversion(), get_bloginfo('version'))) {
            // we can continue. Load all supporting files and hook into wordpress
                    require_once TEMPLATEPATH.'/lib/class/WP_Router.class.php';
            require_once TEMPLATEPATH.'/lib/class/WP_Route.class.php';
            require_once TEMPLATEPATH.'/lib/class/WP_Router_Page.class.php';
            add_action('init', ['WP_Router_Utility', 'init'], -100, 0);
            add_action(WP_Router_Utility::PLUGIN_INIT_HOOK, ['WP_Router_Page', 'init'], 0, 0);
            add_action(WP_Router_Utility::PLUGIN_INIT_HOOK, ['WP_Router', 'init'], 1, 0);

            add_action('wp_router_generate_routes', 'bl_add_routes', 20);

            function bl_add_routes($router)
            {
                /* Mes Bonplans */
                        $route_bp_args = [
                            'path'            => '^mes-bons-plans',
                            'query_vars'      => [],
                            'page_callback'   => 'bp_add_bodyclass',
                            'page_arguments'  => [],
                            'access_callback' => true,
                            'title'           => __('Mes bons plans'),
                            'template'        => [
                                'template-voir-mes-bon-plan.php',
                                dirname(__FILE__).'/template-voir-mes-bon-plan.php',
                            ],
                        ];
                $router->add_route('demo-route-bp', $route_bp_args);
            }

            function bp_add_bodyclass()
            {
                add_action('body_class', 'kom_bp_add_my_bodyclass');
                function kom_bp_add_my_bodyclass($classes)
                {
                    global $post;
                    $classes[] = 'mes-bons-plans';

                    return $classes;
                }
            }

            add_action('wp_router_generate_routes', 'ph_add_routes', 20);
            function ph_add_routes($router)
            {
                /* Mes photos */
                        $route_my_photos_args = [
                            'path'            => '^mes-photos',
                            'query_vars'      => [],
                            'page_callback'   => 'ph_add_bodyclass',
                            'page_arguments'  => [],
                            'access_callback' => true,
                            'title'           => __('Mes photos'),
                            'template'        => [
                                'template-voir-mes-photos.php',
                                dirname(__FILE__).'/template-voir-mes-photos.php',
                            ],
                        ];
                $router->add_route('demo-route-ph', $route_my_photos_args);
            }

            function ph_add_bodyclass()
            {
                add_action('body_class', 'kom_ph_add_my_bodyclass');
                function kom_ph_add_my_bodyclass($classes)
                {
                    global $post;
                    $classes[] = 'mes-photos';

                    return $classes;
                }
            }

            add_action('wp_router_generate_routes', 'vids_add_routes', 20);
            function vids_add_routes($router)
            {
                /* Mes video */
                        $route_my_videos_args = [
                            'path'            => '^mes-videos',
                            'query_vars'      => [],
                            'page_callback'   => 'vids_add_bodyclass',
                            'page_arguments'  => [],
                            'access_callback' => true,
                            'title'           => __('Mes vidéo'),
                            'template'        => [
                                'template-voir-mes-videos.php',
                                dirname(__FILE__).'/template-voir-mes-videos.php',
                            ],
                        ];
                $router->add_route('demo-route-vids', $route_my_videos_args);
            }

            function vids_add_bodyclass()
            {
                add_action('body_class', 'kom_vids_add_my_bodyclass');
                function kom_vids_add_my_bodyclass($classes)
                {
                    global $post;
                    $classes[] = 'mes-videos';

                    return $classes;
                }
            }

            add_action('wp_router_generate_routes', 'profil_add_routes', 20);
            function profil_add_routes($router)
            {
                /* Mon profil */
                        $route_my_videos_args = [
                            'path'            => '^profil',
                            'query_vars'      => [],
                            'page_callback'   => 'profil_add_bodyclass',
                            'page_arguments'  => [],
                            'access_callback' => true,
                            'title'           => __('Ma fiche'),
                            'template'        => [
                                'tpl-profil.php',
                                dirname(__FILE__).'/tpl-profil.php',
                            ],
                        ];
                $router->add_route('demo-route-profil', $route_my_videos_args);
            }

            function profil_add_bodyclass()
            {
                add_action('body_class', 'kom_profil_add_my_bodyclass');
                function kom_profil_add_my_bodyclass($classes)
                {
                    global $post;
                    $classes[] = 'editer-mon-profil';

                    return $classes;
                }
            }

            add_action('wp_router_generate_routes', 'login_add_routes', 20);
            function login_add_routes($router)
            {
                /* Mon login */
                        $route_my_videos_args = [
                            'path'            => '^login',
                            'query_vars'      => [],
                            'page_callback'   => 'login_add_bodyclass',
                            'page_arguments'  => [],
                            'access_callback' => true,
                            'title'           => __('Ma fiche'),
                            'template'        => [
                                'tpl-login.php',
                                dirname(__FILE__).'/tpl-login.php',
                            ],
                        ];
                $router->add_route('demo-route-login', $route_my_videos_args);
            }

            function login_add_bodyclass()
            {
                add_action('body_class', 'kom_login_add_my_bodyclass');
                function kom_login_add_my_bodyclass($classes)
                {
                    global $post;
                    $classes[] = 'login-page';

                    return $classes;
                }
            }

                    /*
                    add_action( 'wp_router_generate_routes', 'my_avatar_add_routes', 20 );
                    function my_avatar_add_routes( $router ) {

                        $route_my_videos_args = array(
                            'path' => '^edit-avatar',
                            'query_vars' => array( ),
                            'page_callback' => false,
                            'page_arguments' => array( ),
                            'access_callback' => true,
                            'title' => __( 'Mon avatar' ),
                            'template' => array(
                                'tpl-edit-avatar.php',
                                dirname( __FILE__ ) . '/tpl-edit-avatar.php'
                            )
                        );
                        $router->add_route( 'demo-route-avatar', $route_my_videos_args );
                    }
                    */
        } else {
            // let the user know prerequisites weren't met
                    add_action('admin_head', ['WP_Router_Utility', 'failed_to_load_notices'], 0, 0);
        }
    }
        // Fire it up!
        WP_Router_load();
}

require_once TEMPLATEPATH.'/lib/class/wp_bootstrap_navwalker.php';

/* Routes */

add_action('send_headers', 'site_router');
function site_router()
{
    $root = str_replace('index.php', '', $_SERVER['SCRIPT_NAME']);
    $url = str_replace($root, '', $_SERVER['REQUEST_URI']);
    $url = explode('/', $url);
    if (count($url) == 1 && $url[0] == 'login') {
        require 'tpl-login.php';
        die();
    } elseif (count($url) == 1 && $url[0] == 'logout') {
        wp_logout();
        header('location:'.$root);
        die();
    } elseif (count($url) == 1 && $url[0] == 'register') {
        require 'tpl-register.php';
        die();
    } elseif (count($url) == 1 && $url[0] == 'reset') {
        require 'tpl-reset.php';
        die();
    } elseif (count($url) == 1 && $url[0] == 'edit-avatar') {
        require 'tpl-edit-avatar.php';
        die();
    }
}

/* Detection Languages */
load_theme_textdomain('kommunity', get_template_directory().'/languages');

/* definition de la taille */
if (!isset($content_width)) {
    $content_width = 1100;
}

// Show posts of 'post', 'page' and 'movie' post types on home page
add_action('pre_get_posts', 'add_my_post_types_to_query');

function add_my_post_types_to_query($query)
{
    if (is_home() && $query->is_main_query()) {
        $query->set('post_type', ['bonplan', 'video', 'photo']);
    }

    return $query;
}

/* popular post */

function wpb_set_post_views($postID)
{
    $count_key = 'wpb_post_views_count';
    $count = get_post_meta($postID, $count_key, true);
    if ($count == '') {
        $count = 0;
        delete_post_meta($postID, $count_key);
        add_post_meta($postID, $count_key, '0');
    } else {
        $count++;
        update_post_meta($postID, $count_key, $count);
    }
}
//To keep the count accurate, lets get rid of prefetching
remove_action('wp_head', 'adjacent_posts_rel_link_wp_head', 10, 0);

/* voir le nombre de vue  */
function wpb_get_post_views($postID)
{
    $count_key = 'wpb_post_views_count';
    $count = get_post_meta($postID, $count_key, true);
    if ($count == '') {
        delete_post_meta($postID, $count_key);
        add_post_meta($postID, $count_key, '0');

        return '0 <i class="icon-eye-open icon-white"></i>';
    }

    return $count.' <i class="icon-eye-open icon-white"></i>';
}

/* Options du theme  */

if (!function_exists('of_get_option')) {
    function of_get_option($name, $default = false)
    {
        $optionsframework_settings = get_option('optionsframework');
        // Gets the unique option id
        $option_name = $optionsframework_settings['id'];
        if (get_option($option_name)) {
            $options = get_option($option_name);
        }
        if (isset($options[$name])) {
            return $options[$name];
        } else {
            return $default;
        }
    }
}

/*
 * option retractable
 */

add_action('optionsframework_custom_scripts', 'optionsframework_custom_scripts');

function optionsframework_custom_scripts()
{
    ?>

<script type="text/javascript">
jQuery(document).ready(function() {

	jQuery('#example_showhidden').click(function() {
  		jQuery('#section-example_text_hidden').fadeToggle(400);
	});
	
	if (jQuery('#example_showhidden:checked').val() !== undefined) {
		jQuery('#section-example_text_hidden').show();
	}
	
});
</script>
 
<?php

}

/*
 * This is an example of how to override a default filter
 * for 'text' sanitization and use a different one.
 */

/*

add_action('admin_init','optionscheck_change_santiziation', 100);

function optionscheck_change_santiziation() {
    remove_filter( 'of_sanitize_text', 'sanitize_text_field' );
    add_filter( 'of_sanitize_text', 'of_sanitize_text_field' );
}

function of_sanitize_text_field($input) {
    global $allowedtags;
    $output = wp_kses( $input, $allowedtags);
    return $output;
}

*/

/*
 * This is an example of how to override the default location and name of options.php
 * In this example it has been renamed options-renamed.php and moved into the folder extensions
 */

/*

add_filter('options_framework_location','options_framework_location_override');

function options_framework_location_override() {
    return array('/extensions/options-renamed.php');
}

*/

function kommunity_customize_register($wp_customize)
{
    $colors = [];
    $colors[] = [
        'slug'    => 'content_text_color',
        'default' => '#333',
        'label'   => __('Content Text Color', 'Ari'),
    ];
    $colors[] = [
        'slug'    => 'content_link_color',
        'default' => '#88C34B',
        'label'   => __('Content Link Color', 'Ari'),
    ];
    foreach ($colors as $color) {
        // SETTINGS
        $wp_customize->add_setting(
            $color['slug'], [
                'default'    => $color['default'],
                'type'       => 'option',
                'capability' => 'edit_theme_options',
            ]
        );
        // CONTROLS
        $wp_customize->add_control(
            new WP_Customize_Color_Control(
                $wp_customize,
                $color['slug'],
                ['label'   => $color['label'],
                'section'  => 'colors',
                'settings' => $color['slug'], ]
            )
        );
    }
}

add_action('customize_register', 'kommunity_customize_register');
/* Fin des Options */

/* Mode maintenance */

// enleve la barre du haut quand ce seras en ligne
/*
show_admin_bar( false );
*/

/* unregister page navi style*/
add_action('wp_print_styles', 'my_deregister_styles', 100);
function my_deregister_styles()
{
    wp_deregister_style('wp-pagenavi');
}

// add microformat to photo
function add_itemprop($html)
{
    $html = str_replace('<img', '<img itemprop="photo"', $html);

    return $html;
}
add_filter('post_thumbnail_html', 'add_itemprop');

/*
 * Include posts from authors in the search results where
 * either their display name or user login matches the query string
 *
 * @author danielbachhuber
 */
/*
add_filter( 'posts_search', 'db_filter_authors_search' );
function db_filter_authors_search( $posts_search ) {

    // Don't modify the query at all if we're not on the search template
    // or if the LIKE is empty
    if ( !is_search() || empty( $posts_search ) )
        return $posts_search;

    global $wpdb;
    // Get all of the users of the blog and see if the search query matches either
    // the display name or the user login
    add_filter( 'pre_user_query', 'db_filter_user_query' );
    $search = sanitize_text_field( get_query_var( 's' ) );
    $args = array(
        'count_total' => false,
        'search' => sprintf( '*%s*', $search ),
        'search_fields' => array(
            'display_name',
            'user_login',
        ),
        'fields' => 'ID',
    );
    $matching_users = get_users( $args );
    remove_filter( 'pre_user_query', 'db_filter_user_query' );
    // Don't modify the query if there aren't any matching users
    if ( empty( $matching_users ) )
        return $posts_search;
    // Take a slightly different approach than core where we want all of the posts from these authors
    $posts_search = str_replace( ')))', ")) OR ( {$wpdb->posts}.post_author IN (" . implode( ',', array_map( 'absint', $matching_users ) ) . ")))", $posts_search );
    error_log( $posts_search );
    return $posts_search;
}
*/

/*
 * Modify get_users() to search display_name instead of user_nicename
 */
/*
function db_filter_user_query( &$user_query ) {

    if ( is_object( $user_query ) )
        $user_query->query_where = str_replace( "user_nicename LIKE", "display_name LIKE", $user_query->query_where );
    return $user_query;
}
*/

/* autorise la création de bio personalisées */
//disable WordPress sanitization to allow more than just $allowedtags from /wp-includes/kses.php
remove_filter('pre_user_description', 'wp_filter_kses');
//add sanitization for WordPress posts
add_filter('pre_user_description', 'wp_filter_post_kses');

//hook the Ajax call
//for logged-in users
add_action('wp_ajax_my_upload_action', 'my_ajax_upload');
//for none logged-in users
add_action('wp_ajax_nopriv_my_upload_action', 'my_ajax_upload');

function my_ajax_upload()
{
    //simple Security check
    check_ajax_referer('upload_thumb');

//get POST data
    $post_id = $_POST['post_id'];

//require the needed files
    require_once ABSPATH.'wp-admin'.'/includes/image.php';
    require_once ABSPATH.'wp-admin'.'/includes/file.php';
    require_once ABSPATH.'wp-admin'.'/includes/media.php';
//then loop over the files that were sent and store them using  media_handle_upload();
    if ($_FILES) {
        foreach ($_FILES as $file => $array) {
            if ($_FILES[$file]['error'] !== UPLOAD_ERR_OK) {
                echo 'upload error : '.$_FILES[$file]['error'];
                die();
            }
            $attach_id = media_handle_upload($file, $post_id);
        }
    }
//and if you want to set that image as Post  then use:
  update_post_meta($post_id, '_thumbnail_id', $attach_id);
    echo 'uploaded the new Thumbnail';
    die();
}

/* inclusion des custom post type*/
include 'templates/define_custom_post_type.php'; /* ok */

/* ajoute le support thumbnails  et definie la taille standart des thumbnails  */
include 'templates/define_images_size.php'; /* ok */

/*  decomposition du code front et back */
if (is_admin()) {
    // Code utile uniquement dans l'administration

        /* modification de la partie admin de wordpress  */
        include 'templates/admin/admin-side-modif.php'; /* ok */

        /* inclusion des metabox aux custom post type*/
        include 'templates/admin/add_metaboxes.php'; /* ok  */

        /* fonctionne avec metabox plugin permet l'upload de la vignette  */
        include 'templates/admin/img-upload.php'; /* todo : tester et implementer l'ajax post */

         /* modification du profil.php */
        include 'templates/admin/modification_profil.php'; /* à verifier*/
} else {
    // Code utile uniquement dans le front-end

        include 'templates/front/remove_jquery.php'; //eleve jquery de toutes les pages car nous disposont deja de jquery
        include 'templates/front/get_related.php'; //element relatif page single
        include 'templates/front/get_the_title_smaller.php'; //permet de recuperer un titre plus court

/*
        include 'templates/front/modif_commentaires.php'; // modifie les commentaires
*/
        include 'templates/front/add_new_user.php'; // check enregistrement utilisateur
        include 'templates/front/add_photo.php'; // check ajout custom post type photo depuis le front
        include 'templates/front/add_video.php'; // check ajout custom post type video depuis le front
        include 'templates/front/add_bonplan.php'; // check ajout custom post type bon plan depuis le front

        include 'templates/front/delete_item.php'; // creer un lien de suppression pour chaque cpt

/*
        include 'templates/edit_profil.php'; // check ajout custom post type bon plan depuis le front
*/

        include 'templates/front/add_scrool_to.php'; // scrool -> erreur ou info js

        include 'lib/class/classe_dates.php'; // permet de gerer les dates en francais
        include 'lib/class/simple-local-avatar.php'; // creer un lien de suppression pour chaque cpt
        include 'templates/front/add_image_uploader.php';

        /*  change le email from  */
        include 'templates/front/mail/email-from.php';

        /*
        include 'templates/add_ajax_to_front.php';
        */
        // ajoute la fonction get_video_thumbnail
        include 'templates/front/get_video_thumbnail.php';

        // ajoute le script /* responsive slider */ dans le footer
        include 'templates/front/add_slider.php';

    include 'templates/front/url_video_decoder.php';

    include 'templates/front/detect_browser.php';

    include 'templates/front/get_light_nav.php';

    include 'templates/front/get_full_adress.php';
    include 'templates/front/get_the_map.php';
    include 'templates/front/get_the_video.php';
    include 'templates/front/get_the_date_event.php';
    include 'templates/front/get_the_slider.php';
    include 'templates/front/get_user_social_link.php';
    include 'templates/front/get_author.php';
        /* recupere la list des horaire relatif à un auteur */
        include 'templates/front/get_author_horaires.php';
        /* à retravailler */
        include 'templates/front/get_fan_number.php';

        /* remove wordpress meta generator  */
        remove_action('wp_head', 'wp_generator');

    include 'templates/search.php';

        /* ajoute les boutton supprimer et editer si l'utilisateur connecté est l'auteur du post */
        /* todo : corriger le bug  */
        include 'templates/front/show_edit_button.php';

    include 'templates/front/add_twitter_anywhere_to_js.php';
}

//display the image profil if one exists
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

function date2fr($adate)
{
    $moisfrancais = [1 => 'Janvier', 'Février', 'Mars',
    'Avril', 'Mai', 'Juin', 'Juillet', 'Août',
    'Septembre', 'Octobre', 'Novembre', 'Décembre', ];
    $joursemainefrancais = [0 => 'Dimanche', 'Lundi', 'Mardi',
    'Mercredi', 'Jeudi', 'Vendredi', 'Samedi', ];
    $jour = $adate->format('d');
    $mois = $moisfrancais[$adate->format('n')];
    $annee = $adate->format('Y');
    $joursemaine = $joursemainefrancais[$adate->format('w')];

    return "$joursemaine $jour $mois $annee ";
}

function isodate2fr($isodatestring)
{
    setlocale(LC_TIME, 'fr_FR');

    return date2fr(new DateTime($isodatestring));
}

function social_shares()
{
    global $post_id;
    $url = get_permalink($post_id);
    $json = file_get_contents('http://api.sharedcount.com/?url='.rawurlencode($url));
    $counts = json_decode($json, true);
    $totalcounts = $counts['Twitter'] + $counts['Facebook']['total_count'] + $counts['GooglePlusOne'];
    echo '<span>'.$totalcounts.'</span>';
}

/* detect l'utilisateur ayant créer la remise et fais un lien vers la fiche  ne recupere pas l'image*/
/*
function get_related_author_posts() {
    global $authordata, $post;

    $authors_posts = query_posts( array( 'author' => $authordata->ID, 'post__not_in' => array( $post->ID ), 'posts_per_page' => -1, 'post_type' => 'adherents' ));


    $output = '<article class="right-content">';
    foreach ( $authors_posts as $authors_post ) {
        $output .= 'Remise faite par <a href="' . get_permalink( $authors_post->ID ) . '">' . apply_filters( 'the_title', $authors_post->post_title, $authors_post->ID ) . '</a>';
    }
    $output .= '</article>';

    return $output;
}

*/

// permet d'attacher une image a un post
function insert_attachment($file_handler, $post_id)
{
    // check to make sure its a successful upload
    if ($_FILES[$file_handler]['error'] !== UPLOAD_ERR_OK) {
        __return_false();
    }

    require_once ABSPATH.'wp-admin'.'/includes/image.php';
    require_once ABSPATH.'wp-admin'.'/includes/file.php';
    require_once ABSPATH.'wp-admin'.'/includes/media.php';

    $attach_id = media_handle_upload($file_handler, $post_id);

    return $attach_id;
}

//fonction get categorie
function get_obj_cat()
{
    echo '<span>Categories : </span>';
    foreach ((get_the_category()) as $category) {
        echo $category->cat_name.' ';
    }
}

function custom_post_author_archive($query)
{
    if ($query->is_author) {
        $query->set('post_type', ['bonsplanssorties', 'video']);
    }
    remove_action('pre_get_posts', 'custom_post_author_archive');
}
add_action('pre_get_posts', 'custom_post_author_archive');

// Add datepiker
function date_piker()
{
    add_action('init', 'register_my_script');
    add_action('wp_footer', 'print_my_script');

    function register_my_script()
    {
        wp_register_script('my-script', plugins_url('date.js', __FILE__), ['jquery'], '1.0', true);
    }

    function print_my_script()
    {
        global $add_my_script;

        if (!$add_my_script) {
            return;
        }

        wp_print_scripts('my-script');
    }
}
add_action('init', 'date_piker');

function register_my_menus()
{
    register_nav_menus(
    [
      'user-menu-connected'   => __('Menu user connect', 'Kommunity'),
      'user-menu-not-connect' => __('Menu user not connect', 'Kommunity'),
    ]
  );
}
add_action('init', 'register_my_menus');

//add favicon on all the pages
add_action('wp_head', 'ilc_favicon');
function ilc_favicon()
{
    echo "<link rel='shortcut icon' href='".get_stylesheet_directory_uri()."/img/favicon.ico' />"."\n";
}

//add logo to the login page
add_action('login_head', 'ilc_custom_login');
function ilc_custom_login()
{
    echo '<style type="text/css">
	h1 a {background-image:url('.get_stylesheet_directory_uri().'/img/kommunity-logo.gif'.') !important;}
	body.login {background-color: #232323;}
	</style>
	<script type="text/javascript">window.onload = function(){document.getElementById("login").getElementsByTagName("a")[0].href = "'.home_url().'";document.getElementById("login").getElementsByTagName("a")[0].title = "Go to site";}</script>';
}

/* retourne 20 mots -> excerpt */
function custom_excerpt_length($length)
{
    return 20;
}
add_filter('excerpt_length', 'custom_excerpt_length', 999);
add_theme_support('automatic-feed-links');

//custom list categorie for front-page

function my_list_categories_on_page($args)
{
    // get category objects
    $categories = get_categories($args);
    // set vars
    $odd_or_even = 'odd';
    $output = '';
    // loop objects
    foreach ($categories as $category) {
        // build output
        $output .= '<li class="'.$odd_or_even.'">';
        $output .= '<img src="img/'.$category->slug.'.jpg" alt="'.$category->name.' icon" />';
        $output .= '<a href="'.get_category_link($category->term_id).'">'.$category->name.'('.$category->category_count.')</a>';
        $output .= '</li>';
        $odd_or_even = ('odd' == $odd_or_even) ? 'even' : 'odd';
    }
    // return output
    return $output;
}

function my_list_categories($args)
{
    // get category objects
    $categories = get_categories($args);
    // set vars
    $odd_or_even = 'odd';
    $output = '';
    // loop objects
    foreach ($categories as $category) {
        // build output
        $output .= '<li class="'.$odd_or_even.'">';
        $output .= '<a href="'.get_category_link($category->term_id).'"data-filter=".category-'.$category->slug.'" >'.$category->name.'</a>';
        $output .= '</li>';
        $odd_or_even = ('odd' == $odd_or_even) ? 'even' : 'odd';
    }
    // return output
    return $output;
}

function my_list_categories_select($args)
{
    // get category objects
    $categories = get_categories($args);
    // set vars
    $output = '';
    // loop objects
    foreach ($categories as $category) {
        // build output
        $output .= '<option value="'.$category->slug.'" data-filter-value=".category-'.$category->slug.'">';
        $output .=  $category->name;
        $output .= '</option>';
    }
    // return output
    return $output;
}

function my_list_region_select($args)
{
    // get category objects
    $categories = get_post_custom($args);
    // set vars
    $output = '';
    // loop objects
    foreach ($categories as $category) {
        // build output
        $output .= '<option value="'.$category->slug.'" data-filter-value=".category-'.$category->slug.'">';
        $output .=  $category->name;
        $output .= '</option>';
    }
    // return output
    return $output;
}

/*
<select id="e1">
        <option value="AL">Alabama</option>
        ...
        <option value="WY">Wyoming</option>
</select>

pour générer les catégories select
    echo my_list_categories_select( array( 'orderby' => 'slug', 'order' => 'ASC','hide_empty'=>0 , 'number' => 300 ) );

 */

/**
 * PressTrends Theme API.
 */
function presstrends_theme()
{

        // PressTrends Account API Key
        $api_key = 's56djyn61favquhirtdg3fbrfphyncrnvelk';
    $auth = 'INSERT THEME AUTH CODE';

        // Start of Metrics
        global $wpdb;
    $data = get_transient('presstrends_theme_cache_data');
    if (!$data || $data == '') {
        $api_base = 'http://api.presstrends.io/index.php/api/sites/add/auth/';
        $url = $api_base.$auth.'/api/'.$api_key.'/';

        $count_posts = wp_count_posts();
        $count_pages = wp_count_posts('page');
        $comments_count = wp_count_comments();

            // wp_get_theme was introduced in 3.4, for compatibility with older versions.
            if (function_exists('wp_get_theme')) {
                $theme_data = wp_get_theme();
                $theme_name = urlencode($theme_data->Name);
                $theme_version = $theme_data->Version;
            }

        $plugin_name = '&';
        foreach (get_plugins() as $plugin_info) {
            $plugin_name .= $plugin_info['Name'].'&';
        }
        $posts_with_comments = $wpdb->get_var("SELECT COUNT(*) FROM $wpdb->posts WHERE post_type='post' AND comment_count > 0");
        $data = [
                'url'              => stripslashes(str_replace(['http://', '/', ':'], '', site_url())),
                'posts'            => $count_posts->publish,
                'pages'            => $count_pages->publish,
                'comments'         => $comments_count->total_comments,
                'approved'         => $comments_count->approved,
                'spam'             => $comments_count->spam,
                'pingbacks'        => $wpdb->get_var("SELECT COUNT(comment_ID) FROM $wpdb->comments WHERE comment_type = 'pingback'"),
                'post_conversion'  => ($count_posts->publish > 0 && $posts_with_comments > 0) ? number_format(($posts_with_comments / $count_posts->publish) * 100, 0, '.', '') : 0,
                'theme_version'    => $theme_version,
                'theme_name'       => $theme_name,
                'site_name'        => str_replace(' ', '', get_bloginfo('name')),
                'plugins'          => count(get_option('active_plugins')),
                'plugin'           => urlencode($plugin_name),
                'wpversion'        => get_bloginfo('version'),
                'api_version'      => '2.4',
            ];

        foreach ($data as $k => $v) {
            $url .= $k.'/'.$v.'/';
        }
        wp_remote_get($url);
        set_transient('presstrends_theme_cache_data', $data, 60 * 60 * 24);
    }
}

// PressTrends WordPress Action
add_action('admin_init', 'presstrends_theme');

/*
 * Plugin Name: Google oEmbed
 * Plugin URI: https://wpsmith.net
 * Description: Adds Google Drive and Maps to the oEmbed functionality.
 * Version: 1.0.0
 * Author: Travis Smith, Samuel Wood (Otto)
 * Author URI: http://wpsmith.net
 *
 * This program is free software; you can redistribute it and/or modify it under the terms of the GNU
 * General Public License version 2, as published by the Free Software Foundation.  You may NOT assume
 * that you can use any other version of the GPL.
 *
 * This program is distributed in the hope that it will be useful, but WITHOUT ANY WARRANTY; without
 * even the implied warranty of MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.
 *
 */

add_action('plugins_loaded', 'wpgo_add_google_maps_docs');
/**
 * Registers The Google Maps & The Google Drive oEmbed handlers.
 * Google Maps & Google Drive does not support oEmbed.
 *
 * @see WP_Embed::register_handler()
 * @see wp_embed_register_handler()
 */
function wpgo_add_google_maps_docs()
{
    wp_embed_register_handler('googlemaps', '#https?://maps.google.com/(maps)?.+#i', 'wpgo_embed_handler_googlemaps');
    wp_embed_register_handler('googledocs', '#https?://docs.google.com/(document|spreadsheet|presentation)/.*#i', 'wpgo_embed_handler_googledrive');
}

/**
 * The Google Maps embed handler callback. Google Maps does not support oEmbed.
 *
 * @see WP_Embed::register_handler()
 * @see WP_Embed::shortcode()
 *
 * @param array  $matches The regex matches from the provided regex when calling {@link wp_embed_register_handler()}.
 * @param array  $attr    Embed attributes.
 * @param string $url     The original URL that was matched by the regex.
 * @param array  $rawattr The original unmodified attributes.
 *
 * @return string The embed HTML.
 */
function wpgo_embed_handler_googlemaps($matches, $attr, $url, $rawattr)
{
    if (!empty($rawattr['width']) && !empty($rawattr['height'])) {
        $width = (int) $rawattr['width'];
        $height = (int) $rawattr['height'];
    } else {
        list($width, $height) = wp_expand_dimensions(425, 326, $attr['width'], $attr['height']);
    }

    return apply_filters('embed_googlemaps', "<iframe width='{$width}' height='{$height}' frameborder='0' scrolling='no' marginheight='0' marginwidth='0' src='{$url}&output=embed'></iframe>");
}

/**
 * The Google Drive embed handler callback. Google Drive does not support oEmbed.
 * Handles documents, spreadsheets, and presentations from Google Drive.
 *
 * @see WP_Embed::register_handler()
 * @see WP_Embed::shortcode()
 *
 * @param array  $matches The regex matches from the provided regex when calling {@link wp_embed_register_handler()}.
 * @param array  $attr    Embed attributes.
 * @param string $url     The original URL that was matched by the regex.
 * @param array  $rawattr The original unmodified attributes.
 *
 * @return string The embed HTML.
 */
function wpgo_embed_handler_googledrive($matches, $attr, $url, $rawattr)
{
    if (!empty($rawattr['width']) && !empty($rawattr['height'])) {
        $width = (int) $rawattr['width'];
        $height = (int) $rawattr['height'];
    } else {
        list($width, $height) = wp_expand_dimensions(425, 344, $attr['width'], $attr['height']);
    }

    $extra = '';
    if ($matches[1] == 'spreadsheet') {
        $url .= '&widget=true';
    } elseif ($matches[1] == 'document') {
        $url .= '?embedded=true';
    } elseif ($matches[1] == 'presentation') {
        $url = str_replace('/pub', '/embed', $url);
        $extra = 'allowfullscreen="true" mozallowfullscreen="true" webkitallowfullscreen="true"';
    }

    return apply_filters('embed_googledrive', "<iframe width='{$width}' height='{$height}' frameborder='0' src='{$url}' {$extra}></iframe>");
}
