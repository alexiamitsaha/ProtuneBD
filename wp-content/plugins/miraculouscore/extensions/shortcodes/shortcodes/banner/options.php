<?php if (!defined('FW')) die('Forbidden');
$options = array(
    'banner_fullwidth_postion' => array(
        'type'  => 'switch',
        'label' => __('Full width position', 'miraculous'),
        'left-choice' => array(
            'value' => 'full',
            'label' => __('Full Width', 'miraculous'),
        ),
        'right-choice' => array(
            'value' => 'half',
            'label' => __('Container', 'miraculous'),
        ),
    ),
    'banner_heading'   => array(
        'label'   => __('Heading', 'miraculous'),
        'help'    => __('help', 'miraculous'),
        'type'    => 'text'
    ),
    'banner_sub_heading' => array(
        'label'   => __('Sub heading', 'miraculous'),
        'help'    => __('help', 'miraculous'),
        'type'    => 'text'
    ),
    'banner_desc' => array(
        'label'   => __('Description', 'miraculous'),
        'help'    => __('help', 'miraculous'),
        'type'    => 'textarea'
    ),
    'banner_image'   => array(
        'label'   => __('Image', 'miraculous'),
        'desc'    => __('Banner image', 'miraculous'),
        'type'    => 'upload'
    ),
    'banner_image_postion' => array(
        'type'  => 'switch',
        'label' => __('Image position', 'miraculous'),
        'help'  => __('Help tip', 'miraculous'),
        'left-choice' => array(
            'value' => 'left',
            'label' => __('Left', 'miraculous'),
        ),
        'right-choice' => array(
            'value' => 'right',
            'label' => __('Right', 'miraculous'),
        ),
    ),
    'banner_button1_sw' => array(
        'type'  => 'switch',
        'label' => __('Button1', 'miraculous'),
        'help'  => __('Help tip', 'miraculous'),
        'left-choice' => array(
            'value' => 'off',
            'label' => __('off', 'miraculous'),
        ),
        'right-choice' => array(
            'value' => 'on',
            'label' => __('on', 'miraculous'),
        ),
    ),
    'banner_button1' => array(
        'label'   => __('Button 1 Label', 'miraculous'),
        'help'    => __('help', 'miraculous'),
        'type'    => 'text'
    ),
    'banner_button1_url' => array(
        'label'   => __('Button 1 Url', 'miraculous'),
        'help'    => __('help', 'miraculous'),
        'type'    => 'text'
    ),
    'banner_button2_sw' => array(
        'type'  => 'switch',
        'label' => __('Button2', 'miraculous'),
        'help'  => __('Help tip', 'miraculous'),
        'left-choice' => array(
            'value' => 'off',
            'label' => __('off', 'miraculous'),
        ),
        'right-choice' => array(
            'value' => 'on',
            'label' => __('on', 'miraculous'),
        ),
    ),
    'banner_button2' => array(
        'label'   => __('Button 2 Label', 'miraculous'),
        'help'    => __('help', 'miraculous'),
        'type'    => 'text'
    ),
    'banner_button2_url' => array(
        'label'   => __('Button 2 Url', 'miraculous'),
        'help'    => __('help', 'miraculous'),
        'type'    => 'text'
    )
);