<?php

class ErrorController extends Zend_Controller_Action {

    private $writer;
    private $logger;

    public function init() {
        $this->writer = new Zend_Log_Writer_Stream('../data/logs/application.log');
        $this->logger = new Zend_Log($this->writer);
    }

    public function errorAction() {
        /*
         * Monta o menu principal
         */
        $this->_helper->actionStack('navigation', 'Menu');

        $errors = $this->_getParam('error_handler');

        if (!$errors || !$errors instanceof ArrayObject) {
            $this->view->message = 'Você chegou a página de erro';
            return;
        }
        switch ($errors->type) {
            case Zend_Controller_Plugin_ErrorHandler::EXCEPTION_NO_ROUTE:
            case Zend_Controller_Plugin_ErrorHandler::EXCEPTION_NO_CONTROLLER:
            case Zend_Controller_Plugin_ErrorHandler::EXCEPTION_NO_ACTION:
                $this->getResponse()->setHttpResponseCode(404);
                $this->view->message = 'Página não localizada.';
                $mensagem = $errors->exception;
                $priority = Zend_Log::NOTICE;
                $this->logger->notice($mensagem);
                break;
            case Zend_Controller_Plugin_ErrorHandler::EXCEPTION_OTHER:
                $mensagem = $errors->exception;
                $this->view->message = $mensagem;
                $priority = Zend_Log::CRIT;
                $this->logger->crit($mensagem);
                $this->_redirect('erro.html');
                break;
            default:
                $this->getResponse()->setHttpResponseCode(500);
                $priority = Zend_Log::CRIT;
                $this->view->message = 'Erro da aplicação';
                break;
        }

        // Log exception, if logger available
        if ($log == $this->getLog()) {
            $log->log($this->view->message, $priority, $errors->exception);
            $log->log('Requisição de parametros', $priority, $errors->request->getParams());
        }

        // conditionally display exceptions
        if ($this->getInvokeArg('displayExceptions') == true) {
            $this->view->exception = $errors->exception;
        }

        $this->view->request = $errors->request;
    }

    public function getLog() {
        $bootstrap = $this->getInvokeArg('bootstrap');
        if (!$bootstrap->hasResource('Log')) {
            return false;
        }
        $log = $bootstrap->getResource('Log');
        return $log;
    }

}

