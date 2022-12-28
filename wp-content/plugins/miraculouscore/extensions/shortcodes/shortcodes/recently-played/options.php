<?php if (!defined('FW')) die('Forbidden');
$options = array(
    'rc_music_label'   => array(
        'label'   => __('Label', 'miraculous'),
        'type'    => 'text'
    ),
    'rc_music_style' => array(
        'label'   => __('Style format', 'miraculous'),
        'type'    => 'select',
        'choices' => array(
            'abstyle1'  => __('Slider', 'miraculous'),
            'abstyle2'  => __('Grid', 'miraculous'),
        ),
        'value'   => 'abstyle1'
    ),
    'number_limits' => array(
        'label'   => __('Number of Tracks', 'miraculous'),
        'type'    => 'text'
    ),
    'par_slide'   => array(
        'label'   => __('Par Slide', 'miraculous'),
        'help'    => __('help', 'miraculous'),
        'type'    => 'text'
    ),
);
?>