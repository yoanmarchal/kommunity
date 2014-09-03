<?php
/*
Template Name: All Authors Template 
*/
?>
<?php get_header(); ?>

<?php

   	$curauth = $wp_query->get_queried_object();
    $Nom = $curauth->first_name; 
	$Prenom = $curauth->last_name; 
	

	echo "<pre>";
	print_r($curauth);
	echo "</pre>";
?>

<div class="postauthor col-md-12" itemscope itemtype="http://schema.org/LocalBusiness">
<!-- model microdata 

	<div>Email: <span itemprop="email">email</span></div>


	<meta itemprop="openingHours"  style='display: none'  datetime="Mo,Tu,We,Th,Fr,Sa,Su 09:00-21:00" />



-->
	<h1 itemprop="name">
		<?php 
	    get_Author_Nicename($curauth); ?>
	</h1>


	<div class="row">
	<sidebar class="col-md-4">
		<figure id="profile_image">
			<?php get_Autor_Avatar($curauth);	?>
		</figure>		

		<?php  get_Author_Infos($curauth); ?>

		<?php if(get_user_social_link($curauth)){		?>
		<h2>Liens</h2>
		<ul>
			<li>
			<?php // show socials links if have any social link
			get_user_social_link($curauth); ?>
			</li>
		</ul>
		<?php
		}?>

		<?php get_author_horaires($curauth); ?>

		<?php include (TEMPLATEPATH . '/share.php'); ?>
	</sidebar>

	<div class="col-md-8">

	<ul class="nav nav-tabs" id="myTab">
	  <li class="active"><a href="#home" data-toggle="tab">profil</a></li>
	  <li><a href="#bonplans" data-toggle="tab">bons plans</a></li>
	  <li><a href="#videos" data-toggle="tab">vidéos</a></li>
	  <li><a href="#photos" data-toggle="tab">photos</a></li>
	</ul>
	 
	<div class="tab-content">
	  	<div class="tab-pane active" id="home">
			<?php 
			$rue = $curauth->address;
			$ville   = $curauth->city;  
			$codepostal = $curauth->postalcode;
			$region = $curauth->region;


			if ( $rue && $codepostal && $ville && $region) {
			?>

			<iframe class="map" width="100%" height="310" frameborder="0" scrolling="no" marginheight="0" marginwidth="0"src="https://maps.google.com/maps?f=q&amp;source=s_q&amp;hl=fr&amp;geocode=&amp;q=<?php echo $rue,"+".$ville,"+".$codepostal ; ?>&amp;aq=0&amp;ie=UTF8&amp;hq=&amp;hnear=<?php echo $rue,"+".$ville,"+".$codepostal ; ?>&amp;t=m&amp;z=14&amp;output=embed"></iframe>


			<?php 	
			} ?>

			<div id="description" class="pad-10-0"><?php

				$user_description = $curauth->description;
				$user_description = make_clickable($user_description);
				$user_description = stripslashes($user_description);
				
				$user_description = preg_replace('/(<[^>]+) style=".*?"/i', '$1', $user_description);

			    // removing all tags apart from paragraphs:
			    
			    echo strip_tags($user_description,'<p>');	    
			 
				  ?>
			</div>




	  </div>


	  <div class="tab-pane" id="bonplans">

	  	<?php
	  	global $query_string;
		query_posts( $query_string . '&post_type=bonplan' );
		?>

		<ul  class="list-unstyled">
			<?php	get_template_part( 'loop' ); ?>
			<?php wp_reset_query();?>
		</ul>
	  </div>

	  <div class="tab-pane" id="videos">
	  		<?php 
			global $query_string;
			query_posts( $query_string . '&post_type=video' );
			?>
			<ul  class="list-unstyled">

			<?php	get_template_part( 'loop' ); ?>

			<?php wp_reset_query();?>
			</ul>
	  </div>

	  <div class="tab-pane" id="photos">
		<?php 
			global $query_string;
			query_posts( $query_string . '&post_type=photo' );
		?>
		<ul  class="list-unstyled">

		<?php	get_template_part( 'loop' ); ?>

		<?php wp_reset_query();?>
		</ul>
	  </div>


	</div>




	

	</div>
    

	
</div>


<?php get_footer(); ?>