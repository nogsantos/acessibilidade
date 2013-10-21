<?php
/**
 *
 * Descrição: Classe AdministrativoController. 
 * Controla as views dos formularios dos modulos.
 *
 * @author Fabricio Nogueira
 *
 * @since 21-Aug-2013
 *
 * @version 1.0.0
 *
 */
require_once 'MainController.php';
class AdministrativoController extends MainController {
    /**
     * Atributos
     */
    private $_controller = 'administrativo';
    /**
     * Init
     */
    public function init(){
        parent::init();
    }
    /**
     * Index
     */
    public function indexAction(){
        /*
         * Monta o menu principal
         */
        $this->_helper->actionStack('navigation', 'Menu');
        $this->_redirect('index');
    }
    /**
     * Index Cadastro de modulos.
     */
    public function controllerAction(){
      /*
       * Monta o menu principal
       */
       $this->_helper->actionStack('navigation', 'Menu');
       /*
        * Grid
        */
        $this->view->headLink()->prependStylesheet(
            $this->url.
            '/DataTables-1.9.4/media/css/jquery.dataTables.css',
            'screen',
            true,
            array('id' => 'jquery.dataTables')
        );
        $this->view->headLink()->prependStylesheet(
            $this->url.
            '/DataTables-1.9.4/media/css/jquery.dataTables_themeroller.css',
            'screen',
            true,
            array('id' => 'jquery.dataTables_themeroller')
        );
        $this->view->headScript()->appendFile(
            $this->url.'/DataTables-1.9.4/media/js/jquery.dataTables.js'
        );
        /*
         * Paginador do grid
         */
        $this->view->headScript()->appendFile(
            $this->url.'/DataTables-1.9.4/media/js/paginador.js'
        );
        /*
         * Carrega o grid no formulário.
         */
        $this->view->headScript()->appendFile(
           $this->url.'/js/loadGrid.js'
        );
        /*
         * Script da página
         */
        $this->view->headScript()->appendFile(
            $this->url.'/js/administrativo/controller/controller.js'
        );
        /*
         * Listagem dos módulos cadastrados.
         */
        $oController             = new Application_Model_Controller();
        $this->view->oController = $oController->listarControllers();
        /*
         * Chamada para Menu da listagem.
         */
        $oMenuListagem = new Custom_Menu();
        $oMenuListagem->setController($this->_controller);
        $oMenuListagem->setCodigoAction('controller');
        $oMenuListagem->setTipoMenu('L');
        $this->view->menu = $oMenuListagem->menu();
    }
    /**
     * Cadastro de módulo
     */
    public function controllerFormAction(){
        /*
         * O formulário deve ser acessado apenas via modal.
         */
        if ($this->getRequest()->getMethod() === 'GET'){
            throw new Exception(Custom_Mensagem::ERRO_ACESSO_INDEVIDO);
        }else{
           /*
            * Chamada para o menu do usuário.
            */
            $oMenuListagem = new Custom_Menu();
            $oMenuListagem->setController($this->_controller);
            $oMenuListagem->setCodigoAction('controller');
            $oMenuListagem->setTipoMenu('F');
            $this->view->menu = $oMenuListagem->menu();
            /*
             * Importante! Para chamada dos formulários modais, é necessário
             * desativar o layout.
             */
            $this->_helper->layout()->disableLayout();
            /*
             * Preenchendo os dados no formulário.
             */
            $oController = new Application_Model_Controller();
            $oController->setIdController($this->getParam('id_controller'));
            $this->view->oController = $oController->consultarController();
        }
    }
    /**
     * Listagem de Actions
     */
    public function actionAction(){
      /*
       * Monta o menu principal
       */
       $this->_helper->actionStack('navigation', 'Menu');
       /*
        * Grid
        */
        $this->view->headLink()->prependStylesheet(
            $this->url.
            '/DataTables-1.9.4/media/css/jquery.dataTables.css',
            'screen',
            true,
            array('id' => 'jquery.dataTables')
        );
        $this->view->headLink()->prependStylesheet(
            $this->url.
            '/DataTables-1.9.4/media/css/jquery.dataTables_themeroller.css',
            'screen',
            true,
            array('id' => 'jquery.dataTables_themeroller')
        );
         $this->view->headScript()->appendFile(
            $this->url.'/DataTables-1.9.4/media/js/jquery.dataTables.js'
        );
        /*
         * Paginador do grid
         */
        $this->view->headScript()->appendFile(
           $this->url.'/DataTables-1.9.4/media/js/paginador.js'
        );
        /*
         * Carrega o grid no formulário.
         */
        $this->view->headScript()->appendFile(
           $this->url.'/js/loadGrid.js'
        );
        /*
         * Script da página
         */
        $this->view->headScript()->appendFile(
           $this->url.'/js/administrativo/action/action.js'
        );
       /*
        * Listagem de actions cadastradas.
        */
        $oAction             = new Application_Model_Action();
        $this->view->oAction = $oAction->listarActions();
        /*
         * Chamada para Menu da listagem.
         */
        $oMenuListagem = new Custom_Menu();
        $oMenuListagem->setController($this->_controller);
        $oMenuListagem->setCodigoAction('action');
        $oMenuListagem->setTipoMenu('L');
        $this->view->menu = $oMenuListagem->menu();
    }
    /**
     * Formulário Actions
     */
    public function actionFormAction(){
       /*
        * Chamada para o menu do usuário.
        */
        $oMenuListagem = new Custom_Menu();
        $oMenuListagem->setController($this->_controller);
        $oMenuListagem->setCodigoAction('action');
        $oMenuListagem->setTipoMenu('F');
        $this->view->menu = $oMenuListagem->menu();
        /*
         * Importante! Para chamada dos formulários modais, é necessário
         * desativar o layout.
         */
         $this->_helper->layout()->disableLayout();
    }
    /**
     * Consulta ajax listando os controllers cadastrados no sistema.
     * 
     * @return json
     */
    public function listagemControllerAction(){
        $this->disableViewAndLayout();
        $oController = new Application_Model_Controller();
        echo Zend_Json::encode($oController->listarControllers()->toArray());
    }
    /**
     * Pdf
     */
    public function pdfAction(){
        
    }
    
}
