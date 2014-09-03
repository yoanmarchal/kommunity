<?php get_header(); ?>
<article itemscope itemtype="http://schema.org/ImageGallery" role="article">
	<?php if (have_posts()) : ?>  
	<?php while (have_posts()) : the_post(); ?>
	<header>
		<h1 class="col-md-12" itemprop="summary"><?php wp_title('');?></h1>
	</header>
	<div class="col-md-9">
		<section id="media">
			<?php get_the_slider(); ?>
		</section>

		<nav class="btn-toolbar">
			<?php get_light_nav(); ?>
		</nav>

		<div itemprop="description" class="description add-top">
			<?php the_content();?>
		</div>
		
		<footer>
			Publié il y a <meta itemprop="datePublished" content="<?php the_date(); ?>"><?php echo human_time_diff(get_the_time('U'), current_time('timestamp')); ?> par 
			<a itemprop="author" rel="author" href="<?php echo get_author_posts_url(get_the_author_meta( 'ID' )); ?>">
				<span itemprop="name"><?php the_author_meta('display_name'); ?></span>
			</a>
		</footer>
			
			<?php endwhile; ?>
			
		<?php else : ?>
		
			<h1>Uh oh...</h1>
		
		<?php endif;
			wp_reset_postdata();	?>

		<div class="second-cadre">
			<p class="primary-color"></p>
			<?php comments_template(); ?>
		</div>	


		<?php
	if(get_related_post_type()){
		echo get_related_post_type();
	} else {
		
		echo get_related_category();

	}   ?>

	</div>
	<?php include (TEMPLATEPATH . '/sidebar-ads.php'); ?>
	
</article>
		<?php include (TEMPLATEPATH . '/footer-ads.php'); ?>
</section>	
<?php get_footer(); ?>