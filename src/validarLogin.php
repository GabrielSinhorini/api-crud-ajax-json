<?php
session_start();
include("../config/config.php");

$user = $_REQUEST['user'];
$password = md5($_REQUEST['password']);

$funcJson = file_get_contents($dadosJson);
$funcionarios = json_decode($funcJson, true);
$funcOk = false;
foreach($funcionarios as $funcionario){
    if($funcionario['user'] == $user){
        if($funcionario['senha'] == $password){
            $funcOk = true;
            break;
        }
    }
}

if(!$funcOk){
    $_SESSION['erro_login'] = "Credenciais incorretas";
    header("Location: ../index.php");
    exit;
}

$_SESSION['login'] = $user;
$_SESSION['logado'] = true;
$_SESSION['password'] = $password;
$_SESSION['nome'] = $funcionario['nome'];
$_SESSION['email'] = $funcionario['email'];
$_SESSION['cpf'] = $funcionario['cpf'];
header("Location: menu.php")
?>