<?php
//ini_set('display_errors', 0 );
//error_reporting(0);
error_reporting(E_ALL);
ini_set('display_errors', 1);

include("config.php");

$json = file_get_contents('php://input');

$config = json_decode($json);

//var_dump($config);
//conectando no banco de dados mysql

try
{
    $PDO = new PDO( 'mysql:host=' . MYSQL_HOST . ';dbname=' . MYSQL_DB_NAME, MYSQL_USER, MYSQL_PASSWORD );
    $PDO->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ); 
}
catch ( PDOException $e )
{
    echo 'Erro ao conectar com o MySQL: ' . $e->getMessage();
}
$status = $_GET['status'];
if ($status == "ligado") {
        $status = 1;
	//$result=mysql_query("UPDATE table_status SET status = '1' WHERE id='1';");
	//echo "Irrigador Ligado!";
}elseif ($status == "desligado") {
        $status = 0;
	//$result=mysql_query("UPDATE table_status SET status = '0' WHERE id='1';");
	//echo "Irrigador Desligado!";
}
try
{
    $sql = "update configurations as c set c.status = :status";
    $sth = $PDO->prepare($sql);
    $sth->bindParam(':status', $status, PDO::PARAM_INT);
    $result = $sth->execute();
    echo $result;
}
catch ( PDOException $e )
{
    echo 'Erro ao conectar com o MySQL: ' . $e->getMessage();
}
//$data = $result->fetchAll();
//print_r( $config );
//echo json_encode($data);

?>