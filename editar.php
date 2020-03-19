<?php

    require 'conexao.php'; //Chamando o arquivo de conexão

    $id = 0;

    //Esse IF verifica se existe alguma variável 'id' configurada no GET (na url do navegador)
    if(isset($_GET['id']) && empty($_GET['id']) == false)
    {
        $id = addslashes($_GET['id']); //Passando o ID que veio do GET para a variável

        //Esse SELECT pega o registro na tabela usuarios que tem aquele ID que veio pelo GET (esses dados que preencherão o formulário de edição)
        $sql = "SELECT * FROM usuarios WHERE id = :id"; 
        $sql = $pdo->prepare($sql); //Prepara a query
        $sql->bindValue(":id",  $id); //Passa para a query o valor que está na variável
        $sql->execute(); //Executa a query
        
        //Verificando se foi retornado algum registro da consulta do Select que foi feito acima
        if($sql->rowCount() > 0)
        {
            $dado = $sql->fetch();

        }
        else
        {
            //Redirecionando para a página do Index
            header("Location: index.php");
        }
    }
    else
    {
         //Redirecionando para a página do Index
        header("Location: index.php");

    }


     //Esse IF verifica se existe alguma variável 'nome' configurada no POST (Essas variáveis do POST são configuradas quando nós enviamos (submitamos) o formulário de edição)
    if(isset($_POST['nome']) && empty($_POST['nome']) == false)
    {
        $nome = addslashes($_POST['nome']); //Passa o valor vindo do POST do formulário para a variável
        $email = addslashes($_POST['email']); //Passa o valor vindo do POST do formulário para a variável
        
        //Realiza o UPDATE, ou seja, faz a atualização dos dados da tabela com os dados vindo dos do banco de dados
        $sql = "UPDATE usuarios SET nome = :nome, email = :email WHERE id = :id";
        $sql = $pdo->prepare($sql); //Prepara a query
        $sql->bindValue(":nome",  $nome); //Passa para a query o valor que está na variável
        $sql->bindValue(":email",  $email); //Passa para a query o valor que está na variável
        $sql->bindValue(":id",  $id); //Passa para a query o valor que está na variável
        $sql->execute(); //Executa a query

        //Redireciona os para a página index
        header("Location: index.php");
    }

    
?>

<!-- Formulário de edição -->
<form method="POST"> 
    Nome:<br/>
    <input type="text" name ="nome" value="<?php echo $dado['nome']; ?>" /><br/><br/> <!-- Esses dados que são preenchidos aqui com PHP, são oriundos do SELECT do início deste arquivo -->
    E-mail:<br/>
    <input type="text" name ="email" value="<?php echo $dado['email']; ?>" /><br/><br/>   <!-- Esses dados que são preenchidos aqui com PHP, são oriundos do SELECT do início deste arquivo -->

    <input type="submit" value="Atualizar" />

</form>