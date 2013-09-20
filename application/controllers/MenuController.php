<?php
/**
 *
 * Descrição:Classe MenuController
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
class MenuController extends MainController {
    
    public function init(){
        parent::init();
    }
    /*
     * Menu Principal
     */
    public function navigationAction(){
        $this->_helper->viewRenderer->setResponseSegment('navigation');
        $oMenu                 = new Application_Model_Controller();
        $vItensMenu            = $oMenu->retornarMenuDinamico();
        $this->view->itensMenu = $vItensMenu;
    }
    /**
     * Retorna menu para formulário.
     */
    public function navigationFormularioAction(){
        $this->_helper->viewRenderer->setResponseSegment('navigation-formulario');
        $oMenuForm             = new Application_Model_Action();
        $oMenuForm->setFkController(1);
        $oMenuForm->setTipoMenu('F');
        $vItensMenuForm        = $oMenuForm->retornarMenuDinamico();
        $this->view->itensMenu = $vItensMenuForm;
    }
    /**
     * Retorna o menu para a listagem.
     */
    public function navigationListagemAction(){
        $this->_helper->viewRenderer->setResponseSegment('navigation-listagem');
        $oMenuForm             = new Application_Model_Action();
        $oMenuForm->setFkController(1);
        $oMenuForm->setTipoMenu('L');
        $vItensMenuForm        = $oMenuForm->retornarMenuDinamico();
        $this->view->itensMenu = $vItensMenuForm;
    }
}
