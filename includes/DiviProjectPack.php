<?php

class DIPP_DiviProjectPack extends DiviExtension {

	/**
	 * The gettext domain for the extension's translations.
	 *
	 * @since 1.0.0
	 *
	 * @var string
	 */
	public $gettext_domain = 'dipp-divi-project-pack';

	/**
	 * The extension's WP Plugin name.
	 *
	 * @since 1.0.0
	 *
	 * @var string
	 */
	public $name = 'divi-project-pack';

	/**
	 * The extension's version
	 *
	 * @since 1.0.0
	 *
	 * @var string
	 */
	public $version = '1.0.0';

	/**
	 * DIPP_DiviProjectPack constructor.
	 *
	 * @param string $name
	 * @param array  $args
	 */
	public function __construct( $name = 'divi-project-pack', $args = array() ) {
		$this->plugin_dir     = plugin_dir_path( __FILE__ );
		$this->plugin_dir_url = plugin_dir_url( $this->plugin_dir );
		
		$this->static();

		parent::__construct( $name, $args );
	}

	public function static() {
		wp_enqueue_style( 'dpp-style', DPP_URI . '/styles/css/dpp.css', false, DPP_VER );
	}
}

new DIPP_DiviProjectPack;
