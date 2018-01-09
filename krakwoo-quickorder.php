<?php
/*
Plugin Name: Krak - Woocommerce Quick Order via Social Media
Plugin URI: http://krak.lasida.work
description: Make Closing Fast with Quick Order via WhatsApp.
Version: 0.1.0
Author: Lasida Azis
Author URI: http://lasida.work
License: GPL2
*/

include( plugin_dir_path( __FILE__ ) . 'assets/core/krakwoo-settings.php');
include( plugin_dir_path( __FILE__ ) . 'assets/core/krakwoo-core.php');

define( 'KRAKPATH', plugin_dir_url( __FILE__ ) );