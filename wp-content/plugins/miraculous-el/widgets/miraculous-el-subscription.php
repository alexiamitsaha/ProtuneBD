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
class Miraculous_subscription extends Widget_Base {

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
		return 'Subscription Plan';
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
		return __( 'Subscription Plan', 'miraculous' );
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
                'label' => esc_html__( 'Subscription Plan', 'miraculous' ),
            ]
        );
        $this->add_control(
            'subscription_heading',
            [
                'label'       => esc_html__( 'Subscription Plan Heading', 'miraculous' ),
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
        $pricing_plan = '';
        if(!empty($miraculous_theme_data['user_pricing_plan_page'])):
            $pricing_plan = get_the_permalink( $miraculous_theme_data['user_pricing_plan_page'] );
        endif;
        $currency = '';
        if(!empty($miraculous_theme_data['currency'])):
            $currency = $miraculous_theme_data['currency'];
        endif;
        $submit_url = plugins_url().'/miraculouscore/paypal/payments.php';
        
        $ms_args = array('post_type' => 'ms-plans',
                        'numberposts' => -1,
                        'order' => 'ASC'
                        );
        $music_plans = new \WP_Query( $ms_args );
        $current_user = wp_get_current_user();
        ?>
        <div class="ms_account_wrapper">
            <div class="container">
                <?php 
        		if( !empty($current_user) && $current_user->ID ):
        		?>
                <div class="row">
                    <div class="col-lg-12">
                        <div class="ms_acc_overview">
                           <?php   
                            global $wpdb;
                            $pmt_tbl = $wpdb->prefix . 'ms_payments'; 
                            $today = date('Y-m-d H:i:s');
                            $query = $wpdb->get_results( "SELECT * FROM `$pmt_tbl` WHERE user_id = $current_user->ID AND expiretime > '$today'" );
                            if($query): 
                            ?>
                            <div class="ms_heading">
                                <h1><?php esc_html_e('Account Overview','miraculous'); ?></h1>
                            </div>
                            <div class="ms_acc_ovrview_list">
                                    <?php $i=1; foreach($query as $row): ?>
                                        <ul>
                                            <?php 
                                            $start = date_create($today);
                                            $end = date_create($row->expiretime);
                                            $days_between = date_diff($start, $end); ?>
                                            <li><?php printf( __('Your Subscribed Plan <span>- %s</span>', 'miraculous'), get_the_title($row->itemid) ); ?></li>
                                            <li><?php printf( __('Amount Paid <span>- '. miraculous_currency_symbol($currency) . ' %s</span>', 'miraculous'), $row->payment_amount ); ?></li>
                                            <li><?php printf( __('Validity Expires In <span>- %s Days</span>', 'miraculous'), $days_between->format("%a") ); ?></li>
                                            <li><?php printf( __('Monthly Download <span>- %s Tracks</span>'), $row->monthly_download ); ?></li>
                                            <li><?php printf( __('Monthly Upload  <span>- %s Tracks</span>'), $row->monthly_upload ); ?></li>
                                            <li><?php printf( __('Downloads Remaining <span>- %s Tracks</span>'), $row->remains_download ); ?></li>
                                            <li><?php printf( __('Upload Remaining <span>- %s Tracks</span>'), $row->remains_upload ); ?></li>
                                        </ul>
                                        <?php if($i == 1){ 
                                            $free_plane_switch = '';
                                        	    $free_plane_switch = get_post_meta($row->itemid, 'fw_options', true);
                                        if($free_plane_switch['free_plane_switch'] == 'on'){ ?>
                                        <?php if( !empty($current_user) && $current_user->ID ){ ?>
                                            <form class="paypal" action="" method="post">
                                                <input type="hidden" name="cmd" value="_xclick" />
                                                <input type="hidden" name="lc" value="UK" />
                                                <input type="hidden" name="first_name" id="first_name" value="<?php echo esc_attr($current_user->user_firstname); ?>" />
                                                <input type="hidden" name="last_name" id="last_name" value="<?php echo esc_attr($current_user->user_lastname); ?>" />
                                                <input type="hidden" name="payer_email" id="payer_email" value="<?php echo esc_attr($current_user->user_email); ?>" />
                                                <input type="hidden" name="user_id" id="user_id" value="<?php echo esc_attr($current_user->ID); ?>" />
                                                <input type="hidden" name="item_number" id="item_number" value="<?php echo esc_attr($row->itemid); ?>" / >
                                                <input type="hidden" name="item_name" id="item_name" value="<?php the_title_attribute(); ?>" / >
                                                <input type="submit" name="submit" id="free_plane_switch" class="mira_price ms_btn" value="<?php    esc_attr_e('Renew now', 'miraculous'); ?>"/>
                                            </form>
                                        <?php } else{ ?>
                						<a href="javascript:;" class="ms_btn" data-toggle="modal" data-target="#myModal1"><?php esc_html_e('Renew now', 'miraculous'); ?></a>
                						<?php } ?>
                					<?php  } else { ?>
                						<a href="javascript:;" class="ms_btn bynow_btn" data-toggle="modal" data-target="#bynow" order_id="<?php echo esc_attr($row->itemid); ?>"><?php esc_html_e('Renew now', 'miraculous'); ?></a>
                					<?php }  ?>
                                        <?php } ?>
                                    <?php endforeach; ?>
                                </div>
                            <?php else: ?>
                              <div>
                                <?php esc_html_e('You have not subscribed any plan yet.', 'miraculous'); ?>
                              </div>
                             <div class="bw_price_plane_page">
                                <a href="<?php echo esc_url($pricing_plan); ?>" class="ms_btn"><?php echo esc_html('Get Price Plan','miraclous'); ?></a>
                             </div>
                             <?php endif; ?> 
                        </div>
                    </div>
                </div>
                <?php 
        		endif; 
        		?>
              </div>
        </div>  
        <?php
	}
}
