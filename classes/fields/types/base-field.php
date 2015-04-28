<?php if ( ! defined( 'ABSPATH' ) ) exit;
/**
 * Base Field Type Class.
 * This class is used as a base for creating field types.
 *
 * It should be extended by new field types, and isn't instantiated itself.
 *
 * @package     Ninja Forms
 * @subpackage  Classes/Fields
 * @copyright   Copyright (c) 2015, WPNINJAS
 * @license     http://opensource.org/licenses/gpl-2.0.php GNU Public License
 * @since       3.0
*/

abstract class NF_Field_Base
{
	var $sidebar = 'template_fields';
	var $edit_options = array();
	var $edit_settings = array();
	/**
	 * Get things rolling
	 * @since 3.0
	 */
	function __construct() {

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

	public function edit_save( $id ) {
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