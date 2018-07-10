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
        <a class="bannerButton buttonLink" href="<?php get_site_url(); ?>#aboutOurClasses">LEARN MORE</a>
      </div>
    <?php endif; ?>
  </div>

  <div id="inner-content" class="wrap cf">

      <main id="main" class="m-all t-3of3 d-7of7 cf" role="main" itemscope itemprop="mainContentOfPage" itemtype="http://schema.org/Blog">

        <h2 class="tagline"><?php echo the_field('tagline'); ?></h2>

        <p class="missionStatement"><?php echo the_field('mission_statement'); ?></p>

        <div class="contentSection coursePrograms">
          <div id="aboutOurClasses" class="scrollAnchor"></div>
          <h3 class="sectionHeader">Course Programs</h3>

          <ul class="imageList coursePrograms">
            <li class="sc">
              <img src="<?php echo bloginfo('template_directory').'/library/images/scPixels.png' ?>">
              <div class="liContent">
                <h2>Summer Camps</h2>
                <p>A full week of creativity and fun! Whether it’s your first time, your fifth, or your fifteenth, these week-long day camps are always a blast. Work on one big project, or start a new one each day; either way, every student will have a great time making new friends and learning new coding techniques.</p>
                <a class="buttonLink" href="./register#sc">Read More</a>
              </div>
            </li>
            <li class="asp">
              <img src="<?php echo bloginfo('template_directory').'/library/images/aspPixels.png' ?>">
              <div class="liContent">
                <h2>After School Programs</h2>
                <p>Join us when the bell rings for an afternoon of coding fun! Our weekly after school classes are held on-location at a growing number of schools in the Seattle area. Each session of this quarter-long program is jam-packed with fun challenges, techniques, and individual instruction time.</p>
                <a class="buttonLink" href="./register#asp">Read More</a>
              </div>
            </li>
            <li class="hc">
              <img src="<?php echo bloginfo('template_directory').'/library/images/hcPixels.png' ?>">
              <div class="liContent">
                <h2>All Day Holiday Camps</h2>
                <p>No school? No problem! We offer full-day coding camps on many of the dates that your school is not in session. Even with plenty of breaks for fresh air, it’s amazing how much students will learn in this 9 to 5 coding jam! Kids with big ideas can get big work done with an entire day of development, fun, and plenty of individual support from our enthusiastic teachers.</p>
                <a class="buttonLink" href="./register#hc">Read More</a>
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
