<?php
class Usuario_ModelTest extends PHPUnit_Framework_TestCase {
    private $CI;
    public function setUp() {
        $this->CI = &get_instance();
    }
    public function testValidarEmailUsuarioConEmailUsuarioExistente() {
        $mailUsuario = 'pepe@pepe.com';
        
        $this->CI->load->model ('Usuario_Model');
        $mailChecked = $this->CI->Usuario_Model->comprobarEmail($mailUsuario);
        
        $this->assertNotNull ( $mailChecked );
        $this->assertEquals ($mailUsuario, $mailChecked->email);
    }
}
?>