<?php 
	
	require 'conexaobd.php';
	require 'Classes/Amigo.php';
	require 'Classes/Emprestimo.php';
	require 'functions.php';

	session_start();

	$aviso = [];

	if(!isset($_SESSION['logged'])){
		header("location: entrar.php");
	}

	//ADD AMIGO
	try {
		if(isset($_POST['addAmg'])){

			$nmAmg = $_POST['nomeAmg'] ?? null;
			$emailAmg = $_POST['emailAmg'] ?? "";
			$telAmg = $_POST['telAmg'] ?? "";

			if(!is_null($nmAmg)){

				$amg = new Amigo($nmAmg, $emailAmg, $telAmg);

				$amg->cadastrarAmigo();
			}

		}
	} catch (Throwable $e) {
		$aviso[] = "Error ao adicionar amigo. Erro: " . $e->getMessage();
		
	}
	
	try {

		//EXIBIR AMIGOS
		$select_amg = "SELECT * FROM Amigo WHERE fk_Usuario_amigo = :id_user;";

		$cmd = $conexao->prepare($select_amg);

		$cmd->bindParam(":id_user", $_SESSION['id_user']);

		$listaAmg = $cmd->execute();

		$listaAmg = $cmd->fetchAll();
		
	} catch (Throwable $e) {

		$aviso[] = "Erro ao exibir lista de amigos. Erro: " . $e->getMessage();
		
	}
	
	//ADD EMPRESTIMOS
	try {
		if(isset($_POST['addEmp'])){

			$item = $_POST['itemEmp'] ?? null;
			$dataEmp = $_POST['dataEmp'];
			$amg = $_POST['amigo'];
			$dataDev = $_POST['dataDev'] ?? "";

			if(!is_null($item) and $item != ""){
				if(strtotime($dataEmp) > strtotime($dataDev)){
					$dataDev = "";
				}
				$emp = new Emprestimo($item, $dataEmp, $dataDev, $amg);

				$emp->cadastrarEmprestimo();
			}

		}
		
	} catch (Throwable $e) {

		$aviso[] = "Erro ao salvar emprestimo. Erro: " . $e->getMessage();
		
	}

	//EXIBIR EMPRESTIMOS
	try {
		$select_emps = "SELECT * FROM Emprestimo e INNER JOIN Amigo a on e.fk_Usuario_emprestimo = :id_user and e.fk_Amigo = a.cd_amigo ORDER BY dt_devolucao";

		$cmd = $conexao->prepare($select_emps);

		$cmd->bindParam(":id_user", $_SESSION['id_user']);

		$listaEmps = $cmd->execute();

		$listaEmps = $cmd->fetchAll();

		

	} catch (Throwable $e) {
		$aviso[] = "Erro ao exibir emprestimos. Erro: " . $e->getMessage();
	}
	/**/
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
	<link rel="icon" type="type/png" href="imagens/emprestimos_s.png" sizes="32x32">
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
					<?php 

					if($listaAmg){

						foreach ($listaAmg as $amg) {
							echo "<p class='linkAmg'>
									<a href='amigo.php?amg=".$amg['cd_amigo']."'>".$amg['nm_amigo']."</a>
								</p>";		
						}

					}else{
						echo "<p class='font-weight-bold text-center'>Sem amigos</p>";
					}

					 ?>
				</div>

				<div class="col-md-10 listaEmps">
					<?php 
						if(!is_null($aviso)){
									foreach ($aviso as $a) {
										echo "<p class='text-danger font-weight-bold'>".$a."</p><br>";
									}
								}
					 ?>
						<div class="row row-cols-3">
	
							<?php 
							if(!$listaEmps){
								echo "<p class='font-weight-bold'>Você ainda não fez nenhum emprestimo.</p>";
							}
								foreach ($listaEmps as $emp){
									$situacao = defineDate($emp['dt_emprestimo'], $emp['dt_devolucao']);
									$tipe = "";
									if($situacao == 1){
											$tipe = "<div class='card bg-primary col-sm-4 card-t1' style='max-width: 18rem;' title='Falta alguns dias - ".$emp['nm_item']."'>
										<a href='emprestimo.php?id=".$emp['cd_emprestimo']."'>
											<div class='card-header'>
												<strong>Falta alguns dias</strong></div>
											<div class='card-body'>
												<h5 class='card-title'><strong>".$emp['nm_item']."</strong></h5>
												<p class='card-text'><strong>".$emp['nm_amigo']."</strong> | Email: ".$emp['cd_email_amigo']." | Telefone: ".$emp['cd_telefone']."</p>
											</div>
										</a>
									</div>";
									}
									else if($situacao == 2){
										$tipe = "<div class='card bg-warning col-sm-4 card-t1' style='max-width: 18rem;' title='Hoje é o dia da devolução - ".$emp['nm_item']."'>
										<a href='emprestimo.php?id=".$emp['cd_emprestimo']."'>
											<div class='card-header'>
												<strong>Hoje é o dia da devolução</strong></div>
											<div class='card-body'>
												<h5 class='card-title'><strong>".$emp['nm_item']."</strong></h5>
												<p class='card-text'><strong>".$emp['nm_amigo']."</strong> | Email: ".$emp['cd_email_amigo']." | Telefone: ".$emp['cd_telefone']."</p>
											</div>
										</a>
									</div>";
									}
									else if($situacao == 3){
										$tipe = "<div class='card bg-danger col-sm-4 card-t1' style='max-width: 18rem;' title='Item atrasado - ".$emp['nm_item']."'>
										<a href='emprestimo.php?id=".$emp['cd_emprestimo']."'>
											<div class='card-header'>
												<strong>Atrasado</strong></div>
											<div class='card-body'>
												<h5 class='card-title'><strong>".$emp['nm_item']."</strong></h5>
												<p class='card-text'><strong>".$emp['nm_amigo']."</strong> | Email: ".$emp['cd_email_amigo']." | Telefone: ".$emp['cd_telefone']."</p>
											</div>
										</a>
									</div>";
									}
									else if($situacao == 4){
										$tipe = "<div class='card bg-success col-sm-4 card-t1' style='max-width: 18rem;' title='Sem data de devolução - ".$emp['nm_item']."'>
										<a href='emprestimo.php?id=".$emp['cd_emprestimo']."'>
											<div class='card-header'>
												<strong>Sem data de devolução</strong></div>
											<div class='card-body'>
												<h5 class='card-title'><strong>".$emp['nm_item']."</strong></h5>
												<p class='card-text'><strong>".$emp['nm_amigo']."</strong> | Email: ".$emp['cd_email_amigo']." | Telefone: ".$emp['cd_telefone']."</p>
											</div>
										</a>
									</div>";
									}
									//var_dump(defineDate($emp['dt_emprestimo'], $emp['dt_devolucao']));
									echo $tipe;	
								}
								
					 		?>
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
			<form method="POST">
				<label for="nome">Nome:</label>
				<input type="text" name="nomeAmg" id="nomeAmg" class="form-control">
				<label for="nome">Email:</label>
				<input type="email" name="emailAmg" id="emailAmg" class="form-control">
				<label for="nome">Telefone:</label>
				<input type="text" name="telAmg" id="telAmg" class="form-control">
		</div>
		<div class="modal-footer">
		  <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
		  <button type="submit" name="addAmg" value="Adicionar" class="btn btn-primary">Adicionar</button>
		</div>
		</form>
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
						<?php 
							if($listaAmg){

								foreach ($listaAmg as $amg) {
									echo "<option value='".$amg['cd_amigo']."'>".$amg['nm_amigo']."</option>";
								}
							}
						 ?>
					</select>
					<label for="dataDev">Data de devolução:</label>
					<input type="date" name="dataDev" id="dataDev" class="form-control">
				
			</div>
			<div class="modal-footer">
			  <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
			  <button type="submit" name="addEmp" class="btn btn-primary">Adicionar</button>
			</div>
			</form>
		  </div>
		</div>
	  </div>
	  <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
</html>

