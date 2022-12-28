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
class Miraculous_usersearning extends Widget_Base {

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
		return 'Users Earning';
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
		return __( 'Users Earning', 'miraculous' );
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
                'label' => esc_html__( 'Users Earning', 'miraculous' ),
            ]
        );
        $this->add_control(
            'usersearning_heading',
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
        
        $about_heading = '';
        if(!empty($atts['about_heading'])):
          $about_heading = $atts['about_heading'];
        endif;
        $user_id ='';
        if(!empty($_GET['artistid'])):
        	$user_id = $_GET['artistid'];
        else:
        	$user_id = get_current_user_id(); 
        endif;
        $name = get_the_author_meta('display_name', $user_id);
        $email = get_the_author_meta('user_email', $user_id);
        
        $miraculous_theme_data = '';
        if (function_exists('fw_get_db_settings_option')):	
            $miraculous_theme_data = fw_get_db_settings_option();     
        endif;
        
        $currency = '';
        if(!empty($miraculous_theme_data['currency']) && function_exists('miraculous_currency_symbol')):
            $currency = miraculous_currency_symbol( $miraculous_theme_data['currency'] );
        endif;
        
        $commision = '';
        if(!empty($miraculous_theme_data['commission_value'])):
            $commision = $miraculous_theme_data['commission_value'];
        endif;
        ?> 
        <div class="ms_free_download ms_purchase_wrapper">
            <div class="earning-div row">
                <div class="earning-div-item col-md-3 col-lg-3">
                    <?php 
                        $orders = wc_get_orders( array(
                            'numberposts' => -1,
                        ) );
                        $quantitys = $order_totals = 0;
                        if(!empty($orders)){
                            foreach($orders as $order){
                                $status = $order->get_status();
                                if( $status == 'completed'){
                                    $order_total = $order->get_total();
                                    foreach ( $order->get_items() as $item_id => $item ) {
                                        $product_id = $item->get_product_id();
                                        $post_obj    = get_post( $product_id );
                                        $vendor_id = $post_obj->post_author;
                                        if($user_id == $vendor_id ){
                                            $order_totals += $order_total;
                                        }
                                    }
                                }
                            }
                        }
                        if(!empty($order_totals)){
                            $product_order = ($order_totals*$commision)/100;
                            $product_orders = $order_totals - $product_order;
                            echo '<h3>'.esc_html($currency.' '.$product_orders).'</h3>';
                        } else {
                            echo '<h3>'.esc_html(0).'</h3>';
                        }
                    ?>
                    <p><?php echo esc_html('Total Product Sell Earning'); ?></p>
                </div>
                <div class="earning-div-item col-md-3 col-lg-3">
                    <?php 
                        global $wpdb;
                        $prices = 0;
                        $pmt_tbl = $wpdb->prefix . 'ms_orders'; 
                        $music_query = $wpdb->get_results( "SELECT* FROM $pmt_tbl WHERE author_id={$user_id}");
                        foreach($music_query as $music){
                            if(!empty($commision)){
                            $commisions = ($music->payment_amount*$commision)/100;
                            }else{
                            $commisions = 0;    
                            }
                            $price = $music->payment_amount - $commisions;
                            $prices += $price;
                        }
                        if(!empty($prices)){
                            echo '<h3>'.esc_html($currency.' '.$prices).'</h3>';
                        } else {
                            echo '<h3>'.esc_html(0).'</h3>';
                        }
                    ?>
                    <p><?php echo esc_html('Total Music Sell Earning'); ?></p>
                </div>
                <div class="earning-div-item col-md-3 col-lg-3">
                    <?php 
                        global $wpdb;
                        $prices = 0;
                        $pmt_tbl = $wpdb->prefix . 'ms_orders'; 
                        $music_query = $wpdb->get_results( "SELECT* FROM $pmt_tbl WHERE author_id={$user_id}");
                        foreach($music_query as $music){
                            if(!empty($commision)){
                            $commisions = ($music->payment_amount*$commision)/100;
                            }else{
                            $commisions = 0;    
                            }
                            $price = $music->payment_amount - $commisions;
                            $prices += $price;
                        }
                        if(!empty($prices) || !empty($order_totals)){
                            if(empty($product_orders)){
                                $product_orders = 0;
                            }
                            $sub_total = $prices + $product_orders;
                            echo '<h3>'.esc_html($currency.' '.$sub_total).'</h3>';
                        } else {
                            echo '<h3>'.esc_html(0).'</h3>';
                        }
                    ?>
                    <p><?php echo esc_html('Total Earning'); ?></p>
                </div>
                <div class="earning-div-item col-md-3 col-lg-3">
                    <?php 
                        $moneys = 0;
                        $pmt_tbld = $wpdb->prefix . 'payement_request'; 
                        $total_r_earningss = $wpdb->get_results( "SELECT* FROM $pmt_tbld WHERE payment_receiver_id={$user_id} ORDER BY srn DESC");
                        foreach($total_r_earningss as $total_r_earn){
                            $std = $total_r_earn->us_payment_receiver;
                            if($std =='complete'){
                               $money = $total_r_earn->amount;
                                $moneys += $money;
                            }
                        }
                        if(!empty($moneys) || !empty($sub_total)){
                            $vendor_payment = $sub_total - $moneys;
                            $number = number_format($vendor_payment, 2, ".", "");
                            echo '<h3>'.esc_html($currency.' '.$number).'</h3>';
                        } else if(empty($moneys) && !empty($sub_total)) {
                            $vendor_payment = $sub_total;
                            echo '<h3>'.esc_html($currency.' '.$vendor_payment).'</h3>';
                        } else if(!empty($moneys) && empty($sub_total)){
                            $vendor_payment = $moneys;
                            echo '<h3>'.esc_html($currency.' '.$vendor_payment).'</h3>';
                        } else {
                             echo '<h3>'.esc_html(0).'</h3>';
                        }
                    ?>
                    <p><?php echo esc_html('Available Balance'); ?></p>
                </div>
                <div class="payout-btn">
                    <?php 
                        if(!empty($number)){
                            $pmt_tbld = $wpdb->prefix . 'payement_request'; 
                            $remening_t = $wpdb->get_results( "SELECT* FROM $pmt_tbld WHERE payment_receiver_id={$user_id}");
                            foreach($remening_t as $remening_ts){
                                $remening = $remening_ts->us_payment_receiver;
                            } 
                            if(!empty($remening)){
                                $remening = $remening_ts->us_payment_receiver;
                            } else {
                                $remening = '';
                            }
                            if($remening == 'Panding'){
                                ?>
                                    <a href="javascript:void(0);" class="ms_btn payment_btn_suc"><?php echo esc_html($currency.' '.$number. ' Pending Request'); ?></a>
                                    <p class="payment_btn_suc"> You Are Not Able To Request For Payment Again. Please Wait While Admin Approve Your Last Request.</p></br>
                                <?php
                            } else {
                                ?>
                                <a href="javascript:void(0);" class="ms_btn payment_btn" data-id="<?php echo esc_attr($user_id); ?>" data-attr="<?php echo esc_attr($number); ?>"><?php echo esc_html($currency.' '.$number.' Payment Request'); ?></a>
                                <?php
                            }
                            
                        } else {
                            ?>
                            <a href="javascript:void(0);" class="ms_btn payment_btn0" data-id="<?php echo esc_attr($user_id); ?>"><?php echo esc_html($currency.' 0 Payment Request'); ?></a>
                            <?php 
                        }
                    
                    ?>
                    
                    
                    
                    <a href="#" style="display: none;" class="ms_btn payment_btn_suc"><?php echo esc_html($currency.' '.$number. ' Pending Request'); ?></a>
                    <p style="display: none;" class="payment_btn_suc"> You Are Not Able To Request For Payment Again. Please Wait While Admin Approve Your Last Request.</p>
                </div>
            </div>
            <ul class="tabs">
        		<li class="tab-link current" data-tab="product_e"><?php echo esc_html('Product Earning', 'miraculous');?></li>
        		<li class="tab-link" data-tab="music_e"><?php echo esc_html('Music Earning', 'miraculous');?></li>
        		<li class="tab-link" data-tab="transaction_e"><?php echo esc_html('Transaction History', 'miraculous');?></li>
        	</ul>
        	<div id="product_e" class="tab-content current table-responsive">
        	   <h1 class="mv_heading"><?php echo esc_html__('Product Earning','miraculous'); ?></h1>
            <table id="myearning" class="display table-responsive">
                <thead>
                    <tr>
        			    <th><?php echo esc_html__('Order','miraculous'); ?></th>
        			    <th><?php echo esc_html__('Date','miraculous'); ?></th>
        			    <th><?php echo esc_html__('Status','miraculous'); ?></th>
        		    	<th><?php echo esc_html__('Product Quantity','miraculous'); ?></th>
        		    	<th><?php echo esc_html__('Total','miraculous'); ?></th>
        			    <th><?php echo esc_html__('Earning','miraculous'); ?></th>
        	        </tr>
                </thead>
                <tbody>
                    <?php
                        $orders = wc_get_orders( array(
                            'numberposts' => -1,
                        ) );
                        if(!empty($orders)){
                            foreach($orders as $order){
                                foreach ( $order->get_items() as $item_id => $item ) {
                                    $product_id = $item->get_product_id();
                                        $post_obj    = get_post( $product_id );
                                        $vendor_id = $post_obj->post_author;
                                        if($user_id == $vendor_id ){
                                            ?>
                                    <tr>
                                        <td class="sort2"><?php echo esc_html('#'.$order->get_id());?></td>
                                        <td><?php 
                                                $date=$order->get_date_created();
                                                $date_format = date_format($date,"Y-m-d");
                                                echo esc_html($date_format);
                                        ?></td>
                                        <td><?php echo esc_html($order->get_status());?></td>
                                        <td><?php echo esc_html($item->get_quantity()); ?></td>
                                        <td><?php echo esc_html($currency.' '. $order->get_total());?></td>
                                        <td><?php
                                            //$currency = get_woocommerce_currency();
                                            if( $order->get_status() == 'completed'){
                                                if(!empty($commision)){;
                                                    $commisions = ($order->get_total()*$commision)/100;
                                                    $total_odr = $order->get_total() - $commisions;
                                                    $total_price = $currency.' '.$total_odr;
                                                } else {
                                                    $total_price = $currency.' '. $order->get_total();
                                                }
                                            } else {
                                                $total_price = 'Amount Pending';
                                            }
                                            echo esc_html($total_price);
                                        ?></td>
                                    </tr>
                                <?php
                                        }
                                }
                            }
                        }
                    ?>
                    
                    
                </tbody>
            </table>
        	</div>
        	<div id="music_e" class="tab-content">
        		 <h1 class="mv_heading"><?php echo esc_html__('Product Earning','miraculous'); ?></h1>
            <table id="musci_earnings" class="display">
                <thead>
                    <tr>
        			    <th><?php echo esc_html__('Order Id','miraculous'); ?></th>
        			    <th><?php echo esc_html__('Date','miraculous'); ?></th>
        			    <th><?php echo esc_html__('Item Name','miraculous'); ?></th>
        			    <th><?php echo esc_html__('Item Type','miraculous'); ?></th>
        		    	<th><?php echo esc_html__('Total','miraculous'); ?></th>
        		    	<th><?php echo esc_html__('Earning','miraculous'); ?></th>
        			    
        	        </tr>
                </thead>
                <tbody>
                    <?php
                        global $wpdb;
                        $pmt_tbl = $wpdb->prefix . 'ms_orders'; 
                        $music_query = $wpdb->get_results( "SELECT* FROM $pmt_tbl WHERE author_id={$user_id}");
                        foreach($music_query as $music){
                            ?>
                                <tr>
                                    <td><?php echo esc_html('#'.$music->id);?></td>
                                    <td><?php 
                                        $date= $music->createdtime;
                                        $date_format = date('Y-m-d',strtotime($date));
                                        echo esc_html($date_format);
                                    ?></td> 
                                    <td><?php
                                        $musicid = $music->itemid;
                                        $music_title = get_the_title($musicid);
                                    echo esc_html($music_title);?></td>
                                    <td><?php 
                                        $music_type = get_post_type($musicid);
                                        if($music_type == 'ms-music'){
                                            $type = 'Track';
                                        } else {
                                            $type = 'Album';
                                        }
                                    
                                    echo esc_html($type);?></td>
                                    <td><?php echo esc_html($music->payment_amount);?></td>
                                    <td><?php 
                                        $commisions = ($music->payment_amount*$commision)/100;
                                        $price = $music->payment_amount - $commisions;
                                        echo esc_html($currency.' '.$price);?></td>
                                </tr>
                            <?php
                        }
                    ?>
                </tbody>
            </table>
            </div>
        	<div id="transaction_e" class="tab-content">
        	    <table id="transaction_earnings" class="display">
                <thead>
                    <tr>
        			    <th><?php echo esc_html__('Id','miraculous'); ?></th>
        			    <th><?php echo esc_html__('Status','miraculous'); ?></th>
        			    <th><?php echo esc_html__('Amount','miraculous'); ?></th>
        			    <!--<th><?php echo esc_html__('Date','miraculous'); ?></th>-->
        			    
        	        </tr>
                </thead>
                <tbody>
        	   <?php 
        	        global $wpdb;
                        $pmt_tbl = $wpdb->prefix . 'payement_request'; 
                        $tra_earnings = $wpdb->get_results( "SELECT* FROM $pmt_tbl WHERE payment_receiver_id={$user_id}");
                        foreach($tra_earnings as $tra_earning){
                            ?>
                                <tr>
                                    <td>#<?php echo esc_attr($tra_earning->srn); ?></td>
                                    <td><?php echo esc_html($tra_earning->us_payment_receiver); ?></td>
                                    <td><?php echo esc_html($currency.' '.$tra_earning->amount); ?></td>
                                </tr>
                            <?php 
                        }
        	   ?>
        	   </tbody>
            </table>
        	   
        	</div>
        </div>
        <?php 
	}
}
