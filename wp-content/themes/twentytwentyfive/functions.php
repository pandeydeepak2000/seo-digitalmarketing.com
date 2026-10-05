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

// Enqueue styles
function sdm_enqueue_assets() {
	wp_enqueue_style( 'sdm-premium', get_template_directory_uri() . '/assets/css/sdm-premium.css', array(), '1.0.0' );
}
add_action( 'wp_enqueue_scripts', 'sdm_enqueue_assets', 99 );

// Inlined Critical CSS for 100/100 PageSpeed
function sdm_inject_critical_styles() {
	$css_file = get_template_directory() . '/assets/css/sdm-premium.css';
	if ( file_exists( $css_file ) ) {
		echo "\n<!-- SDM Critical Inlined Styles -->\n";
		echo "<style id=\"sdm-critical-css\">\n" . file_get_contents( $css_file ) . "\n</style>\n";
	}
}
add_action( 'wp_head', 'sdm_inject_critical_styles', 999 );

// Preconnects & Resource Hints
function sdm_inject_resource_hints() {
	echo "\n<!-- Resource Hints for High-Speed SEO -->\n";
	echo '<link rel="preconnect" href="https://fonts.googleapis.com">' . "\n";
	echo '<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>' . "\n";
	echo '<link rel="preconnect" href="https://www.googletagmanager.com">' . "\n";
	echo '<link rel="dns-prefetch" href="https://www.google-analytics.com">' . "\n";
}
add_action( 'wp_head', 'sdm_inject_resource_hints', 0 );

/**
 * SEO Digital Marketing Enterprise SEO & Rich Schema Engine
 */
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

// Security Hardening
add_filter( 'xmlrpc_enabled', '__return_false' );
remove_action( 'wp_head', 'rsd_link' );
remove_action( 'wp_head', 'wlwmanifest_link' );
remove_action( 'wp_head', 'wp_generator' );
add_filter( 'the_generator', '__return_empty_string' );
