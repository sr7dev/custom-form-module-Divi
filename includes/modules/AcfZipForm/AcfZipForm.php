<?php

class acf_zip_form_Module extends ET_Builder_Module {
	function init() {
		$this->name            = esc_html__( 'ACF ZIP Form', 'et_builder' );
		$this->plural          = esc_html__( 'ACF ZIP Forms', 'et_builder' );
		$this->slug            = 'acf_zip_form';
		$this->vb_support      = 'on';
		
		$this->main_css_element = '%%order_class%% .acf_zip_form_container';

		$this->advanced_fields = array(
			'button'                => array(
				'button' => array(
					'label' => esc_html__( 'Button', 'et_builder' ),
					'css' => array(
						'main'	=> "
								{$this->main_css_element} 
								.et_pb_module 
								.acf_zip_button
								",
						'limited_main' => "{$this->main_css_element} .et_pb_module .acf_zip_button",
					),
					'no_rel_attr' => true,
					'box_shadow'  => array(
						'css' => array(
							'main' => '%%order_class%% .acf_zip_submit',
						),
					),
					'margin_padding' => array(
						'css' => array(
							'important' => 'all',
						),
					),
				),
			),
		);

		$this->custom_css_fields = array(
			'zip_input' => array(
				'label'    => esc_html__( 'ZIP Input Style', 'et_builder' ),
				'selector' => '%%order_class%% .acf_zip_form_validate_field',
			),
			'contact_button_size' => array(
				'label'    => esc_html__( 'Qutoes Button Size', 'et_builder' ),
				'selector' => '.acf_button_container',
			),
			'zip_button_style' => array(
				'label'    => esc_html__( 'Qutoes Button Style', 'et_builder' ),
				'selector' => '%%order_class%% .acf_button',
			),
			'zip_button_after_style' => array(
				'label'    => esc_html__( 'Qutoes Button After Style', 'et_builder' ),
				'selector' => '
							%%order_class%% .acf_button:after, 
							%%order_class%% .acf_button:before
							',
			),
			'zip_button_hover_style' => array(
				'label'    => esc_html__( 
					'Qutoes Button Hover Style', 
					'et_builder' 
				),
				'selector' => '%%order_class%% .acf_button:hover',
			),
			'zip_button_active_style' => array(
				'label'    => esc_html__( 
					'Qutoes Button Active Style', 
					'et_builder' 
				),
				'selector' => '%%order_class%% .acf_button:active',
			),
		);
	}

	function get_fields() {
		$fields = array(
			'form_id' => array(
				'label'           => esc_html__( 'Form ID', 'et_builder' ),
				'type'            => 'text',
				'option_category' => 'configuration',
				'description'     => esc_html__( 
					'Define the ID your contact form.', 
					'et_builder' 
				),
				'toggle_slug'     => 'main_content',
				'default'         => '',
			),
			'input_placeholder_text' => array(
				'label'           => esc_html__( 
					'Input Placeholder', 
					'et_builder' 
				),
				'type'            => 'text',
				'option_category' => 'basic_option',
				'description'     => esc_html__( 
					'Define the text of the form submit button.', 
					'et_builder' 
				),
				'toggle_slug'     => 'main_content',
				'dynamic_content' => 'text',
			),
			'submit_button_text' => array(
				'label'           => esc_html__( 
					'Submit Button', 
					'et_builder' 
				),
				'type'            => 'text',
				'option_category' => 'basic_option',
				'description'     => esc_html__( 
					'Define the text of the form submit button.', 
					'et_builder' 
				),
				'toggle_slug'     => 'main_content',
				'dynamic_content' => 'text',
			),
			'action_url' => array(
				'label'           => esc_html__( 'Action Link', 'et_builder' ),
				'type'            => 'text',
				'option_category' => 'configuration',
				'description'     => esc_html__( 
					'Define the target link.', 
					'et_builder' 
				),
				'toggle_slug'     => 'main_content',
				'dynamic_content' => 'text',
				'default'         => '/medicare-plan-form?src=lp',
			),
		);

		return $fields;
	}

	function render( $attrs, $content = null, $render_slug ) {
		global $acf_form_num;

		$acf_form_num = 0;

		$submit_button_text          = $this->props['submit_button_text'];
		$button_custom               = $this->props['custom_button'];
		// $button_rel                  = $this->props['button_rel'];
		// $button_url                  = $this->props['button_url'];
		// $url_new_window              = $this->props['url_new_window'];
		$custom_icon_values          = et_pb_responsive_options()->get_property_values( $this->props, 'button_icon' );
		$custom_icon = 
			isset( $custom_icon_values['desktop'] ) 
				? $custom_icon_values['desktop'] 
				: '';
		$custom_icon_tablet = 
			isset( $custom_icon_values['tablet'] ) 
				? $custom_icon_values['tablet'] 
				: '';
		$custom_icon_phone = 
			isset( $custom_icon_values['phone'] ) 
				? $custom_icon_values['phone'] 
				: '';


		$form_id = $this->props['form_id'];
		$placeholder = $this->props['input_placeholder_text'];
		$actionUrl = $this->props['action_url'];

		$acf_form_num = $this->render_count();

		wp_enqueue_style( 
			'acf-zip-form', 
			plugins_url('/mrccta_v3/includes/modules/style.css') 
		);
		wp_enqueue_script( 
			'zipForm-register', 
			plugins_url('/mrccta_v3/js/script.js')
		);
		// wp_enqueue_script( 
		// 	'lead_api_script', 
		// 	plugins_url('/mrccta_v2/js/script.js')//, 
		// 	// array('zipForm-register')
		// );
		wp_localize_script( 
			'lead_api_script', 
			'shortFormAjax', 
			['ajax_url' => admin_url('admin-ajax.php')] 
		);
		$output = sprintf( '
			<form 
				class="acf_zip_form clearfix acf_zip_form_container" 
				target="_self" 
				method="post" 
				action="%3$s" 
				id="%1$s"
				%9$s
			>
				<input type="hidden" value="et_contact_proccess" />
				<input 
					name="fields[zip][value]" 
					class="acf_zip_form_validate_field" 
					id="input_%1$s" 
					pattern="\d{5}" 
					type="tel" 
					placeholder="%4$s"
				/>
				<div class="acf_button_container">
					<button 
						id="button_%1$s" 
						type="submit" 
						class="acf_zip_submit acf_button%6$s" 
						%5$s%7$s%8$s
					>
						%2$s
					</button>
				</div>
			</form><!-- .acf_zip_form_container -->
			',
			$form_id, // #1
			esc_html( $submit_button_text ), // #2
			$actionUrl, // #3
			$placeholder, // #4
			'' !== $custom_icon && 'on' === $button_custom 
				? sprintf(
					' data-icon="%1$s"',
					esc_attr( et_pb_process_font_icon( $custom_icon ) )
				) 
				: '', // #5
			'' !== $custom_icon && 'on' === $button_custom 
				? ' acf_custom_button_icon' 
				: '', // #6
			'' !== $custom_icon_tablet && 'on' === $button_custom 
				? sprintf( 
					' data-icon-tablet="%1$s"', 
					esc_attr( et_pb_process_font_icon( $custom_icon_tablet ) ) 
				) 
				: '', // #7
			'' !== $custom_icon_phone && 'on' === $button_custom 
				? sprintf( 
					' data-icon-phone="%1$s"', 
					esc_attr( et_pb_process_font_icon( $custom_icon_phone ) ) 
				) 
				: '', // #8
			"onSubmit='return zipFormAction(".wp_json_encode($form_id).")'"
		);

		return $output;
	}
}

new acf_zip_form_Module;