<?php if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly ?>
<div class="wrap sticky_header_settings">
<h1><?php _e('Sticky Header Settings', 'sticky_header')?></h1>
<?php $sticky_headeroptions = array();
$opt_val = get_option('sticky_header_options');
$msg = isset($_GET['msg']) ? $_GET['msg'] : '';
if(isset($_POST['submit_sticky_header']) && wp_verify_nonce( $_POST['sticky_header_nonce_field'], 'sticky_header_action' )):
	_e("<strong>Saving Please wait...</strong>", 'sticky_header');
	$needToUnset = array('submit_sticky_header'); //no need to save in Database
	foreach($needToUnset as $noneed):
	  unset($_POST[$noneed]);
	endforeach;
		foreach($_POST as $key => $val):
		$sticky_headeroptions[$key] = $val;
		endforeach;
		 $saveSettings = update_option('sticky_header_options', $sticky_headeroptions );
		if($saveSettings)
		{
			shds_sh_redirect('options-general.php?page=shds_sticky_header_settings&msg=1');
		}
		else
		{
			shds_sh_redirect('options-general.php?page=shds_sticky_header_settings&msg=2');
		}
endif;
if(!empty($msg) && $msg == 1):
  _e( '<div class="updated settings-error notice is-dismissible" id="setting-error-settings_updated"> 
<p><strong>Settings saved.</strong></p><button class="notice-dismiss" type="button"><span class="screen-reader-text">Dismiss this notice.</span></button></div>', 'sticky_header');	
elseif(!empty($msg) && $msg == 2):
  _e( '<div class="error settings-error notice is-dismissible" id="setting-error-settings_updated"> 
<p><strong>Settings not saved.</strong></p><button class="notice-dismiss" type="button"><span class="screen-reader-text">Dismiss this notice.</span></button></div>', 'sticky_header');
endif;
?> 
<div id="poststuff">
<div id="post-body" class="metabox-holder columns-2">
<div id="post-body-content" style="position: relative;">
<form action="" method="post" name="duplicate_page_form">
<?php  wp_nonce_field( 'sticky_header_action', 'sticky_header_nonce_field' ); ?>
<table class="form-table">
<tbody>

<tr>
<th scope="row"><label for="sticky_header_classs"><?php _e('Sticky Header Class', 'sticky_header')?></label></th>
<td><input type="text" class="txt_ara" name="sticky_header_classs" value="<?php if(!empty($opt_val['sticky_header_classs'])){ _e($opt_val['sticky_header_classs']);}?>" required> 
    <p><i><?php _e('Please enter class/id name of your header/menu which you want to make sticky. ex: .header/#header', 'sticky_header')?></i></p>
</td>
</tr>
<tr>
<th scope="row"><label for="sticky_header_bgcolor"><?php _e('Sticky Header Background Color', 'sticky_header')?></label></th>
<td><input class="color" name="sticky_header_bgcolor" value="<?php if(!empty($opt_val['sticky_header_bgcolor'])){ _e($opt_val['sticky_header_bgcolor']);}?>" > 
    <p><i><?php _e('Please Choose background color for your sticky header', 'sticky_header')?></i></p>
</td>
</tr>
<tr>
<th scope="row"><label for="sticky_header_txcolor"><?php _e('Sticky Header Text Color', 'sticky_header')?></label></th>
<td><input class="color" name="sticky_header_txcolor" value="<?php if(!empty($opt_val['sticky_header_txcolor'])){ _e($opt_val['sticky_header_txcolor']);}?>" > 
    <p><i><?php _e('Please Choose Text color for your sticky header', 'sticky_header')?></i></p>
</td>
</tr>
<tr>
<th scope="row"><label for="sticky_header_height"><?php _e('Sticky Header Height', 'sticky_header')?></label></th>
<td><input class="hdr_hgt" name="sticky_header_height" value="<?php if(!empty($opt_val['sticky_header_height'])){ _e($opt_val['sticky_header_height']);}?>"> 
    <p><i><?php _e('Please enter height for your sticky header. ex:100px', 'sticky_header')?></i></p>
</td>
</tr>
<tr>
<th scope="row"><label for="sticky_header_scroll"><?php _e('Sticky Header Scroll', 'sticky_header')?></label></th>
<td><input class="header_scroll" name="sticky_header_scroll" value="<?php if(!empty($opt_val['sticky_header_scroll'])){ _e($opt_val['sticky_header_scroll'],'sticky_header');}else{ _e('100','sticky_header');}?>"> 
    <p><i><?php _e('Please enter height for which you want sticky header to b visible without pixcels ex:100', 'sticky_header')?></i></p>
</td>
</tr>
<tr>
<th scope="row"><label for="sticky_header_width"><?php _e('Sticky Header Width', 'sticky_header')?></label></th>
<td><input class="header_scroll" name="sticky_header_width" value="<?php if(!empty($opt_val['sticky_header_width'])){ _e($opt_val['sticky_header_width'],'sticky_header');}else { _e('100%','sticky_header'); }?>" > 
    <p><i><?php _e('Please enter width of sticky header. ex:100% or 100px', 'sticky_header')?></i></p>
</td>
</tr>
<tr>
<th scope="row"><label for="sticky_header_padding"><?php _e('Sticky Header Padding', 'sticky_header')?></label></th>
<td><input class="header_scroll" name="sticky_header_padding" value="<?php if(!empty($opt_val['sticky_header_padding'])){ _e($opt_val['sticky_header_padding'],'sticky_header');}else { echo '0px 0px';}?>" > 
    <p><i><?php _e('Please enter padding for sticky header with pixcels ex:10px 10px', 'sticky_header')?></i></p>
</td>
</tr>
<tr>
<th scope="row"><label for="sticky_header_margin"><?php _e('Sticky Header Margin', 'sticky_header')?></label></th>
<td><input class="header_scroll" name="sticky_header_margin" value="<?php if(!empty($opt_val['sticky_header_margin'])){ _e($opt_val['sticky_header_margin'],'sticky_header');}else { echo '0 auto';}?>" > 
    <p><i><?php _e('Please enter Margin for sticky header with pixcels ex:10px 10px', 'sticky_header')?></i></p>
</td>
</tr>
</tbody></table>
<p class="submit"><input type="submit" value="Save Changes" class="button button-primary" id="submit" name="submit_sticky_header"></p>
</form>
</div>

</div>
</div>
</div>
<script type='text/javascript' src="<?php echo plugins_url( 'js/jqColorPicker.min.js', __FILE__ )?>"></script>
 <script>
  jQuery(".color").colorPicker(); 
 </script>