<?php
session_start();
include("../config/config.php");
include("crud.php");

$jsonDados = file_get_contents($dadosJson); 
$jsonDados = json_decode($jsonDados, true);

if(isset($_SESSION['logado']) && $_SESSION['logado'] == true){
    $header = file_get_contents("../" . $telaHeader);
    $header = str_replace("#nome", $_SESSION['login'], $header);
    $body = file_get_contents("../" . $telaAlt);

    if($_SERVER['REQUEST_METHOD'] == "POST"){
        $oldPass = md5($_POST['oldpass']);
        $newPass = md5($_POST['newpass']);
        $newPass2 = md5($_POST['newpass2']);
        
        if($oldPass == $_SESSION['password']){
            salvarSenha($_SESSION['login'], $body, $newPass);
        }else{
            $body = str_replace("visibility: visible", "border: 1px solid red", $body);
        }
    }

    echo $header . $body;
}else{
    header("Location: ../index.php");
}
?>