<?php 
session_start();
    if(!isset($_SESSION['logged'])){
        header("location: entrar.php");
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
	<title>Meus Emprestimo</title>
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
                        <a href="index.html">
                        <img src="imagens/emprestimos180.png" alt="logo" title="Meus Emprestimos" width="140" height="140">
                    </a>
                        <div class="row justify-content-center">
                            <a class="fa fa-cog icone" aria-hidden="true" title="Configurações da conta" href="conta.php"></a>
                            <a class="fa fa-book icone" aria-hidden="true" title="Documentação" href="documentacao.html"></a>
                            <a class="fa fa-sign-out icone" aria-hidden="true" title="Sair" href="entrar.php"></a>
                        </div>
                    </h1>
                    <hr>
                </div>
        <div class="row section">
            <form action="" method="get" class="col-md-12">
                    <label for="itemEmp" class="h3">Item:</label>
                    <input type="text" name="itemEmp" id="itemEmp" class="form-control" value="Camisa do Santos">
                    <span class="badge badge-danger">Atrasado</span><br>
					<label for="dataEmp" class="h3">Data de emprestimo:</label>
					<input type="date" name="dataEmp" id="dataEmp" class="form-control" value="2020-03-10">
					<label for="nome" class="h3">Amigo:</label>
					<select name="amigo" id="amigo" class="form-control">
                            <option value="1" selected>Mariazinha</option>
                            <option value="2">Joãozinho</option>
                            <option value="3">Pedrinho</option>
					</select>
					<label for="dataDev" class="h3">Data de devolução:</label>
                    <input type="date" name="dataDev" id="dataDev" class="form-control" value="2020-03-13">
                    <input type="submit" value="Editar" class="col btn btn-warning btn-md mt-3 mb-3 font-weight-bold">
                    <input type="button" value="O item foi devolvido" class="col btn btn-success btn-md mb-3 font-weight-bold">
                    <input type="button" value="Deletar item" class="col btn btn-danger btn-md mb-3 font-weight-bold">
            </form>
        </div>
    </div>
</body>
<script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
</html>