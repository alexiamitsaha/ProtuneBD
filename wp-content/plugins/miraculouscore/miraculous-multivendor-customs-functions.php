<?php
/**
* Miraculous Ajax Function
* Function Create: 27-01-2021
* @create:  @update: @an
**/


/**
 * Track update ajax function
 */
add_action( 'wp_ajax_miraculous_user_track_update', 'miraculous_user_track_update');
add_action( 'wp_ajax_nopriv_miraculous_user_track_update', 'miraculous_user_track_update');
function miraculous_user_track_update(){
  $miraculous_theme_data = '';
  if (function_exists('fw_get_db_settings_option')):  
    $miraculous_theme_data = fw_get_db_settings_option();     
  endif; 
  $track_page = '';
  if(!empty($miraculous_theme_data['user_blog_page'])):
    $track_page = get_the_permalink( $miraculous_theme_data['user_blog_page'] );
  endif;
  $data = array('status' => 'false', 'msg' => 'Something went Wrong.');

	if( isset($_POST['mp3_url']) ){

		    extract($_POST);

		    $artist_arr = array();

		    $user_id = get_current_user_id();

		    $lang_arr = array( $language_id );

		    $m_args = array(
          'ID'  => $_POST['aduio_id'],
          'post_type' => 'ms-music',
          'post_title' => $track_name,
					'post_content'  => $track_lyrics,
					'post_author' => $user_id,
          'post_status' => $privacy
          ); 

		    $music_id =  wp_update_post($m_args);

	    	if($music_id){
 
				$artists_name = $_POST['artists_name'];
        if(!empty($track_mp3_id) && !empty($mp3_url)):
				   $new_full_track = array('attachment_id' => $track_mp3_id, 'url' => $mp3_url);
           update_post_meta($music_id, 'fw_option:mp3_full_songs', $new_full_track);
        endif;
				update_post_meta($music_id, 'music_added_by', $user_id);

				update_post_meta($music_id, 'mp3_full_songs', $full_track);

				update_post_meta($music_id, 'fw_option:music_types', $track_types);
 
				update_post_meta($music_id, 'fw_option:single_music_prices', $track_price);
				
				$user_id = get_current_user_id();
				if($user_id):
				$user_info = get_userdata($user_id);
				$user_name = $user_info->display_name;
				$user_roles = implode(', ', $user_info->roles);
        endif; 
        
				if($user_roles=='artist'):
				  update_post_meta($music_id, 'fw_option:user_music_artist', $user_name);
				else:
				  update_post_meta($music_id, 'fw_option:user_music_artist', $user_name);
				endif;
				 
				if($attachimage_id){
          set_post_thumbnail($music_id, $attachimage_id );
	      }
        wp_set_post_terms($music_id, $lang_arr, 'language' );

            $track_page = get_the_permalink($music_id);
	      	  $data = array('status' => 'true', 
                    'msg' => 'Uploaded Successfully.', 
                    'track_page' => $track_page);

	    	}else{

            $data = array('status' => 'false', 
                          'msg' => 'Something went Wrong.');

	    	}

	    	echo json_encode($data);

	    	die();

		}

echo json_encode($data);
die();
}

/**
 * Album Update Ajax Function
 */
add_action( 'wp_ajax_miraculous_user_ablummusic_update', 'miraculous_user_ablummusic_update');
add_action( 'wp_ajax_nopriv_miraculous_user_ablummusic_update', 'miraculous_user_ablummusic_update');
function miraculous_user_ablummusic_update(){

    $miraculous_theme_data = '';
    if (function_exists('fw_get_db_settings_option')):  
      $miraculous_theme_data = fw_get_db_settings_option();     
    endif; 
    $track_page = '';
    if(!empty($miraculous_theme_data['user_blog_page'])):
     $track_page = get_the_permalink( $miraculous_theme_data['user_blog_page'] );
    endif;
    
    $data = array('status' => 'false', 'msg' => 'Something went Wrong.');

    if( isset($_POST['albumtitle']) ){

        extract($_POST); 

        $album_sdata['album_songs'] = explode(',',$album_tracks);
        $user_id = get_current_user_id();

        $post = array(
          'ID'  => $_POST['albums_id'],
          'post_author' => $user_id,
          'post_title'  => $_POST['albumtitle'],
          'post_content' => $_POST['albumdscription'],
          'post_status' => 'publish',   // Could be: publish
          'post_type' => 'ms-albums', // Could be: `page` or your CPT
          'comment_status' =>'closed',
          );
         $album_id = wp_update_post($post);
         if($album_id){
            
          if(!empty($album_sdata)){
             update_post_meta($album_id,'fw_options', maybe_unserialize(maybe_serialize($album_sdata)));
          }
          if(!empty($user_id)){
           update_post_meta($album_id, 'album_added_by', $user_id);
          }
          if($track_types){
             update_post_meta($album_id, 'fw_option:album_type', $track_types);
          }
          if($album_price){
           update_post_meta($album_id, 'fw_option:album_full_prices', $album_price);
          }
          if($attachimage_id){
            set_post_thumbnail($album_id, $attachimage_id);
          }
            
          if(!empty($_POST['languages'])){
           wp_set_object_terms($album_id, $_POST['languages'], 'language');
          }
                $track_page = get_the_permalink($album_id);

                $data = array('status' => 'true', 
                              'msg' => 'Uploaded Successfully.',
                              'track_page' => $track_page
                             );

         }else{

                $data = array('status' => 'false', 
                              'msg' => 'Something went Wrong.'
                             );

         }

        echo json_encode($data);

        die();

    } 
    echo json_encode($data);
die();
}

/**
 * Album Upload Ajax Function
 */ 
 
add_action( 'wp_ajax_miraculous_user_ablummusic_upload', 'miraculous_user_ablummusic_upload');
add_action( 'wp_ajax_nopriv_miraculous_user_ablummusic_upload', 'miraculous_user_ablummusic_upload');
function miraculous_user_ablummusic_upload(){

    $miraculous_theme_data = '';
    if (function_exists('fw_get_db_settings_option')):  
      $miraculous_theme_data = fw_get_db_settings_option();     
    endif; 
    $track_page = '';
    if(!empty($miraculous_theme_data['user_blog_page'])):
     $track_page = get_the_permalink( $miraculous_theme_data['user_blog_page'] );
    endif;
    $data = array('status' => 'false', 'msg' => 'Something went Wrong.');

    
  
    if( isset($_POST['albumtitle']) ){

        extract($_POST);

        $album_sdata['album_songs'] = explode(',',$album_tracks);
        $user_id = get_current_user_id();

        if($languages){

            $m_args = array(
                'post_type' => 'ms-albums',
                'post_title' => $albumtitle,
                'post_content' => $albumdscription,
                'post_author' => $user_id,
                'post_status' => 'publish'
              );

        }else{

            $m_args = array(
                'post_type' => 'ms-albums',
                'post_title' => $albumtitle,
                'post_content' => $albumdscription,
                'post_author' => $user_id,
                'post_status' => 'publish'
             );

        }
        
        $album_id =  wp_insert_post($m_args);
        if($album_id){
            
        update_post_meta($album_id,'fw_options', maybe_unserialize(maybe_serialize($album_sdata)));
        update_post_meta($album_id, 'album_added_by', $user_id);
        update_post_meta($album_id, 'fw_option:album_type', $track_types);
        update_post_meta($album_id, 'fw_option:album_full_prices', $album_price);

        if($music_image){
          set_post_thumbnail($album_id, $attachimage_id);
        }
        wp_set_object_terms($album_id, $_POST['languages'], 'language');

        global $wpdb;
        $pmt_tbl = $wpdb->prefix . 'recurring_subscriptions'; 
        $query = $wpdb->get_row( "SELECT * FROM `$pmt_tbl` WHERE user_id = $user_id AND expiretime > '$today'" );
        
        if($query->remains_upload > 0){

                  $wpdb->update( 
                      $pmt_tbl, 
                      array( 
                        'remains_upload' => $query->remains_upload-1
                        ), 
                      array( 'id' => $query->id ), 
                      array( 
                         '%d'
                         ), 
                      array( '%d' ) 
                    );

              }
            
            $data = array('status' => 'true', 
                          'msg' => 'Uploaded Successfully.',
                          'track_page' => $track_page
                        );

            }else{

              $data = array('status' => 'false', 'msg' => 'Something went Wrong.');

           }

        echo json_encode($data);

        die();

    } 
    echo json_encode($data);
die();
}

/**
 * save vednor strip account detail
 */
add_action( 'wp_ajax_miraculous_vednorstrip_account', 'miraculous_vednorstrip_account');
add_action( 'wp_ajax_nopriv_miraculous_vednorstrip_account', 'miraculous_vednorstrip_account');
function miraculous_vednorstrip_account(){
  $status = false;
  $user_id = get_current_user_id();
  extract($_POST);

  if(!empty($username)){
    update_user_meta($user_id,'stripe_username',$username);
    $status = true;
  }
  if(!empty($useremail)){
    update_user_meta($user_id,'stripe_useremail',$useremail);
    $status = true;
  }
  if(!empty($secretkey)){
    update_user_meta($user_id,'stripe_secretkey',$secretkey);
    $status = true;
  }
  if(!empty($accountid)){
    update_user_meta($user_id,'stripe_accountid',$accountid);
    $status = true;
  } 
   
  if($status == true){ 
    $data = array('status' => 'true', 
    'msg' => 'Save successful Details'); 
  }else{
    $data = array('status' => 'false', 
     'msg' => 'Something went Wrong.');
  }
  echo json_encode($data);
wp_die();
}



