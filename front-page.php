<?php get_header(); ?>
    <!--BEGIN #primary .hfeed-->
    <div id="primary" class="hfeed">
            
    <?php if (have_posts()) : while (have_posts()) : the_post(); ?>

        <!--BEGIN .hentry-->
        <div <?php post_class('hero__wrapper') ?> id="post-<?php the_ID(); ?>">

            <img src="https://kyfamilylawyer.com/wp-content/uploads/2020/01/slide_holly.jpg" class="hero__main-img">
            <!--BEGIN .entry-content -->
            <div class="entry-content hero__sidebar">
                <?php the_content(); ?>
            </div><!--END .entry-content -->
            <div class="front-page__text-wrap"><p class="front-page_-text">My name is A. Holland Houston and I am a Family Lawyer and Mediator in Kentucky, based in Jefferson county. 2.2 Million people will marry in 2022 as projected by the New York Times. Of those, sadly, one half or more will end in divorce. Whether you have children from your marriage, from your current relationship, from another relationship, or have your grandchildren temporarily or permanently, or are going through a domestic violence case, a child support case, a paternity case, a co-parenting case, a dependency, neglect and abuse case or need spousal support, an antenuptial agreement, a cohabitation agreement or need an SJIS petition, I can help. I welcome all people and situations. I use she/her/hers pronouns and am an advocate of gender neutral parenting, which means kids deserve at least two healthy parents and whether mom or dad (or moms or dads do) does the bulk of childrearing and earns most of the income for the family should not matter. I believe firmly in negotiation first and Court later, if merited, and take a straightforward, perhaps sometimes unorthodox, approach to both mediation and litigation, with client (your) participation, as it is your life and money on the line.</p>
            <p class="front-page_-text">In poll after poll, most clients in famiy law matters want the opportunity to be heard, which is coincidentally part of the Due Process guarantee of the Constitution. I strive for you to understand your options, potential outcomes to the best of my knowledge and instill the ability to understand your rights and entitlements are should you choose to waive them or pursue them. I work to power up my clients and love evening playing fields. I am not licensed in Indiana. I am a GAL and mediator. In this job, strategy is everything, and experience counts. I would be happy to guide you through your family law case, whether as your lawyer or your mediator. Let's GO!</p>
<a class="homepage__about" href="/about/">Find Out More</a>
            </div><!-- end font page text wrap -->

        <!--END .hentry-->
        </div>
    </div><!-- end primary hfeed? -->
    <?php endwhile; endif; ?>
    <div class="postcard-promo"><img src="https://kyfamilylawyer.com/wp-content/uploads/2022/03/Holly-postcard-edit.jpg" class="postcard-promo-img"></div>

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
