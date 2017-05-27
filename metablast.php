<?php

/*
Plugin Name: Metablast
Description: This plugin enhances the optimisation of your website by providing additional fields to add meta tags to your posts and pages.
Developed By: Djouonang Landry
Text Domain: metablast
Domain Path: /languages/
Version: 1.0
*/
$options = get_option( 'buddy_settings' );

//Include settings page file

include dirname( __FILE__ ) .'/admin/admin.php';
include dirname( __FILE__ ) .'/admin/functions.php';
include dirname( __FILE__ ) .'/admin/taxonomyphp.php';
