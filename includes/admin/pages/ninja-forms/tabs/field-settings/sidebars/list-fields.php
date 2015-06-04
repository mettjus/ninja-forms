<?php if ( ! defined( 'ABSPATH' ) ) exit;

function ninja_forms_register_sidebar_list_fields(){
	$args = array(
		'name' => __( 'List Fields', 'ninja-forms' ),
		'page' => 'ninja-forms', 
		'tab' => 'builder',
		'display_function' => 'ninja_forms_sidebar_display_fields'
	);
	ninja_forms_register_sidebar('list_fields', $args);
}

add_action('admin_init', 'ninja_forms_register_sidebar_list_fields');