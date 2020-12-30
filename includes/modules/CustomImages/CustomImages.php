<?php

class DIPP_CustomImages extends ET_Builder_Module {

	public $slug       = 'dipp_custom_images';
	public $vb_support = 'on';

	protected $module_credits = array(
		'module_uri' => '#',
		'author'     => 'Beplus',
		'author_uri' => '#',
	);

	public function init() {
		$this->name = esc_html__( 'Custom Images', 'dipp-divi-project-pack' );
	}

	public function get_fields() {
		return array(
			'src' => array(
				'label'              => esc_html__( 'Image', 'dipp-divi-project-pack' ),
				'type'               => 'upload',
				'option_category'    => 'basic_option',
				'upload_button_text' => esc_attr__( 'Upload an image', 'dipp-divi-project-pack' ),
				'choose_text'        => esc_attr__( 'Choose an Image', 'dipp-divi-project-pack' ),
				'update_text'        => esc_attr__( 'Set As Image', 'dipp-divi-project-pack' ),
				'hide_metadata'      => true,
				'affects'            => array(
					'alt',
					'title_text',
				),
				'description'        => esc_html__( 'Upload your desired image, or type in the URL to the image you would like to display.', 'dipp-divi-project-pack' ),
				'toggle_slug'        => 'main_content',
				'dynamic_content'    => 'image',
				'mobile_options'     => true,
				'hover'              => 'tabs',
			),			
			'bg_color' => array(
				'label'			  => esc_html__( 'Text Colour', 'dipp-divi-project-pack'),
				'type'			  => 'color-alpha',
				'option_category' => 'basic_option',
				'description'     => esc_html__( 'Input the color of the text', 'dipp-divi-project-pack' ),
				'toggle_slug'     => 'main_content',
				'default'					=> '#14212B'
			),
			'style' => array(
				'default'         => 'style-1',
				'label'           => esc_html__( 'Choose style heading', 'dipp-divi-project-pack' ),
				'type'            => 'select',
				'option_category' => 'basic_option',
				'options'         => array(
					'style-1' => esc_html__( 'Style 1', 'dipp-divi-project-pack' ),
					'style-2'  => esc_html__( 'Style 2', 'dipp-divi-project-pack' ),
				),
				'toggle_slug'     => 'main_content',
				'description'     => esc_html__( 'Choose style for heading', 'dipp-divi-project-pack' ),
			),
		);
	}

	static function build_template( $attrs ) {

		ob_start();
		$bg_color = $attrs['bg_color'];
		?>
		<div class="wrapper-custom-images"><img src="<?= $attrs['src']?>" alt="image"/><div style="background-color:<?= $bg_color ?>" class="bg-container"></div></div>
		<?php 
		return ob_get_clean();
	}

	public function render( $attrs, $content = null, $render_slug ) {
		$content = self::build_template( $this->props);		
		return sprintf( '<div class="dipp-module-custom-images module-custom-images-%2$s">%1$s</div>', $content, $this->props['style'] );
	}
}

new DIPP_CustomImages;
