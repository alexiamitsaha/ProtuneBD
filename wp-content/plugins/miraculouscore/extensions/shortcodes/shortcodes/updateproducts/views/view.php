<?php if (!defined('FW')) die('Forbidden');
$upload_heading_one = '';
if(!empty($atts['upload_heading_one'])):
  $upload_heading_one = $atts['upload_heading_one'];
endif;
$user_id = get_current_user_id();
if($user_id):    
$products_id = 2618;
$audio_id = '';   
if(!empty($_GET['products_id'])):
  $products_id = $_GET['products_id'];  
endif;
$product = wc_get_product($products_id);
$product_descreption = get_post($products_id); 
$image_url = wp_get_attachment_image_url(get_post_thumbnail_id($products_id), 'full');
?> 
<div class="ms_upload_wrapper mv_video_wrap">
   <form id="upload_products_forms" method="post" enctype="multipart/form-data">
        <div class="form-group">
          <label for="productname"><?php echo esc_html__('Product Name','miraculous'); ?> </label>
          <input type="text" id="productname" name="productname" placeholder="Enter Product Name" value="<?php echo get_the_title($products_id); ?>">
        </div> 
        <div class="form-group">
           <label for="productprice"><?php echo esc_html__('Product Regular Price','miraculous'); ?> </label>
           <input type="text" id="productregularprice" name="productregularprice" placeholder="Enter Regular Price" value="<?php echo $product->get_regular_price(); ?>">
        </div> 
        <div class="form-group">
          <label for="productprice"><?php echo esc_html__('Product Sale price','miraculous'); ?> </label>
          <input type="text" id="productsaleprice" name="productsaleprice" placeholder="Enter Sale Price" value="<?php echo $product->get_sale_price(); ?>">
        </div>  
        <div class="form-group">
            <label for="product_description"><?php echo esc_html__('Product Description','miraculous'); ?></label>
            <textarea id="product_description" name="product_description" placeholder="Enter Product Description" ><?php echo $product_descreption->post_content; ?></textarea>
        </div> 
        <div class="form-group">
            <label><?php esc_html_e('Product Image Upload','miraculous'); ?></label>
            <input type="text" name="up_image_file" id="up_image_file" class="form-control" value="<?php echo esc_url($image_url); ?>" readonly="true">
            <input type="hidden" name="up_image_file_id" id="up_image_file_id" value="">
            <a href="javascript:;" class="ms_btn up_image_upload">
            <?php esc_html_e('Upload Image','miraculous'); ?></a>
        </div>
        <div class="form-group"> 
            <div class="ms_video_file">             
                <label><?php esc_html_e('Product Download Zip File Upload','miraculous'); ?></label>
                <input type="text" name="product_zip_upload" id="product_zip_upload" class="form-control" value="" readonly="true">
                <input type="hidden" name="product_zip_upload_id" id="product_zip_upload_id" value="">
                <a href="javascript:;" class="ms_btn product_update">
                <?php esc_html_e('Upload','miraculous'); ?></a>
            </div>
        </div>
        <div class="form-group"> 
            <div class="ms_video_file">             
                <label><?php esc_html_e('Product Sample File Upload','miraculous'); ?></label>
                <input type="text" name="product_sample_upload" id="product_sample_uploadd" class="form-control" value="" readonly="true">
                <input type="hidden" name="product_sample_upload_id" id="product_sample_upload_id" value="">
                <a href="javascript:;" class="ms_btn product_update_sample">
                <?php esc_html_e('Upload','miraculous'); ?></a>
            </div>
        </div>
        <div class="mv_upload_btn">   
            <input type="hidden" id="products_id" name="products_id" value="<?php echo esc_attr($products_id); ?>">   
            <?php wp_nonce_field( 'wps-frontend-post' ); ?>
            <input type="submit" name="products_update" id="products_update" value="Update">
        </div> 
    </form>
</div> 
<?php
if(isset($_POST['products_update'])){
    
    if(!isset($_POST['productname']) ) {
        return;
    }
    // Check that the nonce was set and valid
    if( !wp_verify_nonce($_POST['_wpnonce'], 'wps-frontend-post') ) {
        echo 'Did not save because your form seemed to be invalid. Sorry';
        return;
    }
   // Do some minor form validation to make sure there is content
    if (strlen($_POST['productname']) < 3) {
        echo 'Please enter a title. Titles must be at least three characters long.';
        return;
    }
    if (strlen($_POST['product_description']) < 50) {
        echo 'Please enter content more than 50 characters in length';
        return;
    }
    if($_POST['productregularprice'] < $_POST['productsaleprice']){
        
        echo 'Please check sale price';
        return; 
    }
    
    $user_id = get_current_user_id();
    // Add the content of the form to $post as an array
    $post = array(
        'ID'  => $_POST['products_id'],
        'post_author' => $user_id,
        'post_title'  => $_POST['productname'],
        'post_content' => $_POST['product_description'],
        'post_status' => 'publish',   // Could be: publish
        'post_type' => 'product', // Could be: `page` or your CPT
        'comment_status' =>'closed',
        );
    $insert_id = wp_update_post($post); 
    if($insert_id):
        require_once( ABSPATH . 'wp-admin/includes/image.php' );
        require_once( ABSPATH . 'wp-admin/includes/file.php' );
        require_once( ABSPATH . 'wp-admin/includes/media.php' ); 
        
        $product = wc_get_product($insert_id);
        if(!empty($_POST['productregularprice'])):
         //update_post_meta($insert_id,'_regular_price',sanitize_text_field($_POST['productregularprice']));
          $product->set_regular_price($_POST['productregularprice']);
          $product->save();
        endif;
        if(!empty($_POST['productsaleprice'])):
            
          //update_post_meta($insert_id,'_sale_price',sanitize_text_field( $_POST['productsaleprice']));
          $product->set_sale_price($_POST['productsaleprice']);
          $product->save();
        endif;
        
        if(!empty($_POST['up_image_file'])){
            set_post_thumbnail( $insert_id, $_POST['up_image_file_id'] );
		}
        if(isset($_POST['product_sample_upload_id'])):
            //$attach_product_sample_id = media_handle_upload('product_sample_upload_id', $insert_id); 
            $attachment_product_sample_url = wp_get_attachment_url($_POST['product_sample_upload_id']);
            if(!empty($attachment_product_sample_url)):
            update_post_meta($insert_id, 'fw_option:mp3_full_songs', $attachment_product_sample_url);
            endif;
        endif;
        
        if(isset($_POST['product_zip_upload_id'])):
            //$attach_zip_id = media_handle_upload('product_zip_upload', $insert_id);  
            $attachment_zip_url = wp_get_attachment_url($_POST['product_zip_upload_id']);
            $download_id = md5( $attachment_zip_url );
            $file_name = $_POST['productname'];
            
            $download  = new WC_Product_Download(); // Get an instance of the WC_Product_Download Object

            // Set the download data
            $download->set_name($file_name);
            $download->set_id($download_id);
            $download->set_file($attachment_zip_url);
            $downloads[$md5_num] = $download; // Insert the new download to the array of downloads
            $product->set_downloads($downloads); // Set new array of downloads
        endif;
        
    ?>  
    <script>
    jQuery(document).ready(function($){
       "use strict";
        toastr.success('upload success full');
        window.location.replace('<?php echo esc_url(home_url('/products/')); ?>'); 
    }); 
    </script>
    <?php
    endif;
}
endif;