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
class Miraculous_bulkupload extends Widget_Base {

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
		return 'Bulk Upload';
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
		return __( 'Bulk Upload', 'miraculous' );
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
                'label' => esc_html__( 'Bulk Upload', 'miraculous' ),
            ]
        );
        $this->add_control(
            'bulk_upload_label',
            [
                'label'       => esc_html__( 'Heading', 'miraculous' ),
                'type'        => Controls_Manager::TEXT,
                'label_block' => true,
                'default'     => esc_html__( '', 'miraculous' ),
            ]
        );
        $this->add_control(
            'bulk_upload_hint',
            [
                'label'       => esc_html__( 'Bulk Upload Hint', 'miraculous' ),
                'type'        => Controls_Manager::TEXT,
                'label_block' => true,
                'default'     => esc_html__( '', 'miraculous' ),
            ]
        );
        $this->add_control(
            'bulk_upload_button',
            [
                'label'       => esc_html__( 'Bulk Upload Button', 'miraculous' ),
                'type'        => Controls_Manager::TEXT,
                'label_block' => true,
                'default'     => esc_html__( '', 'miraculous' ),
            ]
        );
        $this->add_control(
            'bulk_upload_succes',
            [
                'label'       => esc_html__( 'Bulk Upload Success', 'miraculous' ),
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
		
        $bulk_upload_label = '';
        if(!empty($settings['bulk_upload_label'])):
          $bulk_upload_label = $settings['bulk_upload_label'];
        endif;
        
        $bulk_upload_hint = '';
        if(!empty($settings['bulk_upload_hint'])):
          $bulk_upload_hint = $settings['bulk_upload_hint'];
        endif;
        
        $bulk_upload_button = '';
        if(!empty($settings['bulk_upload_button'])):
          $bulk_upload_button = $settings['bulk_upload_button'];
        endif;
        
        $bulk_upload_succes = '';
        if(!empty($settings['bulk_upload_succes'])):
          $bulk_upload_succes = $settings['bulk_upload_succes'];
        endif; 
        
        global $wpdb;
        $today = date('Y-m-d H:i:s');
        $user_id = get_current_user_id();
        $pmt_tbl = $wpdb->prefix . 'ms_payments'; 
        $query = $wpdb->get_row( "SELECT * FROM `$pmt_tbl` WHERE user_id = $user_id AND expiretime > '$today' AND remains_upload > 0" ); 
        if(wp_get_current_user()){
            $price_plane_switch = 'on';
            if($price_plane_switch == 'on'){
               $priceplanevalue = $user_id && $query;
            } else{
               $priceplanevalue = $user_id;
            } 
            
            if($priceplanevalue){
                $userid= get_current_user_id();  
                $uploads = wp_upload_dir( null, false );?>
                <div class="ms_heading">
                    <h1><?php echo esc_html($bulk_upload_label); ?></h1>
                </div>
                <div class="ms_upload_wrapper mv_video_wrap music-dashboard-wrapper">
        	    <form method="POST" action="" enctype="multipart/form-data" class="ms_form_excel">
        	        <div class="ms_pro_form_excel">
        		        <div class="form-group">
        			        <label><?php echo esc_html($bulk_upload_hint); ?></label>
        			        <input type="file" name="uploadFile" class="form-control" />
        			        <label><?php echo esc_html__('Please Check Demo File Here :','miraculous'); ?><a href="<?php echo esc_url(plugin_dir_url( __FILE__ ).'/Book1.xlsx'); ?>" target="_blank"><b><?php echo esc_html__('Sheet','miraculous'); ?></b></a></label>
        		        </div>
        		        <div class="ms_upload_btn">
        			        <button type="submit" name="submit" class="ms_btn"><?php echo esc_html($bulk_upload_button); ?></button>
        		        </div>
        		    </div>
        	    </form>
            </div>
            <?php 
            if(isset($_POST['submit'])) {
                ini_set('error_reporting', E_ALL);
            ini_set('display_errors', true);
            
            require_once __DIR__.'/SimpleXLSX.php';
            $file = $_FILES['uploadFile']['tmp_name'];
            $i = 1;
            if ( $xlsx = SimpleXLSX::parse($file) ) {
            	foreach($xlsx->rows() as $row){
            	    $name = $artists = $artist = $genres_arr = $languages_arr = $genres = $languages = '';
            	    if($i == 1):
            	    else:
            	       $name = $row[0];
            	       $content = $row[1];
            	       $mp_song = $row[2];
            	       $artist = $row[3];
            	       $music = $row[4];
            	       $price = $row[5];
            	       $release = $row[6];
            	       $genres = $row[7];
            	       $languages = $row[8];
            	       $image = $row[9];
            	       $trackcat = $row[10];
            	   endif;
            	   
                	$m_args = array(
                	       'post_type' => 'ms-music',
                	       'post_title' =>$name,
                	       'post_content' => $content,
                	       'post_status' => 'publish',
                	       'post_author' => $userid,
                	  );
                	 $artists = explode(" ",$artist);
                	 $genres_arr = explode(" ",$genres);
                	 $languages_arr = explode(" ",$languages);
                	 $post_id = wp_insert_post($m_args);
                	    if($post_id){
                		    add_post_meta($post_id, 'fw_option:music_extranal_url', $mp_song);
                			add_post_meta($post_id, 'fw_option:music_artists', $artists);
                	        add_post_meta($post_id, 'fw_option:music_types', $music);
                			add_post_meta($post_id, 'fw_option:single_music_prices', $price);
                		    add_post_meta($post_id, 'fw_option:music_release_date', $release); 
                			wp_set_post_terms( $post_id, $genres_arr , 'genre' );
                	        wp_set_post_terms( $post_id, $languages_arr, 'language' );
                			if($image){
                			    $upload_dir = wp_upload_dir();
                                $streamContext = stream_context_create([
                                    'ssl' => [
                                        'verify_peer'      => false,
                                        'verify_peer_name' => false
                                    ]
                                ]);
                                $image_data = file_get_contents($image, false, $streamContext);
                                //$image_data = file_get_contents($image);
                                $filename = basename($image);
                                if (wp_mkdir_p($upload_dir['path']))
                                    $file = $upload_dir['path'] . '/' . $post_id . '_' . $filename;
                                else
                                    $file = $upload_dir['basedir'] . '/' . $post_id . '_' . $filename;
                                file_put_contents($file, $image_data);
                                $wp_filetype = wp_check_filetype($filename, null);
                                $attachment = array(
                                    'post_mime_type' => $wp_filetype['type'],
                                    'post_title' => sanitize_file_name($filename),
                                    'post_content' => '',
                                    'post_status' => 'inherit'
                                );
                                $attach_id = wp_insert_attachment($attachment, $file, $post_id);
                                require_once(ABSPATH . 'wp-admin/includes/image.php');
                                $attach_data = wp_generate_attachment_metadata($attach_id, $file);
                                $res1 = wp_update_attachment_metadata($attach_id, $attach_data);
                                $res2 = set_post_thumbnail($post_id, $attach_id);
                			}
                	        wp_set_post_terms( $post_id, array($trackcat), 'music-type' );
                        } else {
                	        echo SimpleXLSX::parseError();
                        }
                        $i++;
                	}
                	?> <h1 style="text-align: center;margin-top: 27px;font-size: 20px;"><?php echo esc_html($bulk_upload_succes); ?></h1>
                <?php
                }
            }
            } else {?>
                <div class="ms_upload_wrapper marger_top60">
                <div class="ms_upload_box">
                    <h2><?php echo esc_html__('Need to purchase plan to upload music.', 'miraculous'); ?></h2>
                    <a href="<?php echo esc_url($pricing_plan); ?>" class="ms_btn"><?php echo esc_html__('Click Here', 'miraculous'); ?></a>
                </div>
            </div> 
        <?php
            }
        } else { 
        ?>
        <div class="ms_upload_wrapper marger_top60">
            <div class="ms_upload_box">
                <h2><?php echo esc_html__('You have not permission to access this page.', 'miraculous'); ?></h2>
                <a href="<?php echo esc_url(home_url('/')); ?>" class="ms_btn"><?php echo esc_html__('Go Back', 'miraculous'); ?></a>
            </div>
        </div> 
        <?php }
	}
}
