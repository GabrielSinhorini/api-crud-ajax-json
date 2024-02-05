<?php
session_start();
include("config/config.php");

$tela = file_get_contents($telaLogin);

if (isset($_SESSION['erro_login'])) {
    $tela = str_replace("ENTRAR", "Credenciais Incorretas", $tela);
    unset($_SESSION['erro_login']);
}

echo $tela;
?>
