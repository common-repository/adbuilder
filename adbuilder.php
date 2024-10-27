<?php
/**
 * Plugin Name:	      AdBuilder 
 * Description:       Integrates the AdBuilder Grid into WordPress as widgets. You will need to create an AdBuilder account to configure AdBuilder widgets here in WordPress; click <a href="https://console.adbuilder.biz/signup_publisher.php" target="_blank">here</a> to get started.
 * Version:           1.0.0.
 * Requires at least: 5.2
 * Requires PHP:      7.0
 * Author:            AdBuilder - ShareItMobile
 * Author URI:        https://adbuilder.biz/
 * License:           BSD-3-Clause 
 * License URI:       https://opensource.org/licenses/BSD-3-Clause
 */


// Register and load the widget
function adbuilderbiz_load_widget() {
	require_once( 'adbuilderbiz.widget.php' );
	register_widget( 'adbuilderbiz_widget' );
}
add_action( 'widgets_init', 'adbuilderbiz_load_widget' );
