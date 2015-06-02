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

		$adv_settings = array(
			'default_value' => array(
				'type'	=> 'select',
				'label'	=> __( 'Default Value', 'ninja-forms' ),
				'options' => array(
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
			'autocomplete_off'	=> array(
				'type'	=> 'checkbox',
				'label'	=> __( 'Disable Browser Autocomplete', 'ninja-forms' ),
			),
		);

		$this->edit_settings['advanced'] = wp_parse_args( $adv_settings, $this->edit_settings['advanced'] );

	}

	/**
	 * Output our field editing HTML
	 * @since  3.0
	 * @param  int  $id The ID of the field we're editing.
	 * @return void
	 */
	public function edit( $id ) {
		/*
		This space left intentionally blank
		 */
	}

	/**
	 * Output our field display HTML
	 * @since  3.0
	 * @param  int  $id The ID of the field we're displaying.
	 * @return void
	 */
	public function display( $id ) {
		/*
		This space left intentionally blank
		 */
	}

	/**
	 * Run our before_pre_processing function
	 * @since  3.0
	 * @param  int  $id The ID of the field we're processing.
	 * @return void
	 */
	public function before_pre_process( $id ) {
		/*
		This space left intentionally blank
		 */
	}

	/**
	 * Run our pre_processing function
	 * @since  3.0
	 * @param  int  $id The ID of the field we're processing.
	 * @return void
	 */
	public function pre_process( $id ) {
		/*
		This space left intentionally blank
		 */
	}

	/**
	 * Run our processing function
	 * @since  3.0
	 * @param  int  $id The ID of the field we're processing.
	 * @return void
	 */
	public function process( $id ) {
		/*
		This space left intentionally blank
		 */
	}

	/**
	 * Run our post_processing function
	 * @since  3.0
	 * @param  int  $id The ID of the field we're processing.
	 * @return void
	 */
	public function post_process( $id ) {
		/*
		This space left intentionally blank
		 */
	}

}