<?php
use \Elementor\Controls_Manager;
use \Elementor\Utils;
use \Elementor\Group_Control_Typography;
use \Elementor\Group_Control_Background;
use \Elementor\Group_Control_Image_Size;
use \Elementor\Group_Control_Border;

class CustomEleImageComparisonWidget extends \Elementor\Widget_Base
{
    public static $slug = 'customeleaddon';
    public function get_name()
    {
        return self::$slug . "image_comparison";
    }

    public function get_title()
    {
        return __('Image Comparison Slider', self::$slug);
    }

    public function get_icon()
    {
        return 'eicon-image-before-after';
    }

    public function get_custom_help_url()
    {
        return null;
    }

    public function get_categories()
    {
        return ['general'];
    }

    public function get_keywords()
    {
        return ['slider', 'swiper', 'imgage', 'comparison', 'compare', 'custom'];
    }

    public function get_script_depends()
    {
        return ['customeleaddon-scripts'];
    }

    public function get_style_depends()
    {
        return ['customeleaddon-styles'];
    }

    protected function register_controls()
    {
        $this->start_controls_section(
            'content_section',
            [
                'label' => esc_html__('Content', 'elementor-currency-control'),
                'tab' => Controls_Manager::TAB_CONTENT,
            ]
        );


        $this->add_control(
            'customeleaddon_img_comparison_before_heading_section',
            [
                'label' => esc_html__('Before', self::$slug),
                'type' => Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );
        $this->add_control(
            'customeleaddon_img_comparison_image_before',
            [
                'label' => esc_html__('Choose Image', self::$slug),
                'type' => Controls_Manager::MEDIA,
                'dynamic' => [
                    'active' => true,
                ],
                'default' => [
                    'url' => Utils::get_placeholder_image_src(),
                    'id' => -1
                ],
            ]
        );
        $this->add_control(
            'customeleaddon_img_comparison_label_before',
            [
                'label' => esc_html__('Label', self::$slug),
                'type' => Controls_Manager::TEXT,
                'dynamic' => [
                    'active' => true,
                ],
                'default' => 'Before',
            ]
        );
        $this->add_control(
            'customeleaddon_img_comparison_after_heading_section',
            [
                'label' => esc_html__('After', self::$slug),
                'type' => Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );
        $this->add_control(
            'customeleaddon_img_comparison_image_after',
            [
                'label' => esc_html__('Choose Image', self::$slug),
                'type' => Controls_Manager::MEDIA,
                'dynamic' => [
                    'active' => true,
                ],
                'default' => [
                    'url' => Utils::get_placeholder_image_src(),
                    'id' => -1
                ],
            ]
        );
        $this->add_control(
            'customeleaddon_img_comparison_label_after',
            [
                'label' => esc_html__('Label', self::$slug),
                'type' => Controls_Manager::TEXT,
                'dynamic' => [
                    'active' => true,
                ],
                'default' => 'After',
            ]
        );


        $this->end_controls_section();

        /**
         * General Style Section
         */
        $this->start_controls_section(
            'customeleaddon_img_comparison_general_style',
            array(
                'label' => esc_html__('General', self::$slug),
                'tab' => Controls_Manager::TAB_STYLE,
                'show_label' => false,
            )
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            array(
                'name' => 'customeleaddon_img_comparison_container_border',
                'label' => esc_html__('Border', self::$slug),
                'placeholder' => '1px',
                'default' => '1px',
                'selector' => '{{WRAPPER}} .image-container-wrapper',
            )
        );

        $this->add_responsive_control(
            'customeleaddon_img_comparison_container_border_radius',
            array(
                'label' => esc_html__('Border Radius', self::$slug),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => array('px', '%'),
                'selectors' => array(
                    '{{WRAPPER}} .image-container-wrapper' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ),
            )
        );

        $this->add_responsive_control(
            'customeleaddon_img_comparison_container_padding',
            array(
                'label' => esc_html__('Padding', self::$slug),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => array('px', '%'),
                'selectors' => array(
                    '{{WRAPPER}} .image-container-wrapper' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ),
            )
        );

        $this->end_controls_section();

        /**
         * Label Style Section
         */
        $this->start_controls_section(
            'customeleaddon_img_comparison_label_style',
            array(
                'label' => esc_html__('Label', self::$slug),
                'tab' => Controls_Manager::TAB_STYLE,
                'show_label' => false,
                // 'condition' => ['customeleaddon_img_comparison_overlay!' => 'true'],
            )
        );
        $this->add_responsive_control(
            'customeleaddon_img_comparison_handle_text_position',
            array(
                'label' => esc_html__('Overlay Text Position', self::$slug),
                'type' => Controls_Manager::SLIDER,
                'size_units' => array('%'),
                'range' => array(
                    '%' => array(
                        'min' => 0,
                        'max' => 100,
                    ),
                ),
                'default' => array(
                    'unit' => '%',
                    'size' => 50,
                ),
                'selectors' => array(
                    '{{WRAPPER}} .text-overlay' => 'top: {{SIZE}}{{UNIT}};',
                )
            )
        );
        $this->start_controls_tabs('customeleaddon_img_comparison_tabs_label_styles');

        $this->start_controls_tab(
            'customeleaddon_img_comparison_tab_label_before',
            array(
                'label' => esc_html__('Before', self::$slug),
            )
        );

        $this->add_responsive_control(
            'customeleaddon_img_comparison_before_label_color',
            array(
                'label' => esc_html__('Color', self::$slug),
                'type' => Controls_Manager::COLOR,
                'selectors' => array(
                    '{{WRAPPER}} .customeleaddon-image-comparison .customeleaddon-before-label' => 'color: {{VALUE}}',
                    '{{WRAPPER}} .customeleaddon-image-comparison .customeleaddon-after-label' => 'color: {{VALUE}}',
                ),
            )
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            array(
                'name' => 'customeleaddon_img_comparison_before_label_typography_group',
                'selector' => '{{WRAPPER}} .customeleaddon-image-comparison .customeleaddon-before-label',
            )
        );

        $this->add_group_control(
            Group_Control_Background::get_type(),
            array(
                'name' => 'customeleaddon_img_comparison_before_label_background_group',
                'selector' => '{{WRAPPER}} .customeleaddon-image-comparison .customeleaddon-before-label',
            )
        );

        $this->add_responsive_control(
            'customeleaddon_img_comparison_before_label_margin',
            array(
                'label' => esc_html__('Margin', self::$slug),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => array('px', '%'),
                'selectors' => array(
                    '{{WRAPPER}} .customeleaddon-image-comparison .customeleaddon-before-label' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ),
            )
        );

        $this->add_responsive_control(
            'customeleaddon_img_comparison_before_label_padding',
            array(
                'label' => esc_html__('Padding', self::$slug),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => array('px', '%'),
                'selectors' => array(
                    '{{WRAPPER}} .customeleaddon-image-comparison .customeleaddon-before-label' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ),
            )
        );
        $this->end_controls_tab();

        $this->start_controls_tab(
            'customeleaddon_img_comparison_tab_label_after',
            array(
                'label' => esc_html__('After', self::$slug),
            )
        );

        $this->add_responsive_control(
            'customeleaddon_img_comparison_after_label_color',
            array(
                'label' => esc_html__('Color', self::$slug),
                'type' => Controls_Manager::COLOR,
                'selectors' => array(
                    '{{WRAPPER}} .customeleaddon-image-comparison .customeleaddon-after-label' => 'color: {{VALUE}}',
                ),
            )
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            array(
                'name' => 'customeleaddon_img_comparison_after_label_typography_group',
                'selector' => '{{WRAPPER}} .customeleaddon-image-comparison .customeleaddon-after-label',
            )
        );

        $this->add_group_control(
            Group_Control_Background::get_type(),
            array(
                'name' => 'customeleaddon_img_comparison_after_label_background_group',
                'selector' => '{{WRAPPER}} .customeleaddon-image-comparison .customeleaddon-after-label',
            )
        );

        $this->add_responsive_control(
            'customeleaddon_img_comparison_after_label_margin',
            array(
                'label' => esc_html__('Margin', self::$slug),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => array('px', '%'),
                'selectors' => array(
                    '{{WRAPPER}} .customeleaddon-image-comparison .customeleaddon-after-label' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ),
            )
        );

        $this->add_responsive_control(
            'customeleaddon_img_comparison_after_label_padding',
            array(
                'label' => esc_html__('Padding', self::$slug),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => array('px', '%'),
                'selectors' => array(
                    '{{WRAPPER}} .customeleaddon-image-comparison .customeleaddon-after-label' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ),
            )
        );

        $this->end_controls_tab();

        $this->end_controls_tabs();

        $this->add_control(
            'customeleaddon_img_comparison_show_label_animation',
            array(
                'label' => esc_html__('Show Animation', self::$slug),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => esc_html__('Show', self::$slug),
                'label_off' => esc_html__('Hide', self::$slug),
                'return_value' => 'yes',
                'default' => 'no',
            )
        );

        $this->end_controls_section();

        /**
         * Handle Style Section
         */
        $this->start_controls_section(
            'customeleaddon_img_comparison_handle_style',
            array(
                'label' => esc_html__('Handle', self::$slug),
                'tab' => Controls_Manager::TAB_STYLE,
                'show_label' => false,
            )
        );
        $this->add_control(
            'customeleaddon_img_comparison_handle_button_type',
            array(
                'label' => esc_html__('Button Type', self::$slug),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => esc_html__('Arrow', self::$slug),
                'label_off' => esc_html__('Square', self::$slug),
                'return_value' => 'yes',
                'default' => 'yes',
            )
        );

        $this->add_responsive_control(
            'customeleaddon_img_comparison_handle_control_position',
            array(
                'label' => esc_html__('Control Starting Position', self::$slug),
                'type' => Controls_Manager::SLIDER,
                'size_units' => array('%'),
                'range' => array(
                    '%' => array(
                        'min' => 0,
                        'max' => 100,
                    ),
                ),
                'default' => array(
                    'unit' => '%',
                    'size' => 50,
                ),
                'selectors' => array(
                    '{{WRAPPER}} .image-container-wrapper' => '--position: {{SIZE}}{{UNIT}};',
                )
            )
        );
        $this->add_control(
            'customeleaddon_control_color',
            [
                'label' => esc_html__('Control Color 1', self::$slug),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .divider-square::before' => 'background-color: {{VALUE}}',
                    '{{WRAPPER}} .divider-square::after' => 'background-color: {{VALUE}}',
                    '{{WRAPPER}} .divider-arrow' => 'background-color: {{VALUE}}',
                ],
                'default' => 'rgba(255, 255, 255, 1)',
            ]
        );
        $this->add_control(
            'customeleaddon_control_color_2',
            [
                'label' => esc_html__('Control Color 2', self::$slug),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .divider-square.draggable::after' => 'background-color: {{VALUE}}',
                    '{{WRAPPER}} .divider-arrow' => 'color: {{VALUE}}',
                ],
                'default' => 'rgba(46, 46, 46, 1)',
            ]
        );
        $this->add_control(
            'customeleaddon_control_color_3',
            [
                'label' => esc_html__('Control Color 3 (Focused)', self::$slug),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .divider-arrow.draggable' => 'background-color: {{VALUE}}',
                ],
                'default' => 'rgba(255, 255, 255, 0.8)',
            ]
        );
        $this->add_control(
            'customeleaddon_control_color_4',
            [
                'label' => esc_html__('Divider Color', self::$slug),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .slider-line' => 'background-color: {{VALUE}}',
                ],
                'default' => 'rgba(255, 255, 255, 0.2)',
            ]
        );
        $this->end_controls_section();
    }

    protected function render()
    {
        $settings = $this->get_settings();
        $beforeImageId = 'customeleaddon_img_comparison_image_before';
        $afterImageId = 'customeleaddon_img_comparison_image_after';
        $b_image_html = '';
        $a_image_html = '';
        if (!empty($settings[$beforeImageId]['url'])) {
            $b_image_html = Group_Control_Image_Size::get_attachment_image_html($settings, 'thumbnail', $beforeImageId);
        }
        if (!empty($settings[$afterImageId]['url'])) {
            $a_image_html = Group_Control_Image_Size::get_attachment_image_html($settings, 'thumbnail', $afterImageId);
        }
        $b_text = '';
        if (!empty($settings['customeleaddon_img_comparison_label_before'])) {
            $b_text = '<div class="text-overlay customeleaddon-before-label">' .
                $settings['customeleaddon_img_comparison_label_before'] . '</div>';
        }
        $a_text = '';
        if (!empty($settings['customeleaddon_img_comparison_label_after'])) {
            $a_text = '<div class="text-overlay customeleaddon-after-label">' .
                $settings['customeleaddon_img_comparison_label_after'] . '</div>';
        }
        $text_animation_class = 'text-anim-disabled';
        if ('yes' === $settings['customeleaddon_img_comparison_show_label_animation']) {
            $text_animation_class = 'text-anim-enabled';
        }

        $handle_button_html = '<div class="divider divider-square" aria-hidden="true"></div>';
        if ('yes' === $settings['customeleaddon_img_comparison_handle_button_type']) {
            $handle_button_html = '
        <div class="divider divider-arrow" aria-hidden="true">
            <svg version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                x="0px" y="0px" width="32px" height="32px" viewBox="0 0 32 32" enable-background="new 0 0 32 32"
                xml:space="preserve">
                <polygon fill="currentColor" points="13,21 8,16 13,11 " />
                <polygon fill="currentColor" points="19,11 24,16 19,21 " />
            </svg>
        </div>';
        }

        $controls_default_position = 50;
        if (!empty($settings['customeleaddon_img_comparison_handle_control_position']["size"])) {
            $controls_default_position = $settings['customeleaddon_img_comparison_handle_control_position']["size"];
        }
        ?>
        <div class="customeleaddon-image-comparison <?php echo $text_animation_class; ?>">
            <?php echo $a_text; ?>
            <?php echo $a_image_html; ?>
            <div class="after-section">
                <?php echo $b_image_html; ?>
                <?php echo $b_text; ?>
            </div>
            <!-- sliders -->
            <input type="range" min="0" max="100" value="<?php echo $controls_default_position; ?>"
                aria-label="Percentage of before photo shown" class="slider" />
            <div class="slider-line" aria-hidden="true"></div>
            <?php echo $handle_button_html; ?>
        </div>

        <?php
    }
}