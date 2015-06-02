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

class NF_Fields_SubmitButton extends NF_Fields_BaseField
{

	/**
	 * Get things rolling
	 * @since 3.0
	 */
	function __construct() {
		parent::__construct();
		$this->name = __( 'Submit Button', 'ninja-forms' );

		unset( $this->edit_sections['calculations'] );
		unset( $this->edit_sections['restrictions'] );

		unset( $this->edit_settings['basic']['label_pos'] );
		unset( $this->edit_settings['advanced']['admin_label'] );

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