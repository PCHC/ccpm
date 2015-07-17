<?php

namespace Roots\Sage\Extras;

use Roots\Sage\Config;

/**
 * Add <body> classes
 */
function body_class($classes) {
  // Add page slug if it doesn't exist
  if (is_single() || is_page() && !is_front_page()) {
    if (!in_array(basename(get_permalink()), $classes)) {
      $classes[] = basename(get_permalink());
    }
  }

  // Add class if sidebar is active
  if (Config\display_sidebar()) {
    $classes[] = 'sidebar-primary';
  }

  return $classes;
}
add_filter('body_class', __NAMESPACE__ . '\\body_class');

/**
 * Clean up the_excerpt()
 */
function excerpt_more() {
  return ' &hellip; <a href="' . get_permalink() . '">' . __('Continued', 'sage') . '</a>';
}
add_filter('excerpt_more', __NAMESPACE__ . '\\excerpt_more');

/**
 * Clean up ACF addresses, remove "United States"
 */
function ccpm_acf_format_address_value( $value, $post_id, $field )
{
  $value['address'] = str_replace( ', United States', '', $value['address'] );
  return $value;
}
// acf/load_value/type={$field_type} - filter for a value load based on it's field type
add_filter('acf/load_value/name=address', __NAMESPACE__ . '\\ccpm_acf_format_address_value', 10, 3);
