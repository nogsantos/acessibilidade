<?php
/**
 *
 * Descrição:Helper Usuario, retorna os dados do usuário logado.
 *
 *
 * @author Fabricio Nogueira
 *
 * @since 20-Aug-2013
 *
 * @version 1.0.0
 *
 */
class My_View_Helper_Usuario extends Zend_View_Helper_Abstract {
    /**
     * Retorna os nome do usuário logado
     */
    public function usuario() {
        $auth = Zend_Auth::getInstance();
        if ($auth->hasIdentity()) {
            $oUsuario  = new Application_Model_Usuario();
            $oUsuario->setFkPessoa($auth->getIdentity()->fk_pessoa);
            $resultUsuario = $oUsuario->consultarDados();
            return '<em>Bem vindo <b>' . $resultUsuario->nome.'!</b></em>';
        }
        $request    = Zend_Controller_Front::getInstance()->getRequest();
        $controller = $request->getControllerName();
        $action     = $request->getActionName();
        if ($controller == 'auth' && $action == 'index') {
            return true;
        }
        return false;
    }
}

