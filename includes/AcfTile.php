<?php

class MRCCTA_v3 extends DiviExtension {

	/**
	 * The gettext domain for the extension's translations.
	 *
	 * @since 3.0.0
	 *
	 * @var string
	 */
	public $gettext_domain = 'mrccta_v3_module';

	/**
	 * The extension's WP Plugin name.
	 *
	 * @since 3.0.0
	 *
	 * @var string
	 */
	public $name = 'mrccta_v3';

	/**
	 * The extension's version
	 *
	 * @since 3.0.0
	 *
	 * @var string
	 */
	public $version = '3.0.0';

	/**
	 * ACF_AcfTile constructor.
	 *
	 * @param string $name
	 * @param array  $args
	 */
	public function __construct( $name = 'mrccta_v3', $args = array() ) {
		$this->plugin_dir     = plugin_dir_path( __FILE__ );
		$this->plugin_dir_url = plugin_dir_url( $this->plugin_dir );

		parent::__construct( $name, $args );
	}
}

new MRCCTA_v3;
