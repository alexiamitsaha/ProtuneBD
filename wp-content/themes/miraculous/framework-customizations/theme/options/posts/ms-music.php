<?php if( !defined('FW') ) die('Forbidden');
  
  /**
 * Multivendor single music purchase plan options
 * Replace file 
 * File correction : 28-01-2021
 * @update: @an
 */
if (function_exists('fw_get_db_post_option')): 
 $miraculous_post_data = fw_get_db_post_option(get_the_ID());   
endif;
$music_artists = '';
if(!empty($miraculous_post_data['user_music_artist'])):
$music_artists = $miraculous_post_data['user_music_artist'];
else:
$music_artists = get_post_meta(get_the_ID(),'fw_option:user_music_artist',true);
endif;

$full_songs_url = '';
if(!empty($miraculous_post_data['mp3_full_songs']['url'])):
   $full_songs_url = $miraculous_post_data['mp3_full_songs']['url'];
else:
   $full_songs_url = get_post_meta(get_the_ID(),'fw_option:mp3_full_songs',true);
endif;
$user_price = '';
if(!empty($miraculous_post_data['single_music_prices'])):
    $user_price = $miraculous_post_data['single_music_prices'];
 else:
    $user_price = get_post_meta(get_the_ID(),'fw_option:single_music_prices',true);
 endif;
 $music_types = '';
 if(!empty($miraculous_post_data['music_types'])):
     $music_types = $miraculous_post_data['music_types'];
  else:
     $music_types = get_post_meta(get_the_ID(),'fw_option:music_types',true);
  endif;

$options = array(
    'music_upload_option' => array(
        'type' => 'box',
        'title' => __('Music Upload Options', 'miraculous'),
        'options' => array(
            
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
                'fw-storage' => array(
                    'type' => 'post-meta',
                    'post-meta' => 'fw_option:music_extranal_url',
                ),
                'value' => '',
                'label' => __('Mp3 Music External Url', 'miraculous'),
                'desc'  => __('Mp3 Music External Url', 'miraculous'),
            ),
            
            'user_music_artist'  => array(
                 'type'  => 'text',
                 
                 'value' => $music_artists,
                 'label' => __('Artist Name', 'miraculous'),
                 'desc'  => __('Artist Name', 'miraculous'),
            ),
        ),
    ),
    'music_option' => array(
        'type' => 'box',
        'title' => __('Music Options', 'miraculous'),
        'options' => array(
            'music_types' => array(
                'type'  => 'radio',
                'fw-storage' => array(
                    'type' => 'post-meta',
                    'post-meta' => 'fw_option:music_types',
                ),
                //'value' => $music_types,
                'label' => __('Music', 'miraculous'),
                'choices' => array( 
                    'premium' => __('Premium', 'miraculous'),
                    'free' => __('Free', 'miraculous'),
                    
                ),  
                // Display choices inline instead of list
                'inline' => true,
            ),
            'single_music_prices'  => array(
                'type'  => 'text',
                'fw-storage' => array(
                    'type' => 'post-meta',
                    'post-meta' => 'fw_option:single_music_prices',
                ), 
                'value' => '',
                'label' => __('Price', 'miraculous'),
                'desc'  => __('enter price.', 'miraculous'),
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
            
            'music_release_date' => array(
                'type'  => 'date-picker',
                'fw-storage' => array(
                    'type' => 'post-meta',
                    'post-meta' => 'fw_option:music_release_date',
                ), 
                'label' => __('Release Date', 'miraculous'),
                'monday-first' => true, // The week will begin with Monday; for Sunday, set to false
                'min-date' => "01-01-1900", 
                'max-date' => null, 
            ),
            'post-sidebar' => array(
                'label'   => esc_html__( 'Post Sidebar Position', 'miraculous' ),
                'type'    => 'image-picker',
                'value'   => 'full',
                'desc'    => esc_html__( 'Select main content and sidebar alignment. Choose between 1, 2 or 3 column layout.',
                    'miraculous' ),
                'choices' => array(
                    'full' => array(
                        'small' => array(
                            'height' => 50,
                            'src'    => get_template_directory_uri() . '/assets/images/1c.png'
                        ),
                    ),
                    'left' => array(
                        'small' => array(
                            'height' => 50,
                            'src'    => get_template_directory_uri() . '/assets/images/2cl.png'
                        ),
                    ),
                    'right' => array(
                        'small' => array(
                            'height' => 50,
                            'src'    => get_template_directory_uri() . '/assets/images/2cr.png'
                        ),
                    ),
                ),
            ),
            'post_breadcrumbs_switch' => array( 
                'type'  => 'switch',
                'value' => 'on',
                'label' => esc_html__('Breadcrumbs Enable/Disable', 'miraculous'),
                    'left-choice' => array(
                        'value' => 'off',
                        'label' => esc_html__('Off', 'miraculous'),
                    ),
                        'right-choice' => array(
                        'value' => 'on',
                        'label' => esc_html__('On', 'miraculous'),
                    ),
            ),
            'post_bgimages_switch' => array( 
                'type'  => 'switch',
                'value' => 'on',
                'label' => esc_html__('Background Image Enable/Disable', 'miraculous'),
                    'left-choice' => array(
                        'value' => 'off',
                        'label' => esc_html__('Off', 'miraculous'),
                    ),
                        'right-choice' => array(
                        'value' => 'on',
                        'label' => esc_html__('On', 'miraculous'),
                    ),
            ),
            'single_bg_images'  => array(
                'type'  => 'upload',
                'value' => '',
                'images_only' => true,
                'label' => __('Background Image', 'miraculous'),
                'desc'  => __('Upload Background Image', 'miraculous'),
                ),
        ),
    ),
);