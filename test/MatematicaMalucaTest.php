<?php

require_once("../MatematicaMaluca.php");

class MatematicaMalucaTest extends PHPUnit_Framework_TestCase{

    public function testValorMaiorQueTrinta(){
      $mm = new MatematicaMaluca();
      $this->assertEquals(124, $mm->contaMaluca(31));
    }

    public function testValorMenorQueTrinta(){
      $mm = new MatematicaMaluca();
      $this->assertEquals(87, $mm->contaMaluca(29));
    }

    public function testValorIgualTrinta(){
      $mm = new MatematicaMaluca();
      $this->assertEquals(90, $mm->contaMaluca(30));
    }

    public function testValorMaiorQueDez(){
      $mm = new MatematicaMaluca();
      $this->assertEquals(33, $mm->contaMaluca(11));
    }

    public function testValorMenorQueDez(){
      $mm = new MatematicaMaluca();
      $this->assertEquals(18, $mm->contaMaluca(9));
    }

    public function testValorIgualDez(){
      $mm = new MatematicaMaluca();
      $this->assertEquals(20, $mm->contaMaluca(10));
    }

}
