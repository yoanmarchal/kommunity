<?php

add_action('init', 'add_tag_to_cpts');
 
function add_tag_to_cpts() {
   // register_taxonomy_for_object_type('category', 'demo');
    register_taxonomy_for_object_type('post_tag', 'bonplan');
}





add_action('init', 'custom_post_type');
function custom_post_type(){


  /* pagination dans les customs post types */

  /*
  function paginate() {
    global $wp_query, $wp_rewrite;
    $wp_query->query_vars['paged'] > 1 ? $current = $wp_query->query_vars['paged'] : $current = 1;
    $pagination = array(
      'base' => @add_query_arg('page','%#%'),
      'format' => '',
      'total' => $wp_query->max_num_pages,
      'current' => $current,
      'show_all' => true,
      'type' => 'plain'
    );
    if ( $wp_rewrite->using_permalinks() ) $pagination['base'] = user_trailingslashit( trailingslashit( remove_query_arg( 's', get_pagenum_link( 1 ) ) ) . 'page/%#%/', 'paged' );
    if ( !empty($wp_query->query_vars['s']) ) $pagination['add_args'] = array( 's' => get_query_var( 's' ) );
    echo paginate_links( $pagination );
  }
  */



  function paginate($pages = '', $range = 4){  
     $showitems = ($range * 2)+1;  
 
     global $paged;
     if(empty($paged)) $paged = 1;
 
     if($pages == ''){
         global $wp_query;
         $pages = $wp_query->max_num_pages;
         if(!$pages){
             $pages = 1;
         }
     }   

     $template_link = get_template_directory_uri();
     $previous_img =  '<img src="'.$template_link.'/images/pager/previous.png">';
     $next_img =  '<img src="'.$template_link.'/images/pager/next.png">';

 
     if(1 != $pages){
         echo "<div class=\"pagination\"><ul>";


         // si on est a la page 2 on affiche fast first page
         /*
         if($paged > 2 && $paged > $range+1 && $showitems < $pages) echo "<li class=\"previous-fast\"><a href='".get_pagenum_link(1)."'>$previous_img $previous_img</a></li>";
        */

         // si on est a la page superieur a 1
         if($paged > 0 && $showitems < $pages) echo "<li class=\"previous\"><a href='".get_pagenum_link($paged - 1)."'>$previous_img</a></li>";
 
        // pour toute les pages i = le nombre de pages
         for ($i=1; $i <= $pages; $i++){

             if (1 != $pages &&( !($i >= $paged+$range+1 || $i <= $paged-$range-1) || $pages <= $showitems )) {
                 echo ($paged == $i)? "<li class=\"active\"><a >".$i."</a></li>":"<li class=\"inactive\"><a href='".get_pagenum_link($i)."' >".$i."</a></li>";
             }
         }

          // si il y as des pages apres on affiche next page 
          if ($paged < $pages && $showitems < $pages){
            echo "<li class=\"next\"><a href=\"".get_pagenum_link($paged + 1)."\">$next_img</a></li>";
          } 
 

         // si on est a la page on affiche fast last page
         /*
         if ($paged < $pages-1 &&  $paged+$range-1 < $pages && $showitems < $pages) echo "<li class=\"next-fast\"><a href='".get_pagenum_link($pages)."'>$next_img $next_img</a></li>";
         */


         echo "</div>\n";
     }
  }




  /*  photos          */
    register_post_type('photo', array( 'label' => 'Photos','description' => '','public' => true,'show_ui' => true,'show_in_menu' => true,'capability_type' => 'post','hierarchical' => false,'rewrite' => array('slug' => 'photo'),'query_var' => true,'exclude_from_search' => false,'supports' => array('title','editor','comments','thumbnail','author',),'taxonomies' => array('post_tag',),'labels' => array (
    'name' => 'Photos',
    'singular_name' => 'Photo',
    'menu_name' => 'Mes photos',
    'add_new' => 'Ajouter une photo',
    'add_new_item' => 'Ajouter une photo',
    'edit' => 'Editer',
    'edit_item' => 'Editer la photo',
    'new_item' => 'Nouvelle photo',
    'view' => 'Voir ',
    'view_item' => 'Voir la photo',
    'search_items' => 'Rechercher une photo',
    'not_found' => 'Pas de photo trouvé',
    'not_found_in_trash' => 'pas de photo trouvé dans la corbeille ',
    'parent' => 'photo parente',
  ),) );	


  
   // bons plans
    register_post_type('bonplan', array( 
     'label' => 'Bons plans',
     'description' => '',
     'public' => true,
     'show_ui' => true,
     'show_in_menu' => true,
     'capability_type' => 'post',
     'hierarchical' => false,
     'rewrite' => array('slug' => ''),
     'query_var' => true,
     'exclude_from_search' => false,
     'supports' => array(
      'title',
      'editor',
      'excerpt',
      'trackbacks',
      'custom-fields',
      'comments',
      'revisions',
      'thumbnail',
      'author',
      'page-attributes',),
     'taxonomies' => array('post_tag',),'labels' => array (
    'name' => 'Bons plans',
    'singular_name' => 'Bon plan',
    'menu_name' => 'Bons plans',
    'add_new' => 'Add Bon plan',
    'add_new_item' => 'Add New Bon plan',
    'edit' => 'Edit',
    'edit_item' => 'Edit Bon plan',
    'new_item' => 'New Bon plan',
    'view' => 'View Bon plan',
    'view_item' => 'View Bon plan',
    'search_items' => 'Search Bons plans',
    'not_found' => 'No Bons plans Found',
    'not_found_in_trash' => 'No Bons plans Found in Trash',
    'parent' => 'Parent Bon plan',
  ),) );


    // video
    register_post_type('video', array(	'label' => 'Vidéos','description' => '','public' => true,'show_ui' => true,'show_in_menu' => true,'capability_type' => 'post','hierarchical' => false,'rewrite' => array('slug' => 'video', 'with_front' => true),'query_var' => true,'exclude_from_search' => false,'supports' => array('title','editor','comments','thumbnail','author',),'taxonomies' => array('category',),'labels' => array (
      'name' => 'Vidéos',
      'singular_name' => 'Vidéo',
      'menu_name' => 'Mes Vidéos',
      'add_new' => 'Ajouter une vidéo',
      'add_new_item' => 'Ajouter une vidéo',
      'edit' => 'Editer',
      'edit_item' => 'Editer la vidéo',
      'new_item' => 'Nouvelle vidéo',
      'view' => 'Voir ',
      'view_item' => 'Voir la vidéo',
      'search_items' => 'Rechercher une vidéo',
      'not_found' => 'Pas de vidéo trouvé',
      'not_found_in_trash' => 'pas de vidéo trouvé dans la corbeille ',
      'parent' => 'Vidéo parente',
    ),) );


/* nombre de CPT par page */
function arrange_post_per_page($query) {
    if (!isset($query->query_vars['posts_per_page'])
        && isset($query->query['post_type']) && $query->query['post_type'] == 'video'
        || isset($query->query['bonplan']) || isset($query->query['photo'])
    ) {
        $query->query_vars['posts_per_page'] = 5;
    }
    return $query;
}
add_filter('pre_get_posts', 'arrange_post_per_page');



/* Ajout des archives au CPT*/
function add_other_cpt_to_archives( $query ) {
  if( is_category() || is_tag() && empty( $query->query_vars['suppress_filters'] ) ) {
    $query->set( 'post_type', array(
     'post', 'bonplan'
    ));
    return $query;
  }
}
add_filter( 'pre_get_posts', 'add_other_cpt_to_archives' );




	
}