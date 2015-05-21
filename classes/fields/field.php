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
	var $meta = array();

	function __construct( $id = '' )
	{

	}

	/**
	 * Set our field ID
	 * @since 3.0
	 * @return void
	 */
	public function set_id( $id = '' )
	{
		$this->id = $id;
		$this->populate();
	}

	/**
	 * Populate our settings from our meta array
	 * @since 3.0
	 * @return void
	 */
	public function populate()
	{
		global $wpdb;

		if ( ! empty ( Ninja_Forms()->field_data[ $this->id ] ) ) {
			$form_id = Ninja_Forms()->field_data[ $this->id ];
			$field_data = Ninja_Forms()->form( $form_id )->field_data[ $this->id ];
		} else if ( is_object( ( $field_data = get_transient( 'nf_field_' . $this->id ) ) ) ) { 

		} else {
			$field_data = $this->fetch();
			foreach ( $field_data as $d ) {
				if ( ! isset ( $field_data['form_id'] ) ) {
					$field_data['form_id'] = $d['form_id'];
				}
				if ( ! isset ( $field_data['order'] ) ) {
					$field_data['order'] = $d['order'];
				}
				switch ( $d['meta_key'] ) {
					case 'type':
						$field_data['type'] = $d['meta_value'];
						break;
					case 'fav_id':
						$field_data['fav_id'] = $d['meta_value'];
						break;
					case 'def_id':
						$field_data['def_id'] = $d['meta_value'];
						break;
				}
				$field_data['meta'][ $d[ 'meta_key' ] ] = maybe_unserialize( $d['meta_value'] );
			}
			set_transient( 'nf_field_' . $this->id, $field_data );
		}

		if ( ! empty ( $field_data['form_id'] ) ) {
			$this->form_id = $field_data['form_id'];
			$this->type = $field_data['type'];
			$this->order = $field_data['order'];
			$this->fav_id = $field_data['fav_id'];
			$this->def_id = $field_data['def_id'];
			$this->meta = $field_data['meta'];
		} else {
			return false;
		}
	}

	/**
	 * Grab our settings from the database
	 * @since  3.0
	 * @return array
	 */
	public function fetch()
	{
		global $wpdb;
		return $wpdb->get_results( $wpdb->prepare( "SELECT " . NF_FIELDS_TABLE_NAME . ".form_id as 'form_id', " . NF_FIELDS_TABLE_NAME . ".order as 'order', " . NF_FIELDMETA_TABLE_NAME . ".meta_key, " . NF_FIELDMETA_TABLE_NAME . ".meta_value FROM " . NF_FIELDMETA_TABLE_NAME . " JOIN " . NF_FIELDS_TABLE_NAME . " ON " . NF_FIELDS_TABLE_NAME . ".id = " . NF_FIELDMETA_TABLE_NAME . ".field_id WHERE field_id = %d", $this->id ), ARRAY_A );
	}

	/**
	 * Get a specific field setting
	 * @since  3.0
	 * @param  string  $meta_key Name of the setting.
	 * @param  string  $default What to return if nothing is found.
	 * @return mixed
	 */
	public function get_setting( $meta_key, $default = false )
	{
		if ( isset ( $this->meta[ $meta_key ] ) ) {
			return $this->meta[ $meta_key ];
		} else {
			return $default;
		}
	}

	/**
	 * Get all of our settings.
	 * @since  3.0
	 * @return array $this->meta
	 */
	public function get_all_settings()
	{
		return $this->meta;
	}

	/**
	 * Update a specific field setting
	 * @since  3.0
	 * @param  string  $meta_key   Name of the setting being updated
	 * @param  mixed   $meta_value Value of the setting being updated
	 * @return void
	 */
	public function update_setting( $meta_key, $meta_value, $field_id = '' )
	{
		global $wpdb;
		$update_cache = false;

		if ( '' == $field_id ) {
			$field_id = $this->id;
			$update_cache = true;
		}

		$s_meta_value = maybe_serialize( $meta_value );

		// Check to see if this meta_key/meta_value pair exist for this field_id.
		if ( isset ( $this->settings[ $meta_key ] ) ) {
			$wpdb->update( NF_FIELDMETA_TABLE_NAME, array( 'meta_value' => $s_meta_value ), array( 'meta_key' => $meta_key, 'field_id' => $field_id ) );
		} else {
			$wpdb->insert( NF_FIELDMETA_TABLE_NAME, array( 'field_id' => $field_id, 'meta_key' => $meta_key, 'meta_value' => $s_meta_value ) );
		}

		if ( $update_cache ) {
			$this->setting[ $meta_key ] = $meta_value;
		}
	}

	/**
	 * Update field order
	 * @since   3.0
	 * @param   int $order New order
	 * @param   int $field_id Optional: passing the field ID to update prevents populating the entire field object.
	 * @return  void 
	 */
	public function update_order( $order, $field_id = '' )
	{
		global $wpdb;
		$update_cache = false;

		if ( '' == $field_id ) {
			$field_id = $this->id;
			$update_cache = true;
		}

		$wpdb->update( NF_FIELDS_TABLE_NAME, array( 'order' => $order ), array( 'id' => $field_id ) );

		if ( $update_cache ) {
			$this->order = $order;
		}
	}
}