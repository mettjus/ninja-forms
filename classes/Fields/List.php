<?php if ( ! defined( 'ABSPATH' ) ) exit;
/**
 * List Field Type Class.
 * 
 * @package     Ninja Forms
 * @subpackage  Classes/Fields
 * @copyright   Copyright (c) 2015, WPNINJAS
 * @license     http://opensource.org/licenses/gpl-2.0.php GNU Public License
 * @since       3.0
*/

abstract class NF_Fields_List extends NF_Fields_BaseField
{

	/**
	 * Get things rolling
	 * @since 3.0
	 */
	function __construct()
	{
		parent::__construct();
		$this->sidebar = 'list_fields';

		$basic_settings = array(
			'list_type' => array(
				'type'	=> 'select',
				'label' => __( 'List Type', 'ninja-forms' ),
				'options'	=> array(
					array( 'name' => __( 'Dropdown', 'ninja-forms' ), 'value' => 'dropdown' ),
					array( 'name' => __( 'Radio', 'ninja-forms' ), 'value' => 'radio' ),
					array( 'name' => __( 'Checkboxes', 'ninja-forms' ), 'value' => 'checkbox' ),
					array( 'name' => __( 'Multi-Select', 'ninja-forms' ), 'value' => 'multi' ),
				),
			),
			'options'	=> array(
				'type'	=> 'options_html',
				'label'	=> '',
			),
		);

		$this->edit_settings['basic'] = wp_parse_args( $basic_settings, $this->edit_settings['basic'] );

	}

	public function options_html( $field )
	{
		$list_options = array(
			array( 'label' => 'TEST', 'calc' => '1', 'value' => 'test', 'selected' => 1 ),
			array( 'label' => 'Bleep', 'calc' => '2', 'value' => 'test', 'selected' => 0 ),
		);
		?>
		<span id="ninja_forms_field_<?php echo $field_id;?>_list_span" class="ninja-forms-list-span">
			<!-- <p class="description description-wide"> -->
				<a href="#" id="ninja_forms_field_<?php echo $field_id;?>_list_add_option" class="ninja-forms-field-add-list-option button-secondary"><?php _e( 'Add New', 'ninja-forms' );?></a>
				<a href="#TB_inline?width=640&height=530&inlineId=ninja_forms_field_<?php echo $field_id;?>_import_options_div" class="thickbox button-secondary" title="<?php _e( 'Import List Items', 'ninja-forms' ); ?>" id=""><?php _e( 'Import List Items', 'ninja-forms' );?></a>
			<!-- </p> -->

			<p class="description description-wide">
				<input type="hidden" id="" name="ninja_forms_field_<?php echo $field_id;?>[list_show_value]" value="0">
				<label for="ninja_forms_field_<?php echo $field_id;?>_list_show_value"><input type="checkbox" value="1" id="ninja_forms_field_<?php echo $field_id;?>_list_show_value" name="ninja_forms_field_<?php echo $field_id;?>[list_show_value]" class="ninja-forms-field-list-show-value" <?php if(isset($data['list_show_value']) AND $data['list_show_value'] == 1){ echo "checked='checked'";}?>>
				<?php _e( 'Show list item values', 'ninja-forms' );?> </label>
			</p>
			<div id="ninja_forms_field_<?php echo $field_id;?>_list_options" class="ninja-forms-field-list-options description description-wide">
				<input type="hidden" name="ninja_forms_field_<?php echo $field_id;?>[list][options]" value="">
				<?php
				if( isset( $list_options ) AND is_array( $list_options ) AND $list_options != '' ){
					$x = 0;
					foreach( $list_options as $option ) {
						$this->edit_single_option( $field->id, $x, $option, 0 );
						$x++;
					}
				}
				?>
			</div>
		</span>
		<?php
	}

	public function edit_single_option( $field_id, $x, $option, $hidden )
	{
		if($hidden == 1){
			$hidden = '';
		}else{
			$hidden = 'display:none';
		}
		if(is_array($option)){
			$label = htmlspecialchars( $option['label'] );
			$label = str_replace( '&amp;', '&', $label );
			$value = htmlspecialchars( $option['value'] );
			$value = str_replace( '&amp;', '&', $value );
			if ( isset ( $option['calc'] ) ) {
				$calc = $option['calc'];
			} else {
				$calc = '';
			}
			if( isset( $option['selected'] ) ){
				$selected = $option['selected'];
			}else{
				$selected = '';
			}
			$hide = '';
		}else{
			$label = '';
			$value = '';
			$selected = '';
			$calc = '';
			$hide = 'style="display:none;"';
		}
		if($selected == 1){
			$selected = "checked='checked'";
		}

		?>
		<div id="ninja_forms_field_<?php echo $field_id;?>_list_option_<?php echo $x;?>" class="ninja-forms-field-<?php echo $field_id;?>-list-option ninja-forms-field-list-option" <?php echo $hide;?> data-field="<?php echo $field_id; ?>">
		<table class="list-options">
			<tr>
				<td class="ninja-forms-delete-list-option-td">
					<a href="#" id="ninja_forms_field_<?php echo $field_id;?>_list_remove_option" class="nf-remove-list-option"><span class="dashicons dashicons-dismiss"></span></a>
				</td>
				<td class="ninja-forms-list-option-label-td">
					<?php _e( 'Label', 'ninja-forms' );?>: <input type="text" name="ninja_forms_field_<?php echo $field_id;?>[list][options][<?php echo $x;?>][label]" id="ninja_forms_field_<?php echo $field_id;?>_list_option_label" class="ninja-forms-field-list-option-label" value="<?php echo $label;?>">
				</td>
				<td class="ninja-forms-list-option-value-td">
					<span id="ninja_forms_field_<?php echo $field_id;?>_list_option_<?php echo $x;?>_value_span" name="" class="ninja-forms-field-<?php echo $field_id;?>-list-option-value" style="<?php echo $hidden;?>"><?php _e( 'Value', 'ninja-forms' );?>: <input type="text" name="ninja_forms_field_<?php echo $field_id;?>[list][options][<?php echo $x;?>][value]" id="ninja_forms_field_<?php echo $field_id;?>_list_option_value" class="ninja-forms-field-list-option-value" value="<?php echo $value;?>"></span>
				</td>
				<td class="ninja-forms-list-option-calc-td">
					<?php _ex( 'Calc', 'Short for calculation', 'ninja-forms' );?>: <input type="text" name="ninja_forms_field_<?php echo $field_id;?>[list][options][<?php echo $x;?>][calc]" id="ninja_forms_field_<?php echo $field_id;?>_list_option_calc" class="ninja-forms-field-list-option-calc" value="<?php echo $calc;?>">
				</td>
				<td class="ninja-forms-list-option-selected-td">
					<label for="ninja_forms_field_<?php echo $field_id;?>_options_<?php echo $x;?>_selected"><?php _e( 'Selected', 'ninja-forms' );?> <input type="hidden" value="0" name="ninja_forms_field_<?php echo $field_id;?>[list][options][<?php echo $x;?>][selected]"><input type="checkbox" value="1" name="ninja_forms_field_<?php echo $field_id;?>[list][options][<?php echo $x;?>][selected]" id="ninja_forms_field_<?php echo $field_id;?>_options_<?php echo $x;?>_selected" class="ninja-forms-field-list-option-selected" <?php echo $selected;?>></label>
				</td>
				<td class="ninja-forms-list-option-drag-td">
					<span class="ninja-forms-drag"><span class="dashicons dashicons-menu"></span></span>
				</td>
			</tr>
		</table>
		</div>
		<?php
	}

}