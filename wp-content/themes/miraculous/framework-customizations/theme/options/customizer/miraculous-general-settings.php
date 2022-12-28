<?php if (!defined('FW')) die('Forbidden');
$options = array(
    'general_settings' => array(
        'type' => 'tab',
        'title' => esc_html__('General Setting', 'miraculous'),
        'options' => array(
		    'logo_setting' => array(
				'type' => 'group',
				'options' => array(
					'logo_image'  => array( 
						'label' => esc_html__('Logo Image', 'miraculous'),
						'desc' => esc_html__('Upload logo image Here.', 'miraculous'),
						'type' => 'upload', 
					),
					'logo_width'  => array( 
						'type' => 'text',
						'value' => '111',
						'desc' => esc_html__('Enter logo width size in pixels. Ex: 80', 'miraculous'),
				    ),
					'logo_height'  => array( 
						'type' => 'text',
						'value' => '111',
						'desc' => esc_html__('Enter logo height size in pixels. Ex: 80', 'miraculous'),
					),
					'logo_title'  => array( 
						'type' => 'text',
						'value' => '',
						'desc' => esc_html__('Enter logo title', 'miraculous'),
					),
					'logo_svgcode'  => array(
						'type'  => 'textarea',
						'value' => '',
						'label' => __('Logo Svg Code', 'miraculous'),
						'desc'  => __('Enter svg code', 'miraculous'),
					),
				), 
			),
           'loader_switch' => array(
			    'type'  => 'switch',
		        'value' => 'on',
		        'label' => esc_html__('Loader Enable/Disable', 'miraculous'),
			        'left-choice' => array(
						'value' => 'off',
						'label' => esc_html__('Off', 'miraculous'),
					),
			        'right-choice' => array(
						  'value' => 'on',
						  'label' => esc_html__('On', 'miraculous'),
					),
			),
            'loader_image'  => array( 
    			'label' => esc_html__('Loader Image', 'miraculous'),
    			'desc' => esc_html__('Upload loader image Here.', 'miraculous'),
    			'type' => 'upload', 
    		),
			'player_switch' => array(
                'type'  => 'multi-picker',
        		'label' => false,
        		'desc'  => false,       
        		'picker' => array(
        			'player_switch_value' => array(
                        'label' => __('Player Enable/Disable', 'miraculous'),
                        'type'  => 'switch',
                        'right-choice' => array(
                          'value' => 'on',
                          'label' => __('On', 'miraculous')
                        ),
                        'left-choice' => array(
                          'value' => 'off',
                          'label' => __('Off', 'miraculous')
                        ),
                    )
        		), 
        		'choices' => array(
        			'on' => array(
    					'player_style' => array(
    						'label' => esc_html__('Player Style', 'miraculous'),
    						'type'  => 'select',
    						'value' => 'testing',
    						'choices' => array(
                                'style-one' => esc_html__('Player Style One', 'miraculous'),
                                'style-two' => esc_html__('Player Style Two', 'miraculous'),
                            ),
    					),		
                		'player_limit' => array(
                            'type'  => 'multi-picker',
                    		'label' => false,
                    		'desc'  => false,       
                    		'picker' => array(
                    			'song_duration' => array(
                                    'label' => __('Song Duration Enable/Disable', 'miraculous'),
                                    'type'  => 'switch',
                                    'right-choice' => array(
                                      'value' => 'on',
                                      'label' => __('On', 'miraculous')
                                    ),
                                    'left-choice' => array(
                                      'value' => 'off',
                                      'label' => __('Off', 'miraculous')
                                    ),
                                )
                    		), 
                    		'choices' => array(
                    			'on' => array(
                					'player_song_duration' => array(
                						'label' => esc_html__('Song Duration', 'miraculous'),
                						'type'  => 'text',
                						'value' => '10',
                						'desc' => esc_html__('Enter Song Duration Value. Ex: 20', 'miraculous'),
                					),
                    			),
                    		),
                    		'show_borders' => false,     
                    	),
            			
        			),
        		),
        		'show_borders' => false,  
        	),
			'shadow_switch' => array(
			    'type'  => 'switch',
		        'value' => 'on',
		        'label' => esc_html__('Footer Shadow Enable/Disable', 'miraculous'),
			        'left-choice' => array(
						'value' => 'off',
						'label' => esc_html__('Off', 'miraculous'),
					),
			        'right-choice' => array(
						  'value' => 'on',
						  'label' => esc_html__('On', 'miraculous'),
					),
			),
		)
    )
);