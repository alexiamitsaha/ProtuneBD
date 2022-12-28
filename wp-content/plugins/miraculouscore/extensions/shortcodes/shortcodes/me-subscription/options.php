<?php if (!defined('FW')) die('Forbidden');
$options = array(
    'manage_plan_heading'   => array(
        'label'   => __('Heading', 'miraculous'),
        'type'    => 'text'
    ),
	'priceplan_switch' => array( 
		 'type'  => 'switch',
		  'value' => 'on',
		  'label' => esc_html__('Price Plan Enable/Disable', 'miraculous'),
				  'left-choice' => array(
								   'value' => 'off',
								   'label' => esc_html__('Off', 'miraculous'),
								  ),
				  'right-choice' => array(
								 'value' => 'on',
								 'label' => esc_html__('On', 'miraculous'),
								),
	 ),
);
?>