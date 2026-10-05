<?php
/**
 * Title: Header
 * Slug: twentytwentyfive/header
 * Categories: header
 * Block Types: core/template-part/header
 * Description: SEO Digital Marketing Luxury Agency Header
 */
$logo_url = home_url( '/wp-content/uploads/sdm-nav-logo.jpg' );
$home_url = home_url( '/' );
?>
<!-- wp:html -->
<header class="sdm-header">
	<div class="sdm-header-inner">
		<div class="sdm-brand">
			<a href="<?php echo esc_url( $home_url ); ?>" class="sdm-logo-link" title="SEO Digital Marketing - Search Dominance &amp; Growth Lab">
				<img src="<?php echo esc_url( $logo_url ); ?>" alt="SEO Digital Marketing" class="sdm-logo-img" />
				<div class="sdm-brand-text">
					<span class="sdm-brand-title">SEO <span class="sdm-gradient-text">DIGITAL</span></span>
					<span class="sdm-brand-sub">SEARCH &amp; AI GROWTH LAB</span>
				</div>
			</a>
		</div>

		<nav class="sdm-nav" aria-label="Main Navigation">
			<ul class="sdm-nav-list">
				<li><a href="<?php echo esc_url( $home_url ); ?>" class="sdm-nav-item active">Home</a></li>
				<li><a href="<?php echo esc_url( $home_url . 'category/ai-search-geo/' ); ?>" class="sdm-nav-item">AI Search &amp; GEO</a></li>
				<li><a href="<?php echo esc_url( $home_url . 'category/technical-seo/' ); ?>" class="sdm-nav-item">Technical SEO</a></li>
				<li><a href="<?php echo esc_url( $home_url . 'category/link-building/' ); ?>" class="sdm-nav-item">Link Building</a></li>
				<li><a href="<?php echo esc_url( $home_url . 'category/topical-authority/' ); ?>" class="sdm-nav-item">Topical Authority</a></li>
			</ul>
		</nav>

		<div class="sdm-header-actions">
			<a href="<?php echo esc_url( $home_url . 'generative-engine-optimization-geo-ai-ranking-blueprint-2026/' ); ?>" class="sdm-btn-cta">
				<span>Free SEO Audit</span> &#128640;
			</a>
			<button class="sdm-mobile-toggle" aria-label="Toggle navigation" onclick="document.querySelector('.sdm-header').classList.toggle('sdm-mobile-open')">
				<span class="sdm-bar"></span>
				<span class="sdm-bar"></span>
				<span class="sdm-bar"></span>
			</button>
		</div>
	</div>
</header>
<!-- /wp:html -->
