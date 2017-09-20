<?php
$status = 1;
$interval = 1;
$humid = filter_input(INPUT_GET, 'valor', FILTER_SANITIZE_NUMBER_FLOAT);

if(is_null($humid)){
	//die("Dados inválidos");
	$status = 0;
}
$serverName = "localhost";
$username = "angelica";
$password = "1234";
$dataBaseName = "angelica";
$connect = new mysqli($serverName, $username, $password, $dataBaseName);
if($connect->connect_error){
	//die("Não foi possível estabelecer conexão com o BD: ", $connect->connect_error);
	$status = 0;
}
$sql = "INSERT INTO humid_data (valor_umidade) VALUES ($humid)";

if (!$connect->query($sql)){
	//die("Erro na gravação dos dados no BD");
	$status = 0;
}

$sql = "select * from configurations where id = 1";
$result = $connect->query($sql);
if (!$result){
	//die("Erro na gravação dos dados no BD");
	$status = 0;
}else{
	$row = $result->fetch_array(MYSQLI_ASSOC);
	$interval = $row['interval'];
}


$connect->close();

$arr = array('status' => $status, 'valor' => $humid, 'interval' => $interval, 'min' => $row['min'], 'max' => $row['max'], 'pump' => $row['status']);

echo json_encode($arr);

?>
