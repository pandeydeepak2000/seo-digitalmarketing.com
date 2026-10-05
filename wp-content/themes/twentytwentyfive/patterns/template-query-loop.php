<?php
/**
 * Title: Query Loop
 * Slug: twentytwentyfive/template-query-loop
 * Categories: query
 * Block Types: core/query
 * Description: SDM Luxury Card Grid
 */
?>
<!-- wp:query {"queryId":1,"query":{"perPage":9,"pages":0,"offset":0,"postType":"post","order":"desc","orderBy":"date","author":"","search":"","exclude":[],"sticky":"","inherit":true},"align":"wide","layout":{"type":"constrained"}} -->
<div class="wp-block-query alignwide sdm-container">
	<!-- wp:post-template {"layout":{"type":"default"}} -->
		<!-- wp:post-featured-image {"isLink":true,"aspectRatio":"16/9"} /-->
		<div class="sdm-card-body">
			<!-- wp:post-terms {"term":"category","className":"sdm-badge-cat"} /-->
			<!-- wp:post-title {"isLink":true} /-->
			<!-- wp:post-excerpt {"moreText":"Read Complete Blueprint &#8594;","excerptLength":26} /-->
			<div class="sdm-card-meta">
				<!-- wp:post-author-name {"isLink":true} /-->
				<!-- wp:post-date /-->
			</div>
		</div>
	<!-- /wp:post-template -->

	<!-- wp:query-pagination {"layout":{"type":"flex","justifyContent":"space-between"}} -->
		<!-- wp:query-pagination-previous /-->
		<!-- wp:query-pagination-numbers /-->
		<!-- wp:query-pagination-next /-->
	<!-- /wp:query-pagination -->
</div>
<!-- /wp:query -->
