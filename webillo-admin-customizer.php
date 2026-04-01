<?php
<?php
/**
 * Plugin Name: Webillo Admin Customizer
 * Plugin URI: https://webillo.com/webillo-admin-customizer/
 * Description: A lightweight tool by Webillo to customize the WordPress login logo and dashboard experience. Perfect for brand consistency.
 * Version: 1.0.0
 * Author: Webillo
 * Author URI: https://webillo.com/
 * License: GPLv2 or later
 * Text Domain: webillo-admin-customizer
 */

// Sicurezza: impedisce l'accesso diretto al file
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

/**
 * Cambia il logo della pagina di login con quello del sito
 */
function webillo_login_logo() { ?>
    <style type="text/css">
        #login h1 a, .login h1 a {
            background-image: url(<?php echo esc_url( get_site_icon_url() ); ?>);
            height: 100px;
            width: 100px;
            background-size: contain;
            background-repeat: no-repeat;
            margin-bottom: 20px;
        }
    </style>
<?php }
add_action( 'login_enqueue_scripts', 'webillo_login_logo' );

/**
 * Cambia l'URL del logo del login (punta alla Home del sito, non a WP.org)
 */
function webillo_login_logo_url() {
    return home_url();
}
add_filter( 'login_headerurl', 'webillo_login_logo_url' );

/**
 * Aggiunge un messaggio di benvenuto firmato Webillo nella Dashboard
 */
function webillo_dashboard_widget() {
    wp_add_dashboard_widget(
        'webillo_welcome_widget',
        'Webillo Brand Experience',
        'webillo_dashboard_widget_content'
    );
}
add_action( 'wp_dashboard_setup', 'webillo_dashboard_widget' );

function webillo_dashboard_widget_content() {
    echo "<p>Welcome to your customized dashboard. This site is optimized for a <strong>pixel-perfect</strong> experience by Webillo.</p>";
}