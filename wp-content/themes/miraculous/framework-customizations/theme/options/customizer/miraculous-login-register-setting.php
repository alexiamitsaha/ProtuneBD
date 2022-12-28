<?php if (!defined('FW')) die('Forbidden');
$options = array(
    'loginregister_settings' => array(
        'type' => 'tab',
        'title' => esc_html__('Login/Register Setting', 'miraculous'),
        'options' => array(

		'loginregister_switch' => array(
			'type'  => 'switch',
			'value' => 'on',
			'label' => esc_html__('Login / Register Enable/Disable', 'miraculous'),
				'left-choice' => array(
					'value' => 'off',
					'label' => esc_html__('Off', 'miraculous'),
				  ),
				'right-choice' => array(
					'value' => 'on',
					'label' => esc_html__('On', 'miraculous'),
				),
	    	),
        /**
		 * Toltip option
		 */
		'register_artist_toltip'  => array( 
			'label' => esc_html__('Register Form Artist Tooltip', 'miraculous'),
			'desc' => esc_html__('', 'miraculous'),
			'type' => 'textarea', 
		   ),
		'register_listener_toltip'  => array( 
			'label' => esc_html__('Register Form Listener Tooltip', 'miraculous'),
			'desc' => esc_html__('', 'miraculous'),
			'type' => 'textarea', 
		   ),
		'loginregister_image'  => array( 
					 'label' => esc_html__('Login / Register Image', 'miraculous'),
					 'desc' => esc_html__('Upload Login & Register Image Here.', 'miraculous'),
					 'type' => 'upload', 
					),
        /**
		 * Login Page Redirect Setting
		 */

		'dashboard_redirect'  => array( 
			 'label' => esc_html__('Dashboard Page', 'miraculous'),
			 'type' => 'select',
			 'value' => '',
			 'desc'  => __('Select page you want to redirect users after register/login.', 'miraculous'),
			 'choices' => miraculous_list_all_pages(),
			),  

		/*'paymentsetting_redirect'  => array( 
			 'label' => esc_html__('Payment Gatway Page', 'miraculous'),
			 'type' => 'select',
			 'value' => '',
			 'desc'  => __('', 'miraculous'),
			 'choices' => miraculous_list_all_pages(),
			), 	
		'pricingplane_redirect'  => array( 
			 'label' => esc_html__('Subscribe Plan Page', 'miraculous'),
			 'type' => 'select',
			 'value' => '',
			 'desc'  => __('', 'miraculous'),
			 'choices' => miraculous_list_all_pages(),
			), 
        */		


		)
    )
);