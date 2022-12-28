<?php
/**
 * Related Products
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/single-product/related.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see         https://docs.woocommerce.com/document/template-structure/
 * @package     WooCommerce\Templates
 * @version     3.9.0
 */


if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( $related_products ) : ?>

<div class="ms_fea_album_slider">
       <div class="ms_heading">
           <?php
           $heading = apply_filters( 'woocommerce_product_related_products_heading', __( 'Related products', 'woocommerce' ) );
		    if ( $heading ) :
			?>
			<h1><?php echo esc_html( $heading ); ?></h1>
		<?php endif; ?>
       </div>
       <div class="ms_relative_inner">
        <div class="ms_woocommerce_slider swiper-container swiper-container-horizontal">
            <div class="swiper-wrapper">
                <?php
                foreach ( $related_products as $related_product ) :
                    $post_object = get_post( $related_product->get_id());
                    setup_postdata( $GLOBALS['post'] =& $post_object );
                ?>
                <div class="swiper-slide">
                    <div class="ms_store_img">  
                    	<?php
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
                        <?php
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
                   </div>
                <?php  endforeach; ?>
            </div>
            <span class="swiper-notification" aria-live="assertive" aria-atomic="true"></span>
            <span class="swiper-notification" aria-live="assertive" aria-atomic="true"></span>
		</div>
		<div class="swiper-button-next swiper-button-next-elementor" tabindex="0" role="button" aria-label="Next slide" aria-disabled="false">
        	<svg xmlns="http://www.w3.org/2000/svg" version="1.1" xmlns:xlink="http://www.w3.org/1999/xlink" xmlns:svgjs="http://svgjs.com/svgjs" width="512" height="512" x="0" y="0" viewBox="0 0 128 128" style="enable-background:new 0 0 512 512" xml:space="preserve" class=""><g><path xmlns="http://www.w3.org/2000/svg" id="Down_Arrow_3_" d="m64 88c-1.023 0-2.047-.391-2.828-1.172l-40-40c-1.563-1.563-1.563-4.094 0-5.656s4.094-1.563 5.656 0l37.172 37.172 37.172-37.172c1.563-1.563 4.094-1.563 5.656 0s1.563 4.094 0 5.656l-40 40c-.781.781-1.805 1.172-2.828 1.172z" data-original="#000000" class=""></path></g></svg>
        </div>
        <div class="swiper-button-prev swiper-button-prev-elementor" tabindex="0" role="button" aria-label="Previous slide" aria-disabled="false">
        	<svg xmlns="http://www.w3.org/2000/svg" version="1.1" xmlns:xlink="http://www.w3.org/1999/xlink" xmlns:svgjs="http://svgjs.com/svgjs" width="512" height="512" x="0" y="0" viewBox="0 0 128 128" style="enable-background:new 0 0 512 512" xml:space="preserve" class=""><g><path xmlns="http://www.w3.org/2000/svg" id="Down_Arrow_3_" d="m64 88c-1.023 0-2.047-.391-2.828-1.172l-40-40c-1.563-1.563-1.563-4.094 0-5.656s4.094-1.563 5.656 0l37.172 37.172 37.172-37.172c1.563-1.563 4.094-1.563 5.656 0s1.563 4.094 0 5.656l-40 40c-.781.781-1.805 1.172-2.828 1.172z" data-original="#000000" class=""></path></g></svg>
        </div>
      </div>
</div>
<?php endif;
wp_reset_postdata();