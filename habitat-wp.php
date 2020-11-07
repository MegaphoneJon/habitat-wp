<?php
/**
 * Plugin Name: Habitat WP
 * Plugin URI: http://github.com/MegaphoneJon/habitat-wp
 * Description: Set the admin bar color based on a constant in wp-config.php
 * Version: 1.0
 * Author: Megaphone Technology Consulting
 * Author URI: https://www.megaphonetech.com
 */

add_action('wp_before_admin_bar_render', 'habitat_wp_color_override', 9);
add_action( 'admin_print_styles', 'habitat_wp_dequeue_cau_css', 11);

/**
 * Disables the CSS added by CiviCRM Admin Utilities that overrides the Civi menu.
 */
function habitat_wp_dequeue_cau_css() {
  wp_dequeue_style('civicrm_admin_utilities_admin_tweaks');
}

/**
 * Overrides the admin bar color on dev/test sites.
 */
function habitat_wp_color_override() {
  $menubarColor = habitat_wp_getcolor();
  if ($menubarColor) {
    $html = <<<HTML
  <style type="text/css">
  #wpadminbar{background:{$menubarColor};}
  </style>
HTML;

    echo $html;
  }

}

/**
 * The admin bar color picker.
 */
function habitat_wp_getcolor() {
  switch (HABITAT_ENVIRONMENT) {
    case 'Dev':
      // Red.
      return '#E22222';

    case 'Test':
      // Orange.
      return '#E29522';
  }
  return NULL;

}
