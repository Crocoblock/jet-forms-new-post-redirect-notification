<?php
/**
 * Plugin Name: JetEngine Forms - new post redirect notification
 * Plugin URI:
 * Description:
 * Version:     1.0.0
 * Author:      Crocoblock
 * Author URI:  https://crocoblock.com/
 * Text Domain: jet-forms-new-post-redirect-notification
 * License:     GPL-3.0+
 * License URI: http://www.gnu.org/licenses/gpl-3.0.txt
 * Domain Path: /languages
 */


// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
    die();
}

add_action( 'plugins_loaded', 'jet_forms_new_post_redirect_notification' );

function jet_forms_new_post_redirect_notification() {

    define( 'JET_FORMS_NPR_NOTIFICATION_VERSION', '1.0.0' );

    define( 'JET_FORMS_NPR_NOTIFICATION__FILE__', __FILE__ );
    define( 'JET_FORMS_NPR_NOTIFICATION_PLUGIN_BASE', plugin_basename( JET_FORMS_NPR_NOTIFICATION__FILE__ ) );
    define( 'JET_FORMS_NPR_NOTIFICATION_PATH', plugin_dir_path( JET_FORMS_NPR_NOTIFICATION__FILE__ ) );
    define( 'JET_FORMS_NPR_NOTIFICATION_URL', plugins_url( '/', JET_FORMS_NPR_NOTIFICATION__FILE__ ) );

    require JET_FORMS_NPR_NOTIFICATION_PATH . 'includes' . DIRECTORY_SEPARATOR . 'plugin.php';
}
