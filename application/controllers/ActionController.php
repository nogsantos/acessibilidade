<?php
/**
 *
 * Descrição:Classe ActionController. Crud e regras de negocio.
 *
 *
 * @author Fabricio Nogueira
 *
 * @since 09-Oct-2013
 *
 * @version 1.0.0
 *
 */
require_once 'MainController.php';
require_once 'ActionBusiness.php';
class ActionController extends MainController{
    /**
     * Init
     */
    public function init(){
        parent::init();
    }
    /**
     * Salvar Action
     */
    public function salvarActionAction(){
        /*
         * O formulário deve ser acessado apenas via modal.
         */
        if ($this->getRequest()->getMethod() === "GET"){
            throw new Exception(Custom_Mensagem::ERRO_ACESSO_INDEVIDO);
        }else{
            $this->disableViewAndLayout();
            $oActionForm = new Form_Action();
            if ($this->getRequest()->isPost()) {
                $vDados = $this->getRequest()->getPost();
                if ($oActionForm->isValid($vDados)) {
                    
                    $oActionBusiness = new ActionBusiness();
                    $retorno = $oActionBusiness->cadastrar($oActionForm->getValues());

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
                    $this->_redirect('/administrativo/action');
                }else{
                    /*
                     * Retorna para a listagem os erros não validados por js que
                     * foram encontrados pelo zend form.
                     */
                    foreach ($oActionForm->getMessages() as $campo => $valor) {
                        $nomeCampo = strstr($campo,'_',true) ;
                        foreach ($valor as $mensagem) {
                            $erros .='<i class="icon-caret-right"></i> Campo: <b>'.strtoupper($nomeCampo).'</b> Mensagem: '.$mensagem.'. <br />';
                        }
                    }
                    $this->_helper->flashMessenger->addMessage('
                        <div class="alert alert-danger">
                            <i class="icon-exclamation-sign"></i> Erros<br />'.$erros.'
                        </div>
                    ');
                    /*
                     * Redirecionamento para a listagem
                     */
                    $this->_redirect('/administrativo/action');
                }
            }
        }
    }
}
