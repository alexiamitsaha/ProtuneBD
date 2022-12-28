<?php if (!defined('FW')) die('Forbidden');
$options = array(
    'woocommerce_settings' => array(
        'type' => 'tab',
        'title' => esc_html__('Commission Setting', 'miraculous'),
        'options' => array(
            'commission_value'  => array( 
					'type' => 'text',
					'value' => '',
					'label' => __('Commission %', 'miraculous'),
					'desc' => esc_html__('Enter Commission % for vendors', 'miraculous'),
				  ),
            )
        )
    );