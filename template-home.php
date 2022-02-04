<?php get_header(); ?>

            <!--BEGIN #primary .hfeed-->
            <div id="primary" class="hfeed ">
                  
            <?php if (have_posts()) : while (have_posts()) : the_post(); ?>

            	<!--BEGIN .hentry-->
            	<div <?php post_class('hero__wrapper') ?> id="post-<?php the_ID(); ?>">

                    <?php
                        $tz_slider = get_option('tz_image_slider');
                        if( $tz_slider == 'true' ) { /*get_template_part('includes/home-imageslider');*/ }

                    ?>
                        <img src="http://hollyh8.sg-host.com/wp-content/uploads/2020/01/slide_holly.jpg" class="hero__main-img">
            		<!--BEGIN .entry-content -->
            		<div class="entry-content hello hero__sidebar">
            			<?php the_content(); ?>
            		<!--END .entry-content -->
            		</div>
                        <div class="front-page__text-wrap"><p class="front-page_-text">Family Law is what I do. If you have found my page it probably means that you have a legal issue related to you , your spouse your partner, your children or your relatives. 
Our family court is structured around a 1 court 1 family principal divided into separate dockets. The dockets are divided into Circuit, Parternity, Juvenile, Status and EPO/DVO. Whatever docket you might appear on your judge will be consistent for that particular family court proceeding. I appear regularly on every family court docket. Experience matters.</p><a class="button small white" href="/about/">Find Out More</a></div>

            	<!--END .hentry-->
            	</div>

            	<?php
                  get_sidebar('home-callout');
            	?>

            	<?php endwhile; endif; ?>

            <!--END #primary .hfeed-->
                  <div class="front-page__practice-areas" id="practice-areas">
                      <div class="header-wrap header-wrap--practice-areas">
                        <h2 class="practice-areas__header front-page__h2">Practice Areas</h2>
                      </div>  
                      <ul class="practice-areas__list">
                          <li>Mediation</li><li>Custody</li><li>Divorce</li><li>Domestic Violence <!--(EPO DVO IPO)--></li><li>Child Support</li>
                          <li>Parenting Time</li><li>Adoption</li><li>Same Sex + Cohabition</li><li>Grandparent's Rights</li>
                      </ul>
                  </div>
                  <?php
          // Grab the related posts if selected to display in theme options
          if( 'portfolio' == get_post_type() && !is_tax('portfolio-type') && !is_search() && !is_404() ) {

            $related_ports = get_option('tz_portfolio_related');
            if( !empty($related_ports) && $related_ports != '0' ) {
                    //get_template_part('includes/footer-related-posts');
                }
        }
    ?>

    
        
    <div class="front-page__blade front-page__blade--from-blog">
        <!-- <div id="footer" class="clearfix footer front-page__blade front-page__blade--practice"> -->
        <?php get_sidebar('left-footer-column'); ?>
        <?php get_sidebar('center-footer-column'); ?>
        <?php get_sidebar('right-footer-column'); ?>
    
    </div>
        
    <?php include('inc/memberships-affiliations.php'); ?>
    <?php include('inc/bear-blade.php'); ?>
            </div><!-- end content -->

<?php get_footer(); ?>
