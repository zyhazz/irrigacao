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

$sql = "update configurations as c set c.min = :min, c.max = :max, c.interval = :interval";

$stmt = $PDO->prepare( $sql );
$stmt->bindParam( ':min', $config->min );
$stmt->bindParam( ':max', $config->max );
$stmt->bindParam( ':interval', $config->limite );

$result = $stmt->execute();

if ( ! $result ){
    var_dump( $stmt->errorInfo() );
    exit;
}else{
	echo json_encode(array('status' => 'ok'));
}
//$result=mysql_query("UPDATE table_setup SET min = ".$config->min.", max = ".$config->min." WHERE id='1';");

//echo "Configurações Alteradas!";
/*
$sql = "SELECT * FROM configurations";
$result = $PDO->query( $sql );
$config = $result->fetch();

print_r( $config );
*/

?>