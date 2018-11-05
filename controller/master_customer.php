<?php
require_once "../config/init.php";
require_once "../model/Crud_basic.php";

$cls = new Crud_basic($db);

//Group of Variable
$act = isset($_POST['act']) ? $_POST['act'] : "";
$offset = isset($_POST['start']) ? $_POST['start'] : 0;
$perPage = isset($_POST['length']) ? $_POST['length'] : 10;
$draw = isset($_POST['draw']) ? $_POST['draw'] : 1;
$sortBy = isset($_POST['order'][0]['column']) ? $_POST['order'][0]['column'] : 0;
$sortDir = isset($_POST['order'][0]['dir']) ? $_POST['order'][0]['dir'] : 'desc';
$criteria = isset($_POST['search']['value']) ? $_POST['search']['value'] : "1=1";

$fieldSort = array("id_customer","nama","alamat","telpon");
$fieldSearch = array("kode_customer","nama","alamat","telpon");
$stringSearch = "";

//Konfigurasi klausa pencarian
if($criteria !== "1=1"){

	$criteria = str_replace(" ", "%", $criteria);

	foreach($fieldSearch as $val){
		$stringSearch .= $val." LIKE '%".$criteria."%' OR ";
	}

	$criteria = substr($stringSearch, 0, -4);
}


//Add, Update, Delete
$kode_prefix = "CST";

$id = isset($_POST['id']) ? $_POST['id'] : "";
$nama = isset($_POST['nama']) ? cleanInput($_POST['nama']) : "";
$alamat = isset($_POST['alamat']) ? cleanInput($_POST['alamat']) : "";
$telpon = isset($_POST['telpon']) ? cleanInput($_POST['telpon']) : "";

$data_array = array(
	"nama" => $nama,
	"alamat" => $alamat,
	"telpon" => $telpon
);


if($act == "getAll"){

	$query = $cls->getArray("*", "customer", "($criteria) ORDER BY $fieldSort[$sortBy] $sortDir LIMIT $offset, $perPage");
	$get_count = $cls->getCount("*", "customer", "($criteria)");

	$ret['data'] = $query;
	$ret['recordsTotal'] = intval($get_count['total_record']);
	$ret['recordsFiltered'] = intval($get_count['total_record']);
	$ret['draw'] = intval($draw);

}elseif($act == "getData"){

	$query = $cls->getArray("*", "customer", "id_customer=".$id);

	$ret['result'] = $query;

}elseif($act == "save"){

	if($id == 0){
		$query = $cls->addNew("customer", $data_array);
		$getLast = $db->lastInsertId();

		$setKode = array(
			"kode_customer" => $kode_prefix.$getLast
		);

		$cls->update("customer", $setKode, "id_customer=".$getLast);
		
	}else{
		$query = $cls->update("customer", $data_array, "id_customer=".$id);
	}

	if($query){
		$ret['status'] = true;
	}else{
		$ret['status'] = false;
	}

}elseif($act == "del"){

	$query = $cls->del("customer", "id_customer=".$id);

	if($query){
		$ret['status'] = true;
	}else{
		$ret['status'] =  false;
	}

}

echo json_encode($ret);
