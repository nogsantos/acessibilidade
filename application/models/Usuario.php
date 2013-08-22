<?php
/**
 *
 * Descrição:Classe Usuario
 *
 *
 * @author Fabricio Nogueira
 *
 * @since 21-Aug-2013
 *
 * @version 1.0.0
 *
 */
class Application_Model_Usuario extends Zend_Db_Table_Abstract {
    /*
     * Atributos
     */
    protected $_name    = 'usuario';
    protected $_schema  = 'public';
    protected $_primary = 'fk_pessoa';
    protected $fkPessoa;
    protected $login;
    protected $senha;
    protected $dataCadastro;
    
    public function getFkPessoa() {
        return $this->fkPessoa;
    }

    public function setFkPessoa($fkPessoa) {
        $this->fkPessoa = $fkPessoa;
    }

    public function getLogin() {
        return $this->login;
    }

    public function setLogin($login) {
        $this->login = $login;
    }

    public function getSenha() {
        return $this->senha;
    }

    public function setSenha($senha) {
        $this->senha = $senha;
    }

    public function getDataCadastro() {
        return $this->dataCadastro;
    }

    public function setDataCadastro($dataCadastro) {
        $this->dataCadastro = $dataCadastro;
    }
    /**
     * Cadastro
     */
    public function cadastrar(){
        
    }
    /**
     * Edição
     */
    public function editar(){
        
    }
    /**
     * Exclusão
     */
    public function excluir(){
        
    }
}
