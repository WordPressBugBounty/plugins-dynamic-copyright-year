<?php

if ( function_exists( 'fsdcy_fs' ) ) {
    fsdcy_fs()->set_basename( true, __FILE__ );
} else {
    
    if ( !function_exists( 'fsdcy_fs' ) ) {
        // Create a helper function for easy SDK access.
        function fsdcy_fs()
        {
            global  $fsdcy_fs ;
            
            if ( !isset( $fsdcy_fs ) ) {
                // Include Freemius SDK.
                require_once dirname( __FILE__ ) . '/inc/freemius/start.php';
                $fsdcy_fs = fs_dynamic_init( array(
                    'id'              => '11334',
                    'slug'            => 'dynamic-copyright-year',
                    'type'            => 'plugin',
                    'public_key'      => 'pk_2196d0998f874394f0907c0b1aac8',
                    'is_premium'      => false,
                    'premium_suffix'  => 'Premium',
                    'has_addons'      => false,
                    'has_paid_plans'  => true,
                    'trial'           => array(
                    'days'               => 14,
                    'is_require_payment' => false,
                ),
                    'has_affiliation' => 'all',
                    'menu'            => array(
                    'slug' => 'fscymu-options',
                ),
                    'is_live'         => true,
                ) );
            }
            
            return $fsdcy_fs;
        }
        
        // Init Freemius.
        fsdcy_fs();
        // Signal that SDK was initiated.
        do_action( 'fsdcy_fs_loaded' );
    }

}
