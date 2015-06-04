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
	var $limit = '';
	var $show_field_id = true;
	var $show_fav = true;
	/**
	 * Get things rolling
	 * @since 3.0
	 */
	function __construct()
	{

		$this->edit_sections = apply_filters( 'nf_edit_field_settings_sections', array(
			'restrictions' 	=> __( 'Restriction Settings', 'ninja-forms' ),
			'calculations'	=> __( 'Calculation Settings', 'ninja-forms' ),
			'advanced'		=> __( 'Advanced Settings', 'ninja-forms' ),
		) );

		$this->edit_settings = array(
			'basic' => array(
				'label' => array(
					'type' => 'text',
					'label' => __( 'Label', 'ninja-forms' ),
				),
				'label_pos' => array(
					'type' => 'select',
					'label' => __( 'Label Position', 'ninja-forms' ),
					'options' => array(
						array('name' => __( 'Left of Element', 'ninja-forms' ), 'value' => 'left'),
						array('name' => __( 'Above Element', 'ninja-forms' ), 'value' => 'above'),
						array('name' => __( 'Below Element', 'ninja-forms' ), 'value' => 'below'),
						array('name' => __( 'Right of Element', 'ninja-forms' ), 'value' => 'right'),
						array('name' => __( 'Inside Element', 'ninja-forms' ), 'value' => 'inside'),
					),
				),
			),
			'restrictions' => array(
				'req'	=> array(
					'type'	=> 'checkbox',
					'label'	=> __( 'Required', 'ninja-forms' ),
				),
			),
			'calculations'	=> array(
				'calc_auto_include'	=> array(
					'type'	=> 'checkbox',
					'label'	=> __( 'Include in the auto-total? (If enabled)', 'ninja-forms' ),
				),
			),
			'advanced' => array(
				'class'	=> array(
					'type'	=> 'text',
					'label'	=> __( 'Custom CSS Classes', 'ninja-forms' ),
				),
				'admin_label'	=> array(
					'type'	=> 'text',
					'label'	=> __( 'Admin Label', 'ninja-forms' ),
					'desc'	=> __( 'This is the label used when viewing/editing/exporting submissions.', 'ninja-forms' ),
				),
				'show_help'			=> array(
					'type'			=> 'checkbox',
					'label'			=> __( 'Show Help Text', 'ninja-forms' ),
				),
				'help_text'			=> array(
					'type'			=> 'textarea',
					'label'			=> __( 'Help Text', 'ninja-forms' ),
					'desc'			=> sprintf(__('If "help text" is enabled, there will be a question mark %s placed next to the input field. Hovering over this question mark will show the help text.', 'ninja-forms'), '<img src="'.NINJA_FORMS_URL.'images/question-ico.gif">'),
				),
				'show_desc'			=> array(
					'type'			=> 'checkbox',
					'label'			=> __( 'Add Description', 'ninja-forms' ),
				),
				'desc_pos'			=> array(
					'type'			=> 'select',
					'label'			=> __( 'Description Position', 'ninja-forms' ),
					'options'		=> array(
						array( 'name' => __( 'None', 'ninja-forms' ), 'value' => 'none' ),
						array( 'name' => __( 'Before Everything', 'ninja-forms' ), 'value' => 'before_everything' ),
						array( 'name' => __( 'Before Label', 'ninja-forms' ), 'value' => 'before_label' ),
						array( 'name' => __( 'After Label', 'ninja-forms' ), 'value' => 'after_label' ),
						array( 'name' => __( 'After Everything', 'ninja-forms' ), 'value' => 'after_everything' ),
					),
				),
				'desc_text'			=> array(
					'type'			=> 'rte',
					'label'			=> __( 'Description Content', 'ninja-forms' ),
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
		$this->output_edit_open_li( $field );
		$this->output_edit_inside( $field );
		$this->output_edit_close_li( $field );
	}

	public function output_edit_li( $field )
	{
		$this->output_edit_open_li( $field );
		$this->output_edit_close_li( $field );
	}

	public function output_edit_open_li( $field )
	{
		$field_id = $field->id;
		$conditional_value_type = '';
		$type_name = $this->name;
		$li_label = $field->get_setting( 'label' );
		$padding = ( defined( 'DOING_AJAX' ) && DOING_AJAX ) ? '' : 'no-padding';
		$fav_id = '';
		$def_id = '';
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
			<div class="menu-item-settings type-class inside <?php echo $padding?> display:none;" id="ninja_forms_field_<?php echo $field_id;?>_inside" >
		<?php
	}

	public function output_edit_close_li( $field )
	{
		$field_id = $field->id;
		?>
			</div>
		</li>
		<?php
	}

	public function output_edit_inside( $field )
	{
		global $nf_rte_editors;
		$field_id = $field->id;
		?>
		<table id="field-info">
			<tr>
			<?php
			if ( $this->show_field_id ) {
					?>
					<td width="65%"><?php _e( 'Field ID', 'ninja-forms' ); ?>: <strong><?php echo $field_id;?></strong></td>
					<?php
				}
				?>
				<!-- <td width="15%"><a href="#" class="ninja-forms-field-add-def" id="ninja_forms_field_<?php echo $field_id;?>_def" class="ninja-forms-field-add-def">Add Defined</a></td><td width="15%"><a href="#" class="ninja-forms-field-remove-def" id="ninja_forms_field_<?php echo $field_id;?>_def">Remove Defined</a></td> -->
				<?php
				if ( $this->show_fav ) {
					?>
					<td width="5%"><a href="#" class="<?php echo $fav_class;?>" id="ninja_forms_field_<?php echo $field_id;?>_fav"><span class="dashicons dashicons-star-<?php echo $icon_class; ?>"></span></a></td>
					<?php
				}
				?>
			</tr>
		</table>

		<?php

		$this->output_settings_html( $field, 'basic' );

		$x = 0;
		foreach( $this->edit_sections as $slug => $section_name ) {
			if ( 0 == $x ) {
				$arrow = 'dashicons-arrow-up';
			} else {
				$arrow = 'dashicons-arrow-down';
			}
			?>
			<div class="nf-field-settings description-wide description">
				<div class="title">
					<?php echo $section_name; ?><span class="dashicons <?php echo $arrow; ?> nf-field-sub-section-toggle"></span>
				</div>
				<div class="inside" style="display:none;">
					<?php
					$this->output_settings_html( $field, $slug );
					?>
				</div>
			</div>
			<?php
			$x++;
		}

		?>
		<div class="menu-item-actions description-wide submitbox">
			<a class="submitdelete deletion nf-remove-field" id="ninja_forms_field_<?php echo $field_id;?>_remove" data-field="<?php echo $field_id; ?>" href="#"><?php _e('Remove', 'ninja-forms'); ?></a>
		</div>

		<?php
		$editors = new NF_WPEditorAjax();

		if ( ! empty ( $nf_rte_editors ) && isset ( $editors ) && is_object( $editors ) ) {
			$editors->output_js( $field_id, $nf_rte_editors );
		}
	}

	public function output_settings_html( $field, $slug )
	{
		if ( isset ( $this->edit_settings[ $slug ] ) ) {
			foreach ( $this->edit_settings[ $slug ] as $name => $setting ) {
				$desc = isset ( $setting['desc'] ) ? $setting['desc'] : '';
				?>
				<div class="description description-wide <?php echo $field->type;?>" id="<?php echo $name;?>_p">
					<?php
					$this->$setting['type']( $field, $name, $setting );
					?>
					<span class="description"><?php echo $desc; ?></span>
				</div>
				<?php
			}
		}
	}

	public function text( $field, $name, $args = array() )
	{
		$field_id = $field->id;
		$value = $field->get_setting( $name );
		$id = 'ninja_forms_field_'. $field_id. '_'. $name;
		$name = 'ninja_forms_field_' . $field_id . '[' . $name .']';
		$class = 'widefat';
		$label = isset ( $args['label'] ) ? $args['label'] : '';
		?>
		<label for="<?php echo $id;?>" id="<?php echo $id;?>_label">
		<?php echo $label; ?></label><br/>
		<input type="text" class="<?php echo $class;?>" name="<?php echo $name;?>" id="<?php echo $id;?>" value="<?php echo $value;?>" />
		<?php
	}

	public function checkbox( $field, $name,  $args = array() )
	{
		$field_id = $field->id;
		$value = $field->get_setting( $name );
		$id = 'ninja_forms_field_'.$field_id.'_'.$name;
		$name = 'ninja_forms_field_' . $field_id . '[' . $name .']';
		$label = isset ( $args['label'] ) ? $args['label'] : '';
		?>
		<label for="<?php echo $id;?>" id="<?php echo $id;?>_label">
			<input type="hidden" value="0" name="<?php echo $name;?>">
			<input type="checkbox" value="1" name="<?php echo $name;?>" id="<?php echo $id;?>" <?php checked( $value, 1 ); ?>>
			<?php _e( $label , 'ninja-forms'); ?>
		</label>
		<?php
	}

	public function select( $field, $name, $args = array() )
	{
		$field_id = $field->id;
		$value = $field->get_setting( $name );
		$id = 'ninja_forms_field_'.$field_id.'_'.$name;
		$name = 'ninja_forms_field_' . $field_id . '[' . $name .']';
		$class = 'widefat';
		
		$label = isset ( $args['label'] ) ? $args['label'] : '';
		$options = isset ( $args['options'] ) ? $args['options'] : array();
		?>
		<label for = "<?php echo $id; ?>"><?php echo $label; ?></label>
		<select id="<?php echo $id; ?>" name="<?php echo $name; ?>" class="<?php echo $class; ?>">
			<?php
			if( is_array( $options ) AND ! empty( $options ) ) {
				foreach( $options as $opt ) {
					?>
					<option value="<?php echo $opt['value']; ?>" <?php selected( $opt['value'], $value ); ?> ><?php _e( $opt['name'], 'ninja-forms'); ?></option>
					<?php
				}
			}
		?>
		</select>
		<?php
	}

	public function textarea( $field, $name, $args = array() )
	{
		$field_id = $field->id;
		$value = $field->get_setting( $name );
		$id = 'ninja_forms_field_'.$field_id.'_'.$name;
		$name = 'ninja_forms_field_' . $field_id . '[' . $name .']';
		$class = 'widefat';
		?>
		<textarea id="<?php echo $id;?>" name="<?php echo $name;?>" class="<?php echo $class;?>" rows="3" cols="20" ><?php echo $value;?></textarea>
		<?php
	}

	public function rte( $field, $name, $args = array() )
	{
		global $nf_rte_editors;
		// used to capture javascript settings generated by the editor
		add_filter( 'tiny_mce_before_init', 'NF_WPEditorAjax::tiny_mce_before_init', 10, 2 );
		add_filter( 'quicktags_settings', 'NF_WPEditorAjax::quicktags_settings', 10, 2 );

		$field_id = $field->id;
		$value = $field->get_setting( $name );
		$id = 'ninja_forms_field_'.$field_id.'_'.$name;
		$name = 'ninja_forms_field_' . $field_id . '[' . $name .']';

		// Check if our current user has the RTE disabled.
		$user_id = get_current_user_id();
		$rich_editing = get_user_meta( $user_id, 'rich_editing', true );
		if ( 'true' == $rich_editing ) {
			$editor_id = str_replace( '[', '_', $name );
			$editor_id = str_replace( ']', '', $editor_id );
			
			$args = apply_filters( 'ninja_forms_edit_field_rte', array( 'textarea_name' => $name ) );
			wp_editor( $value, $editor_id, $args = array() );				
			$nf_rte_editors[] = $editor_id;
		} else {
			?>
			<textarea id="<?php echo $id;?>" name="<?php echo $name;?>" class="<?php echo $class;?>" rows="3" cols="20" ><?php echo $value;?></textarea>
			<?php
		}
	}

}