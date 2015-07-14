<?php
/**
 * Widget template. This template can be overriden using the "sp_template_image-widget_widget.php" filter.
 * See the readme.txt file for more info.
 */

// Block direct requests
if ( !defined('ABSPATH') )
	die('-1');

echo $before_widget;

if ( !empty( $instance['link'] ) ) {
  $link_output = '';
	$attr = array(
		'href' => $instance['link'],
		'target' => $instance['linktarget'],
		'class' => 	$this->widget_options['classname'].'-image-link',
		'title' => ( !empty( $instance['alt'] ) ) ? $instance['alt'] : $instance['title'],
	);
	$attr = apply_filters('image_widget_link_attributes', $attr, $instance );
	$attr = array_map( 'esc_attr', $attr );
	$link_output = '<a';
	foreach ( $attr as $name => $value ) {
		$link_output .= sprintf( ' %s="%s"', $name, $value );
	}
	$link_output .= '>';
  echo $link_output;
}

if ( !empty( $title ) ) { echo $before_title . $title . $after_title; }

echo $this->get_image_html( $instance, false );

if ( !empty( $description ) ) {
	echo '<div class="'.$this->widget_options['classname'].'-description" >';
	echo wpautop( $description );
	echo "</div>";
}

if ( !empty( $instance['link'] ) ) {
	echo '</a>';
}

echo $after_widget;
?>
