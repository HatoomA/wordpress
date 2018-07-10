<?php
/*
 Template Name: hawaii
*/
?>

<?php get_header(); ?>

<div id="content" class="aboutUs">

  <div class="hero">
    <img src="<?php the_field('hero_image'); ?>">
  </div>

  <div id="inner-content" class="wrap cf">

    <main id="main" class="m-all t-3of3 d-7of7 cf" role="main" itemscope itemprop="mainContentOfPage" itemtype="http://schema.org/Blog">

      <div class="contentSection wysiwyg">

        <?php echo the_field("content"); ?>
      
      </div>
    </main>
  </div>
</div>


<?php get_footer(); ?>