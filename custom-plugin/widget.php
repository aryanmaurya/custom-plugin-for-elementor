<?php
namespace CUSTOM;

use Elementor\Repeater;
use Elementor\Widget_Base;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class Custom_block_Widget extends Widget_Base {

	public static $slug = 'heading-with-subtitle';

	public function get_name() { return self::$slug; }

	public function get_title() { return __('Heading With Subtitle', self::$slug); }

	public function get_icon() { return 'fas fa-heading'; }

	public function get_categories() { return [ 'basic' ]; }

	protected function _register_controls(){
		// Title Content START
		$this->start_controls_section(
			'content_section_title',
			[
				'label'	=> __('Title Option', self::$slug),
				'tab'	=> \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);

		$this->add_control(
			'title',
			[
				'label'	=>	__('Title', self::$slug),
				'type' => \Elementor\Controls_Manager::TEXTAREA,
				'rows' => 4,
				'default'	=> __('Add Heading Text Here', self::$slug),
				'placeholder'	=> __('Enter Your Title', self::$slug),
			]
		);

		$this->add_control(
			'hr',
			[
				'type' => \Elementor\Controls_Manager::DIVIDER,
			]
		);

		$this->add_control(
			'title_link',
			[
				'label' => __( 'Link', self::$slug ),
				'type' => \Elementor\Controls_Manager::URL,
				'placeholder' => __( 'https://your-link.com', self::$slug),
				'show_external' => true,
				'default' => [
					'url' => '',
					'is_external' => true,
					'nofollow' => true,
				],
			]
		);

		$this->add_control(
			'text_align',
			[
				'label' => __( 'Alignment', self::$slug),
				'type' => \Elementor\Controls_Manager::CHOOSE,
				'options' => [
					'left' => [
						'title' => __( 'Left', self::$slug),
						'icon' => 'fa fa-align-left',
					],
					'center' => [
						'title' => __( 'Center', self::$slug),
						'icon' => 'fa fa-align-center',
					],
					'right' => [
						'title' => __( 'Right', self::$slug),
						'icon' => 'fa fa-align-right',
					],
				],
				'default' => 'left',
				'toggle' => true,
			]
		);

		$this->add_control(
			'html_tag',
			[
				'label' => __( 'HTML Tag', self::$slug ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'default' => 'h2',
				'options' => [
					'h1'  => __( 'H1', self::$slug ),
					'h2'  => __( 'H2', self::$slug ),
					'h3'  => __( 'H3', self::$slug ),
					'h4'  => __( 'H4', self::$slug ),
					'h5'  => __( 'H5', self::$slug ),
					'h6'  => __( 'H6', self::$slug ),
					'div'  => __( 'div', self::$slug ),
					'span'  => __( 'span', self::$slug ),
					'p'  => __( 'p', self::$slug ),
				],
			]
		);

		$this->end_controls_section();
		// Title Content END

		// Title Style Setting Start
		$this->start_controls_section(
			'style_section_title',
			[
				'label' => __('Title', self::$slug),
				'tab' => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'style_value_title',
			[
				'label'	=> __('Text Color', self::$slug),
				'type' => \Elementor\Controls_Manager::COLOR,
				'scheme' => [
					'type' => \Elementor\Scheme_Color::get_type(),
					'value' => \Elementor\Scheme_Color::COLOR_1,
				],
				'selectors' => [
					'{{WRAPPER}} .title' => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => 'title_typography',
				'label' => __( 'Typography', self::$slug),
				'scheme' => \Elementor\Scheme_Typography::TYPOGRAPHY_1,
				'selector' => '{{WRAPPER}} .title',
			]
		);

		$this->add_control(
			'margin',
			[
				'label' => __( 'Margin', self::$slug),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .title' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_section();
		// Title Style Setting END
		

		//Subtitle Content START
		$this->start_controls_section(
			'content_section_subtitle',
			[
				'label'	=> __('Subtitle Option', self::$slug),
				'tab'	=> \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);

		$this->add_control(
			'subtitle',
			[
				'label'	=>	__('Sub Title', self::$slug),
				'type' => \Elementor\Controls_Manager::TEXTAREA,
				'rows' => 4,
				'default'	=> __('Add Sub Title Text Here', self::$slug),
				'placeholder'	=>	__('Enter Sub Title', self::$slug),
			]
		);

		$this->end_controls_section();
		// Subtitle Content END

		// Subtitle Style Setting Start
		$this->start_controls_section(
			'style_section_subtitle',
			[
				'label' => __('Sub Title', self::$slug),
				'tab' => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'style_value_subtitle',
			[
				'label'	=> __('Text Color', self::$slug),
				'type' => \Elementor\Controls_Manager::COLOR,
				'scheme' => [
					'type' => \Elementor\Scheme_Color::get_type(),
					'value' => \Elementor\Scheme_Color::COLOR_1,
				],
				'selectors' => [
					'{{WRAPPER}} .subtitle' => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => 'subtitle_typography',
				'label' => __( 'Typography', self::$slug),
				'scheme' => \Elementor\Scheme_Typography::TYPOGRAPHY_2,
				'selector' => '{{WRAPPER}} .subtitle',
			]
		);

		$this->end_controls_section();
		//Subtitle Style Setting END
	}

	protected function render(){
		$settings = $this->get_settings_for_display();
		$target = $settings['title_link']['is_external'] ? 'target="_blank"' : '';
		$titleurl = $settings['title_link']['url'];

		if (!empty($titleurl)) {
			echo '<'.$settings['html_tag'].' class="title" style="text-align:'.$settings['text_align'].'"><a style="color: inherit;" href="'.$settings['title_link']['url'].'" '.$target.'>'.$settings['title'].'</a></'.$settings['html_tag'].'>';
		}
		else{
			echo '<'.$settings['html_tag'].' class="title" style="text-align:'.$settings['text_align'].'">'.$settings['title'].'</'.$settings['html_tag'].'>';
		}
		echo '<h6 class="subtitle">'.$settings['subtitle'].'</h6>';
	}

}