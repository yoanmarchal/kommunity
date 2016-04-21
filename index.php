<?php get_header(); ?>
	<div class="headline col-md-12">
		<div class="wrap add-top">
			<div class="scrollbar">
				<div class="handle">
					<div class="mousearea"></div>
				</div>
			</div>
			<div class="frame oneperframe slider" id="frame">
				<ul class="clearfix">
				<?php 
                $popularpost = new WP_Query(
                    [
                        'posts_per_page' => 10,
                        'post_type'      => ['video'],
                         'meta_key'      => 'wpb_post_views_count',
                          'orderby'      => 'meta_value_num',
                           'order'       => 'ASC', ]
                    );

                while ($popularpost->have_posts()) : $popularpost->the_post(); ?>
				<li>
					<?php get_video_thumbnail_front('full'); ?>
					<div class="desc">
						<span class="btn navbar-btn btn-primary"><?php the_title(); ?>	</span>
						<div class="resume">
							<a class="btn navbar-btn btn-primary" itemprop="url" href="<?php the_permalink() ?>" rel="bookmark" title="<?php the_title(); ?>">
							Voir l'article
							</a>
						</div>
					</div>
				</li>
				<?php endwhile; ?>
				<?php	
                /* best events  */
                /*
                $home_paged = (get_query_var('paged'));

                $arguments = array(
                 'posts_per_page'=>4,
                 'post_type' => 'bonplan',
                 'post_status' => 'publish',
                 'sort_order ' => 'ASC'
                );
                query_posts($arguments);
                get_template_part( 'loop', 'bonplanhome' );
                */
                ?>
				</ul>
			</div>
		</div>
	</div>
	<header class="col-md-12 ">
		<h2>Les derniers bons plans postés</h2>
	</header>	
	<section class="col-md-9">
		<ul class="list-unstyled">
			<?php	$home_paged = (get_query_var('paged'));
                    $arguments = [
                     'posts_per_page' => 50,
                     'post_type'      => ['bonplan', 'video', 'photo'],
                     'post_status'    => 'publish',
                     'sort_order '    => 'ASC',
                    ];
                    query_posts($arguments);
                    get_template_part('loop');
            ?>
		</ul>
	</section>
	<?php include TEMPLATEPATH.'/sidebar-ads.php'; ?>
	<?php include TEMPLATEPATH.'/footer-ads.php'; ?>
<?php get_footer(); ?>