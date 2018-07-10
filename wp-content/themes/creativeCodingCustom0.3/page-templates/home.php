<?php
/*
 Template Name: home
 *
 * This is your custom page template. You can create as many of these as you need.
 * Simply name is "page-whatever.php" and in add the "Template Name" title at the
 * top, the same way it is here.
 *
 * When you create your page, you can just select the template and viola, you have
 * a custom page template to call your very own. Your mother would be so proud.
 *
 * For more info: http://codex.wordpress.org/Page_Templates
*/
?>

<?php get_header(); ?>

<div id="content">
  <div class="homeHero">
    <img src="<?php the_field('hero_image'); ?>">
    <?php $hero_banner = get_field('homepage_hero_banner'); if(!empty($hero_banner)) : ?>
      <div class="banner" style="background-image:url('<?php echo $hero_banner;?>');">
        <a class="bannerButton buttonLink" href="<?php get_site_url(); ?>#our_mission">LEARN MORE</a>
      </div>
    <?php endif; ?>
    <a class="banner_register_leaf" href="./register#sc"><h3>Register Now!</h3><img src="<?php echo bloginfo('template_directory').'/library/images/leaf_glow.png' ?>"></a>
  </div><!--

--><div id="inner-content" class="wrap cf">

    <main id="main" class="m-all t-3of3 d-7of7 cf" role="main" itemscope itemprop="mainContentOfPage" itemtype="http://schema.org/Blog">

      <!--<h2 class="tagline"><?php echo the_field('tagline'); ?></h2>-->

      <div class="contentSection company_overview">
        <div id="company_overview" class="scrollAnchor"></div>
        <h3 class="sectionHeader">Company Overview</h3>
        <div>
          <img src="<?php echo get_field('overview_blurb_1_image')['url']; ?>">
          <?php echo the_field('overview_blurb_1'); ?>
        </div>
        <div>
          <?php echo the_field('overview_blurb_2'); ?>
          <img class="no_mobile" src="<?php echo get_field('overview_blurb_2_image')['url']; ?>">
        </div>
      </div>



      <div class="contentSection coursePrograms">
        <div id="aboutOurClasses" class="scrollAnchor"></div>
        <h3 class="sectionHeader">Offerings</h3>

        <ul class="imageList coursePrograms">
          <li class="asp">
            <a href="./register#asp"><img src="<?php echo bloginfo('template_directory').'/library/images/aspPixels.png' ?>"></a>
            <div class="liContent">
              <h2>After School</h2>
              <p>Join us when the bell rings for an afternoon of coding fun at your school!</p>
              <a class="buttonLink" href="./register#asp">Read More</a>
            </div>
          </li>
          <li class="hc">
            <a href="./register#hc"><img src="<?php echo bloginfo('template_directory').'/library/images/hcPixels.png' ?>"></a>
            <div class="liContent">
              <h2>Holiday Camps</h2>
              <p>No school? No problem! We offer full-day coding camps on many holidays.</p>
              <a class="buttonLink" href="./register#hc">Read More</a>
            </div>
          </li>
          <li class="sc">
            <a href="./register#sc"><img src="<?php echo bloginfo('template_directory').'/library/images/scPixels.png' ?>"></a>
            <div class="liContent">
              <h2>Summer Camps</h2>
              <p>A full week of creativity and fun! This is a great camp for kids at any level.</p>
              <a class="buttonLink" href="./register#sc">Read More</a>
            </div>
          </li>
          <li class="hc">
            <a href="mailto:Teachers@CreativeCoding.com?Subject=Corporate%20Event%20Inquiry"><img src="<?php echo bloginfo('template_directory').'/library/images/seattlePixels.png' ?>"></a>
            <div class="liContent">
              <h2>Corporate Camps</h2>
              <p>Book us for your 'bring your kids to work day' with our corporate camps!</p>
              <a class="buttonLink" href="mailto:Teachers@CreativeCoding.com?Subject=Corporate%20Event%20Inquiry">Contact Us</a>
            </div>
          </li>
        </ul>
      </div>

<!-- JANELLA ABOUT -->

      <div class="contentSection">
        <div id="our_mission" class="scrollAnchor"></div>
        <!-- <div id="aboutOurClasses" class="scrollsAnchor"></div> -->
        <h3 class="sectionHeader">Our Mission</h3>

        <ul class="about-list">
            <li class="">
              <div class="ghost-block">
                <div class="vert-centered-block about-list-images" style="background-image:url('<?php echo bloginfo('template_directory').'/library/images/smooth-moves-face-right.png' ?>'); ">
                </div>
              </div>
              <div class="liContent">
                <div class="ghost-block ghost-block-text">
                  <div class="vert-centered-block vert-centered-block-text">
                    <h2><?php echo get_field('mission_title_1'); ?></h2>
                    <p><?php echo get_field('mission_content_1'); ?></p>
                  </div>
                </div>
              </div>
            </li>
            <li class="">
              <div class="ghost-block">
                <div class="vert-centered-block about-list-images" style="background-image:url('<?php echo bloginfo('template_directory').'/library/images/lazy-bot-character.png' ?>'); ">
                </div>
              </div> 
              <div class="liContent">
                <div class="ghost-block ghost-block-text">
                  <div class="vert-centered-block vert-centered-block-text">
                    <h2><?php echo get_field('mission_title_2'); ?></h2>
                    <p><?php echo get_field('mission_content_2'); ?></p>
                  </div>
                </div>
              </div>
            </li>
            <li class="">
              <div class="ghost-block">
                <div class="vert-centered-block about-list-images" style="background-image:url('<?php echo bloginfo('template_directory').'/library/images/power-up-coin-real-size.png' ?>'); ">
                </div>
              </div> 
              <div class="liContent">
                  <div class="ghost-block ghost-block-text">
                    <div class="vert-centered-block vert-centered-block-text">
                      <h2><?php echo get_field('mission_title_3'); ?></h2>
                      <p><?php echo get_field('mission_content_3'); ?></p>
                    </div>
                  </div>
              </div>
            </li>
          </ul>
        </div>



    <?php 
      $args = array( 'post_type' => 'teacher', 'posts_per_page' => -1 );
      $teachers = new WP_Query( $args );
      //if ( $teachers->have_posts() ) : 
      if ( false ) : 
    ?>

      <div class="contentSection ourTeachers">
        <h3 class="sectionHeader">Our Teachers</h3>

        <ul class="teachers">

        <?php while ( $teachers->have_posts() ) : $teachers->the_post(); ?><!--

        --><li class="teacher">
            <img src="<?php echo the_field("mugshot"); ?>">
            <h4><?php echo the_title(); ?></h4>
            <p><?php echo the_field("blurb"); ?></p>
          </li><!--

      --><?php endwhile; ?>

        </ul>
      </div>

    <?php endif; ?>


    <!--
    <p class="missionStatement"><?php echo the_field('mission_statement'); ?></p>
    -->

    <?php 
      $args = array( 'post_type' => 'testimonial', 'posts_per_page' => -1 );
      $testimonials = new WP_Query( $args );
      if ( $testimonials->have_posts() ) : 
    ?>

        <div class="contentSection testimonials">
          <h3 class="sectionHeader">Testimonials</h3>

        <ul class="testimonials">

        <?php while ( $testimonials->have_posts() ) : $testimonials->the_post(); ?><!--

        --><li class="testimonials">
            <p class="quote">"<?php echo the_field("quote"); ?>"</p>
            <p class="source">-<?php echo the_field("source"); ?></p>
          </li><!--

      --><?php endwhile; ?>

        </ul>
      </div>

    <?php endif; ?>

        </div>

      </main>

  </div>

</div>


<?php get_footer(); ?>
