<?php
	class Usuario {
		private $id;
		private $nome;
		private $qtdLancesDados = 0;

		function __construct($nome,$id = null) {
			$this->nome = $nome;
			$this->id = $id;
		}

		public function getId() {
			return $this->id;
		}

		public function getNome() {
			return $this->nome;
		}

		public function getQtdLancesDados(){
			return $this->qtdLancesDados;
		}

		public function addQtdLancesDados(){
			$this->qtdLancesDados++;
		}

	}
?>
