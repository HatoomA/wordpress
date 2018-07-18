<?php
/*
Author: Eddie Machado
URL: http://themble.com/bones/

This is where you can drop your custom functions or
just edit things like thumbnail sizes, header images,
sidebars, comments, etc.
*/

// LOAD BONES CORE (if you remove this, the theme will break)
require_once( 'library/bones.php' );

// CUSTOMIZE THE WORDPRESS ADMIN (off by default)
// require_once( 'library/admin.php' );

/*********************
LAUNCH BONES
Let's get everything up and running.
*********************/

function bones_ahoy() {

  //Allow editor style.
  add_editor_style( get_stylesheet_directory_uri() . '/library/css/editor-style.css' );

  // let's get language support going, if you need it
  load_theme_textdomain( 'bonestheme', get_template_directory() . '/library/translation' );

  // USE THIS TEMPLATE TO CREATE CUSTOM POST TYPES EASILY
  require_once( 'library/custom-post-type.php' );

  // launching operation cleanup
  add_action( 'init', 'bones_head_cleanup' );
  // A better title
  add_filter( 'wp_title', 'rw_title', 10, 3 );
  // remove WP version from RSS
  add_filter( 'the_generator', 'bones_rss_version' );
  // remove pesky injected css for recent comments widget
  add_filter( 'wp_head', 'bones_remove_wp_widget_recent_comments_style', 1 );
  // clean up comment styles in the head
  add_action( 'wp_head', 'bones_remove_recent_comments_style', 1 );
  // clean up gallery output in wp
  add_filter( 'gallery_style', 'bones_gallery_style' );

  // enqueue base scripts and styles
  add_action( 'wp_enqueue_scripts', 'bones_scripts_and_styles', 999 );
  // ie conditional wrapper

  // launching this stuff after theme setup
  bones_theme_support();

  // adding sidebars to Wordpress (these are created in functions.php)
  add_action( 'widgets_init', 'bones_register_sidebars' );

  // cleaning up random code around images
  add_filter( 'the_content', 'bones_filter_ptags_on_images' );
  // cleaning up excerpt
  add_filter( 'excerpt_more', 'bones_excerpt_more' );

} /* end bones ahoy */

// let's get this party started
add_action( 'after_setup_theme', 'bones_ahoy' );


/************* OEMBED SIZE OPTIONS *************/

if ( ! isset( $content_width ) ) {
	$content_width = 680;
}

/************* THUMBNAIL SIZE OPTIONS *************/

// Thumbnail sizes
add_image_size( 'bones-thumb-600', 600, 150, true );
add_image_size( 'bones-thumb-300', 300, 100, true );

/*
to add more sizes, simply copy a line from above
and change the dimensions & name. As long as you
upload a "featured image" as large as the biggest
set width or height, all the other sizes will be
auto-cropped.

To call a different size, simply change the text
inside the thumbnail function.

For example, to call the 300 x 100 sized image,
we would use the function:
<?php the_post_thumbnail( 'bones-thumb-300' ); ?>
for the 600 x 150 image:
<?php the_post_thumbnail( 'bones-thumb-600' ); ?>

You can change the names and dimensions to whatever
you like. Enjoy!
*/

add_filter( 'image_size_names_choose', 'bones_custom_image_sizes' );

function bones_custom_image_sizes( $sizes ) {
    return array_merge( $sizes, array(
        'bones-thumb-600' => __('600px by 150px'),
        'bones-thumb-300' => __('300px by 100px'),
    ) );
}

/*
The function above adds the ability to use the dropdown menu to select
the new images sizes you have just created from within the media manager
when you add media to your content blocks. If you add more image sizes,
duplicate one of the lines in the array and name it according to your
new image size.
*/



//START JACK

//Add a custom user role

add_role( 'teacher', __('Teacher' ), array(
  'read' => true, // true allows this capability
  'edit_posts' => false, // Allows user to edit their own posts
  'edit_pages' => false, // Allows user to edit pages
  'edit_others_posts' => false, // Allows user to edit others posts not just their own
  'create_posts' => false, // Allows user to create new posts
  'manage_categories' => false, // Allows user to manage post categories
  'publish_posts' => false, // Allows the user to publish, otherwise posts stays in draft mode
  'edit_themes' => false, // false denies this capability. User can’t edit your theme
  'install_plugins' => false, // User cant add new plugins
  'update_plugin' => false, // User can’t update any plugins
  'update_core' => false // user cant perform core updates
));

function your_login_redirect( $redirect_to, $request, $user )
{
    // is there a user ?
    if ( isset( $user->roles ) && is_array( $user->roles ) ) {
        // substitute your role(s):
        if ( in_array( 'teacher', $user->roles ) ) {
            // pick where to redirect to, in the example: Posts page
            return site_url( '/bark/index.php' );
        } else {
            return admin_url();
        }
    }
}
add_filter( 'login_redirect', 'your_login_redirect', 10, 3 );

add_role( 'manager', __('Manager'), array(
  'read' => true, // true allows this capability
  'edit_posts' => true, // Allows user to edit their own posts
  'edit_pages' => true, // Allows user to edit pages
  'edit_others_pages' => true, // Allows user to edit others posts not just their own
  'edit_published_pages' => true, // Allows user to edit others posts not just their own
  'edit_others_posts' => true, // Allows user to edit others posts not just their own
  'create_posts' => true, // Allows user to create new posts
  'manage_categories' => true, // Allows user to manage post categories
  'publish_posts' => true, // Allows the user to publish, otherwise posts stays in draft mode
  'edit_themes' => false, // false denies this capability. User can’t edit your theme
  'install_plugins' => false, // User cant add new plugins
  'update_plugin' => false, // User can’t update any plugins
  'update_core' => false, // user cant perform core updates
  'delete_posts' => true,
  'delete_others_posts' => true,
  'delete_published_posts' => true,
  'delete_private_posts' => true,
  'edit_private_posts' => true,
  'read_private_posts' => true,
  'delete_private_pages' => true,
  'edit_private_pages' => true,
  'read_private_pages' => true,
  'delete_users' => true,
  'create_users' => true
));

function getRegion(){
  $region;
  if( !isset($region) ){
    if( isset($_POST['region']) ){
      if( 'seattle' == $_POST['region'] )
        $region = 'seattle';
      elseif( 'hawaii' == $_POST['region'] )
        $region = 'hawaii';
    }
    if( !isset($region) && isset($_GET['region']) ){
      if( 'seattle' == $_GET['region'] )
        $region = 'seattle';
      elseif( 'hawaii' == $_GET['region'] )
        $region = 'hawaii';
    }
    if( !isset($region) && isset($user_state) ){
      if( 'Seattle' == $user_state )
        $region = 'seattle';
      elseif( 'Hawaii' == $user_state )
        $region = 'hawaii';
    }
    if( !isset($region) )
      $region = 'seattle';//default
  }
  return $region;
}





//Start login form edits

function custom_login_logo() { ?>
    <style type="text/css">
        #login h1 a, .login h1 a {
            background-image: url(<?php echo get_stylesheet_directory_uri(); ?>/library/images/logo.png);
            width:320px;
            background-size: 320px 65px;
            background-repeat: no-repeat;
            background-size: contain;
            padding-bottom: 30px;
        }
    </style>
<?php }
add_action( 'login_enqueue_scripts', 'custom_login_logo' );

function my_login_logo_url() {
    return home_url();
}
add_filter( 'login_headerurl', 'my_login_logo_url' );

function my_login_logo_url_title() {
    return 'Creative Coding';
}
add_filter( 'login_headertitle', 'my_login_logo_url_title' );


function change_lost_password(  ) {?>
    <script>
        
    </script>
<?php }

add_action( 'login_enqueue_scripts', 'change_lost_password' );
//END JACK

//START CHRIS
// loads the url that required the login into a session variable
function loadReferer () {
  if (session_status() == PHP_SESSION_NONE) {
    session_start();
  }
  if( isset($_SERVER['HTTP_REFERER']))
    $_SESSION['target_url'] = $_SERVER['HTTP_REFERER'];
}
add_action( 'login_enqueue_scripts', 'loadReferer' );

// redirect to the requested page after login
// $redirect_to and $user are exposed for future use but not 
// currently used
function redirectToReferer( $redirect_to, $request_url, $user ){
  if (session_status() == PHP_SESSION_NONE) {
    session_start();
  }
  // http referer is set and isn't the login page 'to prevent loops'
  $url = isset($_SESSION['target_url']) && strpos($_SESSION['target_url'], 'login') === false ? $_SESSION['target_url'] : home_url();
  return $url;
}
add_filter('login_redirect', 'redirectToReferer', 10, 3);
//END CHRIS

/************* THEME CUSTOMIZE *********************/

/* 
  A good tutorial for creating your own Sections, Controls and Settings:
  http://code.tutsplus.com/series/a-guide-to-the-wordpress-theme-customizer--wp-33722
  
  Good articles on modifying the default options:
  http://natko.com/changing-default-wordpress-theme-customization-api-sections/
  http://code.tutsplus.com/tutorials/digging-into-the-theme-customizer-components--wp-27162
  
  To do:
  - Create a js for the postmessage transport method
  - Create some sanitize functions to sanitize inputs
  - Create some boilerplate Sections, Controls and Settings
*/

function bones_theme_customizer($wp_customize) {
  // $wp_customize calls go here.
  //
  // Uncomment the below lines to remove the default customize sections 

  // $wp_customize->remove_section('title_tagline');
  // $wp_customize->remove_section('colors');
  // $wp_customize->remove_section('background_image');
  // $wp_customize->remove_section('static_front_page');
  // $wp_customize->remove_section('nav');

  // Uncomment the below lines to remove the default controls
  // $wp_customize->remove_control('blogdescription');
  
  // Uncomment the following to change the default section titles
  // $wp_customize->get_section('colors')->title = __( 'Theme Colors' );
  // $wp_customize->get_section('background_image')->title = __( 'Images' );
}

add_action( 'customize_register', 'bones_theme_customizer' );

/************* ACTIVE SIDEBARS ********************/

// Sidebars & Widgetizes Areas
function bones_register_sidebars() {
	register_sidebar(array(
		'id' => 'sidebar1',
		'name' => __( 'Sidebar 1', 'bonestheme' ),
		'description' => __( 'The first (primary) sidebar.', 'bonestheme' ),
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget' => '</div>',
		'before_title' => '<h4 class="widgettitle">',
		'after_title' => '</h4>',
	));

	/*
	to add more sidebars or widgetized areas, just copy
	and edit the above sidebar code. In order to call
	your new sidebar just use the following code:

	Just change the name to whatever your new
	sidebar's id is, for example:

	register_sidebar(array(
		'id' => 'sidebar2',
		'name' => __( 'Sidebar 2', 'bonestheme' ),
		'description' => __( 'The second (secondary) sidebar.', 'bonestheme' ),
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget' => '</div>',
		'before_title' => '<h4 class="widgettitle">',
		'after_title' => '</h4>',
	));

	To call the sidebar in your template, you can just copy
	the sidebar.php file and rename it to your sidebar's name.
	So using the above example, it would be:
	sidebar-sidebar2.php

	*/
} // don't remove this bracket!


/************* COMMENT LAYOUT *********************/

// Disable support for comments and trackbacks in post types
function df_disable_comments_post_types_support() {
  $post_types = get_post_types();
  foreach ($post_types as $post_type) {
    if(post_type_supports($post_type, 'comments')) {
      remove_post_type_support($post_type, 'comments');
      remove_post_type_support($post_type, 'trackbacks');
    }
  }
}
add_action('admin_init', 'df_disable_comments_post_types_support');

// Close comments on the front-end
function df_disable_comments_status() {
  return false;
}
add_filter('comments_open', 'df_disable_comments_status', 20, 2);
add_filter('pings_open', 'df_disable_comments_status', 20, 2);

// Hide existing comments
function df_disable_comments_hide_existing_comments($comments) {
  $comments = array();
  return $comments;
}
add_filter('comments_array', 'df_disable_comments_hide_existing_comments', 10, 2);

// Remove comments page in menu
function df_disable_comments_admin_menu() {
  remove_menu_page('edit-comments.php');
}
add_action('admin_menu', 'df_disable_comments_admin_menu');

// Redirect any user trying to access comments page
function df_disable_comments_admin_menu_redirect() {
  global $pagenow;
  if ($pagenow === 'edit-comments.php') {
    wp_redirect(admin_url()); exit;
  }
}
add_action('admin_init', 'df_disable_comments_admin_menu_redirect');

// Remove comments metabox from dashboard
function df_disable_comments_dashboard() {
  remove_meta_box('dashboard_recent_comments', 'dashboard', 'normal');
}
add_action('admin_init', 'df_disable_comments_dashboard');

// Remove comments links from admin bar
function df_disable_comments_admin_bar() {
  if (is_admin_bar_showing()) {
    remove_action('admin_bar_menu', 'wp_admin_bar_comments_menu', 60);
  }
}
add_action('init', 'df_disable_comments_admin_bar');


/*
This is a modification of a function found in the
twentythirteen theme where we can declare some
external fonts. If you're using Google Fonts, you
can replace these fonts, change it in your scss files
and be up and running in seconds.
*/
function bones_fonts() {
  wp_enqueue_style('googleFonts', 'https://fonts.googleapis.com/css?family=Quicksand:400,700,300|Muli:400,300italic,400italic,300');
}

add_action('wp_enqueue_scripts', 'bones_fonts');


//Let's hide the default editor for the page templates that don't need one

add_action( 'admin_head', 'hide_editor' );

function hide_editor() {
    global $pagenow;
    if( !( 'post.php' == $pagenow ) ) return;

    global $post;
    // Get the Post ID.
    $post_id = $_GET['post'] ? $_GET['post'] : $_POST['post_ID'] ;
    if( !isset( $post_id ) ) return;
    // Hide the editor on a page with a specific page template
    // Get the name of the Page Template file.
    $template_file = get_post_meta($post_id, '_wp_page_template', true);
    if( strpos($template_file, 'page-') !== false && $template_file ){ // the filename of the page template
      remove_post_type_support('page', 'editor');
    }
}

require_once('wufoo/WufooApiExamples.php');

/* Enable Categories for media items */
function add_categories_for_attachments() {
    register_taxonomy_for_object_type( 'category', 'attachment' );
}
add_action( 'init' , 'add_categories_for_attachments' );


//START CONTACT US FORM RECEIVER

function send_contact_email() {
  if ( isset($_REQUEST) ) {

    if( isset($_REQUEST['name']) && isset($_REQUEST['email']) && isset($_REQUEST['subject']) && isset($_REQUEST['message']) ){

      $title   = 'Contact Us Form from '.$_REQUEST['name'];
      $headers = array('From: '.$_REQUEST['name'].' <'.$_REQUEST['email'].'>');
      $target = $_REQUEST['target'];
      $subject = $_REQUEST['subject'];
      $message = "<strong>SUBJECT</strong><br>".$subject."<br><br><strong>MESSAGE</strong><br>".$_REQUEST['message'];

      //Send the email
      add_filter('wp_mail_content_type', create_function('', 'return "text/html"; '));//INCLUDE SUBJECT IN EMAIL BODY
      $email = wp_mail($target.'@creativecoding.com', $title, $message, $headers);
      remove_filter('wp_mail_content_type', 'set_html_content_type');

      echo '{ "note" : "We emailed '.$target.'@creativecoding.com with your inquiry, expect a reply shortly!", "status" : "success"}';
      
    }

  } else{
    echo '{ "note" : "Failed to send.", "status" : "success"}';
  }
  die();
}

add_action( 'wp_ajax_nopriv_send_contact_email', 'send_contact_email' );

?>