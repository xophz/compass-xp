<?php

/**
 * The admin-specific functionality of the plugin.
 *
 * @link       http://example.com
 * @since      1.0.0
 *
 * @package    Xophz_Compass_Xp
 * @subpackage Xophz_Compass_Xp/admin
 */

/**
 * The admin-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    Xophz_Compass_Xp
 * @subpackage Xophz_Compass_Xp/admin
 * @author     Your Name <email@example.com>
 */
class Xophz_Compass_Xp_Accessories {

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
    'init' => [
      'codex_accessories_init',
    ],
    'manage_edit-xp_accessory_columns' => 'xp_accessory_columns',
    'wp_ajax_list_accessories' => 'listAccessories',
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

  /**
  * Register an gold point shop post type.
  *
  * @link http://codex.wordpress.org/Function_Reference/register_post_type
  */
  public function codex_accessories_init() {
    $labels = array(
      'name'               => __( 'Accessories', 'post type general name', 'xophz-compass-xp-ability' ),
      'singular_name'      => __( 'Accessory', 'post type singular name', 'xophz-compass-xp-ability' ),
      'menu_name'          => __( 'Accessories', 'admin menu', 'xophz-compass-xp-ability' ),
      'name_admin_bar'     => __( 'Accessory', 'add new on admin bar', 'xophz-compass-xp-ability' ),
      'add_new'            => __( 'Add New', 'ability', 'xophz-compass-xp-ability' ),
      'add_new_item'       => __( 'Add New Accessory', 'xophz-compass-xp-ability' ),
      'new_item'           => __( 'New Accessory', 'xophz-compass-xp-ability' ),
      'edit_item'          => __( 'Edit Accessory', 'xophz-compass-xp-ability' ),
      'view_item'          => __( 'View Accessory', 'xophz-compass-xp-ability' ),
      'all_items'          => __( 'All Accessories', 'xophz-compass-xp-ability' ),
      'search_items'       => __( 'Search Accessories', 'xophz-compass-xp-ability' ),
      'parent_item_colon'  => __( 'Parent Accessories:', 'xophz-compass-xp-ability' ),
      'not_found'          => __( 'No abilities found.', 'xophz-compass-xp-ability' ),
      'not_found_in_trash' => __( 'No abilities found in Trash.', 'xophz-compass-xp-ability' )
    );

    $args = array(
      'labels'             => $labels,
      'description'        => __( 'Description.', 'xophz_compass_xp_ability' ),
      'public'             => true,
      'publicly_queryable' => true,
      'show_ui'            => true,
      'show_in_menu'       => true,
      'show_in_rest'       => true,
      'query_var'          => true,
      'rewrite'            => array( 'slug' => 'ability','with_front' => false ),
      'capability_type'    => 'post',
      'has_archive'        => true,
      'hierarchical'        => false,
      'menu_icon'          => 'dashicons-buddicons-groups',
      'menu_position'      => false,
      'supports'           => array( 
        'title', 
        'editor', 
        'author', 
        'thumbnail', 
        'custom-fields',
        'page-attributes' /* This will show the post parent field */,
      )
    );

    register_post_type( 'xp_accessory', $args );
  }

  public function xp_accessory_columns($defaults){
    $defaults['gp_cost'] = __('GP Cost');
    $defaults['accessory_unlocked'] = __('Unlocked @');
    return $defaults;
  }
  
  public function listAccessories(){
    $args = Xophz_Compass::get_input_json();

      $args = array(
        'posts_per_page'   => -1,
        // 'offset'           => 0,
        // 'cat'         => '',
        // 'category_name'    => '',
        'orderby'          => 'post_title',
        'order'            => 'ASC',
        // 'include'          => '',
        // 'exclude'          => '',
        // 'meta_key'         => '',
        // 'meta_value'       => '',
        'post_type'        => 'xp_accessory',
        // 'post_mime_type'   => '',
        // 'post_parent'      => '',
        // 'author'	   => '',
        // 'author_name'	   => '',
        // 'post_status'      => 'publish',
        // 'suppress_filters' => true,
        // 'fields'           => '',
      );
    $posts = get_posts( $args );

    $accessories = [];
    foreach ($posts as $p) {
      $accessories[] = [
        'title' => $p->post_title,
        'img' => get_the_post_thumbnail_url($p->ID),
        'repeats_count' => get_post_meta($p->ID,'_xp_accessory_repeat_count',true),
        'repeats_every' => get_post_meta($p->ID,'_xp_accessory_repeat_every',true),
        'repeats_on' => get_post_meta($p->ID,'_xp_accessory_repeat_on',true),
        // 'xp' => get_post_meta($p->ID,'_xp_accessory_xp',true),
        'gp_cost' => get_post_meta($p->ID,'_xp_accessory_gp_cost',true),
        'ap' => get_post_meta($p->ID,'_xp_accessory_ap_to_unlock',true),
      ];
    }


    $out = [
      'accessories' => $accessories 
    ];


    Xophz_Compass::output_json($out);
  }


}
