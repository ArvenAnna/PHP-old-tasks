<?php
/**
* Initialization of controller, calling methods of controller depending on user's actions;
* Including all needed files; 
*/
include $_SERVER['DOCUMENT_ROOT'] . '/Model/Model.php';
include $_SERVER['DOCUMENT_ROOT'] . '/Model/QueryModel.php';
include $_SERVER['DOCUMENT_ROOT'] . '/Controller/Controller.php';

$controller=new Controller();

if ($file=='index.php') {
	if (is_null($_REQUEST['name'])) {
		$controller->actionIndex();
	}
}

if (isset($_REQUEST['name'])) {
	$controller->actionCreateOrder($_REQUEST);	
}

if ($file=='Order_list.php') {
	$controller->actionListOrders();
}

if ($file=='User_orders.php') {
	$controller->actionListUser($_REQUEST['user']);
}