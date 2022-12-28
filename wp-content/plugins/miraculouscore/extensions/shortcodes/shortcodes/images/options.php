<?php if (!defined('FW')) die('Forbidden');

$options = array(
	'image' => array(
		'type'  => 'upload',
		'label' => __( 'Choose Image', 'miraculous' ),
		'desc'  => __( 'Either upload a new, or choose an existing image from your media library', 'miraculous' )
	),
	'size' => array(
		'type'    => 'group',
		'options' => array(
			'width'  => array(
				'type'  => 'text',
				'label' => __( 'Width', 'miraculous' ),
				'desc'  => __( 'Set image width', 'miraculous' ),
				'value' => 300
			),
			'height' => array(
				'type'  => 'text',
				'label' => __( 'Height', 'miraculous' ),
				'desc'  => __( 'Set image height', 'miraculous' ),
				'value' => 200
			)
		)
	),
	'alignment' => array(
		'type' => 'select',
		'label' => __('Image Alignment', 'miraculous'),
		'desc' => __( 'Set image alignment.', 'miraculous' ),
		'choices' => array(
            'left'  => __('Left', 'miraculous'),
            'center'  => __('Center', 'miraculous'),
            'right'  => __('Right', 'miraculous')
        ),
        'value'   => 'center'
	),
	'image-link-group' => array(
		'type'    => 'group',
		'options' => array(
			'link'   => array(
				'type'  => 'text',
				'label' => __( 'Image Link', 'miraculous' ),
				'desc'  => __( 'Where should your image link to?', 'miraculous' )
			),
			'target' => array(
				'type'         => 'switch',
				'label'        => __( 'Open Link in New Window', 'miraculous' ),
				'desc'         => __( 'Select here if you want to open the linked page in a new window', 'miraculous' ),
				'right-choice' => array(
					'value' => '_blank',
					'label' => __( 'Yes', 'miraculous' ),
				),
				'left-choice'  => array(
					'value' => '_self',
					'label' => __( 'No', 'miraculous' ),
				),
			),
		)
	)
);