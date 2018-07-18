<!doctype html>

<!--[if lt IE 7]><html <?php language_attributes(); ?> class="no-js lt-ie9 lt-ie8 lt-ie7"><![endif]-->
<!--[if (IE 7)&!(IEMobile)]><html <?php language_attributes(); ?> class="no-js lt-ie9 lt-ie8"><![endif]-->
<!--[if (IE 8)&!(IEMobile)]><html <?php language_attributes(); ?> class="no-js lt-ie9"><![endif]-->
<!--[if gt IE 8]><!--> <html <?php language_attributes(); ?> class="no-js"><!--<![endif]-->
	<?php
	  $first_time_visit = false;
		if ( !isset($_COOKIE['firsttime']) )
		{
	    setcookie( "firsttime", "no", time()+315360000 );
	    $first_time_visit = true;
		}

		function ip_details($IPaddress){
        $location_json  = file_get_contents("http://ipinfo.io/{$IPaddress}");
        $location_info = json_decode($location_json);
        return $location_info;
    }
    if ( ! empty( $_SERVER['HTTP_CLIENT_IP'] ) ) {
    	$ip = $_SERVER['HTTP_CLIENT_IP'];
    } elseif ( ! empty( $_SERVER['HTTP_X_FORWARDED_FOR'] ) ) {
    	$ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
    } else {
    	$ip = $_SERVER['REMOTE_ADDR'];
    }


    $location_info = ip_details( $ip );
    // $location_info = ip_details( "66.91.149.122" );//Hawaii test ip
    if(! empty($location_info->region) ){
    	global $user_state;
    	$user_state = $location_info->region;
    }

    
	?>
	<head>
		<meta charset="utf-8">

		<?php // force Internet Explorer to use the latest rendering engine available ?>
		<meta http-equiv="X-UA-Compatible" content="IE=edge">

		<title><?php wp_title(''); ?></title>

		<?php // mobile meta (hooray!) ?>
		<meta name="HandheldFriendly" content="True">
		<meta name="MobileOptimized" content="320">
		<meta name="viewport" content="width=device-width, initial-scale=1">

		<?php // icons & favicons (for more: http://www.jonathantneal.com/blog/understand-the-favicon/) ?>
		<link rel="apple-touch-icon" href="<?php echo get_template_directory_uri(); ?>/library/images/apple-touch-icon.png">
		<link rel="icon" href="<?php echo get_template_directory_uri(); ?>/favicon.png">
		<!--[if IE]>
			<link rel="shortcut icon" href="<?php echo get_template_directory_uri(); ?>/favicon.ico">
		<![endif]-->
		<?php // or, set /favicon.ico for IE10 win ?>
		<meta name="msapplication-TileColor" content="#f01d4f">
		<meta name="msapplication-TileImage" content="<?php echo get_template_directory_uri(); ?>/library/images/win8-tile-icon.png">
            <meta name="theme-color" content="#121212">

		<link rel="pingback" href="<?php bloginfo('pingback_url'); ?>">

		<?php // wordpress head functions ?>
		<?php wp_head(); ?>
		<?php // end of wordpress head ?>

		<?php // drop Google Analytics Here ?>
		<?php // end analytics ?>

	</head>

	<body <?php if( isset($user_state) ) body_class($user_state); else body_class(); ?> itemscope itemtype="http://schema.org/WebPage">

		<div id="container">

			<header class="header" role="banner" itemscope itemtype="http://schema.org/WPHeader">

				<div id="inner-header" class="wrap cf">
          <a class="openNavButton">
            <div class="hamburgerBars">
              <span class="hamburgerBar"></span>
              <span class="hamburgerBar"></span>
              <span class="hamburgerBar"></span>
            </div>
          </a>

					<?php // to use a image just replace the bloginfo('name') with your img src and remove the surrounding <p> ?><?php if( is_page_template( 'page-templates/hawaii.php' ) ) {} ?>

					<p id="logo" class="h1" itemscope itemtype="http://schema.org/Organization"><a href="<?php echo home_url(); ?>" rel="nofollow"><?php bloginfo('name'); ?><?php if( is_page_template( 'page-templates/hawaii.php' ) ) echo " HAWAII"; ?></a></p>

					<p id="image_logo" class="h1" itemscope itemtype="http://schema.org/Organization"><a href="<?php echo home_url(); ?>" rel="nofollow"><img class="image_left" src="<?php echo get_template_directory_uri().'/library/images/logo_white.png' ?>"><img class="image_right" src="<?php echo get_template_directory_uri().'/library/images/logo_white_name_wide_no_c.png' ?>"></a></p>

					<?php // if you'd like to use the site description you can un-comment it below ?>
					<?php // bloginfo('description'); ?>


					<nav role="navigation" itemscope itemtype="http://schema.org/SiteNavigationElement">
						<?php wp_nav_menu(array(
    					         'container' => false,                           // remove nav container
    					         'container_class' => 'menu cf',                 // class of container (should you choose to use it)
    					         'menu' => __( 'The Main Menu', 'bonestheme' ),  // nav name
    					         'menu_class' => 'nav top-nav cf',               // adding custom nav class
    					         'theme_location' => 'main-nav',                 // where it's located in the theme
    					         'before' => '',                                 // before the menu
        			               'after' => '',                                  // after the menu
        			               'link_before' => '',                            // before each link
        			               'link_after' => '',                             // after each link
        			               'depth' => 0,                                   // limit the depth of the nav
    					         'fallback_cb' => ''                             // fallback function (if there is one)
						)); ?>

					</nav>

				</div>

				<?php 
				  $args = array( 'post_type' => 'news_item', 'posts_per_page' => -1 );
				  $news_items = new WP_Query( $args );
				  if ( $news_items->have_posts() ) : 
				  ?>
				    <ul class="latestNews <?php if($first_time_visit){echo 'stopAutoOpen';} ?>">
				      <?php while ( $news_items->have_posts() ) : $news_items->the_post(); ?>
				        <li class="newsItem <?php if( 
				        ( !get_field("start_date") || new DateTime() > new DateTime( get_field("start_date") ) ) && 
				        ( !get_field("end_date") || new DateTime() < new DateTime( get_field("end_date") ) ) 
				        ) { echo "current"; } ?>"
				        data-start-showing="<?php echo get_field("start_date"); ?>"
				        data-stop-showing="<?php echo get_field("end_date"); ?>">
				          <?php echo the_field("content"); ?>
				        </li>
				      <?php endwhile; ?>
				    </ul>
				    <div class="latestNewsCloseButton">Latest News!</div>
				  <?php wp_reset_query(); endif; ?>

			</header>

					
				  