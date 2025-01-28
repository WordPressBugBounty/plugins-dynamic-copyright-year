<?php
/*
Plugin Name: Dynamic Copyright Year
Plugin URI: dynamic-copyright-year
Description: Updates the copyright year in the footer dynamically so it's always current.
Version: 1.1
Author: 5 Star Plugins
Author URI: https://5starplugins.com/
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html
*/

$fscymu_plugindata = get_file_data(__FILE__, array('Version' => 'Version'), false);
$fscymu_version = $fscymu_plugindata['Version'];

require_once plugin_dir_path( __FILE__ ) .'/freemius-sdk.php';
require_once plugin_dir_path( __FILE__ ) .'/inc/codestar-framework/codestar-framework.php';
require_once plugin_dir_path( __FILE__ ) .'/csf-options.php';

// Get options
$options = get_option( 'fscymu_options' );

// Here's the options we're using:
// $options['fscymu-enabled-1']
// $options['prem-position-1'] (sameline, below)
// $options['opt-policylinks-1']['prem-link-1']['text']
// $options['opt-policylinks-1']['prem-link-1']['url']
// $options['opt-policylinks-1']['prem-link-1']['target']
// $options['opt-policylinks-1']['prem-link-2']['text']
// $options['opt-policylinks-1']['prem-link-2']['url']
// $options['opt-policylinks-1']['prem-link-2']['target']
// $options['opt-policylinks-1']['prem-link-3']['text']
// $options['opt-policylinks-1']['prem-link-3']['url']
// $options['opt-policylinks-1']['prem-link-3']['target']
// $options['fscymu-policylink-ptag']

// Enabled logic
if ( $options['fscymu-enabled-1'] == true ) {

	if ( !function_exists('fscymu_jquery') ) {
		function fscymu_jquery() {
			wp_enqueue_script('jquery');
		}
	}
	add_action('wp_enqueue_scripts', 'fscymu_jquery');

// <span class="links"><a href="https://5starplugins.com/" target="_blank">Policy Link Example</a></span>

	add_action( 'wp_footer', function () {
		$options = get_option( 'fscymu_options' );

		if ( empty($options['prem-position-1']) || $options['prem-position-1'] == 'sameline' ) {
			$fscymuSeparator1 = '&nbsp;| ';
			$fscymuSeparator2 = '&nbsp;| ';
			$fscymuSeparator3 = '&nbsp;| ';
		}

		if ( empty($options['prem-position-1']) || $options['prem-position-1'] == 'below' ) {
			$fscymuSeparator1 = '';
			$fscymuSeparator2 = '&nbsp;| ';
			$fscymuSeparator3 = '&nbsp;| ';

			if ( empty($options['opt-policylinks-1']['prem-link-1']['url']) ) {
				$fscymuSeparator2 = '';
			}
			if ( empty($options['opt-policylinks-1']['prem-link-1']['url']) && empty($options['opt-policylinks-1']['prem-link-2']['url']) ) {
				$fscymuSeparator3 = '';
			}	?>
<style>
 .fscymu-links { clear:both;}
</style>
<?php }
		if ( empty($options['fscymu-policylink-ptag']) || $options['fscymu-policylink-ptag'] ) {
			$fscymuPtagStart = '\'<p>\'';
			$fscymuPtagEnd = '\'</p>\'';
		} else {
			$fscymuPtagStart = '\'\'';
			$fscymuPtagEnd = '\'\'';
		} ?>

	<script>
	jQuery(document).ready(function($) {

<?php if ( !empty($options['opt-policylinks-1']['prem-link-1']['url']) || !empty($options['opt-policylinks-1']['prem-link-2']['url']) || !empty($options['opt-policylinks-1']['prem-link-3']['url']) ) { ?>
	fscymuDiv = '<div class="fscymu-links">' + <?php echo $fscymuPtagStart;?>;
	fscymuEndDiv = <?php echo $fscymuPtagEnd;?> + '</div>';
<?php } else { ?>
	fscymuDiv = '';
	fscymuEndDiv = '';
<?php } ?>

<?php if ( !empty($options['opt-policylinks-1']['prem-link-1']['url']) ) { ?>
	const fscymuLink1 = '<?php echo esc_attr($fscymuSeparator1); ?><a href="<?php echo esc_attr($options['opt-policylinks-1']['prem-link-1']['url']); ?>" target="<?php echo esc_attr($options['opt-policylinks-1']['prem-link-1']['target']); ?>"><?php echo esc_attr($options['opt-policylinks-1']['prem-link-1']['text']); ?></a>';
<?php } else { ?>
	const fscymuLink1 = '';
<?php } ?>
<?php if ( !empty($options['opt-policylinks-1']['prem-link-2']['url']) ) { ?>
	const fscymuLink2 = '<?php echo esc_attr($fscymuSeparator2); ?><a href="<?php echo esc_attr($options['opt-policylinks-1']['prem-link-2']['url']); ?>" target="<?php echo esc_attr($options['opt-policylinks-1']['prem-link-2']['target']); ?>"><?php echo esc_attr($options['opt-policylinks-1']['prem-link-2']['text']); ?></a>';
<?php } else { ?>
	const fscymuLink2 = '';
<?php } ?>
<?php if ( !empty($options['opt-policylinks-1']['prem-link-3']['url']) ) { ?>
	const fscymuLink3 = '<?php echo esc_attr($fscymuSeparator3); ?><a href="<?php echo esc_attr($options['opt-policylinks-1']['prem-link-3']['url']); ?>" target="<?php echo esc_attr($options['opt-policylinks-1']['prem-link-3']['target']); ?>"><?php echo esc_attr($options['opt-policylinks-1']['prem-link-3']['text']); ?></a>';
<?php } else { ?>
	const fscymuLink3 = '';
<?php } ?>

			const fscymuCurrentYear = new Date().getFullYear();
//			$("footer").children().each(function () {
			$("footer").find('*').each(function () {
				// Looks for: © 20?? - Text or © 20?? Text
				$(this).html( $(this).html().replace(/(©\ ?)(20..)(\ ?[^-][^ -].*)/i,`$1${fscymuCurrentYear}$3${fscymuDiv}${fscymuLink1}${fscymuLink2}${fscymuLink3}${fscymuEndDiv}` ) );
				$(this).html( $(this).html().replace(/(&copy;\ ?)(20..)(\ ?[^-][^ -].*)/i,`$1${fscymuCurrentYear}$3${fscymuDiv}${fscymuLink1}${fscymuLink2}${fscymuLink3}${fscymuEndDiv}` ) );
				$(this).html( $(this).html().replace(/(&#169;\ ?)(20..)(\ ?[^-][^ -].*)/i,`$1${fscymuCurrentYear}$3${fscymuDiv}${fscymuLink1}${fscymuLink2}${fscymuLink3}${fscymuEndDiv}` ) );
				$(this).html( $(this).html().replace(/(Copyright\ )(20..)(\ ?[^-][^ -].*)/i,`$1${fscymuCurrentYear}$3${fscymuDiv}${fscymuLink1}${fscymuLink2}${fscymuLink3}${fscymuEndDiv}` ) );
				// Looks for: © 20?? - 20?? Text
				$(this).html( $(this).html().replace(/(©\ ?20..\ ?)(\s-\s|-)(20..)(.*)/i,`$1$2${fscymuCurrentYear}$4${fscymuDiv}${fscymuLink1}${fscymuLink2}${fscymuLink3}${fscymuEndDiv}`) );
				$(this).html( $(this).html().replace(/(&copy;\ ?20..\ ?)(\s-\s|-)(20..)(.*)/i,`$1$2${fscymuCurrentYear}$4${fscymuDiv}${fscymuLink1}${fscymuLink2}${fscymuLink3}${fscymuEndDiv}` ) );
				$(this).html( $(this).html().replace(/(&#169;\ ?20..\ ?)(\s-\s|-)(20..)(.*)/i,`$1$2${fscymuCurrentYear}$4${fscymuDiv}${fscymuLink1}${fscymuLink2}${fscymuLink3}${fscymuEndDiv}` ) );
				$(this).html( $(this).html().replace(/(Copyright\ 20..\ ?)(\s-\s|-)(20..)(.*)/i,`$1$2${fscymuCurrentYear}$4${fscymuDiv}${fscymuLink1}${fscymuLink2}${fscymuLink3}${fscymuEndDiv}` ) );
				// Looks for: © 20??-Text
				$(this).html( $(this).html().replace(/(©\ ?)(20..)(\s-\s|-)([^2000-2999].*)/i,`$1${fscymuCurrentYear}$3$4${fscymuDiv}${fscymuLink1}${fscymuLink2}${fscymuLink3}${fscymuEndDiv}`) );
				$(this).html( $(this).html().replace(/(&copy;\ ?)(20..)(\s-\s|-)([^2000-2999].*)/i,`$1${fscymuCurrentYear}$3$4${fscymuDiv}${fscymuLink1}${fscymuLink2}${fscymuLink3}${fscymuEndDiv}` ) );
				$(this).html( $(this).html().replace(/(&#169;\ ?)(20..)(\s-\s|-)([^2000-2999].*)/i,`$1${fscymuCurrentYear}$3$4${fscymuDiv}${fscymuLink1}${fscymuLink2}${fscymuLink3}${fscymuEndDiv}` ) );
				$(this).html( $(this).html().replace(/(Copyright\ )(20..)(\s-\s|-)([^2000-2999].*)/i,`$1${fscymuCurrentYear}$3$4${fscymuDiv}${fscymuLink1}${fscymuLink2}${fscymuLink3}${fscymuEndDiv}` ) );
			});
			$("#footer").find('*').each(function () {
				// Looks for: © 20?? - Text or © 20?? Text
				$(this).html( $(this).html().replace(/(©\ ?)(20..)(\ ?[^-][^ -].*)/i,`$1${fscymuCurrentYear}$3${fscymuDiv}${fscymuLink1}${fscymuLink2}${fscymuLink3}${fscymuEndDiv}` ) );
				$(this).html( $(this).html().replace(/(&copy;\ ?)(20..)(\ ?[^-][^ -].*)/i,`$1${fscymuCurrentYear}$3${fscymuDiv}${fscymuLink1}${fscymuLink2}${fscymuLink3}${fscymuEndDiv}` ) );
				$(this).html( $(this).html().replace(/(&#169;\ ?)(20..)(\ ?[^-][^ -].*)/i,`$1${fscymuCurrentYear}$3${fscymuDiv}${fscymuLink1}${fscymuLink2}${fscymuLink3}${fscymuEndDiv}` ) );
				$(this).html( $(this).html().replace(/(Copyright\ )(20..)(\ ?[^-][^ -].*)/i,`$1${fscymuCurrentYear}$3${fscymuDiv}${fscymuLink1}${fscymuLink2}${fscymuLink3}${fscymuEndDiv}` ) );
				// Looks for: © 20?? - 20?? Text
				$(this).html( $(this).html().replace(/(©\ ?20..\ ?)(\s-\s|-)(20..)(.*)/i,`$1$2${fscymuCurrentYear}$4${fscymuDiv}${fscymuLink1}${fscymuLink2}${fscymuLink3}${fscymuEndDiv}`) );
				$(this).html( $(this).html().replace(/(&copy;\ ?20..\ ?)(\s-\s|-)(20..)(.*)/i,`$1$2${fscymuCurrentYear}$4${fscymuDiv}${fscymuLink1}${fscymuLink2}${fscymuLink3}${fscymuEndDiv}` ) );
				$(this).html( $(this).html().replace(/(&#169;\ ?20..\ ?)(\s-\s|-)(20..)(.*)/i,`$1$2${fscymuCurrentYear}$4${fscymuDiv}${fscymuLink1}${fscymuLink2}${fscymuLink3}${fscymuEndDiv}` ) );
				$(this).html( $(this).html().replace(/(Copyright\ 20..\ ?)(\s-\s|-)(20..)(.*)/i,`$1$2${fscymuCurrentYear}$4${fscymuDiv}${fscymuLink1}${fscymuLink2}${fscymuLink3}${fscymuEndDiv}` ) );
				// Looks for: © 20??-Text
				$(this).html( $(this).html().replace(/(©\ ?)(20..)(\s-\s|-)([^2000-2999].*)/i,`$1${fscymuCurrentYear}$3$4${fscymuDiv}${fscymuLink1}${fscymuLink2}${fscymuLink3}${fscymuEndDiv}`) );
				$(this).html( $(this).html().replace(/(&copy;\ ?)(20..)(\s-\s|-)([^2000-2999].*)/i,`$1${fscymuCurrentYear}$3$4${fscymuDiv}${fscymuLink1}${fscymuLink2}${fscymuLink3}${fscymuEndDiv}` ) );
				$(this).html( $(this).html().replace(/(&#169;\ ?)(20..)(\s-\s|-)([^2000-2999].*)/i,`$1${fscymuCurrentYear}$3$4${fscymuDiv}${fscymuLink1}${fscymuLink2}${fscymuLink3}${fscymuEndDiv}` ) );
				$(this).html( $(this).html().replace(/(Copyright\ )(20..)(\s-\s|-)([^2000-2999].*)/i,`$1${fscymuCurrentYear}$3$4${fscymuDiv}${fscymuLink1}${fscymuLink2}${fscymuLink3}${fscymuEndDiv}` ) );
			});

		});
	</script>
	<?php }, 21 );
}
