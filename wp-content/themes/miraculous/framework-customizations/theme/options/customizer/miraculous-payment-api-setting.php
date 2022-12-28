<?php if (!defined('FW')) die('Forbidden');
    $options = array(
        'payment_setting' => array(
        'type' => 'tab',
        'title' => esc_html__('Payment API Setting', 'miraculous'),
        'options' => array(
            'currency' => array(
				'label' => esc_html__('Currency', 'miraculous'),
				'type' => 'select',
				'value' => 'USD',
				'choices' => array(
					'ANG' => esc_html__('ANG', 'miraculous'),
					'AOA' => esc_html__('AOA', 'miraculous'),
					'AUD' => esc_html__('AUD', 'miraculous'),
					'AWG' => esc_html__('AWG', 'miraculous'),
					'BWP' => esc_html__('BWP', 'miraculous'),
                    'BRL' => esc_html__('BRL', 'miraculous'),
					'USD' => esc_html__('USD', 'miraculous'),
					'CAD' => esc_html__('CAD', 'miraculous'),
					'CDF' => esc_html__('CDF', 'miraculous'),
					'GBP' => esc_html__('GBP', 'miraculous'),
					'EUR' => esc_html__('EUR', 'miraculous'),
					'RUB' => esc_html__('RUB', 'miraculous'),
					'INR' => esc_html__('INR', 'miraculous'),
					'JPY' => esc_html__('JPY', 'miraculous'),
					'VND' => esc_html__('VND', 'miraculous'),
					'GHS' => esc_html__('GHS', 'miraculous'),
                    'NGN' => esc_html__('NGN', 'miraculous'),
                     'ZAR' => esc_html__('ZAR', 'miraculous'),
				),
			),
			
			'theme_paypal_switch' => array(
                'type'  => 'multi-picker',
        		'label' => false,
        		'desc'  => false,       
        		'picker' => array(
        			'Paypal_switch_value' => array(
                        'label' => __('Paypal Payment Option', 'miraculous'),
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
    					'paypal_mode' => array(
    						'label' => esc_html__('Paypal Payment Mode', 'miraculous'),
    						'type' => 'select',
    						'value' => 'testing',
    						'choices' => array(
    							'testing' => esc_html__('Testing', 'miraculous'),
    							'live' => esc_html__('Live', 'miraculous')
    						),
    					),
                        'paypal_business_email' => array(
    						'type'  => 'text',
        	        		'value' => '',
        	        		'label' => esc_html__('Paypal Business Email', 'miraculous'),
    
    					),
    					'paypal_success_page_url' => array(
    						'type'  => 'text',
        	        		'value' => '',
        	        		'label' => esc_html__('Paypal Success Url', 'miraculous'),
    					),
    					'paypal_cancel_page_url' => array(
    						'type'  => 'text',
        	        		'value' => '',
        	        		'label' => esc_html__('Paypal Cancel Url', 'miraculous'),
    					),
    					'paypal_info' => array(
    					    'type'  => 'html',
                            'value' => '',
                            'label' => esc_html__('IPN Info', 'miraculous'),
                            'html'  => 'Set this url in paypal IPN setting <code>YOUR SITE URL/wp-content/plugins/miraculouscore/paypal/payments.php</code> for getting payment information.',
    				    ),
        			),
        		),
        		'show_borders' => false,     
        	),
			'theme_stripe_switch' => array(
					'type'  => 'multi-picker',
					'label' => false,
					'desc'  => false,       
					'picker' => array(
						'stripe_switch_value' => array(
							'label' => __('Stripe Payment Option', 'miraculous'),
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
					'paystack_settings' => array(
						'type' => 'group',
						'options' => array(
							'stripe_publishable_key'  => array( 
								'label' => esc_html__('Publishable key', 'miraculous'),
								'type' => 'text',
								'desc' => 'You can get the Publishable key from <a href="https://dashboard.stripe.com/test/dashboard" target="_blank">here.</a>',
							),
							'stripe_secret_key'  => array( 
								'label' => esc_html__('Secret key', 'miraculous'),
								'type' => 'text',
								'desc' => 'You can get the Secret key from <a href="https://dashboard.stripe.com/test/dashboard" target="_blank">here.</a>',
							),
							'stripe_email'  => array( 
								'label' => esc_html__('Secret Email', 'miraculous'),
								'type' => 'text',
								'desc' => 'You can get the Secret key from <a href="https://dashboard.stripe.com/test/dashboard" target="_blank">here.</a>',
							),
							'stripe_success_page_url' => array(
								'type'  => 'text',
								'value' => '',
								'label' => esc_html__('Stripe Price Plan Success Url', 'miraculous'),
							),
							'stripe_success_single_page_url' => array(
								'type'  => 'text',
								'value' => '',
								'label' => esc_html__('Stripe Track/Album Success Url', 'miraculous'),
							),
							'stripe_cancel_page_url' => array(
								'type'  => 'text',
								'value' => '',
								'label' => esc_html__('Stripe Cancel Url', 'miraculous'),
							),
							'stripe_logo_image'  => array( 
								'label' => esc_html__('Stripe Logo Image', 'miraculous'),
								'desc' => esc_html__('Stripe Upload logo image Here.', 'miraculous'),
								'type' => 'upload', 
							),
							'stripe_store_name'  => array( 
								'label' => esc_html__('Stripe Store Name', 'miraculous'),
								'desc' => esc_html__('Enter Stripe Store Name Here.', 'miraculous'),
								'type' => 'text', 
							),
						),
					),		
					),
				),
			),
			'theme_paystack_switch' => array(
				'type'  => 'multi-picker',
				'label' => false,
				'desc'  => false,       
				'picker' => array(
					'paystack_switch_value' => array(
						'label' => __('Paystack Payment Option', 'miraculous'),
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
					    'paystack_settings' => array(
			            	'type' => 'group',
				                'options' => array(
                    					'paystack_secret_key'  => array( 
                    						'label' => esc_html__('Secret Key', 'miraculous'),
                    						'type' => 'text',
                    						'desc' => 'You can get the secret key from <a href="https://dashboard.paystack.com/#/settings/developer" target="_blank">here.</a>',
                    					),
                    					'paystack_public_key'  => array( 
                    						'label' => esc_html__('Public Key', 'miraculous'),
                    						'type' => 'text',
                    						'desc' => 'You can get the secret key from <a href="https://dashboard.paystack.com/#/settings/developer" target="_blank">here.</a>',
                    					),
                    					'paystack_success_page_url' => array(
                    						'type'  => 'text',
                        	        		'value' => '',
                        	        		'label' => esc_html__('Paystack Success Url', 'miraculous'),
                    					),
                    					'paystack_cancel_page_url' => array(
                    						'type'  => 'text',
                        	        		'value' => '',
                        	        		'label' => esc_html__('Paystack Cancel Url', 'miraculous'),
                    					),
        			              ),
			                ),
					    ),
			    	),
			    ),
				'theme_razorpay_switch' => array(
				'type'  => 'multi-picker',
				'label' => false,
				'desc'  => false,       
				'picker' => array(
					'razorpay_switch_value' => array(
						'label' => __('Razorpay Payment Option', 'miraculous'),
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
					    'razorpay_settings' => array(
			            	'type' => 'group',
				                'options' => array(
                    					'razorpay_key'  => array( 
                    						'label' => esc_html__('Razorpay Key', 'miraculous'),
                    						'type' => 'text',
                    						'desc' => 'You can get the secret key from <a href="https://dashboard.razorpay.com/app/keys" 
											target="_blank">here.</a>',
                    					),
                    					'razorpay_success_page_url' => array(
                    						'type'  => 'text',
                        	        		'value' => '',
                        	        		'label' => esc_html__('Razorpay Success Url', 'miraculous'),
                    					),
                    					'razorpay_cancel_page_url' => array(
                    						'type'  => 'text',
                        	        		'value' => '',
                        	        		'label' => esc_html__('Razorpay Cancel Url', 'miraculous'),
                    					),
        			              ),
			                ),
					    ),
			    	),
			    ),
		    ),
		), 
    );