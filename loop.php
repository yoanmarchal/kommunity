<?php if (have_posts()) : ?>

	<?php while (have_posts()) : the_post(); ?>

	<li itemscope itemtype="http://schema.org/Movie" id="post-<?php the_ID(); ?>" class="row add-bottom">

		<?php if(has_post_thumbnail()) 	{ ?>
			<a  itemprop="url" href="<?php the_permalink() ?>" rel="bookmark" >
				<?php get_the_thumbnail_front('col-md-3'); ?>
			</a>
		<?php } else { ?>

		<figure class="col-md-3">
			<a  itemprop="url" href="<?php the_permalink() ?>" rel="bookmark" >
				<img src="<?php echo get_bloginfo('template_url'); ?>/assets/images/base/kommunity-banner.svg" itemprop="contentURL">
			</a>
		</figure>

		<?php } ?>

		<div class="col-md-9">

			
				<h3 itemprop="name">
					<?php the_title(); ?>
				</h3>
				<i>Publié il y a <meta itemprop="datePublished" content="<?php the_date(); ?>"><?php echo human_time_diff(get_the_time('U'), current_time('timestamp')); ?> par 

				<a itemprop="author" rel="author" href="<?php echo get_author_posts_url(get_the_author_meta( 'ID' )); ?>">

					<span itemprop="name"><?php the_author_meta('display_name'); ?></span>

				</a>

				</i>

			<article>

									<!-- date et heure du bon plan sortie -->

					<?php  

					$debut_date = get_post_meta($post->ID,'_debut_date',true);
					$debut_heure   = get_post_meta($post->ID,'_debut_heure',true);  
					$fin_date = get_post_meta($post->ID,'_fin_date',true);
				    $fin_heure  = get_post_meta($post->ID,'_fin_heure',true);
					//  $debut_date =  isodate2fr($debut_date);
				    //	$fin_date	=  isodate2fr($fin_date);

					if ( $debut_date && $fin_date && $debut_heure && $fin_heure ) {
						echo '<i class="icon-calendar"></i><span>Du <time itemprop="startDate">'.$debut_date.'</time><time> '.$debut_heure.' </time> ';
						echo 'au <time itemprop="endDate">'.$fin_date.'</time><time> '.$fin_heure.' </time></span>';
					}


					// ?>	


					<!-- adress du bon plan sortie -->

					<?php  

					$ville 		= get_post_meta($post->ID,'_ville',true); 

							
					if ($ville) {
						echo '<span class="adresse-block" itemprop="address" itemscope itemtype="http://data-vocabulary.org/Address"><i class="icon-globe"></i>';
						echo '<span itemprop="locality">'.$ville.'</span>';
						echo '</span>'; 
					} 

					?>

				<?php the_excerpt()?>
				<a  itemprop="url" href="<?php the_permalink() ?>" rel="bookmark" class="btn clearfix">
					Continuer à lire 
				</a>

			</article>
		</div>

		<?php show_edit_button(); ?>

	</li>		

	<?php endwhile; ?>

<?php else : ?>

    <h1>Aucune vidéo</h1>

<?php endif; ?>