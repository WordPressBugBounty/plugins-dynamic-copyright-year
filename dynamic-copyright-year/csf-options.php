<?php

// Start Codestar Page Options
// Control core classes for avoid errors

if ( class_exists( 'CSF' ) ) {
    add_action(
        'csf_fscymu_options_save_after',
        'fscymu_clear_cache_on_save',
        10,
        2
    );
    //add_filter( 'csf_fscymu_options_save', 'fscymu_clear_cache_on_save', 10, 2 );
    // Set a unique slug-like ID
    $prefix = 'fscymu_options';
    // Create options
    CSF::createOptions( $prefix, array(
        'framework_title' => 'Dynamic Copyright Year <small>by 5 Star Plugins</small>',
        'framework_class' => '',
        'show_bar_menu'   => false,
        'show_search'     => false,
        'menu_capability' => 'manage_options',
        'menu_position'   => null,
        'menu_type'       => 'menu',
        'menu_parent'     => '',
        'menu_title'      => 'Dynamic Copyright',
        'menu_slug'       => 'fscymu-options',
        'menu_icon'       => 'dashicons-chart-pie',
        'footer_text'     => 'Clear page cache and refresh browser after saving.',
        'footer_after'    => include plugin_dir_path( __FILE__ ) . 'plugin_footer.php',
        'footer_credit'   => 'Copyright ' . date( "Y" ) . ' 5 Star Plugins - Dynamic Copyright Year v' . $fscymu_version,
    ) );
    // Create a top-tab
    CSF::createSection( $prefix, array(
        'id'    => 'primary_tab',
        'title' => 'Options',
    ) );
    // Create a sub-tab
    CSF::createSection( $prefix, array(
        'parent' => 'primary_tab',
        'title'  => 'Dynamic Year',
        'fields' => array(
        // Heading
        array(
            'type'    => 'heading',
            'content' => 'Standard Settings',
        ),
        // Enabled On/Off Activation
        array(
            'id'      => 'fscymu-enabled-1',
            'type'    => 'switcher',
            'title'   => 'Update My Footer Year',
            'label'   => 'Activate automatic updating?',
            'help'    => 'Turn on to activate automatic year updates and show/hide policy links.',
            'default' => false,
        ),
        // Before You Get Started Accordian
        array(
            'id'         => 'opt-accordion-1',
            'type'       => 'accordion',
            'title'      => 'Before you get started',
            'accordions' => array( array(
            'title'  => 'Is copyright year currently in your footer?',
            'icon'   => 'fa fa-plus',
            'fields' => array(
            // Content Field
            array(
                'type'    => 'content',
                'content' => '<b>No</b><br>
				Add © year text to your footer. Works with a footer socket or footer widget.
				<br><br>
				<b>Yes</b><br>
				All you need to do is activate automatic updating.<br>
				<br>
				This plugin detects a copyright year in the footer to automatically update it to the current year based on a visitor’s location.<br>
				For example:<br>
				© YYYY<br>
				Copyright YYYY<br>
				© Copyright YYYY<br>
				© YYYY - YYYY',
            ),
        ),
        ), array(
            'title'  => 'Testing',
            'icon'   => 'fa fa-plus',
            'fields' => array(
            // Content Field
            array(
                'type'    => 'content',
                'content' => 'Test if updates are working by entering a past year in your footer, then activate automatic updates and visit the site to view the footer. Refresh your browser to view changes. It does not work on years prior to 2000.',
            ),
        ),
        ), array(
            'title'  => 'Troubleshooting',
            'icon'   => 'fa fa-plus',
            'fields' => array(
            // Content Field
            array(
                'type'    => 'content',
                'content' => 'This plugin does not work with this format:<br>
						© Company YYYY<br>
						Copyright Company YYYY<br>
						© YYYY to YYYY<br>
						<br>
						Rearrange text to:<br>
						© YYYY Company<br>
						Copyright YYYY Company<br>
						© YYYY - YYYY<br>
						<br>
						Page cache is automatically cleared sitewide each time settings are saved. If you do not see changes take effect, refresh your browser or clear page cache manually.<br>
						<br>
						<a href="https://support.5starplugins.com/category/244-troubleshooting?utm_source=dynamic-copyright&utm_medium=plugin&utm_campaign=dcy-dashboard&utm_source_platform=wordpress" target="_blank">More Tips</a>',
            ),
        ),
        ) ),
        ),
    ),
    ) );
    // Create a Sub-tab
    CSF::createSection( $prefix, array(
        'parent' => 'primary_tab',
        'title'  => 'Policy Links',
        'icon'   => 'fa fa-star',
        'fields' => array(
        // Tab Heading
        array(
            'type'    => 'heading',
            'content' => 'Upgrade For Premium Settings',
        ),
        array(
            'type'    => 'notice',
            'style'   => 'success',
            'content' => 'Upgrade to Premium for added features including:<br><br>
			- Add up to 3 additional links after the copyright content<br>
			- Position those links next to or below the copyright line<br><br>
			<button class="button button-primary" onclick="window.location.href=\'/wp-admin/admin.php?page=fscymu-options-pricing\'" type="button">View Upgrade Details</button>
		',
        ),
        // Select Dropdown
        array(
            'id'          => 'fscymu-prem-position-1',
            'type'        => 'select',
            'title'       => 'Position',
            'placeholder' => 'Upgrade to choose positioning of links',
            'options'     => array(
            'sameline' => 'Same line with copyright',
            'below'    => 'Below copyright',
        ),
            'attributes'  => array(
            'disabled' => 'true',
        ),
            'default'     => 'sameline',
        ),
        // Fieldset
        array(
            'id'       => 'fscymu-policylinks-1',
            'type'     => 'fieldset',
            'title'    => 'Policy Links',
            'subtitle' => 'Add footer links to a policy or disclosure. Leave blank to not show.',
            'fields'   => array( array(
            'id'         => 'fscymu-upgrade-link1',
            'type'       => 'text',
            'title'      => 'Link 1',
            'default'    => 'Upgrade to add links.',
            'attributes' => array(
            'readonly' => 'true',
        ),
        ), array(
            'id'         => 'fscymu-upgrade-link2',
            'type'       => 'text',
            'title'      => 'Link 2',
            'default'    => 'Upgrade to add links.',
            'attributes' => array(
            'readonly' => 'true',
        ),
        ), array(
            'id'         => 'fscymu-upgrade-link3',
            'type'       => 'text',
            'title'      => 'Link 3',
            'default'    => 'Upgrade to add links.',
            'attributes' => array(
            'readonly' => 'true',
        ),
        ) ),
        ),
        // Enabled On/Off Activation
        array(
            'id'          => 'fscymu-policylink-ptag-upgrade',
            'type'        => 'text',
            'title'       => 'Format Quick Fix',
            'placeholder' => 'Upgrade to enable adding HTML &lt;p&gt; tags around links',
            'label'       => 'Adding HTML &lt;p&gt; tags may help the policy links look the same as the copyright text.',
            'help'        => 'If your theme uses &lt;p&gt; tags around footer text, enable this so the style matches.',
            'default'     => false,
            'attributes'  => array(
            'readonly' => 'true',
            'disabled' => 'true',
        ),
        ),
    ),
    ) );
    $whyUpgrade = (include plugin_dir_path( __FILE__ ) . 'whyupgrade.php');
    // fsdcy_fs()->get_trial_url()
    // Create a top-tab
    CSF::createSection( $prefix, array(
        'id'     => 'secondry_tab',
        'title'  => 'Why Upgrade?',
        'fields' => array(
        // Heading
        array(
            'type'    => 'heading',
            'content' => 'Get More in the Premium Plugin',
        ),
        // A Content Field Example
        array(
            'type'    => 'content',
            'content' => $whyUpgrade,
        ),
    ),
    ) );
}

// Add cache clearing
if ( !function_exists( 'fscymu_clear_cache_on_save' ) ) {
    function fscymu_clear_cache_on_save()
    {
        wp_cache_flush();
        $psp_cleared = FALSE;
        // WP Cloudlfare Super Page Cache purge CF cache
        
        if ( has_action( 'swcfpc_purge_cache' ) ) {
            do_action( "swcfpc_purge_cache" );
            //echo "<div class='notice notice-success is-dismissible'><p>WP Cloudflare Super Page cache cleared (may take 30+ seconds).</p></div>";
            $psp_cleared = TRUE;
        }
        
        // WP Rocket
        
        if ( function_exists( 'rocket_clean_domain' ) ) {
            rocket_clean_domain();
            //echo "<div class='notice notice-success is-dismissible'><p>WP Rocket cache cleared.</p></div>";
            $psp_cleared = TRUE;
        }
        
        // W3 Total Cache : w3tc
        
        if ( function_exists( 'w3tc_pgcache_flush' ) ) {
            w3tc_pgcache_flush();
            //echo "<div class='notice notice-success is-dismissible'><p>W3TC cache cleared.</p></div>";
            $psp_cleared = TRUE;
        }
        
        // WP Super Cache : wp-super-cache
        
        if ( function_exists( 'wp_cache_clear_cache' ) ) {
            wp_cache_clear_cache();
            //echo "<div class='notice notice-success is-dismissible'><p>WP Super Cache cache cleared.</p></div>";
            $psp_cleared = TRUE;
        }
        
        // WP Fastest Cache
        
        if ( function_exists( 'wpfc_clear_all_cache' ) ) {
            wpfc_clear_all_cache( true );
            //echo "<div class='notice notice-success is-dismissible'><p>WP Fastest Cache cache cleared.</p></div>";
            $psp_cleared = TRUE;
        }
        
        // WPEngine
        
        if ( class_exists( 'WpeCommon' ) && method_exists( 'WpeCommon', 'purge_memcached' ) ) {
            WpeCommon::purge_memcached();
            WpeCommon::purge_varnish_cache();
            //echo "<div class='notice notice-success is-dismissible'><p>WPEngine cache cleared.</p></div>";
            $psp_cleared = TRUE;
        }
        
        // SG Optimizer by Siteground
        
        if ( function_exists( 'sg_cachepress_purge_cache' ) ) {
            sg_cachepress_purge_cache();
            //echo "<div class='notice notice-success is-dismissible'><p>SiteGround Optimizer cache cleared.</p></div>";
            $psp_cleared = TRUE;
        }
        
        // LiteSpeed
        
        if ( class_exists( 'LiteSpeed_Cache_API' ) && method_exists( 'LiteSpeed_Cache_API', 'purge_all' ) ) {
            LiteSpeed_Cache_API::purge_all();
            //echo "<div class='notice notice-success is-dismissible'><p>LiteSpeed cache cleared.</p></div>";
            $psp_cleared = TRUE;
        }
        
        // Cache Enabler
        
        if ( class_exists( 'Cache_Enabler' ) && method_exists( 'Cache_Enabler', 'clear_total_cache' ) ) {
            Cache_Enabler::clear_total_cache();
            //echo "<div class='notice notice-success is-dismissible'><p>Cache Enabler cache cleared.</p></div>";
            $psp_cleared = TRUE;
        }
        
        // Pagely
        
        if ( class_exists( 'PagelyCachePurge' ) && method_exists( 'PagelyCachePurge', 'purgeAll' ) ) {
            PagelyCachePurge::purgeAll();
            //echo "<div class='notice notice-success is-dismissible'><p>Pagely cache cleared.</p></div>";
            $psp_cleared = TRUE;
        }
        
        // Autoptimize
        
        if ( class_exists( 'autoptimizeCache' ) && method_exists( 'autoptimizeCache', 'clearall' ) ) {
            autoptimizeCache::clearall();
            //echo "<div class='notice notice-success is-dismissible'><p>Autoptimize cache cleared.</p></div>";
            $psp_cleared = TRUE;
        }
        
        // Comet cache
        
        if ( class_exists( 'comet_cache' ) && method_exists( 'comet_cache', 'clear' ) ) {
            comet_cache::clear();
            //echo "<div class='notice notice-success is-dismissible'><p>Comet Cache cache cleared.</p></div>";
            $psp_cleared = TRUE;
        }
        
        // Hummingbird Cache
        
        if ( class_exists( '\\Hummingbird\\WP_Hummingbird' ) && method_exists( '\\Hummingbird\\WP_Hummingbird', 'flush_cache' ) ) {
            \Hummingbird\WP_Hummingbird::flush_cache();
            //echo "<div class='notice notice-success is-dismissible'><p>Hummingbird cache cleared.</p></div>";
            $dcy_cleared = TRUE;
        }
        
        if ( !$dcy_cleared ) {
            //echo "<div class='notice notice-success is-dismissible'><p>NOTE: Please be sure to clear any page caches for new settings to display.</p></div>";
        }
    }

}
// Helpscout Free Beacon

if ( fsdcy_fs()->is_not_paying() ) {
    add_action( 'admin_enqueue_scripts', 'fsdcy_beacon_header_free' );
    // Add Helpscout Free Beacon code
    if ( !function_exists( 'fsdcy_beacon_header_free' ) ) {
        function fsdcy_beacon_header_free( $page )
        {
            if ( 'toplevel_page_fscymu-options' != $page ) {
                return;
            }
            $beacon_html = '<script type="text/javascript">!function(e,t,n){function a(){var e=t.getElementsByTagName("script")[0],n=t.createElement("script");n.type="text/javascript",n.async=!0,n.src="https://beacon-v2.helpscout.net",e.parentNode.insertBefore(n,e)}if(e.Beacon=n=function(t,n,a){e.Beacon.readyQueue.push({method:t,options:n,data:a})},n.readyQueue=[],"complete"===t.readyState)return a();e.attachEvent?e.attachEvent("onload",a):e.addEventListener("load",a,!1)}(window,document,window.Beacon||function(){});';
            $beacon_html .= "window.Beacon('init', 'eeafdf72-97ad-42e4-babd-e38c7b5d4450');</script>";
            echo  $beacon_html ;
        }
    
    }
}
