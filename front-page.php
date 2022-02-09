<?php get_header(); ?>
    <!--BEGIN #primary .hfeed-->
    <div id="primary" class="hfeed">
            
    <?php if (have_posts()) : while (have_posts()) : the_post(); ?>

        <!--BEGIN .hentry-->
        <div <?php post_class('hero__wrapper') ?> id="post-<?php the_ID(); ?>">

            <img src="http://hollyh8.sg-host.com/wp-content/uploads/2020/01/slide_holly.jpg" class="hero__main-img">
            <!--BEGIN .entry-content -->
            <div class="entry-content hero__sidebar">
                <?php the_content(); ?>
            </div><!--END .entry-content -->
            <div class="front-page__text-wrap"><p class="front-page_-text">Family Law is what I do. If you have found my page it probably means that you have a legal issue related to you , your spouse your partner, your children or your relatives. 
Our family court is structured around a 1 court 1 family principal divided into separate dockets. The dockets are divided into Circuit, Parternity, Juvenile, Status and EPO/DVO. Whatever docket you might appear on your judge will be consistent for that particular family court proceeding. I appear regularly on every family court docket. Experience matters.</p>
<a class="button small white" href="/about/">Find Out More</a>
            </div><!-- end font page text wrap -->

        <!--END .hentry-->
        </div>
    </div><!-- end primary hfeed? -->

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
        }
    ?>
    
    <div class="front-page__blade front-page__blade--from-blog test">
        <?php get_sidebar('left-footer-column'); ?>
    </div>
        
    <?php include('inc/memberships-affiliations.php'); ?>
    <?php include('inc/bear-blade.php'); ?>
            
<?php get_footer(); ?>
</div><!-- end content -->
