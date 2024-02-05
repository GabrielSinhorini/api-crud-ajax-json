<?php
session_start();
include("../config/config.php");

$jsonDados = file_get_contents($dadosJson); 
$jsonDados = json_decode($jsonDados, true);

if(isset($_SESSION['logado']) && $_SESSION['logado'] == true){
    $header = file_get_contents("../" . $telaHeader);
    $cad = file_get_contents("../" . $telaFunc);
    $header = str_replace("#nome", $_SESSION['login'], $header);
    foreach($jsonDados as $funcionario){
        if($funcionario['id'] != 0){
            $cad = $cad . '
            <tr>' . '<td scope="row">' . $funcionario["id"] . '</td>' . 
            '<td>' . $funcionario["nome"] . '</td>' . 
            '<td>' . $funcionario["user"] . '</td>' . 
            '<td>' . $funcionario["email"] . '</td>' . 
            '<td>' . $funcionario["cpf"] . '</td>' .
            '<td>' . $funcionario["sexo"] . '</td>' .
            '<td>' . '<a href="editar.php?id=' . $funcionario["id"] . '"type="button" class="editar">Editar</a>' . '</td>' .
            '<td>' . '<a href="deletar.php?id=' . $funcionario["id"] . '"type="button" class="excluir" >Excluir</a>' . '</td>';   
        }
     
    }
    $cad = $cad . '</tbody></table></div></div>';
    echo $header . $cad;
    exit();
}else{
    header("Location: ../index.php");
}
?>