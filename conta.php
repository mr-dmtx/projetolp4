<?php 
    
    require 'conexaobd.php';
    require 'Classes/Usuario.php';
    session_start();
    
    //$user = new Usuario($listaUser['cd_email'], $listaUser['cd_senha']);
    $aviso = null;
    $confirmacao = null;
    $ac = $_POST['delete'] ?? $_POST['edit'] ?? null;
    $user = new Usuario();

    if(!isset($_SESSION['logged'])){
        header("location: entrar.php");
    }

    //exibir conta para edicao
    //$user = new Usuario();

    try {        
        if(!is_null($ac)){

            $email = $_POST['emailAcc'] ?? null;

            $senha = md5($_POST['senhaAcc']) ?? null;

            $senhaN1 = md5($_POST['novaSenhaAcc']) ?? null;

            $senhaN2 = md5($_POST['novaSenhaAcc2']) ?? null;

            //echo $senha;

            if(!is_null($email)){
                if($senha == $_SESSION['senha']){
                    if($ac == "Editar"){
                        if($senhaN1 == $senhaN2){
                            if($user->editarConta($email, $senhaN1)){
                                $confirmacao = "Alteração realizada com sucesso!";
                            }
                            else{
                                $aviso = "O email já esta em uso.";
                            }
                        }
                        else{
                            $aviso = "Confirme a nova senha!";
                        }
                    }
                    else{
                        $user->deletarConta();
                    }
                    
                }
                else{
                    $aviso = "Senha incorreta!<br>";
                }
            }
            else{
                $aviso = "Digite o email!<br>";
            }

        }
        
    } catch (Throwable $e) {
            $aviso .= "Erro ao realizar operação: " . $e->getMessage();
    } catch(Exeception $e){
            $aviso .= $e->getMessage();
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
	<title>Meus Emprestimo - Minha Conta</title>
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
            <form action="" method="post" class="col-md-12 form-group">
                    <label for="emailAcc" class="h3">Email:</label>
					<input type="text" name="emailAcc" id="emailAcc" value="<?=$_SESSION['email']?>" class="form-control">
					<label for="senhaAcc" class="h3">Senha atual:</label>
                    <input type="password" name="senhaAcc" id="senhaAcc" class="form-control">
                    <label for="novaSenhaAcc" class="h3">Nova senha:</label>
                    <input type="password" name="novaSenhaAcc" id="novaSenhaAcc" class="form-control">
                    <label for="novaSenhaAcc2" class="h3">Repita a nova senha:</label>
                    <input type="password" name="novaSenhaAcc2" id="novaSenhaAcc2" class="form-control">
                    <?php if(!is_null($aviso)): ?>
                        <p class="mt-3 text-danger font-weight-bold text-center"><?=$aviso?></p>
                    <?php endif; ?>
                    <?php if(!is_null($confirmacao)): ?>
                        <p class="mt-3 text-success font-weight-bold text-center"><?=$confirmacao?></p>
                    <?php endif; ?>
                    <input type="submit" value="Editar" name="edit" class="col btn btn-warning btn-lg mt-3 mb-3 font-weight-bold">
                    <input type="submit" value="Deletar contar" name="delete" class="col btn btn-danger btn-lg mb-3 font-weight-bold">
            </form>
        </div>
    </div>
</body>
<script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
</html>
