<?php

ini_set("display_errors", "1");
require_once "db_conf.php";

function cleanInput($input) {
	$str = htmlspecialchars(urldecode($input));
	$str = str_replace("'", "\'", $str);

	return $str;
}

function rupiah($str){
	return number_format($str, 0, ",", ".");
}

function formatingDates($str, $format_date){
	$tgl = date_create($str);
	return date_format($str, $format_date);
}

function checkParentMenu($search){
	$menu_array = array(
		"master" => array(
			"master_barang_jadi",
			"master_barang_pokok",
			"master_lokasi",
			"master_konveksi",
			"master_akun",
			"master_supplier",
			"master_customer",
			"master_admin"
		)
	);

	if(in_array($search, $menu_array["master"])){
		return "active";
	}else{
		return "";
	}
}

function checkMenu($cek, $cur){
	if($cek == $cur){
		return "class='active'";
	}else{
		return "";
	}
}

$db = new PDO("mysql:host=$DB_HOST;dbname=$DB_NAME", $DB_USER, $DB_PASS);

if (!$db) {
	die("Database connection error<br />" . print_r($db->errorInfo()));
}

