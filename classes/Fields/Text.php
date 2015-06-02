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
		$this->name = __( 'Single Line Text', 'ninja-forms' );

		$this->edit_settings = array(
			'restrictions' => array(
				array(
					'type' => 'checkbox',
					'name' => 'email',
					'label' => __( 'Validate as an email address? (Field must be required)', 'ninja-forms' ),
				),
				array(
					'type' => 'checkbox',
					'label' => __( 'Disable Input', 'ninja-forms' ),
					'name' => 'disable_input',
				),
			),
			'advanced' => array(
				array(
					'type' => 'checkbox',
					'name' => 'datepicker',
					'label' => __( 'Datepicker', 'ninja-forms' ),
				),
				array(
					'type' => 'checkbox',
					'label' => __( 'This is the user\'s state', 'ninja-forms' ),
					'name' => 'user_state',
				),
			),
		);

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