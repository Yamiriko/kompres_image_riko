<?php
/*
fungsi UploadImageResize mengecilkan width dan kualitas gambar
fungsi UploadGambarResize mengecilkan width dan height serta kualitas gambar
simpan skrip ini pada sebuah file dengan nama kompresgambar.php misalnya.
CV MediaSoft Solusindo https://www.facebook.com/MediasoftSolusindoPKU/
*/
function UploadImageResize($new_name,$file,$dir,$width,$kualitas){
	//direktori gambar
	$vdir_upload = $dir;
	$vfile_upload = $vdir_upload . $_FILES[''.$file.'']["name"];

	//Simpan gambar dalam ukuran sebenarnya
	move_uploaded_file($_FILES[''.$file.'']["tmp_name"], $dir.$_FILES[''.$file.'']["name"]);

	//identitas file asli
	$info = getimagesize($vfile_upload);
	if ($info['mime'] == 'image/jpeg')
		$im_src = imagecreatefromjpeg($vfile_upload);
	elseif ($info['mime'] == 'image/gif') 
        $im_src = imagecreatefromgif($vfile_upload);
    elseif ($info['mime'] == 'image/png') 
		$im_src = imagecreatefrompng($vfile_upload);
	//$im_src = imagecreatefromjpeg($vfile_upload);
	$src_width = imageSX($im_src);
	$src_height = imageSY($im_src);

	//Set ukuran gambar hasil perubahan
	$dst_width = $width;
	$dst_height = ($dst_width/$src_width)*$src_height;

	//proses perubahan ukuran
	$im = imagecreatetruecolor($dst_width,$dst_height);
	imagecopyresampled($im, $im_src, 0, 0, 0, 0, $dst_width, $dst_height, $src_width, $src_height);

	//Simpan gambar
	if ($info['mime'] == 'image/jpeg')
		imagejpeg($im,$vdir_upload . $new_name,$kualitas);
	elseif ($info['mime'] == 'image/gif') 
        imagegif($im,$vdir_upload . $new_name);
    elseif ($info['mime'] == 'image/png') {
		$pngQuality = $kualitas;
		$pngQuality = ($kualitas - 100) / 11.111111;
		$pngQuality = round(abs($pngQuality));
		imagepng($im,$vdir_upload . $new_name,$pngQuality,NULL);
	}
   
	//Hapus gambar di memori komputer
	imagedestroy($im_src);
	imagedestroy($im);
	$remove_small = unlink("$vfile_upload");
	
	return true;
}


function UploadGambarResize($new_name,$file,$dir,$lebar,$tinggi,$kualitas){
	//direktori gambar
	$vdir_upload = $dir;
	$vfile_upload = $vdir_upload . $_FILES[''.$file.'']["name"];

	//Simpan gambar dalam ukuran sebenarnya
	move_uploaded_file($_FILES[''.$file.'']["tmp_name"], $dir.$_FILES[''.$file.'']["name"]);

	//identitas file asli
	$info = getimagesize($vfile_upload);
	if ($info['mime'] == 'image/jpeg')
		$im_src = imagecreatefromjpeg($vfile_upload);
	elseif ($info['mime'] == 'image/gif') 
        $im_src = imagecreatefromgif($vfile_upload);
    elseif ($info['mime'] == 'image/png') 
		$im_src = imagecreatefrompng($vfile_upload);
	//$im_src = imagecreatefromjpeg($vfile_upload);
	$src_width = imageSX($im_src);
	$src_height = imageSY($im_src);

	//Set ukuran gambar hasil perubahan
	$dst_width = $lebar;
	$dst_height = $tinggi;

	//proses perubahan ukuran
	$im = imagecreatetruecolor($dst_width,$dst_height);
	imagecopyresampled($im, $im_src, 0, 0, 0, 0, $dst_width, $dst_height, $src_width, $src_height);

	//Simpan gambar
	if ($info['mime'] == 'image/jpeg')
		imagejpeg($im,$vdir_upload . $new_name,$kualitas);
	elseif ($info['mime'] == 'image/gif') 
        imagegif($im,$vdir_upload . $new_name);
    elseif ($info['mime'] == 'image/png') {
		$pngQuality = $kualitas;
		$pngQuality = ($kualitas - 100) / 11.111111;
		$pngQuality = round(abs($pngQuality));
		imagepng($im,$vdir_upload . $new_name,$pngQuality,NULL);
	}
   
	//Hapus gambar di memori komputer
	imagedestroy($im_src);
	imagedestroy($im);
	$remove_small = unlink("$vfile_upload");
	
	return true;
}

?>