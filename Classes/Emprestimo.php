<?php 
	
	class ClassName extends AnotherClass
	{
		private $nome;
		private $dataEmprestimo;
		private $dataDevolucao;
		
		function __construct(string $nome, string $dataEmprestimo, string $dataDevolucao)
		{
			$this->nome = $nome;
			$this->dataEmprestimo = $dataEmprestimo;
			$this->dataDevolucao = $dataDevolucao;
		}

		public function cadastrarEmprestimo()
		{
			# code...
		}

		public function editarEmprestimo()
		{
			# code...
		}
		public function deletarEmprestimo()
		{
			# code...
		}
	}
 ?>