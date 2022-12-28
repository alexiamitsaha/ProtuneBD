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
class Miraculous_updatealbum extends Widget_Base {

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
		return 'Update Album';
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
		return __( 'Update Album', 'miraculous' );
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
                'label' => esc_html__( 'Update Album', 'miraculous' ),
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
        if(!empty($settings['updatealbum_heading'])):
          $upload_heading_one = $settings['updatealbum_heading'];
        endif; 
        
        $miraculous_theme_data = '';
        if (function_exists('fw_get_db_settings_option')):  
            $miraculous_theme_data = fw_get_db_settings_option();     
        endif;
        
        $currency = '';
        if(!empty($miraculous_theme_data['currency'])):
            $currency = $miraculous_theme_data['currency'];
        endif;
        
        $user_id = get_current_user_id();
        if($user_id):  
        
        $albums_id = '';   
        if(!empty($_GET['albums_id'])):
          $albums_id = $_GET['albums_id'];  
        endif;
        $albums_data = get_post($albums_id);
        
        $ms_album_post_meta_option = '';
        if( function_exists('fw_get_db_post_option') ):
           $ms_album_post_meta_option = fw_get_db_post_option($albums_id);
        endif;
        
        $album_metadata = '';
        if(!empty($ms_album_post_meta_option['album_release_date'])):
          $album_metadata = $ms_album_post_meta_option['album_release_date'];
        else:
          $album_metadata = get_post_meta($albums_id,'fw_options:album_release_date',true);
        endif;
        
        $prices = '';
        if(!empty($ms_album_post_meta_option['album_full_prices'])):
          $prices = $ms_album_post_meta_option['album_full_prices'];
        else:
          $prices = get_post_meta($albums_id,'fw_options:album_full_prices',true);
        endif;
        
        $image_url = wp_get_attachment_image_url(get_post_thumbnail_id($albums_id), 'full');
        ?>   
        <div class="ms_upload_wrapper mv_video_wrap music-dashboard-wrapper">
            <form id="update_album_forms" method="post" enctype="multipart/form-data">
                <div class="form-group">
                  <label for="albumtitle"><?php echo esc_html__('Album Title','miraculous'); ?></label>
                  <input type="text" id="albumtitle" name="albumtitle" placeholder="Enter Album Title" value="<?php echo get_the_title($albums_id); ?>">
                </div>
                <div class="form-group">
                    <label for="albumdscription">
                    <?php echo esc_html__('Album Description','miraculous'); ?></label>
                    <textarea id="albumdscription" name="albumdscription" placeholder="Enter Album Description" ><?php echo $albums_data->post_content; ?></textarea>
                </div> 
        		<!--
                <div class="form-group">   
                    <label for="language"><?php echo esc_html__('Album Language','miraculous'); ?></label>
                    <select id="language" name="language">
                        <?php 
                        $language_terms = get_terms('language',array( 'hide_empty' => false,));
                        if(!empty($language_terms)):
                            foreach($language_terms as $data_terms):
                        ?>
                        <option value="<?php echo esc_attr($data_terms->slug); ?>">
                        <?php echo esc_html($data_terms->name); ?></option>
                        <?php endforeach;
                         endif;
                        ?>
                    </select>
                </div> --> 
                <div class="form-group relative">
                    <label><?php esc_html_e('Album Cover Image Upload','miraculous'); ?></label>
                    <input type="text" name="up_image_file" id="up_image_file" class="form-control" value="<?php echo esc_url($image_url); ?>" readonly="true">
                    <input type="hidden" name="up_image_file_id" id="up_image_file_id" value="">
                    <a href="javascript:;" class="ms_btn up_image_upload">
                    <?php esc_html_e('Upload Image','miraculous'); ?></a>
                </div> 
        		<div class="row">
        			<div class="form-group col-lg-6">
        				<label><?php echo esc_html('Album Type', 'miraculous'); ?></label>
        				<select name="album_types" id="album_types" class="form-control">
        					<option value="premium"><?php echo esc_html__('Premium', 'miraculous'); ?></option>
        					<option value="free"><?php echo esc_html__('Free', 'miraculous'); ?></option>
        				</select>
        			</div>   
        			<div class="form-group col-lg-6" id="mira_album_price_showhide">
        				<label><?php echo esc_html('Album Price', 'miraculous'); ?></label>
        				<input type="text" name="album_price" id="album_price" value="<?php echo esc_attr($prices); ?>" class="form-control" onkeypress="validate_num(event)" >
        			</div>   
        		</div>
                <div class="form-group">
                  <label for="my_image_upload">
                  <?php echo esc_html__('Select Audio','miraculous'); ?></label>
                  <select id="album_tracks" class="bw_album_tracks_upload" name="fw_options[album_songs][]" multiple="">
                    <?php 
                      $user_id = $user_id = get_current_user_id(); 
                      $sg_args = array(
                        'post_type' => 'ms-music',
                        'posts_per_page' => -1,
                        'author' =>  $user_id,
                        ); 
                      $music_posts = new \WP_Query( $sg_args );
                      if( $music_posts->have_posts() && $user_id ):
                        while ( $music_posts->have_posts() ) : $music_posts->the_post();
                      ?>
                      <option value="<?php echo get_the_ID(); ?>"><?php echo get_the_title(); ?></option>
        			        <?php 
                      endwhile;
                      wp_reset_query();
                      endif;  
                      ?>
                  </select> 
                </div>
                <div class="mv_upload_btn">   
                  <input type="hidden" name="albums_id" id="albums_id" value="<?php echo esc_attr($albums_id);  ?>" />  
                  <input type="submit" name="submit_form" id="upload_submit" class="ms_btn" value="Update Album"> 
                  <button class="hst_loader"><i class="fa fa-circle-o-notch fa-spin"></i><?php echo esc_html__('Loading', 'miraculous'); ?></button>
                  <input type="reset" name="reset_form" class="ms_btn" value="<?php esc_attr_e('reset','miraculous'); ?>">
                </div> 
            </form>
        </div>
        <?php
        endif;
	}
}
