<?php
include("../config/config.php");

$funcionarios = $dadosJson;

function getUser(){
    $dados = [];
    $jsonFunc = file_get_contents("../dados/funcionarios.json");
    $dados = json_decode($jsonFunc, true);

    return $dados;
}

function limpaForm($pagina){
    $pagina = str_replace("#name", "", $pagina);
    $pagina = str_replace("#user", "", $pagina);
    $pagina = str_replace("#email", "", $pagina);
    $pagina = str_replace("#cpf", "", $pagina);
    $pagina = str_replace("#cep", "", $pagina);
    $pagina = str_replace("#rua", "", $pagina);
    $pagina = str_replace("#bairro", "", $pagina);
    $pagina = str_replace("#cidade", "", $pagina);
    $pagina = str_replace("#uf", "", $pagina);
    return $pagina;
}

function editarDados($id, $pagina, $dados){
    $pagina = str_replace("#name", $dados[$id]["nome"] , $pagina);
    $pagina = str_replace("#user", $dados[$id]["user"], $pagina);
    $pagina = str_replace("#email", $dados[$id]["email"], $pagina);
    $pagina = str_replace("#cpf", $dados[$id]["cpf"], $pagina);
    return $pagina;
}

function salvarAlt($id, $pagina, $dados){
    $funcionarios = [];
    $funcionarios = getUser($dados);
    
    foreach ($funcionarios as $i => $funcionario) {
        if($funcionario['id'] == $id) {
          $funcionario["nome"]   = $dados["nome"];
          $funcionario["user"]  = $dados["user"];
          $funcionario["email"] = $dados["email"];
          $funcionario["cpf"] = $dados["cpf"];
          $funcionario["sexo"] = $dados["sexo"];
          $funcionarios[$i] = $funcionario;
          break;
        }
    }
    saveUser($funcionarios);   
}

function salvarSenha($user, $pagina, $dados){
    $funcionarios = [];
    $funcionarios = getUser($dados);

    foreach ($funcionarios as $i => $funcionario) {
        if($funcionario['user'] == $user) {
          $funcionario["senha"]   = $dados;
          
          $funcionarios[$i] = $funcionario;
          break;
        }
    }

    saveUser($funcionarios);
}

function getLastId($funcionarios){
    $dados = getUser($funcionarios);
    $id = 0;
    foreach($dados as $funcionario){
        if($funcionario["id"] > $id){
            $id = $funcionario["id"];
        }
    }

    return $id;
}

function saveUser($dados){
    $funcJson = json_encode($dados);
    file_put_contents("../dados/funcionarios.json", $funcJson);

}

function createUser($dados){
    $funcionario = getUser();
    
    $id = getLastId($dados);
    $senha = createPassword($dados["nome"], $dados["cpf"]);
    $id++;
    $novoFuncionario = [];
    $novoFuncionario["id"] = $id;
    $novoFuncionario["nome"] = $dados["nome"];
    $novoFuncionario["user"] = $dados["user"];
    $novoFuncionario["email"] = $dados["email"];
    $novoFuncionario["cpf"] = $dados["cpf"];
    $novoFuncionario["sexo"] = $dados["sexo"];
    $novoFuncionario["senha"] = $senha;

    $funcionario[] = $novoFuncionario;

    saveUser($funcionario);
}

function getUserId($id, $arquivo){
    $dados = [];
    $dados = getUser($arquivo);
    foreach($dados as $usuario){
        if($usuario["id"] == $id){
            return $usuario;
        }
    }
    $usuario = [];
    return $usuario;
}

function deleteUser($id, $dados){
    $funcionarios = [];
    $funcionarios = getUser($dados);

    foreach($funcionarios as $i => $funcionario){
        if($funcionario['id'] == $id){
            array_splice($funcionarios, $i, 1);
            break;
        }
    }
    saveUser($funcionarios);
}

function createPassword($nome, $cpf){
    $senhaNome = explode(" ", $nome);
    $primeiroNome = $senhaNome[0];

    $senhaCpf = mb_substr($cpf, 0, 3, 'UTF-8');

    $senha = md5($primeiroNome . $senhaCpf);

    return $senha;
}
?>