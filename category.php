<?php get_header(); ?>
<?php if (have_posts()) : ?>
	<?php include (TEMPLATEPATH . '/ads/ads-tous-talents.php'); ?>
	<?php include (TEMPLATEPATH . '/filter-reg.php'); ?>
	<div class="thumb">
		<ul class="thumbcontainer">
			<?php while (have_posts()) : the_post(); ?>
			<?php $region 		 = get_post_meta($post->ID,'_region',true) ?>
			<li <?php post_class('region-' . $region ); ?> itemscope itemtype="http://data-vocabulary.org/Organization">
				<div class="holder">
				<span class="adherents-img-fx"></span>
				<a  itemprop="url" href="<?php the_permalink() ?>" rel="bookmark">
				<?php if(has_post_thumbnail()) {		
				the_post_thumbnail('talent');
				} else {
				?>
					<img src="http://placehold.it/247x154/ffffff/000000">
				<?php
				}?>			
				</a>		
				<div class="info">
				<h2 itemprop="name"><a  itemprop="url" href="<?php the_permalink() ?>" rel="bookmark"><?php the_titlesmall('', '...', true, '35'); ?></a></h2>
					<div class="sub-content">
					
						<div>
						 <?php   
						$rue     		 = get_post_meta($post->ID,'_rue',true);
						$codepostal  	 = get_post_meta($post->ID,'_code_postal',true);
						$ville 			 = get_post_meta($post->ID,'_ville',true);
						$tel      		 = get_post_meta($post->ID,'_tel',true);


						echo '<div class="adresse-block" itemprop="address" itemscope itemtype="http://data-vocabulary.org/Address">';
						echo '<span class="bloc" itemprop="street-address">'.$rue.'</span>' ;
						echo '<span class="ad-bloc" itemprop="postal-code">'.$codepostal.'</span>';
						echo '<span itemprop="locality">'.$ville.'</span>';
						echo '<span class="bloc" itemprop="phone">'.$tel.'</span>';
						echo '</div>'; 
						?>
						</div>

					</div>
				
				</div>		
				</div>
			</li>
			<?php endwhile; ?>
		</ul>
	</div>	
		

		<div class="pagination">
    	   <span class="older"><?php next_posts_link('&laquo; Older Entries') ?></span>
    	   <span class="newer"><?php previous_posts_link('Newer Entries &raquo;') ?></span>
    	</div>

	<?php else :

		if ( is_category() ) { // If this is a category archive
			printf("<h2>Sorry, but there aren't any posts in the %s category yet.</h2>", single_cat_title('',false));
		} else if ( is_date() ) { // If this is a date archive
			echo("<h2>Sorry, but there aren't any posts with this date.</h2>");
		} else if ( is_author() ) { // If this is a category archive
			$userdata = get_userdatabylogin(get_query_var('author_name'));
			printf("<h2>Sorry, but there aren't any posts by %s yet.</h2>", $userdata->display_name);
		} else {
			echo("<h2>No posts found.</h2>");
		}
		
	endif;
?>


<?php get_footer(); ?>