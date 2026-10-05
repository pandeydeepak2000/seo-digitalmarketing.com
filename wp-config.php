<?php
/**
 * The base configuration for WordPress for seo-digitalmarketing.com
 */

// If local configuration exists, load it
if ( file_exists( __DIR__ . '/wp-config-local.php' ) ) {
    include __DIR__ . '/wp-config-local.php';
} else {
    // Production cPanel Database Configuration
    define( 'DB_NAME', 'earningin_seodigital' );
    define( 'DB_USER', 'earningin_seodigital' );
    define( 'DB_PASSWORD', '5t*H?Ra=ae)]eEbS' );
    define( 'DB_HOST', 'localhost' );
}

define( 'DB_CHARSET', 'utf8mb4' );
define( 'DB_COLLATE', '' );

define( 'AUTH_KEY',         'sdm_k7@98v#34!xLz_q9011244#@kjsdpq_' );
define( 'SECURE_AUTH_KEY',  'sdm_98v_q8@11#4Lzx_kj340911_sdmpq!#' );
define( 'LOGGED_IN_KEY',    'sdm_Lz9011_kjsdpq#4!x@98v#34_sdm!#@' );
define( 'NONCE_KEY',        'sdm_pq#4!xLz_q9011244#@kjsd@98v#34_!' );
define( 'AUTH_SALT',        'sdm_4!xLz_q9011244#@kjsdpq_@98v#34!#' );
define( 'SECURE_AUTH_SALT', 'sdm_q9011244#@kjsdpq_@98v#34!4!xLz_!#' );
define( 'LOGGED_IN_SALT',   'sdm_kjsdpq_@98v#34!4!xLz_q9011244#@!' );
define( 'NONCE_SALT',       'sdm_@98v#34!4!xLz_q9011244#@kjsdpq_!' );

$table_prefix = 'sdm_';

define( 'WP_DEBUG', false );

if ( ! defined( 'ABSPATH' ) ) {
    define( 'ABSPATH', __DIR__ . '/' );
}

require_once ABSPATH . 'wp-settings.php';
