<?php
session_start();
include("../config/config.php");

$jsonDados = file_get_contents($dadosJson); 
$jsonDados = json_decode($jsonDados, true);

if(isset($_SESSION['logado']) && $_SESSION['logado'] == true){
    $header = file_get_contents("../" . $telaHeader);
    $menu = file_get_contents("../" . $telaMenu);
    $header = str_replace("#nome", $_SESSION['login'], $header);
    $menu = str_replace("#nome", $_SESSION['login'], $menu);
    $menu = str_replace("#data", date('d/m/Y'), $menu);
    $menu = str_replace("#username", $_SESSION['nome'], $menu);
    $menu = str_replace("#email", $_SESSION['email'], $menu);
    $menu = str_replace("#cpf", $_SESSION['cpf'], $menu);
    echo $header . $menu;
    exit();
}else{
    header("Location: ../index.php");
}
?>