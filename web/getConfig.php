<?php
//ini_set('display_errors', 0 );
//error_reporting(0);
include("config.php");

$json = file_get_contents('php://input');

$config = json_decode($json);

//var_dump($config);
//conectando no banco de dados mysql
$db="irrigador"; //nome do banco

try
{
    $PDO = new PDO( 'mysql:host=' . MYSQL_HOST . ';dbname=' . MYSQL_DB_NAME, MYSQL_USER, MYSQL_PASSWORD );
    $PDO->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ); 
}
catch ( PDOException $e )
{
    echo 'Erro ao conectar com o MySQL: ' . $e->getMessage();
}

$sql = "SELECT * FROM configurations";
$result = $PDO->query( $sql );
$config = $result->fetch();

 //print_r( $config );
echo json_encode($config);

?>