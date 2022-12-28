<?php if (!defined('FW')) die('Forbidden');
$options = array(
    'mailchimp_tab' => array(
        'type' => 'tab',
        'title' => esc_html__('Api Setting', 'miraculous'),
        'options' => array(
			'mailchimp_settings' => array(
				'type' => 'group',
				'options' => array(
					'mailchimp_api_key'  => array( 
						'label' => esc_html__('MailChimp Api Key', 'miraculous'),
						'type' => 'text',
					),
					'mailchimp_list_id'  => array( 
						'label' => esc_html__('MailChimp List Id', 'miraculous'),
						'type' => 'text',
					),
				),
			),	
			'google_api_settings' => array(
				'type' => 'group',
				'options' => array(
					'google_login_client_id' => array(
						'type'  => 'text',
    	        		'value' => '',
    	        		'label' => esc_html__('Google App Client ID', 'miraculous'),

					),
					'google_login_client_secret' => array(
						'type'  => 'text',
    	        		'value' => '',
    	        		'label' => esc_html__('Google App client serect', 'miraculous'),
					),
					'google_login_redirect_uri' => array(
						'type'  => 'text',
    	        		'value' => '',
    	        		'label' => esc_html__('Google Login Redirect URI', 'miraculous'),
					),
				),
			),
		),
	),
);  