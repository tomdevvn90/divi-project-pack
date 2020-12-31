<?php

class DIPP_MixImagesVideos extends ET_Builder_Module {

	public $slug       = 'dipp_mix_images_videos';
	public $vb_support = 'on';

	protected $module_credits = array(
		'module_uri' => '#',
		'author'     => 'Beplus',
		'author_uri' => '#',
	);

	public function init() {
		$this->name = esc_html__( 'Mix Images Videos', 'dipp-divi-project-pack' );
	}

	public function get_fields() {
		return array(
			'src_video' => array(
				'label'              => esc_html__( 'Video MP4 File', 'dipp-divi-project-pack' ),
				'type'               => 'upload',
				'option_category'    => 'basic_option',
				'data_type'          => 'video',
				'upload_button_text' => esc_attr__( 'Upload a video', 'dipp-divi-project-pack' ),
				'choose_text'        => esc_attr__( 'Choose a Video MP4 File', 'dipp-divi-project-pack' ),
				'update_text'        => esc_attr__( 'Set As Video', 'dipp-divi-project-pack' ),
				'description'        => esc_html__( 'Upload your desired video in .MP4 format, or type in the URL to the video you would like to display', 'dipp-divi-project-pack' ),
				'toggle_slug'        => 'main_content',
				'computed_affects' => array(
					'__video',
				),
				'mobile_options'     => true,
				'hover'              => 'tabs',
			),
			'src_img_1' => array(
				'label'              => esc_html__( 'Image 1', 'dipp-divi-project-pack' ),
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
			'src_img_2' => array(
				'label'              => esc_html__( 'Image 2', 'dipp-divi-project-pack' ),
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
				'description'     => esc_html__( 'Description member entered here will appear inside the module.', 'dipp-divi-project-pack' ),
				'toggle_slug'     => 'main_content',
			),				
		);
	}

	static function build_template( $attrs ) {

		ob_start();
		$heading = $attrs['heading'];
		$description = $attrs['description'];
		$src_video = $attrs['src_video'];
		$src_img_1 = $attrs['src_img_1'];
		$src_img_2 = $attrs['src_img_2'];
		
		?>
		<div class="wrapper-content-mix-images-videos">
			<div class="content-rows">
				<div class="mix-images-videos-col">
					<div class="title-header"><h2><?= $heading ?></h2></div>
					<div class="desc-content"><?= $description ?></div>
				</div>
				<div class="mix-images-videos-col">
					<div class="wrap-videos">
						<span id="btn-play"></span>
						<?php if(!empty($src_video)){ ?>
							<video width="100" height="355" id="videoPlayer" autoplay muted >
								<source src="<?= $src_video ?>" type="video/mp4">
							</video>
							<?php } ?>
					</div>
				
				</div>
			</div>
			<div class="wrap-images">
				<div class="module-mix-images mix-images-1">
					<?php if(!empty($src_img_1)){ ?>
						<img src="<?= $src_img_1 ?>" alt="image 1"/>
					<?php } ?>
				</div>
				<div class="module-mix-images mix-images-2">
					<?php if(!empty($src_img_2)){ ?>
						<img src="<?= $src_img_2 ?>" alt="image 2"/>
					<?php } ?>
				</div>
			</div>
		</div>
		<?php 
		return ob_get_clean();
	}

	public function render( $attrs, $content = null, $render_slug ) {
		$content = self::build_template( $this->props);		
		return sprintf( '<div class="dipp-module-mix-image-videos">%1$s</div>', $content);
	}
}

new DIPP_MixImagesVideos;
