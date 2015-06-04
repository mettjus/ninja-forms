<?php if ( ! defined( 'ABSPATH' ) ) exit;
/**
 * Email Field Type Class.
 * 
 * @package     Ninja Forms
 * @subpackage  Classes/Fields
 * @copyright   Copyright (c) 2015, WPNINJAS
 * @license     http://opensource.org/licenses/gpl-2.0.php GNU Public License
 * @since       3.0
*/

class NF_Fields_Email extends NF_Fields_Text
{

	/**
	 * Get things rolling
	 * @since 3.0
	 */
	function __construct() {
		parent::__construct();
		$this->name = __( 'Email', 'ninja-forms' );
		$this->sidebar = 'user_info';

		unset( $this->edit_settings['restrictions']['mask_type'] );
		unset( $this->edit_settings['restrictions']['mask'] );
		unset( $this->edit_settings['restrictions']['input_limit'] );
		unset( $this->edit_settings['restrictions']['input_limit_type'] );
		unset( $this->edit_settings['restrictions']['input_limit_msg'] );
		unset( $this->edit_settings['advanced']['default_value'] );
		unset( $this->edit_settings['advanced']['num_sort'] );
		unset( $this->edit_settings['calculations'] );

		$this->edit_settings['advanced']['default_value_type']['options'] = array(
			array( 'name' => __( 'None', 'ninja-forms' ), 'value' => '' ),
			array( 'name' => __( 'User Email (If logged in)', 'ninja-forms'), 'value' => '_user_email' ),
		);
	}
}