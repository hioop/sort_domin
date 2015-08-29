<?php
$filename = $_GET['filename'] ? trim($_GET['filename']):'';
if (!$filename) {
	die('filename is null!');
}

$row = 1;
if (($handle = fopen($filename.".php", "r")) !== FALSE) {
    while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
       preg($data[0]);
    }
    fclose($handle);
}

function preg($string){
	global $array;
	$_array = explode('.', $string);
	$extension = $_array['1'];
	$length = strlen($_array[0]);
	$numOnly = '/^[0-9]+$/';
	$stringOnly = '/^[a-zA-Z]+$/';
	$mixed = '/^[a-zA-Z0-9-]+/';
	if (preg_match($numOnly, $_array[0])) {//纯数字
		$array[$extension][$length]['num'][] = $string;
	}elseif (preg_match($stringOnly, $_array[0])){//纯字母
		// $array[$extension][$length]['string'][] = $string;
	}elseif (preg_match($mixed, $_array[0])){//字母数字混合
		// $array[$extension][$length]['mix'][] = $string;
	}
}

echo json_encode($array);
