<?php if (!defined('FW')) die('Forbidden');
$options = array(
    'fav_music_label'   => array(
        'label'   => __('Label', 'miraculous'),
        'type'    => 'text'
    ),
    'fav_music_list' => array(
        'label'   => __('List by', 'miraculous'),
        'type'    => 'select',
        'choices' => array(
            'songs'  => __('Songs', 'miraculous'),
            'albums'  => __('Albums', 'miraculous'),
            'artist'  => __('Artists', 'miraculous'),
            'radio'  => __('Radios', 'miraculous')
        ),
        'value'   => 'songs'
    ),
    'fav_style_type' => array(
        'label'   => __('Style format', 'miraculous'),
        'type'    => 'select',
        'choices' => array(
            'arstyle1'  => __('Style 1', 'miraculous'),
            'arstyle2'  => __('Style 2', 'miraculous'),
        ),
        'value'   => 'arstyle1'
    ),
    'fav_music_number' => array(
        'label'   => __('Number of Songs', 'miraculous'),
        'type'    => 'text'
    )
);