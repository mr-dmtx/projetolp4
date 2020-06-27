<?php 
	
	class Usuario
	{
		private $email;
		private $senha;
		
		public function __set(string $email, string $senha)
		{
			$this->email = $email;
			$this->senha = $senha;
		}
		public function __get($atb)
		{
			return $this->$atb;
		}

		public function cadastrarConta(string $email, string $senha)
		{
			require 'conexaobd.php';

			$select = "SELECT * FROM Usuario WHERE cd_email = :email";

			$cmd = $conexao->prepare($select);

			$cmd->bindParam(':email', $email);

			$v = $cmd->execute();

			$v = $cmd->fetch();

			
			if(!$v){//senao tiver nenhum email igual cadastra o usuario

				$insert = "INSERT INTO Usuario(cd_email, cd_senha) VALUES (:email, :senha)";

				$cmd = $conexao->prepare($insert);

				$cmd->bindParam(':email', $email);
				$cmd->bindParam(':senha', $senha);

				$v = $cmd->execute();

				if($v){
					$this->email = $email;
					$this->senha = $senha;
					return true;
				}
				else{
					return false;
				}
			}
			return false;
			var_dump($v);
		}

		public function editarConta($email, $senha) : bool
		{	
			require 'conexaobd.php';
			$etin = array(pdo::ATTR_ERRMODE => pdo::ERRMODE_EXCEPTION);
			$v = null;

			if($email != $_SESSION['email']){
					$select = "SELECT * FROM Usuario WHERE cd_email = :email";

				    $cmd = $conexao->prepare($select);

				    $cmd->bindParam(":email", $email);

				    $v = $cmd->execute();
				    $v = $cmd->fetch();
				}

			if(!$v){

				$edit = "UPDATE Usuario SET cd_email = :email_n, cd_senha = :senha WHERE cd_email = :email_a;";
				
				$cmd = $conexao->prepare($edit);
				$cmd->bindParam(":email_n", $email);
				$cmd->bindParam(":senha", $senha);
				$cmd->bindParam(":email_a", $_SESSION['email']);
				$v = $cmd->execute();
				$_SESSION['email'] = $email;
				$_SESSION['senha'] = $senha;
				$this->email = $email;
				$this->senha = $senha;
				return true;
			}
			else{
				return false;
			}
		}
		public function deletarConta()
		{
			require "conexaobd.php";
			//deletar os emprestimos
			$delete = "DELETE FROM Emprestimo WHERE fk_Usuario = :id";
			$cmd = $conexao->prepare($delete);
			$cmd->bindParam(":id", $_SESSION['id_user']);
			$v = $cmd->execute();
			//deletar amigos
			$delete = "DELETE FROM Amigo WHERE fk_Usuario = :id";
			$cmd = $conexao->prepare($delete);
			$cmd->bindParam(":id", $_SESSION['id_user']);
			$v = $cmd->execute();
			//deletar conta :(
			$delete = "DELETE FROM Usuario WHERE cd_usuario = :id";
			$cmd = $conexao->prepare($delete);
			$cmd->bindParam(":id", $_SESSION['id_user']);
			$v = $cmd->execute();

			header("location: logout.php");
		}

		public function login(string $email, string $senha) : bool
		{
			require 'conexaobd.php';

				$select = "SELECT * FROM Usuario WHERE cd_email = :email AND cd_senha = :senha LIMIT 1;";

				$cmd = $conexao->prepare($select);

				$cmd->bindParam(':email', $email);
				$cmd->bindParam(':senha', $senha);

				$v = $cmd->execute();
				
				$v = $cmd->fetch();

				if($v){
					$_SESSION['id_user'] = $v['cd_usuario'];
					$this->email = $email;
					$this->senha = $senha;
					return true;
				}
				else{
					return false;
				}
						


		}
	}

 ?>