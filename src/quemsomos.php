<?php
session_start();
include("../config/config.php");

if(isset($_SESSION['logado']) && $_SESSION['logado'] == true){
    $header = file_get_contents("../" . $telaHeader);
    $header = str_replace("#nome", $_SESSION['login'], $header);
    $body = file_get_contents("../" . $telaQsomos);

    echo $header . $body;
}else{
    header("Location: ../index.php");
}
?>