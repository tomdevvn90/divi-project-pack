<?php 
class DIPP_GridPosts extends ET_Builder_Module {

  public $slug       = 'dipp_grid_posts';
  public $vb_support = 'on';

  protected $module_credits = [
    'module_uri' => '#',
    'author' => 'Beplus',
    'author_uri' => '#',
  ];

  public function init() {
    $this->name = esc_html__( 'Grid Posts', 'dipp-divi-project-pack' );
  }

  public function get_fields() {
    return [
      'heading' => array(
        'label' => esc_html__( 'Heading Text', 'dipp-divi-project-pack' ),
        'type' => 'text',
        'default' => esc_html__( 'Our Posts', 'dipp-divi-project-pack' ),
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
      'category' => [
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
				]
			],
      '__posts' => [
        'type' => 'computed',
        'computed_callback' => [ 'DIPP_GridPosts', 'get_posts' ],
        'computed_depends_on' => [
          'category'
        ]
      ],
    ];
  }

  static function get_posts( $params = [] ) {
    $params = wp_parse_args( $params, [
      'posts_per_page' => 8,
      'category' => '',
      // 'template' => 'symmetrical',
    ] );

    $args = [
      'posts_per_page' => $params[ 'posts_per_page' ],
      'paged' => 1,
      'post_type' => 'post',
      'post_status' => 'publish',
    ];

    if( ! empty( $params[ 'category' ] ) ) {
      $args[ 'category__in' ] = explode( ',', $params[ 'category' ] );
			// $args[ 'tax_query' ] = [
			// 	[ 
			// 		'taxonomy' => 'course-category',
			// 		'field'    => 'term_id',
			// 		'terms'    => explode( ',', $params[ 'category' ] ),
			// 	]
			// ];
		}

    $_posts = get_posts( $args );

    return count( $_posts ) ? array_map( function( $p ) {
      $url = get_the_post_thumbnail_url( $p->ID, 'large' );
      $p->thumb_url = $url ? $url : 'https://via.placeholder.com/800x600';
      $p->post_url = get_the_permalink( $p->ID );
      $p->post_excerpt = wp_trim_words( $p->post_excerpt, 16, '...' );
      return $p;
    }, $_posts ) : [];
  }

  static function post_special_class( $inc, $template ) {
    // if( $template == 'symmetrical' ) {
    // 	return (($inc % 3 == 0) ? '__is-special' : '');
    // }

    return '';
  }

  static function build_template( $posts, $template = 'default' ) {
    if( count( $posts ) <= 0 ) return;

    ob_start();
    ?>
    <div class="pp-posts-grid temp__<?= $template ?>">
      <? foreach( $posts as $index => $p ) : ?>
      <div class="post-item <?= DIPP_GridPosts::post_special_class( $index + 1, $template ) ?>">
        <div class="post-inner">
          <div class="post-thumb">
            <a href="<?= $p->post_url ?>" class="thumb-background" style="background: url(<?= $p->thumb_url ?>) no-repeat center center / cover, #222;">
              <!-- <img src="<?= $p->thumb_url ?>" alt="<?= $p->post_title ?>"> -->
            </a>
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

    $posts = self::get_posts( [
      'category' => $this->props['category'],
    ] );
    $content = self::build_template( $posts );
    $template = 'default';

    return sprintf( 
    '<div class="pp-module-grid-posts"><h2 class="heading-text __heading-%4$s" style="color: %3$s;">%1$s</h2> %2$s</div>', 
    $this->props['heading'],
    $content,
    $this->props['heading_text_color'],
    $template );
  }
} 

new DIPP_GridPosts;
