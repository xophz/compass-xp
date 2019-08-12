<?php

/**
 * XP Players Class 
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    Xophz_Compass_Xp
 * @subpackage Xophz_Compass_Xp/admin
 * @author     Your Name <email@example.com>
 */
class Xophz_Compass_Xp_Players {
  /**
  * The ID of this plugin.
  *
  * @since    1.0.0
  * @access   private
  * @var      string    $plugin_name    The ID of this plugin.
  */
  private $plugin_name;

  /**
  * The version of this plugin.
  *
  * @since    1.0.0
  * @access   private
  * @var      string    $version    The current version of this plugin.
  */
  private $version;

  public  $action_hooks = [
    'wp_ajax_xp_list_players' => 'listPlayers',
  ];

  /**
  * Initialize the class and set its properties.
  *
  * @since    1.0.0
  * @param      string    $plugin_name       The name of this plugin.
  * @param      string    $version    The version of this plugin.
  */
  public function __construct( $plugin_name, $version ) {
    $this->plugin_name = $plugin_name;
    $this->version = $version;
  }
  
  ###################################################
  ### AJAX ##########################################
  ###################################################
  /**
   * undocumented function
   *
   * @return void
   */
  public function listPlayers()
  {
    $out = [];

    $args = ['role' => 'achiever'];

    $users = get_users($args);

    $players = [];

    foreach ($users as $User) {
      $id = $User->ID;
      $player = Xophz_Compass_Xp_Admin::getUser($id,false);
      $player['user_login'] = $User->data->user_login;
      $player['display_name'] = $User->data->display_name;
      $player['avatar'] = get_avatar_url($User->ID);
      $players[] = $player;
    }

    $out['players'] = $players;

    Xophz_Compass::output_json($out);
  }
}
