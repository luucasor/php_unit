<?php

require_once("../Avaliador.php");
require_once("../Lance.php");
require_once("../Leilao.php");
require_once("../Usuario.php");
require_once("../CriadorDeLeilao.php");

class AvaliadorTest extends PHPUnit_Framework_TestCase{

  private $leiloeiro;
  private $jonas;
  private $joao;
  private $jorge;
  private $criador;

  public function setUp(){
    $this->leiloeiro = new Avaliador();
    $this->jonas = new Usuario("Jonas");
    $this->joao = new Usuario("João");
    $this->jorge = new Usuario("Jorge");
    $this->criador = new CriadorDeLeilao();
  }

  public function tearDown() {
    //destroy
  }

  public static function setUpBeforeClass() {
    //var_dump("before class");
  }

  public static function testandoAfterClass() {
    //var_dump("after class");
  }

  public function testAceitaLeilaoEmOrdemCrescente(){

    $maiorEsperado = 400;
    $menorEsperado = 250;
    $mediaEsperada = 316.66666666666669;

    $leilao = $this->criador->para("Playstation")
            ->lance($this->jonas, 250)
            ->lance($this->joao, 300)
            ->lance($this->jorge, 400)
            ->constroi();

    $this->leiloeiro->avalia($leilao);

    $this->assertEquals($maiorEsperado, $this->leiloeiro->getMaiorLance());
    $this->assertEquals($menorEsperado, $this->leiloeiro->getMenorLance());
    $this->assertEquals($mediaEsperada, $this->leiloeiro->getMedia(), 0.00001);
  }

  public function testAceitaLeilaoEmOrdemDecrescente(){

    $maiorEsperado = 400;
    $menorEsperado = 100;

    $leilao = $this->criador->para("Playstation")
            ->lance($this->jonas, 400)
            ->lance($this->joao, 300)
            ->lance($this->jorge, 200)
            ->lance($this->jonas, 100)
            ->constroi();

    $this->leiloeiro->avalia($leilao);

    $this->assertEquals($maiorEsperado, $this->leiloeiro->getMaiorLance(), 0.0001);
    $this->assertEquals($menorEsperado, $this->leiloeiro->getMenorLance(), 0.0001);
  }

  public function testAceitaLeilaoComApenasUmLance(){

    $maiorEsperado = 200;
    $menorEsperado = 200;

    $leilao = $this->criador->para("Playstation")
            ->lance($this->jonas, 200)
            ->constroi();

    $this->leiloeiro->avalia($leilao);

    $this->assertEquals($maiorEsperado, $this->leiloeiro->getMaiorLance(), 0.0001);
    $this->assertEquals($menorEsperado, $this->leiloeiro->getMenorLance(), 0.0001);
  }

  public function testAceitaLeilaoComValoresAleatorios(){

    $maiorEsperado = 700;
    $menorEsperado = 120;

    $leilao = $this->criador->para("Playstation")
            ->lance($this->jonas, 200)
            ->lance($this->joao, 450)
            ->lance($this->jorge, 120)
            ->lance($this->jonas, 700)
            ->lance($this->joao, 630)
            ->lance($this->jorge, 230)
            ->constroi();


    $this->leiloeiro->avalia($leilao);

    $this->assertEquals($maiorEsperado, $this->leiloeiro->getMaiorLance(), 0.0001);
    $this->assertEquals($menorEsperado, $this->leiloeiro->getMenorLance(), 0.0001);
  }


  public function testAceitaLeilaoComCincoLancesEscolheOsTresMaiores(){

    $maiorEsperado1 = 700;
    $maiorEsperado2 = 600;
    $maiorEsperado3 = 500;

    $leilao = $this->criador->para("Playstation")
            ->lance($this->jonas, 700)
            ->lance($this->joao, 600)
            ->lance($this->jorge, 500)
            ->lance($this->jonas, 400)
            ->lance($this->joao, 300)
            ->lance($this->jorge, 200)
            ->constroi();


    $this->leiloeiro->pegaOsMaioresNo($leilao);
    $maiores = $this->leiloeiro->getTresMaiores();

    $this->assertEquals($maiorEsperado1, $maiores[0]->getValor(), 0.0001);
    $this->assertEquals($maiorEsperado2, $maiores[1]->getValor(), 0.0001);
    $this->assertEquals($maiorEsperado3, $maiores[2]->getValor(), 0.0001);
  }


  public function testAceitaLeilaoComDoisLancesRetornaDoisLances(){

    $maiorEsperado1 = 700;
    $maiorEsperado2 = 500;

    $leilao = $this->criador->para("Playstation")
            ->lance($this->jonas, 700)
            ->lance($this->jorge, 500)
            ->constroi();

    $this->leiloeiro->pegaOsMaioresNo($leilao);
    $maiores = $this->leiloeiro->getTresMaiores();

    $this->assertEquals($maiorEsperado1, $maiores[0]->getValor(), 0.0001);
    $this->assertEquals($maiorEsperado2, $maiores[1]->getValor(), 0.0001);
  }

  /**
  * @expectedException Exception
  */
  public function testNaoDeveAvaliarLeiloesSemNenhumLanceDado(){

    $criador = new CriadorDeLeilao();
    $leilao = $this->criador->para("Playstation 3 Novo")->constroi();

    $this->leiloeiro->avalia($leilao);
  }
}
 ?>
