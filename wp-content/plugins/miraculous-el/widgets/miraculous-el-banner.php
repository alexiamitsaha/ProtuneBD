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
class Miraculous_banner extends Widget_Base {

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
		return 'banner';
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
		return __( 'Banner', 'miraculous' );
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
		$this->start_controls_section(
            'heading',
            [
                'label' => esc_html__( 'Banner', 'miraculous' ),
            ]
        );
        $this->add_control(
            'banner_heading',
            [
                'label'       => esc_html__( 'Banner Heading', 'miraculous' ),
                'type'        => Controls_Manager::TEXT,
                'label_block' => true,
                'default'     => esc_html__( '', 'miraculous' ),
            ]
        );
        $this->add_control(
            'banner_subheading',
            [
                'label'       => esc_html__( 'Banner Subheading', 'miraculous' ),
                'type'        => Controls_Manager::TEXT,
                'label_block' => true,
                'default'     => esc_html__( '', 'miraculous' ),
            ]
        );
        $this->add_control(
			'editor',
			[
				'label' => esc_html__( 'Description', 'miraculous' ),
				'type' => Controls_Manager::WYSIWYG,
				'default' => '<p>' . esc_html__( 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut elit tellus, luctus nec ullamcorper mattis, pulvinar dapibus leo.', 'elementor' ) . '</p>',
			]
		);
		$this->add_control(
            'banner_image',
            [
                'label'       => esc_html__( 'Imgae', 'miraculous' ),
                'type'        => Controls_Manager::MEDIA,
                'label_block' => true,
                'default' => [
					'url' => \Elementor\Utils::get_placeholder_image_src(),
				],
            ]
        );
		$this->add_control(
			'banner_img',
			[
				'label' => esc_html__( 'Image Position Left', 'miraculous' ),
				'type' => Controls_Manager::SWITCHER,
				'no' => esc_html__( 'No', 'miraculous' ),
				'yes' => esc_html__( 'Yes', 'miraculous' ),
				'return_value' => 'yes',
				'default' => 'yes',
			]
		);
		$this->add_control(
			'button_one',
			[
				'label' => esc_html__( 'Button 1', 'miraculous' ),
				'type' => Controls_Manager::SWITCHER,
				'no' => esc_html__( 'No', 'miraculous' ),
				'yes' => esc_html__( 'Yes', 'miraculous' ),
				'return_value' => 'yes',
				'default' => 'yes',
			]
		);
		$this->add_control(
            'button_one_label',
            [
                'label'       => esc_html__( 'Button 1 Label', 'miraculous' ),
                'type'        => Controls_Manager::TEXT,
                'label_block' => true,
                'default'     => esc_html__( '', 'miraculous' ),
            ]
        );
        $this->add_control(
            'button_one_url',
            [
                'label'       => esc_html__( 'Button 1 URL', 'miraculous' ),
                'type'        => Controls_Manager::TEXT,
                'label_block' => true,
                'default'     => esc_html__( '', 'miraculous' ),
            ]
        );
        $this->add_control(
			'button_two',
			[
				'label' => esc_html__( 'Button 2', 'miraculous' ),
				'type' => Controls_Manager::SWITCHER,
				'no' => esc_html__( 'No', 'miraculous' ),
				'yes' => esc_html__( 'Yes', 'miraculous' ),
				'return_value' => 'yes',
				'default' => 'yes',
			]
		);
		$this->add_control(
            'button_two_label',
            [
                'label'       => esc_html__( 'Button 2 Label', 'miraculous' ),
                'type'        => Controls_Manager::TEXT,
                'label_block' => true,
                'default'     => esc_html__( '', 'miraculous' ),
            ]
        );
        $this->add_control(
            'button_two_url',
            [
                'label'       => esc_html__( 'Button 2 URL', 'miraculous' ),
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
        if($settings['banner_img'] == "yes"):
        ?>
        <div class="ms-banner">
            <div class="container-fluid">     
                <div class="row">
                    <div class="col-lg-12 col-md-12 padding-right padding-left">            
        			<?php if(!empty($settings['banner_image']['url'])): ?>
                        <div class="ms_banner_img">
                            <img src="<?php echo esc_url($settings['banner_image']['url']); ?>" alt="<?php echo esc_attr('Banner Img','miraculous'); ?>" class="img-fluid">
                        </div>
        			<?php endif; ?>
                        <div class="ms_banner_text">
        				  <?php if(!empty($settings['banner_heading'])): ?>
                            <h1><?php echo esc_html($settings['banner_heading']); ?></h1>
        				  <?php endif;
                           if(!empty($settings['banner_subheading'])):
        				  ?><h1 class="ms_color"><?php echo esc_html($settings['banner_subheading']); ?></h1>
        				  <?php endif;
        				  if(!empty($settings['editor'])):
        				  ?><?php echo wp_kses($settings['editor'], true); ?>
        				  <?php endif; ?>
                            <div class="ms_banner_btn">
                                <?php if( $settings['button_one'] == "yes" ): ?>
                                    <a href="<?php echo esc_url( $settings['button_one_url'] ); ?>" class="ms_btn"><?php echo ($settings['button_one_label']) ? $settings['button_one_label'] : esc_html__( 'Listen Now', 'miraculous' ); ?></a>
                                <?php endif; 
                                if( $settings['button_two'] == "yes" ): ?>
                                    <a href="<?php echo esc_url(  $settings['button_two_url'] ); ?>" class="ms_btn"><?php echo ( $settings['button_two_label']) ?  $settings['button_two_label'] : esc_html__( 'Add To Queue', 'miraculous' ); ?></a>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php else: ?>
        <div class="ms-banner">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12 col-md-12 padding-right padding-left">
                        <div class="ms_banner_text">
        				<?php if(!empty($settings['banner_heading'])): ?>
                            <h1><?php echo esc_html( $settings['banner_heading'] ); ?></h1>
        				<?php endif;
        				if(!empty($settings['banner_subheading'])):
        				?><h1 class="ms_color"><?php echo esc_html($settings['banner_subheading']); ?></h1>
        				<?php endif;
        				if(!empty($settings['editor'])):
        				?><?php echo wp_kses($settings['editor'], true); ?>
        				<?php endif; ?>
                            <div class="ms_banner_btn">
                                <?php if( $settings['button_one'] == "yes" ): ?>
                                    <a href="<?php echo esc_url( $settings['button_one_url'] ); ?>" class="ms_btn"><?php echo ($settings['button_one_label']) ? $settings['button_one_label'] : esc_html__( 'Listen Now','miraculous'); ?></a>
                                <?php endif; 
                                if( $settings['button_two'] == "yes" ): ?>
                                    <a href="<?php echo esc_url( $settings['button_two_url'] ); ?>" class="ms_btn"><?php echo ($settings['button_two_label']) ? $settings['button_two_label'] : esc_html__( 'Add To Queue' ,'miraculous'); ?></a>
                                <?php endif; ?>
                            </div>
                        </div>
        				<?php if(!empty($settings['banner_image']['url'])): ?>
                        <div class="ms_banner_img">
                            <img src="<?php echo esc_url($settings['banner_image']['url']); ?>" alt="<?php echo esc_attr('Banner Img','miraculous'); ?>" class="img-fluid">
                        </div>
        				<?php endif; ?>
                    </div> 
                </div>
            </div>
        </div>
        <?php endif;
	}
}
