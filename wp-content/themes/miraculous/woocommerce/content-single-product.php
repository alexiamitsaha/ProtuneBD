<?php
/**
 * The template for displaying product content in the single-product.php template
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/content-single-product.php.
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

/**
 * Hook: woocommerce_before_single_product.
 *
 * @hooked woocommerce_output_all_notices - 10
 */
do_action( 'woocommerce_before_single_product' );

if ( post_password_required() ) {
	echo get_the_password_form(); // WPCS: XSS ok.
	return;
}
?>
<div id="product-<?php the_ID(); ?>" <?php wc_product_class( '', $product ); ?>>
    <div class="ms_single_product_image">
	<?php
	/**
	 * Hook: woocommerce_before_single_product_summary.
	 *
	 * @hooked woocommerce_show_product_sale_flash - 10
	 * @hooked woocommerce_show_product_images - 20
	 */
	do_action( 'woocommerce_before_single_product_summary' );
	?>
    </div>
	<div class="summary entry-summary">
		<?php
			/**
		 * Hook: woocommerce_single_product_summary.
		 *
		 * @hooked woocommerce_template_single_title - 5
		 * @hooked woocommerce_template_single_rating - 10
		 * @hooked woocommerce_template_single_price - 10
		 * @hooked woocommerce_template_single_excerpt - 20
		 * @hooked woocommerce_template_single_add_to_cart - 30
		 * @hooked woocommerce_template_single_meta - 40
		 * @hooked woocommerce_template_single_sharing - 50
		 * @hooked WC_Structured_Data::generate_product_data() - 60
		 */
		do_action( 'woocommerce_single_product_summary' );
		$ms_music_post_meta_option = '';
	    if(function_exists('fw_get_db_post_option')): 
			$ms_music_post_meta_option = fw_get_db_post_option(get_the_id());   
	    endif;	
	    $play_all = get_template_directory_uri().'/assets/images/svg/play_all.svg';
	    $pause_all = get_template_directory_uri().'/assets/images/svg/pause_all.svg';
	    $add_to_queue = get_template_directory_uri().'/assets/images/svg/add_q.svg';
	    $more_img = get_template_directory_uri().'/assets/images/svg/more.svg';
	    $list_type = 'music';
	    $woco_mp2_switch = '';
	    if(!empty($ms_music_post_meta_option['woco_mp2_switch'])):
	        $woco_mp2_switch = $ms_music_post_meta_option['woco_mp2_switch'];
	    endif;
	    if($woco_mp2_switch == 'on'):
		?>
		<div class="album_btn">
            <a href="javascript:;" class="ms_btn play_btn play_music" data-musicid="<?php esc_html_e(get_the_id()); ?>" data-musictype="<?php printf($list_type); ?>">
			<span class="play_all">
			  <img src="<?php echo esc_url($play_all); ?>" alt="<?php  esc_attr_e('Play', 'miraculous'); ?>">
			  <?php  esc_html_e('Play', 'miraculous'); ?>
			</span>
			<span class="pause_all">
			  <img src="<?php echo esc_url($pause_all); ?>" alt="<?php esc_attr_e('Pause', 'miraculous'); ?>"><?php esc_html_e('Pause', 'miraculous'); ?>
			</span>
			</a>
            <a href="javascript:;" class="ms_btn add_to_queue" data-musicid="<?php esc_html_e(get_the_id()); ?>" data-musictype="<?php printf($list_type); ?>">
			<span class="play_all">
			  <img src="<?php echo esc_url($add_to_queue); ?>" alt="<?php echo esc_attr('Add To Queue', 'miraculous'); ?>">
			  <?php esc_html_e('Add To Queue', 'miraculous'); ?>
			</span>
			</a>
        </div>
	</div>
    <div class="album_more_optn ms_more_icon">
        <span>
		  <img src="<?php echo esc_url($more_img); ?>" alt="<?php esc_attr_e('More', 'miraculous'); ?>">
		</span>
    </div> 
    <?php
    $fav_class = 'icon_fav';
      if(function_exists('miraculous_get_favourite_div_class')){
        $fav_class = miraculous_get_favourite_div_class(get_the_id(), $list_type);
      }
    ?>
    <ul class="more_option">
        <li>
    	<a href="javascript:;" class="favourite_music" data-musicid="<?php echo esc_attr(get_the_id()); ?>">
    		<span class="opt_icon"><span class="icon <?php echo esc_attr($fav_class); ?>"></span>
    		</span><?php esc_html_e('Favourites', 'miraculous'); ?>
    		</a>
    	</li>
        <li>
		  <a href="javascript:;" class="add_to_queue" data-musicid="<?php esc_html_e(get_the_id()); ?>" data-musictype="<?php printf($list_type); ?>">
			<span class="opt_icon"><span class="icon icon_queue"></span>
			 </span><?php  esc_html_e('Add To Queue', 'miraculous'); ?>
			</a>
		</li>
        <li>
		  <a href="javascript:;" class="ms_download" data-msmusic="<?php echo esc_attr(get_the_id()); ?>"><span class="opt_icon"><span class="icon icon_dwn"></span></span>
		    <?php esc_html_e('Download Now', 'miraculous'); ?>
		  </a>
		</li>
        <li>
		   <a href="javascript:;" class="ms_add_playlist" data-msmusic="<?php echo esc_attr(get_the_id()); ?>"><span class="opt_icon">
			<span class="icon icon_playlst"></span></span>
			<?php esc_html_e('Add To Playlist', 'miraculous'); ?></a>
		</li>
        <li>
		  <a href="javascript:;" class="ms_share_music" data-shareuri="<?php esc_attr_e(get_the_permalink()); ?>" data-sharename="<?php the_title_attribute(); ?>">
			   <span class="opt_icon"><span class="icon icon_share"></span></span>
			   <?php  esc_html_e('Share', 'miraculous'); ?>
		   </a>
		</li>
     </ul>
	<?php
	endif;
	/**
	 * Hook: woocommerce_after_single_product_summary.
	 *
	 * @hooked woocommerce_output_product_data_tabs - 10
	 * @hooked woocommerce_upsell_display - 15
	 * @hooked woocommerce_output_related_products - 20
	 */
	do_action( 'woocommerce_after_single_product_summary' );
	?>
</div>

<?php do_action( 'woocommerce_after_single_product' ); ?>
