<?php

class ErrorController extends Zend_Controller_Action {
    
    public function errorAction() {
        /*
         * Monta o menu principal
         */
        $this->_helper->actionStack('navigation', 'Menu');
        
        $errors = $this->_getParam('error_handler');

        if (!$errors || !$errors instanceof ArrayObject) {
            $this->view->message = 'You have reached the error page';
            return;
        }
//        echo '<pre>';print_r($errors->type);exit;
        switch ($errors->type) {
            case Zend_Controller_Plugin_ErrorHandler::EXCEPTION_NO_ROUTE:
            case Zend_Controller_Plugin_ErrorHandler::EXCEPTION_NO_CONTROLLER:
            case Zend_Controller_Plugin_ErrorHandler::EXCEPTION_NO_ACTION:
                // 404 error -- controller or action not found
                $this->getResponse()->setHttpResponseCode(404);
                $priority = Zend_Log::NOTICE;
                $this->view->message = 'Página não localizada.';
                break;
            case Zend_Controller_Plugin_ErrorHandler::EXCEPTION_OTHER:
                $this->_redirect('erro.html');
                $priority = Zend_Log::CRIT;
                $this->view->message = 'Erro na coneão com o banco de dados.';
                break;
            default:
                // application error
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

