<?php if (!defined('FW')) die('Forbidden');
$category = '';
if(function_exists('get_custom_type_category')):
    $category = get_custom_type_category('music-type');
endif;
$options = array(
    'music_label'   => array(
        'label'   => __('Label', 'miraculous'),
        'type'    => 'text'
    ),
    'post_type_top' => array(
        'label'   => __('Style Top Music Type', 'miraculous'),
        'type'    => 'select',
        'choices' => array(
            'music'  => __('Music', 'miraculous'),
        ),
        'value'   => 'music'
    ),
    'music_number' => array(
        'label'   => __('Number of Songs', 'miraculous'),
        'type'    => 'text'
    ),
    'music_song_view' => array(
        'label'   => __('Song View Counter', 'miraculous'),
        'type'  => 'switch',
        'desc' => __('Please use one filter between view and download.', 'miraculous'),
        'left-choice' => array(
            'value' => 'on',
            'label' => __('ON', 'miraculous'),
          ),
        'right-choice' => array(
            'value' => 'off',
            'label' => __('OFF', 'miraculous'),
          ),
    ),
    'music_song_dowenload' => array(
        'label'   => __('Song View Download', 'miraculous'),
        'type'  => 'switch',
        'left-choice' => array(
            'value' => 'on',
            'label' => __('ON', 'miraculous'),
          ),
        'right-choice' => array(
            'value' => 'off',
            'label' => __('OFF', 'miraculous'),
          ),
        )  
);
?>