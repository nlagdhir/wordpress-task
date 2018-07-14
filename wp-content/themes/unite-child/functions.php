<?php

/**
* Enqueue parent theme 
*/

add_action( 'wp_enqueue_scripts', 'enqueue_child_theme_styles', PHP_INT_MAX);

function enqueue_child_theme_styles() {
  wp_enqueue_style( 'parent-style', get_template_directory_uri().'/style.css' );
}

/**
* Create custom post type Films
*/

function create_films_post_type() {
  $labels = array(
		'name'               => _x( 'Films', 'Films'),
		'singular_name'      => _x( 'Film', 'Film'),
		'menu_name'          => _x( 'Films', 'Films'),
		'name_admin_bar'     => _x( 'Film', 'add new film'),
		'add_new'            => _x( 'Add New', 'film'),
		'add_new_item'       => __( 'Add New Film'),
		'new_item'           => __( 'New Film'),
		'edit_item'          => __( 'Edit Film'),
		'view_item'          => __( 'View Film'),
		'all_items'          => __( 'All Films'),
		'search_items'       => __( 'Search Films'),
		'parent_item_colon'  => __( 'Parent Films:'),
		'not_found'          => __( 'No films found.'),
		'not_found_in_trash' => __( 'No fooks found in Trash.')
	);

	$args = array(
		'labels'             => $labels,
        'description'        => __( 'Description.'),
		'public'             => true,
		'publicly_queryable' => true,
		'show_ui'            => true,
		'show_in_menu'       => true,
		'query_var'          => true,
		'rewrite'            => array( 'slug' => 'films' ),
		'capability_type'    => 'post',
		'has_archive'        => true,
		'hierarchical'       => false,
		'menu_position'      => null,
		'supports'           => array( 'title', 'editor', 'author', 'thumbnail', 'excerpt', 'comments' ),
		'register_meta_box_cb' => 'add_films_metaboxes',
	);

	register_post_type( 'films', $args );
}
add_action( 'init', 'create_films_post_type' );


/**
 * Adds metaboxes to films
 */
function add_films_metaboxes() {
	add_meta_box(
		'films_ticket_price',
		'Ticket Price : ',
		'films_ticket_price',
		'films',
		'normal',
		'high'
	);

	add_meta_box(
		'films_release_date',
		'Release Date :',
		'films_release_date',
		'films',
		'normal',
		'high'
	);
}

/**
 * Output the HTML for the metabox.
 */
function films_ticket_price() {
	global $post;
	$ticket_price = get_post_meta( $post->ID, 'film_ticket_price', true );
	echo '<input type="number" name="film_ticket_price" value="' . esc_attr( $ticket_price )  . '" class="widefat" min="0" step="0.1">';
}

/**
 * Output the HTML for the metabox.
 */
function films_release_date() {
	global $post;
	$release_date = get_post_meta( $post->ID, 'film_release_date', true );
	echo '<input type="text"  name="film_release_date" value="' . esc_attr( $release_date )  . '" class="widefat release_date_datepicker">';
}


/**
 * Save the metabox data
 */
function wpt_save_films_meta( $post_id, $post ) {
	
	if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE)
        return $post_id;
    // check permissions
    if ('films' == $_POST['post_type']) {
        if (!current_user_can('edit_post', $post_id)) {
            return $post_id;
    	}  

    	update_post_meta($post_id,'film_ticket_price',$_POST['film_ticket_price']);
    	update_post_meta($post_id,'film_release_date',$_POST['film_release_date']);
    }

}
add_action( 'save_post', 'wpt_save_films_meta', 1, 2 );


/*
* create texonomy for films post type
*/

add_action( 'init', 'create_film_taxonomies', 0 );

// create four taxonomies, genres, countries, years and actors for the post type "film"
function create_film_taxonomies() {

	/* Add new taxonomy, make it hierarchical (like categories)
	 Options define for genre taxonomy */
	$labels = array(
		'name'              => _x( 'Genres'),
		'singular_name'     => _x( 'Genre', 'taxonomy singular name', 'textdomain' ),
		'search_items'      => __( 'Search Genres', 'textdomain' ),
		'all_items'         => __( 'All Genres', 'textdomain' ),
		'parent_item'       => __( 'Parent Genre', 'textdomain' ),
		'parent_item_colon' => __( 'Parent Genre:', 'textdomain' ),
		'edit_item'         => __( 'Edit Genre', 'textdomain' ),
		'update_item'       => __( 'Update Genre', 'textdomain' ),
		'add_new_item'      => __( 'Add New Genre', 'textdomain' ),
		'new_item_name'     => __( 'New Genre Name', 'textdomain' ),
		'menu_name'         => __( 'Genre', 'textdomain' ),
	);

	$args = array(
		'hierarchical'      => true,
		'labels'            => $labels,
		'show_ui'           => true,
		'show_admin_column' => true,
		'query_var'         => true,
		'rewrite'           => array( 'slug' => 'genre' ),
	);

	// register genre taxonomy
	register_taxonomy( 'genre', array( 'films' ), $args );

	// Options define for country taxonomy
	$labels = array(
		'name'              => _x( 'Countries'),
		'singular_name'     => _x( 'Country', 'taxonomy singular name', 'textdomain' ),
		'search_items'      => __( 'Search Countries', 'textdomain' ),
		'all_items'         => __( 'All Countries', 'textdomain' ),
		'parent_item'       => __( 'Parent Country', 'textdomain' ),
		'parent_item_colon' => __( 'Parent Country:', 'textdomain' ),
		'edit_item'         => __( 'Edit Country', 'textdomain' ),
		'update_item'       => __( 'Update Country', 'textdomain' ),
		'add_new_item'      => __( 'Add New Country', 'textdomain' ),
		'new_item_name'     => __( 'New Country Name', 'textdomain' ),
		'menu_name'         => __( 'Country', 'textdomain' ),
	);

	$args = array(
		'hierarchical'      => true,
		'labels'            => $labels,
		'show_ui'           => true,
		'show_admin_column' => true,
		'query_var'         => true,
		'rewrite'           => array( 'slug' => 'country' ),
	);

	// register country taxonomy
	register_taxonomy( 'country', array( 'films' ), $args );

	// Options define for year taxonomy
	$labels = array(
		'name'              => _x( 'Years'),
		'singular_name'     => _x( 'Year', 'taxonomy singular name', 'textdomain' ),
		'search_items'      => __( 'Search Years', 'textdomain' ),
		'all_items'         => __( 'All Years', 'textdomain' ),
		'parent_item'       => __( 'Parent Year', 'textdomain' ),
		'parent_item_colon' => __( 'Parent Year:', 'textdomain' ),
		'edit_item'         => __( 'Edit Year', 'textdomain' ),
		'update_item'       => __( 'Update Year', 'textdomain' ),
		'add_new_item'      => __( 'Add New Year', 'textdomain' ),
		'new_item_name'     => __( 'New Year Name', 'textdomain' ),
		'menu_name'         => __( 'Year', 'textdomain' ),
	);

	$args = array(
		'hierarchical'      => true,
		'labels'            => $labels,
		'show_ui'           => true,
		'show_admin_column' => true,
		'query_var'         => true,
		'rewrite'           => array( 'slug' => 'year' ),
	);

	// register year taxonomy
	register_taxonomy( 'year', array( 'films' ), $args );


	// Options define for actor  taxonomy
	$labels = array(
		'name'              => _x( 'Actors'),
		'singular_name'     => _x( 'Actor', 'taxonomy singular name', 'textdomain' ),
		'search_items'      => __( 'Search Actors', 'textdomain' ),
		'all_items'         => __( 'All Actors', 'textdomain' ),
		'parent_item'       => __( 'Parent Actor', 'textdomain' ),
		'parent_item_colon' => __( 'Parent Actor:', 'textdomain' ),
		'edit_item'         => __( 'Edit Actor', 'textdomain' ),
		'update_item'       => __( 'Update Actor', 'textdomain' ),
		'add_new_item'      => __( 'Add New Actor', 'textdomain' ),
		'new_item_name'     => __( 'New Actor Name', 'textdomain' ),
		'menu_name'         => __( 'Actor', 'textdomain' ),
	);

	$args = array(
		'hierarchical'      => true,
		'labels'            => $labels,
		'show_ui'           => true,
		'show_admin_column' => true,
		'query_var'         => true,
		'rewrite'           => array( 'slug' => 'actor' ),
	);

	// register year taxonomy
	register_taxonomy( 'actor', array( 'films' ), $args );

}


/**
 * Enqueue the date picker
 */

add_action( 'admin_enqueue_scripts', 'enqueue_date_picker', 10, 1 );

function enqueue_date_picker($hook){
	global $post;

    if ( $hook == 'post-new.php' || $hook == 'post.php' ) {
    	if($post->post_type === 'films'){
    		wp_enqueue_script(
				'custom-js',
				get_stylesheet_directory_uri() .'/js/custom.js',
				array('jquery', 'jquery-ui-core', 'jquery-ui-datepicker'),
				time(),
				true
			); 

			wp_enqueue_style('customuicss','//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css'); 
			
    	}
	    
	}
}

/*
* Display texonomy and custom fields data using filter
*/
add_filter( 'the_content', 'after_the_content_filter', 0 );
function after_the_content_filter( $content ) {
if ( is_single() )
{
    global $post;

    if($post->post_type == 'films'){
    	$taxonomies = get_object_taxonomies($post, 'objects');
		foreach ($taxonomies as $taxonomy) {
			$terms = get_the_terms($post->ID,$taxonomy->name);

			if( ! empty( $terms ) ){
				$entry_terms = '';
				$content .= '<div class="custom_content"><b>'.ucfirst($taxonomy->name).':</b>';			
				$content .= '<span class="entry-terms">';
					foreach ( $terms as $term ) {
						$entry_terms .= $term->name . ', ';
					}
					$entry_terms = rtrim( $entry_terms, ', ' );
				$content .=  $entry_terms . '</span></div>';
				
			}
		}
		if(!empty(get_post_meta(get_the_ID(),'film_ticket_price',true))){
			$content .= '<div class="custom_content"><span class="entry-terms"><b>Ticket Price : </b>$'.get_post_meta(get_the_ID(),'film_ticket_price',true).'</span></div>'	;
		}
		if(!empty(get_post_meta(get_the_ID(),'film_release_date',true))){
			$content .= '<div class="custom_content"><span class="entry-terms"><b>Release Date: </b>'.get_post_meta(get_the_ID(),'film_release_date',true).'</span></div>';	
		}
	}
    
}
return $content;
}


/**
* Shortcode create for latest films
*
*/
function shortcode_latest_films() { 
	global $post;
	$data='<h3 class="widget-title">Recent Films</h3><ul>';
	$args = array( 'posts_per_page' => 5, 'post_type' => 'films' );
	$myposts = get_posts( $args );
	foreach ( $myposts as $cpost ){
		$data.='<li><a href="'.get_permalink($cpost->ID).'">'.get_the_title($cpost).'</a></li>';
	}
	
	$data.='</ul>';
	echo $data;
} 
add_shortcode('latest_films','shortcode_latest_films');

/**
* Enable widget for shortcode 
*/
add_filter( 'widget_text', 'do_shortcode' );


?>