<?php if ( ! defined( 'ABSPATH' ) ) exit;

/**
* Class NF_Upgrade_Handler
*/
class NF_UpgradeHandler
{
    static $instance;

    public $upgrades;

    private $page;

    public static function instance()
    {
        if ( ! isset( self::$instance ) ) {
            self::$instance = new NF_UpgradeHandler();
        }

        return self::$instance;
    }

    public function __construct()
    {
        // Bail if we aren't in the admin or we don't have the appropriate permissions.
        if ( ( ! is_admin() ) OR ( is_multisite() AND ! is_super_admin() ) ) {
            return false;
        }

        ignore_user_abort( true );

        $this->register_upgrades();

        if ( defined( 'DOING_AJAX' ) && DOING_AJAX ) {
            add_action( 'wp_ajax_nf_upgrade_handler', array( $this, 'ajax_response' ) );
            return;
        } else {
            $this->page = new NF_UpgradeHandlerPage();
        }

    }

    public function register_upgrades()
    {
        $this->upgrades = apply_filters( 'nf-upgrade-handler-register', $this->upgrades );

        usort( $this->upgrades, array( $this, 'compare_upgrade_priority' ) ) ;
    }

    private function compare_upgrade_priority( $a, $b )
    {
        return version_compare( $a->priority, $b->priority );
    }

    public function ajax_response()
    {
        $current_step = ( isset( $_REQUEST['step'] ) ) ? $_REQUEST['step'] : 0;

        $current_upgrade = $this->getUpgradeByName( $_REQUEST['upgrade'] );

        $current_upgrade->total_steps = $_REQUEST['total_steps'];

        $response = array(
            'upgrade'     => $current_upgrade->name,
            'step'        => $current_step + 1,
            'total_steps' => (int) $current_upgrade->total_steps,
            'args'        => $current_upgrade->args,
        );

        if( 0 == $current_step ) {
            $current_upgrade->loading();
        } else {

            if (is_array($current_upgrade->errors) AND $current_upgrade->errors) {
                $response['errors'] = $current_upgrade->errors;
            }

            if ($current_upgrade->total_steps < $response['step']) {
                $current_upgrade->complete();
                $response['complete'] = TRUE;
                $next_upgrade = $this->getNextUpgrade($current_upgrade);

                if ($next_upgrade) {
                    $response['nextUpgrade'] = $next_upgrade->name;
                }
            } else {
                $current_upgrade->_step($current_step);
            }

        }

        echo json_encode( $response );
        die();
    }



    /*
     * UTILITY METHODS
     */



    public function getUpgradeByName( $name )
    {
        foreach ( $this->upgrades as $index => $upgrade ) {
            if ( $name == $upgrade->name ) {
                return $upgrade;
            }
        }
    }

    public function getNextUpgrade( $current_upgrade )
    {
        foreach ( $this->upgrades as $index => $upgrade ) {
            if ( $current_upgrade->name == $upgrade->name ) {

                if( isset( $this->upgrades[ $index + 1 ] ) ) {
                    return $this->upgrades[ $index + 1 ];
                }
            }
        }

        return FALSE;
    }
}

function NF_UpgradeHandler() {
    return NF_UpgradeHandler::instance();
}
NF_UpgradeHandler();