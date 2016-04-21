<?php


// Define what post types to search
function searchAll($query)
{
    if ($query->is_search) {
        $query->set('post_type', ['page', 'bonplan', 'video', 'photo']);
    }

    return $query;
}

// si le resultat est unique rediriger vers la page
add_action('template_redirect', 'single_result');
function single_result()
{
    if (is_search()) {
        global $wp_query;
        if ($wp_query->post_count == 1) {
            wp_redirect(get_permalink($wp_query->posts['0']->ID));
        }
    }
}

// The hook needed to search ALL content
add_filter('the_search_query', 'searchAll');

/* met en valeur le text recherché  BUG!!!
function wps_highlight_results($text){
     if(is_search()){
     $sr = get_query_var('s');
     $keys = explode(" ",$sr);
     $text = preg_replace('/('.implode('|', $keys) .')/iu', '<strong class="search-excerpt">'.$sr.'</strong>', $text);
     }
     return $text;
}
add_filter('the_excerpt', 'wps_highlight_results');
add_filter('the_title', 'wps_highlight_results');
 */

/***********************************
*
* SEARCH FILTER
* http://speckyboy.com/2010/09/19/10-useful-wordpress-search-code-snippets/
*
***********************************/

/*
function SearchFilter($query) {
if ($query->is_search or $query->is_feed) {
// adherent
if($_GET['post_type'] == "adherents") {
$query->set('post_type', 'adherents');
}

// remises
elseif($_GET['post_type'] == "remises") {
$query->set('post_type', 'remises');
}

// remises
elseif($_GET['post_type'] == "astucestalents") {
$query->set('post_type', 'astucestalents');
}


// evenements
elseif($_GET['post_type'] == "bonsplanssorties") {
$query->set('post_type', 'bonsplanssorties');
}
// video
elseif($_GET['post_type'] == "Videos") {
$query->set('post_type', 'Videos');
}

// EVERYTHING! MWAHAHAHAHAHA
elseif($_GET['post_type'] == "all") {
$query->set('post_type', array('adherents', 'bonplans', 'bonsplanssorties', 'Videos', 'post', 'astucestalents'));
}
}
return $query;
}


*/
/*


// This filter will jump into the loop and arrange our results before they're returned
add_filter('pre_get_posts','SearchFilter');


// Define what post types to search
function searchAll( $query ) {
    if ( $query->is_search ) {
        $query->set( 'post_type', array( 'post', 'page', 'feed', 'adherents', 'remises', 'Videos', 'bonsplanssorties', 'astucestalents'));
    }
    return $query;
}

// The hook needed to search ALL content
add_filter( 'the_search_query', 'searchAll' );


*/
