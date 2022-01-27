<?php get_header(); ?>

            <?php $term = get_term_by( 'slug', get_query_var( 'term' ), get_query_var( 'taxonomy' ) ); ?>

            <!--BEGIN .page-header -->
			<div class="page-header">
			    
			    <h1 class="page-title"><?php echo $term->name; ?></h1>
			    
			<!--END .page-header -->
			</div>
			
            <!--BEGIN #primary .hfeed-->
			<div id="primary" class="hfeed isotope">

		    <?php 
            query_posts( array(
                'post_type' => 'portfolio',
                'orderby' => 'menu_order',
                'order' => 'ASC',
                'posts_per_page' => -1,
                'portfolio-type' => $term->slug
                )
		    );
		    
		    $i = 0;
			while ( have_posts() ) : the_post(); ?>

				<?php $last = ( $i%4 == 3 ) ? ' last' : ''; ?>
				
				<!--BEGIN .hentry -->
				<div <?php post_class("isotope-item $last"); ?> id="post-<?php the_ID(); ?>">				
				    <?php if ( (function_exists('has_post_thumbnail')) && (has_post_thumbnail()) ) { ?>
					<div class="post-thumb">
						<a title="<?php printf(__('Permanent Link to %s', 'framework'), get_the_title()); ?>" href="<?php the_permalink(); ?>">
                            <span class="post-thumb-overlay"><?php _e('View Project', 'framework'); ?></span>
						    <?php the_post_thumbnail('portfolio-thumb'); ?>
						</a>
					</div>
					<?php } ?>
					
					<h2 class="entry-title"><a href="<?php the_permalink(); ?>" rel="bookmark" title="<?php printf(__('Permanent Link to %s', 'framework'), get_the_title()); ?>"> <?php the_title(); ?></a></h2>
									
					<!--BEGIN .entry-meta -->
					<div class="entry-meta">
						<span class="entry-portfolio-type"><?php the_terms($post->ID, 'portfolio-type', '', ', ', ''); ?></span>
					<!--END .entry-meta -->
					</div>
                
				<!--END .hentry-->  
				</div>
				
                <?php $i++; ?>
				<?php endwhile; ?>

			<!--END #primary .hfeed-->
			</div>
			
			<?php wp_reset_postdata(); ?>

<?php get_footer(); ?>