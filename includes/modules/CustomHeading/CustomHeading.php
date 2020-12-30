<?php

class DIPP_CustomHeading extends ET_Builder_Module {

	public $slug       = 'dipp_custom_heading';
	public $vb_support = 'on';

	protected $module_credits = array(
		'module_uri' => '#',
		'author'     => 'Beplus',
		'author_uri' => '#',
	);

	public function init() {
		$this->name = esc_html__( 'Custom Heading', 'dipp-divi-project-pack' );
	}

	public function get_fields() {
		return array(
			'heading' => array(
				'label'           => esc_html__( 'Custom Heading', 'dipp-divi-project-pack' ),
				'type'            => 'text',
				'option_category' => 'basic_option',
				'default'					=> 'Custom Heading',
				'description'     => esc_html__( 'Heading entered here will appear inside the module.', 'dipp-divi-project-pack' ),
				'toggle_slug'     => 'main_content',
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
		$tag = $attrs['tag_heading'];
		$argsfontW = explode('|',$attrs['module_font']);
		foreach($argsfontW as $item){
			if(!empty($item)){
				$fontW = $item;
			}
		}
		
		$argsStyle = [
			'--size-default:'.$attrs['module_font_size'],
			'--size-tablet:'.$attrs['module_font_size_tablet'],
			'--size-mobile:'.$attrs['module_font_size_phone'],
			'color:'.$attrs['module_text_color'],
			'font-weight:'.$fontW
		];
		$styles = implode(';',$argsStyle);
		?>
		<div class="wrapper-heading-tag"><h2 class="custom-heading-tag" style="<?= $styles ?>"><?= $attrs['heading'] ?></h2></div>
		<?php 
		return ob_get_clean();
	}

	public function render( $attrs, $content = null, $render_slug ) {
		$content = self::build_template( $this->props);
		$style_heading = $this->props['style'];
		return sprintf( '<div class="dipp-module-custom-heading module-heading-'.$style_heading.'">%1$s</div>', $content );
	}
}

new DIPP_CustomHeading;
