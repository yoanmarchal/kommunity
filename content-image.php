<?php
/**
 * The template for displaying posts in the Image Post Format on index and archive pages.
 *
 * Learn more: http://codex.wordpress.org/Post_Formats
 *
 * @since Twenty Eleven 1.0
 */
?>
	<article id="post-<?php the_ID(); ?>" <?php post_class('indexed'); ?>>
		<header class="entry-header">
			<hgroup>
				<h2 class="entry-title"><a href="<?php the_permalink(); ?>" title="<?php printf(esc_attr__('Permalink to %s', 'Kommunity'), the_title_attribute('echo=0')); ?>" rel="bookmark"><?php the_title(); ?></a></h2>
				<h3 class="entry-format"><?php _e('Image', 'Kommunity'); ?></h3>
			</hgroup>

			<?php if (comments_open() && !post_password_required()) : ?>
			<div class="comments-link">
				<?php comments_popup_link('<span class="leave-reply">'.__('Reply', 'Kommunity').'</span>', _x('1', 'comments number', 'Kommunity'), _x('%', 'comments number', 'Kommunity')); ?>
			</div>
			<?php endif; ?>
		</header><!-- .entry-header -->

		<div class="entry-content">
			<?php the_content(__('Continue reading <span class="meta-nav">&rarr;</span>', 'Kommunity')); ?>
			<?php wp_link_pages(['before' => '<div class="page-link"><span>'.__('Pages:', 'Kommunity').'</span>', 'after' => '</div>']); ?>
		</div><!-- .entry-content -->

		<footer class="entry-meta">
			<div class="entry-meta">
				<?php
                    printf(__('<a href="%1$s" rel="bookmark"><time class="entry-date" datetime="%2$s" pubdate>%3$s</time></a><span class="by-author"> <span class="sep"> by </span> <span class="author vcard"><a class="url fn n" href="%4$s" title="%5$s" rel="author">%6$s</a></span></span>', 'Kommunity'),
                        esc_url(get_permalink()),
                        get_the_date('c'),
                        get_the_date(),
                        esc_url(get_author_posts_url(get_the_author_meta('ID'))),
                        sprintf(esc_attr__('View all posts by %s', 'Kommunity'), get_the_author()),
                        get_the_author()
                    );
                ?>
			</div><!-- .entry-meta -->
			<div class="entry-meta">
				<?php
                    /* translators: used between list items, there is a space after the comma */
                    $categories_list = get_the_category_list(__(', ', 'Kommunity'));
                    if ($categories_list):
                ?>
				<span class="cat-links">
					<?php printf(__('<span class="%1$s">Posted in</span> %2$s', 'Kommunity'), 'entry-utility-prep entry-utility-prep-cat-links', $categories_list); ?>
				</span>
				<?php endif; // End if categories?>
				<?php
                    /* translators: used between list items, there is a space after the comma */
                    $tags_list = get_the_tag_list('', __(', ', 'Kommunity'));
                    if ($tags_list): ?>
				<span class="tag-links">
					<?php printf(__('<span class="%1$s">Tagged</span> %2$s', 'Kommunity'), 'entry-utility-prep entry-utility-prep-tag-links', $tags_list); ?>
				</span>
				<?php endif; // End if $tags_list?>

				<?php if (comments_open()) : ?>
				<span class="comments-link"><?php comments_popup_link('<span class="leave-reply">'.__('Reply', 'Kommunity').'</span>', __('<strong>1</strong> Reply', 'Kommunity'), __('<strong>%</strong> Replies', 'Kommunity')); ?></span>
				<?php endif; // End if comments_open()?>
			</div><!-- .entry-meta -->

			<?php edit_post_link(__('Edit', 'Kommunity'), '<span class="edit-link">', '</span>'); ?>
		</footer><!-- #entry-meta -->
	</article><!-- #post-<?php the_ID(); ?> -->