<?php if (!defined('FW')) die('Forbidden');
$options = array(
    'user_page_settings' => array(
        'type' => 'tab',
        'title' => esc_html__('Pages Setting', 'miraculous'),
        'options' => array(
		    'profile_pages' =>array(
				   'type' => 'addable-popup',
				   'value' => array(
							 array(
							   'profile_pages' => 'Page Setting',
							   ),
							),
					'label' => esc_html__('Add Page Setting', 'miraculous'),
		            'desc'  => __('These pages show on profile menu', 'miraculous'),
					'template' => esc_html__('Add Page Setting','miraculous'),
					'popup-title' => null,
					'size' => 'small', // small, medium, large
					'limit' => 0, // limit the number of popup`s that can be added
					'add-button-text' => esc_html__('Add', 'miraculous'), 
					'sortable' => true,
					'popup-options' => array(
						'title' => array(
						   'label' => esc_html__('Page title', 'miraculous'),
						   'type' => 'text', 
							),
						'user_profile_page'  => array( 
							'label' => esc_html__('Profile Page', 'miraculous'),
							'type' => 'select',
							'value' => '',
							'desc'  => __('user profile page', 'miraculous'),
							'choices' => miraculous_list_all_pages(),
							),  
						), 
					),
				
			'upload_switch' => array(
			    'type'  => 'switch',
		        'value' => 'on',
		        'label' => esc_html__('Upload Button Enable/Disable', 'miraculous'),
		        'desc'  => __('This upload button works in Top Header of site.', 'miraculous'),
    		        'left-choice' => array(
        				'value' => 'off',
        				'label' => esc_html__('Off', 'miraculous'),
    				 ),
		            'right-choice' => array(
					      'value' => 'on',
					      'label' => esc_html__('On', 'miraculous'),
				           ),
			      ),
			 'registerlogin_switch' => array(
			    'type'  => 'switch',
		        'value' => 'on',
		        'label' => esc_html__('Register/Login Button Enable/Disable', 'miraculous'),
    		        'left-choice' => array(
        				'value' => 'off',
        				'label' => esc_html__('Off', 'miraculous'),
    				 ),
		            'right-choice' => array(
					      'value' => 'on',
					      'label' => esc_html__('On', 'miraculous'),
				           ),
			      ),
			'user_blog_page'  => array( 
				'label' => esc_html__('Your Tracks', 'miraculous'),
				'type' => 'select',
				'value' => '',
				'desc'  => __('Select page you want to redirect users after uploading tracks.', 'miraculous'),
				'choices' => miraculous_list_all_pages(),
			),
			'user_music_upload_page'  => array( 
				 'label' => esc_html__('Music Upload Page', 'miraculous'),
				 'type' => 'select',
				 'value' => '',
				 'desc'  => __('Select the page to link upload button on the top header.', 'miraculous'),
				 'choices' => miraculous_list_all_pages(),
			     ),	
			'user_pricing_plan_page'  => array( 
				'label' => esc_html__('Pricing Plan Page', 'miraculous'),
				'type' => 'select',
				'value' => '',
				'desc'  => __('Select pricing plan page', 'miraculous'),
				'choices' => miraculous_list_all_pages(),
			    ),
			'user_followers_page'  => array( 
				'label' => esc_html__('Followers Page', 'miraculous'),
				'type' => 'select',
				'value' => '',
				'desc'  => __('Select followers page', 'miraculous'),
				'choices' => miraculous_list_all_pages(),
			    ),	
			'directedowenload_switch' => array(
			    'type'  => 'switch',
		        'value' => 'on',
		        'label' => esc_html__('Free Download Enable/Disable',
		        'miraculous'),
		        'desc'  => esc_html__('Allow users to download premium songs at zero (0) amount', 'miraculous'),
    		        'left-choice' => array(
        				'value' => 'off',
        				'label' => esc_html__('Off', 'miraculous'),
    				 ),
		            'right-choice' => array(
					      'value' => 'on',
					      'label' => esc_html__('On', 'miraculous'),
				           ),
			      ),
				  
			
			),
		),
	);  