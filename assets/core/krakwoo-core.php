<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

add_action( 'woocommerce_single_product_summary', 'krakwoo_quick_order', 35 );
function krakwoo_quick_order(){
    echo '<button class="ui button krak-quickorder" type="submit">'. esc_html('Order via WhatsApp', 'krak-quickorder').'</button>';
    echo '<div class="krak-quick-order hidden">
            <form class="ui form">
              <div class="field">
                <label>'. esc_html('Full Name', 'krak-quickorder').'</label>
                <input type="text" name="krak-name" placeholder="First Name">
              </div>
              <div class="field">
                <label>'. esc_html('Address', 'krak-quickorder'). '</label>
                <textarea rows="3" name="krak-address" placeholder="Shipping Address"></textarea>
              </div>
              <div class="field">
                <label>'. esc_html('Postcode / ZIP', 'krak-quickorder').'</label>
                <input type="text" name="krak-postcode" placeholder="Postcode">
              </div>
              <div class="field">
                <label>'. esc_html('Quantity', 'krak-quickorder').'</label>
                <input type="number" name="krak-quantity" placeholder="Quantity" value="1" min="1">
              </div>
              <div class="field">
                <label>'. esc_html('E-mail address', 'krak-quickorder').'</label>
                <input type="email" name="krak-email" placeholder="E-mail Address">
              </div>
              <button class="ui button send-krak-quickorder">'. esc_html('Order via WhatsApp', 'krak-quickorder').'</button>
            </form>
        </div>';
    echo '<div class="lds-css ng-scope hidden">
            <div class="lds-spin" style="100%;height:100%"><div><div></div></div><div><div></div></div><div><div></div></div><div><div></div></div><div><div></div></div><div><div></div></div><div><div></div></div><div><div></div></div><div><div></div></div><div><div></div></div><div><div></div></div><div><div></div></div></div>
        </div>';
    echo '<div class="krak-wa-number hidden">'. get_option('krak_whatsapp_number') .'</div>';
    echo '<div class="krak-wa-message hidden">'. get_option('krak_whatsapp_message') .'</div>';
}

function krak_load_depencies() {
    wp_enqueue_style( 'krak', KRAKPATH . 'assets/css/style.css' );
    wp_enqueue_style( 'bootstrap-theme', KRAKPATH . 'assets/css/form.min.css' );
    
    wp_register_script('bootstrap', KRAKPATH . 'assets/js/form.min.js' , array('jquery'),'1.1', true);
    wp_register_script('krak', KRAKPATH . 'assets/js/core.js' , array('jquery'),'1.1', true);
    wp_enqueue_script('krak');
    wp_enqueue_script('bootstrap');

}
add_action( 'wp_enqueue_scripts', 'krak_load_depencies' );
