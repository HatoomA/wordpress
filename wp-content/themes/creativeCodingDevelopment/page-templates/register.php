<?php
/*
 Template Name: register
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


  $current_asp_registrations = array();
  $current_hc_registrations = array();
  $current_sc_registrations = array();
?>

<div id="content" class="programs register">

  <div class="hero">
    <img src="<?php the_field('hero_image'); ?>">
    <h3>Register</h3>
  </div>

  <div id="inner-content" class="wrap cf <?php echo getRegion(); ?>">

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

              <div class="offerring_type_table">
                <?php 
                  $args = array( 
                    'post_type' => 'after_school_program',
                    'posts_per_page' => -1, 
                    'meta_key' => 'location', 
                    'orderby' => 'meta_value', 
                    'order' => 'ASC' );
                  $asps = new WP_Query( $args );
                  if ( $asps->have_posts() ) : 
                ?>

                  <div class="regionSelector">
                    <span data-region="seattle">Seattle</span><!--
                 --><span data-region="hawaii">Hawaii</span>
                  </div>

                  <table class="asps classTable">
                    <thead>
                      <tr>
                        <th>Location</th>
                        <th>Dates</th>
                        <th>Day of Week</th>
                        <th>Curriculum</th>
                        <th>Register</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php while ( $asps->have_posts() ) : $asps->the_post(); 
                        $reg = get_field("reg_open_date");
                        if( $reg ):
                          $reg_open_date = new DateTime( $reg );//TODO: move class building logic to top of page, simply print it in these tables
                          $this_class = array(
                            'region' => get_field("region"),
                            'location' => get_field("location"),
                            'start_date' => get_field("start_date"),
                            'end_date' => get_field("end_date"),
                            'day_of_the_week' => get_field("day_of_the_week"),
                            'curriculum' => get_field("curriculum"),
                            'registration_closed' => get_field("registration_closed"),
                            'registration_url' => get_field("reg_link"),
                            'external_registration' => get_field("reg_external"),
                            'registration_opens_date' => $reg_open_date
                          );
                          array_push( $current_asp_registrations, $this_class )
                      ?><!--

                        --><tr class="asp classRow <?php echo the_field("region"); ?>Region">
                            <td><?php echo the_field("location"); ?></td>
                            <td><?php the_field("start_date"); ?> - <?php the_field("end_date"); ?></td>
                            <td><?php the_field("day_of_the_week"); ?></td>
                            <td><?php echo the_field("curriculum"); ?></td>
                            <td>
                            <?php 
                              if( get_field('registration_closed') ){
                                echo 'Registration Closed';
                              } else{
                                if( new DateTime() > $reg_open_date ){
                                  $reg_url = get_field('reg_link');
                                  if( !isset($reg_url ) || !get_field("reg_external") ){
                                    $reg_url = './registrationform?region='.get_field("region").'&classType=asp';
                                  }
                                  echo '<a class="table_button_link" target="_blank" href="'.$reg_url.'">Register Now!</a>';
                                } else{
                                  echo 'Opens on : '.$reg_open_date->format('m/d/y');
                                } 
                              } ?>
                            </td>
                          </tr><!--

                    --><?php endif; endwhile; ?>

                    </tbody>
                  </table>
                  <?php if( isset( $aspTableNote )): ?>
                    <p class="afterTableNote"><?php echo $aspTableNote; ?></p>
                  <?php endif; ?>
                <?php else : ?>

                  <article class="hentry cf" style="display:none;">
                    <header class="article-header">
                      <h1><?php _e( 'Oops! No After School Programs at this Time!', 'bonestheme' ); ?></h1>
                    </header>
                  </article>

                <?php endif; ?>
              </div>

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

              <div class="offerring_type_table">
                <?php 
                  $args = array( 
                    'post_type' => 'holiday_camp', 
                    'posts_per_page' => -1, 
                    'meta_key' => 'date', 
                    'orderby' => 'meta_value', 
                    'order' => 'ASC' );
                  $hcs = new WP_Query( $args );
                  if ( $hcs->have_posts() ) : 
                ?>

                  <div class="regionSelector">
                    <span data-region="seattle">Seattle</span><!--
                 --><span data-region="hawaii">Hawaii</span>
                  </div>

                  <table class="hcs classTable">
                    <thead>
                      <tr>
                        <th>Location</th>
                        <th>Date</th>
                        <th>Session</th>
                        <th>Time</th>
                        <th>Curriculum</th>
                        <th>Register</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php while ( $hcs->have_posts() ) : $hcs->the_post(); 
                        $reg = get_field("reg_open_date");
                        if( $reg ):
                          $reg_open_date = new DateTime( $reg );//TODO: move class building logic to top of page, simply print it in these tables
                          $this_class = array(
                            'region' => get_field("region"),
                            'location' => get_field("location"),
                            'date' => get_field("date"),
                            'session' => get_field("session"),
                            'start_time' => get_field("start_time"),
                            'end_time' => get_field("end_time"),
                            'curriculum' => get_field("curriculum"),
                            'registration_closed' => get_field("registration_closed"),
                            'registration_url' => get_field("reg_link"),
                            'external_registration' => get_field("reg_external"),
                            'registration_opens_date' => $reg_open_date
                          );
                          array_push( $current_hc_registrations, $this_class )
                      ?><!--

                        --><tr class="asp classRow <?php echo the_field("region"); ?>Region">
                            <td><?php echo the_field("location"); ?></td>
                            <td><?php the_field("date"); ?></td>
                            <td><?php the_field("session"); ?></td>
                            <td><?php the_field("start_time"); ?> - <?php the_field("end_time"); ?></td>
                            <td><?php echo the_field("curriculum"); ?></td>
                            <td>
                            <?php 
                              if( get_field('registration_closed') ){
                                echo 'Registration Closed';
                              } else{
                                if( new DateTime() > $reg_open_date ){
                                  $reg_url = get_field('reg_link');
                                  if( !isset($reg_url ) || !get_field("reg_external") ){
                                    $reg_url = './registrationform?region='.get_field("region").'&classType=hc';
                                  }
                                  echo '<a class="table_button_link" target="_blank" href="'.$reg_url.'">Register Now!</a>';
                                } else{
                                  echo 'Opens on : '.$reg_open_date->format('m/d/y');
                                } 
                              } ?>
                          </tr><!--

                    --><?php endif; endwhile; ?>

                    </tbody>

                  </table>

                  <?php if( isset($hcTableNote) ): ?>
                    <p class="afterTableNote"><?php echo $hcTableNote ?></p>
                  <?php endif; ?>
                <?php else : ?>

                  <article class="hentry cf" style="display:none;">
                    <header class="article-header">
                      <h1><?php _e( 'Oops! No Holiday Camps at this Time!', 'bonestheme' ); ?></h1>
                    </header>
                  </article>

                <?php endif; ?>
              </div>
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

              <div class="offerring_type_table">
                <?php 
                  $args = array( 
                    'post_type' => 'summer_camp', 
                    'posts_per_page' => -1, 
                    'meta_key' => 'location', 
                    'orderby' => 'meta_value', 
                    'order' => 'ASC' );
                  $scs = new WP_Query( $args );
                  if ( $scs->have_posts() ) : 
                ?>
                  <div class="regionSelector">
                    <span data-region="seattle">Seattle</span><!--
                 --><span data-region="hawaii">Hawaii</span>
                  </div>

                  <table class="scs classTable">
                    <thead>
                      <tr>
                        <th>Location</th>
                        <th>Dates</th>
                        <th>Day of Week</th>
                        <th>Curriculum</th>
                        <th>Register</th>
                      </tr>
                    </thead>
                    <tbody>
                    <tbody>
                      <?php while ( $scs->have_posts() ) : $scs->the_post(); 
                        $reg = get_field("reg_open_date");
                        if( $reg ):
                          $reg_open_date = new DateTime( $reg );//TODO: move class building logic to top of page, simply print it in these tables
                          $this_class = array(
                            'region' => get_field("region"),
                            'location' => get_field("location"),
                            'start_date' => get_field("start_date"),
                            'session' => get_field("session"),
                            'curriculum' => get_field("curriculum"),
                            'registration_closed' => get_field("registration_closed"),
                            'registration_url' => get_field("reg_link"),
                            'external_registration' => get_field("reg_external"),
                            'registration_opens_date' => $reg_open_date
                          );
                          array_push( $current_sc_registrations, $this_class )
                      ?><!--

                        --><tr class="asp classRow <?php echo the_field("region"); ?>Region">
                            <td><?php echo the_field("location"); ?></td>
                            <td><?php the_field("start_date"); ?></td>
                            <td><?php the_field("session"); ?></td>
                            <td><?php echo the_field("curriculum"); ?></td>
                            <td>
                            <?php 
                              if( get_field('registration_closed') == 1 ){
                                echo 'Registration Closed';
                              } else{
                                if( new DateTime() > $reg_open_date ){
                                  $reg_url = get_field('reg_link');
                                  if( !isset($reg_url) || get_field("reg_external") == 0 ){
                                    $reg_url = './registrationform?region='.get_field("region").'&classType=sc';
                                  }
                                  echo '<a class="table_button_link" target="_blank" href="'.$reg_url.'">Register Now!</a>';
                                } else{
                                  echo 'Opens on : '.$reg_open_date->format('m/d/y');
                                } 
                              } ?>
                            </td>
                          </tr><!--

                    --><?php endif; endwhile; ?>
                  </table>

                  <?php if( isset($scTableNote) ): ?>
                    <p class="afterTableNote"><?php echo $scTableNote ?></p>
                  <?php endif; ?>

                <?php else : ?>

                  <article class="hentry cf" style="display:none;">
                    <header class="article-header">
                      <h1><?php _e( 'Oops! No Summer Camps at this Time!', 'bonestheme' ); ?></h1>
                    </header>
                  </article>

                <?php endif; ?>
              </div>

            </li>

          </ul>
        </div>

        <?php /*$current_asp_registrations = array(
                            'region' => get_field("region"),
                            'location' => get_field("location"),
                            'start_date' => get_field("start_date"),
                            'end_date' => get_field("end_date"),
                            'day_of_the_week' => get_field("day_of_the_week"),
                            'curriculum' => get_field("curriculum"),
                            'registration_closed' => get_field("registration_closed"),
                            'registration_url' => get_field("reg_link"),
                            'external_registration' => get_field("reg_external"),
                            'registration_opens_date' => $reg_open_date
                          );
              $current_hc_registrations = array(
                            'region' => get_field("region"),
                            'location' => get_field("location"),
                            'date' => get_field("date"),
                            'session' => get_field("session"),
                            'start_time' => get_field("start_time"),
                            'end_time' => get_field("end_time"),
                            'curriculum' => get_field("curriculum"),
                            'registration_closed' => get_field("registration_closed"),
                            'registration_url' => get_field("reg_link"),
                            'external_registration' => get_field("reg_external"),
                            'registration_opens_date' => $reg_open_date
                          );
              
              $current_sc_registrations = array(
                            'region' => get_field("region"),
                            'location' => get_field("location"),
                            'start_date' => get_field("start_date"),
                            'session' => get_field("session"),
                            'curriculum' => get_field("curriculum"),
                            'registration_closed' => get_field("registration_closed"),
                            'registration_url' => get_field("reg_link"),
                            'external_registration' => get_field("reg_external"),
                            'registration_opens_date' => $reg_open_date
                          );
                          */?>  
        <div class="contentSection mobile_coursePrograms">
          <h1>Register</h1>
          <div><span>Jump To</span></div>
          <a class="mobile_jumpTo" href="#mobile_asp">After School Programs</a>
          <a class="mobile_jumpTo" href="#mobile_hc">Holiday Camps</a>
          <a class="mobile_jumpTo" href="#mobile_sc">Summer Camps</a>
          <div id="mobile_asp">
            <h2>After School Camps</h2>
              <?php if( count($current_asp_registrations) > 0 ): ?>
                <ul>
                <?php foreach( $current_asp_registrations as $this_class ):?>
                  
                  <li class="mobile_class_listing <?php echo $this_class["region"]; ?>Region">
                    <span><b>@<?php echo $this_class["location"]; ?></b> In <?php echo $this_class["region"]; ?></span>
                    <span>On <?php echo $this_class["day_of_the_week"]; ?>s</span>
                    <span><?php echo $this_class["start_date"]." - ".$this_class["end_date"]; ?></span>
                    <span>Level : <?php echo $this_class["curriculum"]; ?></span>
                    <span>
                    <?php 
                      if( $this_class['registration_closed'] ){
                        echo '<i class="reg_closed">Registration Closed</i>';
                      } else{
                        if( new DateTime() > $this_class["registration_opens_date"] ){
                          $reg_url = $this_class['registration_url'];
                          if( !isset( $reg_url ) || !$this_class["external_registration"] ){
                            $reg_url = './registrationform?region='.$this_class["region"].'&classType=asp';
                          }
                          echo '<a class="table_button_link" target="_blank" href="'.$reg_url.'">Register Now!</a>';
                        } else{
                          echo 'Opens on : '.$this_class["registration_opens_date"]->format('m/d/y');
                        } 
                      } ?>
                    </span>
                  </li>

                <?php endforeach; ?>
                </ul>
              <?php else: ?>
                <h3>No After Scool Camps At This Time</h3>
              <?php endif;?>
          </div>
          <div id="mobile_hc">
            <h2>Holiday Camps</h2>
              <?php if( count($current_hc_registrations) > 0 ): ?>
                <ul>
                <?php foreach( $current_hc_registrations as $this_class ):?>
                  <li class="mobile_class_listing <?php echo $this_class["region"]; ?>Region">
                    <span><b>@<?php echo $this_class["location"]; ?></b> In <?php echo $this_class["region"]; ?></span>
                    <span>On <?php echo $this_class["date"]; ?></span>
                    <span><?php echo $this_class["session"]; ?></span>
                    <span><?php echo $this_class["start_time"]." to ".$this_class["end_time"]; ?></span>
                    <span>Level : <?php echo $this_class["curriculum"]; ?></span>
                    <span>
                    <?php 
                      if( $this_class['registration_closed'] ){
                        echo '<i class="reg_closed">Registration Closed</i>';
                      } else{
                        if( new DateTime() > $this_class["registration_opens_date"] ){
                          $reg_url = $this_class['registration_url'];
                          if( !isset( $reg_url ) || !$this_class["external_registration"] ){
                            $reg_url = './registrationform?region='.$this_class["region"].'&classType=hc';
                          }
                          echo '<a class="table_button_link" target="_blank" href="'.$reg_url.'">Register Now!</a>';
                        } else{
                          echo 'Opens on : '.$this_class["registration_opens_date"]->format('m/d/y');
                        } 
                      } ?>
                    </span>
                  </li>
                <?php endforeach; ?>
                </ul>
              <?php else: ?>
                <h3>No Holiday Camps At This Time</h3>
              <?php endif;?>
          </div>
          <div id="mobile_sc">
            <h2>Summer Camps</h2>
              <?php if( count($current_sc_registrations) > 0 ): ?>
                <ul>
                <?php foreach( $current_sc_registrations as $this_class ):?>
                  <li class="mobile_class_listing <?php echo $this_class["region"]; ?>Region">
                    <span><b>@<?php echo $this_class["location"]; ?></b> In <?php echo $this_class["region"]; ?></span>
                    <span>Week Of <?php echo $this_class["start_date"]; ?></span>
                    <span><?php echo $this_class["session"]; ?></span>
                    <span>Level : <?php echo $this_class["curriculum"]; ?></span>
                    <span>
                    <?php 
                      if( $this_class['registration_closed'] ){
                        echo '<i class="reg_closed">Registration Closed</i>';
                      } else{
                        if( new DateTime() > $this_class["registration_opens_date"] ){
                          $reg_url = $this_class['registration_url'];
                          if( !isset( $reg_url ) || !$this_class["external_registration"] ){
                            $reg_url = './registrationform?region='.$this_class["region"].'&classType=sc';
                          }
                          echo '<a class="table_button_link" target="_blank" href="'.$reg_url.'">Register Now!</a>';
                        } else{
                          echo 'Opens on : '.$this_class["registration_opens_date"]->format('m/d/y');
                        } 
                      } ?>
                    </span>
                  </li>
                <?php endforeach; ?>
                </ul>
              <?php else: ?>
                <h3>No Summer Camps At This Time</h3>
              <?php endif;?>
          </div>
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
    if( $(window).width() >= 768 ){
      $target = $('#' + urlAnchor);
      if( $target )
        $target.click();
    } else{
      $target = $('a[href$="' + urlAnchor + '"]');
      if( $target )
        window.setTimeout(function(){
          $target.click();
        }, 200);
    }

    var $regionSelectorButtons = $(".regionSelector").children();
    $regionSelectorButtons.each(function(){
      this.addEventListener("click", function(){
        $content = $('#inner-content');
        $content.removeClass('seattle hawaii');
        $content.addClass($(this).data('region'));
      });
    });
  });

</script>


<?php get_footer(); ?>