<?php
/*
 Template Name: register-backup
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


  $asp_class_offerings = get_class_offerings( 'after_school_program' );
  $hc_class_offerings = get_class_offerings( 'holiday_camp' );
  $sc_class_offerings = get_class_offerings( 'summer_camp' );
?>

<div id="content" class="programs register">

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

                    <?php foreach( $asp_class_offerings as $asp_class_offering ): ?><!--
                    --><tr class="asp classRow <?php echo $asp_class_offering["region"]; ?>Region">
                        <td><?php echo $asp_class_offering["location"]; ?></td>
                        <td><?php echo $asp_class_offering["start_date"]; ?> - <?php echo $asp_class_offering["end_date"]; ?></td>
                        <td><?php echo $asp_class_offering["day_of_the_week"]; ?></td>
                        <td><?php echo $asp_class_offering["curriculum"]; ?></td>
                        <td><?php echo $asp_class_offering['reg_inner_html'] ?></td>
                      </tr><!--
                  --><?php  endforeach; ?>

                  </tbody>
                </table>
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
                <?php if ( count($hc_class_offerings) > 0 ) : ?>

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

                      <?php foreach ( $hc_class_offerings as $hc_class_offering ): ?><!--

                        --><tr class="hc classRow <?php echo $hc_class_offering["region"]; ?>Region">
                            <td><?php echo $hc_class_offering["location"]; ?></td>
                            <td><?php echo $hc_class_offering["date"]; ?></td>
                            <td><?php echo $hc_class_offering["session"]; ?></td>
                            <td><?php echo $hc_class_offering["start_time"]; ?> - <?php echo $hc_class_offering["end_time"]; ?></td>
                            <td><?php echo $hc_class_offering["curriculum"]; ?></td>
                            <td><?php echo $hc_class_offering["reg_inner_html"] ?>
                            </td>
                          </tr><!--
                    --><?php endforeach; ?>

                    </tbody>
                  </table>
                  <?php if( isset($hcTableNote) ): ?>
                    <p class="afterTableNote"><?php echo $hcTableNote ?></p>
                  <?php endif; ?>
                <?php else : ?>

                  <article class="hentry cf" style="display:none;">
                    <header class="article-header">
                      <h1><?php _e( 'Oops! no holiday camps at this time!', 'bonestheme' ); ?></h1>
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
                <?php if ( count($sc_class_offerings) > 0 ) : ?>
                  <div class="regionSelector">
                    <span data-region="seattle">Seattle</span><!--
                 --><span data-region="hawaii">Hawaii</span>
                  </div>

                  <table class="scs classTable">
                    <thead>
                      <tr>
                        <th>Location</th>
                        <th>Dates</th>
                        <th>Session</th>
                        <th>Curriculum</th>
                        <th>Register</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php foreach( $sc_class_offerings as $sc_class_offering ): ?><!--
                        --><tr class="asp classRow <?php echo $sc_class_offering["region"]; ?>Region">
                            <td><?php echo $sc_class_offering["location"]; ?></td>
                            <td><?php echo $sc_class_offering["start_date"]; ?></td>
                            <td><?php echo $sc_class_offering["session"]; ?></td>
                            <td><?php echo $sc_class_offering["curriculum"]; ?></td>
                            <td><?php echo $sc_class_offering["reg_inner_html"] ?></td>
                          </tr><!--
                    --><?php endforeach; ?>
                    </tbody>
                  </table>

                  <?php if( isset($scTableNote) ): ?>
                    <p class="afterTableNote"><?php echo $scTableNote ?></p>
                  <?php endif; ?>
                <?php else : ?>

                  <article class="hentry cf" style="display:none;">
                    <header class="article-header">
                      <h1><?php _e( 'Oops! No summer camps at this time!', 'bonestheme' ); ?></h1>
                    </header>
                  </article>

                <?php endif; ?>
              </div>

            </li>

          </ul>
        </div>

        <?php /*$asp_class_offerings = array(
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
              $hc_class_offerings = array(
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
              
              $sc_class_offerings = array(
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
          <?php if( count($asp_class_offerings) > 0 ): ?>
            <div><span class="jump_to_title"> Quick Scroll To </span></div>
            <a class="mobile_jumpTo" href="#mobile_hc">Holiday Camps</a>
            <a class="mobile_jumpTo" href="#mobile_sc">Summer Camps</a>
          <?php endif; ?>
          <div id="mobile_asp">
            <h2>After School Camps</h2>
              <?php if( count($asp_class_offerings) > 0 ): ?>
                <ul>
                <?php foreach( $asp_class_offerings as $this_class ):?>
                  
                  <li class="mobile_class_listing <?php echo $this_class["region"]; ?>Region">
                    <span><b>@<?php echo $this_class["location"]; ?></b><!--  In <?php echo $this_class["region"]; ?> --></span>
                    <span>On <?php echo $this_class["day_of_the_week"]; ?>s</span>
                    <span><?php echo $this_class["start_date"]." - ".$this_class["end_date"]; ?></span>
                    <span>Level : <?php echo $this_class["curriculum"]; ?></span>
                    <span><?php echo $this_class["reg_inner_html"] ?></span>
                  </li>

                <?php endforeach; ?>
                </ul>
              <?php else: ?>
                <h3>No after scool camps registering at this time</h3>
              <?php endif;?>
          </div>
          <?php if( count($hc_class_offerings) > 0 ): ?>
            <div><span class="jump_to_title"> Quick Scroll To </span></div>
            <a class="mobile_jumpTo" href="#mobile_asp">After School Programs</a>
            <a class="mobile_jumpTo" href="#mobile_sc">Summer Camps</a>
          <?php endif; ?>
          <div id="mobile_hc">
            <h2>Holiday Camps</h2>
              <?php if( count($hc_class_offerings) > 0 ): ?>
                <ul>
                <?php foreach( $hc_class_offerings as $this_class ):?>
                  <li class="mobile_class_listing <?php echo $this_class["region"]; ?>Region">
                    <span><b>@<?php echo $this_class["location"]; ?></b><!--  In <?php echo $this_class["region"]; ?> --></span>
                    <span>On <?php echo $this_class["date"]; ?></span>
                    <span><?php echo $this_class["session"]; ?></span>
                    <span><?php echo $this_class["start_time"]." to ".$this_class["end_time"]; ?></span>
                    <span>Level : <?php echo $this_class["curriculum"]; ?></span>
                    <span><?php echo $this_class["reg_inner_html"] ?></span>
                  </li>
                <?php endforeach; ?>
                </ul>
              <?php else: ?>
                <h3>No holiday camps registering at this time</h3>
              <?php endif;?>
          </div>
          <?php if( count($sc_class_offerings) > 0 ): ?>
            <div><span class="jump_to_title"> Quick Scroll To </span></div>
            <a class="mobile_jumpTo" href="#mobile_asp">After School Programs</a>
            <a class="mobile_jumpTo" href="#mobile_hc">Holiday Camps</a>
          <?php endif; ?>
          <div id="mobile_sc">
            <h2>Summer Camps</h2>
              <?php if( count($sc_class_offerings) > 0 ): ?>
                <ul>
                <?php foreach( $sc_class_offerings as $this_class ):?>
                  <li class="mobile_class_listing <?php echo $this_class["region"]; ?>Region">
                    <p><b>@<?php echo $this_class["location"]; ?></b><!--  In <?php echo $this_class["region"]; ?> --></p>
                    <p>Week Of <b><?php echo $this_class["start_date"]; ?></b></p>
                    <p><?php echo $this_class["session"]; ?></p>
                    <p><img class="minicon_color" src="<?php echo bloginfo('template_directory').'/library/images/'.strtolower($this_class["curriculum"]).'_minicon_color.png'; ?>"><?php echo $this_class["curriculum"]; ?></p>
                    <p><?php echo $this_class["reg_inner_html"] ?></p>
                  </li>
                <?php endforeach; ?>
                </ul>
              <?php else: ?>
                <h3>No summer camps registering at this time</h3>
              <?php endif;?>
          </div>
        </div>


      </main>

  </div>

</div>

<?php 

function get_class_offerings( $class_type ){
  $classes = array();
  $args = array( 
    'post_type' => $class_type,
    'posts_per_page' => -1);

  switch( $class_type ){
    case 'after_school_program':
      $args['meta_key'] = 'location';
      $args['orderby'] = 'meta_value';
      $args['order'] = 'ASC';
      break;
    case 'holiday_camp':
      $args['meta_key'] = 'date';
      $args['orderby'] = 'meta_value';
      $args['order'] = 'ASC';
      break;
    case 'summer_camp':
      $args['meta_query'] = array(
        'relation' => 'AND',
        'location_clause' => array(
          'key' => 'location',
          'compare' => 'EXISTS' ),
        'date_clause' => array(
          'key' => 'start_date',
          'compare' => 'EXISTS' ));
      $args['meta_key'] = 'location';
      $args['orderby'] = array(
        'location_clause' => 'ASC',
        'date_clause' => 'ASC' );
      break;
  }

  $class_posts = new WP_Query( $args );
  if ( $class_posts->have_posts() ) {
    while ( $class_posts->have_posts() ) {
      $class_posts->the_post(); 
      $reg = get_field("reg_open_date");
      if( $reg ){
        $reg_open_date = new DateTime( $reg );
        $this_class = array(
          'region' => get_field("region"),
          'location' => get_field("location"),
          'date' => get_field("date"),
          'start_time' => get_field("start_time"),
          'end_time' => get_field("end_time"),
          'start_date' => get_field("start_date"),
          'end_date' => get_field("end_date"),
          'day_of_the_week' => get_field("day_of_the_week"),
          'session' => get_field("session"),
          'curriculum' => get_field("curriculum"),
          'registration_closed' => get_field("registration_closed"),
          'registration_url' => get_field("reg_link"),
          'external_registration' => get_field("reg_external"),
          'registration_form_hash' => get_field("registration_form_hash"),
          'registration_opens_date' => $reg_open_date
        );

        $reg_date_link_inner_html = '';
        if( $this_class["registration_closed"] ){
          $reg_date_link_inner_html = 'Registration Closed';
        } else{
          if( new DateTime() > $reg_open_date ){
            $reg_url = $this_class['registration_url'];
            $reg_form_hash = $this_class['registration_form_hash'];
            if( !isset($reg_url ) || !$this_class["external_registration"] ){
              if( is_string( $reg_form_hash ) && strlen( $reg_form_hash ) > 3 ){
                $reg_url = './registrationform?hash='.$reg_form_hash;
              } else{
                $reg_url = './registrationform?region='.$this_class["region"].'&classType=asp';
              }
            }
            $reg_date_link_inner_html = '<a class="table_button_link" target="_blank" href="'.$reg_url.'">Register Now!</a>';
          } else{
            $reg_date_link_inner_html = 'Opens on : '.$reg_open_date->format('m/d/y');
          } 
        }
        $this_class['reg_inner_html'] = $reg_date_link_inner_html;

        array_push( $classes, $this_class );
      }
    }
  }
  return $classes;
}

function build_mobile_class_table( $class_type, $classes ){

}

?>




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