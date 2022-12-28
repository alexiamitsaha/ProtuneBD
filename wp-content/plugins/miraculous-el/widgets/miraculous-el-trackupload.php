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
class Miraculous_trackupload extends Widget_Base {

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
		return 'Track Upload With Price';
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
		return __( 'Track Upload With Price', 'miraculous' );
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
                'label' => esc_html__( 'Track Upload With Price', 'miraculous' ),
            ]
        );
        $this->add_control(
            'trackupload_heading_one',
            [
                'label'       => esc_html__( 'Heading One', 'miraculous' ),
                'type'        => Controls_Manager::TEXT,
                'label_block' => true,
                'default'     => esc_html__( '', 'miraculous' ),
            ]
        );
        $this->add_control(
            'trackupload_heading_two',
            [
                'label'       => esc_html__( 'Heading Two', 'miraculous' ),
                'type'        => Controls_Manager::TEXT,
                'label_block' => true,
                'default'     => esc_html__( '', 'miraculous' ),
            ]
        );
        $this->add_control(
            'trackupload_heading_three',
            [
                'label'       => esc_html__( 'Heading Three', 'miraculous' ),
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
        
        $miraculous_theme_data = '';
        if (function_exists('fw_get_db_settings_option')):  
            $miraculous_theme_data = fw_get_db_settings_option();     
        endif; 
        $price_plane_switch = '';
        if(!empty($miraculous_theme_data['pricingplan_switch'])):
          $price_plane_switch = $miraculous_theme_data['pricingplan_switch'];
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
        if(wp_get_current_user()):
            $price_plane_switch = 'on';
            if($price_plane_switch == 'on'):
               $priceplanevalue = $user_id && $query;
            else:
               $priceplanevalue = $user_id;
            endif; 
            if($priceplanevalue): 
            $upload_img = get_template_directory_uri().'/assets/images/svg/upload.svg';
            
            $terms = get_terms( array(
                                'taxonomy' => 'language',
                                'hide_empty' => false
                            ) );
            
            $genre = get_terms( array(
                                'taxonomy' => 'genre',
                                'hide_empty' => false
                            ) );
                            
            $ar_args = array('post_type' => 'ms-artists',
                            'author' => $user_id,
                            'numberposts' => -1,
                        );
            ?>
            <div class="ms_upload_wrapper">
                <?php
                if( isset($_POST['submit_artists_form']) && isset($_POST['new_artist_name']) && isset($_POST['new_artist_image_id']) && isset($_POST['new_artist_image']) ):
            
                    $new_args = array(
                        'post_type' => 'ms-artists',
                        'post_title' => $_POST['new_artist_name'],
                        'post_author' => $user_id,
                        'post_status' => 'publish'
                    );
            
                        $artist_id =  wp_insert_post($new_args);
                        if($artist_id):
                            set_post_thumbnail( $artist_id, $_POST['new_artist_image_id'] );
                        endif;
                        
                endif;
                $artists_names = get_posts($ar_args);
                if( isset($_GET['do']) && $_GET['do'] == 'upload_music' && $artists_names): 
                ?>
                <form id="upload_music_form" method="post" enctype="multipart/form-data">
                    
                    <div class="ms_upload_box"> 
                        <h2><?php echo esc_html($settings['trackupload_heading_two']); ?></h2>
                        <img src="<?php echo esc_url($upload_img); ?>" alt="<?php esc_attr_e('upload mp3','miraculous')?>" class="mp3_file_upload">
                        <input type="hidden" name="track_mp3" id="up_track_mp3" value="">
                        <input type="hidden" name="track_mp3_id" id="up_track_mp3_id" value="">
                        <input type="hidden" name="full_track_data" id="up_full_track_data" value="">
                        <div id="ms_audio_file"></div>
                        <p>or</p>
                        <div class="row justify-content-center ml-0 mr-0">
                            <div class="col-lg-6 col-md-6 col-sm-8 col-12 marger_top20">
                            <div class="form-group">
                                <input class="form-control" type="text" name="ex_track_mp3" id="ex_track_mp3" value="" placeholder = "<?php esc_attr_e('Enter External Song Url','miraculous'); ?>" > 
                            </div>
                            </div>
                        </div>
                    </div>
                    <div class="marger_top60">
                        <div class="ms_upload_box">
                            <div class="ms_heading">
                                <h1><?php echo esc_html($settings['trackupload_heading_three']); ?></h1>
                            </div>
                            <div class="ms_pro_form">
                                <div class="form-group">
                                    <label><?php echo esc_html__('Track Name *', 'miraculous'); ?></label>
                                    <input type="text" name="track_name" id="up_track_name" placeholder="<?php esc_attr_e('Dream Your Moments','miraculous'); ?>" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label><?php echo esc_html__('Artist’s Name *', 'miraculous'); ?></label>
                                    <select name="artists_name" id="up_artists_name" class="form-control">
                                        <?php if($artists_names):
                                            foreach($artists_names as $artists_name): ?>
                                                <option value="<?php esc_attr_e($artists_name->ID); ?>"><?php echo esc_html($artists_name->post_title); ?></option>
                                            <?php endforeach;
                                            endif; ?>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label><?php echo esc_html__('Select Language', 'miraculous'); ?></label>
                                    <select name="language_id" id="up_language_id" class="form-control">
                                        <option value=""><?php echo esc_html('Select Language','miraculous'); ?></option>
                                        <?php if($terms):
                                            foreach($terms as $term): ?>
                                                <option value="<?php esc_attr_e($term->term_id); ?>"><?php echo esc_html($term->name); ?></option>
                                            <?php endforeach;
                                            endif; ?>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label><?php echo esc_html__('Select Genres', 'miraculous'); ?></label>
                                    <select name="up_genres_id" id="up_genres_id" class="form-control">
                                        <option value=""><?php echo esc_html('Select Genres','miraculous'); ?></option>
                                        <?php if($genre):
                                            foreach($genre as $genres): ?>
                                                <option value="<?php esc_attr_e($genres->term_id); ?>"><?php echo esc_html($genres->name); ?></option>
                                            <?php endforeach;
                                            endif; ?>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label><?php echo esc_html('Track Type', 'miraculous'); ?></label>
                                    <select name="track_types" id="track_types" class="form-control">
                                        <option value="free"><?php echo esc_html__('Free', 'miraculous'); ?></option>
                                        <option value="premium"><?php echo esc_html__('Premium', 'miraculous'); ?></option>
                                    </select> 
                                </div> 
                                <div class="form-group" id="track_price_hideshow" style="display: none;">
                                    <label>
                                    <?php echo esc_html('Track Price', 'miraculous'); ?></label>
                                    <input type="text" name="track_price" id="track_price" placeholder="<?php esc_attr_e('Track Price','miraculous'); ?>" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label>
                                    <?php echo esc_html('Release Date', 'miraculous'); ?></label>
                                    <input type="text" name="release_date" id="release_date" placeholder="<?php esc_attr_e('Release Date Ex. DD-MM-YYYY','miraculous'); ?>" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label><?php echo esc_html__('Description *', 'miraculous'); ?></label>
                                    <textarea id="up_track_desc" name="track_desc" rows="4" cols="50" class="form-control" placeholder="<?php esc_attr_e('Description','miraculous'); ?>"></textarea>
                                </div>
                                <div class="form-group track-uploads">
                                    <label><?php echo esc_html('Track Image', 'miraculous'); ?></label>
                                    <input type="text" name="image_file" id="up_image_file" class="form-control" readonly="true">
                                    <input type="hidden" name="image_file_id" id="up_image_file_id" value="">
                                    <a href="javascript:;" class="ms_btn up_image_upload"><?php echo esc_html__('Upload Image', 'miraculous'); ?></a>
                                </div>
                                <div class="pro-form-btn text-center marger_top15">
                                    <div class="ms_upload_btn">
                                        <input type="submit" name="submit_form" id="upload_submit" class="ms_btn" value="Upload Now">
                                        <button class="hst_loader"><i class="fa fa-circle-o-notch fa-spin"></i> <?php echo esc_html__('Loading', 'miraculous'); ?></button>
                                        <input type="reset" name="reset_form" class="ms_btn" value="<?php esc_attr_e('reset','miraculous'); ?>">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
                <?php else: ?>
                    <form id="artist_create_form" method="post" action="<?php echo esc_url(get_the_permalink().'?do=upload_music'); ?>">
                        <div class="marger_top60">
                            <div class="ms_upload_box">
                                <div class="ms_heading">
                                    <h1><?php echo esc_html($settings['trackupload_heading_one']); ?></h1>
                                </div>
                                <div class="ms_pro_form">
                                    <div class="ms_new_artists_info">
                                        <div class="form-group">
                                            <label><?php echo esc_html__('Artist Name', 'miraculous'); ?> *</label>
                                            <input type="text" name="new_artist_name" id="new_artist_name" placeholder="<?php esc_attr_e('Ava Cornish','miraculous'); ?>" class="form-control">
                                        </div>
                                        <div class="ms_artist_image">
                                            <div class="form-group">
                                                <label><?php echo esc_html__('Artist Image *', 'miraculous'); ?> </label>
                                                <input type="text" name="new_artist_image" id="new_artist_image" class="form-control" value="" readonly="true">
                                                <input type="hidden" name="new_artist_image_id" id="new_artist_image_id" class="form-control" value=""><br>
                                                <a href="javascript:;" class="ms_btn up_artists_image"><?php echo esc_html__('Upload Image', 'miraculous'); ?></a>
                                            </div>
                                        </div>
                                        
                                    </div>
                                    <?php if($artists_names): ?>
                                        <div class="text-center">
                                            <a href="<?php echo esc_url(get_the_permalink().'?do=upload_music'); ?>"><?php echo esc_html__('Choose from Existing', 'miraculous'); ?></a>
                                        </div><br>
                                    <?php endif; ?>
                                    <div class="text-center marger_top15">
                                        <div class="ms_upload_btn">
                                            <input type="submit" name="submit_artists_form" id="submit_artists_form" class="ms_btn" value="<?php esc_attr_e('Next','miraculous'); ?>">
                                            <input type="reset" name="reset_form" class="ms_btn" value="<?php esc_attr_e('reset','miraculous'); ?>">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                <?php endif; ?>
            </div>
        <?php else: ?>
            <div class="ms_upload_wrapper marger_top60">
                <div class="ms_upload_box">
                    <h2><?php echo esc_html__('Need to purchase plan to upload music.', 'miraculous'); ?></h2>
                    <a href="<?php echo esc_url($pricing_plan); ?>" class="ms_btn">
                    <?php echo esc_html__('Click Here', 'miraculous'); ?></a>
                </div>
            </div> 
        <?php 
          endif;
        else:
        ?>
        <div class="ms_upload_wrapper marger_top60">
            <div class="ms_upload_box">
                <h2><?php echo esc_html__('You have not permission to access this page.', 'miraculous'); ?></h2>
                <a href="<?php echo esc_url(home_url('/')); ?>" class="ms_btn"><?php echo esc_html__('Go Back', 'miraculous'); ?></a>
            </div>
        </div> 
        <?php
        endif;
	}
}
