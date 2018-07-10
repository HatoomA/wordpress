<?php
/*
 Template Name: programs
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

<?php
  $scLiveDateTime = DateTime::createFromFormat('d-m-y H:i', get_field("sc_registration_opens_date").' '.get_field("sc_registration_opens_time"));
  $hcLiveDateTime = DateTime::createFromFormat('d-m-y H:i', get_field("hc_registration_opens_date").' '.get_field("hc_registration_opens_time"));
  $LiveDateTime = DateTime::createFromFormat('d-m-y H:i', get_field("_registration_opens_date").' '.get_field("_registration_opens_time"));
  $scLiveDateTime = new DateTime( get_field("sc_registration_opens_date").' '.get_field("sc_registration_opens_time") );
  $hcLiveDateTime = new DateTime( get_field("hc_registration_opens_date").' '.get_field("hc_registration_opens_time") );
  $LiveDateTime = new DateTime( get_field("_registration_opens_date").' '.get_field("_registration_opens_time") );

  
?>

<?php get_header(); ?>

<div id="content" class="programs">

  <div class="hero">
    <img src="<?php the_field('hero_image'); ?>">
    <h3>Programs</h3>
  </div>

  <div id="inner-content" class="wrap cf">

      <main id="main" class="m-all t-3of3 d-7of7 cf" role="main" itemscope itemprop="mainContentOfPage" itemtype="http://schema.org/Blog">

        <div class="contentSection intro">
          <h2>Our classes are designed to...</h2>
          <div class="icon_and_text">
            <div class="img_container" style="background-image:url('<?php echo get_template_directory_uri(); ?>/library/images/lazy_bot.png ?>')"></div>
            <div class="text_container">Build Persistence</div>
          </div>
          <div class="icon_and_text">
            <div class="img_container" style="background-image:url('<?php echo get_template_directory_uri(); ?>/library/images/trapper_bot.png ?>')"></div>
            <div class="text_container">Strengthen Coding Knowledge</div>
          </div>
          <div class="icon_and_text">
            <div class="img_container" style="background-image:url('<?php echo get_template_directory_uri(); ?>/library/images/up_coin.png ?>')"></div>
            <div class="text_container">Increase Confidence</div>
          </div>
          <div class="icon_and_text">
            <div class="img_container" style="background-image:url('<?php echo get_template_directory_uri(); ?>/library/images/bubble_character.png ?>')"></div>
            <div class="text_container">Harness Creative Energy</div>
          </div>
          <div class="icon_and_text">
            <div class="img_container" style="background-image:url('<?php echo get_template_directory_uri(); ?>/library/images/fire_ball.png ?>')"></div>
            <div class="text_container">Enhance Focus</div>
          </div>
        </div>

        <div class="contentSection curricula"><!--
          <div class="programsInfo entry-content">
            <?php the_field('programs_content'); ?>
          </div>-->
          <div class="curriculum core">
            <div class="content_wrapper">
              <img class="icon" src="<?php echo get_template_directory_uri(); ?>/library/images/core_minicon.png">
              <div class="curriculumContent">
                <?php the_field('core_content'); ?>
              </div>
            </div>
          </div>
          <div class="curriculum junior">
            <div class="content_wrapper">
              <img class="icon" src="<?php echo get_template_directory_uri(); ?>/library/images/junior_minicon.png">
              <div class="curriculumContent">
                <?php the_field('unplugged_content'); ?>
              </div>
            </div>
          </div>
          <div class="curriculum studio">
            <div class="content_wrapper">
              <img class="icon" src="<?php echo get_template_directory_uri(); ?>/library/images/studio_minicon.png">
              <div class="curriculumContent">
                <?php the_field('studio_content'); ?>
              </div>
            </div>
          </div>
        </div>

      </main>

  </div>

</div>


<?php get_footer(); ?>
