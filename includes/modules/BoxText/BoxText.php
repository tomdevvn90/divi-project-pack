<?php

class DIPP_BoxText extends ET_Builder_Module {

	public $slug       = 'dipp_box_text';
	public $vb_support = 'on';

	protected $module_credits = array(
		'module_uri' => '#',
		'author'     => 'Beplus',
		'author_uri' => '#',
	);

	public function init() {
		$this->name = esc_html__( 'BoxText', 'dipp-divi-project-pack' );
	}

	public function get_fields() {
		return array(
			'heading' => array(
				'label'           => esc_html__( 'Heading', 'dipp-divi-project-pack' ),
				'type'            => 'text',
				'option_category' => 'basic_option',
				'default'					=> 'Heading',
				'description'     => esc_html__( 'Heading entered here will appear inside the module.', 'dipp-divi-project-pack' ),
				'toggle_slug'     => 'main_content',
			),
			'description' => array(
				'label'           => esc_html__( 'Description', 'dipp-divi-project-pack' ),
				'type'            => 'tiny_mce',
				'option_category' => 'basic_option',
				'default'					=> 'Description',
				'description'     => esc_html__( 'Description entered here will appear inside the module.', 'dipp-divi-project-pack' ),
				'toggle_slug'     => 'main_content',
			),	
			'color_text' => array(
				'default'         => 'dark',
				'label'           => esc_html__( 'Choose color', 'dipp-divi-project-pack' ),
				'type'            => 'select',
				'option_category' => 'basic_option',
				'options'         => array(
					'light' => esc_html__( 'Light', 'dipp-divi-project-pack' ),
					'dark'  => esc_html__( 'Dark', 'dipp-divi-project-pack' ),
				),
				'toggle_slug'     => 'main_content',
				'description'     => esc_html__( 'Choose color for text', 'dipp-divi-project-pack' ),
			),
			'bg_color' => array(
				'label'			  => esc_html__( 'Background Colour', 'dipp-divi-project-pack'),
				'type'			  => 'color-alpha',
				'option_category' => 'basic_option',
				'description'     => esc_html__( 'Input the color of the text', 'dipp-divi-project-pack' ),
				'toggle_slug'     => 'main_content',
				'default'					=> '#14212B'
			),
			'space_bottom' => array(
				'label'           => esc_html__( 'Space Bottom', 'dipp-divi-project-pack' ),
				'type'            => 'text',
				'option_category' => 'basic_option',
				'default'					=> 'Space Bottom',
				'description'     => esc_html__( 'Space Bottom entered here will appear inside the module (10% or 10px).', 'dipp-divi-project-pack' ),
				'toggle_slug'     => 'main_content',
			),
		);
	}

	static function build_template( $attrs ) {
		ob_start();
		$title = $attrs['heading'];
		$description = $attrs['description'];
		$color_text = $attrs['color_text'];
		$bg_color = $attrs['bg_color'];
		$space_bottom = $attrs['space_bottom'];
		?>
		<div class="wrapper-box-text style-color-text-<?= $color_text ?>" style="background-color: <?= $bg_color ?>;padding-bottom: <?= $space_bottom ?>;">
			<h3 class="heading-box"><?= $title ?></h3>
			<div class="desc-box"><?= $description ?></div>
		</div>
		<?php 
		return ob_get_clean();
	}

	public function render( $attrs, $content = null, $render_slug ) {
		$content = self::build_template( $this->props);
		
		return sprintf( '<div class="dipp-module-box-text">%1$s</div>', $content );
	}
}

new DIPP_BoxText;
