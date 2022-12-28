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
    'music_style' => array(
        'label'   => __('Style format', 'miraculous'),
        'type'    => 'select',
        'choices' => array(
            'abstyle1'  => __('Slider', 'miraculous'),
            'abstyle2'  => __('Weekly', 'miraculous'),
            'abstyle3'  => __('Grid', 'miraculous'),
            'abstyle4'  => __('Slider2', 'miraculous'),
            'abstyle6'  => __('List', 'miraculous'),
        ),
        'value'   => 'abstyle1'
    ),
    'music_downloadable' => array(
        'label'   => __('Songs', 'miraculous'),
        'type'    => 'select',
        'choices' => array(
            'free'  => __('Free', 'miraculous'),
            'premium'  => __('Premium', 'miraculous'),
           ),
        'value'   => 'free'
    ),
    'music_filter' => array(
        'label'   => __('Songs Filter By', 'miraculous'),
        'type'    => 'select',
        'choices' => array(
            ''  => __('Select', 'miraculous'),
            'song_views_count'  => __('Song Views', 'miraculous'),
            'song_dowenload_counter'  => __('Song Download', 'miraculous'),
           ),
        'value'   => ''
    ),
    'music_types' => array(
        'label'   => __('Song Type', 'miraculous'),
        'type'    => 'select',
        'choices' => $category
       ),
    'music_number' => array(
        'label'   => __('Number of Songs', 'miraculous'),
        'type'    => 'text'
        ),
    'music_song_view' => array(
        'label'   => __('Song View Counter', 'miraculous'),
        'type'  => 'switch',
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
        'label'   => __('Song View Dowenload', 'miraculous'),
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