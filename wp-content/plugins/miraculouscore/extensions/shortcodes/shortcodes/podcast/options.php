<?php if (!defined('FW')) die('Forbidden');
$options = array(
    'podcast_label'   => array(
        'label'   => __('Label', 'miraculous'),
        'help'    => __('help', 'miraculous'),
        'type'    => 'text'
    ),
    'podcast_style' => array(
        'label'   => __('Style format', 'miraculous'),
        'type'    => 'select',
        'choices' => array(
            'abstyle1'  => __('Grid', 'miraculous'),
            'abstyle2'  => __('Slider', 'miraculous'),
        ),
        'value'   => 'abstyle1'
    ),
    'podcast_downloadable' => array(
        'label'   => __('Podcast', 'miraculous'),
        'type'    => 'select',
        'choices' => array(
            'free'  => __('Free', 'miraculous'),
            'premium'  => __('Premium', 'miraculous'), 
        ),
        'value'   => 'free'
    ),
    'podcast_par_slide'   => array(
        'label'   => __('Par Slide Podcast', 'miraculous'),
        'help'    => __('help', 'miraculous'),
        'type'    => 'text'
    ),
    'podcast_type' => array(
        'label'   => __('Podcast Type', 'miraculous'),
        'type'    => 'select',
        'choices' => get_custom_type_category('podcast_type')
    ),
    'podcasts_number'   => array(
        'label'   => __('Number of Podcast', 'miraculous'),
        'help'    => __('help', 'miraculous'),
        'type'    => 'text' 
    )
);
?>