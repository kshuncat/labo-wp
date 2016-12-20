<?php
/*
Plugin Name: Sticky Headers
Plugin URI: https://wordpress.org/plugins/sticky-headers
Description: Add sticky header to the site by just adding header class or id.
Author: mndpsingh287
Version: 1.0
Author URI: https://profiles.wordpress.org/mndpsingh287
Text Domain: Sticky Headers
*/
/*
* Hooks
*/
if(!class_exists('shds_sticky_headers_class')):
class shds_sticky_headers_class
{
	public function __construct()
	{
		register_activation_hook(__FILE__, array(&$this,'shds_sticky_header_install')); /* Activation */
		add_action('admin_menu',array(&$this,'shds_sticky_header_options_page')); /* Options page */
		add_action('wp_head',array(&$this,'shds_scripts_styles_frnt')); /* header Scripts */
		add_action('wp_head',array(&$this,'shds_generate_sticky_css')); /* Header Styles */
		add_filter( 'plugin_action_links', array(&$this, 'shds_system_action_links'), 10, 2 );
	}
/*
* Install Function
*/
public function shds_sticky_header_install()
{
          $defaultsettings = 
						   array(
							 'sticky_header_width' => '100%',
							 'sticky_header_padding' => '0 0',
							 'sticky_header_margin' => '0 auto',
							 'sticky_header_scroll' => '100',				 
								);
	        $opt = get_option('sticky_header_options');			
			update_option('sticky_header_options', $defaultsettings);			 				
}
/*
* Admin Menu 
*/
public function shds_sticky_header_options_page()
{
 add_options_page('Sticky Headers', 'Sticky Headers', 'manage_options', 'shds_sticky_header_settings',array(&$this, 'shds_sticky_header_settings'));
}
/*
  * Plugin Links
  */
public function shds_system_action_links($links, $file)
  {
    if ( $file == plugin_basename(__FILE__) ) {
     
    $duplicate_page_donate = '<a href="http://www.webdesi9.com/donate/?plugin=sticky-headers" title="Donate Now" target="_blank" style="font-weight:bold">'.__('Donate').'</a>';
    array_unshift( $links, $duplicate_page_donate );
   }
  
   return $links; 
  }
/*
* Sticky header settings
*/
public function shds_sticky_header_settings()
{
	if(is_admin()):
	include('admin/sticky-header-settings.php');
	endif;
}
/*
* Sticky header Scripts
*/
public function shds_scripts_styles_frnt() {
	 $opt_val = get_option("sticky_header_options");
	 ?>
  <script>  
  var sticky_header_class   = '<?php echo $opt_val["sticky_header_classs"]; ?>';
  var sticky_header_scroll   = '<?php echo $opt_val["sticky_header_scroll"]; ?>';
  jQuery(window).scroll(function(){
	if(jQuery(document).scrollTop() > sticky_header_scroll){
	jQuery(sticky_header_class).addClass("intro_sticky_hd");
	}else{
		  jQuery(sticky_header_class).removeClass("intro_sticky_hd");	 
	}
	});    
   </script>
<?php } 
/*
* Sticky Header styles
*/
public function shds_generate_sticky_css() {
		$opt_val = get_option("sticky_header_options");?>
		<style type="text/css">
			.intro_sticky_hd {
				background-color: <?php echo $opt_val["sticky_header_bgcolor"]; ?>!important;
			}
			.intro_sticky_hd {
				height: <?php echo $opt_val["sticky_header_height"]; ?>;
			}
			.intro_sticky_hd,
			.intro_sticky_hd a {
				color: <?php echo $opt_val["sticky_header_txcolor"]; ?>!important;
			}			
			.intro_sticky_hd {
				width:<?php echo $opt_val["sticky_header_width"]; ?>!important;				
				position:fixed;
				z-index:99999;
				transition:all 0.5s ease;
			}
          .intro_sticky_hd {
				padding: <?php echo $opt_val["sticky_header_padding"]; ?>!important;
			}			
             <?php echo $opt_val["sticky_header_classs"]; ?>	{
				transition:all 0.5s ease; 
			 }
           .intro_sticky_hd {
				margin: <?php echo $opt_val["sticky_header_margin"]; ?>!important;
			}		 
		</style>
	<?php }
/*
 * Redirect function
*/

}
function shds_sh_redirect($url)
{
	echo '<script>window.location.href="'.$url.'"</script>';
}
new shds_sticky_headers_class;
endif;
?>