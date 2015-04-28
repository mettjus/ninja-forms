<?php if ( ! defined( 'ABSPATH' ) ) exit;
/**
 * Handles interactions with our field data, as well as outputting settings editing and front-end display.
 *
 * @package     Ninja Forms
 * @subpackage  Classes/Fields
 * @copyright   Copyright (c) 2015, WPNINJAS
 * @license     http://opensource.org/licenses/gpl-2.0.php GNU Public License
 * @since       3.0
*/

class NF_Field
{
	var $id = '';
	var $type = '';
	var $form_id = '';
	var $order = '';
	var $fav_id = '';
	var $def_id = '';
	var $settings = array();
	
	function __construct( $id = '', $meta = array() ) {
		if ( ! empty ( $id ) ) {
			// We have been passed a field ID, so we need to populate our id and data.
			$this->id = $id;
			$this->populate( $meta );
		}
	}

	/**
	 * Populate our settings from our meta array
	 * @since 3.0
	 * @return void
	 */
	public function populate( $meta = array() ) {
		if ( empty ( $meta ) ) {
			$meta = $this->fetch();
		}

		foreach ( $meta as $m ) {
			if ( '' == $this->form_id ) {
				$this->form_id = $m['form_id'];
			}

			switch ( $m['meta_key'] ) {
				case 'type':
					$this->type = $m['meta_value'];
					break;
				case 'order':
					$this->order = $m['meta_value'];
					break;
				case 'fav_id':
					$this->fav_id = $m['meta_value'];
					break;
				case 'def_id':
					$this->fav_id = $m['meta_value'];
					break;
			}
			$this->settings[ $m[ 'meta_key' ] ] = maybe_unserialize( $m['meta_value'] );
		}
	}

	/**
	 * Grab our settings from the database
	 * @since  3.0
	 * @return void
	 */
	public function fetch() {
		global $wpdb;
		return $wpdb->get_results( $wpdb->prepare( "SELECT " . NF_FIELDS_TABLE_NAME . ".form_id as 'form_id', " . NF_FIELDMETA_TABLE_NAME . ".meta_key, " . NF_FIELDMETA_TABLE_NAME . ".meta_value FROM " . NF_FIELDMETA_TABLE_NAME . " JOIN " . NF_FIELDS_TABLE_NAME . " ON " . NF_FIELDS_TABLE_NAME . ".id = " . NF_FIELDMETA_TABLE_NAME . ".field_id WHERE field_id = %d", $this->id ), ARRAY_A );
	}

	/**
	 * Get a specific field setting
	 * @since  3.0
	 * @param  string  $meta_key Name of the setting.
	 * @return mixed
	 */
	public function get_setting( $meta_key ) {
		if ( isset ( $this->settings[ $meta_key ] ) ) {
			return $this->settings[ $meta_key ];
		} else {
			return false;
		}
	}

	/**
	 * Update a specific field setting
	 * @since  3.0
	 * @param  string  $meta_key   Name of the setting being updated
	 * @param  mixed   $meta_value Value of the setting being updated
	 * @return void
	 */
	public function update_setting( $meta_key, $meta_value ) {
		global $wpdb;

		$s_meta_value = maybe_serialize( $meta_value );

		// Check to see if this meta_key/meta_value pair exist for this field_id.
		if ( isset ( $this->settings[ $meta_key ] ) ) {
			$wpdb->update( NF_FIELDMETA_TABLE_NAME, array( 'meta_value' => $s_meta_value ), array( 'meta_key' => $meta_key, 'field_id' => $this->id ) );
		} else {
			$wpdb->insert( NF_FIELDMETA_TABLE_NAME, array( 'field_id' => $this->id, 'meta_key' => $meta_key, 'meta_value' => $s_meta_value ) );
		}

		$this->setting[ $meta_key ] = $meta_value;
	}
}