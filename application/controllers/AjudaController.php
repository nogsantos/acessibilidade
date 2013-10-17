<?php
/**
 *
 * Descrição:Classe Sobre
 *
 *
 * @author Fabricio Nogueira
 *
 * @since 22-Aug-2013
 *
 * @version 1.0.0
 *
 */
require_once 'MainController.php';
class AjudaController extends MainController {
    
    public function init() {
        parent::init();
    }
    /**
     * formulário Sobre o sistema.
     */
    public function sobreAction(){
        $this->_helper->layout()->disableLayout();
    }
}
