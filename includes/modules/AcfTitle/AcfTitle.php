<?php

class ACF_TitleModule extends ET_Builder_Module {

	public $slug       = 'acf_title_module';
	public $vb_support = 'on';

	protected $module_credits = array(
		'module_uri' => '',
		'author'     => '',
		'author_uri' => '',
	);

	function init() {
		$this->name = esc_html__( 'ACF Title', 'acf_title_module' );

		// Toggle settings
		$this->settings_modal_toggles  = array(
			'general'  => array(
				'toggles' => array(
					'acf_title'=> esc_html__( 'ACF Title', 'acf_title_module' ),
					'bullet'   => esc_html__( 'Bullet', 'acf_title_module' ),
				),
			),
		);

		$this->main_css_element = '%%order_class%%';

		$this->custom_css_fields = array(
			'acf_background' => array(
				'label'    => esc_html__( 'Background Style', 'et_builder' ),
				'selector' => '%%order_class%% .acf-title-container',
			),
			'before_title' => array(
				'label'    => esc_html__( 'Before Title Style', 'et_builder' ),
				'selector' => '%%order_class%% .before-title-style',
			),
			'title_style' => array(
				'label'    => esc_html__( 'Title Style', 'et_builder' ),
				'selector' => '%%order_class%% .title-style',
			),
            'title2_style' => array(
				'label'    => esc_html__( 'Title2 Style', 'et_builder' ),
				'selector' => '%%order_class%% .title2-style',
			),
			'after_title' => array(
				'label'    => esc_html__( 'After Title Style', 'et_builder' ),
				'selector' => '%%order_class%% .after-title-style',
			),
			'bullet_number_style' => array(
				'label'    => esc_html__( 'Bullet Number Style', 'et_builder' ),
				'selector' => '%%order_class%% .bullet-style',
			),
		);
	}

	function sb_mod_acf_get_fields($repeater_only = false)
	{
		$options = array();

		if ($acf_posts = 
			get_posts(array('post_type' => 'acf', 'posts_per_page' => -1))) {
			foreach ($acf_posts as $acf_post) {

				$acf_meta = get_post_custom($acf_post->ID);
				$acf_fields = array();

				foreach ($acf_meta as $key => $val) {
					if (preg_match("/^field_/", $key)) {
						$acf_fields[$key] = $val;
					}
				}

				if ($acf_fields) {
					foreach ($acf_fields as $field) {
						$field = unserialize($field[0]);

						if (!$repeater_only || 
							$repeater_only && $field['type'] == 'repeater') {
							$options[
								$acf_post->post_title . 
								'|' . 
								$field['name']
							] = $acf_post->post_title . ' - ' . $field['label'];
						}
					}
				}
			}
		}

		if ($acf_pro_groups = 
			get_posts(
				array('post_type' => 'acf-field-group', 'posts_per_page' => -1))
			) {
			foreach ($acf_pro_groups as $acf_fg) {
				if ($fields = 
					get_posts(
						array(
							'post_type' => 'acf-field', 
							'post_parent' => $acf_fg->ID, 
							'posts_per_page' => -1
						)
					)
				) {
					foreach ($fields as $field) {
						$field_obj = unserialize($field->post_content);

						if (!$repeater_only || 
							$repeater_only && $field_obj['type'] == 'repeater') 
						{
							$options[
								$acf_fg->post_title . 
								'|' . 
								$field->post_excerpt
							] = $acf_fg->post_title . 
								' - ' . 
								$field->post_title;
						}
					}
				}
			}
		}

		return $options;
	}

	function get_fields() {
		$options = $this->sb_mod_acf_get_fields();
		return array(
			'form_type' => array(
				'label'             => esc_html__( 'Form Type', 'et_builder' ),
				'type'              => 'select',
				'option_category'   => 'layout',
				'options'           => array(
					'none'  	=> esc_html__( 'None', 'et_builder' ),
					'Medicare' 	=> esc_html__( 'Medicare Landing Page', 'et_builder' ),
					'Health' 	=> esc_html__( 
						'Health Insurance Landing Page', 
						'et_builder' 
					),
					'ZipForm' 	=> esc_html__( 'ZipForm', 'et_builder' ),
					'ShortForm' => esc_html__( 'Short Form', 'et_builder' ),
				),
				'description'        => esc_html__( 
					'Type of Form. Ex:Medicare', 
					'et_builder' 
				),
				'toggle_slug'        => 'acf_title',
				'default_on_front'   => 'ZipForm',
			),
			// ACF Title
			'title_before_acf' => array(
				'label'				=> esc_html__( 
					'Title Before ACF', 
					'acf_title_module' 
				),
				'type'				=> 'text',
				'option_category'	=> 'basic_option',
				'description'		=> esc_html__( 
					'Set title before ACF inside the module.', 
					'acf_title_module' 
				),
				'toggle_slug'		=> 'acf_title',
			),
			'use_title' => array(
				'label'				=> esc_html__( 
					'Use ACF Title', 
					'acf_title_module' 
				),
				'type'				=> 'yes_no_button',
				'option_category'	=> 'basic_option',
				'options'           => array(
					'off'  	=> esc_html__( 'Off', 'acf_title_module' ),
					'on' 	=> esc_html__( 'On', 'acf_title_module' ),
				),
				'description'		=> esc_html__( 
					'Set using bullet inside the module.', 
					'acf_title_module' 
				),
				'toggle_slug'		=> 'acf_title',
                'default'			=> 'off',
			),
			'acf_of_title' => array(
				'label'				=> esc_html__( 
					'ACF of Title', 
					'acf_title_module' 
				),
				'type'				=> 'select',
				'options'	=> $options,
				'description'		=> esc_html__( 
					'Set ACF title inside the module.', 
					'acf_title_module' 
				),
				'toggle_slug'		=> 'acf_title',
				'show_if' 			=> array(
					'use_title'		=> 'on',
				),
			),
			'acf_of_title_text' => array(
				'label'				=> esc_html__(
					'ACF of Title', 
					'acf_title_module' 
				),
				'type'				=> 'text',
				'option_category'	=> 'basic_option',
				'description'		=> esc_html__( 
					'Set title after ACF inside the module.', 
					'acf_title_module' 
				),
				'toggle_slug'		=> 'acf_title',
				'show_if' 			=> array(
					'use_title'		=> 'off',
				),
			),
            'acf_of_title2_text' => array(
				'label'				=> esc_html__( 
					'ACF of Title2', 
					'acf_title_module' 
				),
				'type'				=> 'text',
				'option_category'	=> 'basic_option',
				'description'		=> esc_html__( 
					'Set title after ACF inside the module.', 
					'acf_title_module' 
				),
				'toggle_slug'		=> 'acf_title',
				'show_if' 			=> array(
					'use_title'		=> 'off',
				),
			),
			'title_after_acf' => array(
				'label'				=> esc_html__( 
					'Title After ACF', 
					'acf_title_module' 
				),
				'type'				=> 'text',
				'option_category'	=> 'basic_option',
				'description'		=> esc_html__( 
					'Set title after ACF inside the module.', 
					'acf_title_module' 
				),
				'toggle_slug'		=> 'acf_title',
			),
			'tag_type' => array(
				'label'				=> esc_html__( 
					'Tag Type', 
					'acf_title_module' 
				),
				'type'				=> 'select',
				'option_category'	=> 'basic_option',
				'options'			=> array(
					'h1'	=> esc_html__( 'H1', 'acf_title_module' ),
					'h2'	=> esc_html__( 'H2', 'acf_title_module' ),
					'h3'	=> esc_html__( 'H3', 'acf_title_module' ),
					'p'		=> esc_html__( 'P', 'acf_title_module' ),
				),
				'default'			=> 'p',
				'description'		=> esc_html__( 
					'Set tag type inside the module.', 
					'acf_title_module' 
				),
				'toggle_slug'		=> 'acf_title',
			),

			// Bullet
			'use_bullet' => array(
				'label'				=> esc_html__( 
					'Use Bullet', 
					'acf_title_module' 
				),
				'type'				=> 'yes_no_button',
				'option_category'	=> 'basic_option',
				'options'           => array(
					'off'  	=> esc_html__( 'Off', 'acf_title_module' ),
					'on' 	=> esc_html__( 'On', 'acf_title_module' ),
				),
				'description'		=> esc_html__( 
					'Set using bullet inside the module.', 
					'acf_title_module' 
				),
				'toggle_slug'		=> 'bullet',
                'default'			=> 'off',
			),
			'bullet_number' => array(
				'label'				=> esc_html__( 
					'Bullet Number', 
					'acf_title_module' 
				),
				'type'				=> 'text',
				'option_category'	=> 'basic_option',
				'description'		=> esc_html__( 
					'Set bullet number inside the module.', 
					'acf_title_module' 
				),
				'toggle_slug'		=> 'bullet',
				'show_if' 			=> array(
					'use_bullet'		=> 'on',
				),
			),
			'bullet_type' => array(
				'label'				=> esc_html__( 
					'Bullet Type', 
					'acf_title_module' 
				),
				'type'				=> 'select',
				'option_category'	=> 'basic_option',
				'options'			=> array(
					'circle'	=> esc_html__( 'Circle', 'acf_title_module' ),
					'rectangle'	=> esc_html__( 'Rectangle', 'acf_title_module' ),
				),
				'description'		=> esc_html__( 
					'Set bullet type inside the module.', 
					'acf_title_module' 
				),
				'toggle_slug'		=> 'bullet',
				'default'			=> 'rectangle',
				'show_if' 			=> array(
					'use_bullet'		=> 'on',
				),
			),
			'bullet_margin' => array(
				'label'           => esc_html__( 
					'Bullet Margin', 
					'et_builder' 
				),
				'type'            => 'custom_margin',
				'option_category' => 'basic_option',
				'description'     => esc_html__( 
					'Set bullet margin.', 
					'et_builder' 
				),
				'tab_slug'        => 'advanced',
				'toggle_slug'	  => 'bullet',
			),
			'bullet_padding' => array(
				'label'           => esc_html__( 
					'Bullet Padding', 
					'et_builder' 
				),
				'type'            => 'custom_padding',
				'option_category' => 'basic_option',
				'description'     => esc_html__( 
					'Set bullet padding.', 
					'et_builder' 
				),
				'tab_slug'        => 'advanced',
				'toggle_slug'	  => 'bullet',
			),
			'bullet_background' => array(
				'label'           => esc_html__( 
					'Bullet Background', 
					'et_builder' 
				),
				'type'            => 'color-alpha',
				'option_category' => 'basic_option',
				'description'     => esc_html__( 
					'Set bullet background.', 
					'et_builder' 
				),
				'tab_slug'        => 'advanced',
				'toggle_slug'	  => 'bullet',
			),
		);
	}

	function get_advanced_fields_config() {
		return array(
			'text'           => false,
			'fonts'          => array(
				'body' => array(
					'css'        => array(
						'main'  => "%%order_class%% .acf-title-container p, 
									%%order_class%% .acf-title-container h1,
									%%order_class%% .acf-title-container h2,
									%%order_class%% .acf-title-container h3",
					),
					'label'  => esc_html__( 'ACF Text', 'acf_title_module' ),
					'disable_toggle' => false,
				),
				'bullet' => array(
					'css'   => array(
						'main'  => 
							"%%order_class%% .acf-bullet-container li::before",
					),
					'label'  => esc_html__( 'Bullet', 'acf_title_module' ),
					'disable_toggle' => false,
				),
			),
		);
	}

	function get_html() {

		global $acf_title_form_num;
		$current_module_num =
			null === $acf_title_form_num ? 0 
				: intval( $acf_title_form_num ) + 1;
		// ACF Title
		$titleBeforeAcf	= $this->props['title_before_acf'];
		$titleAfterAcf	= $this->props['title_after_acf'];
		$tagName		= $this->props['tag_type'];
		$useTitle		= $this->props['use_title'];
		if ($useTitle === 'on') {
			$acfTitle = $this->shortcode_atts['acf_of_title'];

			if ($field_arr = explode('|', $acfTitle)) {
				$acfTitle = $field_arr[1];
			}
			if ($acfTitle = get_field_object($acfTitle)) {
				$acfTitle = sb_mod_acf_parse_value_by_type($acfTitle);
			}
		} else {
			$acfTitle = $this->props['acf_of_title_text'];
            $acfTitle2 = $this->props['acf_of_title2_text'];
		}
		// Bullet
		$useBullet		= $this->props['use_bullet'];
		$bulletType		= $this->props['bullet_type'];
		$bulletNumber  	= $this->props['bullet_number']; 

		$form_type  = $this->props['form_type'];
		if ( $form_type !== 'none') {
			$acfTitle = $this->parse_url_params($acfTitle);
            $acfTitle2 = $this->parse_url_params($acfTitle2);
			$titleBeforeAcf = $this->parse_url_params($titleBeforeAcf);
			$titleAfterAcf = $this->parse_url_params($titleAfterAcf);
		}

		if ( $useBullet === 'off' ) {
			$html = '
				<div class="acf-title-container">
					<' .$tagName. ' class="title-style"> 
						<span class="before-title-style">' 
                        	.$titleBeforeAcf. 
                        '</span>' 
                       	.$acfTitle. 
                        '<span class="after-title-style">' 
                        	.$titleAfterAcf. 
                        '</span>
                        <span class="title2-style">'
                        	.$acfTitle2.
                        '</span>
				</' .$tagName. '>
				</div>
				';
		} else {
			if ( $bulletType === 'circle') {
				$this->add_classname("bullet-circle");
			}
			$html = '
				<' .$tagName. ' style="float: left">
					<span class="bullet-style">' 
						.$bulletNumber. 
					'</span>
				</' .$tagName. '>
				<' .$tagName. ' class="title-style"> 
					<span class="before-title-style">' 
						.$titleBeforeAcf. 
					'</span>' 
					.$acfTitle. 
					'<span class="after-title-style">' 
						.$titleAfterAcf. 
					'</span>
				</' .$tagName. '>
			';	
		}

		return $html;
	}

	function dynamic_header($attr, $type) {
		$options = [
			"top"           => "Top {$type} Insurance",
			"signup"        => "{$type} Insurance Signup",
			"reviews"       => "{$type} Insurance Reviews",
			"registration"  => "{$type} Insurance Registration",
			"register"      => "Register For {$type} Insurance",
			"ratings"       => "{$type} Insurance Ratings",
			"price"         => "Price {$type} Insurance Quotes",
			"premiums"      => "{$type} Insurance Premiums",
			"plans"         => "{$type} Insurance Plans",
			"how Much Is"   => "How Much Is {$type} Insurance",
			"get"           => "Get {$type} Insurance",
			"deductibles"   => "{$type} Insurance Deductibles",
			"cost"          => "{$type} Insurance Cost",
			"comparison"    => "{$type} Insurance Comparison",
			"compare"       => "Compare Free Quotes Now",
			"cheap"         => "Cheap {$type} Insurance ",
			"buy"           => "Buy {$type} Insurance",
			"best"          => "Best {$type} Insurance",
			"affordable"    => "Affordable {$type} Insurance",
			"quotes"        => "Get Your Free Quotes Now"
			];

		if (strcasecmp($type, "Medicare") == 0) {
			$options['Ratings'] = "{$type} Ratings";
			$options['Deductibles'] = "{$type} Deductibles";
			$default = "Get Free Medicare Quotes Now";
			if (strcasecmp($attr, "quotes") == 0) {
				return $default;
			}
		} else {
			$default = "Get Health Insurance for as low as $1 / Day";
		}

		$get = isset($attr) ? strtolower($attr) : "";
		$default = isset($options[$get]) ? $options[$get] : $default;

		return $default;
	}

	function landing_location($pre_param_after) {
		//$value format : "pre-XXX:value:after-YYY"

		$pre = "";
		$param = $pre_param_after;
		$after = "";
		$temp_pre_param_after = explode ( ":" , $pre_param_after, 2);
		//find pre
		if (is_array($temp_pre_param_after) && strcasecmp(substr($temp_pre_param_after[0],0, 4) ,"pre-") == 0)
		{
			$pre = substr($temp_pre_param_after[0],4);
			if (sizeof($temp_pre_param_after)> 1) {
				$param = $temp_pre_param_after[1];
			} else {
				$param = "";
			}
		}
		//find after
		$last_pos = strrpos( $param, ":", 0);

		if ($last_pos > 0 && 
			strcasecmp(substr($param,$last_pos+1, 6), "after-") == 0) {
			$after = substr($param, $last_pos + 7);
			$param = substr($param, 0, $last_pos);
		}

		return isset($_GET[$param]) ? $pre.$_GET[$param].$after : '';
	}
    
    function dynamic_header2($param) {
		return $_GET[$param] == "low" ? 'as Low as $1 a Day' : '';
	}

	function parse_url_params($org_text) {
		$form_type  = $this->props['form_type'];
		preg_match_all ("#\{(.*?)\}#", $org_text, $match);

		for ( $i = 0; $i < count($match[0]); $i++)
		{
			$param = $match[0][$i];
			$value = $match[1][$i];
			if ($value == "mrcheadline") {
				$value = $this->dynamic_header($_GET[$value], $form_type);
			} else if ($value == "mrcheadline2") {
				$value = $this->dynamic_header2($value);
			} else {
				$value = $this->landing_location($value);
			}
			$org_text = str_replace($param, $value, $org_text);
		}
		return $org_text;
	}

	function render( $attrs, $content = null, $render_slug ) {
		wp_enqueue_style( 
			'acf-title', 
			plugins_url('/mrccta_v3/includes/modules/style.css') 
		);
		return sprintf( '
			<div>%1$s</div>', 
			$this->get_html()
		);
	}
}

new ACF_TitleModule;