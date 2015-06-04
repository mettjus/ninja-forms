<?php

class NF_WPEditorAjax {
    /*
    * AJAX Call Used to Generate the WP Editor
    */
    public static function output_js( $field_id = '', $editors = array() ) {
    	if ( empty( $field_id ) or empty( $editors ) )
    		return false;
    	$mce_init = '';
    	$qt_init = '';
    	foreach ( $editors as $id ) {
			$mce_init .= self::get_mce_init($id);
	        $qt_init .= self::get_qt_init($id);
    	}
    	$mce_init = '{' . trim( $mce_init, ',' ) . '}';
        $qt_init = '{' . trim( $qt_init, ',' ) . '}';
        ?>
        <script type="text/javascript">
            tinyMCEPreInit.mceInit = jQuery.extend( tinyMCEPreInit.mceInit, <?php echo $mce_init ?>);
            tinyMCEPreInit.qtInit = jQuery.extend( tinyMCEPreInit.qtInit, <?php echo $qt_init ?>);
            nf_ajax_rte_editors = <?php echo json_encode( $editors ); ?>;
        </script>
        <?php
    }
    /*
    * Used to retrieve the javascript settings that the editor generates
    */
    private static $mce_settings = array();
    private static $qt_settings = array();
    public static function quicktags_settings( $qtInit, $editor_id ) {
		self::$qt_settings[ $editor_id ] = $qtInit;
        return $qtInit;
    }
    public static function tiny_mce_before_init( $mceInit, $editor_id ) {
        self::$mce_settings[ $editor_id ] = $mceInit;
        return $mceInit;
    }
    /*
    * Code copied from _WP_Editors class (modified a little)
    */
    private static function get_qt_init($editor_id) {
        if ( ! empty( self::$qt_settings[ $editor_id ] ) ) {
            $options = self::_parse_init( self::$qt_settings[ $editor_id ]  );
            $qtInit = "'$editor_id':{$options},";
        } else {
            $qtInit = '{}';
        }
        return $qtInit;
    }
    private static function get_mce_init($editor_id) {
        if ( !empty(self::$mce_settings[ $editor_id ]) ) {
            $options = self::_parse_init( self::$mce_settings[ $editor_id ]  );
            $mceInit = "'$editor_id':{$options},";
        } else {
            $mceInit = '{}';
        }
        return $mceInit;
    }
    private static function _parse_init($init) {
        $options = '';
        foreach ( $init as $k => $v ) {
            if ( is_bool($v) ) {
                $val = $v ? 'true' : 'false';
                $options .= $k . ':' . $val . ',';
                continue;
            } elseif ( !empty($v) && is_string($v) && ( ('{' == $v{0} && '}' == $v{strlen($v) - 1}) || ('[' == $v{0} && ']' == $v{strlen($v) - 1}) || preg_match('/^\(?function ?\(/', $v) ) ) {
                $options .= $k . ':' . $v . ',';
                continue;
            }
            $options .= $k . ':"' . $v . '",';
        }
        return '{' . trim( $options, ' ,' ) . '}';
    }
}