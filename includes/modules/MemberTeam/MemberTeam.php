<?php

class DIPP_MemberTeam extends ET_Builder_Module {

	public $slug       = 'dipp_member_team';
	public $vb_support = 'on';

	protected $module_credits = array(
		'module_uri' => '#',
		'author'     => 'Beplus',
		'author_uri' => '#',
	);

	public function init() {
		$this->name = esc_html__( 'Member Team', 'dipp-divi-project-pack' );
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
			'name' => array(
				'label'           => esc_html__( 'Name Member', 'dipp-divi-project-pack' ),
				'type'            => 'text',
				'option_category' => 'basic_option',
				'default'					=> 'Name',
				'description'     => esc_html__( 'Name member entered here will appear inside the module.', 'dipp-divi-project-pack' ),
				'toggle_slug'     => 'main_content',
			),
			'position' => array(
				'label'           => esc_html__( 'Position Member', 'dipp-divi-project-pack' ),
				'type'            => 'text',
				'option_category' => 'basic_option',
				'default'					=> 'Position',
				'description'     => esc_html__( 'Position member entered here will appear inside the module.', 'dipp-divi-project-pack' ),
				'toggle_slug'     => 'main_content',
			),
			'email' => array(
				'label'           => esc_html__( 'Email Member', 'dipp-divi-project-pack' ),
				'type'            => 'text',
				'option_category' => 'basic_option',
				'default'					=> 'Email',
				'description'     => esc_html__( 'Email member entered here will appear inside the module.', 'dipp-divi-project-pack' ),
				'toggle_slug'     => 'main_content',
			),					
		);
	}

	static function build_template( $attrs ) {

		ob_start();
		$name = $attrs['name'];
		$position = $attrs['position'];
		$email = $attrs['email'];
		?>
		<div class="wrapper-content-team-member">
			<div class="img-member" style="background-image: url(<?= $attrs['src'] ?>)"></div>		
			<h5 class="name-member"><?= $name ?></h5>
			<p class="position-member"><?= $position ?></p>
			<p class="email-member"><a href="mailto:<?= $email ?>"><?= $email ?></a></p>
		</div>
		<?php 
		return ob_get_clean();
	}

	public function render( $attrs, $content = null, $render_slug ) {
		$content = self::build_template( $this->props);		
		return sprintf( '<div class="dipp-module-member-team">%1$s</div>', $content);
	}
}

new DIPP_MemberTeam;
