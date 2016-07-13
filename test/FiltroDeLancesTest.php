<?php
require_once("../Usuario.php");
require_once("../FiltroDeLances.php");
require_once("../Lance.php");
class FiltroDeLancesTest extends PHPUnit_Framework_TestCase {

    public function testDeveSelecionarLancesEntre1000E3000() {
        $joao = new Usuario("Joao");

        $filtro = new FiltroDeLances();
        $lances = [];
        $lances[] = new Lance($joao,999);
        $lances[] = new Lance($joao,1500);
        $lances[] = new Lance($joao,3001);

        $resultado = $filtro->filtra($lances);

        $this->assertEquals(1, count($resultado));
        $this->assertEquals(1500, $resultado[0]->getValor(), 0.00001);
    }

    public function testDeveSelecionarLancesEntre500E700() {
        $joao = new Usuario("Joao");

        $filtro = new FiltroDeLances();
        $lances = [];
        $lances[] = new Lance($joao,400);
        $lances[] = new Lance($joao,600);
        $lances[] = new Lance($joao,800);

        $resultado = $filtro->filtra($lances);
        $this->assertEquals(1, count($resultado));
        $this->assertEquals(600, $resultado[0]->getValor(), 0.00001);
    }

    public function testDeveSelecionarLancesMaioresQue5000() {
        $joao = new Usuario("Joao");

        $filtro = new FiltroDeLances();
        $lances = [];
        $lances[] = new Lance($joao,4999);
        $lances[] = new Lance($joao,5001);

        $resultado = $filtro->filtra($lances);
        $this->assertEquals(1, count($resultado));
        $this->assertEquals(5001, $resultado[0]->getValor(), 0.00001);
    }
}
?>
