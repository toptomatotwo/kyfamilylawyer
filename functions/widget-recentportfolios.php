<?php

/*-----------------------------------------------------------------------------------

	Plugin Name: Custom Recent Portfolio/Work Widget
	Plugin URI: http://www.premiumpixels.com
	Description: A widget that allows the display of recent portfolios/work.
	Version: 1.0
	Author: Orman Clark
	Author URI: http://www.premiumpixels.com

-----------------------------------------------------------------------------------*/


// Add function to widgets_init that'll load our widget.
add_action( 'widgets_init', 'tz_recent_portfolios_widget' );


// Register widget.
function tz_recent_portfolios_widget() {
	register_widget( 'TZ_Recent_Portfolios_Widget' );
}

// Widget class.
class tz_recent_portfolios_widget extends WP_Widget {


/*-----------------------------------------------------------------------------------*/
/*	Widget Setup
/*-----------------------------------------------------------------------------------*/
	
	public function __construct() {
	
		/* Widget settings. */
		$widget_ops = array( 
		    'classname' => 'tz_recent_portfolios_widget', 
		    'description' => __('A widget that displays your recent portfolios.', 'framework') 
		);

		/* Widget control settings. */
		$control_ops = array( 
		    'width' => 300, 
		    'height' => 350, 
		    'id_base' => 'tz_recent_portfolios_widget' 
		);

		/* Create the widget. */
		parent::__construct( 'tz_recent_portfolios_widget', __('Custom Recent Portfolios Widget', 'framework'), $widget_ops, $control_ops );
	}


/*-----------------------------------------------------------------------------------*/
/*	Display Widget
/*-----------------------------------------------------------------------------------*/
	
	function widget( $args, $instance ) {
		extract( $args );
		
		/* Our variables from the widget settings. */
		$title = apply_filters('widget_title', $instance['title'] );
		$number = ( isset($instance['number']) ) ? $instance['number'] : 0;
		$desc = $instance['desc'];

		/* Before widget (defined by themes). */
		echo $before_widget;

		/* Display the widget title if one was input (before and after defined by themes). */
		if ( $title ) { echo $before_title . $title . $after_title; }
?>
			
		<div class="tz-recent-portfolios-widget">      
            <?php if( !empty($desc) ) { echo "<p>$desc</p>"; } ?>
            
            <ul class="clearfix">
                
			<?php 
			    $args = array(
                    'posts_per_page' => $number,
                    'ignore_sticky_posts' => 1,
                    'post_type' => 'portfolio',
                    'order' => 'DESC',
                    'orderby' => 'date'
                );
			
                $port_query = new WP_Query( $args );
                
                if( $port_query->have_posts() ) : while( $port_query->have_posts() ) : $port_query->the_post(); ?>
                    <li>
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
        				<span class="entry-portfolio-type"><?php the_terms(get_the_ID(), 'portfolio-type', '', ', ', ''); ?></span>
        			<!--END .entry-meta -->
        			</div>

        			</li>	
                <?php endwhile; endif; wp_reset_postdata(); ?>

            </ul>
            
        </div><!-- / .tz-recent-portfolios-widget -->
	
	<?php

		/* After widget (defined by themes). */
		echo $after_widget;
	}


/*-----------------------------------------------------------------------------------*/
/*	Update Widget
/*-----------------------------------------------------------------------------------*/
	
	function update( $new_instance, $old_instance ) {
		
		$instance = $old_instance;
		
		/* Strip tags to remove HTML (important for text inputs). */
		$instance['title'] = strip_tags( $new_instance['title'] );
		$instance['desc'] = strip_tags( $new_instance['desc'] );
		$instance['number'] = strip_tags( $new_instance['number'] );

		/* No need to strip tags for.. */

		return $instance;
	}
	

/*-----------------------------------------------------------------------------------*/
/*	Widget Settings
/*-----------------------------------------------------------------------------------*/
	 
	function form( $instance ) {

		/* Set up some default widget settings. */
		$defaults = array(
		'title' => 'Recent Work',
		'desc' => 'This is my latest work, pretty cool huh?',
		'number' => 4
		
		);
		$instance = wp_parse_args( (array) $instance, $defaults ); ?>
		
        <!-- Widget Title: Text Input -->
		<p>
			<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e('Title:', 'framework') ?></label>
			<input type="text" class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo $instance['title']; ?>" />
		</p>
		
		<!-- Description: Text Input -->
    	<p>
    		<label for="<?php echo $this->get_field_id( 'desc' ); ?>"><?php _e('Short Description:', 'framework') ?></label>
    		<input class="widefat" type="text" id="<?php echo $this->get_field_id( 'desc' ); ?>" name="<?php echo $this->get_field_name( 'desc' ); ?>" value="<?php echo stripslashes(htmlspecialchars(( $instance['desc'] ), ENT_QUOTES)); ?>" />
    	</p>
        
		<!-- Number Input: Text Input -->
		<p>
			<label for="<?php echo $this->get_field_id( 'number' ); ?>"><?php _e('Amount to show:', 'framework') ?></label>
			<input type="text" class="widefat" id="<?php echo $this->get_field_id( 'number' ); ?>" name="<?php echo $this->get_field_name( 'number' ); ?>" value="<?php echo $instance['number']; ?>" />
		</p>

	
	<?php
	}
}
?>
