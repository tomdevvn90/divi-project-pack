<?php
/**
 *  MODULE: SenseiLMS Courses
 */

if( ! class_exists( 'Sensei_Bootstrap' ) ) return;

class DIPP_SenseiLMS_Courses extends ET_Builder_Module {

	public $slug       = 'dipp_senseilms_courses';
	public $vb_support = 'on';

	protected $module_credits = array(
		'module_uri' => '#',
		'author'     => 'Beplus',
		'author_uri' => '#',
	);

	public function init() {
		$this->name = esc_html__( 'SenseiLMS Courses', 'dipp-divi-project-pack' );
	}

	public function get_fields() {
		return array(
			'posttype' => [
				'label' => esc_html__( 'Choose Post Type', 'dipp-divi-project-pack' ),
				'type' => 'select',
				'option_category' => 'basic_option',
				'options' => [
					'course' => esc_html__( 'Course', 'dipp-divi-project-pack' ),
					'post'  => esc_html__( 'Blog Post', 'dipp-divi-project-pack' ),
				],
				'default' => 'course',
				'toggle_slug' => 'main_content',
				'computed_affects'  => [
					'__posts',
				]
			],
			'heading' => array(
				'label' => esc_html__( 'Heading Text', 'dipp-divi-project-pack' ),
				'type' => 'text',
				'default' => esc_html__( 'Our Courses', 'dipp-divi-project-pack' ),
				'option_category' => 'basic_option',
				'description' => esc_html__( 'Enter heading text', 'dipp-divi-project-pack' ),
				'toggle_slug' => 'main_content',
			),
			'heading_text_color' => array(
				'label' => esc_html__( 'Heading Color', 'dipp-divi-project-pack' ),
				'type' => 'color-alpha',
				'custom_color' => true,
				'toggle_slug' => 'main_content',
				'default' => '#222222'
			),
			'course_taxonomy' => [
				'label' => esc_html__( 'Choose Course Category', 'dipp-divi-project-pack' ),
				'type' => 'categories',
				'option_category' => 'basic_option',
				'renderer_options' => [
					'use_terms' => true,
					'term_name' => 'course-category',
				],
				'toggle_slug' => 'main_content',
				'computed_affects'  => [
					'__posts',
				],
				'show_if' => [
					'posttype' => [ 'course' ]
				]
			],
			'post_category' => [
				'label' => esc_html__( 'Choose Category', 'dipp-divi-project-pack' ),
				'type' => 'categories',
        'option_category' => 'basic_option',
        'post_type' => 'post',
        'taxonomy_name' => 'category',
				'renderer_options' => array(
          'use_terms' => false,
        ),
				'toggle_slug' => 'main_content',
				'computed_affects'  => [
					'__posts',
				],
				'show_if' => [
					'posttype' => [ 'post' ]
				]
			],
			'template' => [
				'label' => esc_html__( 'Choose Template', 'dipp-divi-project-pack' ),
				'type' => 'select',
				'option_category' => 'basic_option',
				'options' => [
					'symmetrical' => esc_html__( 'Symmetrical', 'dipp-divi-project-pack' ),
					'featured_post_first'  => esc_html__( 'Featured post first', 'dipp-divi-project-pack' ),
					'base_grid'  => esc_html__( 'Base Grid', 'dipp-divi-project-pack' ),
				],
				'default' => 'symmetrical',
				'toggle_slug' => 'main_content',
				'computed_affects'  => [
					'__posts',
				]
			],
			'__posts' => [
				'type' => 'computed',
				'computed_callback' => [ 'DIPP_SenseiLMS_Courses', 'get_course_posts' ],
				'computed_depends_on' => [
					'posttype',
					'course_taxonomy',
					'post_category',
					'template'
				]
			],
		);
	}

	static function get_course_posts( $params = [] ) {
		$params = wp_parse_args( $params, [
			'posttype' => 'course',
			'posts_per_page' => 6,
			'course_taxonomy' => '',
			'post_category' => '',
			'template' => 'symmetrical',
		] );

		$post_num = [
			'symmetrical' => 6,
			'featured_post_first' => 9,
			'base_grid'=> 8,
		];

		$args = [
			'posts_per_page' => $post_num[ $params['template'] ],
			'paged' => 1,
			'post_type' => $params[ 'posttype' ],
			'post_status' => 'publish',
		];

		if( $params[ 'posttype' ] === 'course' && ! empty( $params[ 'course_taxonomy' ] ) ) {
			$args[ 'tax_query' ] = [
				[ 
					'taxonomy' => 'course-category',
					'field'    => 'term_id',
					'terms'    => explode( ',', $params[ 'course_taxonomy' ] ),
				]
			];
		}

		if( $params[ 'posttype' ] === 'post' && ! empty( $params[ 'post_category' ] ) ) {
			$args[ 'category__in' ] = explode( ',', $params[ 'post_category' ] );
		}

		$_posts = get_posts( $args );

		return count( $_posts ) ? array_map( function( $p ) {
			$url = get_the_post_thumbnail_url( $p->ID, 'large' );
			$postImage2 = '';

			if( function_exists( 'get_field' ) ) {
				$postUrl2 = get_field( 'featured_image_2', $p->ID );
			}

			$p->thumb_url = $url ? $url : 'https://via.placeholder.com/800x600';
			$p->thumb_url2 = $postUrl2;
			$p->post_url = get_the_permalink( $p->ID );
			$p->post_excerpt = wp_trim_words( $p->post_excerpt, 21, '...' );
			return $p;
		}, $_posts ) : [];
	}

	static function post_special_class( $inc, $template ) {
		// if( $template == 'symmetrical' ) {
		// 	return (($inc % 3 == 0) ? '__is-special' : '');
		// }

		return '';
	}

	static function build_template( $posts, $template ) {
		if( count( $posts ) <= 0 ) return;

		ob_start();
		?>
		<div class="pp-lms-course-list temp__<?= $template ?>">
			<? 
			foreach( $posts as $index => $p ) : 
				$postHasThumb2Class = '';
				$postThumb2Html = '';
				if( $template == 'symmetrical' && in_array( $index, [ 2,3 ] ) ) {
					$postHasThumb2Class = $p->thumb_url2 ? '__has-thumb2' : '';
					$postThumb2Html = $p->thumb_url2 ? '<a href="'. $p->post_url .'" class="thumb-background __thumb-2" style="background: url('. $p->thumb_url2 .') no-repeat center center / cover, #222;" ></a>' : '';
				}
			?>
			<div class="course-item <?= DIPP_SenseiLMS_Courses::post_special_class( $index + 1, $template ) ?>">
				<div class="post-inner">
					<div class="post-thumb <?= $postHasThumb2Class ?>">
						<a href="<?= $p->post_url ?>" class="thumb-background" style="background: url(<?= $p->thumb_url ?>) no-repeat center center / cover, #222;"></a>
						<?= $postThumb2Html ?>
					</div>
					<div class="post-entry">
						<h4 class="post-title">
							<a href="<?= $p->post_url ?>"><?= $p->post_title ?></a>
						</h4>
						<?= wpautop( $p->post_excerpt ) ?>
					</div>
				</div>
			</div>
			<? endforeach; ?>
		</div>
		<?php 
		return ob_get_clean();
	}

	public function render( $attrs, $content = null, $render_slug ) {

		$posts = self::get_course_posts( [
			'posttype' => $this->props['posttype'],
			'template' => $this->props['template'],
			'course_taxonomy' => $this->props[ 'course_taxonomy' ],
			'post_category' => $this->props[ 'post_category' ],
		] );
		$content = self::build_template( $posts, $this->props['template'] );

		return sprintf( 
			'<div class="pp-module-lms-course"><h2 class="heading-text __heading-%5$s" style="color: %3$s;">%1$s</h2> %2$s</div>', 
			$this->props['heading'],
			$content,
			$this->props['heading_text_color'],
			$this->props['course_taxonomy'],
			$this->props['template'] );
	}
}

new DIPP_SenseiLMS_Courses;
