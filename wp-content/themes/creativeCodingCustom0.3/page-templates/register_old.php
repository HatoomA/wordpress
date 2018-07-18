<?php
/*
 Template Name: register-old
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

<?php get_header(); 
  $aspLiveDateTimeSeattle = DateTime::createFromFormat('d-m-y', get_field("seattle_after_school_registration_opens"));
  $hcLiveDateTimeSeattle = DateTime::createFromFormat('d-m-y', get_field("seattle_holiday_camps_registration_opens"));
  $scLiveDateTimeSeattle = DateTime::createFromFormat('d-m-y', get_field("seattle_summer_camps_registration_opens"));
  $aspLiveDateTimeSeattle = new DateTime( get_field("seattle_after_school_registration_opens"));
  $hcLiveDateTimeSeattle = new DateTime( get_field("seattle_holiday_camps_registration_opens"));
  $scLiveDateTimeSeattle = new DateTime( get_field("seattle_summer_camps_registration_opens"));

  $aspLiveDateTimeHawaii = DateTime::createFromFormat('d-m-y', get_field("hawaii_after_school_registration_opens"));
  $hcLiveDateTimeHawaii = DateTime::createFromFormat('d-m-y', get_field("hawaii_holiday_camps_registration_opens"));
  $scLiveDateTimeHawaii = DateTime::createFromFormat('d-m-y', get_field("hawaii_summer_camps_registration_opens"));
  $aspLiveDateTimeHawaii = new DateTime( get_field("hawaii_after_school_registration_opens"));
  $hcLiveDateTimeHawaii = new DateTime( get_field("hawaii_holiday_camps_registration_opens"));
  $scLiveDateTimeHawaii = new DateTime( get_field("hawaii_summer_camps_registration_opens"));

  $aspText = get_field('about_after_school');
  $aspHoverBlurb = get_field('hover_blurb_after_school');
  $hcText = get_field('about_holiday_camps');
  $hcHoverBlurb = get_field('hover_blurb_holiday_camps');
  $scText = get_field('about_summer_camps');
  $scHoverBlurb = get_field('hover_blurb_summer_camps');

  $aspTableNote = get_field('table_note_after_school');
  $hcTableNote = get_field('table_note_holiday_camps');
  $scTableNote = get_field('table_note_summer_camps');
?>

<div id="content" class="programs register">

  <div class="hero">
    <img src="<?php the_field('hero_image'); ?>">
    <h3>Register</h3>
  </div>

  <div id="inner-content" class="wrap cf">

      <main id="main" class="m-all t-3of3 d-7of7 cf" role="main" itemscope itemprop="mainContentOfPage" itemtype="http://schema.org/Blog">

        <div class="contentSection registerBlurb">
          <?php echo the_field('select_format_text'); ?>
        </div>

        <div class="contentSection coursePrograms">

          <ul class="imageList listView coursePrograms">
            <li class="asp">
              <a class="anchor" id="asp"></a>
              <h2 class="listViewTitle">After School</h2>
              <div class="pixel">
                <img class="pixel" src="<?php echo bloginfo('template_directory').'/library/images/aspPixels.png' ?>">
                <div class="hoverText"><div><?php echo $aspHoverBlurb; ?></div></div>
              </div>
              <div class="liContent">
                <h2>After School Programs</h2>
                <div class="jumpTos">
                  <span class="label">Jump To:</span>
                  <a data-program="hc">Holiday Camps</a>
                  <span>|</span>
                  <a data-program="sc">Summer Camps</a>
                </div>
                <?php echo $aspText; ?>
              </div>

              <?php 
                $args = array( 'post_type' => 'after_school_program', 'posts_per_page' => -1 );
                $asps = new WP_Query( $args );
                if ( $asps->have_posts() ) : 
              ?>

                <form method="POST" action="./registrationform">
                <input type="hidden" name="classType" value="asp">

                  <table class="asps classTable">
                    <tbody>
                    <div class="regionSelector">
                      <label><input class="regionSelect" type="radio" name="region" value="seattle" id="seattleRadio" checked><span>Seattle</span></label><!--
                   --><label><input class="regionSelect" type="radio" name="region" value="hawaii" id="hawaiiRadio" ><span>Hawaii</span></label>
                    </div>
                    <tr>
                      <th>Location</th>
                      <th>Dates</th>
                      <th>Day of Week</th>
                      <th>Curriculum</th>
                      <!--<th>Register</th>-->
                    </tr>
                      <?php while ( $asps->have_posts() ) : $asps->the_post(); ?><!--

                      --><tr class="asp classRow <?php echo the_field("region"); ?>Region">
                          <td><?php echo the_field("location"); ?></td>
                          <td><?php the_field("start_date"); ?> - <?php the_field("end_date"); ?></td>
                          <td><?php the_field("day_of_the_week"); ?></td>
                          <td><?php echo the_field("curriculum"); ?></td>
                          <!--<td><input type="checkbox" name="uniqueTag" value="<?php echo the_field("tag"); ?>"></td>-->
                        </tr><!--

                    --><?php endwhile; ?>

                    </tbody>
                  </table>
                  <?php if( isset( $aspTableNote )): ?>
                    <p class="afterTableNote"><?php echo $aspTableNote; ?></p>
                  <?php endif; ?>


                  <?php if ( new DateTime() > $aspLiveDateTimeSeattle ) : ?>
                    <a class="buttonLink" onclick="jQuery(this).closest('form').submit()">Register in <strong>Seattle</strong></a>
                  <?php else : ?>
                    <a class="buttonLink greyed">Register in <strong>Seattle</strong> starting <strong><?php echo $aspLiveDateTimeSeattle->format('m/d/y'); ?></strong></a>
                  <?php endif; ?>
                  <?php if ( new DateTime() > $aspLiveDateTimeHawaii ) : ?>
                    <a class="buttonLink" onclick="jQuery(this).closest('form').submit()">Register in <strong>Hawaii</strong></a>
                  <?php else : ?>
                    <a class="buttonLink greyed">Register in <strong>Hawaii</strong> starting <strong><?php echo $aspLiveDateTimeHawaii->format('m/d/y'); ?></strong></a>
                  <?php endif; ?>

                </form>
              <?php else : ?>

                <article class="hentry cf" style="display:none;">
                  <header class="article-header">
                    <h1><?php _e( 'Oops! No After School Programs at this Time!', 'bonestheme' ); ?></h1>
                  </header>
                </article>

              <?php endif; ?>

            </li>
            <li class="hc">
              <a class="anchor" id="hc"></a>
              <h2 class="listViewTitle">Holidays</h2>
              <div class="pixel">
                <img src="<?php echo bloginfo('template_directory').'/library/images/hcPixels.png' ?>">
                <div class="hoverText"><div><?php echo $hcHoverBlurb; ?></div></div>
              </div>
              <div class="liContent">
                <h2>All Day Holiday Camps</h2>
                <div class="jumpTos">
                  <span class="label">Jump To:</span>
                  <a data-program="asp">After School Programs</a>
                  <span>|</span>
                  <a data-program="sc">Summer Camps</a>
                </div>
                <?php echo $hcText; ?>
              </div>
              <?php 
                $args = array( 'post_type' => 'holiday_camp', 'posts_per_page' => -1 );
                $hcs = new WP_Query( $args );
                if ( $hcs->have_posts() ) : 
              ?>

                <form method="POST" action="./registrationform">
                <input type="hidden" name="classType" value="hc">

                  <table class="hcs classTable">
                    <div class="regionSelector">
                      <label><input class="regionSelect" type="radio" name="region" value="seattle" id="seattleRadio" checked><span>Seattle</span></label><!--
                   --><label><input class="regionSelect" type="radio" name="region" value="hawaii" id="hawaiiRadio" ><span>Hawaii</span></label>
                    </div>
                    <tbody>
                    <tr>
                      <th>Location</th>
                      <th>Date</th>
                      <th>Session</th>
                      <th>Time</th>
                      <th>Curriculum</th>
                      <!--<th>Register</th>-->
                    </tr>

                      <?php while ( $hcs->have_posts() ) : $hcs->the_post(); ?><!--

                      --><tr class='hc classRow <?php echo the_field("region"); ?>Region'>
                          <td><?php echo the_field("location"); ?></td>
                          <td><?php the_field("date"); ?></td>
                          <td><?php the_field("session"); ?></td>
                          <td><?php the_field("start_time"); ?> - <?php the_field("end_time"); ?></td>
                          <td><?php echo the_field("curriculum"); ?></td>
                          <!--<td><input type="checkbox" name="uniqueTag" value="<?php echo the_field("tag"); ?>"></td>-->
                        </tr><!--

                    --><?php endwhile; ?>

                    </tbody>
                  </table>
                  <?php if( isset($hcTableNote) ): ?>
                    <p class="afterTableNote"><?php echo $hcTableNote ?></p>
                  <?php endif; ?>

                  <?php if ( new DateTime() > $hcLiveDateTimeSeattle ) : ?>
                    <a class="buttonLink" onclick="jQuery(this).closest('form').submit()">Register in <strong>Seattle</strong></a>
                  <?php else : ?>
                    <a class="buttonLink greyed">Register in <strong>Seattle</strong> starting <strong><?php echo $hcLiveDateTimeSeattle->format('m/d/y'); ?></strong></a>
                  <?php endif; ?>
                  <?php if ( new DateTime() > $hcLiveDateTimeHawaii ) : ?>
                    <a class="buttonLink" onclick="jQuery(this).closest('form').submit()">Register in <strong>Hawaii</strong></a>
                  <?php else : ?>
                    <a class="buttonLink greyed">Register in <strong>Hawaii</strong> starting <strong><?php echo $hcLiveDateTimeHawaii->format('m/d/y'); ?></strong></a>
                  <?php endif; ?>

                </form>
              <?php else : ?>

                <article class="hentry cf" style="display:none;">
                  <header class="article-header">
                    <h1><?php _e( 'Oops! No Holiday Camps at this Time!', 'bonestheme' ); ?></h1>
                  </header>
                </article>

              <?php endif; ?>
            </li>
            <li class="sc">
              <a class="anchor" id="sc"></a>
              <h2 class="listViewTitle">Summer</h2>
              <div class="pixel">
                <img src="<?php echo bloginfo('template_directory').'/library/images/scPixels.png' ?>">
                <div class="hoverText"><div><?php echo $scHoverBlurb; ?></div></div>
              </div>
              <div class="liContent">
                <h2>Summer Camps</h2>
                <div class="jumpTos">
                  <span class="label">Jump To:</span>
                  <a data-program="asp">After School Programs</a>
                  <span>|</span>
                  <a data-program="hc">Holiday Camps</a>
                </div>
                <?php echo $scText; ?>
              </div>

              <?php 
                $args = array( 'post_type' => 'summer_camp', 'posts_per_page' => -1 );
                $scs = new WP_Query( $args );
                if ( $scs->have_posts() ) : 
              ?>

                <form method="POST" action="./registrationform">
                <input type="hidden" name="classType" value="sc">

                  <table class="scs classTable">
                    <div class="regionSelector">
                      <label><input class="regionSelect" type="radio" name="region" value="seattle" id="seattleRadio" checked><span>Seattle</span></label><!--
                   --><label><input class="regionSelect" type="radio" name="region" value="hawaii" id="hawaiiRadio" ><span>Hawaii</span></label>
                    </div>
                      <?php if( isset($scTableNote) ): ?>
                        <p class="afterTableNote"><?php echo $scTableNote ?></p>
                      <?php endif; ?>
                      
                      <?php if ( new DateTime() > $scLiveDateTimeSeattle ) : ?>
                        <a class="buttonLink" onclick="document.getElementById('seattleRadio').checked = true; jQuery(this).closest('form').submit()">Register in <strong>Seattle</strong></a>
                      <?php else : ?>
                        <a class="buttonLink greyed">Register in <strong>Seattle</strong> starting <strong><?php echo $scLiveDateTimeSeattle->format('m/d/y'); ?></strong></a>
                      <?php endif; ?>
                      <?php if ( new DateTime() > $scLiveDateTimeHawaii ) : ?>
                        <a class="buttonLink" onclick="document.getElementById('hawaiiRadio').checked = true; jQuery(this).closest('form').submit()">Register in <strong>Hawaii</strong></a>
                      <?php else : ?>
                        <a class="buttonLink greyed">Register in <strong>Hawaii</strong> starting <strong><?php echo $scLiveDateTimeHawaii->format('m/d/y'); ?></strong></a>
                      <?php endif; ?>
                    <tbody>
                    <tr>
                      <th>Location</th>
                      <th>Dates</th>
                      <th>Day of Week</th>
                      <th>Curriculum</th>
                      <!--<th>Register</th>-->
                    </tr>

                      <?php while ( $scs->have_posts() ) : $scs->the_post(); ?><!--

                      --><tr class="sc classRow <?php echo the_field("region"); ?>Region">
                          <td><?php echo the_field("location"); ?></td>
                          <td><?php the_field("start_date"); ?> - <?php the_field("end_date"); ?></td>
                          <td><?php the_field("session"); ?></td>
                          <td><?php echo the_field("curriculum"); ?></td>
                          <!--<td><input type="checkbox" name="uniqueTag" value="<?php echo the_field("tag"); ?>"></td>-->
                        </tr><!--

                    --><?php endwhile; ?>

                    </tbody>
                  </table>

                </form>
              <?php else : ?>

                <article class="hentry cf" style="display:none;">
                  <header class="article-header">
                    <h1><?php _e( 'Oops! No Summer Camps at this Time!', 'bonestheme' ); ?></h1>
                  </header>
                </article>

              <?php endif; ?>

            </li>

          </ul>
        </div>

      </main>

  </div>

</div>

<script>
  jQuery(document).ready(function(){
    var $ = jQuery;
    var $list = $(".coursePrograms");
    var $listItems = $(".coursePrograms li");
    var urlAnchor = window.location.hash.substr(1);
    
    $listItems.each(function(){
      $(this).one("click", function(){
        $listItems.removeClass("active");
        $(this).addClass("active");
        $list.removeClass("listView");
        $listItems.off( "click", "**" );
        $('.jumpTos a').each(function(){
          this.addEventListener("click", function(){
            var target = $(this).data('program');
            $listItems.removeClass("active");
            $('.'+target).addClass("active");
          });
        });
      });
    });
    if( urlAnchor){
      $target = $('li.' + urlAnchor);
      if($target){
        $target.click();
      }
    }

    var $regionSelectors = $(".regionSelector");
    $regionSelectors.each(function(){
      this.addEventListener("click", function(){
        var regionSelected = $(this).find("input.regionSelect:checked")[0].value;
        $(this).siblings(".classTable").find("tr.classRow").each(function(){this.style.display = "none"});
        availableClasses = $(this).siblings(".classTable").find("."+regionSelected+"Region");
        if( availableClasses.length > 0 ){
          availableClasses.each(function(){this.style.display = "table-row"});
        } else{

        }
      });
    });
  });

</script>


<?php get_footer(); ?>
