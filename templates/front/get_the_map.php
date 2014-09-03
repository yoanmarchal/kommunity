<?php
function get_the_map_user($curauth) {
	$rue = 	$curauth->address;
	$ville   = $curauth->city;  
	$codepostal = $curauth->postalcode;
	$region = $curauth->region;

	if ( $rue && $codepostal && $ville && $region) {
		echo '<adress class="adresse-block" itemprop="address" itemscope itemtype="http://data-vocabulary.org/Address"><i class="icon-globe"></i> <span class="ib">';
		echo '<span class="bloc" itemprop="street-address">'.$rue.'</span>' ;
		echo '<span class="ad-bloc" itemprop="postal-code">'.$codepostal.'</span>';
		echo '<span itemprop="locality"> '.$ville.'</span>';
		echo '<span itemprop="addressRegion"> '.$region.'</span></span>'; 
		echo '</adress>'; 
		}
		else {
			
		}
}


function get_the_map() {
	global $post;
	$rue = get_post_meta($post->ID,'_rue',true);
	$codepostal = get_post_meta($post->ID,'_code_postal',true);
	$ville = get_post_meta($post->ID,'_ville',true); 
	$region = get_post_meta($post->ID,'_region',true);

	if ( $rue && $codepostal && $ville && $region) {
		?>

		<img src="http://maps.googleapis.com/maps/api/staticmap?center=<?php echo $rue,"+".$ville,"+".$codepostal ; ?>&amp;&markers=<?php echo $rue,"+".$ville,"+".$codepostal ; ?>&amp;zoom=15&amp;size=870x300&amp;maptype=hybrid&amp;sensor=false" alt="placeholder+image">
		<?php 
	} else {
		return false;
	}
}
