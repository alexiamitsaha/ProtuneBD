<?php
/**
 * Awesomesauce class.
 *
 * @category   Class
 */

namespace ElementorMiraculous;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use \Elementor\Group_Control_Typography;

// Security Note: Blocks direct access to the plugin PHP files.
defined( 'ABSPATH' ) || die();

/**
 * Awesomesauce widget class.
 *
 * @since 1.0.0
 */
class Miraculous_productupload extends Widget_Base {

	/**
	 * Retrieve the widget name.
	 *
	 * @since 1.0.0
	 *
	 * @access public
	 *
	 * @return string Widget name.
	 */
	public function get_name() {
		return 'Product Upload';
	}

	/**
	 * Retrieve the widget title.
	 *
	 * @since 1.0.0
	 *
	 * @access public
	 *
	 * @return string Widget title.
	 */
	public function get_title() {
		return __( 'Product Upload', 'miraculous' );
	}

	/**
	 * Retrieve the widget icon.
	 *
	 * @since 1.0.0
	 *
	 * @access public
	 *
	 * @return string Widget icon.
	 */
	public function get_icon() {
		return 'eicon-parallax';
	}

	/**
	 * Retrieve the list of categories the widget belongs to.
	 *
	 * Used to determine where to display the widget in the editor.
	 *
	 * Note that currently Elementor supports only one category.
	 * When multiple categories passed, Elementor uses the first one.
	 *
	 * @since 1.0.0
	 *
	 * @access public
	 *
	 * @return array Widget categories.
	 */
	public function get_categories() {
		return array( 'miraculous-widget' );
	}
	
	/**
	 * Register the widget controls.
	 *
	 * Adds different input fields to allow the user to change and customize the widget settings.
	 *
	 * @since 1.0.0
	 *
	 * @access protected
	 */
	protected function register_controls() {
	    $options = array();
		$this->start_controls_section(
            'heading',
            [
                'label' => esc_html__( 'Product Upload', 'miraculous' ),
            ]
        );
        $this->add_control(
            'productupload_heading',
            [
                'label'       => esc_html__( 'Heading', 'miraculous' ),
                'type'        => Controls_Manager::TEXT,
                'label_block' => true,
                'default'     => esc_html__( '', 'miraculous' ),
            ]
        );
        $this->end_controls_section();
	}

	/**
	 * Render the widget output on the frontend.
	 *
	 * Written in PHP and used to generate the final HTML.
	 *
	 * @since 1.0.0
	 *
	 * @access protected
	 */
	protected function render() {
		$settings = $this->get_settings_for_display();
		
        $upload_heading_one = '';
        if(!empty($settings['productupload_heading'])):
          $upload_heading_one = $settings['productupload_heading'];
        endif;
        $miraculous_theme_data = '';
        if (function_exists('fw_get_db_settings_option')):  
            $miraculous_theme_data = fw_get_db_settings_option();     
        endif; 
        $pricing_plan = '';
        if(!empty($miraculous_theme_data['user_pricing_plan_page'])):
            $pricing_plan = get_the_permalink( $miraculous_theme_data['user_pricing_plan_page'] );
        endif;
        global $wpdb;
        $today = date('Y-m-d H:i:s');
        $user_id = get_current_user_id();
        $pmt_tbl = $wpdb->prefix . 'ms_payments'; 
        $query = $wpdb->get_row( "SELECT * FROM `$pmt_tbl` WHERE user_id = $user_id AND expiretime > '$today' AND remains_upload > 0" );
        if( $user_id && $query ){
            $upload_img = get_template_directory_uri().'/assets/images/svg/upload.svg';
        ?> 
        <div class="wrapper_upload_products" >
        <div class="ms_upload_wrapper mv_video_wrap">
           <form id="upload_products_forms" method="post" enctype="multipart/form-data">
                <div class="form-group">
                  <label for="productname"><?php echo esc_html__('Product Name','miraculous'); ?> </label>
                  <input type="text" id="productname" name="productname" placeholder="Enter Product Name" required>
                </div> 
                <div class="form-group">
                   <label for="productprice"><?php echo esc_html__('Product Regular Price','miraculous'); ?> </label>
                   <input type="text" id="productregularprice" name="productregularprice" placeholder="Enter Regular Price" required>
                </div> 
                <div class="form-group">
                  <label for="productprice"><?php echo esc_html__('Product Sale price','miraculous'); ?> </label>
                  <input type="text" id="productsaleprice" name="productsaleprice" placeholder="Enter Sale Price">
                </div> 
                <div class="form-group">
                    <label for="product_description"><?php echo esc_html__('Product Description','miraculous'); ?></label>
                    <textarea id="product_description" minlength="50" name="product_description" placeholder="Enter Product Description" required></textarea>
                </div> 
                <div class="form-group upload_filed"> 
                    <label for="product_image_upload"><?php echo esc_html__('Product Image Upload','miraculous'); ?></label>
                    <input type="text" name="image_file" id="product_image_file" class="form-control" readonly="true">
                    <input type="hidden" name="product_image_file_id" id="product_image_file_id" value="">
                    <a href="javascript:;" class="ms_btn product_image_upload"><?php echo esc_html__('Upload Image', 'miraculous'); ?></a>
                                    
                </div>
                <div class = "row">
                    <div class="col-lg-6">
                        <div class="form-group">  
                            <div class="ms_video_file">             
                                <label for="product_zip_upload"><?php echo esc_html__('Product Download Zip File Upload','miraculous'); ?></label>
                                <img src="<?php echo esc_url($upload_img); ?>" alt="<?php esc_attr_e('upload mp3 file','miraculous')?>" class="mp3_zip_upload">
                                <input type="hidden" name="product_mp3_file_id" id="product_mp3_file_id" value="">
                                <input type="hidden" name="product_zip_upload" id="product_zip_upload" value="">
                                <div id="ms_sam_audio_file"></div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="form-group"> 
                            <div class="ms_video_file">             
                                <label for="product_sample_upload"><?php echo esc_html__('Product Sample File Upload','miraculous'); ?></label>
                                <img src="<?php echo esc_url($upload_img); ?>" alt="<?php esc_attr_e('upload mp3','miraculous')?>" class="mp3_file_upload">
                                <input type="hidden" name="up_track_mp3_id" id="up_track_mp3_id" value="">
                                <input type="hidden" name="full_track_data" id="up_full_track_data" value="">
                                <div id="ms_audio_file"></div>
                            </div>
                        </div> 
                    </div>
                </div>
                <div class="mv_upload_btn">      
                    <?php wp_nonce_field( 'wps-frontend-post' ); ?>
                    <input type="submit" name="products_upload" id="products_upload" value="Upload">
                </div> 
            </form>
        </div>
        <?php
        if(isset($_POST['products_upload'])){
            
            if(!isset($_POST['productname']) ) {
                return;
            }
            // Check that the nonce was set and valid
            if( !wp_verify_nonce($_POST['_wpnonce'], 'wps-frontend-post') ) {
                echo '<div class="form_responce">Did not save because your form seemed to be invalid. Sorry</div>';
                return;
            }
           // Do some minor form validation to make sure there is content
            if (strlen($_POST['productname']) < 3) {
                echo '<div class="form_responce">Please enter a title. Titles must be at least three characters long.</div>';
                return;
            }
            if (strlen($_POST['product_description']) < 50) {
                echo '<div class="form_responce">Please enter content more than 50 characters in length</div>';
                return;
            }
            if($_POST['productregularprice'] < $_POST['productsaleprice']){
                
                echo '<div class="form_responce">Please check sale price</div>';
                return; 
            }
            
            $user_id = get_current_user_id();
            // Add the content of the form to $post as an array
            $post = array(
                'post_author' => $user_id,
                'post_title'  => $_POST['productname'],
                'post_content' => $_POST['product_description'],
                'post_status' => 'publish', 
                'post_type' => 'product',
                'comment_status' =>'closed',
                );
            $insert_id = wp_insert_post($post); 
            if($insert_id):
                $product = wc_get_product($insert_id);
                if(!empty($_POST['productregularprice'])):
                  $product->set_regular_price($_POST['productregularprice']);
                  $product->save();
                endif;
                
                if(!empty($_POST['productsaleprice'])):
                  $product->set_sale_price($_POST['productsaleprice']);
                  $product->save();
                endif;
                
                update_post_meta($insert_id, '_downloadable', 'yes');
                require_once( ABSPATH . 'wp-admin/includes/image.php' );
                require_once( ABSPATH . 'wp-admin/includes/file.php' );
                require_once( ABSPATH . 'wp-admin/includes/media.php' ); 
                
                $attachimage_id = $_POST['product_image_file_id']; 
                set_post_thumbnail( $insert_id, $attachimage_id);
                
                $attach_product_sam_id = $_POST['up_track_mp3_id'];
                $attachment_product_sample_url = wp_get_attachment_url($attach_product_sam_id);
                $new_full_track = array('attachment_id' => $attach_product_sam_id, 'url' => $attachment_product_sample_url);
                
                if(!empty($attachment_product_sample_url)):
                  update_post_meta($insert_id, 'fw_option:mp3_full_songs', $new_full_track);
                endif;
                
                $attach_zip_id = $_POST['product_mp3_file_id'];
                
                $attachment_zip_url = wp_get_attachment_url($attach_zip_id);
                $download_id = md5( $attachment_zip_url );
                $file_name = $_POST['productname'];
                
                // Creating an empty instance of a WC_Product_Download object
                $pd_object = new WC_Product_Download();
                
                // Set the data in the WC_Product_Download object
                $pd_object->set_id( $download_id );
                $pd_object->set_name( $file_name );
                $pd_object->set_file( $attachment_zip_url );
        
                $downdloadArray =array('name'=>$file_name, 'file' => $attachment_zip_url);
                $file_path =md5($attachment_zip_url);
                $_file_paths[  $file_path  ] = $downdloadArray;
                update_post_meta($insert_id, '_downloadable_files', $_file_paths);
                update_post_meta($insert_id, '_download_limit', '');
                update_post_meta($insert_id, '_download_expiry', '');
                 
                global $wpdb;
                $pmt_tbl = $wpdb->prefix . 'ms_payments'; 
                $query = $wpdb->get_row( "SELECT * FROM `$pmt_tbl` WHERE user_id = $user_id AND expiretime > '$today'" );
                if($query->remains_product_upload > 0){
                $wpdb->update( 
                    $pmt_tbl, 
                    array( 
                      'remains_product_upload' => $query->remains_product_upload-1
                      ), 
                    array( 'ID' => $query->id ), 
                        array( 
                            '%d'
                            ), 
                        array( '%d' ) 
                    );
            }
            ?>  
            <script>
            jQuery(document).ready(function($){
               "use strict";
                toastr.success('Uploaded Successfully');
                //window.location.replace('<?php echo esc_url(home_url('/products/')); ?>'); 
            }); 
            </script>
            <?php
            endif;
          }
        }else{
        ?>
        <div class="ms_upload_wrapper marger_top60">
            <div class="ms_upload_box">
                <h2><?php echo esc_html__('Need to purchase plan to upload music.', 'miraculous'); ?></h2>
                <a href="<?php echo esc_url($pricing_plan); ?>" class="ms_btn"><?php echo esc_html__('Click Here', 'miraculous'); ?></a>
            </div>
        </div> 
        <?php
        } ?>
        </div>
    <?php
	}
}