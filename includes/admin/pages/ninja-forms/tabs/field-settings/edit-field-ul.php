<?php if ( ! defined( 'ABSPATH' ) ) exit;
add_action( 'ninja_forms_edit_field_ul', 'ninja_forms_edit_field_output_ul' );
function ninja_forms_edit_field_output_ul( $form_id ){
	?>
	<div id="ninja-forms-viewport">
		<input class="button-primary menu-save nf-save-admin-fields" id="ninja_forms_save_data_top" type="button" value="<?php _e('Save', 'ninja-forms'); ?>" />
		<a href="#" class="button-secondary nf-save-spinner" style="display:none;" disabled><span class="spinner nf-save-spinner" style="float:left;"></span></a>
		<ul class="menu ninja-forms-field-list" id="ninja_forms_field_list">
	  		<?php
			// echo "<pre>";
			// print_r( Ninja_Forms()->form( $form_id )->fields );
			// echo "</pre>";
				if( is_array( Ninja_Forms()->form( $form_id )->fields ) AND !empty( Ninja_Forms()->form( $form_id )->fields ) ){
					
					foreach( Ninja_Forms()->form( $form_id )->fields as $field ){
						// echo "<pre>";
						// print_r( $field );
						// echo "</pre>";
						// ninja_forms_edit_field( $field['id'] );
						Ninja_Forms()->field( $field['id'] )->output_edit_html();
					}
				}
			?>
		</ul>

		<input class="button-primary menu-save nf-save-admin-fields" id="ninja_forms_save_data_bot" type="button" value="<?php _e('Save', 'ninja-forms'); ?>" />
		<a href="#" class="button-secondary nf-save-spinner" style="display:none;" disabled><span class="spinner nf-save-spinner" style="float:left;"></span></a>
	</div>
		<?php

}