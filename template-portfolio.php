<?php
/*
Template Name: Portfolio Template
*/
?>

<?php get_header(); ?>

            <!--BEGIN .page-header -->
			<div class="page-header">
			    
			    <h1 class="page-title"><?php the_title(); ?></h1>
			    <ul id="sort-by">
			        <li><a href="#all" data-filter="type-portfolio" class="active"><?php _e('All', 'framework'); ?></a></li>
			        <?php wp_list_categories( array('title_li' => '', 'taxonomy' => 'portfolio-type', 'walker' => new Portfolio_Walker() ) ); ?>
			    </ul>
			    
			<!--END .page-header -->
			</div>
			
            <!--BEGIN #primary .hfeed-->
			<div id="primary" class="hfeed isotope">
		    <?php 
		    $args = array(
                'post_type' => 'portfolio',
                'orderby' => 'menu_order',
                'order' => 'ASC',
                'posts_per_page' => -1
		    );
		    $query = new WP_Query( $args );

			while ( $query->have_posts() ) : $query->the_post(); ?>
				
				<?php 
				    $terms =  get_the_terms( $post->ID, 'portfolio-type' ); 
				    $term_list = '';
				    if( is_array($terms) ) {
				        foreach( $terms as $term ) {
    				        $term_list .= urldecode($term->slug);
    				        $term_list .= ' ';
    				    }
			        }
				?>
				
				<!--BEGIN .hentry -->
				<div <?php post_class("$term_list isotope-item"); ?> id="post-<?php the_ID(); ?>">				
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
				
				<?php endwhile; ?>

			<?php wp_reset_postdata(); ?>

			<!--END #primary .hfeed-->
			</div>

<?php get_footer(); ?>