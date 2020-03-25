<?php
header("Content-type:application/json");
date_default_timezone_set("Asia/Jakarta");
$tanggal=date("Y-m-d H:i:s");
$tgl_sekarang=date("Y-m-d");

require_once "kompres-gambar.php";

$modul = (isset($_POST['modul']))? $_POST['modul'] : null;
$act = (isset($_POST['act']))? $_POST['act'] : null;
$gambar = (isset($_POST['gambar']))? $_POST['gambar'] : null;
$ext_gambar = (isset($_POST['ext_gambar']))? $_POST['ext_gambar'] : null;

$respon = array();
$respon["data"] = array();

$dir= "../gambar/";

if (($modul == "client_side") AND ($act == "upload")){
	if(!empty($gambar)){
		$new_name='gambar_client_side_'.date("dmYHis").'.'.$ext_gambar;
		if(file_put_contents($dir.$new_name,base64_decode($gambar))){
			$respon["pesan"]="sukses";
		}
		else $respon["pesan"]="gagal";
	}
	else{		
		$respon["pesan"]="gambar_kosong";
	}
	echo json_encode($respon, JSON_PRETTY_PRINT);
}
elseif (($modul == "server_side") AND ($act == "upload")){
	$lebar = 640;
	$kualitas = 75;
	$file='fotonya'; //name pada inputan type file
	$file_type=$_FILES[$file]['type'];
	if ($file_type == 'image/jpeg'){
		$new_name='gambar_server_side_'.date("dmYHis").'.jpg';
	}
	elseif ($file_type == 'image/gif'){
		$new_name='gambar_server_side_'.date("dmYHis").'.gif';
	}
	elseif ($file_type == 'image/png'){
		$new_name='gambar_server_side_'.date("dmYHis").'.png';
	}		
	
	if(UploadImageResize($new_name,$file,$dir,$lebar,$kualitas)){
		$respon["pesan"]="sukses";
	}
	else $respon["pesan"]="gagal";
	
	echo json_encode($respon, JSON_PRETTY_PRINT);
}
else{
	$data['modul'] = $modul;
	$data['act'] = $act;
	array_push($respon["data"], $data);
	$respon["pesan"]="tidak_ada_perintah";
	echo json_encode($respon, JSON_PRETTY_PRINT);
}
?>