<?php 
	
	

	class Usuario
	{
		private $email;
		private $senha;
		
		public function __construct(string $email, string $senha)
		{
			$this->email = $email;
			$this->senha = $senha;
		}

		public function cadastrarConta()
		{
			require 'conexaobd.php';
			$select = "SELECT * FROM Usuario WHERE cd_email = :email";

			$cmd = $conexao->prepare($select);

			$cmd->bindParam(':email', $this->email);

			$v = $cmd->execute();

			$v = $cmd->fetch();

			if(!$v){//senao tiver nenhum email igual cadastra o usuario

				$insert = "INSERT INTO Usuario(cd_email, cd_senha) VALUES (:email, :senha)";

				$cmd = $conexao->prepare($insert);

				$cmd->bindParam(':email', $this->email);
				$cmd->bindParam(':senha', $this->senha);

				$v = $cmd->execute();

				if($v){
					return true;
				}
				else{
					return false;
				}
			}
			return false;
		}

		public function editarConta()
		{
			# code...
		}
		public function deletarConta()
		{
			# code...
		}

		public function login() : bool
		{
			require 'conexaobd.php';

			try {

				$select = "SELECT * FROM Usuario WHERE cd_email = :email AND cd_senha = :senha LIMIT 1;";

				$cmd = $conexao->prepare($select);

				$cmd->bindParam(':email', $this->email);
				$cmd->bindParam(':senha', $this->senha);

				$v = $cmd->execute();
				
				$v = $cmd->fetch();

				if($v){
					session_start();
					$_SESSION['logged'] = true;
					$_SESSION['email'] = $this->email;
					header('location:index.php');
					return true;
				}
				else{
					return false;
				}
						

			} catch (Throwable $e) {
				echo $e->getMessage();
			}

		}
	}

 ?>