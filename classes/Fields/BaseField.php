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

abstract class NF_Fields_BaseField
{
	var $sidebar = 'template_fields';
	var $edit_options = array();
	var $edit_settings = array();
	/**
	 * Get things rolling
	 * @since 3.0
	 */
	function __construct()
	{

	}

	/**
	 * Output our field editing HTML
	 * @since  3.0
	 * @param  int  $id The ID of the field we're editing.
	 * @return void
	 */
	public function edit( $id )
	{
		/*
		This space left intentionally blank
		 */
	}

	public function edit_save( $id )
	{
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
	public function display( $id )
	{
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
	public function before_pre_process( $id )
	{
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
	public function pre_process( $id )
	{
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
	public function process( $id )
	{
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
	public function post_process( $id )
	{
		/*
		This space left intentionally blank
		 */
	}

	public function output_edit_html( $field )
	{

		$conditional_value_type = '';
		$type_name = $this->name;
		$li_label = $field->get_setting( 'label' );
		$padding = '';
		?>
		<li id="ninja_forms_field_<?php echo $field_id;?>" class="">
			<input type="hidden" id="ninja_forms_field_<?php echo $field_id;?>_conditional_value_type" value="<?php echo $conditional_value_type;?>">
			<input type="hidden" id="ninja_forms_field_<?php echo $field_id;?>_fav_id" name="" class="ninja-forms-field-fav-id" value="<?php echo $fav_id;?>">
			<dl class="menu-item-bar">
				<dt class="menu-item-handle" id="ninja_forms_metabox_field_<?php echo $field_id;?>" >
					<span class="item-title ninja-forms-field-title" id="ninja_forms_field_<?php echo $field_id;?>_title"><?php echo $li_label;?></span>
					<span class="item-controls">
						<span class="item-type"><span class="spinner" style="margin-top:-2px;float:left;"></span><span class="item-type-name"><?php echo $type_name;?></span></span>
						<a class="item-edit nf-edit-field" id="ninja_forms_field_<?php echo $field_id;?>_toggle" title="<?php _e( 'Edit Menu Item', 'ninja-forms' ); ?>" href="#" data-field="<?php echo $field_id; ?>"><?php _e( 'Edit Menu Item' , 'ninja-forms' ); ?></a>
					</span>
				</dt>
			</dl>
			<div class="menu-item-settings type-class inside <?php echo $padding?>" id="ninja_forms_field_<?php echo $field_id;?>_inside" >
				<?php
				$this->output_edit_inside( $field );
				?>
			</div>
		</li>
		<?php
	}

	private function output_edit_inside( $field )
	{
		foreach( $this->edit_settings as $section => $settings ) {
			?>
			<div class="nf-field-settings description-wide description">
				<div class="title">
					<?php echo $section; ?><span class="dashicons dashicons-arrow-down nf-field-sub-section-toggle"></span>
				</div>
				<div class="inside" style="display:none;">
					<?php
					foreach ( $settings as $s ) {
						?>
						<br />
						<?php
						$this->$s['type']( $field, $s['name'], $s['label'] );
					}
					?>
				</div>
			</div>
			<?php
		} 
	}

	public function text( $field, $name, $label, $value = '' )
	{
		$field_id = $field->id;
		$id = 'ninja_forms_field_'.$field_id.'_'.$name;
		?>
		<label for="<?php echo $id;?>" id="<?php echo $id;?>_label">
		<?php $label; ?></label><br/>
		<input type="text" class="<?php echo $class;?>" name="<?php echo $name;?>" id="<?php echo $id;?>" value="<?php echo $value;?>" />
		<?php
	}

	public function checkbox( $field, $name, $label, $value = '' )
	{
		$field_id = $field->id;
		$id = 'ninja_forms_field_'.$field_id.'_'.$name;
		?>
		<label for="<?php echo $id;?>" id="<?php echo $id;?>_label">
			<input type="hidden" value="0" name="<?php echo $name;?>">
			<input type="checkbox" value="1" name="<?php echo $name;?>" id="<?php echo $id;?>" <?php checked($value, 1);?>>
			<?php _e( $label , 'ninja-forms'); ?>
		</label>
		<?php
	}

}