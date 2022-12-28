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
class Miraculous_needlogin extends Widget_Base {

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
		return 'Need To Login';
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
		return __( 'Need To Login', 'miraculous' );
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
                'label' => esc_html__( 'Need To Login', 'miraculous' ),
            ]
        );
        $this->add_control(
            'needlogin_heading',
            [
                'label'       => esc_html__( 'Need To Login Heading', 'miraculous' ),
                'type'        => Controls_Manager::TEXT,
                'label_block' => true,
                'default'     => esc_html__( '', 'miraculous' ),
            ]
        );
		$this->add_control(
            'needlogin_image',
            [
                'label'       => esc_html__( 'Imgae', 'miraculous' ),
                'type'        => Controls_Manager::MEDIA,
                'label_block' => true,
                'default' => [
					'url' => \Elementor\Utils::get_placeholder_image_src(),
				],
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
        
        $need_logoimage = '';
        if(!empty($settings['needlogin_image']['url'])):
            $need_logoimage = $settings['needlogin_image']['url'];
        else:
           $need_logoimage = get_template_directory_uri().'/assets/images/headphones.svg';
        endif;
        if(!is_user_logged_in()):
        ?>
        	<div class="ms_needlogin">
        		<div class="needlogin_img">
        			<img src="<?php echo esc_url($need_logoimage); ?>" alt="<?php esc_attr_e('Need Logo Image','miraculous'); ?>">
        		</div>
        		<?php if(!empty($settings['needlogin_heading'])): ?>
        	    	<h2><?php echo esc_html($settings['needlogin_heading']); ?></h2>
        		<?php endif; ?>
        		<a href="javascript:;" class="ms_btn reg_btn" data-toggle="modal" data-target="#myModal"><span><?php esc_html_e('register/login','miraculous'); ?></span></a>
        	</div>
        <?php
        endif;
	}
}
