<?php if (!defined('FW')) die('Forbidden');
$options = array(
    'radio_label'   => array(
        'label'   => __('Label', 'miraculous'),
        'help'    => __('help', 'miraculous'),
        'type'    => 'text'
    ),
    'radio_style' => array(
        'label'   => __('Style format', 'miraculous'),
        'type'    => 'select',
        'choices' => array(
            'abstyle1'  => __('Slider', 'miraculous'),
            'abstyle2'  => __('Grid', 'miraculous'),
            'abstyle3'  => __('Weekly', 'miraculous'),
            'abstyle4'  => __('Slider2', 'miraculous'),
            'abstyle5'  => __('Radio Stations By Genre', 'miraculous'),
            'abstyle6'  => __('Radio By Location', 'miraculous')
        ),
        'value'   => 'abstyle1'
    ),
    'radio_par_slide'   => array(
        'label'   => __('Par Slide Radio', 'miraculous'),
        'help'    => __('help', 'miraculous'),
        'type'    => 'text'
    ),
    'radio_number'   => array(
        'label'   => __('Number of Radio', 'miraculous'),
        'help'    => __('help', 'miraculous'), 
        'type'    => 'text'
    )
);
?>