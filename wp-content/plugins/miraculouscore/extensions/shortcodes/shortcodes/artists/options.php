<?php if (!defined('FW')) die('Forbidden');
$category = '';
if(function_exists('get_custom_type_category')):
    $category = get_custom_type_category('artist-type');
endif;

$options = array(
    'artists_label'   => array(
        'label'   => __('Label', 'miraculous'),
        'help'    => __('help', 'miraculous'),
        'type'    => 'text'
    ),
    'artists_style' => array(
        'label'   => __('Style format', 'miraculous'),
        'type'    => 'select',
        'choices' => array(
            'arstyle1'  => __('Style 1', 'miraculous'),
            'arstyle2'  => __('Style 2', 'miraculous'),
            'arstyle3'  => __('Style 3', 'miraculous'),
        ),
        'value'   => 'arstyle1'
    ),
    'artists_type' => array(
        'label'   => __('Artist Type', 'miraculous'),
        'type'    => 'multi-select',
        'choices' => $category
    ),
    'artists_par_slide'   => array(
        'label'   => __('Per Slide Artist', 'miraculous'),
        'type'    => 'text'
    ),
    'artists_number'   => array(
        'label'   => __('Number of Artists', 'miraculous'),
        'type'    => 'text'
    )
);  