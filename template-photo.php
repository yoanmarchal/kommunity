<?php
/*
Template Name: template-photo
*/
?>
<?php get_header(); ?>
		<h1 class="col-md-12"><i class="fa fa-camera-retro"></i> Photos</h1>
		<section class="col-md-9">
				<ul class="list-unstyled">
					<?php
					global $query_string;
					$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
						$arguments = array(
						 'post_type' => 'photo',
						 'post_status' => 'publish',
						 'sort_order ' => 'ASC',
						 'paged' => $paged,
							 'posts_per_page' => 5,
						);
						query_posts($arguments);
						get_template_part( 'loop');
					?>
				</ul>
			<?php paginate(); ?>
		</section>
		<?php include (TEMPLATEPATH . '/sidebar-ads.php'); ?>
		<?php include (TEMPLATEPATH . '/footer-ads.php'); ?>
<?php get_footer(); ?>