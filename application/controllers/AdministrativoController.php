<?php
/**
 *
 * Descrição:Classe AdministrativoController
 *
 *
 * @author Fabricio Nogueira
 *
 * @since 21-Aug-2013
 *
 * @version 1.0.0
 *
 */
class AdministrativoController extends Zend_Controller_Action {
    
    public function init(){
        /*
         * Monta o menu principal
         */
        $this->_helper->actionStack('navigation', 'Menu');
    }
    /**
     * Index
     */
    public function indexAction(){
         $this->_redirect('index');
    }
    /**
     * Cadastro de modulos
     */
    public function moduloAction(){
       /*
        * Grid
        */
        $this->view->headLink()->setStylesheet(
            Zend_Controller_Front::getInstance()->getBaseUrl().
            '/DataTables-1.9.4/media/css/jquery.dataTables.css'
        );
        $this->view->headLink()->setStylesheet(
            Zend_Controller_Front::getInstance()->getBaseUrl().
            '/DataTables-1.9.4/media/css/jquery.dataTables_themeroller.css'
        );
         $this->view->headScript()->appendFile(
            Zend_Controller_Front::getInstance()->getBaseUrl().
            '/DataTables-1.9.4/media/js/jquery.dataTables.js'
        );
         /*
          * Paginador do grid
          */
         $this->view->headScript()->appendFile(
            Zend_Controller_Front::getInstance()->getBaseUrl().
            '/DataTables-1.9.4/media/js/paginador.js'
        );
         /*
          * Script da página
          */
         $this->view->headScript()->appendFile(
            Zend_Controller_Front::getInstance()->getBaseUrl().
            '/js/administrativo/modulo/modulo.js'
        );
        /*
         * Monta o menu do usuário
         */
//        $this->_helper->actionStack('usuario', 'Menu');
    }
    public function cadModuloAction(){
//        $this->_helper->layout()->disableLayout();
    }
    /**
     * Cadastro de Controllers
     */
    public function controllerAction(){
        
    }
    /**
     * Cadasro de Actions
     */
    public function actionAction(){
        /*
         * Monta o menu do usuário
         */
        $this->_helper->actionStack('usuario', 'Menu');
    }
    /**
     * 
     */
    public function usuarioAction(){
        
    }
}
