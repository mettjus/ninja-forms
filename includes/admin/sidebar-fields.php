<?php if ( ! defined( 'ABSPATH' ) ) exit;
function ninja_forms_sidebar_display_fields( $slug ) {
	foreach ( Ninja_Forms()->field_types as $field_slug => $field_type ) {
		if ( $field_type->sidebar == $slug){
			$limit = $field_type->limit;
			?>
			<p class="button-controls">
				<a class="button-secondary ninja-forms-new-field" id="<?php echo $field_slug;?>" data-limit="<?php echo $limit; ?>" data-type="<?php echo $field_slug; ?>" href="#"><?php echo $field_type->name;?></a>
			</p>
			<?php
		}
	}
	
}