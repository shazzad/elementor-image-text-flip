<?php
/**
 * Class Elementor_Image_Text_Flip_Widget
 * Custom elementor widget
 */

class Elementor_Image_Text_Flip_Widget extends \Elementor\Widget_Base {

	/**
	 * Get Name
	 *
	 * Return the action name
	 *
	 * @access public
	 * @return string
	 */
	public function get_name() {
		return 'elementor-image-text-flip';
	}

	/**
	 * Get Label
	 *
	 * Returns the action label
	 *
	 * @access public
	 * @return string
	 */
	public function get_title() {
		return __( 'Image Text Flip', 'eitf' );
	}


    public function get_icon() {
		return 'eicon-insert-image';
	}

    public function get_categories() {
        return [ 'general' ];
    }

	/**
	 * Register Settings Section
	 *
	 * Registers the Action controls
	 *
	 * @access public
	 * @param \Elementor\Widget_Base $widget
	 */
	public function _register_controls() {

        $this->_setting_controls();
        $this->_button_controls();
        $this->_image_controls();
        $this->_content_controls();

        // style options
        $this->_button_styles_controls();
        $this->_image_styles_controls();
        $this->_content_styles_controls();
	}

    public function _setting_controls() {
        $this->start_controls_section(
            'section_content',
            [
                'label' => __('Settings', 'elementor'),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );
        $this->add_control(
            'layout',
            [
                'label' => __( 'Layout', 'elementor' ),
                'type' => \Elementor\Controls_Manager::SELECT,
                'label_block' => false,
                'options' => [
                    'content_button' => 'Content + Button',
                    'button_content' => 'Button + Content',
                ],
                'default' => 'content_button',
            ]
        );
        $this->add_control(
            'effect',
            [
                'label' => __( 'Animation', 'elementor' ),
                'type' => \Elementor\Controls_Manager::SELECT,
                'label_block' => false,
                'options' => [
                    'slide' => 'Slide',
                    'fade' => 'Fade',
                    'none' => 'None'
                ],
                'default' => 'slide',
            ]
        );
        $this->add_control(
			'effect_duration',
			[
				'label'     => __( 'Animation duration', 'eitf' ),
				'type'      => \Elementor\Controls_Manager::TEXT,
                'default'   => '1000',
                'description'  => 'in milliseconds'
			]
		);
        $this->end_controls_section();
    }
    public function _button_controls() {
        $this->start_controls_section(
			'button_section',
			[
                'label' => __('Button', 'elementor'),
				'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);
        $this->add_control(
			'button_type',
			[
				'label' => __( 'Type', 'elementor' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'default' => '',
				'options' => [
					'' => __( 'Default', 'elementor' ),
					'info' => __( 'Info', 'elementor' ),
					'success' => __( 'Success', 'elementor' ),
					'warning' => __( 'Warning', 'elementor' ),
					'danger' => __( 'Danger', 'elementor' ),
				],
				'prefix_class' => 'elementor-button-',
			]
		);
        $this->add_control(
			'button_text',
			[
				'label' => __( 'Text', 'elementor' ),
				'type' => \Elementor\Controls_Manager::TEXT
			]
		);
        $this->add_control(
			'button_size',
			[
				'label' => __( 'Size', 'elementor' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'default' => 'sm',
				'options' => \Elementor\Widget_Button::get_button_sizes(),
				'style_transfer' => true,
			]
		);

        $this->add_control(
            'close_icon_source',
            [
                'label' => __( 'Icon source', 'eitf' ),
                'type' => \Elementor\Controls_Manager::SELECT,
                'label_block' => false,
                'options' => [
                    'icon' => 'FontAwesome',
                    'image' => 'Image',
                ],
                'default' => 'icon',
            ]
        );
		$this->add_control(
			'close_icon_icon',
			[
				'label' => __( 'Icon', 'eitf' ),
				'type' => \Elementor\Controls_Manager::ICON,
				'default' => 'fa fa-plus',
                'condition' => [
					'close_icon_source' => 'icon',
				]
			]
		);
        $this->add_control(
			'close_icon_image',
			[
				'label' => __( 'Icon', 'elementor' ),
				'type' => \Elementor\Controls_Manager::MEDIA,
                'condition' => [
					'close_icon_source' => 'image',
				]
			]
		);
        $this->add_control(
            'open_icon_source',
            [
                'label' => __( 'Icon source (open)', 'eitf' ),
                'type' => \Elementor\Controls_Manager::SELECT,
                'label_block' => false,
                'options' => [
                    'icon' => 'FontAwesome',
                    'image' => 'Image',
                ],
                'default' => 'icon',
            ]
        );
        $this->add_control(
			'open_icon_icon',
			[
				'label' => __( 'Icon (open)', 'eitf' ),
                'type' => \Elementor\Controls_Manager::ICON,
				'default' => 'fa fa-facebook',
                'condition' => [
					'open_icon_source' => 'icon',
				]
			]
		);
        $this->add_control(
			'open_icon_image',
			[
				'label' => __( 'Icon (open)', 'eitf' ),
				'type' => \Elementor\Controls_Manager::MEDIA,
                'condition' => [
					'open_icon_source' => 'image',
				]
			]
		);

        $this->add_control(
			'button_icon_align',
			[
				'label' => __( 'Icon Position', 'elementor' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'label_block' => false,
				'options' => [
					'left' => 'Before',
                    'right' => 'After',
				],
				'default' => 'left',
			]
		);

		$this->add_control(
			'button_icon_indent',
			[
				'label' => __( 'Icon Spacing', 'elementor' ),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'max' => 50,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .elementor-button .elementor-align-icon-right' => 'margin-left: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .elementor-button .elementor-align-icon-left' => 'margin-right: {{SIZE}}{{UNIT}};',
				],
			]
		);

        $this->end_controls_section();
    }
    public function _image_controls() {
        $this->start_controls_section(
			'image_section',
			[
                'label' => __('Image', 'asifa'),
				'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);
        $this->add_control(
			'image',
			[
				'label' => __( 'Image', 'elementor' ),
				'type' => \Elementor\Controls_Manager::MEDIA
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Image_Size::get_type(),
			[
				'name' => 'image',
				'default' => 'large',
				'separator' => 'none',
			]
		);
        $this->end_controls_section();

    }
    public function _content_controls() {
        $this->start_controls_section(
			'text_section',
			[
                'label' => __('Content', 'asifa'),
				'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);
        $this->add_control(
			'text',
			[
				'label' => __( 'Text', 'elementor' ),
				'type' => \Elementor\Controls_Manager::WYSIWYG,
                'default' => __( 'Default description', 'plugin-domain' ),
				'placeholder' => __( 'Type your description here', 'plugin-domain' )
			]
		);
		$this->end_controls_section();

    }

    public function _content_styles_controls() {
        $this->start_controls_section(
			'content_section_style',
			[
				'label' => __( 'Content', 'elementor' ),
				'tab' => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_responsive_control(
			'content_align',
			[
				'label' => __( 'Alignment', 'elementor' ),
				'type' => \Elementor\Controls_Manager::CHOOSE,
				'options' => [
					'left' => [
						'title' => __( 'Left', 'elementor' ),
						'icon' => 'fa fa-align-left',
					],
					'center' => [
						'title' => __( 'Center', 'elementor' ),
						'icon' => 'fa fa-align-center',
					],
					'right' => [
						'title' => __( 'Right', 'elementor' ),
						'icon' => 'fa fa-align-right',
					],
					'justify' => [
						'title' => __( 'Justified', 'elementor' ),
						'icon' => 'fa fa-align-justify',
					],
				],
				'selectors' => [
					'{{WRAPPER}} .elementor-text-editor' => 'text-align: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'content_text_color',
			[
				'label' => __( 'Text Color', 'elementor' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .elementor-text-editor' => 'color: {{VALUE}};',
				],
				'scheme' => [
					'type' => \Elementor\Scheme_Color::get_type(),
					'value' => \Elementor\Scheme_Color::COLOR_3,
				],
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => 'content_typography',
				'scheme' => \Elementor\Scheme_Typography::TYPOGRAPHY_3,
			]
		);

        $this->add_group_control(
			\Elementor\Group_Control_Border::get_type(),
			[
				'name' => 'content_border',
				'placeholder' => '1px',
				'default' => '1px',
				'selector' => '{{WRAPPER}} .elementor-text-editor',
				'separator' => 'before',
			]
		);

		$this->add_control(
			'content_border_radius',
			[
				'label' => __( 'Border Radius', 'elementor' ),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%' ],
				'selectors' => [
					'{{WRAPPER}} .elementor-text-editor' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'content_box_shadow',
				'selector' => '{{WRAPPER}} .elementor-text-editor',
			]
		);

		$this->add_responsive_control(
			'content_padding',
			[
				'label' => __( 'Padding', 'elementor' ),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors' => [
					'{{WRAPPER}} .elementor-text-editor' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				'separator' => 'before',
			]
		);

		$this->add_responsive_control(
			'content_margin',
			[
				'label' => __( 'Margin', 'elementor' ),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors' => [
					'{{WRAPPER}} .elementor-text-editor' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				'separator' => 'before',
			]
		);

		$this->end_controls_section();
    }
    public function _button_styles_controls() {
        $this->start_controls_section(
			'section_style',
			[
				'label' => __( 'Button', 'elementor' ),
				'tab' => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_responsive_control(
			'button_align',
			[
				'label' => __( 'Alignment', 'elementor' ),
				'type' => \Elementor\Controls_Manager::CHOOSE,
				'options' => [
					'left' => [
						'title' => __( 'Left', 'elementor' ),
						'icon' => 'fa fa-align-left',
					],
					'center' => [
						'title' => __( 'Center', 'elementor' ),
						'icon' => 'fa fa-align-center',
					],
					'right' => [
						'title' => __( 'Right', 'elementor' ),
						'icon' => 'fa fa-align-right',
					],
					'justify' => [
						'title' => __( 'Justified', 'elementor' ),
						'icon' => 'fa fa-align-justify',
					],
				],
				'selectors' => [
					'{{WRAPPER}} a.elementor-button' => 'text-align: {{VALUE}};',
                    '{{WRAPPER}} .elementor-button' => 'text-align: {{VALUE}};',
				],
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => 'button_typography',
				'scheme' => \Elementor\Scheme_Typography::TYPOGRAPHY_4,
				'selector' => '{{WRAPPER}} a.elementor-button, {{WRAPPER}} .elementor-button',
			]
		);

        $this->start_controls_tabs( 'tabs_button_style' );
		$this->start_controls_tab(
			'tab_button_normal',
			[
				'label' => __( 'Normal', 'elementor' ),
			]
		);

        $this->add_control(
			'button_text_color',
			[
				'label' => __( 'Text Color', 'elementor' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} a.elementor-button, {{WRAPPER}} .elementor-button' => 'color: {{VALUE}};',
				],
			]
		);
		$this->add_control(
			'background_color',
			[
				'label' => __( 'Background Color', 'elementor' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'scheme' => [
					'type' => \Elementor\Scheme_Color::get_type(),
					'value' => \Elementor\Scheme_Color::COLOR_4,
				],
				'selectors' => [
					'{{WRAPPER}} a.elementor-button, {{WRAPPER}} .elementor-button' => 'background-color: {{VALUE}};',
				],
			]
		);

		$this->end_controls_tab();
		$this->start_controls_tab(
			'tab_button_hover',
			[
				'label' => __( 'Hover', 'elementor' ),
			]
		);
        $this->add_control(
			'hover_color',
			[
				'label' => __( 'Text Color', 'elementor' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} a.elementor-button:hover, {{WRAPPER}} .elementor-button:hover' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'button_background_hover_color',
			[
				'label' => __( 'Background Color', 'elementor' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} a.elementor-button:hover, {{WRAPPER}} .elementor-button:hover' => 'background-color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'button_hover_border_color',
			[
				'label' => __( 'Border Color', 'elementor' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'condition' => [
					'border_border!' => '',
				],
				'selectors' => [
					'{{WRAPPER}} a.elementor-button:hover, {{WRAPPER}} .elementor-button:hover' => 'border-color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'button_hover_animation',
			[
				'label' => __( 'Hover Animation', 'elementor' ),
				'type' => \Elementor\Controls_Manager::HOVER_ANIMATION,
			]
		);
        $this->end_controls_tab();
		$this->end_controls_tabs();

        $this->add_group_control(
			\Elementor\Group_Control_Border::get_type(),
			[
				'name' => 'border',
				'placeholder' => '1px',
				'default' => '1px',
				'selector' => '{{WRAPPER}} .elementor-button',
				'separator' => 'before',
			]
		);

		$this->add_control(
			'border_radius',
			[
				'label' => __( 'Border Radius', 'elementor' ),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%' ],
				'selectors' => [
					'{{WRAPPER}} a.elementor-button, {{WRAPPER}} .elementor-button' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'button_box_shadow',
				'selector' => '{{WRAPPER}} a.elementor-button',
			]
		);

		$this->add_responsive_control(
			'button_padding',
			[
				'label' => __( 'Padding', 'elementor' ),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors' => [
					'{{WRAPPER}} a.elementor-button, {{WRAPPER}} .elementor-button' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				'separator' => 'before',
			]
		);

        $this->add_responsive_control(
			'button_width',
			[
				'label' => __( 'Width', 'elementor' ),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'default' => [
					'unit' => '%',
				],
				'tablet_default' => [
					'unit' => '%',
				],
				'mobile_default' => [
					'unit' => '%',
				],
				'size_units' => [ '%', 'px', 'vw' ],
				'range' => [
					'%' => [
						'min' => 1,
						'max' => 100,
					],
					'px' => [
						'min' => 1,
						'max' => 1000,
					],
					'vw' => [
						'min' => 1,
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}} a.elementor-button' => 'width: {{SIZE}}{{UNIT}};',
				],
			]
		);

        $this->end_controls_section();
    }
    public function _image_styles_controls() {

		$this->start_controls_section(
			'section_style_image',
			[
				'label' => __( 'Image', 'elementor' ),
				'tab' => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_responsive_control(
			'image_width',
			[
				'label' => __( 'Width', 'elementor' ),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'default' => [
					'unit' => '%',
				],
				'tablet_default' => [
					'unit' => '%',
				],
				'mobile_default' => [
					'unit' => '%',
				],
				'size_units' => [ '%', 'px', 'vw' ],
				'range' => [
					'%' => [
						'min' => 1,
						'max' => 100,
					],
					'px' => [
						'min' => 1,
						'max' => 1000,
					],
					'vw' => [
						'min' => 1,
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .elementor-image img' => 'width: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'image_space',
			[
				'label' => __( 'Max Width', 'elementor' ) . ' (%)',
				'type' => \Elementor\Controls_Manager::SLIDER,
				'default' => [
					'unit' => '%',
				],
				'tablet_default' => [
					'unit' => '%',
				],
				'mobile_default' => [
					'unit' => '%',
				],
				'size_units' => [ '%' ],
				'range' => [
					'%' => [
						'min' => 1,
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .elementor-image img' => 'max-width: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'separator_panel_style',
			[
				'type' => \Elementor\Controls_Manager::DIVIDER,
				'style' => 'thick',
			]
		);

		$this->start_controls_tabs( 'image_effects' );

		$this->start_controls_tab( 'image_normal',
			[
				'label' => __( 'Normal', 'elementor' ),
			]
		);

		$this->add_control(
			'image_opacity',
			[
				'label' => __( 'Opacity', 'elementor' ),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'max' => 1,
						'min' => 0.10,
						'step' => 0.01,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .elementor-image img' => 'opacity: {{SIZE}};',
				],
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Css_Filter::get_type(),
			[
				'name' => 'image_css_filters',
				'selector' => '{{WRAPPER}} .elementor-image img',
			]
		);

		$this->end_controls_tab();

		$this->start_controls_tab( 'image_hover',
			[
				'label' => __( 'Hover', 'elementor' ),
			]
		);

		$this->add_control(
			'image_opacity_hover',
			[
				'label' => __( 'Opacity', 'elementor' ),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'max' => 1,
						'min' => 0.10,
						'step' => 0.01,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .elementor-image:hover img' => 'opacity: {{SIZE}};',
				],
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Css_Filter::get_type(),
			[
				'name' => 'image_css_filters_hover',
				'selector' => '{{WRAPPER}} .elementor-image:hover img',
			]
		);

		$this->add_control(
			'image_background_hover_transition',
			[
				'label' => __( 'Transition Duration', 'elementor' ),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'max' => 3,
						'step' => 0.1,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .elementor-image img' => 'transition-duration: {{SIZE}}s',
				],
			]
		);

		$this->add_control(
			'image_hover_animation',
			[
				'label' => __( 'Hover Animation', 'elementor' ),
				'type' => \Elementor\Controls_Manager::HOVER_ANIMATION,
			]
		);

		$this->end_controls_tab();
		$this->end_controls_tabs();

		$this->add_group_control(
			\Elementor\Group_Control_Border::get_type(),
			[
				'name' => 'image_border',
				'selector' => '{{WRAPPER}} .elementor-image img',
				'separator' => 'before',
			]
		);

		$this->add_responsive_control(
			'image_border_radius',
			[
				'label' => __( 'Border Radius', 'elementor' ),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%' ],
				'selectors' => [
					'{{WRAPPER}} .elementor-image img' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'image_box_shadow',
				'exclude' => [
					'box_shadow_position',
				],
				'selector' => '{{WRAPPER}} .elementor-image img',
			]
		);

		$this->end_controls_section();
    }

    protected function render() {

		$settings = $this->get_settings_for_display();
        # echo '<pre>';print_r($settings);echo '</pre>';

        $this->add_render_attribute( 'wrapper', 'class', 'eitf-wrap' );
        $this->add_render_attribute( 'wrapper', 'data-effect', $settings['effect'] );
        $this->add_render_attribute( 'wrapper', 'data-effect_duration', $settings['effect_duration'] );


        $this->add_render_attribute( 'button-wrapper', 'class', 'elementor-button-wrapper' );

        $this->add_render_attribute( 'button', 'class', 'elementor-button' );
        $this->add_render_attribute( 'button', 'class', 'eitf-button' );
        $this->add_render_attribute( 'button', 'href', '#' );
		$this->add_render_attribute( 'button', 'role', 'button' );
        if ( ! empty( $settings['button_size'] ) ) {
			$this->add_render_attribute( 'button', 'class', 'elementor-size-' . $settings['button_size'] );
		}



        $content = '';
        $content .= '<div class="eitf-content-wrap">';
        $content .= '<div class="elementor-text-editor eitf-text" style="display:none;">' . $settings['text'] . '</div>';
        $content .= '<div class="eitf-image elementor-image">' . wp_get_attachment_image($settings['image']['id'], $settings['image_size']) . '</div>';
        $content .= '</div>';

        if ('icon' == $settings['close_icon_source']) {
            $closeIcon = '<i class="close-icon '. $settings['close_icon_icon'] .'"></i>';
        } else {
            $closeIcon = '<img class="close-icon" src="'. $settings['close_icon_image']['url'] .'" />';
        }

        if ('icon' == $settings['open_icon_source']) {
            $openIcon = '<i class="open-icon '. $settings['open_icon_icon'] .'" style="display:none;"></i>';
        } else {
            $openIcon = '<img class="open-icon" style="display:none;" src="'. $settings['open_icon_image']['url'] .'" />';
        }

        $button = '<div '. $this->get_render_attribute_string( 'button-wrapper' ) . '>
        <a '. $this->get_render_attribute_string( 'button' ) . '>
        <span class="elementor-button-content-wrapper">';

        $button .= '<span class="elementor-button-icon elementor-align-icon-'. $settings['button_icon_align'] .'">'. $closeIcon . $openIcon . '</span>';
        $button .= '<span class="elementor-button-text eitf-text-wrap">'. $settings['button_text'] . '</span>';
        $button .= '</span></a></div>';


        echo '<div '. $this->get_render_attribute_string( 'wrapper' ) . '>';
        if ('button_content' == $settings['layout']) {
            echo $button . $content;
        } else {
            echo $content . $button;
        }
        echo '</div>';
	}
}
