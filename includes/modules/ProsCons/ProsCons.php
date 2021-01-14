<?php

class DIPP_ProsCons extends ET_Builder_Module {

	public $slug       = 'dipp_pros_cons';
	public $vb_support = 'on';

	protected $module_credits = array(
		'module_uri' => '#',
		'author'     => 'Beplus',
		'author_uri' => '#',
	);

	public function init() {
		$this->name = esc_html__( 'Pros Con', 'dipp-divi-project-pack' );
	}

	public function get_fields() {
		return array(
            'pros_heading'     => array(
				'label'           => esc_html__( 'Pros Title', 'dipp-divi-project-pack' ),
				'type'            => 'text',
                'default'		  => 'Pros',
				'option_category' => 'basic_option',
				'toggle_slug'     => 'main_content',
			),
            'pros_content'     => array(
				'label'           => esc_html__( 'Pros Content', 'dipp-divi-project-pack' ),
				'type'            => 'tiny_mce',
				'option_category' => 'basic_option',
				'description'     => esc_html__( 'Content entered here will appear below the pros heading.', 'dipp-divi-project-pack' ),
				'toggle_slug'     => 'main_content',
			),
            'cros_heading'     => array(
				'label'           => esc_html__( 'Cons Title', 'dipp-divi-project-pack' ),
				'type'            => 'text',
                'default'		  => 'Cons',
				'option_category' => 'basic_option',
				'toggle_slug'     => 'main_content',
			),
            'cons_content'     => array(
				'label'           => esc_html__( 'Cons Content', 'dipp-divi-project-pack' ),
				'type'            => 'tiny_mce',
				'option_category' => 'basic_option',
				'description'     => esc_html__( 'Content entered here will appear below the cons heading.', 'dipp-divi-project-pack' ),
				'toggle_slug'     => 'main_content',
			),
		);
	}

	static function build_template( $attrs ) {

		ob_start();
        $pros_heading = $attrs['pros_heading'];
        $pros_content = $attrs['pros_content'];
        $cros_heading= $attrs['cros_heading'];
        $cons_content = $attrs['cons_content'];
        // echo "<pre>";
        // echo print_r($attrs);
        // echo "</pre>";
		?>
        <div class="wrapper-content-pros-cons">
            <div class="item-wrapper item-pros">
                <h2 class="bt-tilte"> <?= $pros_heading ?> </h2>
                <div class="bt-content"> <?= $pros_content ?>  </div>
            </div>
            <div class="item-wrapper item-cons">
                <h2 class="bt-tilte"> <?= $cros_heading ?> </h2>
                <div class="bt-content">  <?=  $cons_content ?>  </div>
            </div>

        </div>
		<?php
		return ob_get_clean();
	}

	public function render( $attrs, $content = null, $render_slug ) {
		$content = self::build_template( $this->props);
		return sprintf( '<div class="dipp-module-pros-cons">%1$s</div>', $content);
	}
}

new DIPP_ProsCons;
