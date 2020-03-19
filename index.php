<?php
require 'conexao.php';
?>

<a href="adicionar.php">Adicionar Novo Usuário</a>
<table border='0' width='100%'>
    <tr>
        <th>Nome</th>
        <th>E-mail</th>
        <th>Ações</th>
    </tr>

    <?php
        //Consulta que pega os dados de todos os usuários da tabela usuarios
        $sql = 'SELECT * FROM usuarios';
        $sql = $pdo->query($sql);

        //Verificando se foi retornado algo na query (Se foi, é preenchida [com os dados vindos do banco] nossa tabela criada no HTML)
        if($sql->rowCount() > 0)
        {   
            //Foreach que faz um Loop e vai passando os dados da consulta para as linhas da tabela
            foreach($sql->fetchAll() as $usuario)
            {
                echo '<tr>';
                    echo '<td>'.$usuario['nome'].'</td>';
                    echo '<td>'.$usuario['email'].'</td>';
                    //Abaixo, são criados dois botões que quando clicamos em um deles, somos direcionados para a página passando a variável id via GET
                    echo '<td><a href="editar.php?id='.$usuario['id'].'">Editar</a> - <a href="excluir.php?id='.$usuario['id'].'">Excluir</a></td>'; 
                echo '</tr>';
            }
        }
    ?>
</table>