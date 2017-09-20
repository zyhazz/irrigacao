<?php

$valor = $_GET['valor'];

$arr = array('status' => 'ok', 'valor' => $valor, 'interval' => 1, 'threshold' => 4, 'pump' => 0);

echo json_encode($arr);