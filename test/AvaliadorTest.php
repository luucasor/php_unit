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

  public function testAceitaLeilaoEmOrdemDecrescente(){

    $maiorEsperado = 400;
    $menorEsperado = 100;

    $leilao = new Leilao("Playstation");

    $jonas = new Usuario("jonas",1);
    $joao  = new Usuario("joao",2);
    $jorge = new Usuario("jorge",3);

    $leilao->propoe(new Lance($jonas, 400));
    $leilao->propoe(new Lance($joao, 300));
    $leilao->propoe(new Lance($jorge, 200));
    $leilao->propoe(new Lance($jonas, 100));


    $leiloeiro = new Avaliador();
    $leiloeiro->avalia($leilao);

    $this->assertEquals($maiorEsperado, $leiloeiro->getMaiorLance(), 0.0001);
    $this->assertEquals($menorEsperado, $leiloeiro->getMenorLance(), 0.0001);
  }

  public function testAceitaLeilaoComApenasUmLance(){

    $maiorEsperado = 200;
    $menorEsperado = 200;

    $leilao = new Leilao("Playstation");
    $jonas = new Usuario("jonas",1);
    $leilao->propoe(new Lance($jonas, 200));

    $leiloeiro = new Avaliador();
    $leiloeiro->avalia($leilao);

    $this->assertEquals($maiorEsperado, $leiloeiro->getMaiorLance(), 0.0001);
    $this->assertEquals($menorEsperado, $leiloeiro->getMenorLance(), 0.0001);
  }

  public function testAceitaLeilaoComValoresAleatorios(){

    $maiorEsperado = 700;
    $menorEsperado = 120;

    $leilao = new Leilao("Playstation");

    $jonas = new Usuario("jonas",1);
    $joao  = new Usuario("joao",2);
    $jorge = new Usuario("jorge",3);

    $leilao->propoe(new Lance($jonas, 200));
    $leilao->propoe(new Lance($joao, 450));
    $leilao->propoe(new Lance($jorge, 120));

    $leilao->propoe(new Lance($jonas, 700));
    $leilao->propoe(new Lance($joao, 630));
    $leilao->propoe(new Lance($jorge, 230));

    $leiloeiro = new Avaliador();
    $leiloeiro->avalia($leilao);

    $this->assertEquals($maiorEsperado, $leiloeiro->getMaiorLance(), 0.0001);
    $this->assertEquals($menorEsperado, $leiloeiro->getMenorLance(), 0.0001);
  }


  public function testAceitaLeilaoComCincoLancesEscolheOsTresMaiores(){

    $maiorEsperado1 = 700;
    $maiorEsperado2 = 600;
    $maiorEsperado3 = 500;

    $leilao = new Leilao("Playstation");

    $jonas = new Usuario("jonas",1);
    $joao  = new Usuario("joao",2);
    $jorge = new Usuario("jorge",3);

    $leilao->propoe(new Lance($jonas, 700));
    $leilao->propoe(new Lance($joao, 600));
    $leilao->propoe(new Lance($jorge, 500));

    $leilao->propoe(new Lance($jonas, 400));
    $leilao->propoe(new Lance($joao, 300));
    $leilao->propoe(new Lance($jorge, 200));

    $leiloeiro = new Avaliador();
    $leiloeiro->pegaOsMaioresNo($leilao);
    $maiores = $leiloeiro->getTresMaiores();

    $this->assertEquals($maiorEsperado1, $maiores[0]->getValor(), 0.0001);
    $this->assertEquals($maiorEsperado2, $maiores[1]->getValor(), 0.0001);
    $this->assertEquals($maiorEsperado3, $maiores[2]->getValor(), 0.0001);
  }


  public function testAceitaLeilaoComDoisLancesRetornaDoisLances(){

    $maiorEsperado1 = 700;
    $maiorEsperado2 = 500;

    $leilao = new Leilao("Playstation");

    $jonas = new Usuario("jonas",1);
    $jorge = new Usuario("jorge",2);

    $leilao->propoe(new Lance($jonas, 700));
    $leilao->propoe(new Lance($jorge, 500));

    $leiloeiro = new Avaliador();
    $leiloeiro->pegaOsMaioresNo($leilao);
    $maiores = $leiloeiro->getTresMaiores();

    $this->assertEquals($maiorEsperado1, $maiores[0]->getValor(), 0.0001);
    $this->assertEquals($maiorEsperado2, $maiores[1]->getValor(), 0.0001);
  }

  public function testAceitaLeilaoSemLancesRetornaVazio(){

    $retornoEsperado = array();
    $leilao = new Leilao("Playstation");

    $leiloeiro = new Avaliador();
    $leiloeiro->pegaOsMaioresNo($leilao);
    $maiores = $leiloeiro->getTresMaiores();

    $this->assertEquals($retornoEsperado, $maiores, 0.0001);
  }
}
 ?>
