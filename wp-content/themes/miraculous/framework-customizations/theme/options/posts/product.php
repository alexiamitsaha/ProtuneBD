<?php if( !defined('FW') ) die('Forbidden');

if (function_exists('fw_get_db_post_option')): 
$miraculous_post_data = fw_get_db_post_option(get_the_ID());   
endif;
$full_songs_url = '';
if(!empty($miraculous_post_data['mp3_full_songs']['url'])):
   $full_songs_url = $miraculous_post_data['mp3_full_songs']['url'];
else:
   $full_songs_url = get_post_meta(get_the_ID(),'fw_option:mp3_full_songs',true);
endif;
$options = array(
    'music_upload_option' => array(
        'type' => 'box',
        'title' => __('Music Upload Options', 'miraculous'),
        'options' => array(
            'woco_mp2_switch' => array(
			    'label' => __('WooCommerce Page MP3 Enable/Disable', 'miraculous'),
			    'type'  => 'switch',
			    'value' => 'on',
			    'right-choice' => array(
			         'value' => 'on',
			         'label' => __('On', 'miraculous')
			         ),
	             'left-choice' => array(
	                 'value' => 'off',
	                 'label' => __('Off', 'miraculous')
	                ),
			     ),
            'mp3_full_songs' => array(
                'type'  => 'upload',
                'fw-storage' => array(
                    'type' => 'post-meta',
                    'post-meta' => 'fw_option:mp3_full_songs',
                ),
                'label' => __('Mp3 Full song', 'miraculous'),
                'desc'  => $full_songs_url,
                'files_ext' => array( 'mp3' ),
                'extra_mime_types' => array( 'audio/x-aiff, aif aiff' )
            ),
            'music_extranal_url'  => array(
                    'type'  => 'text',
                    'value' => '',
                    'label' => __('Mp3 Music External Url', 'miraculous'),
                    'desc'  => __('Mp3 Music External Url', 'miraculous'),
                    ),
            'music_artists' => array(
                'type'  => 'select-multiple',
                'fw-storage' => array(
                    'type' => 'post-meta',
                    'post-meta' => 'fw_option:music_artists',
                ),
                'label' => __('Artist Name', 'miraculous'),
                'desc'  => __('Select Artists you wish to assign for this music.', 'miraculous'),
                'choices' => miraculous_get_all_artists_name_for_album_post(),
            ),
        ),
    ),
  );