<?php get_header(); ?>
    <!--BEGIN .page-header -->
    <div class="page-header">
        <h1 class="page-title"><?php the_title(); ?></h1>
        <?php if ( current_user_can( 'edit_post', $post->ID ) ): 
    	    edit_post_link( __('edit', 'framework'), '<span class="edit-post">[', ']</span>' );
    	endif; ?>
    <!--END .page-header -->
    </div>

	<!--BEGIN #primary .hfeed-->
	<div id="primary" class="hfeed">
	<?php if (have_posts()) : while (have_posts()) : the_post(); ?>

		<!--BEGIN .hentry-->
		<div <?php post_class() ?> id="post-<?php the_ID(); ?>">

			<!--BEGIN .entry-content -->
			<div class="entry-content">
				<?php the_content(); ?>
				<?php wp_link_pages(array('before' => '<p><strong>'.__('Pages:', 'framework').'</strong> ', 'after' => '</p>', 'next_or_number' => 'number')); ?>
			<!--END .entry-content -->
			</div>

		<!--END .hentry-->
		</div>
		
		<?php comments_template('', true); ?>

		<?php endwhile; endif; ?>
	
	<!--END #primary .hfeed-->
	</div>
			
<?php get_sidebar(); ?>

<?php get_footer(); ?>