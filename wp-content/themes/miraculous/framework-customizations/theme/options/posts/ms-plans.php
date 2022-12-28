<?php if( !defined('FW') ) die('Forbidden');
$options = array(
    'main' => array(
        'type' => 'box',
        'title' => __('Plan Options', 'miraculous'),
        'options' => array(

          'free_plane_switch' => array(
              'label' => __('Free Plan Enable/Disable', 'miraculous'),
              'type'  => 'switch',
              'right-choice' => array(
                  'value' => 'on',
                  'label' => __('On', 'miraculous')
                  ),
	             'left-choice' => array(
	                 'value' => 'off',
	                 'label' => __('Off', 'miraculous')
	                ),
			        ),
           'plan_monthly_price' => array(
                'type'  => 'text',
                'fw-storage' => array(
                    'type' => 'post-meta',
                    'post-meta' => 'fw_option:plan_monthly_price',
                   ),
                'label' => __('Monthly Price', 'miraculous'),
                'desc'  => __('Enter monthly price eg. 20, Do not use decimal value.', 'miraculous'),
             ), 
            'plan_monthly_uploads' => array(
                'type'  => 'text',
                'fw-storage' => array(
                    'type' => 'post-meta',
                    'post-meta' => 'fw_option:plan_monthly_uploads',
                    ),
                'label' => __('Monthly Uploads', 'miraculous'),
                'desc'  => __('Enter number of songs to Uploads eg. 50', 'miraculous'),
              ),
            'plan_monthly_download' => array(
                'type'  => 'text',
                'fw-storage' => array(
                    'type' => 'post-meta',
                    'post-meta' => 'fw_option:plan_monthly_download',
                 ),
                'label' => __('Monthly Download', 'miraculous'),
                'desc'  => __('Enter number of songs to download Limite eg. 50', 'miraculous'),
              ),  
            'plan_validity' => array(
                'type'  => 'text',
                'fw-storage' => array(
                    'type' => 'post-meta',
                    'post-meta' => 'fw_option:plan_validity',
                ),
                'label' => __('Plan Validity', 'miraculous'),
                'desc'  => __('Enter number of months eg. 2', 'miraculous'),
            ),
         ),
    ), 
);