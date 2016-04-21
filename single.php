<?php get_header(); ?>
<article role="article">
	<?php if (have_posts()) : ?>  
	<?php while (have_posts()) : the_post(); ?>
	<div class="col-md-9">
		<header>
			<h1 class="col-md-12" itemprop="summary"><?php wp_title(''); ?></h1>
		</header>	

		<section class="btn-toolbar">
			<?php get_light_nav(); ?>
		</section>

		<div itemprop="description">
			<?php the_content(); ?>
		</div>
		<footer>
			 Publié le <time datetime="<?php the_time('c'); ?>" itemprop="datePublished"> <?php the_date(); ?> à <?php the_time(); ?></time> par 
			<a itemprop="author" rel="author" href="<?php echo get_author_posts_url(get_the_author_meta('ID')); ?>">
				<span itemprop="name"><?php the_author_meta('display_name'); ?></span>
			</a>
		</footer>
		
		<div class="second-cadre">
			<p class="primary-color"></p>
			<?php comments_template(); ?>
		</div>	


<?php endwhile; ?>
      
    <?php else : ?>
    
        <h1>Uh oh...</h1>
    
    <?php endif; ?>
	
	<?php 
        // Prevent weirdness
        wp_reset_postdata(); ?>
	</div> <!--end content  -->
	<?php include TEMPLATEPATH.'/sidebar-ads.php'; ?>
</article><!--end article  -->		
<?php include TEMPLATEPATH.'/footer-ads.php'; ?>
		</section><!--end section  -->	

<?php get_footer(); ?>