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

        <div class="contentSection curricula">
          <div class="programsInfo entry-content">
          <?php the_field('programs_content'); ?>
          </div>
          <div class="curriculum core">
            <div class="curriculumContent">
              <?php the_field('core_content'); ?>
            </div>
            <div class="classesRegisteringNow">
              <a class="afterSchoolLink buttonLink" href="<?php echo site_url()."/register#asc"; ?>">After School</a>
              <a class="summerCampLink buttonLink" href="<?php echo site_url()."/register#sc"; ?>">Summer Camps</a>
              <a class="allDayCamps buttonLink" href="<?php echo site_url()."/register#hc"; ?>">All Day Camps</a>
            </div>
          </div>
          <div class="curriculum unplugged">
            <div class="curriculumContent">
              <?php the_field('unplugged_content'); ?>
            </div>
            <div class="classesRegisteringNow">
              <a class="afterSchoolLink buttonLink" href="<?php echo site_url()."/register#asc"; ?>">After School</a>
              <a class="summerCampLink buttonLink" href="<?php echo site_url()."/register#sc"; ?>">Summer Camps</a>
              <a class="allDayCamps buttonLink" href="<?php echo site_url()."/register#hc"; ?>">All Day Camps</a>
            </div>
          </div>
          <div class="curriculum studio">
            <div class="curriculumContent">
              <?php the_field('studio_content'); ?>
            </div>
            <div class="classesRegisteringNow">
              <a class="afterSchoolLink buttonLink" href="<?php echo site_url()."/register#asc"; ?>">After School</a>
              <a class="summerCampLink buttonLink" href="<?php echo site_url()."/register#sc"; ?>">Summer Camps</a>
              <a class="allDayCamps buttonLink" href="<?php echo site_url()."/register#hc"; ?>">All Day Camps</a>
            </div>
          </div>
        </div>

      </main>

  </div>

</div>


<?php get_footer(); ?>
