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
    
    protected $frontController;
    
    public function init(){
        parent::init();
        
        $this->view->menssagens = $this->_helper->flashMessenger->getMessages();
        
        $this->frontController = Zend_Controller_Front::getInstance();
        if (!is_object($this->view)) {
            $this->_setInvokeArgs(array('noViewRenderer' => true));
        }
        $this->initView();
        $this->_request->setBaseUrl();
        $this->view->baseUrl        = $this->_request->getBaseUrl();
        $this->view->actionName     = $this->_request->getActionName();
        $this->view->controllerName = $this->_request->getControllerName();
        /*
         * Caso não esteja habilitado o rewrite, remove o index.php da url
         */
        if (stristr($this->view->baseUrl, "index.php")) {
            $this->view->baseUrl = substr(
                $this->view->baseUrl, 
                0, 
                strpos($this->view->baseUrl, "index.php") - 1
            );
        }
        $module = explode(
            DIRECTORY_SEPARATOR,
            $this->frontController->getModuleDirectory()
        );
        $this->view->moduleName = $module[count($module) - 1];
        $this->moduleDir        = $this->frontController->getModuleDirectory();
        $this->view->moduleDir  = $this->moduleDir;
        $this->frontController->setParams($this->_request->getParams());
        $this->viewBasePath = $this->view->getScriptPaths();
        $this->viewBasePath = $this->viewBasePath[0];
        if (isset($this->cParams)) {
            if (is_array($this->cParams)) {
                foreach ($this->cParams as $k => $v) {
                    $this->frontController->setParam($k, $v);
                }
            }
        }
        /*
         * seta a variável _zendLocale 
         */
        if (Zend_Registry::isRegistered('Zend_Locale')) {
            $this->_zendLocale = Zend_Registry::get("Zend_Locale");
        }
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
     * Cadastro de modulos
     */
    public function moduloAction(){
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
            '/js/administrativo/modulo/modulo.js'
        );
        /*
         * Listagem dos módulos cadastrados.
         */
        $oModulo = new Application_Model_Modulo();
        $this->view->oModulo = $oModulo->listarModulos();
    }
    /**
     * Cadastro de módulo
     */
    public function formModuloAction(){
        /*
         * O formulário deve ser acessado apenas via modal.
         */
        if ($this->getRequest()->getMethod() === "GET"){
            throw new Exception(Custom_Mensagens::ERRO_ACESSO_INDEVIDO);
        }else{
           /*
            * Script da página
            */
            $this->view->headScript()->appendFile(
                Zend_Controller_Front::getInstance()->getBaseUrl().
                    '/js/administrativo/modulo/form-modulo.js'
            );
           /*
            * Monta o menu do usuário
            */
            $this->_helper->actionStack('navigation-formulario', 'Menu');
            $this->_helper->layout()->disableLayout();
            /*
             * Preenchendo os dados no formulário.
             */
            $oModulo = new Application_Model_Modulo();
            $oModulo->setIdModulo($this->getParam('id_modulo'));
            $this->view->oModulo = $oModulo->consultarModulo();
        }
    }
    /**
     * Salvar modulo
     */
    public function salvarModuloAction(){
        /*
         * O formulário deve ser acessado apenas via modal.
         */
        if ($this->getRequest()->getMethod() === "GET"){
            throw new Exception(Custom_Mensagens::ERRO_ACESSO_INDEVIDO);
        }else{
            $this->disableViewAndLayout();
            $oModuloForm = new Form_Modulo();
            if ($this->getRequest()->isPost()) {
                $vDados = $this->getRequest()->getPost();
                if ($oModuloForm->isValid($vDados)) {
                    $oModulo = new Application_Model_Modulo();
                    $oModulo->setIdModulo($oModuloForm->getValue('id_modulo'));
                    $oModulo->setCodigoModulo($oModuloForm->getValue('codigo_modulo'));
                    $oModulo->setNomeModulo($oModuloForm->getValue('nome_modulo'));
                    $oModulo->setDescricaoModulo($oModuloForm->getValue('descricao_modulo'));
                    $oModulo->setNumeroOrdem($oModuloForm->getValue('numero_ordem'));
                    $oModulo->setDataBloqueio($oModuloForm->getValue('data_bloqueio'));
                    $retorno = "";
                    if(empty($oModuloForm->getValue('id_modulo'))){
                        /*
                         * Cadastro
                         */
                        $retorno = $oModulo->cadastrar();
                    }else{
                        /*
                         * Edição
                         */
                        $retorno = $oModulo->editar();
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
                                '.Custom_Mensagens::ACAO_SUCESSO.'
                            </div>
                        ');
                    }
                    $this->_helper->redirector('modulo');
                }
            }
        }
    }
    /**
     * Excluir módulo
     */
    public function excluirModuloAction(){
        /*
         * O formulário deve ser acessado apenas via modal.
         */
        if ($this->getRequest()->getMethod() === "GET"){
            throw new Exception(Custom_Mensagens::ERRO_ACESSO_INDEVIDO);
        }else{
            $this->disableViewAndLayout();
            $oModulo = new Application_Model_Modulo();
            $oModulo->setIdModulo($this->getParam('id_modulo'));
            $retorno = $oModulo->excluir();
        }
        if (!$retorno) {
            $this->_helper->flashMessenger->addMessage('
                <div class="alert alert-danger">
                    ' . $retorno . '
                </div>
            ');
        } else {
            $this->_helper->flashMessenger->addMessage('
                <div class="alert alert-success">
                    '.Custom_Mensagens::ACAO_SUCESSO.'
                </div>
            ');
        }
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
    /**
     * método que desabilita a view e o layout
     */
    protected function disableViewAndLayout() {
        if ($this->_helper->hasHelper('layout')) {
            $this->_helper->layout()->disableLayout();
        }
        $this->frontController->setParam('noViewRenderer', true);
    }
}
