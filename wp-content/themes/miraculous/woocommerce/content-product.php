<?php
/**
 * The template for displaying product content within loops
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/content-product.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 3.6.0
 */


defined( 'ABSPATH' ) || exit;

global $product;

// Ensure visibility.
if ( empty( $product ) || ! $product->is_visible() ) {
	return;
}
$play_img = get_template_directory_uri().'/assets/images/svg/play.svg';
	
?>
<li <?php wc_product_class( '', $product ); ?>>
    <div class="ms_store_img">
	<?php
	if(function_exists( 'fw_get_db_post_option' )){
	$miraclous_post_data = fw_get_db_post_option(get_the_id());
	if(!empty($miraclous_post_data['music_extranal_url'])){
	$mp3url = $miraclous_post_data['music_extranal_url'];
	}
	elseif(!empty($miraclous_post_data['mp3_full_songs']['url'])){
		$mp3url = $miraclous_post_data['mp3_full_songs']['url'];
	}
	else{
		$mp3url = "0";
	}
}
	/**
	 * Hook: woocommerce_before_shop_loop_item.
	 *
	 * @hooked woocommerce_template_loop_product_link_open - 10
	 */
	 do_action( 'woocommerce_before_shop_loop_item' );
    /**
	 * Hook: woocommerce_before_shop_loop_item_title.
	 *
	 * @hooked woocommerce_show_product_loop_sale_flash - 10
	 * @hooked woocommerce_template_loop_product_thumbnail - 10
	 */
	 do_action( 'woocommerce_before_shop_loop_item_title' );
	 ?>
	</div>
	<?php if($mp3url == "0"){
		
	}
	else{ ?>
	 <div class="ms_play_icon play_btn play_music" data-musicid="<?php esc_attr_e(get_the_id()); ?>" data-musictype="music">
        <img src="<?php echo esc_url($play_img); ?>" alt="<?php  esc_attr_e('play', 'miraculous'); ?>">
     </div>
    <?php
	}
	/**
	 * Hook: woocommerce_shop_loop_item_title.
	 *
	 * @hooked woocommerce_template_loop_product_title - 10
	 */
	do_action( 'woocommerce_shop_loop_item_title' );
    /**
	 * Hook: woocommerce_after_shop_loop_item_title.
	 *
	 * @hooked woocommerce_template_loop_rating - 5
	 * @hooked woocommerce_template_loop_price - 10
	 */
	do_action( 'woocommerce_after_shop_loop_item_title' );

	/**
	 * Hook: woocommerce_after_shop_loop_item.
	 *
	 * @hooked woocommerce_template_loop_product_link_close - 5
	 * @hooked woocommerce_template_loop_add_to_cart - 10
	 */
	do_action( 'woocommerce_after_shop_loop_item' );
	?>
</li>
