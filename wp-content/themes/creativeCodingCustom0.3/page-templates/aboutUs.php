<?php
/*
 Template Name: about us
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

<div id="content" class="aboutUs">

  <div class="hero">
    <img src="<?php the_field('hero_image'); ?>">
    <h3>About Us</h3>
  </div>

  <div id="inner-content" class="wrap cf">

    <main id="main" class="m-all t-3of3 d-7of7 cf" role="main" itemscope itemprop="mainContentOfPage" itemtype="http://schema.org/Blog">

      <div class="contentSection">

        <?php the_field("pre_teachers_field"); ?>

      <?php 
        $args = array( 'post_type' => 'teacher', 'posts_per_page' => -1 );
        $teachers = new WP_Query( $args );
        //if ( $teachers->have_posts() ) : 
        if ( false ) : 
      ?>

        <div class="sectionHeaderWrapper">
          <h3 class="sectionHeader">Teachers</h3>
        </div>

        <ul class="teachers">

        <?php while ( $teachers->have_posts() ) : $teachers->the_post(); ?><!--

        --><li class="teacher">
            <img src="<?php echo the_field("mugshot"); ?>">
            <h4><?php echo the_title(); ?></h4>
            <p><?php echo the_field("bio"); ?></p>
          </li><!--

      --><?php endwhile; ?>

        </ul>

      <?php endif; ?>
      
      </div>
    </main>
  </div>
</div>


<?php get_footer(); ?>