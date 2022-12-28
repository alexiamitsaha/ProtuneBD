<?php if (!defined('FW')) die('Forbidden');
$options = array(
    'albums_label'   => array(
        'label'   => __('Label', 'miraculous'),
        'help'    => __('help', 'miraculous'),
        'type'    => 'text'
    ),
    'albums_style' => array(
        'label'   => __('Style format', 'miraculous'),
        'type'    => 'select',
        'choices' => array(
            'abstyle1'  => __('Slider', 'miraculous'),
            'abstyle2'  => __('Grid', 'miraculous'),
            'abstyle3'  => __('Weekly', 'miraculous'),
            'abstyle4'  => __('Slider2', 'miraculous'),
            'abstyle5'  => __('Slider3', 'miraculous'),
            'abstyle6'  => __('Center Slider', 'miraculous')
        ),
        'value'   => 'abstyle1'
    ),
    'album_downloadable' => array(
        'label'   => __('Album', 'miraculous'),
        'type'    => 'select',
        'choices' => array(
            'free'  => __('Free', 'miraculous'),
            'premium'  => __('Premium', 'miraculous'),
        ),
        'value'   => 'free'
    ),
    'albums_type' => array(
        'label'   => __('Albums Type', 'miraculous'),
        'type'    => 'select',
        'choices' => get_custom_type_category('album-type')
    ),
    'albums_par_slide'   => array(
        'label'   => __('Per Slide Albums', 'miraculous'),
        'type'    => 'text'
    ),
    'albums_number'   => array(
        'label'   => __('Number of Albums', 'miraculous'),
        'type'    => 'text'
    )
);
?>