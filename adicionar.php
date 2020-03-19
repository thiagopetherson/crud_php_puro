<?php

    require 'conexao.php';

       //Esse IF verifica se existe alguma variável 'nome' configurada no POST (Essas variáveis do POST são configuradas quando nós enviamos (submitamos) o formulário de edição)
    if(isset($_POST['nome']) && empty($_POST['nome']) == false)
    {
        $nomenovo = addslashes($_POST['nome']); //Passa o valor vindo do POST do formulário para a variável
        $emailnovo = addslashes($_POST['email']); //Passa o valor vindo do POST do formulário para a variável
        $senhanova = md5(ddslashes($_POST['senha'])); //Passa o valor vindo do POST do formulário para a variável (Esse md5 é para criptografar sua senha)

        //Aqui nós fazemos o INSERT com os dados que vieram do formulário (via POST)
        $sql = "INSERT INTO usuarios(nome,email,senha)VALUES(:nome,:email,:senha)";
        $sql = $pdo->prepare($sql); //Prepara a query
        $sql->bindValue(":nome", $nomenovo); //Passa para a query o valor que está na variável
        $sql->bindValue(":email", $emailnovo); //Passa para a query o valor que está na variável
        $sql->bindValue(":senha", $senhanova); //Passa para a query o valor que está na variável
        $sql->execute(); //Executa a query

        //Redireciona para a página index.php
        header("Location: index.php");
    }
?>

<!-- Formulário que adiciona uma novo registro na tabela -->
<form method="POST">
    Nome:<br/>
    <input type="text" name ="nome" /><br/><br/>
    E-mail:<br/>
    <input type="text" name ="email" /><br/><br/>
    Senha:<br/>
    <input type="password" name ="senha" /><br/><br/>

    <input type="submit" value="Cadastrar" />

</form>