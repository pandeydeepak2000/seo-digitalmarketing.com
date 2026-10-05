<?php
/**
 * Twenty Twenty-Five functions and definitions.
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package WordPress
 * @subpackage Twenty_Twenty_Five
 * @since Twenty Twenty-Five 1.0
 */

if ( ! function_exists( 'twentytwentyfive_post_format_setup' ) ) :
	/**
	 * Adds theme support for post formats.
	 *
	 * @since Twenty Twenty-Five 1.0
	 *
	 * @return void
	 */
	function twentytwentyfive_post_format_setup() {
		add_theme_support( 'post-formats', array( 'aside', 'audio', 'chat', 'gallery', 'image', 'link', 'quote', 'status', 'video' ) );
	}
endif;
add_action( 'after_setup_theme', 'twentytwentyfive_post_format_setup' );

if ( ! function_exists( 'twentytwentyfive_editor_style' ) ) :
	/**
	 * Enqueues editor-style.css in the editors.
	 *
	 * @since Twenty Twenty-Five 1.0
	 *
	 * @return void
	 */
	function twentytwentyfive_editor_style() {
		add_editor_style( 'assets/css/editor-style.css' );
	}
endif;
add_action( 'after_setup_theme', 'twentytwentyfive_editor_style' );

if ( ! function_exists( 'twentytwentyfive_enqueue_styles' ) ) :
	/**
	 * Enqueues the theme stylesheet on the front.
	 *
	 * @since Twenty Twenty-Five 1.0
	 *
	 * @return void
	 */
	function twentytwentyfive_enqueue_styles() {
		$suffix = SCRIPT_DEBUG ? '' : '.min';
		$src    = 'style' . $suffix . '.css';

		wp_enqueue_style(
			'twentytwentyfive-style',
			get_parent_theme_file_uri( $src ),
			array(),
			wp_get_theme()->get( 'Version' )
		);
		wp_style_add_data(
			'twentytwentyfive-style',
			'path',
			get_parent_theme_file_path( $src )
		);

		// Enqueue TopBlogTech Premium Custom Styling
		wp_enqueue_style(
			'topblogtech-premium-style',
			get_parent_theme_file_uri( 'assets/css/topblogtech-premium.css' ),
			array( 'twentytwentyfive-style' ),
			time()
		);
	}
endif;
add_action( 'wp_enqueue_scripts', 'twentytwentyfive_enqueue_styles' );

if ( ! function_exists( 'twentytwentyfive_block_styles' ) ) :
	/**
	 * Registers custom block styles.
	 *
	 * @since Twenty Twenty-Five 1.0
	 *
	 * @return void
	 */
	function twentytwentyfive_block_styles() {
		register_block_style(
			'core/list',
			array(
				'name'         => 'checkmark-list',
				'label'        => __( 'Checkmark', 'twentytwentyfive' ),
				'inline_style' => '
				ul.is-style-checkmark-list {
					list-style-type: "\2713";
				}

				ul.is-style-checkmark-list li {
					padding-inline-start: 1ch;
				}',
			)
		);
	}
endif;
add_action( 'init', 'twentytwentyfive_block_styles' );

if ( ! function_exists( 'twentytwentyfive_pattern_categories' ) ) :
	/**
	 * Registers pattern categories.
	 *
	 * @since Twenty Twenty-Five 1.0
	 *
	 * @return void
	 */
	function twentytwentyfive_pattern_categories() {

		register_block_pattern_category(
			'twentytwentyfive_page',
			array(
				'label'       => __( 'Pages', 'twentytwentyfive' ),
				'description' => __( 'A collection of full page layouts.', 'twentytwentyfive' ),
			)
		);

		register_block_pattern_category(
			'twentytwentyfive_post-format',
			array(
				'label'       => __( 'Post formats', 'twentytwentyfive' ),
				'description' => __( 'A collection of post format patterns.', 'twentytwentyfive' ),
			)
		);
	}
endif;
add_action( 'init', 'twentytwentyfive_pattern_categories' );

if ( ! function_exists( 'twentytwentyfive_register_block_bindings' ) ) :
	/**
	 * Registers the post format block binding source.
	 *
	 * @since Twenty Twenty-Five 1.0
	 *
	 * @return void
	 */
	function twentytwentyfive_register_block_bindings() {
		register_block_bindings_source(
			'twentytwentyfive/format',
			array(
				'label'              => _x( 'Post format name', 'Label for the block binding placeholder in the editor', 'twentytwentyfive' ),
				'get_value_callback' => 'twentytwentyfive_format_binding',
			)
		);
	}
endif;
add_action( 'init', 'twentytwentyfive_register_block_bindings' );

if ( ! function_exists( 'twentytwentyfive_format_binding' ) ) :
	/**
	 * Callback function for the post format name block binding source.
	 *
	 * @since Twenty Twenty-Five 1.0
	 *
	 * @return string|void Post format name, or nothing if the format is 'standard'.
	 */
	function twentytwentyfive_format_binding() {
		$post_format_slug = get_post_format();

		if ( $post_format_slug && 'standard' !== $post_format_slug ) {
			return get_post_format_string( $post_format_slug );
		}
	}
endif;

/**
 * TopBlogTech Automated SEO & Schema Engine
 */


/**
 * TopBlogTech Enterprise Security Hardening
 */
// 1. Disable XML-RPC completely (Blocks 95% of automated brute-force attacks)
add_filter( 'xmlrpc_enabled', '__return_false' );
remove_action( 'wp_head', 'rsd_link' );
remove_action( 'wp_head', 'wlwmanifest_link' );

// 2. Hide WordPress Version everywhere (prevents bot vulnerability scans)
remove_action( 'wp_head', 'wp_generator' );
add_filter( 'the_generator', '__return_empty_string' );

// 3. Prevent Username Enumeration / Author Scans (?author=1)
if ( ! is_admin() && isset( $_REQUEST['author'] ) ) {
	wp_redirect( home_url( '/' ), 301 );
	exit;
}

// 4. Remove version strings from scripts and styles for security through obscurity
function tbt_remove_ver_css_js( $src ) {
	if ( strpos( $src, '?ver=' ) ) {
		$src = remove_query_arg( 'ver', $src );
	}
	return $src;
}
add_filter( 'style_loader_src', 'tbt_remove_ver_css_js', 9999 );
add_filter( 'script_loader_src', 'tbt_remove_ver_css_js', 9999 );

/**
 * TopBlogTech Google Analytics (GA4) Tracking Script
 * Stream: topblog (https://topblogtech.com)
 * Measurement ID: G-SNDLMK8H9E
 */

/**
 * SEO DIGITAL MARKETING (SDM) - ENTERPRISE SEO, CRITICAL CSS & PERFORMANCE ENGINE
 */

// 1. Resource Hints for Core Web Vitals
function sdm_inject_resource_hints() {
	echo "\n<!-- Resource Hints for High Speed SEO -->\n";
	echo '<link rel="preconnect" href="https://fonts.googleapis.com">' . "\n";
	echo '<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>' . "\n";
	echo '<link rel="preconnect" href="https://www.googletagmanager.com">' . "\n";
	echo '<link rel="dns-prefetch" href="https://www.google-analytics.com">' . "\n";
}
add_action( 'wp_head', 'sdm_inject_resource_hints', 0 );

// 2. SEO & Schema Engine
function sdm_inject_seo_meta() {
	$site_name    = 'SEO Digital Marketing';
	$site_domain  = 'https://seo-digitalmarketing.com';
	$default_desc = 'SEO Digital Marketing is an elite search engine optimization and organic growth agency. We specialize in Generative Engine Optimization (GEO), Core Web Vitals technical audits, white-hat editorial link building, and E-E-A-T topical authority architecture.';
	$logo_url     = home_url( '/wp-content/uploads/sdm-nav-logo.jpg' );

	echo "\n<!-- Search Engine Directives -->\n";
	echo '<meta name="robots" content="index, follow, max-image-preview:large, max-snippet:-1, max-video-preview:-1" />' . "\n";

	if ( is_singular() ) {
		global $post;
		$title          = get_the_title() . ' | ' . $site_name;
		$excerpt        = has_excerpt() ? get_the_excerpt() : wp_trim_words( strip_shortcodes( $post->post_content ), 26, '...' );
		$canonical      = get_permalink();
		$thumb_id       = get_post_thumbnail_id();
		$image_url      = $thumb_id ? wp_get_attachment_image_url( $thumb_id, 'full' ) : $logo_url;
		$published_time = get_the_date( 'c' );
		$modified_time  = get_the_modified_date( 'c' );
		$author_name    = get_the_author() ? get_the_author() : 'SDM Research Team';
		$categories     = get_the_category();
		$cat_name       = ! empty( $categories ) ? $categories[0]->name : 'Search Engine Optimization';

		echo "\n<!-- SDM Article SEO Meta Tags -->\n";
		echo '<meta name="description" content="' . esc_attr( $excerpt ) . '" />' . "\n";
		echo '<link rel="canonical" href="' . esc_url( $canonical ) . '" />' . "\n";
		echo '<meta property="og:locale" content="en_US" />' . "\n";
		echo '<meta property="og:type" content="article" />' . "\n";
		echo '<meta property="og:title" content="' . esc_attr( $title ) . '" />' . "\n";
		echo '<meta property="og:description" content="' . esc_attr( $excerpt ) . '" />' . "\n";
		echo '<meta property="og:url" content="' . esc_url( $canonical ) . '" />' . "\n";
		echo '<meta property="og:site_name" content="' . esc_attr( $site_name ) . '" />' . "\n";
		echo '<meta property="article:published_time" content="' . esc_attr( $published_time ) . '" />' . "\n";
		echo '<meta property="article:modified_time" content="' . esc_attr( $modified_time ) . '" />' . "\n";
		echo '<meta property="article:section" content="' . esc_attr( $cat_name ) . '" />' . "\n";
		echo '<meta property="og:image" content="' . esc_url( $image_url ) . '" />' . "\n";
		echo '<meta property="og:image:alt" content="' . esc_attr( get_the_title() ) . '" />' . "\n";
		echo '<meta name="twitter:card" content="summary_large_image" />' . "\n";
		echo '<meta name="twitter:title" content="' . esc_attr( $title ) . '" />' . "\n";
		echo '<meta name="twitter:description" content="' . esc_attr( $excerpt ) . '" />' . "\n";
		echo '<meta name="twitter:image" content="' . esc_url( $image_url ) . '" />' . "\n";

		// Article Schema
		$article_schema = array(
			'@context'         => 'https://schema.org',
			'@type'            => 'BlogPosting',
			'headline'         => get_the_title(),
			'description'      => $excerpt,
			'image'            => $image_url,
			'datePublished'    => $published_time,
			'dateModified'     => $modified_time,
			'inLanguage'       => 'en-US',
			'mainEntityOfPage' => array(
				'@type' => 'WebPage',
				'@id'   => $canonical,
			),
			'author'           => array(
				'@type' => 'Person',
				'name'  => $author_name,
				'url'   => home_url( '/about-us/' ),
			),
			'publisher'        => array(
				'@type' => 'Organization',
				'name'  => $site_name,
				'url'   => $site_domain,
				'logo'  => array(
					'@type' => 'ImageObject',
					'url'   => $logo_url,
				),
			),
		);
		echo '<script type="application/ld+json">' . json_encode( $article_schema, JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT ) . '</script>' . "\n";

		// BreadcrumbList Schema
		$breadcrumb_schema = array(
			'@context'        => 'https://schema.org',
			'@type'           => 'BreadcrumbList',
			'itemListElement' => array(
				array(
					'@type'    => 'ListItem',
					'position' => 1,
					'name'     => 'Home',
					'item'     => home_url( '/' ),
				),
				array(
					'@type'    => 'ListItem',
					'position' => 2,
					'name'     => $cat_name,
					'item'     => ! empty( $categories ) ? get_category_link( $categories[0]->term_id ) : home_url( '/' ),
				),
				array(
					'@type'    => 'ListItem',
					'position' => 3,
					'name'     => get_the_title(),
					'item'     => $canonical,
				),
			),
		);
		echo '<script type="application/ld+json">' . json_encode( $breadcrumb_schema, JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT ) . '</script>' . "\n";

	} else {
		$canonical = is_home() || is_front_page() ? home_url( '/' ) : ( ( isset( $_SERVER['HTTPS'] ) && 'on' === $_SERVER['HTTPS'] ? 'https' : 'http' ) . '://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'] );
		$page_title = is_category() ? single_cat_title( '', false ) . ' | ' . $site_name : $site_name . ' | Search Engine Optimization & Growth Lab';

		echo "\n<!-- SDM Site SEO Meta Tags -->\n";
		echo '<meta name="description" content="' . esc_attr( $default_desc ) . '" />' . "\n";
		echo '<link rel="canonical" href="' . esc_url( $canonical ) . '" />' . "\n";
		echo '<meta property="og:locale" content="en_US" />' . "\n";
		echo '<meta property="og:type" content="website" />' . "\n";
		echo '<meta property="og:title" content="' . esc_attr( $page_title ) . '" />' . "\n";
		echo '<meta property="og:description" content="' . esc_attr( $default_desc ) . '" />' . "\n";
		echo '<meta property="og:url" content="' . esc_url( $canonical ) . '" />' . "\n";
		echo '<meta property="og:site_name" content="' . esc_attr( $site_name ) . '" />' . "\n";
		echo '<meta property="og:image" content="' . esc_url( $logo_url ) . '" />' . "\n";
		echo '<meta name="twitter:card" content="summary_large_image" />' . "\n";
		echo '<meta name="twitter:title" content="' . esc_attr( $page_title ) . '" />' . "\n";
		echo '<meta name="twitter:description" content="' . esc_attr( $default_desc ) . '" />' . "\n";
		echo '<meta name="twitter:image" content="' . esc_url( $logo_url ) . '" />' . "\n";

		// WebSite Schema
		$site_schema = array(
			'@context'        => 'https://schema.org',
			'@type'           => 'WebSite',
			'name'            => $site_name,
			'url'             => $site_domain,
			'potentialAction' => array(
				'@type'       => 'SearchAction',
				'target'      => home_url( '/?s={search_term_string}' ),
				'query-input' => 'required name=search_term_string',
			),
		);
		echo '<script type="application/ld+json">' . json_encode( $site_schema, JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT ) . '</script>' . "\n";

		// DigitalMarketingAgency Schema
		$agency_schema = array(
			'@context'       => 'https://schema.org',
			'@type'          => array( 'DigitalMarketingAgency', 'ProfessionalService', 'Organization' ),
			'name'           => $site_name,
			'url'            => $site_domain,
			'logo'           => $logo_url,
			'image'          => $logo_url,
			'description'    => $default_desc,
			'priceRange'     => '$$$',
			'areaServed'     => array(
				'@type' => 'Country',
				'name'  => 'Worldwide',
			),
			'knowsAbout'     => array(
				'Generative Engine Optimization (GEO)',
				'Google AI Overviews Ranking',
				'Core Web Vitals & INP Optimization',
				'White-Hat Editorial Link Building',
				'E-E-A-T Topical Authority',
			),
		);
		echo '<script type="application/ld+json">' . json_encode( $agency_schema, JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT ) . '</script>' . "\n";
	}
}
add_action( 'wp_head', 'sdm_inject_seo_meta', 2 );

// 3. Enqueue Styles & Inlined Critical CSS
function sdm_enqueue_assets() {
	wp_enqueue_style( 'sdm-premium', get_template_directory_uri() . '/assets/css/sdm-premium.css', array(), '1.1.0' );
}
add_action( 'wp_enqueue_scripts', 'sdm_enqueue_assets', 99 );

function sdm_inject_critical_styles() {
	$css_file = get_template_directory() . '/assets/css/sdm-premium.css';
	if ( file_exists( $css_file ) ) {
		echo "\n<!-- SDM Critical Inlined Styles -->\n";
		echo "<style id=\"sdm-critical-css\">\n" . file_get_contents( $css_file ) . "\n</style>\n";
	}
}
add_action( 'wp_head', 'sdm_inject_critical_styles', 999 );

// 4. Security Hardening
add_filter( 'xmlrpc_enabled', '__return_false' );
remove_action( 'wp_head', 'rsd_link' );
remove_action( 'wp_head', 'wlwmanifest_link' );
remove_action( 'wp_head', 'wp_generator' );
add_filter( 'the_generator', '__return_empty_string' );
