<?php

function get_related_post_type() {
    global $authordata, $post;
    $post_type = get_post_type();
    $authors_posts = get_posts( array( 
        'author' => $authordata->ID,
        'post__not_in' => array( $post->ID ),
        'post_type' => $post_type,
        'posts_per_page' => 10 
    ));

    $nbArt = count($authors_posts); 
    if(!empty($authors_posts) && $nbArt > 3){ 
    /* l'auteur du post as dautre autre aticle du même type
    si le nombre d'article attaché est superieur a 6 alors un affiche le carousel */
        $output ='<aside class="featured add-top">';
        $output .='<h4>Les '.$post_type.'s du même auteur</h4>';
        $output .= '<div class="swiper-container swiper-car"><a class="swiper-nav arrow-left" href="#"></a> <a class="swiper-nav arrow-right" href="#"></a><div class="swiper-wrapper">';
        foreach ( $authors_posts as $authors_post ) {
            $img = get_the_post_thumbnail( $authors_post->ID, 'thumb');

            $output .= '<div class="swiper-slide"><a href="'. get_permalink( $authors_post->ID ) .'">' ;    /* lien */
            if($img){
                $output .= '<figure>'. get_the_post_thumbnail( $authors_post->ID, 'full');   /* image */
            } else {
                 $output .= '<figure><img src="'. get_bloginfo('template_url') .'/assets/images/base/kommunity-banner.svg" itemprop="contentURL">';
                 /* image */
            }
            

            $output .= '<figcaption><span class="title">'. apply_filters( 'the_title', $authors_post->post_title, $authors_post->ID ) .'</span>';    /* titre */
            $output .= '<time class="time">Le <meta itemprop="datePublished" content="'. $authors_post->post_date .'">'. isodate2fr($authors_post->post_date) .'</time>';
            $output .= '<span class="author">'. get_the_author_meta( $authors_post->ID, 'nickname') .'</span>';    /* auteur */
            $output .= '</figcaption></figure>';
            $output .= '</a></div>';
        }
        $output .= '</div></div><div class="pagination-car"></div></aside>';

        return $output;


    } else {
    // l'auteur du post n'as pas d'autre autre aticle du même type
        /*  prevoir redirection vers fonction get_related post -> categorie */

        return false;
    }  
}


function get_related_category() {
    global $authordata, $post;
    $categories = get_the_category($post->ID);
    $post_type = get_post_type();
    $authors_posts = get_posts( array( 
        'cat' => $categories,
        'post__not_in' => array( $post->ID ),
        'post_type' => $post_type,
        'posts_per_page' => 10 
    ));

    $nbArt = count($authors_posts); 
    if(!empty($authors_posts) && $nbArt > 3){ 
    /* l'auteur du post as dautre autre aticle du même type
    si le nombre d'article attaché est superieur a 6 alors un affiche le carousel */
        $output ='<aside class="featured">';
        $output .='<h4>Les '.$post_type.'s dans la même catégorie</h4>';
        $output .= '<div class="swiper-container swiper-car"><a class="swiper-nav arrow-left" href="#"></a> <a class="swiper-nav arrow-right" href="#"></a><div class="swiper-wrapper">';
        foreach ( $authors_posts as $authors_post ) {
            $output .= '<div class="swiper-slide"><a href="'. get_permalink( $authors_post->ID ) .'">' ;    /* lien */
            $output .= '<figure>'. get_the_post_thumbnail( $authors_post->ID, 'thumb');   /* image */
            $output .= '<figcaption><span class="title">'. apply_filters( 'the_title', $authors_post->post_title, $authors_post->ID ) .'</span>';    /* titre */
            $output .= '<time class="time">Le <meta itemprop="datePublished" content="'. $authors_post->post_date .'">'. isodate2fr($authors_post->post_date) .'</time>';
            $output .= '<span class="author">'. get_the_author_meta($authors_post->ID, 'nickname') .'</span>';    /* auteur */
            $output .= '</figcaption></figure>';
            $output .= '</a></div>';
        }
        $output .= '</div></div><div class="pagination-car"></div></aside>';

        return $output;


    } else {
    // l'auteur du post n'as pas d'autre autre aticle du même type
        /*  prevoir redirection vers fonction get_related post -> categorie */

        return false;
    }  
}


/*


function get_related_author_image() {
    global $authordata, $post;
    $authors_posts = get_posts( array( 
        'author' => $authordata->ID,
    	'post__not_in' => array( $post->ID ),
    	'post_type' => 'photo',
    	'posts_per_page' => 6 
    ));





    if(!empty($authors_posts)){
        $output ='<h4>Les photos du même auteur</h4><div class="swiper-container swiper-car"><div class="pagination-car"></div>';
        $output .= '<div class="swiper-wrapper">';
        foreach ( $authors_posts as $authors_post ) {
    		$output .= '<div class="swiper-slide"><a href="'. get_permalink( $authors_post->ID ) .'">' ;
            $output .= '<figure>'. get_the_post_thumbnail( $authors_post->ID, 'thumb') .'<figcaption>'. apply_filters( 'the_title', $authors_post->post_title, $authors_post->ID ) .'</figcaption></figure>';
            $output .= '</a></div>';
        }
        $output .= '</div></div>';

        return $output;

    } else {
        return false;
    }  
}
*/



function get_related_category_image() {
    global $post;
    $categories = get_the_category($post->ID);

    $authors_posts = get_posts( array( 
    	'cat' => $categories,
    	'post__not_in' => array( $post->ID ),
    	'post_type' => 'photo',
    	'posts_per_page' => 6 
    	));
    if(!empty($authors_posts)){
        $output ='<h4>Les photos dans la même catégorie</h4><div class="swiper-container swiper-car"><div class="pagination-car"></div>';
        $output .= '<div class="swiper-wrapper">';
        foreach ( $authors_posts as $authors_post ) {
            $output .= '<div class="swiper-slide"><a href="'. get_permalink( $authors_post->ID ) .'">' ;
            $output .= '<figure>'. get_the_post_thumbnail( $authors_post->ID, 'thumb') .'<figcaption>'. apply_filters( 'the_title', $authors_post->post_title, $authors_post->ID ) .'</figcaption></figure>';
            $output .= '</a></div>';
        }
        $output .= '</div></div>';

        return $output;

    } else {
        return false;
    }  
}


function get_related_author_video() {
	// recupation des date auteur et post hors loop
    global $authordata, $post;

    $authors_posts = get_posts( array( 
    	'author' => $authordata->ID,
    	'post__not_in' => array( $post->ID ),
    	'post_type' => 'video',
    	'posts_per_page' => 6 
    ));

    if(!empty($authors_posts)){
        $output ='<h4>Les vidéos du même auteur</h4><div class="swiper-container swiper-car"><div class="pagination-car"></div>';
        $output .= '<div class="swiper-wrapper">';
        foreach ( $authors_posts as $authors_post ) {
            $output .= '<div class="swiper-slide"><a href="'. get_permalink( $authors_post->ID ) .'">';
           	$output .= '<figure>'. get_the_post_thumbnail( $authors_post->ID, 'thumb') .'<figcaption>'. apply_filters( 'the_title', $authors_post->post_title, $authors_post->ID ) .'</figcaption></figure>';
           	$output .='</a></div>';
        }
        
        $output .= '</div></div>';

        return $output;
    } else {
        return false;
    }   
}


function get_related_category_video() {
    global $post;
    $categories = get_the_category($post->ID);

    $authors_posts = get_posts( array( 
    	'cat' => $categories,
    	'post__not_in' => array( $post->ID ),
    	'post_type' => 'video',
    	'posts_per_page' => 5 
    	));

    if(!empty($authors_posts)){
        $output ='<h4>Les vidéos dans la même catégorie</h4><div class="swiper-container swiper-car"><div class="pagination-car"></div>';
        $output .= '<div class="swiper-wrapper">';
        foreach ( $authors_posts as $authors_post ) {
           $output .= '<div class="swiper-slide"><a href="'. get_permalink( $authors_post->ID ) .'">';
           $output .= '<figure>'. get_the_post_thumbnail( $authors_post->ID, 'thumb') .'<figcaption>'. apply_filters( 'the_title', $authors_post->post_title, $authors_post->ID ) .'</figcaption></figure>';
           	$output .='</a></div>';
        }
        $output .= '</div></div>';
        return $output;

    } else {
        return false;
    }
}






function get_related_author_bonsplans() {
    global $authordata, $post, $authors_post;

    $authors_posts = get_posts( array( 
    	'author' => $authordata->ID,
    	'post__not_in' => array( $post->ID ),
    	'post_type' => 'bonplan',
    	'posts_per_page' => 6 
    	));

    if(!empty($authors_posts)){
        $output ='<h4>Les bons plans du même auteur</h4><div class="swiper-container swiper-car"><div class="pagination-car"></div>';
        $output .= '<div class="swiper-wrapper">';
        foreach ( $authors_posts as $authors_post ) {
            $output .= '<div class="swiper-slide"><a href="'. get_permalink( $authors_post->ID ) .'">' ;
            $output .= '<figure>'. get_the_post_thumbnail( $authors_post->ID, 'thumb') .'<figcaption>'. apply_filters( 'the_title', $authors_post->post_title, $authors_post->ID ) .'</figcaption></figure>';
            $output .= '</a></div>';
        }
        $output .= '</div></div>';
        return $output;
    } else {
        return false;
    }
}

function get_related_category_bonsplans() {
    global $post;
    $categories = get_the_category($post->ID);

    $authors_posts = get_posts( array( 
    	'cat' => $categories,
    	'post__not_in' => array( $post->ID ),
    	'post_type' => 'bonplan',
    	'posts_per_page' => 6 
    	));

    if(!empty($authors_posts)){
        $output ='<h4>Les bons plans dans la même catégorie</h4><div class="swiper-container swiper-car"><div class="pagination-car"></div>';
        $output .= '<div class="swiper-wrapper">';
        foreach ( $authors_posts as $authors_post ) {
            $output .= '<div class="swiper-slide"><a href="'. get_permalink( $authors_post->ID ) .'">' ;
            $output .= '<figure>'. get_the_post_thumbnail( $authors_post->ID, 'thumb') .'<figcaption>'. apply_filters( 'the_title', $authors_post->post_title, $authors_post->ID ) .'</figcaption></figure>';
            $output .= '</a></div>';
        }
        $output .= '</div></div>';

        return $output;
    } else {
        return false;
    }
}
