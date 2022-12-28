<?php if(!defined('FW')) die( 'Forbidden' );
$options = array(
     'dowenload_heading'   => array(
        'label'   => __('Enter Your Heading', 'miraculous'),
        'type'    => 'text'
      ),
      'dowenload_style' => array(
        'label'   => __('Style format', 'miraculous'),
        'type'    => 'select',
        'choices' => array(
            'arstyle1'  => __('Style 1', 'miraculous'),
            'arstyle2'  => __('Style 2', 'miraculous'),
        ),
        'value'   => 'arstyle1'
    ),
    );			