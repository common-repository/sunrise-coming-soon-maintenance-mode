<?php

/**
 * Register all actions and filters for the plugin
 *
 * @link       http://jeweltheme.com
 * @since      1.0.0
 *
 * @package    Sunrise_Coming_Soon
 * @subpackage Sunrise_Coming_Soon/includes
 */


function sunrise_customization_settings(){ 
	$sunrise_custom = new Sunrise_Coming_Soon_Loader();

	$logo_width = $sunrise_custom->sunrise_get_option( 'logo_width', 'sunrise_general', '' ); 
	$logo_height = $sunrise_custom->sunrise_get_option( 'logo_height', 'sunrise_general', '' ); 
	$sunrise_bg_image_type_select = $sunrise_custom->sunrise_get_option( 'sunrise_bg_image_type_select', 'sunrise_general', '' ); 
	$sunrise_bg_image = $sunrise_custom->sunrise_get_option( 'sunrise_bg_image', 'sunrise_general', '' ); 
	$bg_color = $sunrise_custom->sunrise_get_option( 'bg_color', 'sunrise_general', '' ); 
?>
	<style>
		.logo-image{
			width: <?php echo $logo_width; ?>;
			height: <?php echo $logo_height; ?>;
		}
		<?php if( $sunrise_bg_image_type_select == "image" ){ ?>
			.bg {
				background: url(<?php echo $sunrise_bg_image; ?>)  no-repeat center center !important;
			    width: 100%;
			}	
		<?php } elseif ($sunrise_bg_image_type_select == "color") { ?>
			.bg {
				background: none;
			}
			.bg-color{
				background-color: <?php echo $bg_color; ?>;
			}
		<?php } ?>
		

	</style>
<?php }
add_action('wp_head', 'sunrise_customization_settings');



/* Display a notice that can be dismissed */

add_action('admin_notices', 'sunrise_admin_notice');

function sunrise_admin_notice() {
    global $current_user ;
        $user_id = $current_user->ID;
    if ( ! get_user_meta($user_id, 'jeweltheme_ignore_notice') ) {
        echo '<div class="updated"><p>';         
        printf(__('<h4 style="font-size: 20px; color: #5FA52A; font-weight: normal; margin-bottom: 10px; margin-top: 5px;"><a href="https://jeweltheme.com/product/kite-coming-soon-wordpress-plugin/" target="_blank">Get Kite – Coming Soon WordPress Plugin Today!</a></h4>Check out Premium Features of <a href="https://jeweltheme.com/product/kite-coming-soon-wordpress-plugin/" target="_blank">WP Awesome FAQ</a> Plugin. Compare Why this Plugin is really awesome !!! <br>
            Jewel Theme, always express the power of WordPress. We are one of the best Team for creating stunning WordPress Themes - Plugins and Website Templates. <br>
            Check all of our <a href="https://jeweltheme.com/product-category/wordpress-themes/" target="_blank">Free and Premium WordPress Themes</a> and <a href="https://jeweltheme.com/product-category/wordpress-plugins/" target="_blank">WordPress Plugins </a> <a style="float: right;" href="%1$s">X</a>'), '?jeweltheme_ignore=0');
        echo "</p></div>";
    }
}
add_action('admin_init', 'sunrise_ignore');


function sunrise_ignore() {
    global $current_user;
        $user_id = $current_user->ID;
        if ( isset($_GET['jeweltheme_ignore']) && '0' == $_GET['jeweltheme_ignore'] ) {
             add_user_meta($user_id, 'jeweltheme_ignore_notice', 'true', true);
    }
}
