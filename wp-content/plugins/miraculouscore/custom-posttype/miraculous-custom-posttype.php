<?php
add_action( 'init', 'miraculous_music_register_post_type' );
/**
 * Register a music post type.
 *
 * @link http://codex.wordpress.org/Function_Reference/register_post_type
 */
function miraculous_music_register_post_type() {
	$m_labels = array(
		'name'               => _x( 'Tracks', 'miraculous' ),
		'singular_name'      => _x( 'Track', 'miraculous' ),
		'menu_name'          => _x( 'Tracks', 'admin menu', 'miraculous' ),
		'name_admin_bar'     => _x( 'Track', 'add new on admin bar', 'miraculous' ),
		'add_new'            => _x( 'Add New', 'music', 'miraculous' ),
		'add_new_item'       => __( 'Add New Track', 'miraculous' ),
		'new_item'           => __( 'New Track', 'miraculous' ),
		'edit_item'          => __( 'Edit Track', 'miraculous' ),
		'view_item'          => __( 'View Track', 'miraculous' ),
		'all_items'          => __( 'All Tracks', 'miraculous' ),
		'search_items'       => __( 'Search Tracks', 'miraculous' ),
		'parent_item_colon'  => __( 'Parent Tracks:', 'miraculous' ),
		'not_found'          => __( 'No Tracks found.', 'miraculous' ),
		'not_found_in_trash' => __( 'No Tracks found in Trash.', 'miraculous' )
	);

	$mp_args = array(
		'labels'             => $m_labels,
        'description'        => __( 'Description.', 'miraculous' ),
		'public'             => true,
		'publicly_queryable' => true,
		'show_ui'            => true,
		'show_in_menu'       => true,
		'query_var'          => true,
		'rewrite'            => array( 'slug' => 'ms-music' ),
		'capability_type'    => 'post',
		'has_archive'        => true,
		'hierarchical'       => false,
		'menu_position'      => null,
		'menu_icon'          => 'dashicons-media-audio',
		'supports'           => array( 'title', 'editor', 'author', 'thumbnail', 'excerpt', 'comments' )
	);

	$arp_labels = array(
		'name'               => _x( 'Artists', 'miraculous' ),
		'singular_name'      => _x( 'Artist', 'miraculous' ),
		'menu_name'          => _x( 'Artists', 'admin menu', 'miraculous' ),
		'name_admin_bar'     => _x( 'Artist', 'add new on admin bar', 'miraculous' ),
		'add_new'            => _x( 'Add New', 'Artist', 'miraculous' ),
		'add_new_item'       => __( 'Add New Artist', 'miraculous' ),
		'new_item'           => __( 'New Artist', 'miraculous' ),
		'edit_item'          => __( 'Edit Artist', 'miraculous' ),
		'view_item'          => __( 'View Artist', 'miraculous' ),
		'all_items'          => __( 'All Artists', 'miraculous' ),
		'search_items'       => __( 'Search artists', 'miraculous' ),
		'parent_item_colon'  => __( 'Parent artists:', 'miraculous' ),
		'not_found'          => __( 'No artists found.', 'miraculous' ),
		'not_found_in_trash' => __( 'No artists found in Trash.', 'miraculous' )
	);

	$arp_args = array(
		'labels'             => $arp_labels,
        'description'        => __( 'Description.', 'miraculous' ),
		'public'             => true,
		'publicly_queryable' => true,
		'show_ui'            => true,
		'show_in_menu'       => true,
		'query_var'          => true,
		'rewrite'            => array( 'slug' => 'ms-artists' ),
		'capability_type'    => 'post',
		'has_archive'        => true,
		'hierarchical'       => false,
		'menu_position'      => null,
		'menu_icon'          => 'dashicons-microphone',
		'supports'           => array( 'title', 'editor', 'author', 'thumbnail', 'comments' )
	);

	$alp_labels = array(
		'name'               => _x( 'Albums', 'miraculous' ),
		'singular_name'      => _x( 'Album', 'miraculous' ),
		'menu_name'          => _x( 'Albums', 'admin menu', 'miraculous' ),
		'name_admin_bar'     => _x( 'Album', 'add new on admin bar', 'miraculous' ),
		'add_new'            => _x( 'Add New', 'Album', 'miraculous' ),
		'add_new_item'       => __( 'Add New Album', 'miraculous' ),
		'new_item'           => __( 'New Album', 'miraculous' ),
		'edit_item'          => __( 'Edit Album', 'miraculous' ),
		'view_item'          => __( 'View Album', 'miraculous' ),
		'all_items'          => __( 'All Albums', 'miraculous' ),
		'search_items'       => __( 'Search Albums', 'miraculous' ),
		'parent_item_colon'  => __( 'Parent Albums:', 'miraculous' ),
		'not_found'          => __( 'No Albums found.', 'miraculous' ),
		'not_found_in_trash' => __( 'No Albums found in Trash.', 'miraculous' )
	);

	$alp_args = array(
		'labels'             => $alp_labels,
        'description'        => __( 'Description.', 'miraculous' ),
		'public'             => true,
		'publicly_queryable' => true,
		'show_ui'            => true,
		'show_in_menu'       => true,
		'query_var'          => true,
		'rewrite'            => array( 'slug' => 'ms-albums' ),
		'capability_type'    => 'post',
		'has_archive'        => true,
		'hierarchical'       => false,
		'menu_position'      => null,
		'menu_icon'          => 'dashicons-album',
		'supports'           => array( 'title', 'editor', 'author', 'thumbnail', 'comments' )
	);

	$rd_labels = array(
		'name'               => _x( 'Radios', 'miraculous' ),
		'singular_name'      => _x( 'Radio', 'miraculous' ),
		'menu_name'          => _x( 'Radios', 'admin menu', 'miraculous' ),
		'name_admin_bar'     => _x( 'Radio', 'add new on admin bar', 'miraculous' ),
		'add_new'            => _x( 'Add New', 'Radio', 'miraculous' ),
		'add_new_item'       => __( 'Add New Radio', 'miraculous' ),
		'new_item'           => __( 'New Radio', 'miraculous' ),
		'edit_item'          => __( 'Edit Radio', 'miraculous' ),
		'view_item'          => __( 'View Radio', 'miraculous' ),
		'all_items'          => __( 'All Radios', 'miraculous' ),
		'search_items'       => __( 'Search Radios', 'miraculous' ),
		'parent_item_colon'  => __( 'Parent Radios:', 'miraculous' ),
		'not_found'          => __( 'No Radios found.', 'miraculous' ),
		'not_found_in_trash' => __( 'No Radios found in Trash.', 'miraculous' )
	);

	$rd_args = array(
		'labels'             => $rd_labels,
        'description'        => __( 'Description.', 'miraculous' ),
		'public'             => true,
		'publicly_queryable' => true,
		'show_ui'            => true,
		'show_in_menu'       => true,
		'query_var'          => true,
		'rewrite'            => array( 'slug' => 'ms-radios' ),
		'capability_type'    => 'post',
		'has_archive'        => true,
		'hierarchical'       => false,
		'menu_position'      => null,
		'menu_icon'          => 'dashicons-media-interactive',
		'supports'           => array( 'title', 'editor', 'author', 'thumbnail', 'comments' )
	);

	$pl_labels = array(
		'name'               => _x( 'Plans', 'miraculous' ),
		'singular_name'      => _x( 'Plan', 'miraculous' ),
		'menu_name'          => _x( 'Plans', 'admin menu', 'miraculous' ),
		'name_admin_bar'     => _x( 'Plan', 'add new on admin bar', 'miraculous' ),
		'add_new'            => _x( 'Add New', 'Plan', 'miraculous' ),
		'add_new_item'       => __( 'Add New Plan', 'miraculous' ),
		'new_item'           => __( 'New Plan', 'miraculous' ),
		'edit_item'          => __( 'Edit Plan', 'miraculous' ),
		'view_item'          => __( 'View Plan', 'miraculous' ),
		'all_items'          => __( 'All Plans', 'miraculous' ),
		'search_items'       => __( 'Search Plans', 'miraculous' ),
		'parent_item_colon'  => __( 'Parent Plans:', 'miraculous' ),
		'not_found'          => __( 'No Plans found.', 'miraculous' ),
		'not_found_in_trash' => __( 'No Plans found in Trash.', 'miraculous' )
	);

	$pl_args = array(
		'labels'             => $pl_labels,
        'description'        => __( 'Description.', 'miraculous' ),
		'public'             => true,
		'publicly_queryable' => true,
		'show_ui'            => true,
		'show_in_menu'       => true,
		'query_var'          => true,
		'rewrite'            => array( 'slug' => 'ms-plans' ),
		'capability_type'    => 'post',
		'has_archive'        => true,
		'hierarchical'       => false,
		'menu_position'      => null,
		'menu_icon'          => 'dashicons-products',
		'supports'           => array( 'title', 'editor', 'author', 'thumbnail' )
	);
	$po_labels = array(
		'name'               => _x( 'Podcasts', 'miraculous' ),
		'singular_name'      => _x( 'Podcast', 'miraculous' ),
		'menu_name'          => _x( 'Podcasts', 'admin menu', 'miraculous' ),
		'name_admin_bar'     => _x( 'Podcast', 'add new on admin bar', 'miraculous' ),
		'add_new'            => _x( 'Add New', 'music', 'miraculous' ),
		'add_new_item'       => __( 'Add New Podcast', 'miraculous' ),
		'new_item'           => __( 'New Podcast', 'miraculous' ),
		'edit_item'          => __( 'Edit Podcast', 'miraculous' ),
		'view_item'          => __( 'View Podcast', 'miraculous' ),
		'all_items'          => __( 'All Podcasts', 'miraculous' ),
		'search_items'       => __( 'Search Podcasts', 'miraculous' ),
		'parent_item_colon'  => __( 'Parent Podcasts:', 'miraculous' ),
		'not_found'          => __( 'No Podcasts found.', 'miraculous' ),
		'not_found_in_trash' => __( 'No Podcasts found in Trash.', 'miraculous' )
	);

	$po_args = array(
		'labels'             => $po_labels,
        'description'        => __( 'Description.', 'miraculous' ),
		'public'             => true,
		'publicly_queryable' => true,
		'show_ui'            => true,
		'show_in_menu'       => true,
		'query_var'          => true,
		'rewrite'            => array( 'slug' => 'ms-podcasts' ),
		'capability_type'    => 'post',
		'has_archive'        => true,
		'hierarchical'       => false,
		'menu_position'      => null,
		'menu_icon'          => 'dashicons-media-audio',
		'supports'           => array( 'title', 'editor', 'author', 'thumbnail', 'excerpt', 'comments' )
	);

	register_post_type( 'ms-music', $mp_args );
	register_post_type( 'ms-artists', $arp_args );
	register_post_type( 'ms-albums', $alp_args );
	register_post_type( 'ms-radios', $rd_args );
	register_post_type( 'ms-plans', $pl_args );
	register_post_type( 'ms-podcasts', $po_args );

	// Add new taxonomy, make it hierarchical (like categories)
		$gen_labels = array(
			'name'              => _x( 'Genres', 'miraculous' ),
			'singular_name'     => _x( 'Genre', 'miraculous' ),
			'search_items'      => __( 'Search Genres', 'miraculous' ),
			'all_items'         => __( 'All Genres', 'miraculous' ),
			'parent_item'       => __( 'Parent Genre', 'miraculous' ),
			'parent_item_colon' => __( 'Parent Genre:', 'miraculous' ),
			'edit_item'         => __( 'Edit Genre', 'miraculous' ),
			'update_item'       => __( 'Update Genre', 'miraculous' ),
			'add_new_item'      => __( 'Add New Genre', 'miraculous' ),
			'new_item_name'     => __( 'New Genre Name', 'miraculous' ),
			'menu_name'         => __( 'Genre', 'miraculous' ),
		);

		$gen_args = array(
			'hierarchical'      => true,
			'labels'            => $gen_labels,
			'show_ui'           => true,
			'show_admin_column' => true,
			'query_var'         => true,
			'rewrite'           => array( 'slug' => 'genre' ),
		);

	/* Add new taxonomy, make it hierarchical (like categories) */
		$lan_labels = array(
			'name'              => _x( 'Languages', 'miraculous' ),
			'singular_name'     => _x( 'Language', 'miraculous' ),
			'search_items'      => __( 'Search Languages', 'miraculous' ),
			'all_items'         => __( 'All Languages', 'miraculous' ),
			'parent_item'       => __( 'Parent Language', 'miraculous' ),
			'parent_item_colon' => __( 'Parent Language:', 'miraculous' ),
			'edit_item'         => __( 'Edit Language', 'miraculous' ),
			'update_item'       => __( 'Update Language', 'miraculous' ),
			'add_new_item'      => __( 'Add New Language', 'miraculous' ),
			'new_item_name'     => __( 'New Language Name', 'miraculous' ),
			'menu_name'         => __( 'Language', 'miraculous' ),
		);

		$lan_args = array(
			'hierarchical'      => true,
			'labels'            => $lan_labels,
			'show_ui'           => true,
			'show_admin_column' => true,
			'query_var'         => true,
			'rewrite'           => array( 'slug' => 'language' ),
		);

	/* Add new taxonomy, make it hierarchical (like categories) */
		$arty_labels = array(
			'name'              => _x( 'Artist Types', 'miraculous' ),
			'singular_name'     => _x( 'Artist Type', 'miraculous' ),
			'search_items'      => __( 'Search Artist Types', 'miraculous' ),
			'all_items'         => __( 'All Artist Types', 'miraculous' ),
			'parent_item'       => __( 'Parent Artist Type', 'miraculous' ),
			'parent_item_colon' => __( 'Parent Artist Type:', 'miraculous' ),
			'edit_item'         => __( 'Edit Artist Type', 'miraculous' ),
			'update_item'       => __( 'Update Artist Type', 'miraculous' ),
			'add_new_item'      => __( 'Add New Artist Type', 'miraculous' ),
			'new_item_name'     => __( 'New Artist Type Name', 'miraculous' ),
			'menu_name'         => __( 'Artist Type', 'miraculous' ),
		);

		$arty_args = array(
			'hierarchical'      => true,
			'labels'            => $arty_labels,
			'show_ui'           => true,
			'show_admin_column' => true,
			'query_var'         => true,
			'rewrite'           => array( 'slug' => 'artist-type' ),
		);

	/* Add new taxonomy, make it hierarchical (like categories) */
		$alty_labels = array(
			'name'              => _x( 'Album Types', 'miraculous' ),
			'singular_name'     => _x( 'Album Type', 'miraculous' ),
			'search_items'      => __( 'Search Album Types', 'miraculous' ),
			'all_items'         => __( 'All Album Types', 'miraculous' ),
			'parent_item'       => __( 'Parent Album Type', 'miraculous' ),
			'parent_item_colon' => __( 'Parent Album Type:', 'miraculous' ),
			'edit_item'         => __( 'Edit Album Type', 'miraculous' ),
			'update_item'       => __( 'Update Album Type', 'miraculous' ),
			'add_new_item'      => __( 'Add New Album Type', 'miraculous' ),
			'new_item_name'     => __( 'New Album Type Name', 'miraculous' ),
			'menu_name'         => __( 'Album Type', 'miraculous' ),
		);

		$alty_args = array(
			'hierarchical'      => true,
			'labels'            => $alty_labels,
			'show_ui'           => true,
			'show_admin_column' => true,
			'query_var'         => true,
			'rewrite'           => array( 'slug' => 'album-type' ),
		);

	/* Add new taxonomy, make it hierarchical (like categories) */
		$mty_labels = array(
			'name'              => _x( 'Track Types', 'miraculous' ),
			'singular_name'     => _x( 'Track Type', 'miraculous' ),
			'search_items'      => __( 'Search Track Types', 'miraculous' ),
			'all_items'         => __( 'All Track Types', 'miraculous' ),
			'parent_item'       => __( 'Parent Track Type', 'miraculous' ),
			'parent_item_colon' => __( 'Parent Track Type:', 'miraculous' ),
			'edit_item'         => __( 'Edit Track Type', 'miraculous' ),
			'update_item'       => __( 'Update Track Type', 'miraculous' ),
			'add_new_item'      => __( 'Add New Track Type', 'miraculous' ),
			'new_item_name'     => __( 'New Track Type Name', 'miraculous' ),
			'menu_name'         => __( 'Track Type', 'miraculous' ),
		);

		$mty_args = array(
			'hierarchical'      => true,
			'labels'            => $mty_labels,
			'show_ui'           => true,
			'show_admin_column' => true,
			'query_var'         => true,
			'rewrite'           => array( 'slug' => 'music-type' ),
		);

	/* Add new taxonomy, make it hierarchical (like categories) */
		$rdtax_labels = array(
			'name'              => _x( 'Radio Types', 'miraculous' ),
			'singular_name'     => _x( 'Radio Type', 'miraculous' ),
			'search_items'      => __( 'Search Radio Types', 'miraculous' ),
			'all_items'         => __( 'All Radio Types', 'miraculous' ),
			'parent_item'       => __( 'Parent Radio Type', 'miraculous' ),
			'parent_item_colon' => __( 'Parent Radio Type:', 'miraculous' ),
			'edit_item'         => __( 'Edit Radio Type', 'miraculous' ),
			'update_item'       => __( 'Update Radio Type', 'miraculous' ),
			'add_new_item'      => __( 'Add New Radio Type', 'miraculous' ),
			'new_item_name'     => __( 'New Radio Type Name', 'miraculous' ),
			'menu_name'         => __( 'Radio Type', 'miraculous' ),
		);

		$rdtax_args = array(
			'hierarchical'      => true,
			'labels'            => $rdtax_labels,
			'show_ui'           => true,
			'show_admin_column' => true,
			'query_var'         => true,
			'rewrite'           => array( 'slug' => 'radio-type' ),
		);
		// Add new taxonomy, make it hierarchical (like categories)
		$location_labels = array(
			'name'              => _x( 'Locations', 'miraculous' ),
			'singular_name'     => _x( 'Location', 'miraculous' ),
			'search_items'      => __( 'Search Locations', 'miraculous' ),
			'all_items'         => __( 'All Locations', 'miraculous' ),
			'parent_item'       => __( 'Parent Location', 'miraculous' ),
			'parent_item_colon' => __( 'Parent Location:', 'miraculous' ),
			'edit_item'         => __( 'Edit Location', 'miraculous' ),
			'update_item'       => __( 'Update Location', 'miraculous' ),
			'add_new_item'      => __( 'Add New Location', 'miraculous' ),
			'new_item_name'     => __( 'New Location Name', 'miraculous' ),
			'menu_name'         => __( 'Location', 'miraculous' ),
		);

		$location_args = array(
			'hierarchical'      => true,
			'labels'            => $location_labels,
			'show_ui'           => true,
			'show_admin_column' => true,
			'query_var'         => true,
			'rewrite'           => array( 'slug' => 'location' ),
		);
		$podtype_labels = array(
			'name'              => _x( 'Podcast Type', 'miraculous' ),
			'singular_name'     => _x( 'Podcast Type', 'miraculous' ),
			'search_items'      => __( 'Search Podcast Type', 'miraculous' ),
			'all_items'         => __( 'All Locations', 'miraculous' ),
			'parent_item'       => __( 'Parent Podcast Type', 'miraculous' ),
			'parent_item_colon' => __( 'Parent Podcast Type:', 'miraculous' ),
			'edit_item'         => __( 'Edit Podcast Type', 'miraculous' ),
			'update_item'       => __( 'Update Podcast Type', 'miraculous' ),
			'add_new_item'      => __( 'Add New Podcast Type', 'miraculous' ),
			'new_item_name'     => __( 'New Podcast Type Name', 'miraculous' ),
			'menu_name'         => __( 'Podcast Type', 'miraculous' ),
		);

		$podtype_args = array(
			'hierarchical'      => true,
			'labels'            => $podtype_labels,
			'show_ui'           => true,
			'show_admin_column' => true,
			'query_var'         => true,
			'rewrite'           => array( 'slug' => 'podcast_type' ),
		);


		register_taxonomy( 'genre', array( 'ms-music', 'ms-artists', 'ms-albums', 'ms-radios', 'ms-podcasts' ), $gen_args );
		register_taxonomy( 'language', array( 'ms-music', 'ms-artists', 'ms-albums', 'ms-radios', 'ms-podcasts' ), $lan_args );
		register_taxonomy( 'music-type', array( 'ms-music' ), $mty_args );
		register_taxonomy( 'artist-type', array( 'ms-artists' ), $arty_args );
		register_taxonomy( 'album-type', array( 'ms-albums' ), $alty_args );
		register_taxonomy( 'radio-type', array( 'ms-radios' ), $rdtax_args );
		register_taxonomy( 'location', array( 'ms-radios' ), $location_args );
		register_taxonomy( 'podcast_type', array( 'ms-podcasts' ), $podtype_args );
}


function miraculous_music_save_meta_box_fields( $post_id ) {
	global $post;

	if ( is_admin() && current_user_can( 'manage_options' )  ) {
	      
		$post_type = get_post_type($post_id);

		extract($_POST);

		if( defined('FW') && isset($fw_options) && function_exists('fw_get_db_post_option')){
			if( $post_type == "ms-artists" ) {
				update_post_meta($post_id, 'artists_type', $fw_options['artists_type']);
			}

			if( $post_type == "ms-albums" ) {
				update_post_meta($post_id, 'album_type', $fw_options['album_type']);
				update_post_meta($post_id, 'album_artists', $fw_options['album_artists']);
			}

			if( $post_type == "ms-radios" ) {
				update_post_meta($post_id, 'radio_artists', $fw_options['radio_artists']);
			}

			if( $post_type == "ms-music" ) {
				update_post_meta($post_id, 'fw_option:music_type', $fw_options['music_type_options']['music_type']);
			}
		}
	}

}
add_action( 'save_post', 'miraculous_music_save_meta_box_fields' );


/* Add the custom columns to the artist post type: */
add_filter( 'manage_ms-music_posts_columns', 'miraculous_set_custom_artist_name_columns' );
function miraculous_set_custom_artist_name_columns($columns) {
	if(function_exists('fw_get_db_post_option')){
		# Insert at offset 3
		$offset = 3;
		$columns = array_slice($columns, 0, $offset, true) +
		            array('artists_name' => 'Artists Name') +
		            array_slice($columns, $offset, NULL, true);
	}

    return $columns;
}

/* Add the data to the custom columns for the book post type: */
add_action( 'manage_ms-music_posts_custom_column' , 'miraculous_custom_artist_name_columns_value', 10, 2 );
function miraculous_custom_artist_name_columns_value( $column, $post_id ) {
	if(function_exists('fw_get_db_post_option')){
		switch ( $column ) {

		    case 'artists_name' :
		    	$artists_name = array();
		        $artists_ids = fw_get_db_post_option($post_id, 'music_artists');
		        if( empty($artists_ids) ) {
		        	echo __('—', 'miraculous');
		        }else {
		        	foreach ($artists_ids as $artists_id) {
		                $artists_name[] = get_the_title($artists_id);
		            }
		            echo implode(',', $artists_name);
		        }
		        break;
		}
	}
    
}
?>