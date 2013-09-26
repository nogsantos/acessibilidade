<?php
/**
 *
 * Descrição: Classe AdministrativoController
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
         * Carrega o grid no formulário.
         */
        $this->view->headScript()->appendFile(
           Zend_Controller_Front::getInstance()->getBaseUrl().
           '/js/loadGrid.js'
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
            * Script para formulários default.
            */
            $this->view->headScript()->appendFile(
                Zend_Controller_Front::getInstance()->getBaseUrl().
                '/js/default-forms.js'
            );
            /*
             * Estilo para formulários.
             */
            $this->view->headLink()->setStylesheet(
                Zend_Controller_Front::getInstance()->getBaseUrl() .
                '/css/forms.css'
            );
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
                    $oController->setIdController(
                        $oControllerForm->getValue('id_controller')
                    );
                    $oController->setCodigoController(
                        $oControllerForm->getValue('codigo_controller')
                    );
                    $oController->setNomeController(
                        $oControllerForm->getValue('nome_controller')
                    );
                    $oController->setDescricaoController(
                        $oControllerForm->getValue('descricao_controller')
                    );
                    $oController->setNumeroOrdem(
                        $oControllerForm->getValue('numero_ordem')
                    );
                    $oController->setDataBloqueio(
                        $oControllerForm->getValue('data_bloqueio')
                    );
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
         * Carrega o grid no formulário.
         */
        $this->view->headScript()->appendFile(
           Zend_Controller_Front::getInstance()->getBaseUrl().
           '/js/loadGrid.js'
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
         * MagicSugest
         */
        $this->view->headLink()->setStylesheet(
            Zend_Controller_Front::getInstance()->getBaseUrl() .
            '/magicsuggest/magicsuggest-1.3.1.css'
        );
        $this->view->headScript()->appendFile(
            Zend_Controller_Front::getInstance()->getBaseUrl().
            '/magicsuggest/magicsuggest-1.3.1.js'
        );
        /*
         * Script da página
         */
        $this->view->headScript()->appendFile(
            Zend_Controller_Front::getInstance()->getBaseUrl().
            '/js/administrativo/action/action-form.js'
        );
        /*
         * Script para formulários
         */
        $this->view->headScript()->appendFile(
            Zend_Controller_Front::getInstance()->getBaseUrl().
            '/js/numeros.js'
        );
        /*
         * Script para formulários default.
         */
        $this->view->headScript()->appendFile(
            Zend_Controller_Front::getInstance()->getBaseUrl().
            '/js/default-forms.js'
        );
       /*
        * Estilo para formulários.
        */
//        $this->view->headLink()->setStylesheet(
//            Zend_Controller_Front::getInstance()->getBaseUrl() .
//            '/css/forms.css'
//        );
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
