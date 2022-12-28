<?php if (!defined('FW')) die('Forbidden');
$options = array(
    'user_music_label'   => array(
        'label'   => __('Label', 'miraculous'),
        'type'    => 'text'
    ),
    'user_music_type' => array(
        'label'   => __('Tracks', 'miraculous'),
        'type'    => 'select',
        'choices' => array(
            'free'  => __('Free', 'miraculous'),
            'premium'  => __('Premium', 'miraculous'),
        ),
        'value'   => 'free'
    ),
    'track_style_type' => array(
        'label'   => __('Style format', 'miraculous'),
        'type'    => 'select',
        'choices' => array(
            'arstyle1'  => __('Style 1', 'miraculous'),
            'arstyle2'  => __('Style 2', 'miraculous'),
        ),
        'value'   => 'arstyle1'
    ),
    'user_music_number' => array(
        'label'   => __('Number of Songs', 'miraculous'),
        'type'    => 'text'
    )
);
?>