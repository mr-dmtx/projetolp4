<?php 
	session_start();
	if(!isset($_SESSION['logged'])){
		header("location: entrar.php");
	}
 ?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>
	<meta charset="utf-8">
	<meta http-equiv='X-UA-Compatible' content='IE=edge'>
	<meta name='viewport' content='width=device-width, initial-scale=1'>
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
				<h1 class="col-md-12 text-center"><img src="imagens/emprestimos180.png" alt="logo" title="Meus Emprestimos" width="140" height="140">
					<div class="row justify-content-center">
						<a class="fa fa-cog icone" aria-hidden="true" title="Configurações da conta" href="conta.php"></a>
						<a class="fa fa-book icone" aria-hidden="true" title="Documentação" href="documentacao.html"></a>
						<a class="fa fa-sign-out icone" aria-hidden="true" title="Sair" href="logout.php"></a>
					</div>
				</h1>
				<hr>
				<button class="btn btn-primary btn-lg col-md-5 btn-top" data-toggle="modal" data-target="#modalAddAmg">Adicionar Amigo</button>
				<button class="btn btn-primary btn-lg col-md-5 btn-top" data-toggle="modal" data-target="#modalAddEmp">Adicionar Empréstimo</button>
			</div>
			<hr/>
			<div class="row section">
				<div class="col-md-2 listaAmg">
					<h1 class="h5 text-center">Lista de amigos</h1>
					<hr>
					<p class="linkAmg"><a href="amigo.php">Mariazinha</a></p>
					<p class="linkAmg"><a href="amigo.php">Joazinho</a></p>
					<p class="linkAmg"><a href="amigo.php">Pedrinho</a></p>
				</div>
				<div class="col-md-10 listaEmps">
						<div class="row row-cols-3">
							<div class="card bg-danger col-sm-4 card-t1" style="max-width: 18rem;" title="Atrasado - Camisa do Santos"><a href="emprestimo.html">
								<div class="card-header"><strong>Atrasado</strong></div>
								<div class="card-body">
									<h5 class="card-title"><strong>Camisa do Santos</strong></h5>
									<p class="card-text"><strong>Mariazinha</strong> | Email: mari@asd.e | Telefone: 13 996423-3030</p>
								</div>
							</a></div>
							<div class="card bg-warning col-sm-4 card-t1" style="max-width: 18rem;" title="Dia da devolução - Bola de futebol"><a href="emprestimo.html">
									<div class="card-header"><strong>Hoje é o dia da devolução</strong></div>
									<div class="card-body">
										<h5 class="card-title"><strong>Bola de futebol</strong></h5>
										<p class="card-text"><strong>Joazinho</strong> | Email: joao@ss.net | Telefone: Sem telefone
										</p>
									</div>
								</a></div>
							<div class="card bg-primary col-sm-4 card-t1" style="max-width: 18rem;" title="Faltam 4 dias - Livro Harry Potter"><a href="emprestimo.html">
									<div class="card-header"><strong>Faltam 4 dias</strong></div>
									<div class="card-body">
										<h5 class="card-title"><strong>Livro Harry Potter</strong></h5>
										<p class="card-text"><strong>Zequinha</strong> | Email: zeze@asdasd.asd | Telefone: Sem
											telefone</p>
									</div>
								</a></div>
								<div class="card bg-success col-sm-4 card-t1" style="max-width: 18rem;" title="Sem data de devolução - Pen Drive"><a href="emprestimo.html">
									<div class="card-header"><strong>Sem data de devolução</strong></div>
									<div class="card-body">
										<h5 class="card-title"><strong>Pen Drive</strong></h5>
										<p class="card-text"><strong>Pedrinho</strong> | Email: ped@asdasd.asd | Telefone: 13 98573-5672</p>
									</div>
								</a></div>
								<div class="card bg-success col-sm-4 card-t1" style="max-width: 18rem;" title="Sem data de devolução - Pen Drive"><a href="emprestimo.html">
										<div class="card-header"><strong>Sem data de devolução</strong></div>
										<div class="card-body">
											<h5 class="card-title"><strong>Pen Drive</strong></h5>
											<p class="card-text"><strong>Pedrinho</strong> | Email: ped@asdasd.asd | Telefone: 13 98573-5672</p>
										</div>
									</a></div>
					  </div>
				</div>
			</div>
	</body>
	<!-- Modal Add Amigo-->
<div class="modal fade" id="modalAddAmg" tabindex="-1" role="dialog" aria-labelledby="modalAddAmg" aria-hidden="true">
	<div class="modal-dialog" role="document">
	  <div class="modal-content">
		<div class="modal-header">
		  <h5 class="modal-title font-weight-bold" id="modalAddAmg">Adicionar Amigo</h5>
		  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
			<span aria-hidden="true">&times;</span>
		  </button>
		</div>
		<div class="modal-body">
			<form action="" method="post">
				<label for="nome">Nome:</label>
				<input type="text" name="nomeAmg" id="nomeAmg" class="form-control">
				<label for="nome">Email:</label>
				<input type="email" name="emailAmg" id="emailAmg" class="form-control">
				<label for="nome">Telefone:</label>
				<input type="text" name="telAmg" id="telAmg" class="form-control">
			</form>
		</div>
		<div class="modal-footer">
		  <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
		  <button type="button" class="btn btn-primary">Adicionar</button>
		</div>
	  </div>
	</div>
  </div>
  <!-- Modal Add Emp-->
<div class="modal fade" id="modalAddEmp" tabindex="-1" role="dialog" aria-labelledby="modalAddEmp" aria-hidden="true">
		<div class="modal-dialog" role="document">
		  <div class="modal-content">
			<div class="modal-header">
			  <h5 class="modal-title font-weight-bold" id="modalAddEmp">Adicionar Empréstimo</h5>
			  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
				<span aria-hidden="true">&times;</span>
			  </button>
			</div>
			<div class="modal-body">
				<form action="" method="post">
					<label for="itemEmp">Item:</label>
					<input type="text" name="itemEmp" id="itemEmp" class="form-control">
					<label for="dataEmp">Data de emprestimo:</label>
					<input type="date" name="dataEmp" id="dataEmp" class="form-control">
					<label for="nome">Amigo:</label>
					<select name="amigo" id="amigo" class="form-control">
						<option value="0" selected>Selecionar Amigo</option>
						<option value="1">Mariazinha</option>
						<option value="2">Joãozinho</option>
						<option value="">Pedrinho</option>
					</select>
					<label for="dataDev">Data de devolução:</label>
					<input type="date" name="dataDev" id="dataDev" class="form-control">
				</form>
			</div>
			<div class="modal-footer">
			  <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
			  <button type="button" class="btn btn-primary">Adicionar</button>
			</div>
		  </div>
		</div>
	  </div>
	  <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
</html>
