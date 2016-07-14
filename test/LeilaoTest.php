<?php
require_once("../Leilao.php");
require_once("../Usuario.php");
require_once("../Lance.php");
class LeilaoTest extends PHPUnit_Framework_TestCase {

  public function testNaoDeveAceitarDoisLancesSeguidosDoMesmoUsuario(){
      $leilao = new Leilao("Macbook caro");
      $joao = new Usuario("Joao");

      $leilao->propoe(new Lance($joao, 2000));
      $leilao->propoe(new Lance($joao, 2500));

      $this->assertEquals(1, count($leilao->getLances()));
      $this->assertEquals(2000, $leilao->getLances()[0]->getValor());
  }

  public function testNaoDeveAceitarMaisDeCincoLancesDoMesmoUsuario(){
    $leilao = new Leilao("Macbook caro");
    $joao = new Usuario("Joao");
    $jonas = new Usuario("Jonas");

    $leilao->propoe(new Lance($joao, 1000));
    $leilao->propoe(new Lance($jonas, 2000));

    $leilao->propoe(new Lance($joao, 3000));
    $leilao->propoe(new Lance($jonas, 4000));

    $leilao->propoe(new Lance($joao, 5000));
    $leilao->propoe(new Lance($jonas, 6000));

    $leilao->propoe(new Lance($joao, 7000));
    $leilao->propoe(new Lance($jonas, 8000));

    $leilao->propoe(new Lance($joao, 9000));
    $leilao->propoe(new Lance($jonas, 10000));

    $leilao->propoe(new Lance($joao, 11000));

    $this->assertEquals(10, count($leilao->getLances()));
    $ultimo = count($leilao->getLances())- 1;
    $this->assertEquals(10000, $leilao->getLances()[$ultimo]->getValor());
  }

  public function testDobrarLanceUsuarioContendoLanceAnterior(){
    $leilao = new Leilao("Macbook caro");
    $joao = new Usuario("Joao");
    $jonas = new Usuario("Jonas");

    $leilao->propoe(new Lance($joao, 1000));
    $leilao->propoe(new Lance($jonas, 1500));
    $leilao->dobraLance($joao);

    $this->assertEquals(3, count($leilao->getLances()));
    $this->assertEquals(2000, $leilao->getLances()[2]->getValor());
  }

  public function testNaoDeveDobrarCasoNaoHajaLanceAnterior(){
    $leilao = new Leilao("Macbook caro");
    $joao = new Usuario("Joao");
    $jonas = new Usuario("Jonas");

    $leilao->propoe(new Lance($jonas, 1500));
    $leilao->dobraLance($joao);

    $this->assertEquals(1, count($leilao->getLances()));
    $this->assertEquals(1500, $leilao->getLances()[0]->getValor());
  }
}
?>
