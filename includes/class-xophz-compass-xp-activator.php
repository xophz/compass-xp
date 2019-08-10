<?php

/**
 * Fired during plugin activation
 *
 * @link       http://example.com
 * @since      1.0.0
 *
 * @package    Xophz_Compass_Xp
 * @subpackage Xophz_Compass_Xp/includes
 */

/**
 * Fired during plugin activation.
 *
 * This class defines all code necessary to run during the plugin's activation.
 *
 * @since      1.0.0
 * @package    Xophz_Compass_Xp
 * @subpackage Xophz_Compass_Xp/includes
 * @author     Your Name <email@example.com>
 */
class Xophz_Compass_Xp_Activator {

	/**
	 * Short Description. (use period)
	 *
	 * Long Description.
	 *
	 * @since    1.0.0
	 */
	public static function activate() {
    global $wpdb;
    $xp_db_version = XOPHZ_COMPASS_XP_VERSION;

    $table_name = $wpdb->prefix . 'xp_achievements';
    
    $charset_collate = $wpdb->get_charset_collate();

    $sql = "CREATE TABLE $table_name (
      id mediumint(9) NOT NULL AUTO_INCREMENT,
      post_id mediumint(9),
      user_id mediumint(9),
      xp mediumint(9),
      ap mediumint(9),
      gp mediumint(9),
      time datetime DEFAULT '0000-00-00 00:00:00' NOT NULL,
      redo smallint(1),
      grade smallint(1),
      PRIMARY KEY  (id)
    ) $charset_collate;";

    require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
    dbDelta( $sql );

    add_option( 'xp_db_version', $xp_db_version );

	}
}
