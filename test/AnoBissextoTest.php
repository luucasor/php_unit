<?php

require_once("../AnoBissexto.php");

class AnoBissextoTest extends PHPUnit_Framework_TestCase{

  public function testVerificaSeAnoBissexto(){
    $ano = 2016;

    $verificador = new AnoBissexto;
    $this->assertEquals(true, $verificador->ehBissexto($ano));
  }
}
?>
