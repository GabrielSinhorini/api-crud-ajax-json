<?php
session_start();
include("../config/config.php");
include("crud.php");

if(isset($_SESSION['logado']) && $_SESSION['logado'] == true){
    $header = file_get_contents("../" . $telaHeader);
    $header = str_replace("#nome", $_SESSION['login'], $header);
    $tela = file_get_contents("../" . $telaCliente);
    $tela = limpaForm($tela);
    if($_SERVER['REQUEST_METHOD'] == "POST"){
        $firstName = $_POST["firstName"];
        $lastName = $_POST["lastName"];
        $cep = $_POST["cepNumber"];
        $street = $_POST["street"];
        $number = $_POST["number"];
        $neighborhood = $_POST["neighborhood"];
        $city = $_POST["city"];
        $uf = $_POST["uf"];

        $novoCliente = array(
            "firstName" => $firstName,
            "lastName" => $lastName,
            "saleCep" => $cep,
            "street" => $street,
            "number" => $number,
            "neighborhood" => $neighborhood,
            "city" => $city,
            "uf" => $uf
        );

        $arquivo = $clientesJson;

        if(file_exists($arquivo)){
            $dados = file_get_contents($arquivo);
            $dadosClientes = json_decode($dados, true);
            $dadosClientes[] = $novoCliente;
            $jsonClientes = json_encode($dadosClientes);

            file_put_contents($arquivo, $jsonClientes);
        }else{
            $dadosClientes = array($novoCliente);
            $jsonClientes = json_encode($dadosClientes);
            file_put_contents($arquivo, $jsonClientes);
        }
    }
    echo $header . $tela;
}else{
    header("Location: ../index.php");
}

?>