<?php  

use Projet4\Model\Autoloader;

require_once('Autoloader.php');

class Controller {

	public function __construct() {
		Autoloader::register();
	}
}





