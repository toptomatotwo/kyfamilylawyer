<?php get_header(); ?>
<?php /* Get author data */
	if(get_query_var('author_name')) :
	$curauth = get_userdatabylogin(get_query_var('author_name'));
	else :
	$curauth = get_userdata(get_query_var('author'));
	endif;
?>

            <!-- BEGIN .page-header -->
            <div class="page-header">

            <?php $post = $posts[0]; // Hack. Set $post so that the_date() works. ?>
	 	  	<?php /* If this is a category archive */ if (is_category()) { ?>
				<h1 class="page-title"><?php printf(__('All posts in %s', 'framework'), single_cat_title('',false)); ?></h1>
	 	  	<?php /* If this is a tag archive */ } elseif( is_tag() ) { ?>
				<h1 class="page-title"><?php printf(__('All posts tagged %s', 'framework'), single_tag_title('',false)); ?></h1>
	 	  	<?php /* If this is a daily archive */ } elseif (is_day()) { ?>
				<h1 class="page-title"><?php _e('Archive for', 'framework') ?> <?php the_time('F jS, Y'); ?></h1>
	 	 	 <?php /* If this is a monthly archive */ } elseif (is_month()) { ?>
				<h1 class="page-title"><?php _e('Archive for', 'framework') ?> <?php the_time('F, Y'); ?></h1>
	 		<?php /* If this is a yearly archive */ } elseif (is_year()) { ?>
				<h1 class="page-title"><?php _e('Archive for', 'framework') ?> <?php the_time('Y'); ?></h1>
		  	<?php /* If this is an author archive */ } elseif (is_author()) { ?>
				<h1 class="page-title"><?php _e('All posts by', 'framework') ?> <?php echo $curauth->display_name; ?></h1>
	 	  	<?php /* If this is a paged archive */ } elseif (isset($_GET['paged']) && !empty($_GET['paged'])) { ?>
				<h1 class="page-title"><?php _e('Blog Archives', 'framework') ?></h1>
	 	  	<?php } ?>

            </div>
            <!-- END .page-header -->

			<!--BEGIN #primary .hfeed-->
			<div id="primary" class="hfeed">
			<?php if (have_posts()) : while (have_posts()) : the_post(); ?>

    			<!--BEGIN .hentry -->
    			<div <?php post_class(); ?> id="post-<?php the_ID(); ?>">
                    <h2><a href="<?php the_permalink(); ?>" title="<?php printf(__('Permanent link to %s', 'framework'), get_the_title()); ?>" class="post-format"><?php echo the_title(); ?></a></h2>

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

			<?php else :

			if ( is_category() ) { // If this is a category archive
				printf(__('<h2>Sorry, but there aren\'t any posts in the %s category yet.</h2>', 'framework'), single_cat_title('',false));
			} elseif ( is_tag() ) { // If this is a tag archive
			    printf(__('<h2>Sorry, but there aren\'t any posts tagged %s yet.</h2>', 'framework'), single_tag_title('',false));
			} elseif ( is_date() ) { // If this is a date archive
				echo(__('<h2>Sorry, but there aren\'t any posts with this date.</h2>', 'framework'));
			} elseif ( is_author() ) { // If this is a category archive
				$userdata = get_userdatabylogin(get_query_var('author_name'));
				printf(__('<h2>Sorry, but there aren\'t any posts by %s yet.</h2>', 'framework'), $userdata->display_name);
			} else {
				echo(__('<h2>No posts found.</h2>', 'framework'));
			}

			endif; ?>

			<!--END #primary .hfeed-->
			</div>

<?php get_sidebar(); ?>

<?php get_footer(); ?>