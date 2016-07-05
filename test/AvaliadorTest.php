<?php

require_once("../Avaliador.php");
require_once("../Lance.php");
require_once("../Leilao.php");
require_once("../Usuario.php");

class AvaliadorTest extends PHPUnit_Framework_TestCase{

  public function testAceitaLeilaoEmOrdemCrescente(){

    $maiorEsperado = 400;
    $menorEsperado = 250;
    $mediaEsperada = 316.66666666666669;
    $leilao = new Leilao("Playstation");


    $jonas = new Usuario("jonas",1);
    $joao  = new Usuario("joao",2);
    $jorge = new Usuario("jorge",3);

    $leilao->propoe(new Lance($jonas, 250));
    $leilao->propoe(new Lance($joao, 300));
    $leilao->propoe(new Lance($jorge, 400));


    $leiloeiro = new Avaliador();
    $leiloeiro->avalia($leilao);

    $this->assertEquals($maiorEsperado, $leiloeiro->getMaiorLance());
    $this->assertEquals($menorEsperado, $leiloeiro->getMenorLance());
    $this->assertEquals($mediaEsperada, $leiloeiro->getMedia(), 0.00001);
  }
}
 ?>
