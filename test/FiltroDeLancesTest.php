<?php

require_once("../Usuario.php");
require_once("../FiltroDeLances.php");
require_once("../Lance.php");
require_once("../Usuario.php");

class FiltroDeLancesTest extends PHPUnit_Framework_TestCase {

    public function testDeveSelecionarLancesEntre1000E3000() {
        $joao = new Usuario("Joao");

        $filtro = new FiltroDeLances();
        $lances = [];
        $lances[] = new Lance($joao,2000);
        $lances[] = new Lance($joao,1000);
        $lances[] = new Lance($joao,3000);
        $lances[] = new Lance($joao,800);

        $resultado = $filtro->filtra($lances);

        $this->assertEquals(1, count($resultado));
        $this->assertEquals(2000, $resultado[0]->getValor(), 0.00001);
    }

    public function testDeveSelecionarLancesEntre500E700() {
        $joao = new Usuario("Joao");

        $filtro = new FiltroDeLances();
        $lances = [];
        $lances[] = new Lance($joao,600);
        $lances[] = new Lance($joao,500);
        $lances[] = new Lance($joao,700);
        $lances[] = new Lance($joao,800);

        $resultado = $filtro->filtra($lances);
        $this->assertEquals(1, count($resultado));
        $this->assertEquals(600, $resultado[0]->getValor(), 0.00001);
    }

    public function testDeveSelecionarLancesAbaixoDe1000() {
        $joao = new Usuario("Joao");

        $filtro = new FiltroDeLances();
        $lances = [];
        $lances[] = new Lance($joao,999);

        $resultado = $filtro->filtra($lances);
        var_dump($resultado);
        $this->assertEquals(0, count($resultado));
    }

    //criar testes com 400; 800 e 6000
}
?>
