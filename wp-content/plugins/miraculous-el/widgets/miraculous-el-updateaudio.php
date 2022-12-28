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
class Miraculous_updateaudio extends Widget_Base {

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
		return 'Update Audio';
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
		return __( 'Update Audio', 'miraculous' );
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
                'label' => esc_html__( 'Update Audio', 'miraculous' ),
            ]
        );
        $this->add_control(
            'upload_heading_three',
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
        
        $user_id = get_current_user_id();
        if($user_id):    
        $upload_heading_three = '';
        if(!empty($settings['upload_heading_three'])):
          $upload_heading_three = $settings['upload_heading_three'];
        endif;
        $miraculous_theme_data = '';
        if (function_exists('fw_get_db_settings_option')):  
            $miraculous_theme_data = fw_get_db_settings_option();     
        endif; 
        $pricing_plan = '';
        if(!empty($miraculous_theme_data['user_pricing_plan_page'])):
            $pricing_plan = get_the_permalink( $miraculous_theme_data['user_pricing_plan_page'] );
        endif;
        
        $audio_id = '';   
        if(!empty($_GET['track_id'])):
          $audio_id = $_GET['track_id'];  
        endif;
        global $wpdb;
        $today = date('Y-m-d H:i:s');
        $user_id = get_current_user_id();
        $pmt_tbl = $wpdb->prefix . 'ms_payments'; 
        $query = $wpdb->get_row( "SELECT * FROM `$pmt_tbl` WHERE user_id = $user_id AND expiretime > '$today' AND remains_upload > 0" );
        $upload_img = get_template_directory_uri().'/assets/images/svg/upload.svg';
        $terms = get_terms( array(
                                'taxonomy' => 'language',
                                'hide_empty' => false
                            ) );
                            
        $music_type = get_terms( array(
                                'taxonomy' => 'music-type',
                                'hide_empty' => false
                            ) );        
        $image_url = wp_get_attachment_image_url(get_post_thumbnail_id($audio_id), 'full');
        ?>
        
        
        <div class="ms_upload_wrapper">
            <form id="upload_music_formn" method="post" enctype="multipart/form-data">
                <div class="ms_upload_box">
                    <div class="ms_heading">
                        <h1><?php echo esc_html($upload_heading_three); ?></h1>
                    </div>
                    <div class="ms_pro_form">
                        <div class="form-group">
                            <label><?php echo esc_html('Audio Cover Image', 'miraculous'); ?></label>
                            <input type="file" name="bw_audio_cover_images" value="<?php echo esc_url($image_url); ?>"  id="bw_audio_cover_images" class="form-control" accept="image/*" required>
                            <?php wp_nonce_field( 'bw_audio_cover_images', 'bw_audio_cover_images_nonce' ); ?>
                            <label><?php 
                            if(!empty($image_url)):
                                echo esc_html__('currently, it stores :'); echo esc_url($image_url); 
                            endif;
                            ?></label>
                        </div> 
                        <div class="form-group">
                         <label><?php echo esc_html__('Audio Upload*', 'miraculous'); ?></label>
                         <input type="file" name="bw_audio_file_upload" id="bw_audio_file_upload" class="form-control" accept="audio/*" required>
                         <?php wp_nonce_field('bw_audio_file_upload', 'bw_audio_file_upload_nonce' ); ?>
                         <?php $music_url = get_post_meta($audio_id, 'fw_option:mp3_full_songs',true); 
                         ?>
                         <label><?php 
                         if(!empty($music_url['url'])):
                            echo esc_html__('currently, it stores :'); echo esc_url($music_url['url']); 
                            endif;
                            ?></label>
                       </div>
                        <div class="form-group">
                            <label><?php echo esc_html__('Audio Name *', 'miraculous'); ?></label>
                            <input type="text" name="aduio_name" id="aduio_name" placeholder="<?php esc_attr_e('Dream Your Moments','miraculous'); ?>" value="<?php echo get_the_title($audio_id); ?>" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <?php 
                            $music_artists = get_post_meta($audio_id, 'fw_option:music_artists',true);
                            if(!empty($music_artists)):
                            foreach ($music_artists as $artists_id) {
                                $artists_name[] = get_the_title($artists_id);
                            }
                            endif;
                            ?>
                            <label><?php echo esc_html__('Artist’s Name', 'miraculous'); ?></label>
                            <input type="text" name="track_artist" id="track_artist" placeholder="<?php esc_attr_e('Enter Artist’s Name','miraculous'); ?>" value="<?php echo implode(', ', $artists_name); ?>" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <?php
                            if(!empty($audio_id)){
                                $lang = get_post_meta($audio_id); 
                                $term_obj_list = get_the_terms( $audio_id, 'language' );
                                $term_obj = $term_obj_list['0'];
                            }    
                                ?>
                            <label><?php echo esc_html__('Select Language', 'miraculous'); ?></label>
                            <select name="language" id="language" class="form-control" required>
                                <option value="<?php echo $term_obj->name; ?>"><?php echo esc_html('Select Language','miraculous'); ?></option>
                                <?php if($terms):
                                    foreach($terms as $term): 
                                        if($term_obj->name == $term->name){  
                                        ?>
                                        <option value="<?php esc_attr_e($term->slug); ?>" selected><?php echo esc_html($term->name); ?></option>
                                        <?php
                                        }
                                        else{
                                        ?>
                                        <option value="<?php esc_attr_e($term->slug); ?>"><?php echo esc_html($term->name); ?></option>
                                        <?php    
                                        }
                                    endforeach;
                                    endif; ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label><?php echo esc_html('Select Music Type', 'miraculous'); ?></label>
                            <select name="audio_type" id="audio_type" class="form-control" required>
                                <?php if($music_type):
                                    foreach($music_type as $term): ?>
                                        <option value="<?php esc_attr_e($term->slug); ?>"><?php echo esc_html($term->name); ?></option>
                                <?php endforeach;
                                endif; ?>
                            </select>
                        </div>
                        <div class="pro-form-btn text-center marger_top15">
                            <div class="ms_upload_btn">
                                 <?php wp_nonce_field( 'wps-frontend-post' ); ?>
                                 <input type="hidden" id="audios_id" name="audios_id" value="<?php echo esc_attr($audio_id); ?>">  
                                <input type="submit" name="submit_audio_forms" id="submit_audio_forms" class="ms_btn" value="Update Now">
                                <button class="hst_loader"><i class="fa fa-circle-o-notch fa-spin"></i> <?php echo esc_html__('Loading', 'miraculous'); ?></button>
                                <input type="reset" name="reset_form" class="ms_btn" value="<?php esc_attr_e('reset','miraculous'); ?>">
                            </div>
                        </div>
                    </div>
                </div>
            </form>   
        </div>
        <?php
        if(isset($_POST['submit_audio_forms'])){
            
            if(!isset($_POST['aduio_name']) ) {
                return;
            }
            // Check that the nonce was set and valid
            if( !wp_verify_nonce($_POST['_wpnonce'], 'wps-frontend-post') ) {
                echo 'Did not save because your form seemed to be invalid. Sorry';
                return;
            }
           
            $user_id = get_current_user_id();
            // Add the content of the form to $post as an array
            $post = array(
                'ID'  => $_POST['audios_id'],
                'post_author' => $user_id,
                'post_title'  => $_POST['aduio_name'],
                'post_status' => 'publish',   // Could be: publish
                'post_type' => 'ms-music', // Could be: `page` or your CPT
                );
            $insert_id = wp_update_post($post); 
            if($insert_id):
                if(!empty($_POST['language'])):
                  wp_set_object_terms($insert_id, $_POST['language'], 'language');
                endif;
                if(!empty($_POST['audio_type'])):
                  wp_set_object_terms($insert_id, $_POST['audio_type'], 'music-type');
                endif;
              
                if(!empty($_POST['track_artist'])):
                update_post_meta($insert_id, 'fw_option:user_music_artist', $_POST['track_artist']);
                endif;
                require_once( ABSPATH . 'wp-admin/includes/image.php' );
                require_once( ABSPATH . 'wp-admin/includes/file.php' );
                require_once( ABSPATH . 'wp-admin/includes/media.php' ); 
                
                if(isset($_POST['bw_audio_cover_images'])):
                  $attach_cover_id = media_handle_upload('bw_audio_cover_images', $insert_id);
                  set_post_thumbnail( $insert_id, $attach_cover_id );
                endif;
                if(isset($_POST['bw_audio_file_upload'])):
                    $attach_video_id = media_handle_upload('bw_audio_file_upload', $insert_id); 
                    $attachmentbg_url = wp_get_attachment_url($attach_video_id);
                    if(!empty($attachmentbg_url)):
                    update_post_meta($insert_id, 'fw_option:mp3_full_songs', $attachmentbg_url);
                    endif;
                endif; 
            ?> 
            <script>
            jQuery(document).ready(function($){
               "use strict";
                toastr.success('Save success full');
               window.location.replace('<?php echo esc_url(home_url('/overview/')); ?>');
            });  
            </script>
            <?php
            endif;
        }
        endif;
	}
}
