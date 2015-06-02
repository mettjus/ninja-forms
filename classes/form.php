<?php if ( ! defined( 'ABSPATH' ) ) exit;
/**
 * Handles the output of our form, as well as interacting with its settings.
 *
 * @package     Ninja Forms
 * @subpackage  Classes/Form
 * @copyright   Copyright (c) 2014, WPNINJAS
 * @license     http://opensource.org/licenses/gpl-2.0.php GNU Public License
 * @since       2.7
*/

class NF_Form {

	/**
	 * @var form_id
	 * @since 2.7
	 */
	var $form_id;

	/**
	 * @var settings - Form Settings
	 * @since 2.7
	 */
	var $settings = array();

	/**
	 * @var fields - Form Fields
	 * @since 2.7
	 */
	var $fields = array();

	/**
	 * @var field_data - Store our field meta values
	 * @since  3.0
	 */
	var $field_data = array();

	/**
	 * @var errors - Form errors
	 * @since 2.7
	 */
	var $errors = array();

	/**
	 * Get things started
	 * 
	 * @access public
	 * @since 2.7
	 * @return void
	 */
	public function __construct( $form_id = '' ) {
		if ( ! empty ( $form_id ) ) { // We've been passed a form id.
			// Set our current form id.
			$this->form_id = $form_id;
			$this->update_fields();
			$this->settings = nf_get_form_settings( $form_id );
		}
	}

	public function __wakeup() {
		foreach ( $this->fields as $field ) {
			Ninja_Forms()->field_data[ $field['id'] ] = $this->form_id;
		}
	}

	/**
	 * Add a form
	 * 
	 * @access public
	 * @since 2.9
	 * @return int $form_id
	 */
	public function create( $defaults = array() ) {
		$form_id = nf_insert_object( 'form' );
		$date_updated = date( 'Y-m-d', current_time( 'timestamp' ) );
		nf_update_object_meta( $form_id, 'date_updated', $date_updated );

		foreach( $defaults as $meta_key => $meta_value ) {
			nf_update_object_meta( $form_id, $meta_key, $meta_value );
		}

		// Add a single event hook that will check to see if this is an orphaned function.
		$timestamp = strtotime( '+24 hours', time() );
		$args = array(
			'form_id' => $form_id
		);
		wp_schedule_single_event( $timestamp, 'nf_maybe_delete_form', $args );
		return $form_id;
	}

	/**
	 * Insert a field into our form
	 * 
	 * @access public
	 * @since 3.0
	 * @return int $field_id
	 */
	public function insert_field( $args ) {
		global $wpdb;

		$order = isset ( $args['order'] ) ? $args['order'] : 999;
		unset ( $args['order'] );
		$wpdb->insert( NF_FIELDS_TABLE_NAME, array( 'form_id' => $this->form_id, 'order' => $order ) );
		$field_id = $wpdb->insert_id;
		unset ( $args['form_id'] );
		foreach ( $args as $meta_key => $meta_value ) {
			$meta_value = maybe_serialize( $meta_value );
			$wpdb->insert( NF_FIELDMETA_TABLE_NAME, array( 'field_id' => $field_id, 'meta_key' => $meta_key, 'meta_value' => $meta_value ) );
		}
		return $field_id;
	}

	/**
	 * Update our fields
	 * 
	 * @access public
	 * @since 2.9
	 * @return void
	 */
	public function update_fields() {
		global $wpdb;
		$field_ids = array();
		$fields = $wpdb->get_results( $wpdb->prepare( "SELECT wp_nf_fields.id as 'id', wp_nf_fields.order as 'order', wp_nf_fields.type as 'type' FROM " . NF_FIELDS_TABLE_NAME . " WHERE form_id = %d ORDER BY wp_nf_fields.order ASC", $this->form_id ), ARRAY_A );
		// var_dump( $wpdb->prepare( "SELECT wp_nf_fields.id as 'id', wp_nf_fields.order as 'order' FROM " . NF_FIELDS_TABLE_NAME . " WHERE form_id = %d ORDER BY wp_nf_fields.order ASC", $this->form_id ) );
		// echo "<pre>";
		// print_r( $fields );
		// echo "</pre>";

		foreach ( $fields as $field ) {
			$field_ids[] = $field['id'];
		}

		$fieldmeta = $wpdb->get_results( "SELECT * FROM " . NF_FIELDMETA_TABLE_NAME . " WHERE `field_id` IN (" . implode( ',', array_map( 'intval', $field_ids ) ) . ")", ARRAY_A );
		$data = array();
		foreach ( $fieldmeta as $meta ) {
			$meta_key = $meta['meta_key'];
			$meta_value = $meta['meta_value'];
			switch ( $meta['meta_key'] ) {
				case 'fav_id':
					$data[ $meta['field_id'] ]['fav_id'] = $meta_value;
				break;
				case 'def_id':
					$data[ $meta['field_id'] ]['def_id'] = $meta_value;
				break;
			}

			$data[ $meta['field_id'] ]['meta'][ $meta_key ] = maybe_unserialize( $meta_value );
		}

		foreach ( $fields as $field ) {
			$data[ $field['id'] ]['form_id'] = $this->form_id;
			$data[ $field['id'] ]['order'] = $field['order'];
			$data[ $field['id'] ]['type'] = $field['type'];

			// Ninja_Forms()->field_data[ $field['id'] ] = $this->form_id;
		}

		$this->fields = $fields;
		uasort( $data, array( $this, 'sort_by_order' ) );
		$this->field_data = $data;

	}

	public function sort_by_order( $a, $b ) {
		return $a['order'] - $b['order'];
	}

	/**
	 * Get one of our form settings.
	 * 
	 * @access public
	 * @since 2.7
	 * @return string $setting
	 */
	public function get_setting( $setting, $bypass_cache = false ) {
		if ( $bypass_cache ) {
			return nf_get_object_meta_value( $this->form_id, 'last_sub' );
		}
		if ( isset ( $this->settings[ $setting ] ) ) {
			return $this->settings[ $setting ];
		} else {
			return false;
		}
	}

	/**
	 * Update a form setting (this doesn't update anything in the database)
	 * Changes are only applied to this object.
	 * 
	 * @access public
	 * @since 2.8
	 * @param string $setting
	 * @param mixed $value
	 * @return bool
	 */
	public function update_setting( $setting, $value, $form_id = '' ) {
		if ( '' == $form_id ) {
			$this->settings[ $setting ] = $value;
			nf_update_object_meta( $this->form_id, $setting, $value );			
		} else {
			nf_update_object_meta( $form_id, $setting, $value );
		}

		return true;
	}

	/**
	 * Get all of our settings
	 * 
	 * @access public
	 * @since 2.9
	 * @return array $settings
	 */
	public function get_all_settings() {
		return $this->settings;
	}

	/**
	 * Get all the submissions for this form
	 * 
	 * @access public
	 * @since 2.7
	 * @return array $sub_ids
	 */
	public function get_subs( $args = array() ) {
		$args['form_id'] = $this->form_id;
		return Ninja_Forms()->subs()->get( $args );
	}

	/**
	 * Return a count of the submissions this form has had
	 * 
	 * @access public
	 * @param array $args
	 * @since 2.7
	 * @return int $count
	 */
	public function sub_count( $args = array() ) {
		return count( $this->get_subs( $args ) );
	}

	/**
	 * Delete this form
	 * 
	 * @access public
	 * @since 2.9
	 */
	public function delete() {
		global $wpdb;
		// Delete this object.
		nf_delete_object( $this->form_id );
		// Delete any fields on this form.
		$wpdb->query($wpdb->prepare( "DELETE FROM ".NINJA_FORMS_FIELDS_TABLE_NAME." WHERE form_id = %d", $this->form_id ) );
	}


	public function field( $id = '' ) {
		return Ninja_Forms()->field( $id );
	}

    /**
     * Delete the cached form object (transient)
     *
     * @access public
     * @since 2.9.17
     */
    public function dump_cache()
    {
        delete_transient( 'nf_form_' . $this->form_id );
    }

    /**
     * Deprecated wrapper for dump_cache()
     *
     * @access public
     * @since 2.9.12
     */
    public function dumpCache()
    {
        $this->dump_cache();
    }

    /**
     * Return all field ids
     * @access public
     * @since  3.0
     */
    public function get_fields()
    {
    	return $this->fields;
    }


}