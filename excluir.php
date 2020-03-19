<?php
    require 'conexao.php';

    //Esse IF verifica se existe alguma variável 'id' configurada no GET (na url do navegador)
    if(isset($_GET['id']) && empty($_GET['id']) == false)
    {
        $id = addslashes($_GET['id']);  //Passando o ID que veio do GET para a variável

        //Query que apaga o registro que tem aquele id que veio na variável do GET
        $sql = "DELETE FROM usuarios WHERE id = :id";
        $sql = $pdo->prepare($sql); //Prepara a query
        $sql->bindValue(":id", $id); //Passa para a query o valor que está na variável
        $sql->execute(); //Executando a query
        
        //Redireciona para a página index.php
        header("Location: index.php");
    }
    else
    {   
        //Redireciona para a página index.php
         header("Location: index.php");

    }
?>
