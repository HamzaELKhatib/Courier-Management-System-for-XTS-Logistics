<?php
ob_start();
date_default_timezone_set("Africa/Casablanca");

$action = $_GET['action'];
include 'admin_class.php';
$crud = new Action();
if($action == 'login'){
	$login = $crud->login();
	if($login)
		echo $login;
}

if($action == 'logout'){
	$logout = $crud->logout();
	if($logout)
		echo $logout;
}
if($action == 'logout2'){
	$logout = $crud->logout2();
	if($logout)
		echo $logout;
}
if($action == 'delete_staff'){
	$save = $crud->delete_staff();
	if($save)
		echo $save;
}
if($action == 'signup'){
	$save = $crud->signup();
	if($save)
		echo $save;
}
if($action == 'save_user'){
	$save = $crud->save_user();
	if($save)
		echo $save;
}
if($action == 'update_user'){
	$save = $crud->update_user();
	if($save)
		echo $save;
}
if($action == 'delete_user'){
	$save = $crud->delete_user();
	if($save)
		echo $save;
}
if($action == 'save_branch'){
	$save = $crud->save_branch();
	if($save)
		echo $save;
}
if($action == 'delete_branch'){
	$save = $crud->delete_branch();
	if($save)
		echo $save;
}
if($action == 'save_parcel'){
	$save = $crud->save_parcel();
	if($save)
		echo $save;
}
if($action == 'delete_parcel'){
	$save = $crud->delete_parcel();
	if($save)
		echo $save;
}
if($action == 'update_parcel'){
	$save = $crud->update_parcel();
	if($save)
		echo $save;
}
if($action == 'update_parcel_send'){
	$save = $crud->update_parcel_send();
	if($save)
		echo $save;
}
if($action == 'arrived_parcel_domicile'){
	$save = $crud->arrived_parcel_domicile();
	if($save)
		echo $save;
}
if($action == 'arrived_parcel_agence'){
	$save = $crud->arrived_parcel_agence();
	if($save)
		echo $save;
}
if($action == 'save_parcel_agence'){
	$save = $crud->save_parcel_agence();
	if($save)
		echo $save;
}
if($action == 'get_parcel_history'){
	$get = $crud->get_parcel_history();
	if($get)
		echo $get;
}

if($action == 'get_report'){
	$get = $crud->get_report();
	if($get)
		echo $get;
}

if($action == 'save_feuille_chargement'){
	$save = $crud->save_feuille_chargement();
	if($save)
		echo $save;
}
ob_end_flush();
?>
