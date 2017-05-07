<?php
/**
 * Plugin Name: Simple Contact Form Feedback
 * Plugin URI: http://www.example.com
 * Description: Simple Add Contact Form To Your Pages.
 * Version: 1.0.1
 * Author: Sandeep
 * Author URI: http://www.example.com
 * License: GPL2
 */
function simple_contact_form_db(){
global $wpdb, $wp_version;
$simple_contact_form_db_table0 = $wpdb->prefix . "simple_contact_form_feedback";
$wpdb->query("CREATE TABLE IF NOT EXISTS `". $simple_contact_form_db_table0."` 
	(
	  `id` INT( 11 ) NOT NULL AUTO_INCREMENT ,
	  `cformfullname` VARCHAR(255) NOT NULL ,
	  `cformemail` VARCHAR(255) NOT NULL ,
	  `cformphone` VARCHAR(255) NOT NULL ,
	  `cformcity` VARCHAR(255) NOT NULL ,
	  `cformmessage` VARCHAR(255) NOT NULL ,
	   PRIMARY KEY (  `id` ))");

}
function view_list_contact(){
include('contact-admin/view_contact_list.php');
displaySimpleCSSSettings();
}
function add_new_form(){
include('contact-admin/add_form.php');
}
function call_edit_form(){

}
function contact_form_shortcode()
 {
 	include('short-code/shortcode.php');
 }

function add_admin_contact_form(){
	add_menu_page( 'Simple Contact Form Feedback -- plugin', 'Simple Contact Form Feedback', 1, 'simple-contact-form-feedback', 'view_list_contact' );
	add_submenu_page( 'Add Contact Form', 'Add Contact Form', 'Add Contact Form', 1, 'add-contact-form', 'add_new_form' );
	add_submenu_page( 'Edit Contact Form', 'Edit Contact Form', 'Edit Contact Form', 1, 'edit-contact-form', 'call_edit_form' ); 
}

function add_simple_stylesheet(){
    wp_register_style( 'wp-custom-css', plugins_url('/contact-admin/wp-custom-css.css', __FILE__) );
    wp_enqueue_style( 'wp-custom-css' );
}
add_action( 'wp_enqueue_scripts', 'add_simple_stylesheet' );

function load_simple_wp_admin_style($hook) {
	if($hook != 'toplevel_page_simple-contact-form-feedback') {
                return;
    }
     wp_enqueue_style( 'simple_wp_admin_css', plugins_url('simple_wp_admin_css.css', __FILE__) );
}
add_action( 'admin_enqueue_scripts', 'load_simple_wp_admin_style' );


add_action('admin_menu', 'add_admin_contact_form');
contact_form_shortcode();
add_shortcode('contact_form_short', 'contact_form_creation');
register_activation_hook(__FILE__, 'simple_contact_form_db');