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

<?php get_header(); 
  $scLiveDateTime = DateTime::createFromFormat('d-m-y H:i', get_field("sc_registration_opens_date").' '.get_field("sc_registration_opens_time"));
  $hcLiveDateTime = DateTime::createFromFormat('d-m-y H:i', get_field("hc_registration_opens_date").' '.get_field("hc_registration_opens_time"));
  $aspLiveDateTime = DateTime::createFromFormat('d-m-y H:i', get_field("asp_registration_opens_date").' '.get_field("asp_registration_opens_time"));
  $scLiveDateTime = new DateTime( get_field("sc_registration_opens_date").' '.get_field("sc_registration_opens_time") );
  $hcLiveDateTime = new DateTime( get_field("hc_registration_opens_date").' '.get_field("hc_registration_opens_time") );
  $aspLiveDateTime = new DateTime( get_field("asp_registration_opens_date").' '.get_field("asp_registration_opens_time") );
?>

<?php get_header(); ?>

<div id="content" class="programs">

  <div class="hero">
    <img src="<?php the_field('hero_image'); ?>">
    <h3>Course Programs</h3>
  </div>

  <div id="inner-content" class="wrap cf">

      <main id="main" class="m-all t-3of3 d-7of7 cf" role="main" itemscope itemprop="mainContentOfPage" itemtype="http://schema.org/Blog">

        <div class="contentSection coursePrograms">

          <ul class="imageList coursePrograms">
            <li class="asp">
              <a class="anchor" id="asp"></a>
              <img src="<?php echo bloginfo('template_directory').'/library/images/aspPixels.png' ?>">
              <div class="liContent">
                <h2>After School Programs</h2>
                <div class="jumpTos">
                  <span class="label">Jump To:</span>
                  <a href="#hc">Holiday Camps</a>
                  <span>|</span>
                  <a href="#sc">Summer Camps</a>
                </div>
                <p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Donec quam felis, ultricies nec, pellentesque eu, pretium quis, sem.</p>
                <p>Nulla consequat massa quis enim. Donec pede justo, fringilla vel, aliquet nec, vulputate eget, arcu. In enim justo, rhoncus ut, imperdiet a, venenatis vitae, justo.</p>
                <p>Nullam dictum felis eu pede mollis pretium. Integer tincidunt. Cras dapibus. Vivamus elementum semper nisi. Aenean vulputate eleifend tellus. Aenean leo ligula, porttitor eu, consequat vitae, eleifend ac, enim. Aliquam lorem ante, dapibus in, viverra quis, feugiat a</p>
                <!-- <a class="buttonLink" href="./register#asp">view schedule</a> -->
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
                    <tr>
                      <th>Location</th>
                      <th>Dates</th>
                      <th>Day of Week</th>
                      <th>Level</th>
                      <!--<th>Register</th>-->
                    </tr>
                      <?php while ( $asps->have_posts() ) : $asps->the_post(); ?><!--

                      --><tr class="asp">
                          <td><?php echo the_field("location"); ?></td>
                          <td><?php the_field("start_date"); ?> - <?php the_field("end_date"); ?></td>
                          <td><?php the_field("day_of_the_week"); ?></td>
                          <td><?php echo the_field("level"); ?></td>
                          <!--<td><input type="checkbox" name="uniqueTag" value="<?php echo the_field("tag"); ?>"></td>-->
                        </tr><!--

                    --><?php endwhile; ?>

                    </tbody>
                  </table>
                  <?php if (new DateTime() > $aspLiveDateTime) : ?>
                    <a class="buttonLink" onclick="jQuery(this).closest('form').submit()">Register Now!</a>
                  <?php else : ?>
                    <h3>Registration for After School Camps opens again on <?php echo $aspLiveDateTime->format('d/m/y').' after '.$aspLiveDateTime->format('h:ia'); ?></h3>
                  <?php endif; ?>

                </form>
              <?php else : ?>

                <article id="post-not-found" class="hentry cf">
                  <header class="article-header">
                    <h1><?php _e( 'Oops! No After School Programs at this Time!', 'bonestheme' ); ?></h1>
                  </header>
                </article>

              <?php endif; ?>

            </li>
            <li class="hc">
              <a class="anchor" id="hc"></a>
              <img src="<?php echo bloginfo('template_directory').'/library/images/hcPixels.png' ?>">
              <div class="liContent">
                <h2>All Day Holiday Camps</h2>
                <div class="jumpTos">
                  <span class="label">Jump To:</span>
                  <a href="#asp">After School Programs</a>
                  <span>|</span>
                  <a href="#sc">Summer Camps</a>
                </div>
                <p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Donec quam felis, ultricies nec, pellentesque eu, pretium quis, sem.</p>
                <p>Nulla consequat massa quis enim. Donec pede justo, fringilla vel, aliquet nec, vulputate eget, arcu. In enim justo, rhoncus ut, imperdiet a, venenatis vitae, justo.</p>
                <p>Nullam dictum felis eu pede mollis pretium. Integer tincidunt. Cras dapibus. Vivamus elementum semper nisi. Aenean vulputate eleifend tellus. Aenean leo ligula, porttitor eu, consequat vitae, eleifend ac, enim. Aliquam lorem ante, dapibus in, viverra quis, feugiat a</p>
              </div>
              <?php 
                $args = array( 'post_type' => 'holiday_camp', 'posts_per_page' => -1 );
                $hcs = new WP_Query( $args );
                if ( $hcs->have_posts() ) : 
              ?>

                <form method="POST" action="./registrationform">
                <input type="hidden" name="classType" value="hc">

                  <table class="hcs classTable">
                    <tbody>
                    <tr>
                      <th>Location</th>
                      <th>Date</th>
                      <th>Session</th>
                      <th>Time</th>
                      <th>Level</th>
                      <!--<th>Register</th>-->
                    </tr>

                      <?php while ( $hcs->have_posts() ) : $hcs->the_post(); ?><!--

                      --><tr class="hc">
                          <td><?php echo the_field("location"); ?></td>
                          <td><?php the_field("date"); ?></td>
                          <td><?php the_field("session"); ?></td>
                          <td><?php the_field("start_time"); ?> - <?php the_field("end_time"); ?></td>
                          <td><?php echo the_field("level"); ?></td>
                          <!--<td><input type="checkbox" name="uniqueTag" value="<?php echo the_field("tag"); ?>"></td>-->
                        </tr><!--

                    --><?php endwhile; ?>

                    </tbody>
                  </table>
                  <?php if (new DateTime() > $hcLiveDateTime) : ?>
                    <a class="buttonLink" onclick="jQuery(this).closest('form').submit()">Register Now!</a>
                  <?php else : ?>
                    <h3>Registration for Holiday Camps opens again on <?php echo $aspLiveDateTime->format('d/m/y').' after '.$aspLiveDateTime->format('h:ia'); ?></h3>
                  <?php endif; ?>

                </form>
              <?php else : ?>

                <article id="post-not-found" class="hentry cf">
                  <header class="article-header">
                    <h1><?php _e( 'Oops! No Holiday Camps at this Time!', 'bonestheme' ); ?></h1>
                  </header>
                </article>

              <?php endif; ?>
            </li>
            <li class="sc">
              <a class="anchor" id="sc"></a>
              <img src="<?php echo bloginfo('template_directory').'/library/images/scPixels.png' ?>">
              <div class="liContent">
                <h2>Summer Camps</h2>
                <div class="jumpTos">
                  <span class="label">Jump To:</span>
                  <a href="#asp">After School Programs</a>
                  <span>|</span>
                  <a href="#hc">Holiday Camps</a>
                </div>
                <p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Donec quam felis, ultricies nec, pellentesque eu, pretium quis, sem.</p>
                <p>Nulla consequat massa quis enim. Donec pede justo, fringilla vel, aliquet nec, vulputate eget, arcu. In enim justo, rhoncus ut, imperdiet a, venenatis vitae, justo.</p>
                <p>Nullam dictum felis eu pede mollis pretium. Integer tincidunt. Cras dapibus. Vivamus elementum semper nisi. Aenean vulputate eleifend tellus. Aenean leo ligula, porttitor eu, consequat vitae, eleifend ac, enim. Aliquam lorem ante, dapibus in, viverra quis, feugiat a</p>
              </div>

              <?php 
                $args = array( 'post_type' => 'summer_camp', 'posts_per_page' => -1 );
                $scs = new WP_Query( $args );
                if ( $scs->have_posts() ) : 
              ?>

                <form method="POST" action="./registrationform">
                <input type="hidden" name="classType" value="sc">

                  <table class="scs classTable">
                    <tbody>
                    <tr>
                      <th>Location</th>
                      <th>Dates</th>
                      <th>Day of Week</th>
                      <th>Level</th>
                      <!--<th>Register</th>-->
                    </tr>

                      <?php while ( $scs->have_posts() ) : $scs->the_post(); ?><!--

                      --><tr class="sc">
                          <td><?php echo the_field("location"); ?></td>
                          <td><?php the_field("start_date"); ?> - <?php the_field("end_date"); ?></td>
                          <td><?php the_field("session"); ?></td>
                          <td><?php echo the_field("level"); ?></td>
                          <!--<td><input type="checkbox" name="uniqueTag" value="<?php echo the_field("tag"); ?>"></td>-->
                        </tr><!--

                    --><?php endwhile; ?>

                    </tbody>
                  </table>
                  <?php if (new DateTime() > $scLiveDateTime) : ?>
                    <a class="buttonLink" onclick="jQuery(this).closest('form').submit()">Register Now!</a>
                  <?php else : ?>
                    <h3>Registration for Summer Camps opens again on <?php echo $aspLiveDateTime->format('d/m/y').' after '.$aspLiveDateTime->format('h:ia'); ?></h3>
                  <?php endif; ?>
                </form>
              <?php else : ?>

                <article id="post-not-found" class="hentry cf">
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


<?php get_footer(); ?>
