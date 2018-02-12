<?php
/*
 * Raspberry Remote
 * http://xkonni.github.com/raspberry-remote/
 *
 * configuration for the webinterface
 */

/*
 * define ip address and port here
 */
$source = $_SERVER['SERVER_ADDR'];
$target = '192.168.178.72';
$port = 11337;
/*
 * specify configuration of sockets to use
 *   array("systemcode", "group" , "plug", "description");
 * use empty string to create empty box
 *   ""
 */
 $config=array(
   array("1", "11011", "16", "Nr. 1"),
//  array("1", "11011", "08", "Nr. 2"),
//  array("1", "11011", "04", "Nr. 3"),
 );
?>
