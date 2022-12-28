<?php if(!defined('FW')) {
	die( 'Forbidden' );
}
$options = array(
    'web_urls'  => array( 
		'label' => esc_html__('Web Url', 'weburl'),
		'type' => 'text',
		'value' => '',
		'desc' => esc_html__('', 'weburl'),
	    ), 	 
    );			
?> 