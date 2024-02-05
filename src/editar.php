<?php
session_start();
include("../config/config.php");
include("crud.php");

$jsonDados = file_get_contents($dadosJson); 
$jsonDados = json_decode($jsonDados, true);
$id = $_REQUEST["id"];

if(isset($_SESSION['logado']) && $_SESSION['logado'] == true){
    $header = file_get_contents("../" . $telaHeader);
    $cad = file_get_contents("../" . $telaCad);
    $cad = editarDados($id, $cad, $jsonDados);
    $cad = str_replace("Cadastrar", "Salvar Alterações", $cad);
    $cad = str_replace("criar.php", "editar.php?id=" . $id . '"', $cad);
    if($_SERVER['REQUEST_METHOD'] == "POST"){
        salvarAlt($id, $cad, $_POST);
        header("Location: ../src/funcionarios.php");
        exit();
    }
    echo $header . $cad;
}else{
    header("Location: ../index.php");
}
?>