<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

add_action('admin_menu', 'krak_quickorder_menu'); 
	if( ! function_exists('krak_quickorder_menu') ) {
	function krak_quickorder_menu() { 
		add_submenu_page( 'options-general.php', 'KRAK - QuickOrder', 'KRAK - QuickOrder', 'manage_options', 'krak_quick_order', 'krak_quick_order_init' );
	}}

add_action( 'admin_init', 'krak_quick_order_settings' ); 
	if( ! function_exists('krak_quick_order_settings') ) {
	function krak_quick_order_settings() {
		register_setting( 'krak-quick-order', 'krak_whatsapp_number' );
		register_setting( 'krak-quick-order', 'krak_whatsapp_message' );
	}}

add_action( 'plugins_loaded', 'krak_load_plugin_textdomain' );
	if( ! function_exists('krak_load_plugin_textdomain') ) {
	function krak_load_plugin_textdomain() {
    	load_plugin_textdomain( 'krak-quickorder', FALSE, KRAKPATH . 'assets/lang/' );
	}}

	if( ! function_exists('krak_quick_order_init') ){
	function krak_quick_order_init() { // Function Add Interface Backend Setting
?>
	<div class="wrap">
	<h2><?php esc_html_e('KRAK - QuickOrder','krak-quickorder'); ?></h2>
		<p>ADS</p>
        <hr>
		<form method="post" action="options.php">
		    <?php settings_fields( 'krak-quick-order' ); ?>
		    <?php do_settings_sections( 'krak-quick-orders' ); ?>
            <?php $krak_whatsapp_number = get_option('krak_whatsapp_number'); ?>
            <?php $krak_whatsapp_message = get_option('krak_whatsapp_message'); ?>
		    <table class="form-table">
		    	<tbody>
		    		<tr>
		    			<th scope="row"><?php esc_html_e('WhatsApp Number','krak-quickorder'); ?></th>
		    			<td>
                            <input type="text" name="krak_whatsapp_number" placeholder="+62 8561655028" value="<?php echo ( $krak_whatsapp_number ) ? $krak_whatsapp_number : ''; ?>">
		    			</td>
		    		</tr>
                    <tr>
                        <th scope="row"><?php esc_html_e('WhatsApp Message Template','krak-quickorder'); ?></th>
                        <td>
                            <textarea rows="13" cols="35" name="krak_whatsapp_message"><?php echo ( $krak_whatsapp_message ) ? $krak_whatsapp_message : 'I want to order *[product_title]*
                                
Name : [user_name]
Address : [user_address]
PostCode : [user_postal]
Email : [user_email]
Quantity : [user_quantity]

[Product Detail]
Product ID : *#[product_id]*
Price : *[product_price]*'; 
?>
                            </textarea>
                        </td>
                    </tr>
		    	</tbody>
		    </table>
		    <?php submit_button(); ?>
		</form>
	</div>
	<?php
	}}
?>