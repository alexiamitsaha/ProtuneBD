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
            'abstyle2'  => __('Grid', 'miraculous'),
        ),
        'value'   => 'abstyle1'
    ),
    'music_number' => array(
        'label'   => __('Number of Product', 'miraculous'),
        'type'    => 'text'
    )
);
?>