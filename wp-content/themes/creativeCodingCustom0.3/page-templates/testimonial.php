<?php
/*
 Template Name: testimonials
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

<div id="content" class="testimonials">

  <div class="hero">
    <img src="<?php the_field('hero_image'); ?>">
    <h3>Testimonials</h3>
  </div>

  <div id="inner-content" class="wrap cf">

    <main id="main" class="m-all t-3of3 d-7of7 cf" role="main" itemscope itemprop="mainContentOfPage" itemtype="http://schema.org/Blog">

      <div class="contentSection">

        <?php the_field("pre_testimonials_field"); ?>

        <?php 
          $args = array( 'post_type' => 'testimonial', 'posts_per_page' => -1 );
          $testimonials = new WP_Query( $args );
          if ( $testimonials->have_posts() ) : 
        ?>

          <div class="sectionHeaderWrapper">
            <h3 class="sectionHeader">Testimonials</h3>
          </div>

          <ul class="testimonials">

            <?php while ( $testimonials->have_posts() ) : $testimonials->the_post(); ?><!--

            --><li class="testimonials">
                <p class="quote">"<?php echo the_field("quote"); ?>"</p>
                <p class="source">-<?php echo the_field("source"); ?></p>
              </li><!--

          --><?php endwhile; ?>

          </ul>

        <?php endif; ?>
      
      </div>
    </main>
  </div>
</div>


<?php get_footer(); ?>