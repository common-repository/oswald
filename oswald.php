<?php
/**
 * Plugin Name: Oswald
 * Plugin URI: http://oswald.net.au/
 * Description: A usefull way to enqueue usefull items
 * Version: 0.1.1
 * Author: Jay Oswald
 * Author URI: http://oswald.net.au
 * License: GPL2
 */
defined( 'ABSPATH' ) or die( 'No script kiddies please!' );
require('inc/settings.php');
require('inc/enqueue_register.php');
require('inc/enqueue.php');