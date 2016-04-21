<?php get_header(); ?>
<article itemscope itemtype="http://data-vocabulary.org/Event" role="article">
	<?php if (have_posts()) : ?>  
	<?php while (have_posts()) : the_post(); ?>
	<header>
		<h1 class="col-md-12" itemprop="summary"><?php wp_title(''); ?></h1>
	</header>
	<section class="col-md-9">
		<section id="media">
			<?php get_the_slider(); ?>
		</section>

		<section class="btn-toolbar">
			<?php get_light_nav(); ?>
		</section>

		<div itemprop="description" class="description add-top">
			<?php the_content(); ?>
		</div>

		<aside class="date-adress-dispatcher row add-top">
			<aside class="col-md-6">
				<ul>
					<!-- date et heure du bon plan sortie -->
					<?php get_the_date_event(); ?>	
					<!-- adress du bon plan sortie -->
					<?php get_full_adress(); ?>
				</ul>
			</aside>

			<aside class="col-md-6 last">
				<?php get_the_map(); ?>		
			</aside>

		</aside>

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

		<?php
            if (get_related_post_type()) {
                echo get_related_post_type();
            } else {
                echo get_related_category();
            }
        ?>

    	<?php endwhile; ?>
      
    <?php else : ?>
    
        <h1>Uh oh...</h1>
    
    <?php endif; ?>
	
	<?php 
        // Prevent weirdness
        wp_reset_postdata(); ?>
	</section> <!--end content  -->
	<?php include TEMPLATEPATH.'/sidebar-ads.php'; ?>
</article><!--end article  -->		
<?php include TEMPLATEPATH.'/footer-ads.php'; ?>
		</section><!--end section  -->	

<?php get_footer(); ?>