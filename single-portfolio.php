<?php get_header(); ?>

            <!--BEGIN .page-header -->
			<div class="page-header">
			    
			    <h1 class="page-title"><?php the_title(); ?></h1>
			    
			    <!--BEGIN .navigation .single-page-navigation -->
				<div class="navigation single-page-navigation">
				
				    <?php if( get_previous_post() ) : ?>
					<div class="nav-previous"><?php previous_post_link('&larr; %link') ?></div>
					<?php endif; ?>
					
					<?php if( get_next_post() ) : ?>
					<div class="nav-next"><?php next_post_link('%link &rarr;') ?></div>
					<?php endif; ?>

				<!--END .navigation .single-page-navigation -->
				</div>
				
			<!--END .page-header -->
			</div>
			
            <!--BEGIN #primary .hfeed-->
			<div id="primary" class="hfeed">
		    <?php if( have_posts() ) : while ( have_posts() ) : the_post(); ?>
				
				<!--BEGIN .hentry -->
				<div <?php post_class(); ?> id="post-<?php the_ID(); ?>">				
					
            		<?php // get the media elements
                        $mediaType = get_post_meta($post->ID, 'tz_portfolio_type', true);
                    	
            		    switch( $mediaType ) {
                            case "Image":
                                tz_image($post->ID, 'portfolio-main');
                                break;

                            case "Slideshow":
                                tz_gallery($post->ID, 'portfolio-main');
                                break;

                            case "Video":
                                $embed = get_post_meta($post->ID, 'tz_portfolio_embed_code', true);
                                if( !empty($embed) ) {
                                	echo "<div class='video-frame'>";
                                    echo stripslashes(htmlspecialchars_decode($embed));
                                    echo "</div>";
                                } else {
                                    tz_video($post->ID, 940);
                                }
                                break;

                            case "Audio":
                                tz_audio($post->ID, 940);
                                break;

                            default:
                                break;
                        }
            		?>

            		<!-- BEGIN .entry-content -->
            		<div class="entry-content">
                        
                        <!-- BEGIN .entry-meta -->
                		<div class="entry-meta">

                		    <?php 
                		        // get the meta information and display if supplied
                		        $portfolioClient = get_post_meta($post->ID, 'tz_portfolio_client', true);
                                $portfolioDate = get_post_meta($post->ID, 'tz_portfolio_date', true); 
                                $portfolioURL = get_post_meta($post->ID, 'tz_portfolio_url', true);
                        	    
            		            if( !empty($portfolioClient) ) {
            		                echo '<h5>' . __('Client:', 'framework') . '</h5>';
            		                echo '<span>' . $portfolioClient . '</span><br />';
            		            }

                                if( !empty($portfolioDate) ) {
                                    echo '<h5>' . __('Date:', 'framework') . '</h5>';
                                    echo '<span>' . $portfolioDate . '</span><br />';
                                }

                                if( !empty($portfolioURL) ) {
                                    echo "<a href='$portfolioURL'>" . __('Launch Project', 'framework') . "</a>";
                                }
            		        ?>

                		<!-- END .entry-meta -->
                		</div>
                		
                		<?php the_content(); ?>

            		<!-- END .entry-content -->
            		</div>                
				<!--END .hentry-->  
				</div>

				<?php endwhile; endif; ?>

			<!--END #primary .hfeed-->
			</div>

<?php get_footer(); ?>