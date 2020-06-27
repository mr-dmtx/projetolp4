<?php 
    session_start();
    if(isset($_SESSION['logged'])){
        header("location: index.php");
    }
    require 'Classes/Usuario.php';

    $aviso = null;
    $confirmacao = null;
    $sgp = $_POST['registrar'] ?? null;
    if(!is_null($sgp)){
        $email = $_POST['email'] ?? null;
        $senha = md5($_POST['senha']) ?? null;
        $senha2 = md5($_POST['resenha']) ?? null;
        if(!is_null($senha) and !is_null($senha2) and !is_null($email)){
            if($senha === $senha2){
                $user = new Usuario();
                if($user->cadastrarConta($email, $senha)){

                    $_SESSION['logged'] = true;
                    $_SESSION['email'] = $user->email;
                    $_SESSION['senha'] = $user->senha;

                    if($user->login($_SESSION['email'], $_SESSION['senha'])){
                        header("location: index.php");    
                    }
                }
                else{
                    $aviso .= "*Esse email já esta em uso<br>";
                }
            }
            else{
                $aviso .= "*As senhas precisam ser iguais<br>";
            }
        }
        else{
            $aviso .= "*Preencha os campos corretamente<br>";
        }
    }



 ?>
<!DOCTYPE html>
<html lang="pt-BR">

<head>
	<meta charset="utf-8">
	<meta http-equiv='X-UA-Compatible' content='IE=edge'>
	<meta name='viewport' content='width=device-width, initial-scale=1'>
	<meta name="theme-color" content="#007bff">
	<meta name="Description" content="Gerencia de emprestimos para coisas/item aos seus amigos.">
	<title>Meus Emprestimo - Cadastrar-se</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <link rel='stylesheet' type='text/css' media='screen' href='css/mainIndex.css'>
	<link rel="icon" type="type/png" href="imagens/emprestimos16.png" sizes="16x16">
	<link rel="icon" type="type/png" href="imagens/emprestimos32.png" sizes="32x32">
	<link rel="icon" type="type/png" href="imagens/emprestimos96.png" sizes="96x96">
	<link rel="apple-touch-icon" type="type/png" href="imagens/emprestimos180.png" sizes="180x180">
</head>

<body>
        <div class="container container-fluid">
                <div class="row cabecalho">
                        <h1 class="col-md-12 text-center">
                            <a href="entrar.php">
                            <img src="imagens/emprestimos180.png" alt="logo" title="Meus Emprestimos">
                        </a>
                        </h1>
                        <hr>
                    </div>
            <div class="row">
                    <form method="post" class="col-lg-4 m-auto">
                        <div class="row justify-content-center">
                            <h1 class="h3 mb-3 font-weight-light">Criar conta</h1>
                        </div>
                        <label for="email" class="sr-only">Email</label>
                        <input type="email" id="email" name="email" class="form-control mb-2" placeholder="Endereço de email" maxlength="45" required autofocus>
                        <label for="senha" class="sr-only">Senha</label>
                        <input type="password" id="senha" name="senha" class="form-control mb-2" placeholder="Senha" required>
                        <label for="resenha" class="sr-only">Confirmar Senha</label>
                        <input type="password" id="resenha" name="resenha" class="form-control mb-2" placeholder="Confirmar Senha" required>
                        <?php if(!is_null($aviso)): ?>
                            <p class="mb-3 text-danger font-weight-bold text-center"><?=$aviso?></p>
                        <?php endif; ?>
                        <?php if(!is_null($confirmacao)): ?>
                            <p class="mb-3 text-success font-weight-bold text-center"><?=$confirmacao?></p>
                        <?php
                            endif;
                        ?>
                        <button class="btn btn-lg btn-primary btn-block mt-2 font-weight-bold" type="submit" name="registrar" value="submit">Criar conta</button>
                        <a href="entrar.php" class="btn btn-lg btn-primary btn-block font-weight-bold">Voltar</a>
                    </form>
            </div>
        </div>
</body>

</html>