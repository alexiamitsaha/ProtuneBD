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
class Miraculous_followartist extends Widget_Base {

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
		return 'Follow Artist';
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
		return __( 'Follow Artist', 'miraculous' );
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
                'label' => esc_html__( 'Follow Artist', 'miraculous' ),
            ]
        );
        $this->add_control(
            'followartist_heading',
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
        
        $heading = '';
        if(!empty($settings['followartist_heading'])):
          $heading = $settings['followartist_heading'];
        endif;
        $user_id = get_current_user_id(); 
        $user_meta = get_userdata($user_id);
        $user_roles ='';
        if(!empty($user_meta->roles)){
            $user_roles = implode(', ', $user_meta->roles);
        }
        $artists_names = '';
        if($user_roles=='artist'):
          if(!empty($artist_pricing_plan)){
            $pricing_plan = $artist_pricing_plan;
          }
        endif;
        $preview = get_template_directory_uri().'/assets/images/pro_img.png';
        $user_id = get_current_user_id(); 
        global $wpdb;
        $today = date('Y-m-d H:i:s');
        $pmt_tbl = $wpdb->prefix . 'recurring_subscriptions';  
        if(wp_get_current_user()){
        ?> 
        <div class="ms-artist-list">
            <div class="ms-artist-inner">
                <?php if(!empty($heading)): ?>
                    <div class="ms_heading">
                        <h1><?php echo esc_html($heading); ?></h1>
                    </div>  
                <?php endif; ?>
                <div class="ms-artist-list-inner">
                     <table id="artist-list" class="display">
                        <thead>
                            <tr>
                                <th>Image</th>
                                <th>Name</th>
                                <th>Track</th>
                                <th>Follow</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php 
                            $roles = array('artist','administrator');
                            $args = array (
                                'role__in' => $roles,
                                'order' => 'ASC',
                            );
                            $wp_user_query = new \WP_User_Query($args); 
                            $authors = $wp_user_query->get_results();
                            if (!empty($authors)) {
                                foreach ($authors as $author){
                                    $author_info = get_userdata($author->ID);
                                    $img_src = get_user_meta($author->ID, 'user_profile_img', true);
                                    if($author->ID == get_current_user_id()){
                                    }?>
                                        <tr>
                                            <td class="ms-artist-image">
                                                <?php if(!empty($img_src)){ ?>
                                                    <img src="<?php echo esc_url($img_src); ?>" data-artistsids="<?php echo esc_attr($author->ID); ?>" alt="<?php echo esc_attr($author_info->first_name); ?>" class="img-fluid bw_artists_data">
                                                    <?php } else{ ?> 
                                                        <img src="<?php echo esc_url($preview); ?>" data-artistsids="<?php echo esc_attr($author->ID); ?>"  alt="<?php echo esc_attr($author_info->first_name); ?>" class="img-fluid bw_artists_data">
                                                    <?php } ?>
                                            </td>
                                            <td>
                                                <span class="ms-artist-full" data-artistsids="<?php echo esc_attr($author->ID); ?>"><?php echo esc_html($author_info->first_name); ?></span>
                                            </td>
                                            <td>
                                                <?php
                                                    global $wp_query;
                                                    $post_tracks_count = $wpdb->get_var("SELECT COUNT(*) FROM $wpdb->posts WHERE post_author = '" .$author->ID. "' AND post_type = 'ms-music' AND post_status = 'publish'"); ?>
                                                    <span class="ms-artist-track-cont"><?php
                                                        if(!empty($post_tracks_count)){
                                                            echo esc_html($post_tracks_count); 
                                                        } else{
                                                            esc_html_e('0', 'miraculous'); 
                                                        }
                                                ?></span>
                                            </td>
                                            <td id="follow-me">
            									<a href="javascript:;" class="ms-follow" data-id="<?php echo esc_attr($author->ID); ?>">
            									<?php 
            										$id = $author->ID;
            										
            										$follow_cont = get_user_meta($user_id, 'follow_id', true);
            										if($follow_cont){
            										if (in_array($id, $follow_cont)){?>
            											<span class="ms-following f_added">UnFollow</span> 
            										<?php } else { ?>
            											<span class="ms-following f_remove">Follow</span>
            										<?php } 
            										} else { ?>
            											<span class="ms-following f_remove">Follow</span>
            										<?php }
            									?> 
            									</a> 
            								</td>
                                        </tr>
                                <?php }
        						} else {
        						?>
        						<div class="ms_upload_wrapper marger_top60">
        							<div class="ms_upload_box">
        								<h2><?php echo esc_html__('No User Found', 'miraculous'); ?></h2>
        								<a href="<?php echo esc_url(home_url('/')); ?>" class="ms_btn"><?php echo esc_html__('Go Back', 'miraculous'); ?></a>
        							</div>
        						</div> 
        						<?php }
                            ?>
                        <tbody>
                    </table>
                </div>
            </div>
        </div>
        <?php 
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
