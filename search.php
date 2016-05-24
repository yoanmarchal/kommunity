<?php
/**
 * The template for displaying Search Results pages.
 *
 * @since Twenty Eleven 1.0
 */
get_header(); ?>
<?php
/* recuperation de la variable de recherche */
$s = esc_html($s, 1);
/* Template Name: Search Results */
$search_refer = isset($_GET['post_type']);
if ($search_refer == 'bonplan') {
    load_template(TEMPLATEPATH.'/template_search_bonplan.php');
} elseif ($search_refer == 'video') {
    load_template(TEMPLATEPATH.'/template_search_video.php');
} elseif ($search_refer == 'photo') {
    load_template(TEMPLATEPATH.'/template_search_photo.php');
}
?>

<header class="page-header  col-md-12">
	<h1 class="page-title"><?php printf(__('Resultat de recherche pour : %s', 'Kommunity'), '<span>'.get_search_query().'</span>'); ?></h1>
</header>

	<div id="content" role="main" class="col-md-9">
	<?php if (have_posts()) : ?>
	<?php /* Start the Loop */ ?>
		<ul class="list-unstyled">
			<?php while (have_posts()) : the_post(); ?>
			<?php $region = get_post_meta($post->ID, '_region', true) ?>
			<li <?php post_class('region-'.$region); ?>>
			
			<?php	if (has_post_thumbnail()) { // check if the post has a Post Thumbnail assigned to it.
            ?>
				<figure class="col-md-3">
				<?php the_post_thumbnail();
    ?>
				</figure>
				<?php 
}?>

				<div class="text-hentry col-md-9">
					<a href="<?php the_permalink() ?>" class="entry-title"><?php the_title(); ?></a><br>
					 <?php the_excerpt(); ?> <br>
					<?php 
                    $debut_date = get_post_meta($post->ID, '_debut_date', true);
                    $debut_heure = get_post_meta($post->ID, '_debut_heure', true);
                    $fin_date = get_post_meta($post->ID, '_fin_date', true);
                    $fin_heure = get_post_meta($post->ID, '_fin_heure', true);

                    if ($debut_date && $fin_date) {
                        echo '<span>Du <time datetime="'.$debut_date.'">'.$debut_date.'</time><time datetime="'.$debut_heure.'"> '.$debut_heure.' </time> ';
                        echo 'au <time datetime="'.$fin_date.'">'.$fin_date.'</time><time datetime="'.$fin_heure.'"> '.$fin_heure.' </time></span><br>';
                    } else {
                    }

                    ?>
					
					<?php 

                    $rue = get_post_meta($post->ID, '_rue', true);
                    $codepostal = get_post_meta($post->ID, '_code_postal', true);
                    $ville = get_post_meta($post->ID, '_ville', true);
                    $region = get_post_meta($post->ID, '_region', true);

                    if ($rue && $codepostal && $ville) {
                        echo '<span class="adresse-block" itemprop="address" itemscope itemtype="http://data-vocabulary.org/Address">';
                        echo '<span class="bloc" itemprop="street-address">'.$rue.'</span>';
                        echo '<span class="ad-bloc" itemprop="postal-code">'.$codepostal.'</span>';
                        echo '<span itemprop="locality">'.$ville.'</span><span itemprop="addressRegion"> '.$region.'</span>';
                        echo '</span>';
                    } else {
                    }
                    ?>		
				</div>
		
			</li>
					
	<?php endwhile; ?>
	</ul>
	<?php else : ?>

		<article id="post-0" class="post no-results not-found">
			<header class="entry-header">
				<h1 class="entry-title"><?php _e('Aucun contenu', 'Kommunity'); ?></h1>
			</header><!-- .entry-header -->

			<div class="entry-content">
				<p><?php _e('Desole, mais aucun contenu trouve .Veuillez reessayer avec un mot clef different', 'Kommunity'); ?></p>
			</div><!-- .entry-content -->
		</article><!-- #post-0 -->

	<?php endif; ?>
		

	
		<div class="clear"></div>
	</div><!-- #content -->
	<?php include TEMPLATEPATH.'/sidebar-ads.php'; ?>
	<?php include TEMPLATEPATH.'/footer-ads.php'; ?>
	
</section>

<?php get_footer(); ?>