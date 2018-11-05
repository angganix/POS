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

$fieldSort = array("id_barang_pokok", "id_barang_pokok", "nama_barang_pokok", "strSatuan", "harga");
$fieldSearch = array("kode_barang_pokok", "nama_barang_pokok", "harga");
$stringSearch = "";

//Konfigurasi pencarian
if($criteria !== "1=1"){
	$criteria = str_replace(" ", "%", $criteria);

	foreach($fieldSearch as $val){
		$stringSearch .= $val." LIKE '%".$criteria."%' OR ";
	}

	$criteria = substr($stringSearch, 0, -4);

}

//Add, Update, Delete
$kode_prefix = "BP";

//Data Section
$id = isset($_POST['id']) ? $_POST['id'] : "";
$nama_barang_pokok = isset($_POST['nama_barang_pokok']) ? cleanInput($_POST['nama_barang_pokok']) : "";
$id_satuan = isset($_POST['id_satuan']) ? cleanInput($_POST['id_satuan']) : "";
$id_satuan2 = isset($_POST['id_satuan2']) ? cleanInput($_POST['id_satuan2']) : "";
$harga = isset($_POST['harga']) ? cleanInput($_POST['harga']) : "";

//Image Section
$dir = "../upload/";
$foto = isset($_FILES['foto']['name']) ? $_FILES['foto']['name'] : "";
$fotoTmp = isset($_FILES['foto']['tmp_name']) ? $_FILES['foto']['tmp_name'] : ""; 
$arrExt = array("jpg","jpeg","png","gif","tiff");
$errExt = 0;
$errUpl = 0;

$getExt = explode(".", $foto);
$extPic = end($getExt);
$fileFoto = $kode_prefix."-".rand(99, 999).date("YmdHis").".".strtolower($extPic);

$data_array = array(
	"nama_barang_pokok" => $nama_barang_pokok,
	"id_satuan" => $id_satuan,
	"id_satuan2" => $id_satuan2,
	"harga" => $harga,
	"foto" => $fileFoto
);


if($act == "getAll"){

	$query = $cls->getArray("*, (SELECT kode_satuan FROM satuan WHERE id_satuan=barang_pokok.id_satuan) AS strSatuan, (SELECT kode_satuan FROM satuan WHERE id_satuan=barang_pokok.id_satuan2) AS strSatuan2 ", "barang_pokok", "($criteria) ORDER BY $fieldSort[$sortBy] $sortDir LIMIT $offset, $perPage");
	$get_count = $cls->getCount("*", "barang_pokok", "($criteria)");

	$ret['data'] = $query;
	$ret['recordsTotal'] = intval($get_count['total_record']);
	$ret['recordsFiltered'] = intval($get_count['total_record']);
	$ret['draw'] = intval($draw);


}elseif($act == "getData"){

	$query = $cls->getArray("*, (SELECT kode_satuan FROM satuan WHERE id_satuan=barang_pokok.id_satuan) AS strSatuan, (SELECT kode_satuan FROM satuan WHERE id_satuan=barang_pokok.id_satuan2) AS strSatuan2", "barang_pokok", "id_barang_pokok=".$id);

	$ret['result'] = $query;

}elseif($act == "save"){

	if($id == 0){

		if(in_array($extPic, $arrExt)){
			if(move_uploaded_file($fotoTmp, $dir.$fileFoto)){

				$query = $cls->addNew("barang_pokok", $data_array);
				$getLast = $db->lastInsertId();

				$setKode = array(
					"kode_barang_pokok" => $kode_prefix.$getLast
				);

				$cls->update("barang_pokok", $setKode, "id_barang_pokok=".$getLast);

			}else{
				$errUpl = 1;
			}
		}else{
			$errExt = 1;
		}
		
		
	}else{
		if(empty($foto)){
			unset($data_array["foto"]);

			$query = $cls->update("barang_pokok", $data_array, "id_barang_pokok=".$id);

		}else{
			$getOldFoto = $cls->getData("foto", "barang_pokok", "id_barang_pokok=".$id);
			$oldFoto = $getOldFoto['foto'];
			if($oldFoto !== null OR $oldFoto !== ""){
				unlink($dir.$oldFoto);
			}

			if(in_array($extPic, $arrExt)){
				if(move_uploaded_file($fotoTmp, $dir.$fileFoto)){

					$query = $cls->update("barang_pokok", $data_array, "id_barang_pokok=".$id);

				}else{
					$errUpl = 1;
				}
			}else{
				$errExt = 1;
			}

		}

		

	}

	if($id == 0){
		if($errExt === 0){
			if($errUpl === 0){
				if($query){
					$ret['status'] = true;
				}else{
					$ret['status'] = false;
				}
			}else{
				$ret['status'] = "error_upload";
			}
		}else{
			$ret['status'] = "invalid_extension";
		}
	}else{
		if($query){
			$ret['status'] = true;
		}else{
			$ret['status'] = false;
		}
	}
	
	

}elseif($act == "del"){
	$getPict = $cls->getData("foto", "barang_pokok", "id_barang_pokok=".$id);
	if($getPict['foto'] !== null OR $getPict['foto'] !== ""){
		unlink($dir.$getPict['foto']);
	}	

	$query = $cls->del("barang_pokok", "id_barang_pokok=".$id);
	

	if($query){		
		$ret['status'] = true;
	}else{
		$ret['status'] =  false;
	}

}elseif($act == "getSatuan"){

	$query = $cls->getArray("*", "satuan", "1=1");

	$ret['result'] = $query;

}

echo json_encode($ret);
