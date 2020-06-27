<?php 
    require 'conexaobd.php';
    require 'functions.php';
    require 'Classes/Emprestimo.php';
    session_start();
    
    $idEmp = $_GET['id'] ?? null;
    $erro = [];
    $confirmacao = null;
    $status = "";
    if(!isset($_SESSION['logged'])){
        header("location: entrar.php");
    }

    if(is_null($_GET['id'])){
        header("location: index.php");   
    }

    $acao = $_POST['act'] ?? null;


    if(!is_null($acao)){
        $item = $_POST['itemEmp'] ?? $v['nm_item'];
        $dataEmp = $_POST['dataEmp'] ?? $v['dt_emprestimo'];
        $amg = $_POST['amigo'] ?? $v['fk_Amigo'];
        $dataDev = $_POST['dataDev'] ?? $v['dt_devolucao'];
        $emp = new Emprestimo($item, $dataEmp, $dataDev, $amg);

        if($item != "" && !is_null($item)){
            if($acao == "Editar"){
                try {

                   $emp->editarEmprestimo($_GET['id']);
                    
                } catch (Throwable $e) {
                    $erro[] = "Erro ao editar emprestimo. Erro: " . $e->getMessage();
                }
                
            }
        }
        else{
            try {
                $emp = new Emprestimo();

                $emp->deletarEmprestimo($_GET['id']);

            } catch (Throwable $e) {
                $erro[] = "Erro ao deletar emprestimo. Erro: " . $e->getMessage();
            }
        }
         
    }
    

    try {  
        $select = "SELECT * FROM Amigo WHERE fk_Usuario_amigo = :id_user";

        $cmd = $conexao->prepare($select);

        $cmd->bindParam(":id_user", $_SESSION['id_user']);

        $amgs = $cmd->execute();

        $amgs = $cmd->fetchAll();
        
    } catch (Throwable $e) {
        $erro[] = "Erro ao exibir dados. Erro: " . $e->getMessage();
    }

    try {
        
        $select = "SELECT * FROM Emprestimo WHERE cd_emprestimo = :id_emp";

        $cmd = $conexao->prepare($select);

        $cmd->bindParam(":id_emp", $_GET['id']);

        $v = $cmd->execute();
        $v = $cmd->fetch();

        $emp = new Emprestimo($v['nm_item'], $v['dt_emprestimo'], $v['dt_devolucao'], $v['fk_Amigo']);

        if(defineDate($v['dt_emprestimo'], $v['dt_devolucao']) == 1){
            $status = "<span class='badge badge-primary'>Falta alguns dias</span><br>";
        }
        else if(defineDate($v['dt_emprestimo'], $v['dt_devolucao']) == 2){
            $status = "<span class='badge badge-warning'>Hoje é o dia da devolução</span><br>";
        }
        else if(defineDate($v['dt_emprestimo'], $v['dt_devolucao']) == 3){
            $status = "<span class='badge badge-danger'>Atrasado</span><br>";
        }
        else if(defineDate($v['dt_emprestimo'], $v['dt_devolucao']) == 4){
            $status = "<span class='badge badge-success'>Sem data de devolução</span><br>";
        }
        

        if(!$v){
            header("location: index.php");
        }


    } catch (Throwable $e) {
        $erro[] = "Erro ao exibir dados. Erro: " . $e->getMessage();
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
	<title>Meus Emprestimo - Emprestimo</title>
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
                            <a class="fa fa-sign-out icone" aria-hidden="true" title="Sair" href="entrar.php"></a>
                        </div>
                    </h1>
                    <hr>
                </div>
        <div class="row section">
            <form action="#" method="POST" class="col-md-12">
                    <label for="itemEmp" class="h3">Item:</label>
                    <input type="text" name="itemEmp" id="itemEmp" class="form-control" value="<?=$v['nm_item']?>">
                    <?=$status?>
					<label for="dataEmp" class="h3">Data de emprestimo:</label>
					<input type="date" name="dataEmp" id="dataEmp" class="form-control" value="<?=$v['dt_emprestimo']?>">
					<label for="nome" class="h3">Amigo:</label>
					<select name="amigo" id="amigo" class="form-control">
                        <?php
                            foreach ($amgs as $amg){
                                if($amg["cd_amigo"] == $v["fk_Amigo"]){
                                    echo "<option value='".$amg["cd_amigo"]."' selected>".$amg['nm_amigo']."</option>";
                                }
                                else{
                                    echo "<option value='".$amg["cd_amigo"]."'>".$amg['nm_amigo']."</option>";   
                                }
                            }
                        
                        ?>
					</select>
					<label for="dataDev" class="h3">Data de devolução:</label>
                    <input type="date" name="dataDev" id="dataDev" class="form-control" value="<?=$v['dt_devolucao']?>">
                    <input type="submit" name="act" value="Editar" class="col btn btn-warning btn-md mt-3 mb-3 font-weight-bold">
                    <input type="button" name="act" value="O item foi devolvido" class="col btn btn-success btn-md mb-3 font-weight-bold">
                    <input type="button" name="act" value="Deletar item" class="col btn btn-danger btn-md mb-3 font-weight-bold">
            </form>
        </div>
    </div>
</body>
<script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
</html>