<?php
/**
 * Song View Counter
 */ 
function miraculous_song_view_counter($songid){
    $count_key = 'song_views_count';
    $count = get_post_meta($songid, $count_key, true);
    if($count==''){
        delete_post_meta($songid, $count_key);
        add_post_meta($songid, $count_key, '0');
        echo  '<i class="fa fa-eye"></i> 0';
    }else{
      echo '<i class="fa fa-eye"></i>'. $count;
    }
} 

function miraculous_song_view_set($songid) {
    $count_key = 'song_views_count';
    $count = get_post_meta($songid, $count_key, true);
    if($count==''){
    $count = 0;
    delete_post_meta($songid, $count_key);
    add_post_meta($songid, $count_key, '0'); 
    }else{
    $count++;
    update_post_meta($songid, $count_key, $count);
    }
}

/**
 * album View Counter
 */ 

function miraculous_album_view_counter($albumid){
    $count_key = 'album_views_count';
    $count = get_post_meta($albumid, $count_key, true);
    if($count==''){
        delete_post_meta($albumid, $count_key);
        add_post_meta($albumid, $count_key, '0');
        echo  '<i class="fa fa-eye"></i> 0';
    }else{
      echo '<i class="fa fa-eye"></i>'. $count;
    }
}  
function miraculous_album_view_set($albumid) {
    $count_key = 'album_views_count';
    $count = get_post_meta($albumid, $count_key, true);
    if($count==''){
    $count = 0;
    delete_post_meta($albumid, $count_key);
    add_post_meta($albumid, $count_key, '0');
    }else{
    $count++;
    update_post_meta($albumid, $count_key, $count);
    }
}



/**
 * album View Counter
 */ 

function miraculous_artist_view_counter($artistid){
    $count_key = 'artist_views_count';
    $count = get_post_meta($artistid, $count_key, true);
    if($count==''){
        delete_post_meta($artistid, $count_key);
        add_post_meta($artistid, $count_key, '0');
        echo  '<i class="fa fa-eye"></i> 0';
    }else{
      echo '<i class="fa fa-eye"></i>'. $count;
    }
}  
function miraculous_artist_view_set($artistid) {
    $count_key = 'artist_views_count';
    $count = get_post_meta($artistid, $count_key, true);
    if($count==''){
        $count = 0;
        delete_post_meta($artistid, $count_key);
        add_post_meta($artistid, $count_key, '0');
    }else{
        $count++;
        update_post_meta($artistid, $count_key, $count);
    }
}


/**
 * Song Dowenload Counter
 */ 
function miraculous_song_dowenload_counter($songid){
    echo $dowenloadsong = get_post_meta($songid,'song_dowenload_counter',true);
    if(empty($dowenloadsong)):
        echo "0";
    endif;
 }

/**
 * custom role set
 */
add_action('init', 'mira_custom_userrole');
function mira_custom_userrole()
{ 
 global $wp_roles;
 if (!isset($wp_roles))
 $wp_roles = new WP_Roles();
 $subs = $wp_roles->get_role('artist');
 // Adding a new role with all admin caps.
 $wp_roles->add_role('artist', 'Artist', $subs->capabilities);
 $wp_roles->add_role('listener', 'Listener', $subs->capabilities);
} 
add_filter( 'ajax_query_attachments_args', 'wpb_show_current_user_attachments' );


//limitation for users 
function wpb_show_current_user_attachments( $query ) {
    $user_id = get_current_user_id();
    if ( $user_id && !current_user_can('activate_plugins') && !current_user_can('edit_others_posts') ) {
        $query['author'] = $user_id;
    }
    return $query;
}
