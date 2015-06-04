<?php if ( ! defined( 'ABSPATH' ) ) exit;
/**
 * Select Field Type Class.
 * 
 * @package     Ninja Forms
 * @subpackage  Classes/Fields
 * @copyright   Copyright (c) 2015, WPNINJAS
 * @license     http://opensource.org/licenses/gpl-2.0.php GNU Public License
 * @since       3.0
*/

class NF_Fields_Select extends NF_Fields_List
{

	/**
	 * Get things rolling
	 * @since 3.0
	 */
	function __construct() {
		parent::__construct();
		$this->name = __( 'Select Dropdown', 'ninja-forms' );
	}
}