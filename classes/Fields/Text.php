<?php if ( ! defined( 'ABSPATH' ) ) exit;
/**
 * Text Field Type Class.
 * 
 * @package     Ninja Forms
 * @subpackage  Classes/Fields
 * @copyright   Copyright (c) 2015, WPNINJAS
 * @license     http://opensource.org/licenses/gpl-2.0.php GNU Public License
 * @since       3.0
*/

class NF_Fields_Text extends NF_Fields_BaseField
{

	/**
	 * Get things rolling
	 * @since 3.0
	 */
	function __construct() {
		parent::__construct();
		$this->name = __( 'Single Line Text', 'ninja-forms' );

		$basic_settings = array(
			'placeholder' 		=> array(
				'type'			=> 'text',
				'label'			=> __( 'Placeholder', 'ninja-forms' ),
			),
		);

		$this->edit_settings['basic'] = wp_parse_args( $basic_settings, $this->edit_settings['basic'] );

		$res_settings = array(
			'disable_input' 	=> array(
				'type'			=> 'checkbox',
				'label'			=> __( 'Disable Input', 'ninja-forms' ),
			),
			'mask_type'			=> array(
				'type'			=> 'select',
				'label'			=> __( 'Input Mask', 'ninja-forms' ),
				'options'		=> array(
					array( 'name' => 'None', 'value' => '' ),
					array( 'name' => 'Phone (555) 555-5555', 'value' => '(999) 999-9999' ),
					array( 'name' => 'Date', 'value' => 'date' ),
					array( 'name' => 'Currency', 'value' => 'currency' ),
					array( 'name' => 'Custom', 'value' => '_custom' ),
				),
			),
			'mask'				=> array(
				'type'			=> 'text',
				'label'			=> __( 'Custom Mask Definition', 'ninja-forms' ),
			),
			'input_limit'		=> array(
				'type'			=> 'text',
				'label'			=> __( 'Limit input to this number', 'ninja-forms' ),
				'desc'			=> __( 'If you leave the box empty, no limit will be used', 'ninja-forms' ),
			),
			'input_limit_type'	=> array(
				'type'			=> 'select',
				'label'			=> __( 'of', 'ninja-forms' ),
				'options'		=> array(
					array( 'name' => __( 'Characters', 'ninja-forms' ), 'value' => 'char' ),
					array( 'name' => __( 'Words', 'ninja-forms' ), 'value' => 'word' ),
				),
			),
			'input_limit_msg'	=> array(
				'type'			=> 'text',
				'label'			=> __( 'Text to appear after character/word counter', 'ninja-forms' ),
				'desc'			=> __( 'character(s) remaining', 'ninja-forms' ),
			),
		);

		$this->edit_settings['restrictions'] = wp_parse_args( $res_settings, $this->edit_settings['restrictions'] );

		$adv_settings = array(
			'default_value_type'=> array(
				'type'			=> 'select',
				'label'			=> __( 'Default Value', 'ninja-forms' ),
				'options'		=> array(
					array( 'name' => __( 'None', 'ninja-forms' ), 'value' => '' ),
					array( 'name' => __( 'User ID (If logged in)', 'ninja-forms'), 'value' => '_user_id' ),
					array( 'name' => __( 'User Firstname (If logged in)', 'ninja-forms'), 'value' => '_user_firstname' ),
					array( 'name' => __( 'User Lastname (If logged in)', 'ninja-forms'), 'value' => '_user_lastname' ),
					array( 'name' => __( 'User Display Name (If logged in)', 'ninja-forms'), 'value' => '_user_display_name' ),
					array( 'name' => __( 'User Email (If logged in)', 'ninja-forms'), 'value' => '_user_email' ),
					array( 'name' => __( 'Post / Page ID (If available)', 'ninja-forms'), 'value' => 'post_id' ),
					array( 'name' => __( 'Post / Page Title (If available)', 'ninja-forms'), 'value' => 'post_title' ),
					array( 'name' => __( 'Post / Page URL (If available)', 'ninja-forms'), 'value' => 'post_url' ),
					array( 'name' => __( 'Today\'s Date', 'ninja-forms'), 'value' => 'today' ),
					array( 'name' => __( 'Custom -&gt;', 'ninja-forms'), 'value' => '_custom' ),
					array( 'name' => __( 'Querystring Variable -&gt;', 'ninja-forms'), 'value' => 'querystring' ),
				),
			),
			'default_value'		=> array(
				'type'			=> 'text',
				'label'			=> __( 'Custom Default Value', 'ninja-forms' ),
			),
			'autocomplete_off'	=> array(
				'type'			=> 'checkbox',
				'label'			=> __( 'Disable Browser Autocomplete', 'ninja-forms' ),
			),
			'num_sort'			=> array(
				'type'			=> 'checkbox',
				'label'			=> __( 'Sort as numeric', 'ninja-forms' ),
				'desc'			=> __( 'If this box is checked, this column in the submissions table will sort by number.', 'ninja-forms' ),
			),
		);

		$this->edit_settings['advanced'] = wp_parse_args( $adv_settings, $this->edit_settings['advanced'] );

	}
}