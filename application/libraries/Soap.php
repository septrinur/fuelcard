<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Soap {
	
	function __construct() {
		require_once(APPPATH.'third_party/nusoap/nusoap.php'); //If we are executing this script on a Windows server
	}
}