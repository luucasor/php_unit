<?php

  require_once("Leilao.php");
  require_once("Lance.php");

  class Avaliador
  {
    private $menorValor = INF;
    private $maiorValor = -INF;
    private $media = 0;
    private $maiores = 0;

    function __construct()
    {

    }

    public function avalia(Leilao $leilao){
      $total = 0;
      
      if(count($leilao->getLances()) <= 0) {
        throw new Exception("Um leilão precisa ter pelo menos um lance");
      }

      foreach ($leilao->getLances() as $lance) {
        if($lance->getValor() > $this->maiorValor){
            $this->maiorValor = $lance->getValor();
        }
        if ($lance->getValor() < $this->menorValor) {
            $this->menorValor = $lance->getValor();
        }
        $total += $lance->getValor();
      }
      $this->pegaOsMaioresNo($leilao);
      $this->media = $total / count($leilao->getLances());
    }

    public function pegaOsMaioresNo(Leilao $leilao) {

          $lances = $leilao->getLances();
          usort($lances,function ($a,$b) {
              if($a->getValor() == $b->getValor()) return 0;
              return ($a->getValor() < $b->getValor()) ? 1 : -1;
          });

          $this->maiores = array_slice($lances, 0,3);
    }

    public function getTresMaiores() {
        return $this->maiores;
    }

    public function getMedia(){
      return $this->media;
    }

    public function getMaiorLance(){
      return $this->maiorValor;
    }

    public function getMenorLance(){
      return $this->menorValor;
    }
  }

 ?>
