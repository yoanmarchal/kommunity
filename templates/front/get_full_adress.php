<?php
function get_full_adress_profil ($curauth) {
	$rue = $curauth->address;
	$ville   = $curauth->city;  
	$codepostal = $curauth->postalcode;
	$region = $curauth->region;


	if ( $rue && $codepostal && $ville && $region) {
		echo '<adress class="adresse-block" itemprop="address" itemscope itemtype="http://data-vocabulary.org/Address"><i class="icon-map-marker"></i> <span class="ib">';
		echo '<span class="bloc" itemprop="street-address">'.$rue.'</span>' ;
		echo '<span class="ad-bloc" itemprop="postal-code">'.$codepostal.'</span>';
		echo '<span itemprop="locality">'.$ville.'</span>';
		echo '<span itemprop="addressRegion"> '.$region.'</span></span>'; 
		echo '</adress>'; 
		}
		else {
			
		}
}

function get_full_adress () {
	global $post;

$rue = get_post_meta($post->ID,'_rue',true);
$codepostal = get_post_meta($post->ID,'_code_postal',true);
$ville = get_post_meta($post->ID,'_ville',true); 
$region = get_post_meta($post->ID,'_region',true);

if ( $rue && $codepostal && $region && $ville) {
	echo '<li>' ;
	echo '<span class="adresse-block" itemprop="address" itemscope itemtype="http://data-vocabulary.org/Address"><i class="icon-globe"></i> <span class="ib">';
	echo '<span class="bloc" itemprop="street-address">'.$rue.'</span>' ;
	echo '<span class="ad-bloc" itemprop="postal-code">'.$codepostal.'</span>';
	echo '<span itemprop="locality">'.$ville.'</span>';
	echo '<span itemprop="addressRegion"> '.$region.'</span></span>';
	echo '</span>'; 
	echo '</li>' ;
	}
	else {
		
	}
}