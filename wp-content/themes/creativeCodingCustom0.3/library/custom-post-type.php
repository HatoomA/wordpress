<?php
/* Bones Custom Post Type Example
This page walks you through creating 
a custom post type and taxonomies. You
can edit this one or copy the following code 
to create another one. 

I put this in a separate file so as to 
keep it organized. I find it easier to edit
and change things if they are concentrated
in their own file.

Developed by: Eddie Machado
URL: http://themble.com/bones/
*/

// Flush rewrite rules for custom post types
add_action( 'after_switch_theme', 'bones_flush_rewrite_rules' );

// Flush your rewrite rules
function bones_flush_rewrite_rules() {
	flush_rewrite_rules();
}

// let's create the function for the custom type
function custom_post_teacher() { 
	// creating (registering) the custom type 
	register_post_type( 'teacher', /* (http://codex.wordpress.org/Function_Reference/register_post_type) */
		// let's now add all the options for this post type
		array( 'labels' => array(
			'name' => __( 'Teacher Bios', 'bonestheme' ), /* This is the Title of the Group */
			'singular_name' => __( 'Teacher Bio', 'bonestheme' ), /* This is the individual type */
			'all_items' => __( 'All Teacher Bios', 'bonestheme' ), /* the all items menu item */
			'add_new' => __( 'Add New Teacher Bio', 'bonestheme' ), /* The add new menu item */
			'add_new_item' => __( 'Add New Teacher Bio', 'bonestheme' ), /* Add New Display Title */
			'edit' => __( 'Edit', 'bonestheme' ), /* Edit Dialog */
			'edit_item' => __( 'Edit Teacher Bios', 'bonestheme' ), /* Edit Display Title */
			'new_item' => __( 'New Teacher Bio', 'bonestheme' ), /* New Display Title */
			'view_item' => __( 'View Teacher Bio', 'bonestheme' ), /* View Display Title */
			'search_items' => __( 'Search Teacher Bio', 'bonestheme' ), /* Search Custom Type Title */ 
			'not_found' =>  __( 'Nothing found in the Database.', 'bonestheme' ), /* This displays if there are no entries yet */ 
			'not_found_in_trash' => __( 'Nothing found in Trash', 'bonestheme' ), /* This displays if there is nothing in the trash */
			'parent_item_colon' => ''
			), /* end of arrays */
			'description' => __( 'Members of our teaching staff', 'bonestheme' ), /* Custom Type Description */
			'public' => true,
			'publicly_queryable' => true,
			'exclude_from_search' => false,
			'show_ui' => true,
			'query_var' => true,
			'menu_position' => 2.1, /* this is what order you want it to appear in on the left hand side menu */ 
			'menu_icon' => get_stylesheet_directory_uri() . '/library/images/teacher-icon.png', /* the icon for the custom post type menu */
			'rewrite'	=> array( 'slug' => 'teacher', 'with_front' => false ), /* you can specify its url slug */
			'capability_type' => 'post',
			'hierarchical' => false,
			/* the next one is important, it tells what's enabled in the post editor */
			'supports' => array( 'title' )
		) /* end of options */
	); /* end of register post type */
	
}

	// adding the function to the Wordpress init
	add_action( 'init', 'custom_post_teacher');

// let's create the function for the custom type
function custom_post_testimonial() { 
	// creating (registering) the custom type 
	register_post_type( 'testimonial', /* (http://codex.wordpress.org/Function_Reference/register_post_type) */
		// let's now add all the options for this post type
		array( 'labels' => array(
			'name' => __( 'Testimonials', 'bonestheme' ), /* This is the Title of the Group */
			'singular_name' => __( 'Testimonial', 'bonestheme' ), /* This is the individual type */
			'all_items' => __( 'All Testimonials', 'bonestheme' ), /* the all items menu item */
			'add_new' => __( 'Add New', 'bonestheme' ), /* The add new menu item */
			'add_new_item' => __( 'Add New Testimonial', 'bonestheme' ), /* Add New Display Title */
			'edit' => __( 'Edit', 'bonestheme' ), /* Edit Dialog */
			'edit_item' => __( 'Edit Testimonials', 'bonestheme' ), /* Edit Display Title */
			'new_item' => __( 'New Testimonial', 'bonestheme' ), /* New Display Title */
			'view_item' => __( 'View Testimonial', 'bonestheme' ), /* View Display Title */
			'search_items' => __( 'Search Testimonial', 'bonestheme' ), /* Search Custom Type Title */ 
			'not_found' =>  __( 'Nothing found in the Database.', 'bonestheme' ), /* This displays if there are no entries yet */ 
			'not_found_in_trash' => __( 'Nothing found in Trash', 'bonestheme' ), /* This displays if there is nothing in the trash */
			'parent_item_colon' => ''
			), /* end of arrays */
			'description' => __( 'Members of our teaching staff', 'bonestheme' ), /* Custom Type Description */
			'public' => true,
			'publicly_queryable' => true,
			'exclude_from_search' => false,
			'show_ui' => true,
			'query_var' => true,
			'menu_position' => 2.1, /* this is what order you want it to appear in on the left hand side menu */ 
			'menu_icon' => get_stylesheet_directory_uri() . '/library/images/testimonial-icon.png', /* the icon for the custom post type menu */
			'rewrite'	=> array( 'slug' => 'testimonial', 'with_front' => false ), /* you can specify its url slug */
			'has_archive' => true, /* you can rename the slug here */
			'capability_type' => 'post', 
			'hierarchical' => false,
			/* the next one is important, it tells what's enabled in the post editor */
			'supports' => array( 'title' )
		) /* end of options */
	); /* end of register post type */
	
}

	// adding the function to the Wordpress init
	add_action( 'init', 'custom_post_testimonial');

// let's create the function for the custom type
function custom_post_asp() { 
	// creating (registering) the custom type 
	register_post_type( 'after_school_program', /* (http://codex.wordpress.org/Function_Reference/register_post_type) */
		// let's now add all the options for this post type
		array( 'labels' => array(
			'name' => __( 'After School Programs', 'bonestheme' ), /* This is the Title of the Group */
			'singular_name' => __( 'After School Program', 'bonestheme' ), /* This is the individual type */
			'all_items' => __( 'All After School Programs', 'bonestheme' ), /* the all items menu item */
			'add_new' => __( 'Add New', 'bonestheme' ), /* The add new menu item */
			'add_new_item' => __( 'Add New After School Program', 'bonestheme' ), /* Add New Display Title */
			'edit' => __( 'Edit', 'bonestheme' ), /* Edit Dialog */
			'edit_item' => __( 'Edit After School Programs', 'bonestheme' ), /* Edit Display Title */
			'new_item' => __( 'New After School Program', 'bonestheme' ), /* New Display Title */
			'view_item' => __( 'View After School Program', 'bonestheme' ), /* View Display Title */
			'search_items' => __( 'Search After School Program', 'bonestheme' ), /* Search Custom Type Title */ 
			'not_found' =>  __( 'Nothing found in the Database.', 'bonestheme' ), /* This displays if there are no entries yet */ 
			'not_found_in_trash' => __( 'Nothing found in Trash', 'bonestheme' ), /* This displays if there is nothing in the trash */
			'parent_item_colon' => ''
			), /* end of arrays */
			'description' => __( 'Our after school programs', 'bonestheme' ), /* Custom Type Description */
			'public' => true,
			'publicly_queryable' => true,
			'exclude_from_search' => false,
			'show_ui' => true,
			'query_var' => true,
			'menu_position' => 2.1, /* this is what order you want it to appear in on the left hand side menu */ 
			'menu_icon' => get_stylesheet_directory_uri() . '/library/images/asp-icon.png', /* the icon for the custom post type menu */
			'rewrite'	=> array( 'slug' => 'asp', 'with_front' => false ), /* you can specify its url slug */
			'capability_type' => 'post',
			'hierarchical' => false,
			/* the next one is important, it tells what's enabled in the post editor */
			'supports' => array( 'title' )
		) /* end of options */
	); /* end of register post type */
	
}

// adding the function to the Wordpress init
add_action( 'init', 'custom_post_asp');

// let's create the function for the custom type
function custom_post_sc() { 
	// creating (registering) the custom type 
	register_post_type( 'summer_camp', /* (http://codex.wordpress.org/Function_Reference/register_post_type) */
		// let's now add all the options for this post type
		array( 'labels' => array(
			'name' => __( 'Summer Camps', 'bonestheme' ), /* This is the Title of the Group */
			'singular_name' => __( 'Summer Camp', 'bonestheme' ), /* This is the individual type */
			'all_items' => __( 'All Summer Camps', 'bonestheme' ), /* the all items menu item */
			'add_new' => __( 'Add New', 'bonestheme' ), /* The add new menu item */
			'add_new_item' => __( 'Add New Summer Camp', 'bonestheme' ), /* Add New Display Title */
			'edit' => __( 'Edit', 'bonestheme' ), /* Edit Dialog */
			'edit_item' => __( 'Edit Summer Camps', 'bonestheme' ), /* Edit Display Title */
			'new_item' => __( 'New Summer Camp', 'bonestheme' ), /* New Display Title */
			'view_item' => __( 'View Summer Camp', 'bonestheme' ), /* View Display Title */
			'search_items' => __( 'Search Summer Camp', 'bonestheme' ), /* Search Custom Type Title */ 
			'not_found' =>  __( 'Nothing found in the Database.', 'bonestheme' ), /* This displays if there are no entries yet */ 
			'not_found_in_trash' => __( 'Nothing found in Trash', 'bonestheme' ), /* This displays if there is nothing in the trash */
			'parent_item_colon' => ''
			), /* end of arrays */
			'description' => __( 'Our summer camps', 'bonestheme' ), /* Custom Type Description */
			'public' => true,
			'publicly_queryable' => true,
			'exclude_from_search' => false,
			'show_ui' => true,
			'query_var' => true,
			'menu_position' => 2.1, /* this is what order you want it to appear in on the left hand side menu */ 
			'menu_icon' => get_stylesheet_directory_uri() . '/library/images/sc-icon.png', /* the icon for the custom post type menu */
			'rewrite'	=> array( 'slug' => 'sc', 'with_front' => false ), /* you can specify its url slug */
			'capability_type' => 'post',
			'hierarchical' => false,
			/* the next one is important, it tells what's enabled in the post editor */
			'supports' => array( 'title' )
		) /* end of options */
	); /* end of register post type */
	
}

	// adding the function to the Wordpress init
	add_action( 'init', 'custom_post_sc');

// let's create the function for the custom type
function custom_post_hc() { 
	// creating (registering) the custom type 
	register_post_type( 'holiday_camp', /* (http://codex.wordpress.org/Function_Reference/register_post_type) */
		// let's now add all the options for this post type
		array( 'labels' => array(
			'name' => __( 'Holiday Camps', 'bonestheme' ), /* This is the Title of the Group */
			'singular_name' => __( 'Holiday Camp', 'bonestheme' ), /* This is the individual type */
			'all_items' => __( 'All Holiday Camps', 'bonestheme' ), /* the all items menu item */
			'add_new' => __( 'Add New', 'bonestheme' ), /* The add new menu item */
			'add_new_item' => __( 'Add New Holiday Camp', 'bonestheme' ), /* Add New Display Title */
			'edit' => __( 'Edit', 'bonestheme' ), /* Edit Dialog */
			'edit_item' => __( 'Edit Holiday Camps', 'bonestheme' ), /* Edit Display Title */
			'new_item' => __( 'New Holiday Camp', 'bonestheme' ), /* New Display Title */
			'view_item' => __( 'View Holiday Camp', 'bonestheme' ), /* View Display Title */
			'search_items' => __( 'Search Holiday Camp', 'bonestheme' ), /* Search Custom Type Title */ 
			'not_found' =>  __( 'Nothing found in the Database.', 'bonestheme' ), /* This displays if there are no entries yet */ 
			'not_found_in_trash' => __( 'Nothing found in Trash', 'bonestheme' ), /* This displays if there is nothing in the trash */
			'parent_item_colon' => ''
			), /* end of arrays */
			'description' => __( 'Our holiday camps', 'bonestheme' ), /* Custom Type Description */
			'public' => true,
			'publicly_queryable' => true,
			'exclude_from_search' => false,
			'show_ui' => true,
			'query_var' => true,
			'menu_position' => 2.1, /* this is what order you want it to appear in on the left hand side menu */ 
			'menu_icon' => get_stylesheet_directory_uri() . '/library/images/hc-icon.png', /* the icon for the custom post type menu */
			'rewrite'	=> array( 'slug' => 'hc', 'with_front' => false ), /* you can specify its url slug */
			'capability_type' => 'post',
			'hierarchical' => false,
			/* the next one is important, it tells what's enabled in the post editor */
			'supports' => array( 'title' )
		) /* end of options */
	); /* end of register post type */
	
}

	// adding the function to the Wordpress init
	add_action( 'init', 'custom_post_hc');
	
	
// let's create the function for the custom type
function custom_post_our_news() { 
	// creating (registering) the custom type 
	register_post_type( 'news_item', /* (http://codex.wordpress.org/Function_Reference/register_post_type) */
		// let's now add all the options for this post type
		array( 'labels' => array(
			'name' => __( 'News Items', 'bonestheme' ), /* This is the Title of the Group */
			'singular_name' => __( 'News Item', 'bonestheme' ), /* This is the individual type */
			'all_items' => __( 'All News Items', 'bonestheme' ), /* the all items menu item */
			'add_new' => __( 'Add New', 'bonestheme' ), /* The add new menu item */
			'add_new_item' => __( 'Add New News Item', 'bonestheme' ), /* Add New Display Title */
			'edit' => __( 'Edit', 'bonestheme' ), /* Edit Dialog */
			'edit_item' => __( 'Edit News Items', 'bonestheme' ), /* Edit Display Title */
			'new_item' => __( 'New News Item', 'bonestheme' ), /* New Display Title */
			'view_item' => __( 'View News Item', 'bonestheme' ), /* View Display Title */
			'search_items' => __( 'Search News Item', 'bonestheme' ), /* Search Custom Type Title */ 
			'not_found' =>  __( 'Nothing found in the Database.', 'bonestheme' ), /* This displays if there are no entries yet */ 
			'not_found_in_trash' => __( 'Nothing found in Trash', 'bonestheme' ), /* This displays if there is nothing in the trash */
			'parent_item_colon' => ''
			), /* end of arrays */
			'description' => __( 'Members of our teaching staff', 'bonestheme' ), /* Custom Type Description */
			'public' => true,
			'publicly_queryable' => true,
			'exclude_from_search' => false,
			'show_ui' => true,
			'query_var' => true,
			'menu_position' => 2.1, /* this is what order you want it to appear in on the left hand side menu */ 
			'menu_icon' => get_stylesheet_directory_uri() . '/library/images/news-icon.png', /* the icon for the custom post type menu */
			'rewrite'	=> array( 'slug' => 'news_item', 'with_front' => false ), /* you can specify its url slug */
			'has_archive' => true, /* you can rename the slug here */
			'capability_type' => 'post', 
			'hierarchical' => false,
			/* the next one is important, it tells what's enabled in the post editor */
			'supports' => array( 'title' )
		) /* end of options */
	); /* end of register post type */
	
}

	// adding the function to the Wordpress init
	add_action( 'init', 'custom_post_our_news');
	
	
// let's create the function for the custom type
function custom_post_badge() { 
	// creating (registering) the custom type 
	register_post_type( 'badge', /* (http://codex.wordpress.org/Function_Reference/register_post_type) */
		// let's now add all the options for this post type
		array( 'labels' 				=> array(
					'name' 								=> __( 'Badges', 'bonestheme' ), /* This is the Title of the Group */
					'singular_name' 			=> __( 'Badge', 'bonestheme' ), /* This is the individual type */
					'all_items' 					=> __( 'All Badges', 'bonestheme' ), /* the all items menu item */
					'add_new' 						=> __( 'Add New', 'bonestheme' ), /* The add new menu item */
					'add_new_item' 				=> __( 'Add New Badge', 'bonestheme' ), /* Add New Display Title */
					'edit' 								=> __( 'Edit', 'bonestheme' ), /* Edit Dialog */
					'edit_item' 					=> __( 'Edit Badges', 'bonestheme' ), /* Edit Display Title */
					'new_item' 						=> __( 'New Badge', 'bonestheme' ), /* New Display Title */
					'view_item' 					=> __( 'View Badge', 'bonestheme' ), /* View Display Title */
					'search_items' 				=> __( 'Search Badge', 'bonestheme' ), /* Search Custom Type Title */ 
					'not_found' 					=> __( 'Nothing found in the Database.', 'bonestheme' ), /* This displays if there are no entries yet */ 
					'not_found_in_trash' 	=> __( 'Nothing found in Trash', 'bonestheme' ), /* This displays if there is nothing in the trash */
					'parent_item_colon' 	=> ''
				), /* end of arrays */
			'description' 				=> __( 'Our Badges', 'bonestheme' ), /* Custom Type Description */
			'public' 							=> true,
			'publicly_queryable' 	=> true,
			'exclude_from_search' => false,
			'show_ui' 						=> true,
			'query_var' 					=> true,
			'menu_position' 			=> 1.5, /* this is what order you want it to appear in on the left hand side menu */ 
			'menu_icon' 					=> get_stylesheet_directory_uri() . '/library/images/badges-icon.png', /* the icon for the custom post type menu */
			'rewrite'							=> array( 'slug' => 'badges', 'with_front' => false ), /* you can specify its url slug */
			'capability_type' 		=> 'post',
			'hierarchical' 				=> false,
			/* the next one is important, it tells what's enabled in the post editor */
			'supports' 						=> array( 'title' ),
			'taxonomies'          => array( 'category' )
		) /* end of options */
	); /* end of register post type */
	
}

	// adding the function to the Wordpress init
	add_action( 'init', 'custom_post_badge');

?>
