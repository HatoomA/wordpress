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


  $asp_class_offerings = get_class_offerings( 'after_school_program' );
  $hc_class_offerings = get_class_offerings( 'holiday_camp' );
  $sc_class_offerings = get_class_offerings( 'summer_camp' );
?>

<div id="content" class="programs register">

  <div id="inner-content" class="wrap cf <?php echo getRegion(); ?>">

      <main id="main" class="m-all t-3of3 d-7of7 cf" role="main" itemscope itemprop="mainContentOfPage" itemtype="http://schema.org/Blog">

        <div class="contentSection coursePrograms">

          <h2>Find Your Class</h2>

          <div id="table_filters" data-target-table="classes_table">
            <select id="offering">
              <option selected value="-1">All Offerings</option>
              <option value="asp">After School Programs</option>
              <option value="hc">Holiday Camps</option>
              <option value="sc">Summer Camps</option>
            </select>
            <select id="area">
              <option selected value="-1">All Areas</option>
              <option value='sl'>Shoreline</option>
              <option value='mercer'>Mercer Island</option>
              <option value='bellevue'>Bellevue</option>
              <option value='norm'>Normandy Park</option>
              <option value='oahu'>Oahu</option>
              <option value='s_nw'>Seattle NW</option>
              <option value='s_ne'>Seattle NE</option>
              <option value='s_mag'>Seattle Magnolia</option>
              <option value='s_slu'>Seattle South Lake Union</option>
              <option value='s_w'>Seattle West</option>
              <option value='s_s'>Seattle South</option>
            </select>
            <select id="curriculum">
              <option selected value="-1">All Programs</option>
              <option value="core">Core</option>
              <option value="junior">Junior</option>
              <option value="studio">Studio</option>
            </select>
            <div class="checkbox_wrapper">
              <input type="checkbox" id="registration_open" checked />
              <label for="registration_open">Show only classes registering now</label>
            </div>
          </div>

          <div class="classes_table_wrapper">
            <table id="classes_table">
              <tbody>
                <?php foreach( $asp_class_offerings as $asp_class_offering ): ?><!--
               --><tr class="asp classRow" data-offering="asp" data-curriculum="<?php echo $asp_class_offering["curriculum"]; ?>" data-area="<?php echo $asp_class_offering["area"]; ?>" data-registration_open="<?php echo $asp_class_offering["registration_open"]; ?>">

                    <td class="offering">
                      <img class="offering_thumb" src="<?php echo bloginfo('template_directory').'/library/images/aspPixels.png' ?>">
                      <img class="offering_label" src="<?php echo bloginfo('template_directory').'/library/images/'.strtolower($asp_class_offering["curriculum"]).'_minicon_color.png'; ?>">
                      <?php if( isset($asp_class_offering['special_enrollment_restriction']) ): ?>
                        <div class="restriction"><img class="restriction_sym" src="<?php echo bloginfo('template_directory').'/library/images/pixel_red_plus.png' ?>"><span class="restriction_text"><?php echo $asp_class_offering['special_enrollment_restriction']; ?> only</span></div>
                      <?php endif; ?>
                    </td>
                    <td class="location">
                      <p><img class="pin" src="<?php echo bloginfo('template_directory').'/library/images/pixel_pin.png' ?>"> <?php echo $asp_class_offering["location"]; ?></p>
                      <div class="tags">
                        <span class="<?php echo $asp_class_offering["curriculum"]; ?> tag"><?php echo $asp_class_offering["curriculum"]; ?></span>
                        <span class="asp tag">after school</span>
                      </div>
                    </td>
                    <td class="date_time">
                      <b><?php echo $asp_class_offering["day_of_the_week"]; ?>s</b><br><?php echo $asp_class_offering["start_date"]; ?> - <?php echo $asp_class_offering["end_date"]; ?>
                    </td>
                    <td class="register">
                      <?php echo $asp_class_offering['reg_inner_html'] ?>
                    </td>

                  </tr><!--
             --><?php  endforeach;
                foreach ( $hc_class_offerings as $hc_class_offering ): ?><!--
               --><tr class="hc classRow" data-offering="hc" data-curriculum="<?php echo $hc_class_offering["curriculum"]; ?>" data-area="<?php echo $hc_class_offering["area"]; ?>" data-registration_open="<?php echo $hc_class_offering["registration_open"]; ?>">
                    <td class="offering">
                      <img class="offering_thumb" src="<?php echo bloginfo('template_directory').'/library/images/hcPixels.png' ?>">
                      <img class="offering_label" src="<?php echo bloginfo('template_directory').'/library/images/'.strtolower($hc_class_offering["curriculum"]).'_minicon_color.png'; ?>">
                      <?php if( isset($hc_class_offering['special_enrollment_restriction']) ): ?>
                        <div class="restriction"><img class="restriction_sym" src="<?php echo bloginfo('template_directory').'/library/images/pixel_red_plus.png' ?>"><span class="restriction_text"><?php echo $hc_class_offering['special_enrollment_restriction']; ?> only</span></div>
                      <?php endif; ?>
                    </td>
                    <td class="location">
                      <p><img class="pin" src="<?php echo bloginfo('template_directory').'/library/images/pixel_pin.png' ?>"> <?php echo $hc_class_offering["location"]; ?></p>
                      <div class="tags">
                        <span class="<?php echo $hc_class_offering["curriculum"]; ?> tag"><?php echo $hc_class_offering["curriculum"]; ?></span>
                        <span class="hc tag">after school</span>
                      </div>
                    </td>
                    <td class="date_time">
                      <?php echo $hc_class_offering["date"]; ?><br><?php echo $hc_class_offering["start_time"]; ?> - <?php echo $hc_class_offering["end_time"]; ?>
                    </td>
                    <td class="register">
                      <?php echo $hc_class_offering["reg_inner_html"] ?>
                    </td>
                  </tr><!--
             --><?php endforeach;
                foreach( $sc_class_offerings as $sc_class_offering ): ?><!--
               --><tr class="sc classRow" data-offering="sc" data-curriculum="<?php echo $sc_class_offering["curriculum"]; ?>" data-area="<?php echo $sc_class_offering["area"]; ?>" data-registration_open="<?php echo $sc_class_offering["registration_open"]; ?>">
                    <td class="offering">
                      <img class="offering_thumb" src="<?php echo bloginfo('template_directory').'/library/images/scPixels.png' ?>">
                      <img class="offering_label" src="<?php echo bloginfo('template_directory').'/library/images/'.strtolower($sc_class_offering["curriculum"]).'_minicon_color.png'; ?>">
                      <?php if( isset($sc_class_offering['special_enrollment_restriction']) ): ?>
                        <div class="restriction"><img class="restriction_sym" src="<?php echo bloginfo('template_directory').'/library/images/pixel_red_plus.png' ?>"><span class="restriction_text"><?php echo $sc_class_offering['special_enrollment_restriction']; ?> only</span></div>
                      <?php endif; ?>
                    </td>
                    <td class="location">
                      <p><img class="pin" src="<?php echo bloginfo('template_directory').'/library/images/pixel_pin.png' ?>"> <?php echo $sc_class_offering["location"]; ?></p>
                      <div class="tags">
                        <span class="<?php echo $sc_class_offering["curriculum"]; ?> tag"><?php echo $sc_class_offering["curriculum"]; ?></span>
                        <span class="sc tag">summer camp</span>
                      </div>
                    </td>
                    <td class="date_time">
                      <b><?php echo $sc_class_offering["session"]; ?>s</b><br>Week of <?php echo $sc_class_offering["start_date"]; ?>
                    </td>
                    <td class="register">
                      <?php echo $sc_class_offering["reg_inner_html"] ?>
                        
                      </td>
                  </tr><!--
             --><?php endforeach; ?>
               <tfoot>
                <tr class="empty_note">
                  <td>
                    <div>
                      <h2>Oops! No classes match your search at this time.</h2>
                      <p><a target="_blank" href="../contact/">Email Us</a> about bringing Creative Coding to your school!</p>
                    </div>
                  </td>
                </tr>
              </tfoot>
              </tbody>
            </table>
          </div>
        </div>

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
          'curriculum' => strtolower(explode(' ',trim( get_field("curriculum") ))[0]),
          'area' => get_field("area"),
          'registration_closed' => get_field("registration_closed"),
          'wait_list_only' => get_field("wait_list_only"),
          'registration_url' => get_field("reg_link"),
          'external_registration' => get_field("reg_external"),
          'registration_form_hash' => get_field("registration_form_hash"),
          'registration_opens_date' => $reg_open_date
        );

        if( count(explode(' ',trim( get_field("curriculum") ))) > 1 ){
          $restriction = strtolower(explode(' ',trim( get_field("curriculum") ))[1]);
          $this_class['special_enrollment_restriction'] = $restriction;
        }

        $this_class['registration_open'] = "false";
        $reg_date_link_inner_html = '';
        if( $this_class["registration_closed"] ){
          $reg_date_link_inner_html = '<a class="table_button_link greyed" disabled>Registration Closed</a>';
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
            if( $this_class['wait_list_only'] ){
              $reg_date_link_inner_html = '<a class="table_button_link" target="_blank" href="'.$reg_url.'">Get on the Waitlist!</a>';
            }else{
              $reg_date_link_inner_html = '<a class="table_button_link" target="_blank" href="'.$reg_url.'">Register Now!</a>';
            }
            $this_class['registration_open'] = "true";
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

?>


<?php get_footer(); ?>