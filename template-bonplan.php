<?php
/*
Template Name: template bonplan
*/
?>
<?php get_header(); ?>
		<h1 class="col-md-12"><i class="fa fa-tag"></i> Bons plans</h1>
		<section class="col-md-9">
			<?php include TEMPLATEPATH.'/filter.php'; ?>
				<ul class="list-unstyled">
				<?php
                    $home_paged = (get_query_var('paged'));
                    $arguments = [
                     'post_type'   => 'bonplan',
                     'post_status' => 'publish',
                     'sort_order ' => 'ASC',
                     'paged'       => $home_paged,
                    ];
                    query_posts($arguments);
                    get_template_part('loop');
                ?>
				</ul>
				<?php paginate(); ?>
				
		</section>
		<?php include TEMPLATEPATH.'/sidebar-ads.php'; ?>

	<?php include TEMPLATEPATH.'/footer-ads.php'; ?>
<?php get_footer(); ?>