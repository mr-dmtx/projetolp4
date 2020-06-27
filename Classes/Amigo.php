<?php 
	
	class Amigo
	{
		private $nome;
		private $email;
		private $telefone;
		
		public function __construct(string $nome, string $email, string $telefone)
		{
			$this->nome = $nome;
			$this->email = $email;
			$this->telefone = $telefone;
		}

		public function __get($atb)
		{
			return $this->$atb;	
		}

		public function cadastrarAmigo() : void
		{		
				require 'conexaobd.php';

				$insert = "INSERT INTO Amigo(nm_amigo, cd_email_amigo, cd_telefone, fk_Usuario_amigo) VALUES (:name, :cd_email, :cd_telf, :id_user);";

				$cmd = $conexao->prepare($insert);

				$cmd->bindParam(":name", $this->nome);
				$cmd->bindParam(":cd_email", $this->email);
				$cmd->bindParam(":cd_telf", $this->telefone);
				$cmd->bindParam(":id_user", $_SESSION["id_user"]);

				$add = $cmd->execute();

		}

		public function editarAmigo(int $id_amg) 
		{

			require 'conexaobd.php';

			$edit = "UPDATE Amigo SET nm_amigo = '$this->nome', cd_email_amigo = '$this->email', cd_telefone = '$this->telefone' WHERE cd_amigo = $id_amg";

			$cmd = $conexao->exec($edit);
				
			
		}
		public function deletarAmigo(int $id_amg)
		{
			require 'conexaobd.php';
			
			$delete = "DELETE FROM Amigo WHERE cd_amigo = $id_amg";

			$cmd = $conexao->exec($delete);
		}
	}
	
