<?php

/**
 *
 * Descrição:Classe UsuarioController
 *
 *
 * @author Fabricio Nogueira
 *
 * @since 20-Aug-2013
 *
 * @version 1.0.0
 *
 */
class UsuarioController extends Zend_Controller_Action {
    /*
     * Atributos
     */
    private $login;
    private $senha;
    private $dataUltimoLogin;
    
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

    public function getDataUltimoLogin() {
        return $this->dataUltimoLogin;
    }

    public function setDataUltimoLogin($dataUltimoLogin) {
        $this->dataUltimoLogin = $dataUltimoLogin;
    }
    
    public function init() {
        parent::init();
    }
    /**
     * Ações para o usuário ao logar no sistema.
     */
    public function login(){
        
    }
    /**
     * Ações para o usuário ao deslogar do sistema.
     */
    public function logout(){
        
    }
}
