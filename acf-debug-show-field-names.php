<?php
/**
 *
 * @link              http://github.com/codebrauer/acf-debug-show-field-names/
 * @since             1.0.0
 * @package           ACF Debug: Show field names
 *
 * @wordpress-plugin
 * Plugin Name:       ACF Debug: Show field names
 * Plugin URI:        http://github.com/codebrauer/acf-debug-show-field-names/
 * Description:       Shows the original ACF field name / meta_key of the value in your posts.
 * Version:           1.0.4
 * Author:            CodeBrauer
 * Author URI:        http://codebrauer.com/
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       acf-debug-show-field-names
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
    die;
}

add_filter('acf/load_field', function($field) {
    if (empty($field['name']) || !is_admin()) {
        return $field;
    }

    // don't edit the field instructions for the acf/acf extended backend itself
    $current_screen = function_exists('get_current_screen') ? get_current_screen() : null;
    if (is_object($current_screen) && preg_match("/acfe?-/", $current_screen->post_type)) {
        return $field;
    }
    
    // add field name in field instructions
    $field_name = '<code style="font-size: 11px">'.$field['name'].'</code>';
    if (strlen($field['instructions']) > 0) {
        $field['instructions'] = $field_name . '<br>' . $field['instructions'];
    } else {
        $field['instructions'] = $field_name;
    }
    return $field;
});
