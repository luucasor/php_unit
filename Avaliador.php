<?php

  require_once("Leilao.php");
  require_once("Lance.php");

  class Avaliador
  {
    private $menorValor = INF;
    private $maiorValor = -INF;
    private $media = 0;

    function __construct()
    {

    }

    public function avalia(Leilao $leilao){
      $total = 0;
      foreach ($leilao->getLances() as $lance) {
        if($lance->getValor() > $this->maiorValor){
            $this->maiorValor = $lance->getValor();
        }
        if ($lance->getValor() < $this->menorValor) {
            $this->menorValor = $lance->getValor();
        }
        $total += $lance->getValor();
      }
      $this->media = $total / count($leilao->getLances());
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
