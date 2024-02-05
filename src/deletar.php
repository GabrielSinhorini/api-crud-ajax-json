<?php
session_start();
include("../config/config.php");
include("crud.php");

$jsonDados = file_get_contents($dadosJson); 
$jsonDados = json_decode($jsonDados, true);

if(isset($_SESSION['logado']) && $_SESSION['logado'] == true){
    $userId = $_REQUEST['id'];
    $user = getUserId($userId, $jsonDados);
    
    deleteUser($userId, $arquivo);
    header("Location: funcionarios.php");
}else{
    header("Location: ../index.php");
}

?>
