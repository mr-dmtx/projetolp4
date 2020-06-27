<?php 
	
	class Emprestimo
	{
		private $nome;
		private $dataEmprestimo;
		private $dataDevolucao;
		private $amigo;
		
		function __construct(string $nome, string $dataEmprestimo, string $dataDevolucao, string $amigo)
		{
			$this->nome = $nome;
			$this->dataEmprestimo = $dataEmprestimo;
			$this->dataDevolucao = $dataDevolucao;
			$this->amigo = $amigo;
		}

		function __get($atb){
			return $this->$atb;
		}

		public function cadastrarEmprestimo()
		{
			require 'conexaobd.php';

			$insert = "INSERT INTO Emprestimo(nm_item, dt_emprestimo, dt_devolucao, fk_Usuario_emprestimo, fk_Amigo)
						VALUES (:item, :dtemp, :dtdev, :user, :amg)";

			$cmd = $conexao->prepare($insert);

			$cmd->bindParam(":item", $this->nome);
			$cmd->bindParam(":dtemp", $this->dataEmprestimo);
			$cmd->bindParam(":dtdev", $this->dataDevolucao);
			$cmd->bindParam(":user", $_SESSION['id_user']);
			$cmd->bindParam(":amg", $this->amigo);

			$v = $cmd->execute();
		}

		public function editarEmprestimo(string $id)
		{
			require 'conexaobd.php';
			$edit = "UPDATE Emprestimo SET nm_item = :item, dt_emprestimo = :dataemp, dt_devolucao = :datadev, fk_Amigo = :amg WHERE cd_emprestimo = :id_emp";
            $cmd = $conexao->prepare($edit);

            $cmd->bindParam(":item", $this->nome);
            $cmd->bindParam(":dataemp", $this->dataEmprestimo);
            $cmd->bindParam("datadev", $this->dataDevolucao);
            $cmd->bindParam(":amg", $this->amigo);
            $cmd->bindParam(":id_emp", $id);

            $cmd->execute();
		}
		public static function deletarEmprestimo(string $id)
		{	
			require 'conexaobd.php';

			$delete = "DELETE FROM Emprestimo WHERE cd_emprestimo = :id_emp";

			$cmd = $conexao->prepare($delete);

            $cmd->bindParam(":id_emp", $id);

            $cmd->execute();
		}
	}
 ?>