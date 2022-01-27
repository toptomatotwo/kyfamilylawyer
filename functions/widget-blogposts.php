<?php

/*-----------------------------------------------------------------------------------

	Plugin Name: Custom Blog Widget
	Plugin URI: http://www.premiumpixels.com
	Description: A widget that allows the display of blog posts.
	Version: 1.0
	Author: Orman Clark
	Author URI: http://www.premiumpixels.com

-----------------------------------------------------------------------------------*/


// Add function to widgets_init that'll load our widget.
add_action( 'widgets_init', 'tz_blog_widgets' );


// Register widget.
function tz_blog_widgets() {
	register_widget( 'TZ_Blog_Widget' );
}

// Widget class.
class tz_blog_widget extends WP_Widget {


/*-----------------------------------------------------------------------------------*/
/*	Widget Setup
/*-----------------------------------------------------------------------------------*/
	
	public function __construct() {
	
		/* Widget settings. */
		$widget_ops = array( 'classname' => 'tz_blog_widget', 'description' => __('A widget that displays your latest posts with a short excerpt.', 'framework') );

		/* Widget control settings. */
		$control_ops = array( 'width' => 300, 'height' => 350, 'id_base' => 'tz_blog_widget' );

		/* Create the widget. */
		parent::__construct( 'tz_blog_widget', __('Custom Recent Posts Widget', 'framework'), $widget_ops, $control_ops );
	}


/*-----------------------------------------------------------------------------------*/
/*	Display Widget
/*-----------------------------------------------------------------------------------*/
	
	function widget( $args, $instance ) {
		extract( $args );
		
		$title = apply_filters('widget_title', $instance['title'] );

		/* Our variables from the widget settings. */
		$number = $instance['number'];

		/* Before widget (defined by themes). */
		echo $before_widget;

		/* Display Widget */
		?> 
        <?php /* Display the widget title if one was input (before and after defined by themes). */
				if ( $title )
					echo $before_title . $title . $after_title;
				?>
			<div class="tz-blog-widget">
                            
                <ul>
                
					<?php 
                    $query = new WP_Query();
                    $query->query( array(
                        'posts_per_page' => $number,
                        'ignore_sticky_posts' => 1,
                        'tax_query' => array(
                                            array(
                                                'taxonomy' => 'post_format',
                                                'field' => 'slug',
                                                'terms' => array( 'post-format-aside', 'post-format-audio', 'post-format-gallery', 'post-format-image', 'post-format-link', 'post-format-quote', 'post-format-video' ),
                                                'operator' => 'NOT IN'
                                            )
                                        )
                            ));
                    ?>
                    <?php if ($query->have_posts()) : while ($query->have_posts()) : $query->the_post(); ?>
                    <li class="<?php echo 'format-'. get_post_format(); ?>">
                        
                        <div class="entry-meta">
                            <a href="<?php the_permalink(); ?>" title="<?php printf(__('Permanent link to %s', 'framework'), get_the_title()); ?>" class="post-format"><span class="post-format"></span></a>
                        </div>
                        
                        <div class="detail">
                            <h5 class="entry-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h5>
                            <?php the_excerpt(); ?>
                        </div>
                    
                    </li>
                    <?php endwhile; endif; ?>
                    
                    <?php wp_reset_query(); ?>

                </ul>
                
            </div><!--blog_widget-->
		
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
		'title' => 'Take a look behind the scenes.',
		
		'number' => 4
		
		);
		$instance = wp_parse_args( (array) $instance, $defaults ); ?>
		
        <!-- Widget Title: Text Input -->
		<p>
			<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e('Title:', 'framework') ?></label>
			<input type="text" class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo $instance['title']; ?>" />
		</p>
        
		<!-- Widget Title: Text Input -->
		<p>
			<label for="<?php echo $this->get_field_id( 'number' ); ?>"><?php _e('Amount to show:', 'framework') ?></label>
			<input type="text" class="widefat" id="<?php echo $this->get_field_id( 'number' ); ?>" name="<?php echo $this->get_field_name( 'number' ); ?>" value="<?php echo $instance['number']; ?>" />
		</p>

	
	<?php
	}
}
?>
