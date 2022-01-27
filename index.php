<?php get_header(); ?>
			<!--BEGIN .page-header -->
			<div class="page-header">
			    <?php $blog = get_post(get_option('page_for_posts')); ?>
                <!-- <h1 class="page-title"><?php echo $blog->post_title; ?></h1> -->
                <h1 class="page-title">Holly Go Lawly Blog</h1>

			<!--END .page-header -->
			</div>

			<!--BEGIN #primary .hfeed-->
			<div id="primary" class="hfeed">
			<?php if (have_posts()) : while (have_posts()) : the_post(); ?>

				<!--BEGIN .hentry -->
				<div <?php post_class(); ?> id="post-<?php the_ID(); ?>">
					<h2><a href="<?php the_permalink(); ?>" title="<?php printf(__('Permanent link to %s', 'framework'), get_the_title()); ?>" class="post-format"><?php echo the_title(); ?></a></h2>
					<?php 
						if ( has_post_thumbnail() ) {
						echo '<div class="featured-image">';
						the_post_thumbnail('thumbnail');
						echo '</div>'; }
					?>
					<!--BEGIN .entry-meta -->
					<div class="entry-meta">
                        <a href="<?php the_permalink(); ?>" title="<?php printf(__('Permanent link to %s', 'framework'), get_the_title()); ?>" class="post-format"><span class="post-format"></span></a>

				    <?php
				        $format = get_post_format();
				        if( false === $format ) { $format = 'standard'; }
				        if( $format == 'standard' || $format == 'gallery' || $format == 'image' || $format == 'video' || $format == 'audio' ) {
				    ?>

                        <h5><?php _e('Posted:', 'framework'); ?></h5>
                        <span class="published"><?php the_time( get_option('date_format') ); ?></span>

                        <?php the_tags('<h5>' . __('Tags:', 'framework') . '</h5><span>', '<br />', '</span>' ); ?>


					<?php } ?>

						<?php if( is_user_logged_in() ) { echo '<h5>' . __('Edit', 'framework') . '</h5>'; } ?>
						<?php edit_post_link( __('edit', 'framework'), '<span class="edit-post">[', ']</span>' ); ?>
					<!--END .entry-meta -->
					</div>

					<?php get_template_part( 'includes/' . $format ); ?>

					<!--BEGIN .entry-content -->
					<div class="entry-content">
						<?php the_content(__('Read more...', 'framework')); ?>
					<!--END .entry-content -->
					</div>

				<!--END .hentry-->
				</div>

				<?php endwhile; ?>

    			<!--BEGIN .navigation .page-navigation -->
    			<div class="navigation page-navigation">

    				<div class="nav-next">
    				    <?php if( get_next_posts_link() ) echo '<span>&larr; </span>'; ?>
    				    <?php next_posts_link(__('Older Entries', 'framework')); ?>
    				</div>
    				<div class="nav-previous">
    				    <?php previous_posts_link(__('Newer Entries', 'framework')) ?>
    				    <?php if( get_previous_posts_link() ) echo '<span> &rarr;</span>'; ?>
    				</div>

    			<!--END .navigation .page-navigation -->
    			</div>

			<?php else : ?>

				<!--BEGIN #post-0-->
				<div id="post-0" <?php post_class(); ?>>

					<h2 class="entry-title"><?php _e('Error 404 - Not Found', 'framework') ?></h2>

					<!--BEGIN .entry-content-->
					<div class="entry-content">
						<p><?php _e("Sorry, but you are looking for something that isn't here.", "framework") ?></p>
					<!--END .entry-content-->
					</div>

				<!--END #post-0-->
				</div>

			<?php endif; ?>
			<!--END #primary .hfeed-->
			</div>

<?php get_sidebar(); ?>

<?php get_footer(); ?>