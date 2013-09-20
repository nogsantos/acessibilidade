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
require_once 'MainController.php';
class AdministrativoController extends MainController {
    
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
            '/js/administrativo/controller/controller.js'
        );
        /*
         * Listagem dos módulos cadastrados.
         */
        $oController = new Application_Model_Controller();
        $this->view->oController = $oController->listarControllers();
        /*
         * Menu da listagem
         */
        $this->view->menu = Custom_Menu_Listagem::menu();
    }
    /**
     * Cadastro de módulo
     */
    public function controllerFormAction(){
        /*
         * O formulário deve ser acessado apenas via modal.
         */
        if ($this->getRequest()->getMethod() === "GET"){
            throw new Exception(Custom_Mensagem::ERRO_ACESSO_INDEVIDO);
        }else{
           /*
            * Script da página
            */
            $this->view->headScript()->appendFile(
                Zend_Controller_Front::getInstance()->getBaseUrl().
                '/js/administrativo/controller/controller-form.js'
            );
           /*
            * Script para formulários
            */
            $this->view->headScript()->appendFile(
                Zend_Controller_Front::getInstance()->getBaseUrl().
                '/js/numeros.js'
            );
            /*
             * Estilo para formulários.
             */
            $this->view->headLink()->setStylesheet(
                Zend_Controller_Front::getInstance()->getBaseUrl() .
                '/css/forms.css'
            );
           /*
            * Monta o menu do usuário
            */
            $this->_helper->actionStack('navigation-formulario', 'Menu');
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
     * Salvar modulo
     */
    public function salvarControllerAction(){
        /*
         * O formulário deve ser acessado apenas via modal.
         */
        if ($this->getRequest()->getMethod() === "GET"){
            throw new Exception(Custom_Mensagem::ERRO_ACESSO_INDEVIDO);
        }else{
            $this->disableViewAndLayout();
            $oControllerForm = new Form_Controller();
            if ($this->getRequest()->isPost()) {
                $vDados = $this->getRequest()->getPost();
                if ($oControllerForm->isValid($vDados)) {
                    $oController = new Application_Model_Controller();
                    $oController->setIdController($oControllerForm->getValue('id_controller'));
                    $oController->setCodigoController($oControllerForm->getValue('codigo_controller'));
                    $oController->setNomeController($oControllerForm->getValue('nome_controller'));
                    $oController->setDescricaoController($oControllerForm->getValue('descricao_controller'));
                    $oController->setNumeroOrdem($oControllerForm->getValue('numero_ordem'));
                    $oController->setDataBloqueio($oControllerForm->getValue('data_bloqueio'));
                    if(empty($oControllerForm->getValue('id_controller'))){
                        /*
                         * Cadastro
                         */
                        $retorno = $oController->cadastrar();
                    }else{
                        /*
                         * Edição
                         */
                        $retorno = $oController->editar();
                    }
                    if(!$retorno){
                        $this->_helper->flashMessenger->addMessage('
                            <div class="alert alert-danger">
                                '.$retorno.'
                            </div>
                        ');
                    }else{
                        $this->_helper->flashMessenger->addMessage('
                            <div class="alert alert-success">
                                '.Custom_Mensagem::ACAO_SUCESSO.'
                            </div>
                        ');
                    }
                    /*
                     * Redirecionamento para a listagem
                     */
                    $this->_helper->redirector('controller');
                }
            }
        }
    }
    /**
     * Excluir módulo
     */
    public function excluirControllerAction(){
        /*
         * O formulário deve ser acessado apenas via modal.
         */
        if ($this->getRequest()->getMethod() === "GET"){
            throw new Exception(Custom_Mensagem::ERRO_ACESSO_INDEVIDO);
        }else{
            $this->disableViewAndLayout();
            $oController = new Application_Model_Controller();
            $oController->setIdController($this->getParam('id_controller'));
            $retorno = $oController->excluir();
            if(!$retorno){
                $this->_helper->flashMessenger->addMessage('
                    <div class="alert alert-danger">
                        ' . $retorno . '
                    </div>
                ');
            } else {
                $this->_helper->flashMessenger->addMessage('
                    <div class="alert alert-success">
                        '.Custom_Mensagem::ACAO_SUCESSO.'
                    </div>
                ');
            }
        }
    }
    /**
     * Cadasro de Actions
     */
    public function actionAction(){
      /*
       * Monta o menu principal
       */
       $this->_helper->actionStack('navigation', 'Menu');
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
            '/js/administrativo/action/action.js'
        );
       /*
        * Listagem de actions cadastradas.
        */
        $oAction = new Application_Model_Action();
        $this->view->oAction = $oAction->listarActions();
    }
    /**
     * 
     */
    public function usuarioAction(){
        
    }
    /**
     * Pdf
     */
    public function pdfAction(){
        
    }
    
}
