<?php
	class Leilao {
		private $descricao;
		private $lances;

		function __construct($descricao) {
			$this->descricao = $descricao;
			$this->lances = array();
		}

	  public function dobraLance(Usuario $usuario){
			$ultimoLance = $this->getUltimoLance($usuario);
			if(!is_null($ultimoLance))
				$this->propoe(new Lance($usuario, $ultimoLance->getValor() * 2));
		}

		public function propoe(Lance $lance) {

			if(count($this->lances) == 0 || $this->podeDarLance($lance->getUsuario())){
				$lance->getUsuario()->addQtdLancesDados();
				$this->lances[] = $lance;
			}
		}

		private function getUltimoLance(Usuario $usuario){
			$ultimoLance = null;
			foreach ($this->getLances() as $lance) {
				if($lance->getUsuario() == $usuario)
					$ultimoLance = $lance;
			}
			return $ultimoLance;
		}

		private function podeDarLance($usuario){
			return $this->getUsuarioAnterior()->getNome() != $usuario->getNome() && $usuario->getQtdLancesDados() < 5;
		}

		private function getUsuarioAnterior(){
			$posicaoAnterior = count($this->lances) -1;
			return $this->getLances()[$posicaoAnterior]->getUsuario();
		}

		public function getDescricao() {
			return $this->descricao;
		}

		public function getLances() {
			return $this->lances;
		}
	}
?>
