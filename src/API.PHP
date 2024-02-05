<?php
session_start();
include("../config/config.php");

$nome = $_POST["firstName"];
$sobrenome = $_POST["lastName"];
$cep = $_POST["cepNumber"];

$url = "https://viacep.com.br/ws/{$cep}/json/";

$ch = curl_init($url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
$response = curl_exec($ch);

if($response == false) {
    $error = "Falha na requisição.";
}else{
    $dados = json_decode($response, true);

    if(isset($dados["erro"])) {
        $error = "Cep não encontrado";
    }else{
        $logradouro = $dados["logradouro"];
        $bairro = $dados["bairro"];
        $cidade = $dados["localidade"];
        $uf = $dados["uf"];
    }
}

curl_close($ch);

if(isset($_SESSION['logado']) && $_SESSION['logado'] == true){
    $header = file_get_contents("../" . $telaHeader);
    $header = str_replace("#nome", $_SESSION['login'], $header);
    $tela = file_get_contents("../" . $telaCliente);
    if(!isset($dados["erro"])){
        $tela = str_replace("#name", $nome, $tela);
        $tela = str_replace("#user", $sobrenome , $tela);
        $tela = str_replace("#cep", $cep , $tela);
        $tela = str_replace("#rua", $logradouro , $tela);
        $tela = str_replace("#bairro", $bairro, $tela);
        $tela = str_replace("#cidade", $cidade, $tela);
        $tela = str_replace("#uf", $uf, $tela);
    }else{
        $tela = str_replace("#name", $nome, $tela);
        $tela = str_replace("#user", $sobrenome , $tela);
        $tela = str_replace("#cep", $error, $tela);
        $tela = str_replace("#rua", "" , $tela);
        $tela = str_replace("#bairro", "", $tela);
        $tela = str_replace("#cidade", "", $tela);
        $tela = str_replace("#uf", "", $tela);
    }
    echo $header . $tela;
}else{
    header("Location: ../index.php");
}

?>