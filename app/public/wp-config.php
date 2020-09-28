<?php
/**
 * The base configuration for WordPress
 *
 * The wp-config.php creation script uses this file during the
 * installation. You don't have to use the web site, you can
 * copy this file to "wp-config.php" and fill in the values.
 *
 * This file contains the following configurations:
 *
 * * MySQL settings
 * * Secret keys
 * * Database table prefix
 * * ABSPATH
 *
 * @link https://codex.wordpress.org/Editing_wp-config.php
 *
 * @package WordPress
 */

// ** MySQL settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define( 'DB_NAME', 'local' );

/** MySQL database username */
define( 'DB_USER', 'root' );

/** MySQL database password */
define( 'DB_PASSWORD', 'root' );

/** MySQL hostname */
define( 'DB_HOST', 'localhost' );

/** Database Charset to use in creating database tables. */
define( 'DB_CHARSET', 'utf8' );

/** The Database Collate type. Don't change this if in doubt. */
define( 'DB_COLLATE', '' );

/**
 * Authentication Unique Keys and Salts.
 *
 * Change these to different unique phrases!
 * You can generate these using the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}
 * You can change these at any point in time to invalidate all existing cookies. This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define('AUTH_KEY',         '5sHYb3FZlq+zOUV2aetWPGRoP2jgENNiWUbdE3LapzEuMwdQ5uu7zoYWK61Tf3ujRjIbAePB8vlzhJ0LQQ8dOQ==');
define('SECURE_AUTH_KEY',  'k0ObVysxuSX1zz7RkngjsjItzFEq/Sv+TxRC1QRqohTBvQAoecxzH0vE7ddNJZ2cFvBs79hZwti6aaHOFvcqCw==');
define('LOGGED_IN_KEY',    '7VaTvzLcGDxQBhW9DqdsafXzlLaceIfZtc/oaCrYMzIt3kCnuMGOGwWHM/68SoULn1LBDzGZpDTy8/zjlehRug==');
define('NONCE_KEY',        'IMhCZp3wxzVC460KmnuITGDVvEH+KAMwruZ7RvB7tx5G8jf6tcdOQQLehk+S2DsvsC1C+4qgk9NFVnFkdroNHA==');
define('AUTH_SALT',        'Ox4f6COWPQRE9PtUZVTYWVdAboWUVJzEeRaQiOpgB3MBoOUQJyfoOBMVq7egeSAvWKws8q5RrRlQQ1q9Vap1Ww==');
define('SECURE_AUTH_SALT', 'Uu6TxFuSWs3nTM/bapB4CiXTMkBAstbTBrq30j1WWol8yuW1lElOhUEcGGrmg8p13iu8ENb9/40sdO6MmHiUhw==');
define('LOGGED_IN_SALT',   'NjZUU/qDJmaktrVB6+MbYQtdmcDU+w5sBmlVLmDfE55kfNW3rdWLXKTsCjMjAFNC60L/KHuSjH/+d4gUOm036Q==');
define('NONCE_SALT',       'RKaMGSKvMG/4LNpmWFOQTddK/o1emO+g0Fy3uviGyjeehQ1eRwRcdBMCMGuxQBqANxrkHV3pviR5UAHGb72puQ==');

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix = 'wp_';




/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', dirname( __FILE__ ) . '/' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
