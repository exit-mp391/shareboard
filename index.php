<?php
// Startuje sesiju na svaku stranicu
session_start();

// Include Config
require('config.php');

require('classes/Messages.php');
require('classes/Bootstrap.php');
require('classes/Controller.php');
require('classes/Model.php');

require('controllers/home.php');
require('controllers/shares.php');
require('controllers/users.php');

require('models/home.php');
require('models/share.php');
require('models/user.php');

$bootstrap = new Bootstrap($_GET);
//nas konstruktor uzima request i request ce doci u formi $_GET

$controller = $bootstrap->createController();
if($controller){
	$controller->executeAction();
}