<?php
/**
 *
 * Descrição:Classe GrassController controller geral para o sistema.
 *
 *
 * @author Fabricio Nogueira
 *
 * @since 13-Sep-2013
 *
 * @version 1.0.0
 *
 */
abstract class MainController extends Zend_Controller_Action {
    /*
     * Atributos
     */
    protected $frontController;
    protected $url;
    /**
     * Construtor
     */
    public function init() {
        parent::init();
        $this->url = Zend_Controller_Front::getInstance()->getBaseUrl();
        /*
         * Default styles.
         */
        $this->view->headLink()->prependStylesheet(
            $this->url.
            '/css/bootstrap.min.css',
            'screen',
            true,
            array('id' => 'bootstrap.min')
        );
        $this->view->headLink()->prependStylesheet(
            $this->url.
            '/css/bootstrap-theme.min.css',
            'screen',
            true,
            array('id' => 'bootstrap-theme.min')
        );
        $this->view->headLink()->prependStylesheet(
            $this->url.
            '/css/normalize.css',
            'screen',
            true,
            array('id' => 'normalize')
        );
        $this->view->headLink()->prependStylesheet(
            $this->url.
            '/css/font-awesome.min.css',
            'screen',
            true,
            array('id' => 'font-awesome.min')
        );
        $this->view->headLink()->prependStylesheet(
            $this->url.
            '/jquery-ui-1.10.3.custom/css/smoothness/jquery-ui-1.10.3.custom.min.css',
            'screen',
            true,
            array('id' => 'jquery-ui-1.10.3.custom.min')
        );
        $this->view->headLink()->prependStylesheet(
            $this->url.
            '/jquery.qtip/jquery.qtip.min.css',
            'screen',
            true,
            array('id' => 'jquery.qtip.min')
        );
        $this->view->headLink()->prependStylesheet(
            $this->url.
            '/css/main.css',
            'screen',
            true,
            array('id' => 'main')
        );
        $this->view->headLink()->prependStylesheet(
            $this->url.
            '/css/default.css',
            'screen',
            true,
            array('id' => 'default')
        );
        /*
         * Default Scripts
         */
        $this->view->headScript()->appendFile(
            $this->url.
            '/js/jquery-1.10.2.min.js'
        );
        $this->view->headScript()->appendFile(
            $this->url.
            '/js/jquery-countdown/jquery.countdown.min.js'
        );
        $this->view->headScript()->appendFile(
            $this->url.
            '/js/jquery-countdown/jquery.countdown-pt-BR.js'
        );
        $this->view->headScript()->appendFile(
            $this->url.
            '/js/bootstrap.min.js'
        );
        $this->view->headScript()->appendFile(
            $this->url.
            '/js/bootbox.js'
        );
        $this->view->headScript()->appendFile(
            $this->url.
            '/js/jquery.maskedinput.min.js'
        );
        $this->view->headScript()->appendFile(
            $this->url.
            '/js/layout.js'
        );
        $this->view->headScript()->appendFile(
            $this->url.
            '/js/default.js'
        );
        $this->view->headScript()->appendFile(
            $this->url.
            '/jquery.qtip/jquery.qtip.min.js'
        );
        /*
         * Mensagens para views.
         */
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
        if (stristr($this->view->baseUrl, 'index.php')) {
            $this->view->baseUrl = substr(
                $this->view->baseUrl, 
                0, 
                strpos($this->view->baseUrl, 'index.php') - 1
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
        $this->viewBasePath     = $this->view->getScriptPaths();
        $this->viewBasePath     = $this->viewBasePath[0];
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
            $this->_zendLocale = Zend_Registry::get('Zend_Locale');
        }
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
    /**
     * traz o locale pra view
     */
    public function setLocaleToView() {
        $localeType = new Zend_Session_Namespace('locale');
        if (isset($localeType->translate)) {
            $msgs = $localeType->translate->getMessages();
            $this->view->translate = $msgs;
        }
    }
    /**
     * Tradução de mensagens
     */
    public function getTranslateMessages() {
        $localeType = new Zend_Session_Namespace('locale');
        if (isset($localeType->translate)) {
            $msgs = $localeType->translate->getMessages();
            return $msgs;
        }
        return 0;
    }
}
