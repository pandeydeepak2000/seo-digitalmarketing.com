<?php
/**
 * Title: Footer
 * Slug: twentytwentyfive/footer
 * Categories: footer
 * Block Types: core/template-part/footer
 * Description: SEO Digital Marketing Enterprise Agency Footer
 */
$logo_url = home_url( '/wp-content/uploads/sdm-nav-logo.jpg' );
$home_url = home_url( '/' );
?>
<!-- wp:html -->
<footer class="sdm-footer">
	<div class="sdm-footer-inner">
		<div class="sdm-footer-grid">
			<div class="sdm-footer-col sdm-footer-about">
				<div class="sdm-brand">
					<a href="<?php echo esc_url( $home_url ); ?>" class="sdm-logo-link">
						<img src="<?php echo esc_url( $logo_url ); ?>" alt="SEO Digital Marketing" class="sdm-logo-img" />
						<div class="sdm-brand-text">
							<span class="sdm-brand-title">SEO <span class="sdm-gradient-text">DIGITAL</span></span>
							<span class="sdm-brand-sub">SEARCH &amp; AI GROWTH LAB</span>
						</div>
					</a>
				</div>
				<p class="sdm-footer-desc">
					SEO Digital Marketing is an elite search engineering and organic growth lab. We reverse-engineer Google AI Overviews, master technical Core Web Vitals, and build impenetrable topical authority for global enterprises and ambitious digital brands.
				</p>
				<div class="sdm-trust-metrics">
					<div class="sdm-metric-item">
						<strong>10M+</strong>
						<span>Organic Search Impressions</span>
					</div>
					<div class="sdm-metric-item">
						<strong>#1 Rankings</strong>
						<span>High-Value Keywords</span>
					</div>
				</div>
			</div>

			<div class="sdm-footer-col">
				<h4 class="sdm-footer-heading">SEO Capabilities</h4>
				<ul class="sdm-footer-links">
					<li><a href="<?php echo esc_url( $home_url . 'category/ai-search-geo/' ); ?>">Generative Engine Optimization (GEO)</a></li>
					<li><a href="<?php echo esc_url( $home_url . 'category/technical-seo/' ); ?>">Technical SEO &amp; Core Web Vitals</a></li>
					<li><a href="<?php echo esc_url( $home_url . 'category/link-building/' ); ?>">High-Authority Editorial Backlinks</a></li>
					<li><a href="<?php echo esc_url( $home_url . 'category/topical-authority/' ); ?>">E-E-A-T Topical Authority Clusters</a></li>
					<li><a href="<?php echo esc_url( $home_url . 'generative-engine-optimization-geo-ai-ranking-blueprint-2026/' ); ?>">Zero-Click Search Domination</a></li>
				</ul>
			</div>

			<div class="sdm-footer-col">
				<h4 class="sdm-footer-heading">Company &amp; Trust</h4>
				<ul class="sdm-footer-links">
					<li><a href="<?php echo esc_url( $home_url . 'about-us/' ); ?>">About SDM Lab</a></li>
					<li><a href="<?php echo esc_url( $home_url . 'contact-us/' ); ?>">Contact &amp; Audit Request</a></li>
					<li><a href="<?php echo esc_url( $home_url . 'privacy-policy/' ); ?>">Privacy Policy</a></li>
					<li><a href="<?php echo esc_url( $home_url . 'terms-of-service/' ); ?>">Terms of Service</a></li>
					<li><a href="<?php echo esc_url( $home_url . 'disclaimer/' ); ?>">Editorial Disclaimer</a></li>
				</ul>
			</div>

			<div class="sdm-footer-col">
				<h4 class="sdm-footer-heading">Search Intelligence Dispatch</h4>
				<p class="sdm-newsletter-desc">
					Get confidential weekly algorithmic teardowns, Google core update analyses, and actionable GEO blueprints.
				</p>
				<form class="sdm-newsletter-form" onsubmit="event.preventDefault(); alert('Subscribed to Search Intelligence Dispatch!');">
					<input type="email" placeholder="Enter work email..." required class="sdm-newsletter-input" />
					<button type="submit" class="sdm-newsletter-btn">Get Weekly Briefings &#8594;</button>
				</form>
			</div>
		</div>

		<div class="sdm-footer-bottom">
			<p>&copy; <?php echo date('Y'); ?> SEO Digital Marketing. All rights reserved. Search Dominance Engineered.</p>
			<p><a href="<?php echo esc_url( $home_url . 'wp-sitemap.xml' ); ?>" style="color: #64748b; text-decoration: none;">XML Sitemap</a></p>
		</div>
	</div>
</footer>
<!-- /wp:html -->
