<?php
session_start();
include("../config/config.php");
include("crud.php");

$jsonDados = file_get_contents($dadosJson); 
$jsonDados = json_decode($jsonDados, true);

if(isset($_SESSION['logado']) && $_SESSION['logado'] == true){
    $header = file_get_contents("../" . $telaHeader);
    $cad = file_get_contents("../" . $telaCad);
    $cad = limpaForm($cad);
    $header = str_replace("#nome", $_SESSION['login'], $header);
    if($_SERVER['REQUEST_METHOD'] == "POST"){
        createUser($_POST);
        header("Location: ../src/funcionarios.php");
        exit();
    }
}else{
    header("Location: ../index.php");
}

echo $header . $cad;

?>
