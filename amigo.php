<?php 
    
    require 'conexaobd.php';
    require 'Classes/Amigo.php';

    session_start();

    $ac = $_POST['delete'] ?? $_POST['edit'] ?? null;
    $id_amg = $_GET['amg'] ?? null;
    $aviso = [];

    if(!isset($_SESSION['logged'])){
        header("location: entrar.php");
    } 

    //deletar ou editar amigo
    try {
        if(!is_null($ac)){

                $nm = $_POST['nomeAmg'] ?? $listaAmg['nm_amigo'];
                $email = $_POST['emailAmg'] ?? $listaAmg['cd_email_amigo'];
                $tel = $_POST['telfAmg'] ?? $listaAmg['cd_telefone'];
                $amigo = new Amigo($nm, $email, $tel);

            if($ac == "Editar"){
                $amigo->editarAmigo($id_amg);
            }
            else{
                $amigo->deletarAmigo($id_amg);
            }
        }
        
    } catch (Throwable $e) {
        $aviso[] = "Erro realizar operação. Erro: " . $e->getMessage();
    } 


    //exibir amigo para edicao
    
    
    try {
        if(!is_null($id_amg)){

            $select = "SELECT * FROM Amigo WHERE cd_amigo = :id_amg and fk_Usuario_amigo = :id_user LIMIT 1;";

            $cmd = $conexao->prepare($select);

            $cmd->bindParam(":id_amg", $id_amg);
            $cmd->bindParam(":id_user", $_SESSION['id_user']);

            $listaAmg = $cmd->execute();

            $listaAmg = $cmd->fetch();

            if(!$listaAmg){
                header("location: index.php");
            }

            $amigo = new Amigo($listaAmg['nm_amigo'], $listaAmg['cd_email_amigo'], $listaAmg['cd_telefone']);
        }
        else{
            header("location: index.php");
        }
        
    } catch (Throwable $e) {
        $aviso[] = "Erro ao exibir dados. Error: " . $e->getMessage();
    }


    ?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="theme-color" content="#007bff">
	<meta name="Description" content="Gerenciador de emprestimos para coisas/item aos seus amigos.">
	<title>Meus Emprestimo - <?=$amigo->nome?></title>
	<!--importar bootstrap, js, jquery, font awesome-->
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	<link rel="stylesheet" type="text/css" href="css/mainIndex.css">
	<link rel="icon" type="type/png" href="imagens/emprestimos16.png" sizes="16x16">
	<link rel="icon" type="type/png" href="imagens/emprestimos32.png" sizes="32x32">
	<link rel="icon" type="type/png" href="imagens/emprestimos96.png" sizes="96x96">
	<link rel="apple-touch-icon" type="type/png" href="imagens/emprestimos180.png" sizes="180x180">
</head>
<body>
    <div class="container container-fluid">
            <div class="row cabecalho">
                    <h1 class="col-md-12 text-center">
                        <a href="index.php">
                            <img src="imagens/emprestimos180.png" alt="logo" title="Meus Emprestimos" width="140" height="140">
                        </a>
                        <div class="row justify-content-center">
                            <a class="fa fa-cog icone" aria-hidden="true" title="Configurações da conta" href="conta.php"></a>
                            <a class="fa fa-book icone" aria-hidden="true" title="Documentação" href="documentacao.html"></a>
                            <a class="fa fa-sign-out icone" aria-hidden="true" title="Sair" href="logout.php"></a>
                        </div>
                    </h1>
                    <hr>
                </div>
        <div class="row section">
            <?php
            if(!is_null($aviso)){
                foreach ($aviso as $a):
                    ?>
                    <p class='text-danger font-weight-bold'><?=$a?></p><br>

                    <?php 
                endforeach;
             
            }
            ?>
            <form method="post" class="col-md-12">
                    <label for="nomeAmg" class="h3">Nome:</label>
					<input type="text" name="nomeAmg" id="nomeAmg" class="form-control" value="<?=$amigo->nome?>">
                    <label for="emailAmg" class="h3">Email:</label>
                    <input type="text" name="emailAmg" id="emailAmg" class="form-control" value="<?=$amigo->email?>">
                    <label for="telfAmg" class="h3">Telefone:</label>
					<input type="text" name="telfAmg" id="telfAmg" class="form-control" value="<?=$amigo->telefone?>">
                    <input type="submit" value="Editar" name="edit" class="col btn btn-warning btn-md mt-3 mb-3 font-weight-bold">
                    <input type="submit" value="Deletar amigo" name="delete" class="col btn btn-danger btn-md mb-3 font-weight-bold">
            </form>
        </div>
    </div>
</body>
<script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
</html>