<?php
/**
 *
 * Descrição:Classe LoginAs
 *
 *
 * @author Fabricio Nogueira
 *
 * @since 20-Aug-2013
 *
 * @version 1.0.0
 *
 */
class My_View_Helper_LoggedInAs extends Zend_View_Helper_Abstract {
    /**
     * Retorna os nome do usuário logado
     */
    public function loggedInAs() {
        $auth = Zend_Auth::getInstance();
        if ($auth->hasIdentity()) {
            $username       = $auth->getIdentity()->login;
            $dtUltimoLogin  = $auth->getIdentity()->data_ultimo_acesso;
            $locale         = new Zend_Locale('pt_BR');
            Zend_Date::setOptions(array('format_type' => 'php'));
            $date           = new Zend_Date($dtUltimoLogin, false, $locale);
            return '<em>Bem vindo <b>' . $username . '</b>! Último login em ' . $date.'</em>';
        }
        $request    = Zend_Controller_Front::getInstance()->getRequest();
        $controller = $request->getControllerName();
        $action     = $request->getActionName();
        if ($controller == 'auth' && $action == 'index') {
            return true;
        }
        return false;
    }
    /**
     * Confirma se há um usuário logado
     */
    public function isLogged(){
        $auth = Zend_Auth::getInstance();
        if ($auth->hasIdentity()) {
            return true;
        }else{
            return false;
        }
    }

}

