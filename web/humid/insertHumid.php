<? php
$humid = filter_input(INPUT_GET, 'humid', FILTER_SANITIZE_NUMBER_FLOAT);

if(is_null($humid)){
	die("Dados inválidos");
}
$serverName = "localhost";
$username = "root";
$password = "root";
$dataBaseName = "irrigador";
$connect = new mysqli($serverName, $username, $password, $dataBaseName);
if($connect->connect_error){
	die("Não foi possível estabelecer conexão com o BD: ", $connect->connect_error);
$sql = "INSERT INTO humid_data (valor_umidade) VALUES ($humid)";

if (!$connect->query($sql)){
	die("Erro na gravação dos dados no BD");
}
$connect->close();

?>
