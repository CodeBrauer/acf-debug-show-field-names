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
 * Version:           1.0.1
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

define( 'PLUGIN_NAME_VERSION', '1.0.1' );

add_filter('acf/load_field', function($field) {
    global $post;
    if (empty($field['name'])) {
        return $field;
    }
    $field_name = '<code style="font-size: 11px">'.$field['name'].'</code>';
    if (strlen($field['instructions']) > 0) {
        $field['instructions'] = $field_name . '<br>' . $field['instructions'];
    } else {
        $field['instructions'] = $field_name;
    }
    return $field;
});
