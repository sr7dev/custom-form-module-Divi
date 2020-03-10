<?php

class mrc_plan_form_Module extends ET_Builder_Module {
	function init() {
		$this->name            = esc_html__( 'MRC Plan Form', 'et_builder' );
		$this->plural          = esc_html__( 'MRC Plan Forms', 'et_builder' );
		$this->slug            = 'mrc_plan_form';
		$this->vb_support      = 'on';
		$this->child_slug      = 'mrc_plan_form_field';
		$this->child_item_text = esc_html__( 'Field', 'et_builder' );
		
		
		$this->main_css_element = '%%order_class%%.mrc_health_savings_form_container';

		$this->settings_modal_toggles = array(
			'general'  => array(
				'toggles' => array(
					'main_content' => esc_html__( 'Text', 'et_builder' ),
					'email'        => esc_html__( 'Email', 'et_builder' ),
					'elements'     => esc_html__( 'Elements', 'et_builder' ),
					'redirect'     => esc_html__( 'Redirect', 'et_builder' ),
				),
			),
		);

		$this->advanced_fields = array(
			'borders' => array(
				'default' => array(
					'css' => array(
						'main' => array(
							'border_radii' => sprintf( 
								'%1$s .input, 
								%1$s .input[type="checkbox"] + label i, 
								%1$s .input[type="radio"] + label i', 
								$this->main_css_element 
							),
							'border_styles' => sprintf( 
								'%1$s .input, 
								%1$s .input[type="checkbox"] + label i, 
								%1$s .input[type="radio"] + label i', 
								$this->main_css_element 
							),
						),
						'important' => 'plugin_only',
					),
					'label_prefix' => esc_html__( 'Inputs', 'et_builder' ),
				),
			),
			'fonts' => array(
				'title' => array(
					'label' => esc_html__( 'Title', 'et_builder' ),
					'css' => array(
						'main' => 
						"{$this->main_css_element} h1, 
						{$this->main_css_element} h2.mrc_health_savings_main_title, 
						{$this->main_css_element} h3.mrc_health_savings_main_title, 
						{$this->main_css_element} h4.mrc_health_savings_main_title, 
						{$this->main_css_element} h5.mrc_health_savings_main_title, 
						{$this->main_css_element} h6.mrc_health_savings_main_title",
					),
					'header_level' => array(
						'default' => 'h1',
					),
				),
				'captcha' => array(
					'label' => esc_html__( 'Captcha', 'et_builder' ),
					'css' => array(
						'main' => 
							"{$this->main_css_element} 
							.mrc_health_savings_captcha_question",
					),
					'hide_text_align' => true,
					'line_height'     => array(
						'default' => '1.7em',
					),
				),
			),
			'box_shadow' => array(
				'default' => array(
					'css' => array(
						'main' => implode( ', ', array(
							'%%order_class%% .mrc_health_savings_field input',
							'%%order_class%% .mrc_health_savings_field select',
							'%%order_class%% .mrc_health_savings_field textarea',
							'%%order_class%% 
								.mrc_health_savings_field 
								.mrc_health_savings_field_options_list label > i',
							'%%order_class%% input.mrc_health_savings_captcha',
						) ),
					),
				),
			),
			'button'                => array(
				'button' => array(
					'label' => esc_html__( 'Button', 'et_builder' ),
					'css' => array(
						'main'  => "{$this->main_css_element}
							.mrc_module 
							.mrc_button",
						'limited_main' => "{$this->main_css_element}
							.mrc_module 
							.mrc_button",
					),
					'no_rel_attr' => true,
					'box_shadow'  => array(
						'css' => array(
							'main' => '%%order_class%% .mrc_health_savings_submit',
						),
					),
					'margin_padding' => array(
						'css' => array(
							'important' => 'all',
						),
					),
				),
			),
			'margin_padding' => array(
				'css' => array(
					'important' => array( 'custom_margin' ), 
				),
			),
			'max_width'             => array(
				'css' => array(
					'module_alignment' => 
					'%%order_class%%.mrc_health_savings_hero_container.mrc_module',
				),
			),
			'text' => array(
				'css' => array(
					'text_orientation' => 
						'%%order_class%% input, 
						%%order_class%% textarea, 
						%%order_class%% label',
					'text_shadow' => 
						'%%order_class%%, 
						%%order_class%% input, 
						%%order_class%% textarea, 
						%%order_class%% label, 
						%%order_class%% select',
				),
			),
			'form_field' => array(
				'form_field' => array(
					'label' => esc_html__( 'ZIP Fields', 'et_builder' ),
					'css' => array(
						'main' => '%%order_class%% 
							.mrc_shortform_validate_field',
						'important' => 'all',
					),
					'box_shadow' => false,
					'border_styles' => false,
					'font_field' => array(
						'css' => array(
							'main' => '%%order_class%% 
								.mrc_shortform_validate_field',
							'important' => 'all',
						),
					),
					'margin_padding' => array(
						'css'  => array(
							'main' => '%%order_class%% 
								.mrc_shortform_validate_field',
							'important' => 'all',
						),
					),
					'max_width' => array(
						'css' => array(
							'main' => '%%order_class%% 
								.mrc_shortform_validate_field',
							'important' => 'all',
						),
					),
				),
			),
		);

		$this->custom_css_fields = array(
			'contact_zip_input' => array(
				'label' => esc_html__( 'ZIP Input Size', 'et_builder' ),
				'selector' => '.mrc_shortform_validate_field',
			),
			'contact_button_size' => array(
				'label' => esc_html__( 'Qutoes Button Size', 'et_builder' ),
				'selector' => '.mrc_button_container',
			),
			'contact_button_style' => array(
				'label' => esc_html__( 'Qutoes Button Style', 'et_builder' ),
				'selector' => '.mrc_button',
			),
			'contact_button_hover_style' => array(
				'label' => esc_html__( 
					'Qutoes Button Hover Style', 
					'et_builder' 
				),
				'selector' => '%%order_class%% .mrc_button:hover',
			),
			'contact_button_active_style' => array(
				'label' => esc_html__( 
					'Qutoes Button Active Style', 
					'et_builder' 
				),
				'selector' => '%%order_class%% .mrc_button:active',
			),
			'error_message_style' => array(
				'label' => esc_html__( 'Error Message Style', 'et_builder' ),
				'selector' => '.mrc_health_savings_error_text',
			),
		);
	}

	function get_fields() {
		$fields = array(
			'captcha' => array(
				'label'           => esc_html__( 'Show Captcha', 'et_builder' ),
				'type'            => 'yes_no_button',
				'option_category' => 'configuration',
				'options'         => array(
					'on'  => esc_html__( 'Yes', 'et_builder' ),
					'off' => esc_html__( 'No', 'et_builder' ),
				),
				'toggle_slug'     => 'elements',
				'description'     => esc_html__( 
					'Turn the captcha on or off using this option.', 
					'et_builder' 
				),
				'default_on_front' => 'on',
			),
			'email' => array(
				'label'           => esc_html__( 
					'Email Address', 
					'et_builder' 
				),
				'type'            => 'text',
				'option_category' => 'basic_option',
				'description'     => esc_html__( 
					'Input email address.', 
					'et_builder' 
				),
				'toggle_slug'     => 'email',
			),
			'form_id' => array(
				'label'           => esc_html__( 'Form ID', 'et_builder' ),
				'type'            => 'text',
				'option_category' => 'basic_option',
				'description'     => esc_html__( 
					'Define the ID your contact form.', 
					'et_builder' 
				),
				'toggle_slug'     => 'main_content',
				'dynamic_content' => 'text',
				'default'         => 'quoteForm',
			),
			// 'input_id' => array(
			// 	'label'           => esc_html__( 'Input ID', 'et_builder' ),
			// 	'type'            => 'text',
			// 	'option_category' => 'configuration',
			// 	'description'     => esc_html__(
			// 		'Define the ID your contact form input.', 
			// 		'et_builder' 
			// 	),
			// 	'toggle_slug'     => 'main_content',
			// 	'default'         => 'zip',
			// ),
			'use_redirect' => array(
				'label'           => esc_html__( 
					'Enable Redirect URL', 
					'et_builder' 
				),
				'type'            => 'yes_no_button',
				'option_category' => 'configuration',
				'options'         => array(
					'off' => esc_html__( 'No', 'et_builder' ),
					'on'  => esc_html__( 'Yes', 'et_builder' ),
				),
				'affects' => array(
					'redirect_url',
				),
				'toggle_slug'     => 'redirect',
				'description'     => esc_html__( 
					'Redirect users after successful form submission.', 
					'et_builder' 
				),
				'default_on_front' => 'off',
			),
			'redirect_url' => array(
				'label'           => esc_html__( 'Redirect URL', 'et_builder' ),
				'type'            => 'text',
				'option_category' => 'configuration',
				'depends_show_if' => 'on',
				'toggle_slug'     => 'redirect',
				'description'     => esc_html__( 
					'Type the Redirect URL', 
					'et_builder' 
				),
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
			'submit_button_id' => array(
				'label'           => esc_html__( 
					'Submit Button ID', 
					'et_builder' 
				),
				'type'            => 'text',
				'option_category' => 'configuration',
				'description'     => esc_html__( 
					'Define the text of the form submit button id.', 
					'et_builder' 
				),
				'toggle_slug'     => 'main_content',
				'dynamic_content' => 'text',
				'default'         => 'submitShortForm_v2',
			),
		);

		return $fields;
	}

	public function get_transition_fields_css_props() {
		$fields = parent::get_transition_fields_css_props();

		$fields['form_field_background_color'] = array(
			'background-color' => implode(', ', array(
				'%%order_class%% .input',
				'%%order_class%% .input[type="checkbox"]+label i',
				'%%order_class%% .input[type="radio"]+label i',
			))
		);

		return $fields;
	}

	function predefined_child_modules() {
		$output = sprintf(
			'[mrc_health_savings_field 
				field_title="%1$s" 
				field_type="input" 
				field_id="Name" 
				required_mark="on" 
				fullwidth_field="off" 
			/]
			[mrc_health_savings_field 
				field_title="%2$s" 
				field_type="email" 
				field_id="Email" 
				required_mark="on" 
				fullwidth_field="off" 
			/]
			[mrc_health_savings_field 
				field_title="%3$s" 
				field_type="text" 
				field_id="Message" 
				required_mark="on" 
				fullwidth_field="on" 
			/]',
			esc_attr__( 'Name', 'et_builder' ),
			esc_attr__( 'Email Address', 'et_builder' ),
			esc_attr__( 'Message', 'et_builder' )
		);

		return $output;
	}

	function mrc_process_header_level( $new_level, $default ) {
		$valid_header_levels = array( 'h1', 'h2', 'h3', 'h4', 'h5', 'h6' );
	
		// return the new header level if exists in the list of valid header levels
		if ( in_array( $new_level, $valid_header_levels ) ) {
			return $new_level;
		}
	
		// return default if defined. Fallback to h2 otherwise
		return isset( $default ) ? $default : 'h2';
	}

	function render( $attrs, $content = null, $render_slug ) {
		global $mrc_half_width_counter, $mrc_health_savings_form_num;

		$mrc_half_width_counter = 0;

		$captcha                     = $this->props['captcha'];
		$email                       = $this->props['email'];
		$title                       = '';//$this->_esc_attr( 'title' );
		$form_field_text_color       = $this->props['form_field_text_color'];
		$button_custom               = $this->props['custom_button'];
		$submit_button_text          = $this->props['submit_button_text'];
		$custom_message              = '';//$this->props['custom_message'];
		$use_redirect                = $this->props['use_redirect'];
		$redirect_url                = $this->props['redirect_url'];
		$success_message             = '';//$this->_esc_attr( 'success_message' );
		$header_level                = $this->props['title_level'];

		$custom_icon_values          = et_pb_responsive_options()
			-> get_property_values( $this->props, 'button_icon' );
		$custom_icon                 = isset( $custom_icon_values['desktop'] ) 
			? $custom_icon_values['desktop'] 
			: '';
		$custom_icon_tablet          = isset( $custom_icon_values['tablet'] ) 
			? $custom_icon_values['tablet'] 
			: '';
		$custom_icon_phone           = isset( $custom_icon_values['phone'] ) 
			? $custom_icon_values['phone'] 
			: '';

		$video_background          = $this->video_background();
		$parallax_image_background = $this->get_parallax_image_background();

		$form_id = $this->props['form_id'];
		$input_id = '';//$this->props['input_id'];
		$button_id = $this->props['submit_button_id'];

		wp_enqueue_style( 
			'health-saving-form', 
			plugins_url('/mrccta_v3/includes/modules/style.css') 
		);
		wp_enqueue_script( 
			'health-saving-register', 
			plugins_url('/mrccta_v3/js/script.js')
		);
		// wp_enqueue_script( 
		// 	'lead_api_script', 
		// 	plugins_url('/mrccta_v2/js/script.js')//, 
		// 	array('submit-register')
		// );
		wp_localize_script( 
		 	'lead_api_script', 
		 	'shortFormAjax', 
		 	['ajax_url' => admin_url('admin-ajax.php')] 
		);

		if ( '' !== $form_field_text_color ) {
			ET_Builder_Element::set_style( $render_slug, array(
				'selector'    => 
					'%%order_class%% 
					.input[type="checkbox"]:checked + label i:before',
				'declaration' => sprintf(
					'color: %1$s%2$s;',
					esc_html( $form_field_text_color ),
					et_builder_has_limitation( 'force_use_global_important' ) 
						? ' !important' 
						: ''
				),
			) );

			ET_Builder_Element::set_style( $render_slug, array(
				'selector'    => 
					'%%order_class%% 
					.input[type="radio"]:checked + label i:before',
				'declaration' => sprintf(
					'background-color: %1$s%2$s;',
					esc_html( $form_field_text_color ),
					et_builder_has_limitation( 'force_use_global_important' ) 
						? ' !important' 
						: ''
				),
			) );
		}

		$success_message = '' !== $success_message 
			? $success_message 
			: esc_html__( 'Thanks for contacting us', 'et_builder' );

		$mrc_health_savings_form_num = $this->render_count();

		$content = $this->content;

		$et_error_message = '';
		$et_contact_error = false;
		$current_form_fields = isset( 
			$_POST['mrc_health_savings_email_fields_' . $mrc_health_savings_form_num] 
		) 
			? $_POST['mrc_health_savings_email_fields_' . $mrc_health_savings_form_num] 
			: '';
		$hidden_form_fields = isset( 
			$_POST['mrc_health_savings_email_hidden_fields_' . $mrc_health_savings_form_num] 
		) 
			? $_POST['mrc_health_savings_email_hidden_fields_' . $mrc_health_savings_form_num] 
			: false;
		$contact_email = '';
		$processed_fields_values = array();

		// $nonce_result = isset( 
		// 	$_POST['_wpnonce-et-pb-contact-form-submitted-' 
		// 	. $mrc_health_savings_form_num] 
		// ) && 
		// wp_verify_nonce( 
		// 	$_POST['_wpnonce-et-pb-contact-form-submitted-' 
		// 	. $mrc_health_savings_form_num], 
		// 	'et-pb-contact-form-submit' 
		// ) 
		// 	? true 
		// 	: false;

		// check that the form was submitted and mrc_shortform_validate field is empty to protect from spam
		if ( $nonce_result && 
			isset( $_POST['mrc_shortform_submit_' . $mrc_health_savings_form_num] ) && 
			empty( $_POST['mrc_shortform_validate_' . $mrc_health_savings_form_num] ) ) {
			if ( '' !== $current_form_fields ) {
				$fields_data_json = str_replace( 
					'\\', 
					'' ,  
					$current_form_fields 
				);
				$fields_data_array = json_decode( $fields_data_json, true );

				// check all fields on current form and generate error message if needed
				if ( ! empty( $fields_data_array ) ) {
					foreach( $fields_data_array as $index => $value ) {
						// check all the required fields, generate error message if required field is empty
						$field_value = isset( $_POST[ $value['field_id'] ] ) 
							? trim( $_POST[ $value['field_id'] ] ) 
							: '';

						if ( 'required' === $value['required_mark'] && 
							empty( $field_value ) && 
							! is_numeric( $field_value ) 
						) {
							$et_error_message .= sprintf( 
								'<p class="mrc_health_savings_error_text">%1$s</p>', esc_html__( 
									'Make sure you fill in all required fields.', 
									'et_builder' ) 
							);
							$et_contact_error = true;
							continue;
						}

						// additional check for email field
						if ( 'email' === $value['field_type'] && 
							'required' === $value['required_mark'] && 
							! empty( $field_value ) 
						) {
							$contact_email = isset( 
								$_POST[ $value['field_id'] ] 
								)
								? sanitize_email($_POST[$value['field_id']]) 
								: '';

							if ( ! empty( $contact_email ) && 
								! is_email( $contact_email ) ) {
								$et_error_message .= sprintf( 
									'<p class="mrc_health_savings_error_text">%1$s</p>', esc_html__( 
										'Invalid Email.', 
										'et_builder' ) 
								);
								$et_contact_error = true;
							}
						}

						// prepare the array of processed field values in convenient format
						if ( false === $et_contact_error ) {
							$processed_fields_values[ 
									$value['original_id'] 
								]['value'] = $field_value;
							$processed_fields_values[ 
									$value['original_id'] 
								]['label'] = $value['field_label'];
						}
					}
				}
			} else {
				$et_error_message .= sprintf( 
					'<p class="mrc_health_savings_error_text">%1$s</p>', 
					esc_html__( 'Enter valid ZIP code.', 'et_builder' ) );
				$et_contact_error = true;
			}
		} else {
			if ( false === $nonce_result && 
				isset( $_POST['mrc_shortform_submit_' .$mrc_health_savings_form_num] ) &&
				empty( $_POST['mrc_shortform_validate_' .$mrc_health_savings_form_num] ) 
			) {
				$et_error_message .= sprintf( 
					'<p class="mrc_health_savings_error_text">%1$s</p>', 
					esc_html__( 'Please refresh the page and try again.',
					'et_builder' ) 
				);
			}
			$et_contact_error = true;
		}

		// generate digits for captcha
		// $mrc_first_digit = rand( 1, 15 );
		// $mrc_second_digit = rand( 1, 15 );

		// if ( ! $et_contact_error && $nonce_result ) {
		// 	$et_email_to = '' !== $email
		// 		? $email
		// 		: get_site_option( 'admin_email' );

		// 	$et_site_name = get_option( 'blogname' );

		// 	$contact_name = isset( $processed_fields_values['name'] ) 
		// 	? stripslashes( 
		// 		sanitize_text_field( 
		// 			$processed_fields_values['name']['value'] 
		// 		) 
		// 	) 
		// 	: '';

		// 	if ( '' !== $custom_message ) {
		// 		// decode html entites to make sure HTML from the message pattern is rendered properly
		// 		$message_pattern = et_builder_convert_line_breaks(
		// 			html_entity_decode( $custom_message ), 
		// 			"\r\n" 
		// 		);

		// 		// insert the data from contact form into the message pattern
		// 		foreach ( $processed_fields_values as $key => $value ) {
		// 			// strip all tags from each field. Don't strip tags from the entire message to allow using HTML in the pattern.
		// 			$message_pattern = str_ireplace( 
		// 				"%%{$key}%%", 
		// 				wp_strip_all_tags( $value['value'] ), 
		// 				$message_pattern 
		// 			);
		// 		}

		// 		if ( false !== $hidden_form_fields ) {
		// 			$hidden_form_fields = str_replace( 
		// 				'\\', 
		// 				'' ,  		
		// 				$hidden_form_fields 
		// 			);
		// 			$hidden_form_fields = json_decode( $hidden_form_fields );

		// 			if ( is_array( $hidden_form_fields ) ) {
		// 				foreach ( $hidden_form_fields as $hidden_field_label ) {
		// 					$message_pattern = str_ireplace( 
		// 						"%%{$hidden_field_label}%%", 
		// 						'', 
		// 						$message_pattern 
		// 					);
		// 				}
		// 			}
		// 		}
		// 	} else {
		// 		// use default message pattern if custom pattern is not defined
		// 		$message_pattern = isset( $processed_fields_values['message']['value'] ) ? $processed_fields_values['message']['value'] : '';

		// 		// Add all custom fields into the message body by default
		// 		foreach ( $processed_fields_values as $key => $value ) {
		// 			if ( ! in_array( $key, array( 'message', 'name', 'email' ) ) ) {
		// 				$message_pattern .= "\r\n";
		// 				$message_pattern .= sprintf(
		// 					'%1$s: %2$s',
		// 					'' !== $value['label'] ? $value['label'] : $key,
		// 					$value['value']
		// 				);
		// 			}
		// 		}

		// 		// strip all tags from the message content
		// 		$message_pattern = wp_strip_all_tags( $message_pattern );
		// 	}

		// 	$http_host = str_replace( 'www.', '', $_SERVER['HTTP_HOST'] );

		// 	$headers[] = "From: \"{$contact_name}\" <mail@{$http_host}>";

		// 	// Set `Reply-To` email header based on contact_name and contact_email values
		// 	if ( ! empty( $contact_email ) ) {
		// 		$contact_name = ! empty( $contact_name ) ? $contact_name : $contact_email;
		// 		$headers[] = "Reply-To: \"{$contact_name}\" <{$contact_email}>";
		// 	}

		// 	add_filter( 'et_get_safe_localization', 'et_allow_ampersand' );

		// 	// don't strip tags at this point to properly send the HTML from pattern. All the unwanted HTML stripped at this point.
		// 	$email_message = trim( stripslashes( $message_pattern ) );

		// 	wp_mail( apply_filters( 'et_contact_page_email_to', $et_email_to ),
		// 		et_get_safe_localization( sprintf(
		// 			__( 'New Message From %1$s%2$s', 'et_builder' ),
		// 			sanitize_text_field( 
		// 				html_entity_decode( $et_site_name, ENT_QUOTES, 'UTF-8' )
		// 			),
		// 			( '' !== $title 
		// 				? sprintf( 
		// 					_x( 
		// 						' - %s', 
		// 						'contact form title separator', 
		// 						'et_builder' 
		// 					), 
		// 					$title 
		// 				) 
		// 				: '' 
		// 			)
		// 		) ),
		// 		! empty( $email_message ) ? $email_message : ' ',
		// 		apply_filters( 
		// 			'et_contact_page_headers', 
		// 			$headers, 
		// 			$contact_name, 
		// 			$contact_email 
		// 		)
		// 	);

		// 	remove_filter( 'et_get_safe_localization', 'et_allow_ampersand' );

		// 	$et_error_message = sprintf( 
		// 		'<p>%1$s</p>', 
		// 		et_core_esc_previously( $success_message ) 
		// 	);
		// }

		$form = '';

		$mrc_captcha = sprintf( '
			<div class="mrc_health_savings_right">
				<p class="clearfix">
					<span class="mrc_health_savings_captcha_question">%1$s</span> 
					= 
					<input 
						type="text" 
						size="2" 
						class="input mrc_health_savings_captcha" 
						data-first_digit="%3$s" 
						data-second_digit="%4$s" 
						value="" 
						name="mrc_health_savings_captcha_%2$s"
						data-required_mark="required"
					/>
				</p>
			</div> <!-- .mrc_health_savings_right -->',
			sprintf( '%1$s + %2$s',
				esc_html( $mrc_first_digit ), esc_html( $mrc_second_digit ) 
			),
			esc_attr( $mrc_health_savings_form_num ),
			esc_attr( $mrc_first_digit ),
			esc_attr( $mrc_second_digit )
		);

		if ( '' === trim( $content ) ) {
			$content = do_shortcode( $this->predefined_child_modules() );
		}

		if ( $et_contact_error ) {
			// Make sure submit button text is not just a space
			$submit_button_text = trim( $submit_button_text );

			// We can't use `empty( trim() )` because that throws
			// an error on old(er) PHP versions
			if ( empty( $submit_button_text ) ) {
				$submit_button_text = __( 'Submit', 'et_builder' );
			}

			$form = sprintf( '
				<div class="mrc_short">
					<form 
						class="mrc_health_savings_form clearfix" 
						method="post" 
						id="%11$s"
						%14$s
					>
						%8$s
						<div class="mrc_health_savings_container">
							%2$s
							<button 
								id="%13$s" 
								type="submit" 
								class="mrc_health_savings_submit mrc_button%6$s"
								%5$s%9$s%10$s
							>
								%3$s
							</button>
						</div>
						%4$s
					</form>
				</div> <!-- .mrc_short -->',
				"plan_form_handler",
				(  'on' === $captcha ? $mrc_captcha : '' ),
				esc_html( $submit_button_text ),
				// wp_nonce_field( 
				// 	'et-pb-contact-form-submit', 
				// 	'_wpnonce-et-pb-contact-form-submitted-' 
				// 		. $mrc_health_savings_form_num, 
				// 	true, 
				// 	false 
				// ),
				'',
				'' !== $custom_icon && 'on' === $button_custom 
					? sprintf(
						' data-icon="%1$s"',
						et_esc_previously( $custom_icon )) 
					: '', // #5
				'' !== $custom_icon && 'on' === $button_custom 
					? ' mrc_custom_button_icon' 
					: '',
				esc_attr( $mrc_health_savings_form_num ),
				$content,
				'' !== $custom_icon_tablet && 'on' === $button_custom 
					? sprintf( ' data-icon-tablet="%1$s"', 
						et_esc_previously( $custom_icon_tablet ) ) 
					: '',
				'' !== $custom_icon_phone && 'on' === $button_custom 
					? sprintf( ' data-icon-phone="%1$s"', 
						et_esc_previously( $custom_icon_phone ) ) 
					: '',
				$form_id,
				$input_id,
				$button_id,
				$button_id == "health-savings-hero-button" ? 'action="/health-savings-hero-offers"' :"" 
			);
		}

		// Module classnames
		$this->add_classname( array(
			'mrc_health_savings_form_container',
			'clearfix',
			$this->get_text_orientation_classname(),
		) );

		// Remove automatically added classname
		$this->remove_classname( $render_slug );

		// Contact form should always have the ID. Use saved ID or generate automatically
		$module_id = '' !== $this->module_id(false) 
			? $this->module_id(false) 
			: 'mrc_health_savings_form_' . $mrc_health_savings_form_num;

		$output = sprintf( '
			<div id="%4$s" class="%5$s" data-form_unique_num="%6$s"%7$s>
				%9$s
				%8$s
				%1$s
				%3$s
			</div> <!-- .mrc_health_savings_form_container -->
			',
			( '' !== $title 
				? sprintf( '<%2$s class="mrc_health_savings_main_title">%1$s</%2$s>', 
					et_core_esc_previously( $title ), 
					$this->mrc_process_header_level( $header_level, 'h1' ) ) 
				: '' 
			),
			$et_error_message,
			$form,
			esc_attr( $module_id ),
			'mrc_health_savings_form_container clearfix',//$this->module_classname( $render_slug ),
			esc_attr( $mrc_health_savings_form_num ),
			'on' === $use_redirect && '' !== $redirect_url 
				? sprintf( ' data-redirect_url="%1$s"', 
					esc_attr( $redirect_url ) ) 
				: '',
			$video_background,
			$parallax_image_background
		);

		return $output;
	}
}

new mrc_plan_form_Module;