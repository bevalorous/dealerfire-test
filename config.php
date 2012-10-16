<?php	
	require_once('base/helpers.php');
	require_once('protected/controllers/ConfigurationController.php');	
	$configController = new ConfigurationController;
	$configController->actionSetup();
?>