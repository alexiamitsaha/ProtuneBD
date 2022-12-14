<?php if (!defined('FW')) die('Forbidden');

/**
 * @var array $atts
 */

if ( empty( $atts['image'] ) ) {
	return;
}
$alignment = 'center';
$align_class = 'ms_advr_wrapper';
if ( empty( $atts['alignment'] ) ) {
	$alignment = $atts['alignment'];
}
if($alignment == 'left'){
	$align_class = 'ms_advr_wrapper_left';
}
if($alignment == 'right'){
	$align_class = 'ms_advr_wrapper_right';
}

$width  = ( is_numeric( $atts['width'] ) && ( $atts['width'] > 0 ) ) ? $atts['width'] : '';
$height = ( is_numeric( $atts['height'] ) && ( $atts['height'] > 0 ) ) ? $atts['height'] : '';

if ( ! empty( $width ) && ! empty( $height ) ) {
	$image = fw_resize( $atts['image']['attachment_id'], $width, $height, true );
} else {
	$image = $atts['image']['url'];
}

$alt = get_post_meta($atts['image']['attachment_id'], '_wp_attachment_image_alt', true);

$img_attributes = array(
	'src' => $image,
	'alt' => $alt ? $alt : $image
);

if(!empty($width)){
	$img_attributes['width'] = $width;
}

if(!empty($height)){
	$img_attributes['height'] = $height;
}

if ( empty( $atts['link'] ) ) { ?>
<div class="<?php echo esc_attr($align_class); ?>">
	<div class="container">
		<div class="row">
			<div class="col-lg-12">
			<?php echo fw_html_tag('img', $img_attributes); ?>
			</div>
		</div>
	</div>
</div>
<?php
} else {
	?>
<div class="<?php echo esc_attr($align_class); ?>">
	<div class="container">
		<div class="row">
			<div class="col-lg-12">
				<?php 
				 echo fw_html_tag('a', array(
						'href' => $atts['link'],
						'target' => $atts['target'],
				 ), fw_html_tag('img',$img_attributes));
				?>
			</div>
		</div>
	</div>
</div>
<?php
}